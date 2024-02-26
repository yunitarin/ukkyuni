<?php
session_start();
$user_id = $_SESSION['id'];
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum Login!');
    location.href='../index.php';
    </script>";

}

 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" conctent="
  width=device-width, initial-scale=1">
  <title>Website Galeri Foto</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <style>
    body {
      background-color: white;
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
        <a href="home.php" class="nav-link">Home</a>
        <a href="album.php" class="nav-link">Album</a>
        <a href="foto.php" class="nav-link">Foto</a>
      </div>
      
      <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">Keluar</a>
    </div>
  </div>
</nav>

<div class="container mt-3">
  Album :
  <?php 
  $album = mysqli_query($koneksi, "SELECT * FROM album WHERE user_id='$user_id'");
  while($row = mysqli_fetch_array($album)){ ?>
  <a href="home.php?album=<?php echo $row['id'] ?>" class="btn btn-outline-primary"><?php echo $row['nama_album'] ?></a>

  <?php } ?>

  <div class="row">
    <?php 
    if (isset($_GET['album'])) {
      $album = $_GET['album'];
      // var_dump($album);
      $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE user_id='$user_id' AND album_id='$album'");
      while($data = mysqli_fetch_array($query)){ ?>
      <div class="col-md-3 mt-2">
      <div class="card">
        <img style="height: 12rem;" src="../assets/img/<?php echo $data['lokasi_file'] ?>" class="card-img-top" title="<?php echo $data['judul_foto'] ?>">
        <div class="card-footer text-center">
          
          <?php
          $id = $data['id'];
          $ceksuka = mysqli_query($koneksi, "SELECT * FROM like_foto WHERE user_id='$user_id'");
          if (mysqli_num_rows($ceksuka) == 1) { ?>
            <a href="../config/proses_like.php?id=<?php echo $data['id'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart m-1"></i></a>

          <?php }else{ ?>
            <a href="../config/proses_like.php?id=<?php echo $data['id'] ?>" type="submit" name="suka"><i class="fa-regular fa-heart m-1"></i></a>

          <?php }
          $like =mysqli_query($koneksi, "SELECT * FROM like_foto WHERE foto_id='$id'");
          echo mysqli_num_rows($like). ' Suka';
          ?>
          <a href=""><i class="fa-regular fa-comment"></i></a> 3 Komentar
        </div>
      </div>
    </div>
      
    <?php } }else{ 

$id = $_SESSION['id'];
$query = mysqli_query($koneksi, "SELECT * FROM foto WHERE user_id='$id'");
while($data = mysqli_fetch_array($query)){
 ?>
 <div class="col-md-3 mt-2">
      <div class="card">
        <img style="height: 12rem;" src="../assets/img/<?php echo $data['lokasi_file'] ?>" class="card-img-top" title="<?php echo $data['judul_foto'] ?>">
        <div class="card-footer text-center">
          
          <?php
          $id = $data['id'];
          $ceksuka = mysqli_query($koneksi, "SELECT * FROM like_foto WHERE user_id='$user_id'");
          if (mysqli_num_rows($ceksuka) == 1) { ?>
            <a href="../config/proses_like.php?id=<?php echo $data['id'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart m-1"></i></a>

          <?php }else{ ?>
            <a href="../config/proses_like.php?id=<?php echo $data['id'] ?>" type="submit" name="suka"><i class="fa-regular fa-heart m-1"></i></a>

          <?php }
          $like =mysqli_query($koneksi, "SELECT * FROM like_foto WHERE foto_id='$id'");
          echo mysqli_num_rows($like). ' Suka';
          ?>
          <a href=""><i class="fa-regular fa-comment"></i></a> 3 Komentar
        </div>
      </div>
    </div>
 <?php } } ?>
 </div>
</div>


<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
  <p>&copy; UKK RPL 2024 | Yuni tarina</p>
</footer>


<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>