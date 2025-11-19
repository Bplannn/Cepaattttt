<?php
include '../config/db.php';
$query = "SELECT e.id_equipment, e.equipment_name,
                 ec.class_name, g.grade_name, p.plant_name, ip.period_name
          FROM equipment e
          JOIN equipment_class ec ON e.id_equipment_class = ec.id_equipment_class
          JOIN grade g ON e.id_grade = g.id_grade
          JOIN plant p ON e.id_plant = p.id_plant
          JOIN inspection_period ip ON e.id_inspection_period = ip.id_inspection_period";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Alternatif</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <h3>Data Alternatif (Equipment)</h3>
  <table class="table table-bordered mt-3">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Nama Equipment</th>
        <th>Kelas</th>
        <th>Grade</th>
        <th>Plant</th>
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
        <td><?= $row['period_name'] ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>
