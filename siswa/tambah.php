<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
    
    <!-- SCRIPT TEMA WAJIB DI ATAS AGAR TIDAK KEDIP -->
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark-mode');
        }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap');

        /* === 1. DEKLARASI VARIABEL TEMA === */
        :root {
            --bg-html: #f8fafc;
            --bg-dots: #cbd5e1;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --bg-form: #ffffff;
            --border-color: #e2e8f0;
            --bg-input: #f1f5f9;
            --bg-input-focus: #ffffff;
            --focus-ring: #d1fae5;
            --btn-kembali-bg: #ffffff;
            --btn-kembali-text: #334155;
            --btn-kembali-hover: #f1f5f9;
            --shadow: rgba(0, 0, 0, 0.1);
        }

        html.dark-mode {
            --bg-html: #0f172a;
            --bg-dots: #334155;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --bg-form: #1e293b;
            --border-color: #475569;
            --bg-input: #334155;
            --bg-input-focus: #0f172a;
            --focus-ring: rgba(16, 185, 129, 0.25);
            --btn-kembali-bg: #1e293b;
            --btn-kembali-text: #f1f5f9;
            --btn-kembali-hover: #334155;
            --shadow: rgba(0, 0, 0, 0.4);
        }

        /* === 2. PENERAPAN VARIABEL CSS === */
        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-html);
            background-image: radial-gradient(var(--bg-dots) 1px, transparent 1px);
            background-size: 20px 20px;
            min-height: 100vh;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: background-color 0.3s, background-image 0.3s;
        }

        h1 {
            color: var(--text-primary);
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }
        h1::before { content: '📝 '; }

        form br { display: none; }

        form {
            background: var(--bg-form);
            padding: 35px 40px;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px var(--shadow);
            width: 340px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-secondary);
        }

        input[type="text"] {
            display: block;
            width: 100%;
            padding: 12px 16px;
            margin: 8px 0 20px 0;
            background-color: var(--bg-input);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            color: var(--text-primary);
            transition: 0.2s;
        }

        input[type="text"]:focus {
            background-color: var(--bg-input-focus);
            border-color: #10b981; 
            outline: none;
            box-shadow: 0 0 0 4px var(--focus-ring);
        }

        button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: #10b981;
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
            transition: 0.2s;
        }
        button::before { content: '💾'; font-size: 16px; }
        button:hover { 
            background-color: #059669; 
            transform: translateY(-1px); 
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2); 
        }

        a[href="index.php"] {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            background-color: var(--btn-kembali-bg);
            color: var(--btn-kembali-text);
            padding: 10px 25px;
            border-radius: 50px;
            border: 1px solid var(--border-color);
            font-size: 14px;
            font-weight: 600;
            margin-top: 20px;
            box-shadow: 0 1px 3px var(--shadow);
            transition: 0.2s;
        }
        a[href="index.php"]::before { content: '🔙'; font-size: 14px; }
        a[href="index.php"]:hover { 
            background-color: var(--btn-kembali-hover); 
            transform: translateY(-1px); 
        }
    </style>
</head>
<body>

    <h1>Tambah Data</h1>
    
    <form action="simpan.php" method="POST">
        Nis : <input type="text" name="nis" autocomplete="off" required>
        <br>
        Nama : <input type="text" name="nama" autocomplete="off" required>
        <br>
        Alamat : <input type="text" name="alamat" autocomplete="off" required>
        <br>
        <button type="submit">Simpan</button>
    </form>
    <br>
    <a href="index.php">Kembali</a>

</body>
</html>