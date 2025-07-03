<?php
include "includes/db.php";
include "../bootstrap.php";
include "includes/layout/header.php";


$stmt = $connection->query("SELECT * FROM posts ORDER BY id DESC LIMIT 3");
$posts = $stmt->fetchAll();
// var_dump($posts);

$stmt = $connection->query("SELECT * FROM comments ORDER BY id DESC LIMIT 3");
$comments = $stmt->fetchAll();

$stmt = $connection->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();

if (isset($_GET['action'])) {

  if ($_GET['action'] == 'delete') {
    $id = $_GET['id'];
    if ($_GET['entity'] == "post") {
      $stmt = $connection->query("DELETE FROM posts WHERE id=$id");
      header("Location:index.php");
    } else if ($_GET['entity'] == "comment") {
      $stmt = $connection->query("DELETE FROM comments WHERE id=$id");
      header("Location:index.php");
    } else if ($_GET['entity'] == "categories") {
      $stmt = $connection->query("DELETE FROM categories WHERE id=$id");
      header("Location:index.php");
    }
  }
}

?>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar Section -->
    <?php include "includes/layout/sidebar.php" ?>
    <!-- Main Section -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="fs-3 fw-bold">داشبورد</h1>
      </div>

      <!-- Recently Posts -->
      <div class="mt-4">
        <h4 class="text-secondary fw-bold">مقالات اخیر</h4>
        <div class="table-responsive small">
          <table class="table table-hover align-middle">
            <thead>
              <tr>
                <th>id</th>
                <th>عنوان</th>
                <th>نویسنده</th>
                <th>عملیات</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($posts as $post): ?>
                <tr>
                  <th><?= $post['id'] ?></th>
                  <td><?= $post['title'] ?></td>
                  <td><?= $post['author'] ?></td>
                  <td>
                    <a href="#" class="btn btn-sm btn-outline-dark">ویرایش</a>
                    <a href="<?= ADMIN_URL_ROOT ?>index.php?action=delete&entity=post&id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-danger">حذف</a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Recently Comments -->
      <div class="mt-4">
        <h4 class="text-secondary fw-bold">کامنت های اخیر</h4>
        <div class="table-responsive small">
          <table class="table table-hover align-middle">
            <thead>
              <tr>
                <th>id</th>
                <th>نام</th>
                <th>متن کامنت</th>
                <th>عملیات</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($comments as $comment): ?>
                <tr>
                  <th><?= $comment['id'] ?></th>
                  <td><?= $comment['name'] ?></td>
                  <td><?= $comment['comment'] ?></td>
                  <td>
                    <?php if ($comment['status'] == 1): ?>
                      <a href="#" class="btn btn-sm btn-outline-dark disabled">تایید شده</a>
                    <?php else: ?>
                      <a href="/admin-panel/index.php?action=approve&entity=comment&id=<?= $comment['id'] ?>" class="btn btn-sm btn-outline-primary">در انتظار تایید</a>
                    <?php endif ?>
                    <a href="/admin-panel/index.php?action=delete&entity=comment&id=<?= $comment['id'] ?>" class="btn btn-sm btn-outline-danger">حذف</a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Categories -->
      <div class="mt-4">
        <h4 class="text-secondary fw-bold">دسته بندی</h4>
        <div class="table-responsive small">
          <table class="table table-hover align-middle">
            <thead>
              <tr>
                <th>id</th>
                <th>عنوان</th>
                <th>عملیات</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($categories as $category): ?>
                <tr>
                  <th><?= $category['id'] ?></th>
                  <td><?= $category['title'] ?></td>
                  <td>
                    <a href="#" class="btn btn-sm btn-outline-dark">ویرایش</a>
                    <a href="/admin-panel/index.php?action=delete&entity=category&id=<?= $category['id'] ?>" class="btn btn-sm btn-outline-danger">حذف</a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</div>
<?php include "includes/layout/footer.php" ?>