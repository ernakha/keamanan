<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include 'config.php';
// membuat variabel untuk menampung data dari form
$nama_produk   = $_POST['nama_produk'];
$deskripsi     = $_POST['deskripsi'];
$harga_beli    = $_POST['harga_beli'];
$gambar_produk = $_FILES['gambar_produk']['name'];
//cek dulu jika ada gambar produk jalankan coding ini
if ($gambar_produk != "") {
  $ekstensi_diperbolehkan = array('png', 'jpg'); //ekstensi file gambar yang bisa diupload 
  $x = explode('.', $gambar_produk); //memisahkan nama file dengan ekstensi yang diupload
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar_produk']['tmp_name'];
  $angka_acak     = rand(1, 999);
  $nama_gambar_baru = $angka_acak . '-' . $gambar_produk; //menggabungkan angka acak dengan nama file sebenarnya
  if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
    move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
    // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
    $query = "INSERT INTO produk (nama_produk, deskripsi, harga_beli, gambar_produk) VALUES ('$nama_produk', '$deskripsi', '$harga_beli', '$nama_gambar_baru')";
    $result = mysqli_query($koneksi, $query);
    // periska query apakah ada error
    if (!$result) {
      die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman produk.php
      //silahkan ganti produk.php sesuai halaman yang akan dituju
      echo "<script>alert('Data berhasil ditambah.');window.location='produk.php';</script>";
    }
  } else {
    //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
    echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_produk.php';</script>";
  }
} else {
  $query = "INSERT INTO produk (nama_produk, deskripsi, harga_beli, gambar_produk) VALUES ('$nama_produk', '$deskripsi', '$harga_beli', null)";
  $result = mysqli_query($koneksi, $query);
  // periska query apakah ada error
  if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
      " - " . mysqli_error($koneksi));
  } else {
    //tampil alert dan akan redirect ke halaman produk.php
    //silahkan ganti produk.php sesuai halaman yang akan dituju
    echo "<script>alert('Data berhasil ditambah.');window.location='produk.php';</script>";
  }
}