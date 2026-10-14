<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap');

    body {
        font-family: 'Outfit', sans-serif;
        background-color: #f8fafc;
        background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
        background-size: 20px 20px;
        min-height: 100vh;
        margin: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    h1 {
        color: #0f172a;
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 25px;
    }
    h1::before { content: '⚙️ '; }

    form {
        background: #ffffff;
        padding: 35px 40px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        width: 340px;
    }

    form br { display: none; }

    label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 8px;
        margin-top: 15px;
    }
    label:first-of-type { margin-top: 0; }

    input[type="text"],
    textarea {
        display: block;
        width: 100%;
        padding: 12px 16px;
        margin-bottom: 20px;
        background-color: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-sizing: border-box;
        font-family: 'Outfit', sans-serif;
        font-size: 14px;
        color: #0f172a;
        transition: 0.2s;
    }

    textarea {
        min-height: 90px;
        resize: vertical;
    }

    input[type="text"]:focus,
    textarea:focus {
        background-color: #ffffff;
        border-color: #f59e0b;
        outline: none;
        box-shadow: 0 0 0 4px #fef3c7;
    }

    /* Tombol Update (Pendek & Ke Tengah) */
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
        margin: 15px auto 0;
        width: fit-content;
        transition: 0.2s;
    }

    input[type="submit"]:hover { 
        background-color: #d97706; 
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(245, 158, 11, 0.2);
    }
</style>

<?php
include 'koneksi.php';

$nip = $_GET['nip'];

$query = mysqli_query($koneksi, "SELECT * FROM guru WHERE nip='$nip'");
$data = mysqli_fetch_array($query);
?>
<h1>EDIT DATA GURU</h1>
<form method="post" action="update.php">
    <label>Nip:</label>
    <input type="text" name="nip" value="<?php echo $data['nip']; ?>"><br><br>
    <label>Nama:</label>
    <input type="text" name="nama" value="<?php echo $data['nama']; ?>"><br><br>
    <label>Alamat:</label>
    <textarea name="alamat"><?php echo $data['alamat']; ?></textarea><br><br>
    <input type="submit" value="Update">
</form>