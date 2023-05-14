<?php
include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>CRUD Produk dengan gambar - Gilacoding</title>
  <title>CRUD Gambar dengan PHP 7</title>
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
  <center>
    <h1>CRUD Gambar dengan PHP 7 Pemulungkode</h1>
  </center>
  <center><a href="tambah_produk.php"><button type="button" class="btn btn-info"> Tambah Produk</button></a>
  </center>
  <br />
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Produk</th>
        <th>Dekripsi</th>
        <th>Harga Beli</th>
        <th>Gambar</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
      $query = "SELECT * FROM produk ORDER BY id ASC";
      $result = mysqli_query($koneksi, $query);
      //mengecek apakah ada error ketika menjalankan query
      if (!$result) {
        die("Query Error: " . mysqli_errno($koneksi) .
          " - " . mysqli_error($koneksi));
      }

      //buat perulangan untuk element tabel dari data mahasiswa
      $no = 1; //variabel untuk membuat nomor urut
      // hasil query akan disimpan dalam variabel $data dalam bentuk array
      // kemudian dicetak dengan perulangan while
      while ($row = mysqli_fetch_assoc($result)) {
      ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row['nama_produk']; ?></td>
          <td><?php echo substr($row['deskripsi'], 0, 20); ?>...</td>
          <td>Rp <?php echo number_format($row['harga_beli'], 0, ',', '.'); ?></td>
          <td style="text-align: center;"><img src="gambar/<?php echo $row['gambar_produk']; ?>" class="img-thumbnail" style="width: 120px;"></td>
          <td>
            <a href="edit_produk.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-info">Edit</a> |
            <a href="proses_hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
          </td>
        </tr>
      <?php
        $no++; //untuk nomor urut terus bertambah 1
      }
      ?>
    </tbody>
  </table>
  <br>
  <hr>
  <Center>
    <footer>
      Pemulungkode
    </footer>
  </Center>
</body>
</html>