<?php 

// Login Admin
function loginAdmin($dataLoginAdmin){
  global $db;

  $username = $dataLoginAdmin['username'];
  $password = $dataLoginAdmin['password'];
 
  $sql = "SELECT * FROM data_admin 
          WHERE username='$username' 
          AND password = '$password'";

  $result = $db->query($sql);

  $getAkun = $result->num_rows;
  if ($getAkun == 1){
    $dataLogin = $result -> fetch_assoc();

    $_SESSION['username_admin'] = $dataLogin;
    
    header("location: ./admin/dashboardAdmin.php");
  }
}

// Update Profile Admin
function updateDataAdmin($dataUpdateAdmin){
  global $db;

  $username_admin = $dataUpdateAdmin['username'];
  $password_admin = $dataUpdateAdmin['password'];
  $id_admin       = $dataUpdateAdmin['id'];
  $foto_lama      = $dataUpdateAdmin['foto_lama'];

  try{
    if ($_FILES['foto']['error']===4 
        && $_SESSION['username_admin']['username'] === $username_admin 
        && $_SESSION['username_admin']['password'] === $password_admin){

      $foto_admin = $foto_lama;
      echo "<script>
              alert('Tidak Ada Data Yang Diubah');
              window.location.href = 'dashboardAdmin.php';  
            </script>";

    }elseif($_FILES['foto']['error']===4){
      $foto_admin = $foto_lama;
      $username_admin = $dataUpdateAdmin['username'];
      $password_admin = $dataUpdateAdmin['password'];
    }else{
      
      $foto_admin = uploadFotoAdmin();
    }
    
    $sql = "UPDATE data_admin 
            SET username = '$username_admin', 
            password = '$password_admin', 
            foto_admin ='$foto_admin' 
            WHERE id = '$id_admin' ";
  
    $db->query($sql);
    
    echo "<script>
            alert('Data Berhasil Diubah, Login Ulang');
            window.location.href = '../loginAdmin.php';
          </script>";
  }catch(mysqli_sql_exception){
    echo "<script>
            alert('Username Sudah Terdaftar!');
            document.location.href = 'editProfileAdmin.php';
          </script>";
  }
  
}

// Upload Foto Admin
function uploadFotoAdmin(){
  
  $nama_file   = $_FILES['foto']['name'];
  $ukuran_file = $_FILES['foto']['size'];
  $eror        = $_FILES['foto']['error'];
  $tmp_name    = $_FILES['foto']['tmp_name'];

  if ($eror === 4){
    echo "<script>
            alert('Tidak Ada File Yang Dipilih');
            window.location.href = 'editProfileAdmin.php';
          </script>";
    die;
  }
  
  $ekstensiFileValid = ['jpg', 'jpeg', 'png', 'heic'];
  $ekstensiFile = explode('.', $nama_file);
  $ekstensiFile = strtolower(end($ekstensiFile));

  if (!in_array($ekstensiFile, $ekstensiFileValid)){
    echo "<script>
            alert('Ekstensi Gambar Tidak Valid');
            window.location.href = 'editProfileAdmin.php';
          </script>";
    die;
  }

  if ($ukuran_file > 1000000){
    echo "<script>
            alert('Ukuran Gambar Terlalu Besar (max 1mb)');
            window.location.href = 'editProfileAdmin.php';
          </script>";
    die;
  }

  // ketika lolos pengecekan di atas
  // generate nama gambar baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiFile;
  move_uploaded_file($tmp_name, '../img/admin/' . $namaFileBaru);

  return $namaFileBaru;
}

// Menampilkan Data Siswa
function ambilDataSiswa($ambilDataSiswa){
  global $db;
  $result = mysqli_query($db, $ambilDataSiswa);
  $rows = [];
  while($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
  }
  return $rows;
}

