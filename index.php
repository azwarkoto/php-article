<?php
  require_once "core/init.php";

  // check login
  if (cek_login() === true) {
    if (cek_status($_SESSION['user']) == 0) {
      $superuser = true;
    } else {
      $superuser = false;
    }
  }

  // pagination code
  $perPage = 4;
  $page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
  $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
  $articles = tampilkan($start, $perPage);

  $result = mysqli_query($connect, "SELECT * FROM blog");
  $total = mysqli_num_rows($result);

  $pages = ceil($total/$perPage);

  // search article
  if (isset($_GET['search'])) {
    $search   = $_GET['search'];
    $articles = hasil_cari($search);
  }

  require_once "view/header.php";
?>

<div class="container">

  <h1>Blog List</h1>

  <!-- search form input -->
  <form method="get" class="search">
    <input type="search" name="search" placeholder="Cari blog disini ..">
  </form>

  <!-- output articles -->
  <?php while ($row = mysqli_fetch_assoc($articles)):?>
    <div class="article">
      <h3><a href="single.php?id=<?= $row['id'] ?>"><?= $row['judul']; ?></a></h3>
      <p><?= excerpt($row['isi']); ?></p>
      <p class="waktu"><?= $row['waktu']; ?></p>
      <p class="tag"><?= $row['tag']; ?></p>
      <?php if (cek_login() === true): ?>
        <a href="edit.php?id=<?= $row['id']; ?>">Edit</a>
        <?php if ($superuser === true): ?>
          <a href="delete.php?id=<?= $row['id']; ?>">Delete</a>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  <?php endwhile; ?>

  <!-- pagination -->
  <div class="pagination">
    <?php for ($i=1; $i <= $pages ; $i++) { ?>
      <a href="?halaman=<?= $i ?>"><?= $i ?></a>
    <?php } ?>
  </div>

</div>

<?php
  require_once "view/footer.php";
?>
