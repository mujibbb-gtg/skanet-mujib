<?php
include 'koneksi.php';
session_start();
if($_SESSION['status']<>"sukses"){
    header("location:../logout.php");
    exit; // Always add exit after a header redirect
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Guru</title>
    
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
            --bg-table: #ffffff;
            --bg-th: #f1f5f9;
            --bg-hover: #f8fafc;
            --border-color: #cbd5e1;
            --border-strong: #94a3b8;
            --btn-kembali-bg: #ffffff;
            --btn-kembali-text: #334155;
            --shadow: rgba(0,0,0,0.05);
        }

        html.dark-mode {
            --bg-html: #0f172a;
            --bg-dots: #334155;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --bg-table: #1e293b;
            --bg-th: #334155;
            --bg-hover: #0f172a;
            --border-color: #475569;
            --border-strong: #64748b;
            --btn-kembali-bg: #1e293b;
            --btn-kembali-text: #f1f5f9;
            --shadow: rgba(0,0,0,0.4);
        }

        /* === 2. PENERAPAN VARIABEL CSS === */
        html {
            background-color: var(--bg-html);
            background-image: radial-gradient(var(--bg-dots) 1px, transparent 1px);
            background-size: 20px 20px;
            min-height: 100vh;
            transition: background-color 0.3s, background-image 0.3s;
        }

        body {
            font-family: 'Outfit', sans-serif;
            margin: 0;
            padding: 50px 20px 100px 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 15px; 
        }

        h1 {
            color: var(--text-primary);
            font-size: 26px;
            font-weight: 700;
            margin: 0 0 10px 0;
            text-align: center;
        }
        h1::before { content: '🧑‍🏫 '; }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 4px 6px var(--shadow);
            transition: 0.2s;
            width: fit-content; 
        }

        .btn-tambah { 
            background-color: #3b82f6; /* Disamakan warna biru agar mencolok di dark/light mode */
            color: #ffffff; 
        }
        .btn-tambah::before { content: '➕'; font-size: 14px; }
        .btn-tambah:hover { background-color: #2563eb; transform: translateY(-2px); }

        .btn-kembali { 
            background-color: var(--btn-kembali-bg); 
            color: var(--btn-kembali-text); 
            border: 1px solid var(--border-color); 
            align-self: flex-end; 
            margin-top: 10px;
        }
        .btn-kembali::before { content: '🔙'; font-size: 14px; }
        .btn-kembali:hover { background-color: var(--bg-hover); transform: translateY(-2px); }

        table {
            width: 100%;
            background: var(--bg-table);
            border-collapse: collapse;
            border-radius: 12px;
            overflow: hidden; 
            box-shadow: 0 4px 6px -1px var(--shadow);
            border: 1px solid var(--border-strong) !important; 
        }

        table, th, td, tr { border-color: var(--border-color) !important; }

        th, td {
            padding: 16px 20px;
            text-align: left;
            border: 1px solid var(--border-color) !important; 
            font-size: 14px;
            color: var(--text-secondary);
        }

        th {
            background-color: var(--bg-th);
            color: var(--text-primary);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--border-strong) !important; 
        }

        tr:not(:first-child):hover td { background-color: var(--bg-hover); }

        .action-btn {
            display: inline-flex; align-items: center; gap: 5px;
            text-decoration: none; padding: 6px 15px; border-radius: 50px;
            font-size: 12px; font-weight: 600; margin-right: 8px; transition: 0.2s;
        }

        .btn-edit { background: #fef3c7; color: #d97706; }
        .btn-edit::before { content: '✏️'; }
        .btn-edit:hover { background: #fde68a; transform: translateY(-1px); }

        .btn-hapus { background: #ffe4e6; color: #e11d48; }
        .btn-hapus::before { content: '🗑️'; }
        .btn-hapus:hover { background: #fecdd3; transform: translateY(-1px); }
        
        /* SweetAlert Customizations & Dark Mode */
        div:where(.swal2-container) { font-family: 'Outfit', sans-serif !important; }
        .swal2-popup { border-radius: 16px !important; }
        html.dark-mode div:where(.swal2-container) .swal2-popup { background-color: var(--bg-table); color: var(--text-primary); }
        html.dark-mode .swal2-title, html.dark-mode .swal2-html-container { color: var(--text-primary) !important; }
    </style>
</head>
<body>

<div class="container">
    <h1>DATA GURU</h1>
    
    <a href="tambah.php" class="btn btn-tambah">Tambah Data</a>
    
    <table>
        <tr>
            <th>Nip</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM guru");
        while($data = mysqli_fetch_array($query)){
        ?>
        <tr>
            <td><?php echo htmlspecialchars($data['nip']); ?></td>
            <td><?php echo htmlspecialchars($data['nama']); ?></td>
            <td><?php echo htmlspecialchars($data['alamat']); ?></td>
            <td>
                <a href="hapus.php?nip=<?php echo $data['nip']; ?>" class="action-btn btn-hapus">Hapus</a>
                <a href="edit.php?nip=<?php echo $data['nip']; ?>" class="action-btn btn-edit">Edit</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <a href="../index.php" class="btn btn-kembali">Kembali ke Menu</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tombolHapus = document.querySelectorAll('.btn-hapus');
        
        tombolHapus.forEach(tombol => {
            tombol.addEventListener('click', function(e) {
                e.preventDefault(); 
                const linkTujuan = this.getAttribute('href'); 
                
                /* === 3. CEK TEMA UNTUK SWEETALERT === */
                const isDark = localStorage.getItem('theme') === 'dark';
                
                Swal.fire({
                    title: 'Hapus Data Ini?',
                    text: "Data yang dihapus tidak akan bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444', 
                    cancelButtonColor: isDark ? '#475569' : '#94a3b8',  
                    confirmButtonText: '🗑️ Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    background: isDark ? '#1e293b' : '#ffffff',
                    color: isDark ? '#f1f5f9' : '#545454'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = linkTujuan;
                    }
                });
            });
        });
    });
</script>

</body>
</html>