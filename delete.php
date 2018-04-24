<?php

  require_once "core/init.php";

  if(cek_login() === false){
    header('Location: login.php');
  }

  require_once "view/header.php";

  // get blog ID, and delete it by function hapus_data()
  if (isset($_GET['id'])) {
    if (hapus_data($_GET['id'])) {
      header('Location: index.php');
    } else {
      echo 'gagal hapus data';
    }
  }

?>
