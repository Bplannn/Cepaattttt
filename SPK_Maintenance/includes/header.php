<?php
// include this at top of pages
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>SPK SAW - Maintenance</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { padding-top: 56px; }
    .sidebar { min-width:220px; max-width:220px; }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand ms-3" href="/SPK_Maintenance/index.php">SISTEM PENUNJANG KEPUTUSAN</a>
    <div class="ms-auto text-white">
      <?php if(isset($_SESSION['username'])): ?>
        <span class="me-3">Logged as: <strong><?=htmlspecialchars(
          
          
        
        
        
        
        
        
        $_SESSION['username'])?></strong> (<?=htmlspecialchars($_SESSION['role'])?>)</span>
        <a href="/SPK_Maintenance/process/logout.php" class="btn btn-sm btn-light">Logout</a>
      <?php else: ?>
        <a href="/SPK_Maintenance/login.php" class="btn btn-sm btn-light">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<div class="container-fluid">
  <div class="row">
