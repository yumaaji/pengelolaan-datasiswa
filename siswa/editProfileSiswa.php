<?php 

require "../server/database.php";

session_start();

if ($_SESSION['username_siswa'] != true){
  header ("location: ../loginSiswa.php");
}

if (isset($_POST['submit'])){
  editProfileSiswa($_POST);
}

$dataSiswa = $_SESSION['username_siswa']['agama_siswa'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Siswa | Ubah Data Profile</title>
  <link rel="stylesheet" href="../style/siswa/editProfileSiswa.css">
</head>
<body>
  <div class="container">
    <h1>Ubah Data Profile</h1>
    <img src="../img/siswa/<?= $_SESSION['username_siswa']['foto_siswa']?>" alt="siswa" class="foto-siswa">
    <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $_SESSION['username_siswa']['id'] ?>">
      <input type="hidden" name="foto_lama" value="<?php echo $_SESSION['username_siswa']['foto_siswa']?>">

      <input type="text" name="nisn" value="<?php echo $_SESSION['username_siswa']['nisn_siswa'] ?>" id="nisn" maxlength="10" placeholder="nisn siswa" readonly>
      <input type="text" name="nama" value="<?php echo $_SESSION['username_siswa']['nama_siswa']?>" placeholder="nama siswa">
      <input type="text" name="kelas" value="<?php echo $_SESSION['username_siswa']['kelas_siswa']?>">
      <select name="agama">
      <option value="" selected disabled>Pilih Agama</option>
       <?php

         $agama_siswa = $dataSiswa;
         $agama_options = ['ISLAM', 'KRISTEN', 'KATOLIK', 'HINDU', 'BUDHA', 'KONGHUCU'];
         foreach ($agama_options as $agama) {
         $selected = ($agama === $agama_siswa) ? 'selected' : '';
         echo "<option value=\"$agama\" $selected>$agama</option>";
        }

       ?>
      </select>

      <input type="text" name="telepon" value="<?php echo $_SESSION['username_siswa']['telepon_siswa']?>" maxlength="13">
      <input type="password" name="password" value="<?php echo $_SESSION['username_siswa']['password'] ?>" placeholder="Password">
      <input type="file" name="foto">
      <button type="submit" name="submit">Simpan Perubahan</button>
    </form>
    
    <a href="./dashboardsiswa.php" class="back-home"><button>Dashboard</button></a>
  </div>
</body>
<script>
    const username = document.getElementById("nisn")
    username.addEventListener("click", () => alert("NISN tidak dapat diubah!"))
</script>
</html>