// Menambah Data Siswa
function tambahDataSiswa($dataSiswa){
  global $db;
  $nisn_siswa    = htmlspecialchars($dataSiswa['nisn']);
  $nama_siswa    = (strtoupper(htmlspecialchars($dataSiswa['nama'])));
  $kelas_siswa   = (strtoupper(htmlspecialchars($dataSiswa['kelas'])));
  $agama_siswa   = (strtoupper(isset($dataSiswa['agama']) ? htmlspecialchars($dataSiswa['agama']) : ""));
  $telepon_siswa = htmlspecialchars($dataSiswa['telepon']);

  $foto_siswa = uploadFotoSiswa();
  if(!$foto_siswa){
    return false;
  }

  $sql = "INSERT INTO data_siswa (nisn_siswa, nama_siswa, kelas_siswa, foto_siswa, agama_siswa, telepon_siswa) 
  VALUES ('$nisn_siswa', '$nama_siswa', '$kelas_siswa', '$foto_siswa', '$agama_siswa', '$telepon_siswa' )";

  mysqli_query($db, $sql);
  return mysqli_affected_rows($db);
}

// Update Data Siswa
function updateDataSiswa($dataSiswa){
  global $db;
  $id            = $dataSiswa['id'];
  $nisn_siswa    = htmlspecialchars($dataSiswa['nisn']);
  $nama_siswa    = (strtoupper(htmlspecialchars($dataSiswa['nama'])));
  $kelas_siswa   = (strtoupper(htmlspecialchars($dataSiswa['kelas'])));
  $agama_siswa   = (strtoupper($dataSiswa['agama']));
  $telepon_siswa = htmlspecialchars($dataSiswa['telepon']);

  $fotoLama = $dataSiswa['foto_lama'];

  if ($_FILES['foto']['error']===4){
    $foto_siswa = $fotoLama;
  }else{
    $foto_siswa = uploadFotoSiswa();
  }

  $sql = "UPDATE data_siswa SET 
          nisn_siswa = '$nisn_siswa',
          nama_siswa = '$nama_siswa',
          kelas_siswa = '$kelas_siswa',
          foto_siswa = '$foto_siswa',
          agama_siswa = '$agama_siswa',
          telepon_siswa = '$telepon_siswa'
          WHERE id = '$id'";
  mysqli_query($db, $sql);

  return mysqli_affected_rows($db);

}

// Menghapus Data Siswa
function deleteDataSiswa($id){
  global $db;
  $sql = "DELETE FROM data_siswa WHERE id = $id";
  mysqli_query($db, $sql);
  return mysqli_affected_rows($db);
}

// Upload Foto Siswa
function uploadFotoSiswa(){

  $nama_file   = $_FILES['foto']['name'];
  $ukuran_file = $_FILES['foto']['size'];
  $eror        = $_FILES['foto']['error'];
  $tmp_name    = $_FILES['foto']['tmp_name'];

  if ($eror === 4){
    echo "<script>
            alert('Tidak Ada File Yang Dipilih');
            window.location.href = 'dataSiswa.php';
          </script>";
    die();
  }

  $ekstensiFileValid = ['jpg', 'jpeg', 'png', 'heic'];
  $ekstensiFile      = explode('.', $nama_file);
  $ekstensiFile      = strtolower(end($ekstensiFile));

  if (!in_array($ekstensiFile, $ekstensiFileValid)){
    echo "<script>
            alert('Ekstensi Gambar Tidak Valid');
            window.location.href = 'dataSiswa.php';
          </script>";
    die();
    
  }

  if ($ukuran_file > 1000000){
    echo "<script>
            alert('Ukuran Gambar Terlalu Besar (max 1mb)');
            window.location.href = 'dataSiswa.php';
          </script>";
    die();
  }

  // ketika lolos pengecekan di atas
  // generate nama gambar baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiFile;
  move_uploaded_file($tmp_name, '../img/siswa/' . $namaFileBaru);

  return $namaFileBaru;
}

// Fitur Searching Data Siswa
function searchDataSiswa($keyword){
  $ambilDataSiswa = "SELECT * FROM data_siswa 
            WHERE nisn_siswa LIKE '%$keyword%' 
            OR nama_siswa LIKE '%$keyword%'
            OR kelas_siswa LIKE '%$keyword%'";
            
  return ambilDataSiswa($ambilDataSiswa);
}

// Dashoard Admin - Logout
function logoutAdmin(){
  session_unset();
  session_destroy();
  header ("location: ../index.php");
}

?>