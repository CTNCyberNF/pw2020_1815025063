<?php
require 'functions.php';

//ambil id dari URL
$id = $_GET['id'];

//query mahasiswa berdasarkan id
$mahasiswa = query("SELECT * FROM mahasiswa WHERE id = $id");
//var_dump($mahasiswa['nama'])
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Mahasiswa</title>
</head>

<body>
  <h3>Detail Mahasiswa</h3>
  <ul>
    <li><img src="img/<?= $mahasiswa['gambar']; ?>" alt=""></li>
    <li>NRP : <?= $mahasiswa['nrp']; ?></li>
    <li>NAMA : <?= $mahasiswa['nama']; ?></li>
    <li>Email : <?= $mahasiswa['email']; ?></li>
    <li>Jurusan: <?= $mahasiswa['jurusan']; ?></li>
    <li><a href="">Ubah</a> | <a href="">Hapus</a></li>
    <li><a href="latihan3.php">kembali Ke Latihan3</a></li>
  </ul>
</body>

</html>