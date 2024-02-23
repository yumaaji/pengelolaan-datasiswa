<?php 

require "./server/database.php";

session_start();

if (isset($_POST['submit'])){
  if(loginAdmin($_POST)){

  }else{
    echo "<script>
          alert('Akun Atau Password Salah');
          window.location.href = 'loginAdmin.php';
          </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Admin</title>
  <link rel="stylesheet" href="./style/user.css">
</head>
<body>
  <section>
    <!-- Nama Halaman -->
    <nav>
      <h1 class="judul-web">Smart <span>KITA</span></h1>
      <h1>Login as Admin</h1>
      <p>Insert your data here</p>
    </nav>
    <!-- Form Login -->
    <nav>
      <form action="loginAdmin.php" method="POST">
        <input type="text" name="username" placeholder="username" required>
        <input type="password" name="password" placeholder="password" required>
        <button type="submit" name="submit">Submit</button>
      </form>
    </nav>
    <!-- Pindah user -->
    <nav>
      <p class="move-user">isn't admin? <span><a href="./loginSiswa.php">Login as Siswa</a></span></p>
    </nav>
  </section>
</body>
</html>