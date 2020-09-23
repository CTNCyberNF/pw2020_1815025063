<?php
// Koneksi database dan pilih database
$conn = mysqli_connect('localhost', 'root', '', 'pw_043040023');


// Query isi table mahasiswa
$result = mysqli_query($conn, "SELECT * FROM mahasiswa");
//var_dump($row) //melihat isi dari variable di sini nilai nya masih berupa objeck

// Ubah data ke dalam array
//$row = mysqli_fetch_row($result); //array numerick yang tiap key nya angka
//$row = mysqli_fetch_assoc($result); // array assosiarif yang tiap key nya mengambil dari nama aslinya atribut
//$row = mysqli_fetch_array($result); // Keduanya
//var_dump($row); //melihat isi dari variable


$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
  $rows[] = $row;
}

//var_dump($rows)
//tampung ke variabel mahasiswa
$mahasiswa = $rows;
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Mahasiswa</title>
</head>

<body>
  <h3>Daftar Mahasiswa</h3>

  <table border="1" cellpadding="10" cellspacing=0>
    <tr>
      <th>#</th>
      <th>Gambar</th>
      <th>NRP</th>
      <th>Nama</th>
      <th>Email</th>
      <th>Jurusan</th>
      <th>Aksi</th>
    </tr>

    <?php
    $i = 1;
    foreach ($mahasiswa as $m) : ?>
      <tr>
        <td><?= $i++; ?></td>
        <td><img src="img/<?= $m['gambar']; ?>" width="60"></td>
        <td><?= $m['nrp']; ?></td>
        <td><?= $m['nama']; ?></td>
        <td><?= $m['email']; ?></td>
        <td><?= $m['jurusan']; ?></td>
        <td>
          <a href="">ubah</a> | <a href="">hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>