<?php

include "../../includes/layout/header.php";



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
  if (empty($body)) {
    $invalidBody = " بدنه مقاله الزامی است";
  }
  if (empty($author)) {
    $invalidAuthor = " نویسنده مقاله الزامی است";
  }
  if (empty($_FILES['image']['name'])) {
    $invalidImage = " بارگذاری عکس الزامی است";
  }

  if (!empty($title) && !empty($body) && !empty($author) && !empty($_FILES['image']['name'])) {
    $stmt = $connection->query("INSERT INTO posts (title,body,category_id,author,image) 
                            VALUES ('$title','$body',$category_id,'$author','5.jpg')");
    header("Location:" . URL_ROOT . "/admin-panel/pages/posts/index.php");
  }
}

?>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar Section -->
    <?php include "../../includes/layout/sidebar.php" ?>

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
              <option value="1">طبیعت</option>
              <option value="2">گردشگری</option>
              <option value="3">تکنولوژی</option>
              <option value="4">متفرقه</option>
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

<?php include "../../includes/layout/footer.php" ?>