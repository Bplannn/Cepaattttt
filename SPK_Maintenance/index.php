<?php include 'config/db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>SPK Maintenance - Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-2 bg-light vh-100 p-3">
        <h5 class="mb-4">SPK Maintenance</h5>
        <ul class="nav flex-column">
          <li class="nav-item"><a class="nav-link" href="pages/dashboard.php">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="pages/data_kriteria.php">Data Kriteria</a></li>
          <li class="nav-item"><a class="nav-link" href="pages/data_subkriteria.php">Data Sub Kriteria</a></li>
          <li class="nav-item"><a class="nav-link" href="pages/data_alternatif.php">Data Alternatif</a></li>
          <li class="nav-item"><a class="nav-link" href="pages/data_penilaian.php">Data Penilaian</a></li>
          <li class="nav-item"><a class="nav-link" href="pages/data_perhitungan.php">Data Perhitungan</a></li>
          <li class="nav-item"><a class="nav-link" href="pages/data_hasil.php">Data Hasil Akhir</a></li>
          <li class="nav-item"><a class="nav-link" href="pages/profil.php">Profil</a></li>
        </ul>
      </div>

      <!-- Main Content -->
      <div class="col-10 p-4">
        <h3>Selamat datang di Sistem Pendukung Keputusan Maintenance</h3>
        <p>Pilih menu di sebelah kiri untuk mulai mengelola data.</p>
      </div>
    </div>
  </div>
</body>
</html>
