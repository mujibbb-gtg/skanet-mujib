<?php
include 'koneksi.php';

$nis = $_GET['nis'];

$query = mysqli_query($koneksi, "DELETE FROM siswa WHERE nis='$nis'");
header("location:index.php");

?>