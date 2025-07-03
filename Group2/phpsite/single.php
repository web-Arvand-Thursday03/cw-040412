<?php
include "includes/db.php";
include "includes/layout/header.php";

$postId = $_GET['id'];
if (isset($_GET['id'])) {
  $stmt = $connection->query("SELECT posts.*,categories.title AS category_title
                          FROM posts,categories
                          WHERE posts.category_id=categories.id AND posts.id=$postId
                          ");
  $post = $stmt->fetch();

  // var_dump($post);
}

$stmt = $connection->query("SELECT * FROM comments WHERE post_id=$postId AND status=1");
$commentCount = $stmt->rowCount();
$comments = $stmt->fetchAll();

// var_dump($_POST);

$invalidName = "";
$invalidText = "";
$successfullInsert = "";

if (isset($_POST['insertComment'])) {
  $name = $_POST['name'];
  $newComment = $_POST['comment'];
  if (empty($name)) {
    $invalidName = "وارد کردن نام الزامیست";
  }
  if (empty($newComment)) {
    $invalidText = "وارد کردن کامنت الزامیست";
  }

  if (!empty($name) && !empty($newComment)) {
    $stmt = $connection->query("INSERT INTO comments (name,comment,post_id,status) 
                           VAlUES ('$name','$newComment','$postId',0)");
    $successfullInsert = "با تشکر! کامنت شما پس از تایید منتشر خواهد شد";
  }
}

?>

<main>
  <!-- Content -->
  <section class="mt-4">
    <div class="row">
      <!-- Posts & Comments Content -->
      <?php if (!empty($post)): ?>
        <div class="col-lg-8">
          <div class="row justify-content-center">
            <!-- Post Section -->
            <div class="col">
              <div class="card">
                <img src="./assets/images/<?= $post['image'] ?>" class="card-img-top" alt="post-image" />
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <h5 class="card-title fw-bold"><?= $post['title'] ?></h5>
                    <div>
                      <span class="badge text-bg-secondary"><?= $post['category_title'] ?></span>
                    </div>
                  </div>
                  <p class="card-text text-secondary text-justify pt-3">
                    <?= $post['body'] ?>
                  </p>
                  <div>
                    <p class="fs-6 mt-5 mb-0">نویسنده : <?= $post['author'] ?></p>
                  </div>
                </div>
              </div>
            </div>

            <hr class="mt-4" />

            <!-- Comment Section -->
            <div class="col">
              <!-- Comment Form -->
              <div class="card">
                <div class="card-body">
                  <p class="fw-bold fs-5">ارسال کامنت</p>

                  <form action="" method="post">
                    <div class="mb-3">
                      <label class="form-label">نام</label>
                      <input type="text" class="form-control" name="name" />
                      <div class="text-danger small"><?= $invalidName ?></div>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">متن کامنت</label>
                      <textarea class="form-control" rows="3" name="comment"></textarea>
                      <div class="text-danger small"><?= $invalidText ?></div>
                    </div>
                    <button type="submit" class="btn btn-dark" name="insertComment">ارسال</button>
                    <div class="text-success small"><?= $successfullInsert ?></div>
                  </form>
                </div>
              </div>

              <hr class="mt-4" />
              <!-- Comment Content -->
              <p class="fw-bold fs-6">تعداد کامنت : <?= $commentCount ?></p>
              <?php if ($commentCount == 0): ?>
                <div class="alert alert-success">شما نخستین فردی باشید که نظر میدهد</div>
              <?php else: ?>
                <?php foreach ($comments as $comment): ?>
                  <div class="card bg-light-subtle mb-3">
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        <img src="./assets/images/profile.png" width="45" height="45" alt="user-profle" />

                        <h5 class="card-title me-2 mb-0"><?= $comment['name'] ?></h5>
                      </div>

                      <p class="card-text pt-3 pr-3"><?= $comment['comment'] ?></p>
                    </div>
                  </div>
                <?php endforeach ?>
              <?php endif ?>
            </div>
          </div>
        </div>
      <?php else: ?>
        <div class="col-lg-8">
          <div class="alert alert-danger">مقاله مورد نظر پیدا نشد !!!!</div>
        </div>
      <?php endif ?>
      <!-- Sidebar Section -->
      <?php include "includes/layout/sidebar.php"; ?>
    </div>
  </section>
</main>

<!-- Footer -->
<?php include "includes/layout/footer.php"; ?>