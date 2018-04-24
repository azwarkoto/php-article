<?php
  require_once "core/init.php";

  if(cek_login() === false){
    header('Location: login.php');
  }

  require_once "view/header.php";

  $error = '';

  $id = $_GET['id'];
  if (isset($_GET['id'])) {
    $article = tampilkan_per_id($id);
    while ($row = mysqli_fetch_assoc($article)) {
      $judul_awal = $row['judul'];
      $isi_awal = $row['isi'];
      $tag_awal = $row['tag'];
    }
  }

  // edit blog, check if submit button is set
  if (isset($_POST['submit'])) {
    $judul = mysqli_real_escape_string($connect, $_POST['judul']);
    $isi = mysqli_real_escape_string($connect, $_POST['isi']);
    $tag = mysqli_real_escape_string($connect, $_POST['tag']);

    // check if $judul and $isi is not empty, proceed to edit_data
    if (!empty(trim($judul).trim($isi))) {
      if (edit_data($judul, $isi, $tag, $id)) {
        header('Location: index.php')
      }
    } else {
      $error = 'judul dan konten harus di isi';
    }
  }

?>

<div class="container">

  <h1>Edit <?= $judul_awal ?></h1>

  <!-- edit blog form -->
  <form action="" method="post">
    <label for="judul">Judul</label> <br>
    <input type="text" name="judul" value="<?= $judul_awal ?>"> <br><br>

    <label for="isi">Isi</label> <br>
    <textarea name="isi" rows="4" cols="40"><?= $isi_awal ?></textarea> <br><br>

    <label for="tag">Tag</label> <br>
    <input type="text" name="tag" value="<?= $tag_awal ?>"> <br><br>

    <input type="submit" name="submit" value="submit">

    <div id="error"><?= $error ?></div> <br>
  </form>

</div>
