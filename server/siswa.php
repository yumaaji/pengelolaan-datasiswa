<?php 

// Login Siswa
function loginSiswa($dataLoginSiswa){
  global $db;

  $nisn_siswa = $dataLoginSiswa['nisn_siswa'];
  $password   = $dataLoginSiswa['password'];
  
  $sql = "SELECT * FROM data_siswa 
          WHERE nisn_siswa = '$nisn_siswa' 
          AND password = '$password'";

  $result = $db->query($sql);

  $getAkun = $result->num_rows;
  if($getAkun == 1){
    $dataLogin = $result -> fetch_assoc();

    $_SESSION['username_siswa'] = $dataLogin;

    header("location: ./siswa/dashboardSiswa.php");
  }
}

//Edit Profile Siswa
function editProfileSiswa($dataUpdateSiswa){
  global $db;
  $id             = $dataUpdateSiswa['id'];
  $nisn_siswa     = (strtoupper(htmlspecialchars($dataUpdateSiswa['nisn'])));
  $nama_siswa     = (strtoupper(htmlspecialchars($dataUpdateSiswa['nama'])));
  $kelas_siswa    = (strtoupper(htmlspecialchars($dataUpdateSiswa['kelas'])));
  $agama_siswa    = (strtoupper(htmlspecialchars($dataUpdateSiswa['agama'])));
  $telepon_siswa  = $dataUpdateSiswa['telepon'];
  $password_siswa = (strtoupper(htmlspecialchars($dataUpdateSiswa['password'])));
  $fotoLama       = $dataUpdateSiswa['foto_lama'];

  if ($_FILES['foto']['error']===4 
      && $_SESSION['username_siswa']['nama_siswa'] === $nama_siswa 
      && $_SESSION['username_siswa']['kelas_siswa'] === $kelas_siswa
      && $_SESSION['username_siswa']['agama_siswa'] === $agama_siswa
      && $_SESSION['username_siswa']['telepon_siswa'] === $telepon_siswa
      && $_SESSION['username_siswa']['password'] === $password_siswa){

    $foto_siswa = $fotoLama;
    echo "<script>
            alert('Tidak Ada Data Yang Diubah');
            window.location.href = 'dashboardSiswa.php';
          </script>";
    

  }elseif($_FILES['foto']['error']===4){
    $foto_siswa = $fotoLama;
    $nama_siswa;
    $password_siswa;
  }else{
    
    $foto_siswa = updateFotoProfile();
  }

  $sql = "UPDATE data_siswa SET 
          nisn_siswa = '$nisn_siswa',
          nama_siswa = '$nama_siswa',
          kelas_siswa = '$kelas_siswa',
          foto_siswa = '$foto_siswa',
          agama_siswa = '$agama_siswa',
          telepon_siswa = '$telepon_siswa',
          password = '$password_siswa'
          WHERE id = '$id'";
  
  $db->query($sql);
  echo "<script>
          alert('Data Berhasil Diubah, Login Ulang');
          window.location.href = '../loginSiswa.php';
        </script>";
}

// Update Foto Profile Siswa
function updateFotoProfile(){
  $nama_file   = $_FILES['foto']['name'];
  $ukuran_file = $_FILES['foto']['size'];
  $eror        = $_FILES['foto']['error'];
  $tmp_name    = $_FILES['foto']['tmp_name'];

  if ($eror === 4){
    echo "<script>
            alert('Tidak Ada File Yang Dipilih');
            window.location.href = 'editProfileSiswa.php';
          </script>";

    die;
  }
  
  $ekstensiFileValid = ['jpg', 'jpeg', 'png', 'heic'];
  $ekstensiFile      = explode('.', $nama_file);
  $ekstensiFile      = strtolower(end($ekstensiFile));

  if (!in_array($ekstensiFile, $ekstensiFileValid)){
    echo "<script>
            alert('Yang Dipilih Bukan Gambar');
            window.location.href = 'editProfileSiswa.php';
          </script>";
    die;
  }

  if ($ukuran_file > 1000000){
    echo "<script>
           alert('Ukuran Gambar Terlalu Besar (max 1mb)');
           window.location.href = 'editProfileSiswa.php';
          </script>";
    die;
  }

  // ketika lolos pengecekan di atas
  // generate nama gambar baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiFile;
  move_uploaded_file($tmp_name, '../img/siswa/' . $namaFileBaru);

  return $namaFileBaru;
}

// Logout Siswa
function logoutSiswa(){
  session_unset();
  session_destroy();
  header("location: ../index.php");
}
?>