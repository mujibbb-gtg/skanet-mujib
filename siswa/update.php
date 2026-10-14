<?php
include 'koneksi.php';

$nis = $_POST['nis'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];

$query = mysqli_query($koneksi, "UPDATE siswa SET nama='$nama', alamat='$alamat' WHERE nis='$nis'");
header("location:index.php");

?>