<?php
session_start();
if($_SESSION['status']<>"sukses"){
    header('location:logout.php');
    exit; // Tambahkan exit agar script benar-benar berhenti
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap');

        /* === CSS VARIABLES UNTUK TEMA === */
        :root {
            /* Light Mode (Default) */
            --bg-color: #f8fafc;
            --dot-color: #cbd5e1;
            --text-heading: #0f172a;
            --text-body: #334155;
            --btn-bg: #ffffff;
            --btn-border: #e2e8f0;
            --btn-hover-border: #c7d2fe;
            --btn-hover-text: #4f46e5;
            --logout-bg: #fff1f2;
            --logout-border: #ffe4e6;
            --logout-text: #e11d48;
            --logout-hover-bg: #ffe4e6;
            --shadow: rgba(0, 0, 0, 0.05);
        }

        .dark-mode {
            /* Dark Mode */
            --bg-color: #0f172a;
            --dot-color: #1e293b;
            --text-heading: #f8fafc;
            --text-body: #cbd5e1;
            --btn-bg: #1e293b;
            --btn-border: #334155;
            --btn-hover-border: #6366f1;
            --btn-hover-text: #818cf8;
            --logout-bg: #4c0519;
            --logout-border: #881337;
            --logout-text: #fb7185;
            --logout-hover-bg: #881337;
            --shadow: rgba(0, 0, 0, 0.3);
        }

        /* === GAYA DASAR === */
        html {
            background-color: var(--bg-color);
            background-image: radial-gradient(var(--dot-color) 1px, transparent 1px);
            background-size: 20px 20px;
            min-height: 100vh;
            transition: background-color 0.3s ease;
        }

        body {
            font-family: 'Outfit', sans-serif;
            margin: 0;
            padding: 50px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--text-body);
            transition: color 0.3s ease;
        }

        /* === TOMBOL TOGGLE TEMA === */
        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--btn-bg);
            border: 1px solid var(--btn-border);
            color: var(--text-heading);
            padding: 10px 14px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 2px 5px var(--shadow);
            transition: all 0.3s ease;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
        }

        .theme-toggle:hover {
            transform: translateY(-2px);
            border-color: var(--btn-hover-border);
        }

        /* === POSISI LOGO KIRI & KANAN === */
        .side-logo {
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            width: 160px;
            opacity: 0.5;
            z-index: -1;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .dark-mode .side-logo {
            opacity: 0.2; /* Dibuat lebih redup saat dark mode agar tidak terlalu mencolok */
        }

        .left-logo { left: 12%; } 
        .right-logo { right: 12%; }

        @media (max-width: 1100px) {
            .side-logo { display: none; }
        }

        /* === MENU UTAMA === */
        h1 {
            color: var(--text-heading);
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
            letter-spacing: -0.5px;
            text-align: center;
            transition: color 0.3s ease;
        }

        ul { padding: 0; margin: 0; width: 100%; max-width: 300px; }

        li {
            list-style-type: none;
            margin-bottom: 12px;
            display: flex;
            justify-content: center; 
        }

        a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            color: var(--text-body);
            background: var(--btn-bg);
            padding: 12px 30px;
            border-radius: 50px; 
            border: 1px solid var(--btn-border);
            font-size: 15px;
            font-weight: 600;
            box-shadow: 0 1px 3px var(--shadow);
            transition: all 0.2s ease;
            width: 100%;
        }

        a:hover {
            border-color: var(--btn-hover-border);
            color: var(--btn-hover-text);
            box-shadow: 0 4px 6px -1px var(--shadow);
            transform: translateY(-2px);
        }

        /* Emoji Otomatis */
        a[href="siswa"]::before { content: '🎓'; }
        a[href="guru"]::before { content: '👨‍🏫'; }
        a[href="mapel"]::before { content: '📚'; }
        a[href="nilai"]::before { content: '📊'; }
        a[href="logout.php"]::before { content: '🚪'; }

        /* Logout Style */
        li:last-child a {
            background-color: var(--logout-bg);
            border-color: var(--logout-border);
            color: var(--logout-text);
            margin-top: 25px; 
        }
        li:last-child a:hover { 
            background-color: var(--logout-hover-bg); 
        }
    </style>
</head>
<body>

    <!-- Tombol Toggle Tema -->
    <button id="themeToggle" class="theme-toggle">🌙 Dark Mode</button>

    <!-- Logo Samping -->
    <img src="logoti.png" class="side-logo left-logo" alt="Logo TI">
    <img src="logorpl.png" class="side-logo right-logo" alt="Logo RPL">

    <h1>Menu Utama</h1>
    <ul>
        <li><a href="siswa">Siswa</a></li>
        <li><a href="guru">Guru</a></li>
        <li><a href="mapel">Mata Pelajaran</a></li>
        <li><a href="nilai">Nilai</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

    <!-- Script untuk fungsi Dark/Light Mode -->
    <script>
        const toggleBtn = document.getElementById('themeToggle');
        const htmlElement = document.documentElement;
        
        // 1. Cek apakah ada preferensi tema yang tersimpan di Local Storage
        const currentTheme = localStorage.getItem('theme');

        // 2. Jika ada dan nilainya 'dark', aktifkan dark mode
        if (currentTheme === 'dark') {
            htmlElement.classList.add('dark-mode');
            toggleBtn.innerHTML = '☀️ Light Mode';
        }

        // 3. Fungsi saat tombol diklik
        toggleBtn.addEventListener('click', function() {
            // Toggle class 'dark-mode' di tag <html>
            htmlElement.classList.toggle('dark-mode');
            
            // Cek apakah sekarang dark mode aktif
            if (htmlElement.classList.contains('dark-mode')) {
                toggleBtn.innerHTML = '☀️ Light Mode';
                localStorage.setItem('theme', 'dark'); // Simpan pilihan user
            } else {
                toggleBtn.innerHTML = '🌙 Dark Mode';
                localStorage.setItem('theme', 'light'); // Simpan pilihan user
            }
        });
    </script>
</body>
</html>