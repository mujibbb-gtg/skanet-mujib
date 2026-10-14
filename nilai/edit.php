<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap');

    body {
        font-family: 'Outfit', sans-serif;
        background-color: #f8fafc;
        background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
        background-size: 20px 20px;
        min-height: 100vh;
        margin: 0;
        padding: 40px 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    /* Menyisipkan Emoji di Judul */
    h1 {
        color: #0f172a;
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 20px;
        letter-spacing: -0.5px;
        text-align: center;
    }
    h1::before { content: '⚙️ '; }

    /* Sembunyikan <br> bawaan HTML agar jarak diatur sepenuhnya oleh CSS */
    form br { display: none; }

    /* Desain Container Form */
    form {
        background: #ffffff;
        padding: 35px 40px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        width: 380px;
    }

    /* Styling Label */
    label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 6px;
        margin-top: 15px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    label:first-of-type { margin-top: 0; }

    /* Styling Kolom Input (Text & Number) */
    input[type="text"],
    input[type="number"] {
        display: block;
        width: 100%;
        padding: 12px 16px;
        margin-bottom: 5px;
        background-color: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-sizing: border-box;
        font-family: 'Outfit', sans-serif;
        font-size: 14px;
        color: #0f172a;
        transition: 0.2s;
    }

    input[type="text"]:focus,
    input[type="number"]:focus {
        background-color: #ffffff;
        border-color: #f59e0b; /* Warna amber/orange khas mode edit */
        outline: none;
        box-shadow: 0 0 0 4px #fef3c7;
    }

    /* Tombol Update (Berbentuk Pil, ke Tengah, Aksen Amber) */
    input[type="submit"] {
        display: block;
        background-color: #f59e0b;
        color: #ffffff;
        padding: 12px 35px;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        font-size: 15px;
        font-weight: 600;
        font-family: 'Outfit', sans-serif;
        margin: 20px auto 0;
        width: fit-content;
        transition: 0.2s;
        box-shadow: 0 4px 6px rgba(245, 158, 11, 0.2);
    }

    input[type="submit"]:hover { 
        background-color: #d97706; 
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(245, 158, 11, 0.3);
    }
</style>

<?php
include 'koneksi.php';

$id_nilai = $_GET['id_nilai'];

$query = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_nilai='$id_nilai'");
$data = mysqli_fetch_array($query);
?>
<h1>EDIT DATA NILAI </h1>
<form method="post" action="update.php">
    <label>Id Nilai:</label>
    <input type="text" name="id_nilai" value="<?php echo $data['id_nilai']; ?>"><br><br>
    <label>NIS:</label>
    <input type="text" name="nis" value="<?php echo $data['nis']; ?>"><br><br>
    <label>Id Mapel:</label>
    <input type="text" name="id_mapel" value="<?php echo $data['id_mapel']; ?>"><br><br>
    <label>NIP:</label>
    <input type="text" name="nip" value="<?php echo $data['nip']; ?>"><br><br>
    <label>Nilai:</label>
    <input type="number" name="nilai" value="<?php echo $data['nilai']; ?>"><br><br>
    <input type="submit" value="Update">
</form>