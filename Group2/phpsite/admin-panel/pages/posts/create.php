<?php
include "../../includes/layout/header.php";


$stmt = $connection->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();





$invalidTitle = "";
$invalidBody = "";
$invalidAuthor = "";
$invalidImage = "";
if (isset($_POST['createPost'])) {
  $title = $_POST['title'];
  $body = $_POST['body'];
  $category_id = $_POST['category_id'];
  $author = $_POST['author'];

  if (empty($title)) {
    $invalidTitle = "فیلد عنوان الزامی است";
  }
  if (empty($author)) {
    $invalidAuthor = "فیلد نویسنده الزامی است";
  }
  if (empty($body)) {
    $invalidBody = "فیلد بدنه الزامی است";
  }
  if (!isset($_FILES['image'])) {
    $invalidImage = "فیلد عکس الزامی است";
  }

  if (!empty($title) && !empty($author) && !empty($body) && isset($_FILES['image']))
    $stmt = $connection->query("INSERT INTO posts (title,body,category_id,author,image) 
                              VALUES ('$title','$body','$category_id','$author','4.jpg')");
}

?>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar Section -->
    <?php include BASE_DIR . "/admin-panel/includes/layout/sidebar.php" ?>


    <!-- Main Section -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="fs-3 fw-bold">ایجاد مقاله</h1>
      </div>

      <!-- Posts -->
      <div class="mt-4">
        <form class="row g-4" method="post" action="" enctype="multipart/form-data">
          <div class="col-12 col-sm-6 col-md-4">
            <label class="form-label">عنوان مقاله</label>
            <input type="text" class="form-control" name="title" />
            <div class="text-danger small"><?= $invalidTitle ?></div>
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <label class="form-label">نویسنده مقاله</label>
            <input type="text" class="form-control" name="author" />
            <div class="text-danger small"><?= $invalidAuthor ?></div>
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <label class="form-label">دسته بندی مقاله</label>
            <select class="form-select" name="category_id">
              <option value="0"> انتخاب کنید ... </option>
              <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <label for="formFile" class="form-label">تصویر مقاله</label>
            <input class="form-control" type="file" name="image" />
            <div class="text-danger small"><?= $invalidImage ?></div>
          </div>

          <div class="col-12">
            <label for="formFile" class="form-label">متن مقاله</label>
            <textarea
              class="form-control"
              rows="6"
              name="body"></textarea>
            <div class="text-danger small"><?= $invalidBody ?></div>
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-dark" name="createPost">
              ایجاد
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</div>

<?php include BASE_DIR . "/admin-panel/includes/layout/footer.php" ?>