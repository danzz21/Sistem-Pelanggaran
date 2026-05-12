<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>404 Not Found</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    height:100vh;
    background:linear-gradient(135deg,#0f172a,#1e293b);
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;
    color:white;
}

.container{
    text-align:center;
    animation:fadeIn 1s ease;
}

.error-code{
    font-size:140px;
    font-weight:700;
    color:#ef4444;
    text-shadow:0 0 25px rgba(239,68,68,0.6);
}

.title{
    font-size:32px;
    margin-top:-20px;
    font-weight:600;
}

.desc{
    margin-top:10px;
    color:#cbd5e1;
    font-size:15px;
}

.btn{
    display:inline-block;
    margin-top:30px;
    padding:12px 28px;
    background:#2563eb;
    color:white;
    text-decoration:none;
    border-radius:12px;
    transition:0.3s;
    font-weight:600;
}

.btn:hover{
    background:#1d4ed8;
    transform:translateY(-3px);
}

.circle{
    position:absolute;
    border-radius:50%;
    background:rgba(255,255,255,0.05);
    animation:float 6s infinite ease-in-out;
}

.circle:nth-child(1){
    width:200px;
    height:200px;
    top:-50px;
    left:-50px;
}

.circle:nth-child(2){
    width:300px;
    height:300px;
    bottom:-100px;
    right:-100px;
    animation-delay:2s;
}

@keyframes float{
    0%{
        transform:translateY(0px);
    }
    50%{
        transform:translateY(20px);
    }
    100%{
        transform:translateY(0px);
    }
}

@keyframes fadeIn{
    from{
        opacity:0;
        transform:translateY(20px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

</style>
</head>
<body>

<div class="circle"></div>
<div class="circle"></div>

<div class="container">

    <div class="error-code">
        404
    </div>

    <div class="title">
        Halaman Tidak Ditemukan
    </div>

    <div class="desc">
        Maaf, halaman yang kamu cari tidak tersedia.
    </div>

    <a href="/project-software/frontend/dashboard.php" class="btn">
        Kembali ke Dashboard
    </a>

</div>

</body>
</html>