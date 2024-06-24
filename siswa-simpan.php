<?php
session_start();
include "koneksi.php";
date_default_timezone_set("Asia/Jakarta");
$nik                  = $_POST['nik'];
$nis                  = $_POST['nis'];
$nisn                 = $_POST['nisn'];
$nama_siswa           = $_POST['nama_siswa'];
$jenis_kelamin         = $_POST['jenis_kelamin'];
$nama_wali               = $_POST['nama_wali'];
$no_telepon           = $_POST['no_telepon'];
$alamat               = $_POST['alamat'];

$sql = "SELECT * FROM siswa WHERE nisn = '$nisn'";
$query = mysqli_query($koneksi, $sql);
if (mysqli_num_rows($query) == 0) {
  $sql = "INSERT INTO siswa(nik, nis, nisn, nama_siswa, jenis_kelamin,nama_wali, no_telepon,alamat) VALUES('$nik','$nis','$nisn','$nama_siswa', '$jenis_kelamin', '$nama_wali', '$no_telepon','$alamat' )";
  $query   = mysqli_query($koneksi, $sql);
  if ($query == 1) {
    if ($_FILES["photo"]["name"] != "") {
      $namaBaru   = date('dmYHis');
      $new_images = $namaBaru . $_FILES["photo"]["name"];
      $images     = $_FILES["photo"]["tmp_name"];

      move_uploaded_file($images, "photo/" . $new_images);
      $sql = "UPDATE siswa SET photo = '$new_images' WHERE nisn='$nisn'";
      $query   = mysqli_query($koneksi, $sql);
    }

    $_SESSION['info'] = 'Disimpan';
  } else {
    $_SESSION['info'] = 'Gagal Disimpan';
  }
} else {
  $_SESSION['info'] = 'Gagal Disimpan';
}
header("location:siswa.php");