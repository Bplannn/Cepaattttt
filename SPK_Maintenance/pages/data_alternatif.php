<?php
session_start();
include '../config/db.php';

// === PROSES TAMBAH DATA ===
if (isset($_POST['simpan'])) {
  // Only admin can add alternatives
  if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak: Anda tidak memiliki hak untuk menambah data.'); window.location='data_alternatif.php';</script>";
    exit;
  }
    $equipment_name = $_POST['equipment_name'];
    $id_equipment_class = $_POST['id_equipment_class'];
    $id_grade = $_POST['id_grade'];
    $id_plant = $_POST['id_plant'];
    $id_classification = $_POST['id_classification'];
    $id_inspection_period = $_POST['id_inspection_period'];

    $query = "INSERT INTO equipment 
              (equipment_name, id_equipment_class, id_grade, id_plant, id_classification, id_inspection_period)
              VALUES 
              ('$equipment_name', '$id_equipment_class', '$id_grade', '$id_plant', '$id_classification', '$id_inspection_period')";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Ambil id equipment terakhir
        $id_equipment = $koneksi->insert_id;
        // Ambil semua kriteria
        $kq = $koneksi->query("SELECT * FROM criteria_weight ORDER BY id_criteria");
        while($kr = $kq->fetch_assoc()) {
            $id_criteria = $kr['id_criteria'];
            $nilai = 0;
            $cname = strtolower(trim($kr['criteria_name']));
            if ($cname == 'equipment class') {
                $q = $koneksi->query("SELECT equipment_class_point FROM equipment_class WHERE id_equipment_class='$id_equipment_class'");
                $d = $q->fetch_assoc();
                $nilai = $d ? $d['equipment_class_point'] : 0;
            } elseif ($cname == 'grade') {
                $q = $koneksi->query("SELECT grade_point FROM grade WHERE id_grade='$id_grade'");
                $d = $q->fetch_assoc();
                $nilai = $d ? $d['grade_point'] : 0;
            } elseif ($cname == 'classification') {
                $q = $koneksi->query("SELECT classification_point FROM classification WHERE id_classification='$id_classification'");
                $d = $q->fetch_assoc();
                $nilai = $d ? $d['classification_point'] : 0;
            } elseif ($cname == 'inspection period') {
                $q = $koneksi->query("SELECT period_point FROM inspection_period WHERE id_inspection_period='$id_inspection_period'");
                $d = $q->fetch_assoc();
                $nilai = $d ? $d['period_point'] : 0;
            }
            // Insert ke penilaian
            $insert = $koneksi->query("INSERT INTO penilaian (id_equipment, id_criteria, nilai) VALUES ('$id_equipment', '$id_criteria', '$nilai')");
            if(!$insert) {
                echo "<script>alert('Gagal insert penilaian: " . $koneksi->error . "');</script>";
            }
        }
        echo "<script>alert('Data berhasil ditambahkan!'); window.location='data_alternatif.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data: " . mysqli_error($koneksi) . "');</script>";
    }
}

// === QUERY UNTUK TABEL ===
$query = "SELECT e.id_equipment, e.equipment_name,
                 ec.class_name, g.grade_name, p.plant_name,
                 c.classification_name, ip.period_name
          FROM equipment e
          JOIN equipment_class ec ON e.id_equipment_class = ec.id_equipment_class
          JOIN grade g ON e.id_grade = g.id_grade
          JOIN plant p ON e.id_plant = p.id_plant
          JOIN classification c ON e.id_classification = c.id_classification
          JOIN inspection_period ip ON e.id_inspection_period = ip.id_inspection_period";
$result = mysqli_query($koneksi, $query);

// === DROPDOWN DATA RELASI ===
$equipment_class = mysqli_query($koneksi, "SELECT * FROM equipment_class");
$grade = mysqli_query($koneksi, "SELECT * FROM grade");
$plant = mysqli_query($koneksi, "SELECT * FROM plant");
$classification = mysqli_query($koneksi, "SELECT * FROM classification");
$inspection_period = mysqli_query($koneksi, "SELECT * FROM inspection_period");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Alternatif</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h3>Data Alternatif (Equipment)</h3>
    <!-- Back button: go to previous page or to dashboard if no history -->
    <div class="mb-3">
      <button type="button" class="btn btn-secondary" onclick="if(document.referrer) { window.history.back(); } else { window.location='/SPK_Maintenance/pages/dashboard.php'; }">&larr; Kembali</button>
    </div>
    
    <!-- Form Tambah -->
    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <form method="POST" class="mt-3 mb-4">
      <div class="row">
        <div class="col-md-4">
          <label>Nama Equipment</label>
          <input type="text" name="equipment_name" class="form-control" required>
        </div>

        <div class="col-md-4">
          <label>Kelas Equipment</label>
          <select name="id_equipment_class" class="form-select" required>
            <option value="">-- Pilih Class --</option>
            <?php while($row=mysqli_fetch_assoc($equipment_class)) { ?>
              <option value="<?= $row['id_equipment_class'] ?>"><?= $row['class_name'] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="col-md-4">
          <label>Grade</label>
          <select name="id_grade" class="form-select" required>
            <option value="">-- Pilih Grade --</option>
            <?php while($row=mysqli_fetch_assoc($grade)) { ?>
              <option value="<?= $row['id_grade'] ?>"><?= $row['grade_name'] ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-md-4">
          <label>Plant</label>
          <select name="id_plant" class="form-select" required>
            <option value="">-- Pilih Plant --</option>
            <?php while($row=mysqli_fetch_assoc($plant)) { ?>
              <option value="<?= $row['id_plant'] ?>"><?= $row['plant_name'] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="col-md-4">
          <label>Classification</label>
          <select name="id_classification" class="form-select" required>
            <option value="">-- Pilih Classification --</option>
            <?php while($row=mysqli_fetch_assoc($classification)) { ?>
              <option value="<?= $row['id_classification'] ?>"><?= $row['classification_name'] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="col-md-4">
          <label>Inspection Period</label>
          <select name="id_inspection_period" class="form-select" required>
            <option value="">-- Pilih Period --</option>
            <?php while($row=mysqli_fetch_assoc($inspection_period)) { ?>
              <option value="<?= $row['id_inspection_period'] ?>"><?= $row['period_name'] ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="mt-4">
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
      </div>
    </form>
    <?php else: ?>
      <div class="alert alert-info">Anda login sebagai <strong><?=htmlspecialchars($_SESSION['username'] ?? 'Tamu')?></strong>. Anda hanya dapat melihat data.</div>
    <?php endif; ?>

    <!-- Tabel Data -->
    <table class="table table-bordered mt-4">
      <thead class="table-dark">
        <tr>
          <th>No</th>
          <th>Nama Equipment</th>
          <th>Kelas</th>
          <th>Grade</th>
          <th>Plant</th>
          <th>Classification</th>
          <th>Inspection Period</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; while($row=mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $row['equipment_name'] ?></td>
          <td><?= $row['class_name'] ?></td>
          <td><?= $row['grade_name'] ?></td>
          <td><?= $row['plant_name'] ?></td>
          <td><?= $row['classification_name'] ?></td>
          <td><?= $row['period_name'] ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>
</html>
