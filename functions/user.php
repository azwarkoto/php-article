<?php

  // auth $username and $password to login the user
  function cek_data($username, $password) {
    global $connect;

    $password = md5($password);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";

    if ($result = mysqli_query($connect, $query)) {
      if (mysqli_num_rows($result) != 0) return true;
      else return false;
    }
  }

  // check if user has been logged in or not
  function cek_login() {
    return (isset($_SESSION['user'])) ? true : false;
  }

  // check user status to limit their action
  // 0 = admin can edit, delete
  // 1 = normal user only edit, can not delete
  // if cek_login false, do not show action
  function cek_status($username) {
    global $connect;

    $query = "SELECT * FROM users WHERE username='$username'";

    if ($result = mysqli_query($connect, $query)) {
      while ($row = mysqli_fetch_assoc($result)) {
        $status = $row['status'];
      }
      return $status;
    }
  }

  // check if username taken, then proceed to register_user if true
  function register_cek($username) {
    global $connect;

    $query = "SELECT * FROM users WHERE username='$username'";

    if ($result = mysqli_query($connect, $query)) {
      if (mysqli_num_rows($result) == 0) return true;
      else return false;
    }
  }

  // register user to database
  function register_user($username, $password) {
    global $connect;

    $password = md5($password);

    $query = "INSERT INTO users(username, password, status) VALUES ('$username', '$password', 1)";
    return run($query);
  }


?>
