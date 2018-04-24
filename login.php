<?php
  require_once "core/init.php";

  if (cek_login() === true) {
    header('Location: index.php');
  } else {
  $error = '';

  if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    if (!empty(trim($username).trim($password))) {
      if (cek_data($username, $password)) {
        $_SESSION['user'] = $username;
        header('Location: index.php');
      } else {
        $error = "masalah saat login";
      }
    } else {
      $error = 'nama dan password wajib di isi';
    }
  }

  require_once "view/header.php";

?>

<div class="container">

  <h1>Login</h1>

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
