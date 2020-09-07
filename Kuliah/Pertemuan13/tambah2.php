<?php
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}
require 'functions.php';

//seleksi apakah halaman sebelumnya mengirimkan url id atau tidak
if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}
//ambil id dari URL
$id = $_GET['id'];

//query mahasiswa berdasarkan id
$mahasiswa = query("SELECT * FROM mahasiswa WHERE id = $id");
//var_dump($mahasiswa['nama'])

if (isset($_POST['ubah'])) {
  //isset menyeleksi 
  # code...
  //var_dump($_POST);
  //tambah($_POST)
  if (ubah($_POST) > 0) {
    echo "<script>
            alert('data berhasil diubah');
            document.location.href = 'index.php';
          </script>";
  } else {
    echo "data gagal di Ubah!";
  }
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

  <title>Ubah Data Mahasiswa</title>
  <style>
    .form-row {

      position: relative;
      left: 500px;
    }

    .form-group {
      position: relative;
      left: 500px;

    }
  </style>
</head>

<body>
  <div>
    <a class="btn btn-primary btn-lg" href="detail.php?id=<?= $mahasiswa['id']; ?>" role="button" style="position: relative; left: 20px; top: 20px;">Kembali</a>
  </div>
  <br><br>


  <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $mahasiswa['id']; ?>">
    <div class=" form-row">
      <div class="col-md-4 mb-3">
        <label for="validationCustom01">Nama</label>
        <input type="text" class="form-control" id="validationCustom01" placeholder="Nama" value="<?= $mahasiswa['nama']; ?>" name="nama" autofocus>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-4 mb-3">
        <label for="validationCustom02">NRP</label>
        <input type="text" class="form-control" id="validationCustom02" placeholder="NRP" value="<?= $mahasiswa['nrp']; ?>" required name="nrp">
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-4 mb-3">
        <label for="validationCustom02">Email</label>
        <input type="text" class="form-control" id="validationCustom02" placeholder="email" value="<?= $mahasiswa['email']; ?>" required name="email">
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-4 mb-3">
        <label for="validationCustom02">Jurusan</label>
        <input type="text" class="form-control" id="validationCustom02" placeholder="Jurusan" value="<?= $mahasiswa['jurusan']; ?>" required name="jurusan">
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
    </div>
    <div class="form-row">
      <input type="hidden" name="gambar_lama" value="<?= $mahasiswa['gambar']; ?>">
      <label>
        Gambar
        <input type="file" name="gambar" class="gambar" onchange="previewImage()">
      </label>
      <img src="img/<?= $mahasiswa['gambar']; ?>" width="120" style="display: block;" class="img-preview">
    </div>

    <div class="form-group">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">
          Ceklis Untuk Menyetujui
        </label>
        <div class="invalid-feedback">
          You must agree before submitting.
        </div>
      </div>
    </div>
    <button class="btn btn-primary" type="submit" style="position: relative;
      left: 500px;" name="ubah">Ubah Data</button>
    <br><br><br><br><br>
  </form>

  <script src="js/script.js"></script>
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>