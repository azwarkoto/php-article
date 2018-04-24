<?php

  // function to run query
  function run($query) {
    global $connect;

    if(mysqli_query($connect, $query)) return true;
    else return false;
  }

  function result($query) {
    global $connect;

    if ($result = mysqli_query($connect, $query) or die("gagal menampilkan data")) {
      return $result;
    }
  }

  // show blog
  function tampilkan($start, $perPage) {
    $query = "SELECT * FROM blog LIMIT $start, $perPage";
    return result($query);
  }

  // show blog by ID
  function tampilkan_per_id($id) {
    $query = "SELECT * FROM blog WHERE id=$id";
    return result($query);
  }

  // search function
  function hasil_cari($search) {
    $query = "SELECT * FROM blog WHERE judul LIKE '%$search%'";
    return result($query);
  }

  // add blog
  function tambah_data($judul, $isi, $tag) {
    $query = "INSERT INTO blog (judul, isi, tag) VALUES ('$judul', '$isi', '$tag')";
    return run($query);
  }

  // edit blog
  function edit_data($judul, $isi, $tag, $id) {
    $query = "UPDATE blog SET judul='$judul', isi='$isi', tag='$tag' WHERE id=$id";
    return run($query);
  }

  // delete blog
  function hapus_data($id) {
    $query = "DELETE FROM blog WHERE id=$id";
    return run($query);
  }

  // excerpt string to limit text shown
  function excerpt($string) {
    $string = substr($string, 0, 40);
    return $string . "...";
  }



?>
