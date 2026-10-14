<?php
header("Content-type: application/vnd-ms-excel");
// ...
header("Content-Disposition: attachment; filename=Data_Nilai_Siswa.xls");

// Hubungkan ke database (Perhatikan letak koneksi.php Anda ada di luar folder nilai)
include "../koneksi.php";
?>

<!-- Kita buat tabel sederhana tanpa CSS, karena Excel hanya membaca struktur tabelnya saja -->
<table border="1">
    <tr>
        <th>No</th>
        <th>Nama Siswa</th>
        <th>Mata Pelajaran</th>
        <th>Guru Pengajar</th>
        <th>Nilai</th>
    </tr>
    <?php
    // Query ini sama persis dengan yang ada di halaman utama Data Nilai Anda
    $query = mysqli_query($koneksi, "SELECT nilai.*, siswa.nama AS nama_siswa, mapel.mapel AS nama_mapel, guru.nama AS nama_guru 
                                     FROM nilai 
                                     JOIN siswa ON nilai.nis = siswa.nis 
                                     JOIN mapel ON nilai.id_mapel = mapel.id_mapel
                                     JOIN guru ON nilai.nip = guru.nip");
    $no = 1;
    while($data = mysqli_fetch_array($query)){
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $data['nama_siswa']; ?></td>
        <td><?php echo $data['nama_mapel']; ?></td>
        <td><?php echo $data['nama_guru']; ?></td>
        <td><?php echo $data['nilai']; ?></td>
    </tr>
    <?php } ?>
</table>