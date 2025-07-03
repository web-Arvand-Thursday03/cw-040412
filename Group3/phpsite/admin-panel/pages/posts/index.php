<?php
include "../../includes/layout/header.php";

$stmt = $connection->query("SELECT * FROM posts ORDER BY id DESC");
$posts = $stmt->fetchAll();



?>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar Section -->
    <?php include "../../includes/layout/sidebar.php" ?>

    <!-- Main Section -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="fs-3 fw-bold">مقالات</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
          <a href="<?= URL_ROOT ?>admin-panel/pages/posts/create.php" class="btn btn-sm btn-dark">
            ایجاد مقاله
          </a>
        </div>
      </div>

      <!-- Posts -->
      <div class="mt-4">
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
                    <a
                      href="./edit.html"
                      class="btn btn-sm btn-outline-dark">ویرایش</a>
                    <a
                      href="#"
                      class="btn btn-sm btn-outline-danger">حذف</a>
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

<?php include "../../includes/layout/footer.php" ?>