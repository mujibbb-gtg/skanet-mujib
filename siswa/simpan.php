<?php
include "koneksi.php";
$nis=$_POST["nis"];
$nama=$_POST["nama"];
$alamat=$_POST["alamat"];
$query = mysqli_query($koneksi, "INSERT INTO siswa(nis, nama, alamat) VALUES('$nis', '$nama', '$alamat')");
header("location:index.php");
?>