<?php
session_start();
include 'koneksi.php';

$foto_id = $_POST['foto_id'];
$user_id = $_SESSION['id'];
$isi_komentar = $_POST['isi_komentar'];
$tanggal_komentar = date('Y-m-d');

$query = mysqli_query($koneksi, "INSERT INTO komentar_foto VALUES('', '$foto_id','$user_id','$isi_komentar','$tanggal_komentar')");
// var_dump($koneksi);
echo "<script>
location.href='../admin/index.php';
</script>";
 ?>