<?php 

require "../server/database.php";

session_start();

if ($_SESSION['username_admin'] != true){
  header ("location: ../loginAdmin.php");
}

if (isset($_POST['submit'])){
  updateDataAdmin($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin | Ubah Data Profile</title>
  <link rel="stylesheet" href="../style/admin/editProfileAdmin.css">
</head>
<body>
  <div class="container">
    <h1>Ubah Data Admin</h1>
    <img src="../img/admin/<?= $_SESSION['username_admin']['foto_admin']?>" alt="admin" class="foto-admin">
    
    <form action="editProfileAdmin.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $_SESSION['username_admin']['id'] ?>">
      <input type="hidden" name="foto_lama" value="<?php echo $_SESSION['username_admin']['foto_admin']?>">

      <input type="text" id="username" name="username" value="<?php echo $_SESSION['username_admin']['username'] ?>" placeholder="Username" required>
      <input type="password" id="password" name="password" value="<?php echo $_SESSION['username_admin']['password'] ?>" placeholder="Password" required>
      <input type="file" name="foto" >
      <button type="submit" name="submit">Simpan Perubahan</button>
    </form>
    
    <a href="./dashboardAdmin.php" class="back-home"><button>Dashboard</button></a>
  </div>
</body>
</html>
