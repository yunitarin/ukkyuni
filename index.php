<?php
include 'config/koneksi.php';

 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" conctent="
  width=device-width, initial-scale=1">
  <title>Website Galeri Foto</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

  <style>
    body {
      background-color: whitesmoke;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="index.php">Website Galeri Foto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto">
        
      </div>
      <a href="register.php" class="btn btn-outline-primary m-1">Daftar</a>
      <a href="login.php" class="btn btn-outline-success m-1">Masuk</a>
    </div>
  </div>
</nav>


<div class="container mt-3">
  <div class="row">
    <?php  
  $query = mysqli_query($koneksi, "SELECT foto.id AS foto_id ,foto.*, album.*,user.* FROM foto JOIN user ON foto.user_id=user.id JOIN album ON foto.album_id=album.id");
  while($data = mysqli_fetch_array($query)){
 ?>
 <div class="col-md-3">
 <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['foto_id'] ?>">

      <div class="card mb-2">
        <img src="assets/img/<?php echo $data['lokasi_file'] ?>" class="card-img-top" title="<?php echo $data['judul_foto'] ?>" style="height: 12rem;">
        <div class="card-footer text-center">
        <a href="login.php" type="submit" name="suka"><i class="fa-regular fa-heart m-1"></i></a>

          <?php 
          $id = $data['foto_id'];
          $like =mysqli_query($koneksi, "SELECT * FROM like_foto WHERE foto_id='$id'");
          echo mysqli_num_rows($like). ' Suka';
          ?>
          <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['foto_id'] ?>"><i class="fa-regular fa-comment"></i></a>
          <?php
          $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentar_foto WHERE foto_id='$id'");
          echo mysqli_num_rows($jmlkomen).'Komentar';
           ?>
        </div>
      </div>
      </a>

      <!-- Modal -->
<div class="modal fade" id="komentar<?php echo $data['foto_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
          <img src="assets/img/<?php echo $data['lokasi_file'] ?>" class="card-img-top" title="<?php echo $data['judul_foto'] ?>">
          </div>
          <div class="col-md-4">
            <div class="m-2">
              <div class="overflow-auto">
                <div class="sticky-top">
                  <strong><?php echo $data['judul_foto'] ?></strong><br>
                  <span class="badge bg-secondary"><?php echo $data['nama_album'] ?></span>
                  <span class="badge bg-secondary"><?php echo $data['tanggal_unduh'] ?></span>
                  <span class="badge bg-primary"><?php echo $data['nama_album'] ?></span>
                </div>
                <hr>
                <p align="left">
                  <?php echo $data['deskripsi_foto'] ?>
                </p>
                <hr>
                <?php
                $foto_id = $data['foto_id'];
                $komentar   = mysqli_query($koneksi,"SELECT * FROM komentar_foto JOIN user ON komentar_foto.user_id=user.id WHERE komentar_foto.foto_id='$foto_id'");
                while($row = mysqli_fetch_array($komentar)) {
                 ?>
                 <p align="left">
                  <strong><?php echo $row['nama_lengkap'] ?></strong>
                  <?php echo $row['isi_komentar'] ?>
                 </p>
                 <?php } ?>
                <hr> 
                <div class="sticky-bottom">
                  <form action="../config/proses_komentar.php" method="POST">
                    <div class="input-group">
                      <input type="hidden" name="foto_id" value="<?php echo $data['foto_id'] ?>">
                      <input type="text" name="isi_komentar" class="form-control" placeholder="Silahkan Login Dulu sebelum komentar">
                      <div class="input-group-prepend">
                       <a href="login.php" class="btn btn-primary">Login</a>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    </div>
    <?php } ?>

  </div>
</div>
<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
  <p>&copy; UKK RPL 2024 | Yuni tarina</p>
</footer>


<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>