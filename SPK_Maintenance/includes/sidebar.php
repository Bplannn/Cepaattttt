<?php
// sidebar column
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<div class="col-2 bg-light sidebar vh-100 p-3">
  <h4>Menu</h4>
  <ul class="nav flex-column">
    <li class="nav-item"><a class="nav-link" href="/SPK_Maintenance/pages/dashboard.php">Dashboard</a></li>
    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
      <li class="nav-item"><a class="nav-link" href="/SPK_Maintenance/pages/data_kriteria.php">Data Kriteria</a></li>
      <li class="nav-item"><a class="nav-link" href="/SPK_Maintenance/pages/data_subkriteria.php">Data Sub Kriteria</a></li>
      <li class="nav-item"><a class="nav-link" href="/SPK_Maintenance/pages/data_alternatif.php">Data Alternatif</a></li>
      <li class="nav-item"><a class="nav-link" href="/SPK_Maintenance/pages/data_perhitungan.php">Data Perhitungan</a></li>
      <li class="nav-item"><a class="nav-link" href="/SPK_Maintenance/pages/data_hasil.php">Data Hasil Akhir</a></li>
      <li class="nav-item"><a class="nav-link" href="/SPK_Maintenance/pages/profil.php">Profil</a></li>
    <?php else: ?>
      <!-- regular user: only see alternatif and hasil -->
      <li class="nav-item"><a class="nav-link" href="/SPK_Maintenance/pages/data_alternatif.php">Data Alternatif</a></li>
      <li class="nav-item"><a class="nav-link" href="/SPK_Maintenance/pages/data_hasil.php">Data Hasil Akhir</a></li>
    <?php endif; ?>
  </ul>
</div>
<div class="col-10 p-4">
