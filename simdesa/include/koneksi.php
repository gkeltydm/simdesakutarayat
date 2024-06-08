<?php
/*
 *      koneksi.php
 *      Melakukan koneksi ke database
 */
$user = "root";
$host = "localhost";
$pass = "";
$db = "simdes_db";
$conn = mysqli_connect($host,$user,$pass,$db) or die("koneksi gagal");

?>
