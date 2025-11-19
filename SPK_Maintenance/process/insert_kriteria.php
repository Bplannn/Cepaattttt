<?php
include('../config/db.php');
$k = $koneksi->real_escape_string($_POST['id_criteria']);
$l = $koneksi->real_escape_string($_POST['criteria_name']);
$w = (float)$_POST['weight'];
$t = $_POST['type'];
$stmt = $koneksi->prepare("INSERT INTO criteria_weight (id_criteria, criteria_name, weight, type) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sdis", $k, $l, $w, $t);
$stmt->execute();
header("Location: ../pages/data_kriteria.php");
