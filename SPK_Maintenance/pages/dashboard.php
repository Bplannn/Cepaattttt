<?php include('../config/db.php'); include('../includes/header.php'); include('../includes/sidebar.php'); ?>
<div class="container mt-3">
  <h3>Dashboard</h3>
  <p>Selamat datang di Sistem Penunjang Keputusan - Maintenance</p>

  <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <div class="row dashboard-cards mb-3">
      <div class="col-md-4"><a href="data_kriteria.php" class="text-decoration-none"><div class="card p-3">Data Kriteria</div></a></div>
      <div class="col-md-4"><a href="data_subkriteria.php" class="text-decoration-none"><div class="card p-3">Data Sub Kriteria</div></a></div>
      <div class="col-md-4"><a href="data_alternatif.php" class="text-decoration-none"><div class="card p-3">Data Alternatif</div></a></div>
    </div>
    <div class="row dashboard-cards">
      <div class="col-md-4"><a href="data_perhitungan.php" class="text-decoration-none"><div class="card p-3">Data Perhitungan</div></a></div>
      <div class="col-md-4"><a href="data_hasil.php" class="text-decoration-none"><div class="card p-3">Data Hasil Akhir</div></a></div>
      <div class="col-md-4"><a href="profil.php" class="text-decoration-none"><div class="card p-3">Profil</div></a></div>
    </div>
  <?php else: ?>
    <!-- regular user: only show view links -->
    <div class="row">
      <div class="col-md-6"><a href="data_alternatif.php" class="text-decoration-none"><div class="card p-3">Lihat Alternatif</div></a></div>
      <div class="col-md-6"><a href="data_hasil.php" class="text-decoration-none"><div class="card p-3">Lihat Hasil Akhir</div></a></div>
    </div>
  <?php endif; ?>

<?php include('../includes/footer.php'); ?>
</div>
