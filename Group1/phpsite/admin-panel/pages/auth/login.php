<?php
session_start();
include "../../../bootstrap.php";
include "../../includes/db.php";

// var_dump($_POST);
if (isset($_POST['loginBtn'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $stmt = $connection->query("SELECT * FROM users WHERE email='$email' AND password='$password'");

  if ($stmt->rowCount() == 1) {
    $_SESSION['email'] = $email;
    header("Location:" . ADMIN_URL_ROOT);
  } else {
    header("Location: login.php?err_msg=نام کاربری یا رمز عبور اشتباه است");
  }
}


?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>php tutorial || blog project || compidan.ir</title>

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
    crossorigin="anonymous" />

  <link rel="stylesheet" href="../../assets/css/style.css" />
</head>

<body class="auth">
  <main class="form-signin w-100 m-auto">
    <?php if (isset($_GET['err_msg'])): ?>
      <div class="alert alert-danger"> <?= $_GET['err_msg'] ?></div>
    <?php endif ?>
    <form method="post" action="">
      <div class="fs-2 fw-bold text-center mb-4">compidan.ir</div>
      <div class="mb-3">
        <label class="form-label">ایمیل</label>
        <input type="email" class="form-control" name="email" />
      </div>

      <div class="mb-3">
        <label class="form-label">رمز عبور</label>
        <input type="password" class="form-control" name="password" />
      </div>
      <button class="w-100 btn btn-dark mt-4" type="submit" name="loginBtn">
        ورود
      </button>
    </form>
  </main>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
</body>

</html>