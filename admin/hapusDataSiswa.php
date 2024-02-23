<?php 
// Menghubungkan dengan database & function guna CRUD
require "../server/database.php";
session_start();

if ($_SESSION['username_admin'] != true){
  header ("location: ../loginAdmin.php");
}

$id = $_GET['id'];

if (deleteDataSiswa($id) > 0){
  echo "<script>
          alert('Data Berhasil Dihapus');
        </script>";
  header("location: ./dataSiswa.php");
}else{
  echo "<script>
          alert('Data Gagal Dihapus');
        </script>";
  header("location: ./dataSiswa.php");
}

?>