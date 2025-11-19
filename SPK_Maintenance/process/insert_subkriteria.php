<?php
include('../config/db.php');
$target = $_POST['target'];
$name = $koneksi->real_escape_string($_POST['name']);
$point = (int)$_POST['point'];

if($target === 'equipment_class'){
  $stmt = $koneksi->prepare("INSERT INTO equipment_class (class_name, equipment_class_point) VALUES (?,?)");
  $stmt->bind_param("si",$name,$point);
}
elseif($target === 'grade'){
  $stmt = $koneksi->prepare("INSERT INTO grade (grade_name, grade_point) VALUES (?,?)");
  $stmt->bind_param("si",$name,$point);
}
$stmt->execute();
header("Location: ../pages/data_subkriteria.php");
