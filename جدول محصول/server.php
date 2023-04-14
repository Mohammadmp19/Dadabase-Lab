<?php 
function connect(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "mall";

  $connection = mysqli_connect($servername,$username,$password,$database);
  if (!$connection) {
    die("<p class='alert alert-danger'><strong>اخطار</strong> اتصال به پایگاه داده ناموفق بود</p>");
  }
  $connection->set_charset('utf8');
  mysqli_set_charset($connection,"utf8");

  return $connection;
  }
?>