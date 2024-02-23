<?php 

require "../server/database.php";

session_start();

if ($_SESSION['username_siswa'] != true){
  header ("location: ../loginSiswa.php");
}

if (isset($_POST['logout'])){
  logoutSiswa();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/siswa/dashboardSiswa.css">
  <title>Siswa | Dashboard</title>
</head>
<body>
  <div class="container">
    <h1 class="greeting"><span id="greeting"></span> <br> <span class="nama-siswa"><?= ucwords(strtolower($_SESSION['username_siswa']['nama_siswa'])) ?></span> <span class="kelas-siswa"> - <?php echo strtoupper($_SESSION['username_siswa']['kelas_siswa'])  ?></span></h1>
    <img src="../img/siswa/<?= $_SESSION['username_siswa']['foto_siswa']?>" alt="siswa" class="foto-siswa">
    <div class="buttons">
      <a href="./detailProfileSiswa.php"><button>Detail Profil</button></a>
      <a href="./editProfileSiswa.php"><button>Edit Profile</button></a>

      <form action="dashboardSiswa.php" method="POST">
        <a href=""><button name="logout" onclick="return confirm('Yakin Ingin Logout?');">Logout</button></a>
      </form>
    </div>
  </div>
  <script src="../timeGreeting.js"></script>
</body>
</html>