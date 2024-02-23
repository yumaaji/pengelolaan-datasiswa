<?php 

require "../server/database.php";

session_start();

if ($_SESSION['username_admin'] != true){
  header ("location: ../loginAdmin.php");
  exit;
}

$id = $_GET['id'];

$dataSiswa = ambilDataSiswa("SELECT * FROM data_siswa WHERE id = $id")[0];

if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}

if (isset($_POST['submit'])){

  try{

    if (updateDataSiswa($_POST) > 0){
      echo "<script>
            alert('Data Berhasil Diupdate');
            document.location.href = './dataSiswa.php';
          </script>";

    }else{
      echo "<script>
            alert('Tidak Ada Data Yang Diupdate');
            document.location.href = './dataSiswa.php';
          </script>";
    }

  }catch(mysqli_sql_exception){
    echo "<script>
            alert('NISN Sudah Terdaftar');
            document.location.href = './dataSiswa.php';
          </script>";
  }
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/admin/updateDataSiswa.css">
  <title>Ubah Data Siswa</title>
</head>
<body>
  <h1>Ubah Data Siswa</h1>

  <div class="container">
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=$dataSiswa['id'] ?>" maxlength="10">
    <input type="hidden" name="foto_lama" value="<?= $dataSiswa['foto_siswa']?>">

    <input type="text" name="nisn" id="nisn" maxlength="10" value="<?=$dataSiswa['nisn_siswa'] ?>" required>
    <input type="text" name="nama" id="nama" value="<?=$dataSiswa['nama_siswa'] ?>" required>
    <input type="text" name="kelas" id="kelas" value="<?=$dataSiswa['kelas_siswa'] ?>" required>
    <select name="agama" id="agama" required>
      <option value="" selected disabled>Pilih Agama</option>
       <?php

         $agama_siswa = $dataSiswa['agama_siswa'];
         $agama_options = ['ISLAM', 'KRISTEN', 'KATOLIK', 'HINDU', 'BUDHA', 'KONGHUCU'];
         foreach ($agama_options as $agama) {
         $selected = ($agama === $agama_siswa) ? 'selected' : '';
         echo "<option value=\"$agama\" $selected>$agama</option>";
        }

       ?>
    </select>

    <input type="text" name="telepon" id="telepon" value="<?=$dataSiswa['telepon_siswa'] ?>" required>
    <input type="file" name="foto" id="foto">

    <button type="submit" name="submit">Simpan Perubahan</button>
  </form>
  <a href="./dataSiswa.php"><button class="back-home">Data Seluruh Siswa</button></a>
  <a href="./dashboardAdmin.php"><button class="back-home">Dashboard</button></a>
  </div>

</body>
</html>