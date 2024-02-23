<?php 

require "admin.php";
require "siswa.php";

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "smart_kita";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if ($db->connect_error){
  echo "koneksi database eror";
  die("gagal");
}

?>



