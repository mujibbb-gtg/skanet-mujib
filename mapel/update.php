<?php
include 'koneksi.php';

$id = $_POST['id'];
$id_mapel = $_POST['id_mapel'];
$mapel = $_POST['mapel'];

$query = mysqli_query($koneksi, "UPDATE mapel SET id_mapel='$id_mapel', mapel='$mapel' WHERE id='$id'");
header("location:index.php");

if($query){
    echo "Data berhasil diupdate";
    echo "<a href='index.php'>Lihat Data</a>";
} else {
    echo "Data gagal diupdate";
}
?>