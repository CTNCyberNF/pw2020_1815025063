const tombolCari = document.querySelector('.tombol-cari');
const keyword = document.querySelector('.keyword');
const container = document.querySelector('.container');


// hilangkan tombol cari
tombolCari.style.display = 'none';

//even ketika kita menulis keyword
keyword.addEventListener('keyup', function () {
  //console.log('OK!');


  //ajax dua cara
  // metode xmlhttprequest
  // const xhr = new XMLHttpRequest();


  // xhr.onreadystatechange = function () {
  //   if (xhr.readyState == 4 && xhr.status == 200) { // 4 artinya sumber dari alamat ajak sudah siap
  //     // 200 alamat dari tujuanya oke
  //     //console.log(xhr.responseText);
  //     container.innerHTML = xhr.responseText;
  //   }
  // };

  // xhr.open('get', 'ajax/ajax_cari.php?keyword=' + keyword.value);
  // xhr.send();


  //metode fetch()
  fetch('ajax/ajax_cari.php?keyword=' + keyword.value)
    .then((response) => response.text())
    .then((response) => (container.innerHTML = response));
});


// preview untuk tambah dan ubah 
function previewImage() {
  const gambar = document.querySelector('.gambar');
  const imgPreview = document.querySelector('.img-preview');

  const OFReader = new FileReader();
  OFReader.readAsDataURL(gambar.files[0]);

  OFReader.onload = function (oFREvent) {
    imgPreview.src = oFREvent.target.result;
  };
};