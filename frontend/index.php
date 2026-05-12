<?php
session_start();

// kalau sudah login, langsung ke dashboard
if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login E-Makh</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }

        body{
            height: 100vh;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .login-card{
            width: 380px;
            border: none;
            border-radius: 20px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(12px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
            padding: 35px;
            color: white;
        }

        .login-title{
            font-weight: 600;
            text-align: center;
            margin-bottom: 10px;
        }

        .login-subtitle{
            text-align: center;
            font-size: 14px;
            color: #e5e7eb;
            margin-bottom: 30px;
        }

        .form-label{
            font-size: 14px;
            margin-bottom: 6px;
        }

        .form-control{
            border-radius: 12px;
            padding: 12px;
            border: none;
            background: rgba(255,255,255,0.2);
            color: white;
        }

        .form-control::placeholder{
            color: #ddd;
        }

        .form-control:focus{
            background: rgba(255,255,255,0.25);
            box-shadow: none;
            border: 1px solid #fff;
            color: white;
        }

        .btn-login{
            background: white;
            color: #4f46e5;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover{
            background: #e0e7ff;
            transform: translateY(-2px);
        }

        .logo{
            width: 70px;
            height: 70px;
            background: white;
            color: #4f46e5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: bold;
            margin: 0 auto 20px;
        }
    </style>
</head>
<body>

<div class="login-card">

    <div class="logo">
        E
    </div>

    <h3 class="login-title">Login E-Makh</h3>
    <p class="login-subtitle">Silakan masuk untuk melanjutkan</p>

    <form action="proses-login.php" method="POST">

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input 
                type="text" 
                name="username" 
                class="form-control" 
                placeholder="Masukkan username"
                required
            >
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <input 
                type="password" 
                name="password" 
                class="form-control" 
                placeholder="Masukkan password"
                required
            >
        </div>

        <button type="submit" class="btn btn-login w-100">
            Login
        </button>

    </form>
</div>

</body>
</html>