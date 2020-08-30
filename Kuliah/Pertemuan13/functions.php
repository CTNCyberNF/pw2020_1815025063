<?php

function koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'pw_043040023');
}

function query($query)
{
  $conn = koneksi();
  $result = mysqli_query($conn, $query);

  //jika hasilnya hanya 1 data
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }


  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function upload()
{
  $nama_file = $_FILES['gambar']['name'];
  $tipe_file = $_FILES['gambar']['type'];
  $ukuran_file = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmp_file = $_FILES['gambar']['tmp_name'];


  //ketika tidak ada gambar yang di piilih
  if ($error == 4) {
    // echo "<script>
    //         alert('pilih gambar terlebih dahulu!');
    //       </script>";
    // return false;
    return 'nophoto.jpg';
  }


  // cek ekstensi file
  $daftar_gamabar = ['jpg', 'jpeg', 'png'];
  $exstensi_file = explode('.', $nama_file);
  $exstensi_file = strtolower(end($exstensi_file));
  var_dump($exstensi_file);
  if (!in_array($exstensi_file, $daftar_gamabar)) {
    echo "<script>
            alert('Yang Anda Pilih Bukan Gambar !');
          </script>";
    return false;
  }

  //cek tipe file
  if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
    echo "<script>
            alert('pilih gambar terlebih dahulu!');
          </script>";
    return false;
  }


  //cek ukuran file
  // maksimal 5Mb ==> 5000000 byte
  if ($ukuran_file > 5000000) {
    echo "<script>
    alert('Ukuran Terlalu Besar!');
  </script>";
    return false;
  }


  // lolos pengecekan 
  //siap upload file
  // generate nama file baru
  $nama_file_baru = uniqid();
  $nama_file_baru .= '.';
  $nama_file_baru .= $exstensi_file;
  move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);

  return $nama_file_baru;
}


function tambah($data)
{
  $conn = koneksi();

  $nama = htmlspecialchars($data['nama']);
  $nrp = htmlspecialchars($data['nrp']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  // $gambar = htmlspecialchars($data['gambar']);

  // upload gambar
  $gambar = upload();

  if (!$gambar) {
    return false;
  }

  $query = "INSERT INTO mahasiswa VALUES (null, '$nama', '$nrp', '$email', '$jurusan', '$gambar')";
  mysqli_query($conn, $query);
  echo mysqli_error($conn); // pesan error
  return mysqli_affected_rows($conn); // melihat apakah adayang berubah jika tidak ada 0 jika error -1 jika ada berubah >0
}

function hapus($id)
{
  $conn = koneksi();

  // menghapus gambar di folder image
  $mhs = query("SELECT * FROM mahasiswa WHERE id = $id");
  if ($mhs['gambar'] != 'nophoto.jpg') {
    unlink('img/' . $mhs['gambar']);
  }


  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id= '$id'") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function ubah($data)
{
  $conn = koneksi();

  $id = htmlspecialchars($data['id']);
  $nama = htmlspecialchars($data['nama']);
  $nrp = htmlspecialchars($data['nrp']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar_lama = htmlspecialchars($data['gambar_lama']);

  $gambar = upload();
  if (!$gambar) {
    return false;
  }

  if ($gambar == 'nophoto.jpg') {
    $gambar = $gambar_lama;
  }

  mysqli_query($conn, "UPDATE mahasiswa SET nama = '$nama', nrp = '$nrp', email ='$email', jurusan = '$jurusan', gambar='$gambar' WHERE id= '$id'") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function cari($nama)
{
  $conn = koneksi();

  $result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nama LIKE '%$nama%' OR nrp LIKE '%$nama%'");

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function login($data)
{
  $conn = koneksi();

  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);

  //cek username
  if ($user = query("SELECT * FROM user WHERE username = '$username' ")) {
    //cek password
    if (password_verify($password, $user['password'])) {
      //set Session
      $_SESSION['login'] = true;

      header("Location: index.php");
      exit;
    }
  }
  return [
    'error' => true,
    'pesan' => 'Username / Password Salah!'
  ];
}

function registrasi($data)
{
  $conn = koneksi();

  $username = htmlspecialchars(strtolower($data['username']));
  $password1 = mysqli_real_escape_string($conn, $data['password1']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);

  // jika username atau password kosong
  if (empty($username) || empty($password1) || empty($password2)) {
    echo "<script>
          alert('username / password tidak boleh kosong !');
          document.location.href = 'registrasi.php';
          </script>";
    return false;
  }

  //jika username sudah ada
  if (query("SELECT * FROM user WHERE username = '$username'")) {
    # code...
    echo "<script>
    alert('username Sudah Terdaftar !');
    document.location.href = 'registrasi.php';
    </script>";
    return false;
  }

  //jika konfirmasi tidak sesuai
  if ($password1 !== $password2) {
    # code...
    echo "<script>
    alert('Konfirmasi Password Tidak Sesuai !');
    document.location.href = 'registrasi.php';
    </script>";
    return false;
  }

  //jika passsword lebih kecil dari lima digit
  if (strlen($password1) < 5) {
    # code...
    echo "<script>
    alert('Password Terlalu Pendek !');
    document.location.href = 'registrasi.php';
    </script>";
    return false;
  }

  //jika username dan password sudah sesuai
  // enksripsi
  $password_baru = password_hash($password1, PASSWORD_DEFAULT);
  //insert ke tabel user
  $query = "INSERT INTO user VALUES (null, '$username', '$password_baru')";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
