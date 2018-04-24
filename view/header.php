<head>
  <title>Belajar</title>
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link rel="stylesheet" href="view/style.css">
</head>

<nav>
  <ul>
    <div class="container">
      <li><a href="index.php">Home</a></li>
      <li><a href="add.php">Add</a></li>
      <?php if (cek_login() === true): ?>
        <li>Hello, <a href="#"><?= $_SESSION['user']; ?></a></li>
        <li class='logout'><a href='logout.php'>Logout</a></li>
      <?php endif; ?>
      <?php if (cek_login() === false): ?>
        <li><a href="register.php">Register</a></li>
        <li class='logout'><a href='logout.php'>Login</a></li>
      <?php endif; ?>
    </div>
  </ul>
</nav>
