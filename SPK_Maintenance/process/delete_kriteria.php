<?php
include('../config/db.php');
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $koneksi->query("DELETE FROM criteria_weight WHERE id_criteria = $id");
}
header('Location: ../pages/data_kriteria.php');
exit;
