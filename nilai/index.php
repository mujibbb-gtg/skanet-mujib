<?php
include "../koneksi.php";
session_start();
if($_SESSION['status'] <> "sukses"){
    header('location:../logout.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai Siswa</title>
    
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
            --search-bg: #ffffff;
            --search-border: #e2e8f0;
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
            --search-bg: #1e293b;
            --search-border: #475569;
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
            max-width: 1000px;
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
        h1::before { content: '📊 '; }

        .top-actions {
            display: flex;
            gap: 12px;
            align-items: center; 
        }

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
            height: 40px; 
            box-sizing: border-box;
        }

        .btn-tambah { background-color: #3b82f6; color: #ffffff; }
        .btn-tambah::before { content: '➕'; font-size: 14px; }
        .btn-tambah:hover { background-color: #2563eb; color: #ffffff; transform: translateY(-2px); }

        .btn-export { background-color: #10b981; color: #ffffff; }
        .btn-export::before { content: '📗'; font-size: 14px; }
        .btn-export:hover { background-color: #059669; color: #ffffff; transform: translateY(-2px); }

        /* === CSS ANIMASI SEARCH BAR === */
        form.search-form { margin: 0; margin-left: auto; }

        .search-bar {
            position: relative;
            width: 42px; 
            height: 40px;
            background: var(--search-bg);
            border: 1px solid var(--search-border);
            border-radius: 50px;
            display: flex;
            align-items: center;
            transition: width 0.7s cubic-bezier(0.8, -0.4, 0.2, 1.4), border-color 0.3s, background-color 0.3s;
            cursor: pointer;
            z-index: 10;
            padding: 0 12px;
            box-sizing: border-box;
            overflow: hidden;
            box-shadow: 0 4px 6px var(--shadow);
        }

        .search-bar:hover, .search-bar:focus-within {
            width: 250px;
            border-color: var(--border-strong);
            cursor: text;
        }

        .search-bar span { font-size: 14px; flex-shrink: 0; }

        .search-bar input {
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
            height: 100%;
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            color: var(--text-primary);
            margin-left: 8px;
            opacity: 0;
            transition: opacity 0.5s;
        }

        .search-bar:hover input, .search-bar:focus-within input { opacity: 1; }

        /* ================================== */

        .btn-kembali { 
            background-color: var(--btn-kembali-bg); color: var(--btn-kembali-text); border: 1px solid var(--border-color); 
            align-self: flex-end; margin-top: 10px; height: 40px; box-sizing: border-box;
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

        td { color: var(--text-secondary); }
        tr:not(:first-child):hover td { background-color: var(--bg-hover); }

        .action-btn {
            display: inline-flex; align-items: center; gap: 5px; text-decoration: none;
            padding: 6px 15px; border-radius: 50px; font-size: 12px; font-weight: 600;
            margin-right: 5px; transition: 0.2s;
        }

        .btn-edit { background: #fef3c7; color: #d97706; }
        .btn-edit::before { content: '✏️'; }
        .btn-edit:hover { background: #fde68a; color: #d97706; transform: translateY(-1px); }

        .btn-hapus { background: #ffe4e6; color: #e11d48; }
        .btn-hapus::before { content: '🗑️'; }
        .btn-hapus:hover { background: #fecdd3; color: #e11d48; transform: translateY(-1px); }

        .btn-cetak { background: #e0f2fe; color: #0284c7; cursor: pointer; border: none; font-family: inherit; }
        .btn-cetak::before { content: '🖨️'; }
        .btn-cetak:hover { background: #bae6fd; color: #0284c7; transform: translateY(-1px); }
        
        /* Dark mode overrides for print button */
        html.dark-mode .btn-cetak { background: #0c4a6e; color: #bae6fd; }
        html.dark-mode .btn-cetak:hover { background: #075985; }

        /* SweetAlert Styling & Dark Mode */
        div:where(.swal2-container) { font-family: 'Outfit', sans-serif !important; }
        .swal2-popup { border-radius: 16px !important; }
        html.dark-mode div:where(.swal2-container) .swal2-popup { background-color: var(--bg-table); color: var(--text-primary); }
        html.dark-mode .swal2-title, html.dark-mode .swal2-html-container { color: var(--text-primary) !important; }
    </style>
</head>
<body>

<div class="container">
    <h1>Data Nilai Siswa</h1>

    <div class="top-actions">
        <a href="tambah.php" class="btn btn-tambah">Tambah Nilai</a> 
        <a href="export.php" target="_blank" class="btn btn-export">Export</a>
        
        <form action="" method="GET" class="search-form">
            <div class="search-bar">
                <span>🔍</span>
                <input type="text" name="cari" placeholder="Cari siswa, mapel..." value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>" autocomplete="off">
            </div>
        </form>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Mata Pelajaran</th>
            <th>Guru Pengajar</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
        <?php
        $cari = isset($_GET['cari']) ? $_GET['cari'] : '';
        
        $sql = "SELECT nilai.*, siswa.nama AS nama_siswa, mapel.mapel AS nama_mapel, guru.nama AS nama_guru 
                FROM nilai 
                JOIN siswa ON nilai.nis = siswa.nis 
                JOIN mapel ON nilai.id_mapel = mapel.id_mapel
                JOIN guru ON nilai.nip = guru.nip";
        
        if($cari != '') {
            $sql .= " WHERE siswa.nama LIKE '%$cari%' 
                      OR mapel.mapel LIKE '%$cari%' 
                      OR guru.nama LIKE '%$cari%'";
        }

        $query = mysqli_query($koneksi, $sql);
        $no = 1;

        if(mysqli_num_rows($query) > 0) {
            while($data = mysqli_fetch_array($query)){
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($data['nama_siswa']); ?></td>
            <td><?php echo htmlspecialchars($data['nama_mapel']); ?></td>
            <td><?php echo htmlspecialchars($data['nama_guru']); ?></td>
            <td><?php echo htmlspecialchars($data['nilai']); ?></td>
            <td>
                <a href="hapus.php?id_nilai=<?php echo $data['id_nilai']; ?>" class="action-btn btn-hapus">Hapus</a>
                <a href="edit.php?id_nilai=<?php echo $data['id_nilai']; ?>" class="action-btn btn-edit">Edit</a> 
                <button class="action-btn btn-cetak" onclick="cetakBaris(this)">Cetak</button>
            </td>
        </tr>
        <?php 
            } // penutup while
        } else { 
        ?>
        <tr>
            <td colspan="6" style="text-align: center; color: #ef4444; font-weight: 600; padding: 30px;">
                🔍 Yah, data yang Anda cari tidak ditemukan...
            </td>
        </tr>
        <?php } ?>
    </table>

    <a href="../index.php" class="btn btn-kembali">Kembali ke Menu</a>
</div>

<!-- SCRIPT CETAK PER DATA (Sengaja format warna terang) -->
<script>
    function cetakBaris(tombol) {
        const baris = tombol.closest('tr');
        const kolom = baris.querySelectorAll('td');

        const no = kolom[0].innerText;
        const nama = kolom[1].innerText;
        const mapel = kolom[2].innerText;
        const guru = kolom[3].innerText;
        const nilai = kolom[4].innerText;

        const jendelaCetak = window.open('', '_blank', 'width=800,height=600');
        
        const desainCetak = `
            <!DOCTYPE html>
            <html>
            <head>
                <title>Cetak Nilai - ${nama}</title>
                <style>
                    body { font-family: 'Arial', sans-serif; padding: 40px; color: #333; background: #fff; }
                    .header { text-align: center; border-bottom: 2px solid #0f172a; padding-bottom: 15px; margin-bottom: 30px; }
                    .header h2 { margin: 0; font-size: 26px; color: #0f172a; text-transform: uppercase;}
                    .header p { margin: 5px 0 0 0; color: #64748b; font-size: 14px; }
                    .content { max-width: 600px; margin: 0 auto; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    th, td { padding: 14px; border: 1px solid #cbd5e1; text-align: left; font-size: 16px; color: #333; }
                    th { background-color: #f8fafc; width: 40%; color: #334155; font-weight: bold; }
                    .nilai-box { font-size: 20px; font-weight: bold; color: #0f172a; }
                </style>
            </head>
            <body>
                <div class="header">
                    <h2>Laporan Nilai Siswa</h2>
                    <p>Dokumen Resmi Hasil Evaluasi Pembelajaran</p>
                </div>
                <div class="content">
                    <table>
                        <tr><th>Nomor Urut</th><td>${no}</td></tr>
                        <tr><th>Nama Lengkap Siswa</th><td>${nama}</td></tr>
                        <tr><th>Mata Pelajaran</th><td>${mapel}</td></tr>
                        <tr><th>Guru Pengajar</th><td>${guru}</td></tr>
                        <tr><th>Nilai Akhir</th><td class="nilai-box">${nilai}</td></tr>
                    </table>
                </div>
                <script>
                    window.onload = function() { 
                        window.print(); 
                        window.onafterprint = function() { window.close(); }
                    }
                <\/script>
            </body>
            </html>
        `;

        jendelaCetak.document.write(desainCetak);
        jendelaCetak.document.close();
    }
</script>

<!-- SWEETALERT2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tombolHapus = document.querySelectorAll('.btn-hapus'); 
        
        tombolHapus.forEach(tombol => {
            tombol.addEventListener('click', function(e) {
                e.preventDefault();
                const linkTujuan = this.getAttribute('href');
                
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