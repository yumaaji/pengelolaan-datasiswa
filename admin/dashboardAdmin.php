<?php 

require "../server/database.php";

session_start();

if ($_SESSION['username_admin'] != true){
  header ("location: ../loginAdmin.php");
}

if (isset($_POST['logout'])){
  logoutAdmin();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/admin/dashboardAdmin.css">
  <title>Admin | Dashboard</title>
</head>
<body>
<div class="container">
  <h1><span id="greeting"></span> <br> <span class="username-admin"><?= $_SESSION['username_admin']['username']?></span></h1>
  <img src="../img/admin/<?= $_SESSION['username_admin']['foto_admin']?>" alt="admin" class="foto-admin">
  
  <div class="buttons">
    <a href="./editProfileAdmin.php"><button>Edit Profile</button></a>
    <a href="./dataSiswa.php"><button>Lihat Data Siswa</button></a>
    <a href="./tambahDataSiswa.php"><button>Tambah Data Siswa</button></a>

    <form action="dashboardAdmin.php" method="POST">
      <button type="submit" name="logout" onclick="return confirm ('Yakin Ingin Logout?');">Logout</button>
    </form>
  </div>
</div>

<script src="../timeGreeting.js"></script>
</body>
</html>