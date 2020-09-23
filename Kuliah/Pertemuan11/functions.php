<?php

function koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'pw_043040023');
}

function query($query)
{
  $conn = koneksi();
  $result = mysqli_query($conn, $query);

  //jika hasilnya hanya 1 data tidak usah di masukan dalam array
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }


  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}


function tambah($data)
{
  $conn = koneksi();

  $nama = htmlspecialchars($data['nama']);
  $nrp = htmlspecialchars($data['nrp']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar = htmlspecialchars($data['gambar']);

  $query = "INSERT INTO mahasiswa VALUES (null, '$nama', '$nrp', '$email', '$jurusan', '$gambar')";
  mysqli_query($conn, $query);
  echo mysqli_error($conn); // pesan error
  return mysqli_affected_rows($conn); // melihat apakah adayang berubah jika tidak ada 0 jika error -1 jika ada berubah >0
}

function hapus($id)
{
  $conn = koneksi();
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
  $gambar = htmlspecialchars($data['gambar']);

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
