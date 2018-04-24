<?php

  require_once "core/init.php";

  // check user login, deny user to access add.php if cek_login === false
  if(cek_login() === false){
    header('Location: login.php');
  }

  require_once "view/header.php";

  $error = '';
  // add an article
  if (isset($_POST['submit'])) {

    $judul = mysqli_real_escape_string($connect, $_POST['judul']);
    $isi = mysqli_real_escape_string($connect, $_POST['isi']);
    $tag = mysqli_real_escape_string($connect, $_POST['tag']);

    // if $judul and $isi empty, proceed
    if (!empty(trim($judul).trim($isi))) {
      if (tambah_data($judul, $isi, $tag)) {
        echo "<meta http-equiv='refresh' content='1;url=index.php' />";
      }
    } else {
      $error = 'judul dan konten harus di isi';
    }

  }

?>

<div class="container">

  <h1>Add Blog</h1>

  <!-- add form  -->
  <form action="" method="post">
    <label for="judul">Judul</label> <br>
    <input type="text" name="judul" value=""> <br><br>

    <label for="isi">Isi</label> <br>
    <textarea name="isi" rows="1" cols="80"></textarea> <br><br>

    <label for="tag">Tag</label> <br>
    <input type="text" name="tag" value=""> <br><br>

    <input type="submit" name="submit" value="submit">

    <div id="error"><?= $error ?></div> <br>
  </form>

</div>
