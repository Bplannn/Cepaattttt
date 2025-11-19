<?php include('../config/db.php'); include('../includes/header.php'); include('../includes/sidebar.php'); ?>
<h3>Data Sub Kriteria</h3>

<div class="row">
  <div class="col-md-6">
    <h5>Equipment Class</h5>
    <form action="../process/insert_subkriteria.php" method="post" class="input-group mb-2">
      <input type="hidden" name="target" value="equipment_class">
      <input name="name" class="form-control" placeholder="Class name (A)">
      <input name="point" type="number" class="form-control" placeholder="Point (5)">
      <button class="btn btn-success">Tambah</button>
    </form>
    <table class="table table-sm">
      <thead><tr><th>Class</th><th>Point</th></tr></thead>
      <tbody>
      <?php $q=$koneksi->query("SELECT * FROM equipment_class"); while($x=$q->fetch_assoc()){ echo "<tr><td>{$x['class_name']}</td><td>{$x['equipment_class_point']}</td></tr>"; } ?>
      </tbody>
    </table>
  </div>

  <div class="col-md-6">
    <h5>Grade</h5>
    <form action="../process/insert_subkriteria.php" method="post" class="input-group mb-2">
      <input type="hidden" name="target" value="grade">
      <input name="name" class="form-control" placeholder="Grade name (A)">
      <input name="point" type="number" class="form-control" placeholder="Point (5)">
      <button class="btn btn-success">Tambah</button>
    </form>
    <table class="table table-sm">
      <thead><tr><th>Grade</th><th>Point</th></tr></thead>
      <tbody>
      <?php $q=$koneksi->query("SELECT * FROM grade"); while($x=$q->fetch_assoc()){ echo "<tr><td>{$x['grade_name']}</td><td>{$x['grade_point']}</td></tr>"; } ?>
      </tbody>
    </table>
  </div>
</div>

<div class="row mt-4">
  <div class="col-md-6">
    <h5>Classification</h5>
    <form action="../process/insert_subkriteria.php" method="post" class="input-group mb-2">
      <input type="hidden" name="target" value="classification">
      <input name="name" class="form-control" placeholder="Classification name (Rotating work)">
      <input name="point" type="number" class="form-control" placeholder="Point (4)">
      <button class="btn btn-success">Tambah</button>
    </form>
    <table class="table table-sm">
      <thead><tr><th>Classification</th><th>Point</th></tr></thead>
      <tbody>
      <?php $q=$koneksi->query("SELECT * FROM classification"); while($x=$q->fetch_assoc()){ echo "<tr><td>{$x['classification_name']}</td><td>{$x['classification_point']}</td></tr>"; } ?>
      </tbody>
    </table>
  </div>

  <div class="col-md-6">
    <h5>Inspection Period</h5>
    <form action="../process/insert_subkriteria.php" method="post" class="input-group mb-2">
      <input type="hidden" name="target" value="inspection_period">
      <input name="name" class="form-control" placeholder="Period name (2-4)">
      <input name="point" type="number" class="form-control" placeholder="Point (5)">
      <button class="btn btn-success">Tambah</button>
    </form>
    <table class="table table-sm">
      <thead><tr><th>Period</th><th>Point</th></tr></thead>
      <tbody>
      <?php $q=$koneksi->query("SELECT * FROM inspection_period"); while($x=$q->fetch_assoc()){ echo "<tr><td>{$x['period_name']}</td><td>{$x['period_point']}</td></tr>"; } ?>
      </tbody>
    </table>
  </div>
</div>

<?php include('../includes/footer.php'); ?>
