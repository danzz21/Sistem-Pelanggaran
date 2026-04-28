<?php
session_start();

// kalau sudah login, langsung ke dashboard
if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login E-Makh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

<div class="card p-4" style="width:350px;">
    <h3 class="text-center mb-4">Login E-Makh</h3>

    <form action="proses-login.php" method="POST">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">Login</button>
    </form>
</div>

</body>
</html>