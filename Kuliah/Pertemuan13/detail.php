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
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>
  <div>
    <a class="btn btn-primary btn-lg" href="index.php" role="button" style="position: relative; left: 20px; top: 20px;">Kembali</a>
    <a class="btn btn-warning btn-lg" href="ubah.php?id=<?= $mahasiswa['id']; ?>" role="button" style="position: relative; left: 20px; top: 20px; margin-left: 1000px;">Ubah</a>
    <a class="btn btn-danger btn-lg" href="hapus.php?id=<?= $mahasiswa['id']; ?>" role="button" style="position: relative; left: 20px; top: 20px;" onclick="return confirm
    ('Apakah Anda Yakin Ingin Menghapus?');">Hapus</a>
  </div>
  <br><br>
  <div style="text-align: center;">
    <h3 style="text-align: center;">
      Detail
      <small class="text-muted">Mahasiswa</small>
    </h3>
    <ul>
      <img src="img/<?= $mahasiswa['gambar']; ?>" width="250">
    </ul>
    <ul>
      NRP : <?= $mahasiswa['nrp']; ?>
    </ul>
    <ul>
      NAMA : <?= $mahasiswa['nama']; ?>
    </ul>
    <ul>Email : <?= $mahasiswa['email']; ?></ul>
    <ul>Jurusan: <?= $mahasiswa['jurusan']; ?></ul>


  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>