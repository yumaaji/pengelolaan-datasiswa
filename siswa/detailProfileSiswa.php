<?php 

require "../server/database.php";

session_start();

if ($_SESSION['username_siswa'] != true){
  header ("location: ../loginSiswa.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Siswa | Data Profile</title>
  <link rel="stylesheet" href="../style/siswa/detailProfileSiswa.css">
</head>
<body>
  <div class="container">
    <h1>Data Profile</h1>
    <img src="../img/siswa/<?= $_SESSION['username_siswa']['foto_siswa']?>" alt="siswa" class="foto-siswa">
    <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $_SESSION['username_siswa']['id'] ?>">
      <input type="hidden" name="foto-lama" value="<?php echo $_SESSION['username_siswa']['foto_siswa']?>">
      
      <input type="text" name="nisn" value="<?php echo $_SESSION['username_siswa']['nisn_siswa'] ?>" readonly>
      <input type="text" name="nama" value="<?php echo $_SESSION['username_siswa']['nama_siswa']?>" readonly>
      <input type="text" name="kelas" value="<?php echo $_SESSION['username_siswa']['kelas_siswa']?>" readonly>
      <input type="text" name="agama" value="<?php echo $_SESSION['username_siswa']['agama_siswa']?>" readonly>

      <input type="text" name="telepon" value="<?php echo $_SESSION['username_siswa']['telepon_siswa']?>" readonly>
      <input type="password" name="password" value="<?php echo $_SESSION['username_siswa']['password']?>" placeholder="password siswa" readonly>
    </form>
    
    <a href="./editProfileSiswa.php" class="back-home"><button>Edit profile</button></a>
    <a href="./dashboardSiswa.php" class="back-home"><button>Dashboard</button></a>
  </div>
</body>

</html>