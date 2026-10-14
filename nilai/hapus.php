<?php
include 'koneksi.php';

$id_nilai = $_GET['id_nilai'];

$query = mysqli_query($koneksi, "DELETE FROM nilai WHERE id_nilai='$id_nilai'");
header("location:index.php");

?>