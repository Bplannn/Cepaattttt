<?php
include('../config/db.php'); include('../includes/header.php'); include('../includes/sidebar.php');
?>

<div class="container mt-4">
  <h3>Hasil Perhitungan</h3>

<?php
// If history_id provided, show detail for that history (printable)
if (!empty($_GET['history_id'])) {
  $hid = (int)$_GET['history_id'];
  $h = $koneksi->query("SELECT * FROM compute_history WHERE id_history=$hid")->fetch_assoc();
  if (!$h) { echo "<div class='alert alert-warning'>History tidak ditemukan.</div>"; }
  else {
    echo "<div class='mb-2'>Perhitungan oleh <strong>".htmlspecialchars($h['computed_by'])."</strong> pada <strong>".htmlspecialchars($h['computed_at'])."</strong></div>";
    echo "<button class='btn btn-sm btn-outline-primary mb-2' onclick='window.print()'>Cetak</button>";
    echo "<table class='table table-bordered'><thead><tr><th>Rank</th><th>ID</th><th>Equipment</th><th>Score</th></tr></thead><tbody>";
    $q = $koneksi->query("SELECT cr.*, e.equipment_name FROM compute_results cr JOIN equipment e ON cr.id_equipment=e.id_equipment WHERE cr.history_id=$hid ORDER BY cr.score DESC");
    $rank = 1;
    while($row = $q->fetch_assoc()){
      echo "<tr><td>$rank</td><td>{$row['id_equipment']}</td><td>".htmlspecialchars($row['equipment_name'])."</td><td>".round($row['score'],4)."</td></tr>";
      $rank++;
    }
    echo "</tbody></table>";
  }
} else {
  // list history as date links
  echo "<h5>Riwayat Perhitungan</h5>";
  $qh = $koneksi->query("SELECT * FROM compute_history ORDER BY computed_at DESC");
  echo "<ul class='list-group'>";
  while($hh = $qh->fetch_assoc()){
    $date = $hh['computed_at'];
    $who = htmlspecialchars($hh['computed_by']);
    echo "<li class='list-group-item'><a href='?history_id={$hh['id_history']}'>".htmlspecialchars($date)."</a> &nbsp;<small>by $who</small></li>";
  }
  echo "</ul>";
}

?>

</div>

<?php include('../includes/footer.php'); ?>
