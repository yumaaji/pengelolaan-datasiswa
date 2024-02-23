<?php 

require "../server/database.php";

session_start();

if ($_SESSION['username_admin'] != true){
  header ("location: ../loginAdmin.php");
  exit;
}

if (isset($_POST['submit'])){
  try{
    if (tambahDataSiswa($_POST) > 0){
      echo "<script>
            alert('Data Berhasil Ditambahkan');
            document.location.href = 'dataSiswa.php';
          </script>";

    }else{
      echo "<script>
            alert('Data Gagal Ditambahkan');
            document.location.href = 'tambahDataSiswa.php';
          </script>";
    }

  }catch(mysqli_sql_exception){
    echo "<script>
            alert('NISN Sudah Terdaftar!');
            document.location.href = 'tambahDataSiswa.php';
          </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/admin/tambahDataSiswa.css">
  <title>Admin | Tambah Data Siswa</title>
</head>
<body>
  <div class="judul-halaman">
    <h1>Tambah Data Siswa</h1>
  </div>
  <div class="container">
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="text" name="nisn" id="nisn" maxlength="10" placeholder="nisn" required>
      <input type="text" name="nama" id="nama" placeholder="nama siswa" required>
      <input type="text" name="kelas" id="kelas" placeholder="kelas siswa" required>
      <select name="agama" id="agama" required>
        <option value="" selected disabled >Pilih Agama</option>
        <option value="ISLAM">islam</option>
        <option value="KRISTEN">kristen</option>
        <option value="KATOLIK">katolik</option>
        <option value="HINDU">hindu</option>
        <option value="BUDHA">budha</option>
        <option value="KONGHUCU">konghucu</option>
      </select>
      <input type="text" name="telepon" id="telepon" maxlength="13" placeholder="telepon siswa" required>
      <input type="file" name="foto" id="foto" placeholder="foto siswa" required>

      <button type="submit" name="submit">Submit</button>
    </form>
      <a href="./datasiswa.php"><button class="button-data-siswa">Lihat Data Siswa</button></a>
      <a href="./dashboardadmin.php"><button class="back-home">Dashboard Admin</button></a>
  </div>
</body>
</html>