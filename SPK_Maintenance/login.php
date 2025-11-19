<?php
// simple login page (hard-coded users)
session_start();
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['username'] ?? '';
    $p = $_POST['password'] ?? '';
    // hard-coded users: admin/admin, user/user
    if ($u === 'admin' && $p === 'admin') {
        $_SESSION['username'] = 'admin';
        $_SESSION['role'] = 'admin';
        header('Location: pages/dashboard.php'); exit;
    } elseif ($u === 'user' && $p === 'user') {
      $_SESSION['username'] = 'user';
      $_SESSION['role'] = 'user';
      header('Location: pages/dashboard.php'); exit;
    } else {
        $err = 'Username atau password salah.';
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container" style="max-width:420px">
    <h3>Login</h3>
    <?php if($err): ?><div class="alert alert-danger"><?=htmlspecialchars($err)?></div><?php endif; ?>
    <form method="post">
      <div class="mb-2"><input name="username" class="form-control" placeholder="Username"></div>
      <div class="mb-2"><input name="password" type="password" class="form-control" placeholder="Password"></div>
      <div><button class="btn btn-primary">Login</button></div>
    </form>
    <hr>
    <div>Use <strong>admin/admin</strong> or <strong>user/user</strong></div>
  </div>
</body>
</html>