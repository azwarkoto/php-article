<?php
  require_once "core/init.php";

  if (cek_login() === true) {
    header('Location: index.php');
  } else {
  $error = '';

  if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    // make sure if username and password is not empty
    if (!empty(trim($username).trim($password))) {
      // check if username taken
      if (register_cek($username)) {
        // register the user
        if (register_user($username, $password)) {
          $_SESSION['user'] = $username;
          header('Location: index.php');
        } else {
          $error = 'ada masalah saat daftar.';
        }
      } else {
        $error = 'nama yang didaftarkan sudah ada, pilih nama lain';
      }
    } else {
      $error = 'isi nama dan password';
    }

  }

  require_once "view/header.php";

?>

<div class="container">

  <h1>Register</h1>

  <!-- register form input -->
  <form action="" method="post">
    <label for="username">username</label> <br>
    <input type="text" name="username" value=""> <br><br>

    <label for="password">password</label> <br>
    <input type="password" name="password"></input> <br><br>

    <input type="submit" name="submit" value="submit">

    <div id="error"><?= $error ?></div> <br>
  </form>

</div>

<?php } ?>
