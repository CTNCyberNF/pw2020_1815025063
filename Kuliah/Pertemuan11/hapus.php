<?php
require 'functions.php';


//seleksi apakah halaman sebelumnya mengirimkan url id atau tidak
if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}

//mengambil id dari url
$id = $_GET['id'];

if (hapus($id) > 0) {
  echo "<script>
          alert('data berhasil dihapus');
          document.location.href = 'index.php';
        </script>";
} else {
  echo "data gagal di tambahakan!";
}
var_dump("ayam");
