<?php
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}
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
<style>
  h1 {
    text-align: center;
  }

  body {
    text-align: center;
  }
</style>

<body>
  <h1>Detail Mahasiswa</h1>
  <ul>
    <li><img src="img/<?= $mahasiswa['gambar']; ?>" alt=""></li>
    <li>NRP : <?= $mahasiswa['nrp']; ?></li>
    <li>NAMA : <?= $mahasiswa['nama']; ?></li>
    <li>Email : <?= $mahasiswa['email']; ?></li>
    <li>Jurusan: <?= $mahasiswa['jurusan']; ?></li>
    <li><a href="ubah.php?id=<?= $mahasiswa['id']; ?>">Ubah</a> | <a href="hapus.php?id=<?= $mahasiswa['id']; ?>" onclick="return confirm
    ('apakah anda yakin?');">Hapus</a></li>
    <li><a href="index.php">kembali Ke Index</a></li>
  </ul>
</body>

</html>