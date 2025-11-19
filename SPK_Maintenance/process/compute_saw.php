<?php
include('../config/db.php');
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
		die('Access denied.');
}

// collect filters
$filters = [];
$where = [];
if(!empty($_POST['id_equipment_class'])) { $filters['id_equipment_class'] = (int)$_POST['id_equipment_class']; $where[] = "e.id_equipment_class=".$filters['id_equipment_class']; }
if(!empty($_POST['id_grade'])) { $filters['id_grade'] = (int)$_POST['id_grade']; $where[] = "e.id_grade=".$filters['id_grade']; }
if(!empty($_POST['id_plant'])) { $filters['id_plant'] = (int)$_POST['id_plant']; $where[] = "e.id_plant=".$filters['id_plant']; }
if(!empty($_POST['id_classification'])) { $filters['id_classification'] = (int)$_POST['id_classification']; $where[] = "e.id_classification=".$filters['id_classification']; }
if(!empty($_POST['id_inspection_period'])) { $filters['id_inspection_period'] = (int)$_POST['id_inspection_period']; $where[] = "e.id_inspection_period=".$filters['id_inspection_period']; }
$where_sql = '';
if(count($where)>0) $where_sql = 'WHERE '.implode(' AND ', $where);

// get equipments matching filter
$sql = "SELECT e.id_equipment, e.equipment_name FROM equipment e $where_sql";
$res = $koneksi->query($sql);
$items = [];
while($r=$res->fetch_assoc()) $items[] = $r;
if(count($items)===0){
		// nothing to compute
		header('Location: ../pages/data_perhitungan.php?msg=no_items'); exit;
}

// get criteria
$kq = $koneksi->query("SELECT * FROM criteria_weight ORDER BY id_criteria");
$criteria = [];
while($k=$kq->fetch_assoc()) $criteria[$k['id_criteria']] = $k;

// build raw matrix (nilai from penilaian or 0)
$matrix = [];
foreach($items as $it){
	$id = $it['id_equipment'];
	$matrix[$id]['name'] = $it['equipment_name'];
	foreach($criteria as $cid=>$meta){
		$s = $koneksi->prepare("SELECT nilai FROM penilaian WHERE id_equipment=? AND id_criteria=?");
		$s->bind_param("ii", $id, $cid);
		$s->execute();
		$res2 = $s->get_result()->fetch_assoc();
		$matrix[$id]['raw'][$cid] = $res2 ? (float)$res2['nilai'] : 0;
	}
}

// normalization
$normalized = [];
foreach($criteria as $cid=>$meta){
	$values = array_map(fn($r) => $r['raw'][$cid] ?? 0, $matrix);
	$max = count($values)>0?max($values):0; $min = count($values)>0?min($values):0;
	foreach($matrix as $id=>$row){
		$x = $row['raw'][$cid] ?? 0;
		if($meta['type']=='benefit'){
			$rval = ($max>0)?($x/$max):0;
		} else {
			$rval = ($x>0)?($min/$x):0;
		}
		$normalized[$id][$cid]=$rval;
	}
}

// compute totals
$results = [];
foreach($matrix as $id=>$row){
	$total=0;
	foreach($criteria as $cid=>$meta){
		$total += ($normalized[$id][$cid] ?? 0) * (float)$meta['weight'];
	}
	$results[$id]=$total;
}

// save history
$filters_json = $koneksi->real_escape_string(json_encode($filters));
$user = $koneksi->real_escape_string($_SESSION['username']);
$ins = $koneksi->query("INSERT INTO compute_history (computed_by, filters) VALUES ('{$user}', '{$filters_json}')");
if(!$ins){
	die('Failed saving history: '.$koneksi->error);
}
$history_id = $koneksi->insert_id;

// save results
foreach($results as $id=>$score){
	$details = $koneksi->real_escape_string(json_encode(['raw'=>$matrix[$id]['raw']]));
	$koneksi->query("INSERT INTO compute_results (history_id, id_equipment, score, details) VALUES ($history_id, $id, $score, '$details')");
}

// redirect to hasil page (detail)
header('Location: ../pages/data_hasil.php?history_id='.$history_id);
exit;
