<?php
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}


require 'functions.php';

$mahasiswa = query("SELECT * FROM mahasiswa");

//Ketika tombol cari di klik

if (isset($_POST['cari'])) {
  $mahasiswa = cari($_POST['katakunci']);
}

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
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <!-- Button trigger modal -->
  <div class="logut" style="display: block; margin-bottom: 20px; height: 100px;">
    <a class="btn btn-primary btn-lg" href="tambah.php" role="button" style="float: right; position: relative; padding: 20px; margin: 20px; display: block;">Tambah Data</a>
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal" style="float: right; position: relative; padding: 20px; margin: 20px; display: block;">
      Logout
    </button>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="position:absolute;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Anda Yakin Ingin Logout ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="window.location.href='logout.php'">Logout</button>
        </div>
      </div>
    </div>
  </div>

  <div class="alert alert-success" role="alert" style="width: 60%;   position:relative;
  margin-left:auto;
  margin-right:auto;
  margin-top:auto;
  margin-bottom:auto;
  left:0;
  right:0;
  top:0;
  bottom:0;">
    <h4 class="alert-heading" style="text-align: center;">Data Mahasiswa!</h4>
    <hr>
    <p style="text-align: center;">Welcome To Data Mahasiswa Fakultas Informatika Universitas Mulawarman</p>
  </div>
  <br><br>

  <div class="container">
    <table class="table table-bordered table-striped" style="position: relative;  width: 60%;   position:relative;
  margin-left:auto;
  margin-right:auto;
  margin-top:auto;
  margin-bottom:auto;
  left:0;
  right:0;
  top:0;
  bottom:0;">
      <thead>
        <tr>
          <th>#</th>
          <th>Gambar</th>
          <th>Nama</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        foreach ($mahasiswa as $m) : ?>
          <tr>
            <td><?= $i++; ?></td>
            <td><img src="img/<?= $m['gambar']; ?>" width="60"></td>
            <td><?= $m['nama']; ?></td>
            <td>
              <a href="detail.php?id=<?= $m['id']; ?>">Lihat Detail</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>