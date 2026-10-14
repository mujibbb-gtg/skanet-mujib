<?php
session_start();
include "koneksi.php";

$error = false;
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $query = mysqli_query($koneksi,"SELECT * FROM users WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query); 

    if($cek > 0){
        $_SESSION['status'] = "sukses";
        $_SESSION['username'] = $username;
        header('location:index.php?status=login');
        exit;
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc; 
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 20px 20px;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #334155;
            overflow: hidden;
        }

        /* === LOGO SEKOLAH (Di Luar Form) === */
        .logo-main {
            width: 100px; /* Ukuran Logo */
            height: auto;
            margin-bottom: 25px; /* Jarak antara logo dan tombol Login */
            z-index: 20;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1)); /* Sedikit bayangan agar elegan */
        }

        /* === WADAH UTAMA === */
        .auth-container {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 320px;
        }

        /* Tombol Awal (Muncul saat tidak disentuh) */
        .peek-btn {
            background-color: #0f172a;
            color: #ffffff;
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.3);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 10;
        }

        /* Menyembunyikan tombol saat kursor disentuh (hover), saat diketik (focus), atau saat error (is-open) */
        .auth-container.is-open .peek-btn,
        .auth-container:hover .peek-btn,
        .auth-container:focus-within .peek-btn {
            opacity: 0;
            pointer-events: none;
            transform: translateY(-20px) scale(0.8);
        }

        /* === FORM DISCLOSE (Tersembunyi secara default) === */
        .disclose-form {
            position: absolute;
            top: 0;
            background: #ffffff;
            padding: 35px 40px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            width: 100%;
            box-sizing: border-box;
            
            visibility: hidden;
            pointer-events: none;
            transition: visibility 0s linear 0.65s; 
        }

        /* Memunculkan form saat disentuh / diketik / error */
        .auth-container.is-open .disclose-form,
        .auth-container:hover .disclose-form,
        .auth-container:focus-within .disclose-form {
            visibility: visible;
            pointer-events: auto;
            transition: visibility 0s; 
        }

        h1 {
            color: #0f172a;
            font-size: 26px;
            font-weight: 700;
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
            letter-spacing: -0.5px;
        }
        h1::before { content: '👋 '; }

        /* Animasi efek cairan (wipe-in) */
        .disclose-form > * {
            clip-path: inset(-10% -10% 100% -10%);
            transform: translateY(20px);
            opacity: 0;
            transition: clip-path 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275), 
                        transform 0.65s cubic-bezier(0.175, 0.885, 0.32, 1.275), 
                        opacity 0.4s ease;
        }

        /* Animasi membuka cairan saat disentuh (hover) */
        .auth-container.is-open .disclose-form > *,
        .auth-container:hover .disclose-form > *,
        .auth-container:focus-within .disclose-form > * {
            clip-path: inset(-10% -10% -10% -10%);
            transform: translateY(0);
            opacity: 1;
        }

        /* Delay beruntun untuk Judul, Input 1, Input 2, dan Tombol */
        .auth-container.is-open .disclose-form > *:nth-child(1), .auth-container:hover .disclose-form > *:nth-child(1), .auth-container:focus-within .disclose-form > *:nth-child(1) { transition-delay: 0.1s; } 
        .auth-container.is-open .disclose-form > *:nth-child(2), .auth-container:hover .disclose-form > *:nth-child(2), .auth-container:focus-within .disclose-form > *:nth-child(2) { transition-delay: 0.2s; } 
        .auth-container.is-open .disclose-form > *:nth-child(3), .auth-container:hover .disclose-form > *:nth-child(3), .auth-container:focus-within .disclose-form > *:nth-child(3) { transition-delay: 0.3s; } 
        .auth-container.is-open .disclose-form > *:nth-child(4), .auth-container:hover .disclose-form > *:nth-child(4), .auth-container:focus-within .disclose-form > *:nth-child(4) { transition-delay: 0.4s; } 

        /* === INPUT & TOMBOL === */
        .form-group {
            font-size: 14px;
            font-weight: 600;
            color: #475569;
        }

        input[type="text"],
        input[type="password"] {
            display: block;
            width: 100%;
            padding: 12px 16px;
            margin: 8px 0 20px 0;
            background-color: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            color: #0f172a;
            transition: all 0.2s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            background-color: #ffffff;
            border-color: #6366f1;
            outline: none;
            box-shadow: 0 0 0 4px #e0e7ff;
        }

        button.submit-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: #0f172a;
            color: #ffffff;
            padding: 12px 30px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            margin: 10px auto 0;
            width: 100%;
            transition: all 0.2s ease;
        }

        button.submit-btn::before { content: '🔐'; font-size: 16px; }

        button.submit-btn:hover {
            background-color: #4f46e5;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            transform: translateY(-2px);
        }

        div:where(.swal2-container) { font-family: 'Outfit', sans-serif !important; }
        .swal2-popup { border-radius: 16px !important; }
    </style>
</head>
<body>

    <!-- SVG Filter -->
    <svg style="width:0;height:0;position:absolute;" aria-hidden="true" focusable="false">
        <filter id="goo">
            <feGaussianBlur in="SourceGraphic" stdDeviation="7" result="blur" />
            <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
        </filter>
    </svg>

    <!-- LOGO DITEMPATKAN DI LUAR FORM -->
    <img src="logoti.png" alt="Logo SMKN Takeran" class="logo-main">

    <!-- Container Utama Animasi -->
    <div class="auth-container <?php echo $error ? 'is-open' : ''; ?>">
        
        <!-- Tombol Log In -->
        <button class="peek-btn" type="button">Log in</button>
        
        <!-- Form Terbuka (Muncul saat diarahkan kursor) -->
        <form class="disclose-form" action="" method="POST">
            <h1>Halaman Login</h1>
            
            <div class="form-group">
                Username : 
                <input type="text" name="username" required autocomplete="off">
            </div>
            
            <div class="form-group">
                Password : 
                <input type="password" name="password" required>
            </div>
            
            <button class="submit-btn" name="login">Login</button>
        </form>
    </div>

    <!-- Alert Login Gagal -->
    <?php if($error): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal Login!',
            text: 'Username atau password salah.',
            confirmButtonColor: '#0f172a',
            confirmButtonText: 'Coba Lagi'
        });
    </script>
    <?php endif; ?>

</body>
</html>