<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "DELETE FROM mapel WHERE id='$id'");
header("location:index.php");

?>