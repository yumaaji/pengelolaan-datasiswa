<?php 

require "./server/database.php";

session_start();

if (isset($_POST['submit'])){
  if(loginSiswa($_POST)){

  }else{
    echo "<script>
          alert('Akun Atau Password Salah');
          window.location.href = 'loginSiswa.php';
          </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Siswa</title>
  <link rel="stylesheet" href="./style/user.css">
</head>
<body>
  <section>
    <!-- Nama Halaman -->
    <nav>
      <h1 class="judul-web">Smart <span>KITA</span></h1>
      <h1>Login as Siswa</h1>
      <p>Insert your data here</p>
    </nav>
    <!-- Form Login -->
    <nav>
      <form action="loginSiswa.php" method="POST">
        <input type="text" name="nisn_siswa" placeholder="nisn" maxlength="10" required>
        <input type="password" name="password" placeholder="password" required>
        <button type="submit" name="submit">Submit</button>
      </form>
    </nav>
    <!-- Pindah user -->
    <nav>
      <p class="move-user">isn't siswa? <span><a href="./loginAdmin.php"> Login as Admin</a></span></p>
    </nav>
  </section>
</body>
</html>