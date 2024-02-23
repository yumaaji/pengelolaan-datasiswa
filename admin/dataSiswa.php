<?php

require "../server/database.php";

session_start();

if ($_SESSION['username_admin'] != true){
  header ("location: ../loginAdmin.php");
  exit;
}

$dataSiswa = ambilDataSiswa("SELECT * FROM data_siswa");

if (isset($_POST['cari'])){
  $dataSiswa = searchDataSiswa($_POST['keyword']);
  $result = $dataSiswa;

  if (empty($result)){
    echo "<script>alert('Keyword Tidak Ditemukan')
    document.location.href='./dataSiswa.php';</script>";
    
  }else{
    $dataSiswa = $result;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/admin/dataSiswa.css">
  <title>Admin | Data Siswa</title>
</head>
<body>
  <h1>Selamat Datang <span><?= $_SESSION['username_admin']['username'] ?></span></h1>
  <div class="navigation">
    <div class="button">
      <a href="tambahDataSiswa.php"><button>Tambah Data Siswa</button></a>
      <a href="dashboardAdmin.php"><button>Dashboard</button></a>
    </div>

    <!-- Form data searching -->
    <form action="dataSiswa.php" method="POST">
      <input type="text" name="keyword" size="40" placeholder="keyword : nisn / nama / kelas" autocomplete="off" autofocus required>
      <button type="submit" name="cari">Cari</button>
    </form>
  </div>
  
  <div class="table-container">
    <table border="1" cellpading="10" cellspacing="0">
      <tr>
        <th>Nomer</th>
        <th>Gambar</th>
        <th>NISN</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Agama</th>
        <th>Telepon</th>
        <th>Aksi</th>
      </tr>


      <?php $i=1 ?>
      <?php foreach($dataSiswa as $row): ?>
      <tr>
        <td><?= $i ?></td>
        <td><img src="../img/siswa/<?= $row['foto_siswa'] ?>" width="70" style="border-radius: 50%" alt=""></td>
        <td><?= $row['nisn_siswa'] ?></td>
        <td><?= $row['nama_siswa'] ?></td>
        <td><?= $row['kelas_siswa'] ?></td>
        <td><?= $row['agama_siswa'] ?></td>
        <td><?= $row['telepon_siswa'] ?></td>
        <td>
          <a href="./updateDataSiswa.php?id=<?=$row['id']?>" class="button-update-data">ubah</a>
          <a href="./hapusDataSiswa.php?id=<?= $row['id']?>" onclick="return confirm ('Yakin Ingin Menghapus Data?');" class="button-hapus-data">hapus</a>
        </td>
      </tr>
      <?php $i++ ?>
      <?php endforeach; ?>
      
    </table>
  </div>
</body>
</html>
