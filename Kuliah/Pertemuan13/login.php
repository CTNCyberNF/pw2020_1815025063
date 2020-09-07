<?php
session_start();

if (isset($_SESSION['login'])) {
  header("Location: index.php");
  exit;
}

require 'functions.php';

//ketika tombol login di tekan
if (isset($_POST['login'])) {
  $login = login($_POST);
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

  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <br><br><br><br>
  <h3 style="text-align: center;">
    LOGIN
    <br>
    <small class="text-muted">Bangku Kuliah</small>
  </h3>

  <div class="tengah" style=" width:26%; height:320px; border:2px solid black;color:black;">
    <div class="container">
      <br>
      <form action="" method="POST">
        <div class="form-group">
          <label for="exampleInputEmail1">Username</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="username" autofocus autocomplete="off" required aria-describedby="emailHelp" placeholder="Enter username">
          <small id="emailHelp" class="form-text text-muted">We'll never share your username with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password" required placeholder="Password">
        </div>
        <div style="position: absolute; ">
          <?php if (isset($login['error'])) : ?>
            <p style="color: red; font-style: italic;"><?= $login['pesan']; ?></p>
          <?php endif; ?>
        </div>
        <br>
        <button type="sub" class="btn btn-primary btn-lg btn-block" name="login">LOGIN</button>
      </form>
    </div>
  </div>
  <br><br><br><br>
  <div class="card text-white bg-primary mb-3" style="max-width: 18rem; margin-left: 20px;">
    <div class="card-header">Attention !!</div>
    <div class="card-body">
      <h5 class="card-title">Developer Newbie</h5>
      <p class="card-text">Don't bother me a new player</p>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>