<?php
include "koneksi.php";
$nip=$_POST["nip"];
$nama=$_POST["nama"];
$alamat=$_POST["alamat"];
$query = mysqli_query($koneksi, "INSERT INTO guru(nip, nama, alamat) VALUES('$nip', '$nama', '$alamat')");
header("location:index.php");
?>