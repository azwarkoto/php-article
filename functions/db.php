<?php
  
  $host   = "localhost";
  $user   = "root";
  $pass   = "";
  $name   = "php-article";

  $connect = mysqli_connect($host, $user, $pass, $name);

  if(!$connect){
    die("ada error" . mysqli_error());
  }

?>
