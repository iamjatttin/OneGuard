<?php
$servername="localhost";
$username="root";
$password="";
$database="oneguard";

$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn){
 echo ("ERROR".mysqli_connect_error());
}
session_start();
 if(!$_SESSION['staff_id']) {
  header('location:login.php');
  exit;
}
error_reporting(0);
// echo($_SESSION['admin_id']);
?>
