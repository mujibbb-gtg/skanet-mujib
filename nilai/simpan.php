<?php 
include "../koneksi.php";

$nis = $_POST['nis'];
$id_mapel = $_POST['id_mapel'];
$nip = $_POST['nip']; // Menangkap data nip guru dari form
$nilai = $_POST['nilai'];

// Memasukkan 4 data sekaligus ke dalam tabel nilai
mysqli_query($koneksi, "insert into nilai(nis, id_mapel, nip, nilai) values('$nis', '$id_mapel', '$nip', '$nilai')");

header('location:index.php');
?>