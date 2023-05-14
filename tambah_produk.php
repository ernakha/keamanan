<?php
include('config.php'); //agar index terhubung dengan database
?>
<!DOCTYPE html>
<html>
<head>
  <title>CRUD Produk dengan gambar - Gilacoding</title>
  <style type="text/css">
    * {
      font-family: "Trebuchet MS";
    }
    h1 {
      text-transform: uppercase;
      color: #f50834;
    }
    label {
      margin-top: 10px;
      float: left;
      text-align: left;
      width: 100%;
    }
    input {
      padding: 6px;
      width: 100%;
      box-sizing: border-box;
      background: #f8f8f8;
      border: 2px solid #ccc;
      outline-color: #f50834;
    }
    div {
      width: 100%;
      height: auto;
    }
    .base {
      width: 400px;
      height: auto;
      padding: 20px;
      margin-left: auto;
      margin-right: auto;
      background: #ededed;
    }
  </style>
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
  <center>
    <h1>Tambah Produk</h1>
    <center>
      <div class="base"><label> <a href="produk.php"> Home</a>
        </label></div>
      <form method="POST" action="proses_tambah.php" enctype="multipart/form-data">
        <section class="base">
          <div>
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" autofocus="" required="" />
          </div>
          <div>
            <label>Deskripsi</label>
            <input type="text" name="deskripsi" />
          </div>
          <div>
            <label>Harga Beli</label>
            <input type="text" name="harga_beli" required="" />
          </div>
          <div>
            <label>Gambar Produk</label>
            <input type="file" name="gambar_produk" required="" />
          </div>
          <div>
            <button type="submit" class="btn btn-info">Simpan Produk</button>
          </div>
        </section>
      </form>
      <br>
      <hr>
      <footer>Pemulungkode</footer>
</body>
</html>