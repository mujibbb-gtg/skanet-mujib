<?php
include "koneksi.php";
$id=$_POST["id"];
$id_mapel=$_POST["id_mapel"];
$mapel=$_POST["mapel"];
$query = mysqli_query($koneksi, "INSERT INTO mapel(id, id_mapel, mapel) VALUES('$id', '$id_mapel', '$mapel')");
header("location:index.php");
?>