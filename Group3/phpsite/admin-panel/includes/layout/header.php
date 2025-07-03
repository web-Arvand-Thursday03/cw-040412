<?php
include __DIR__ . "/../../../bootstrap.php";
include __DIR__ . "/../../../includes/db.php";

$path = $_SERVER['REQUEST_URI'];

?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>php tutorial || blog project || compidan.ir</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <!-- <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
      crossorigin="anonymous"
    /> -->
  <link rel="stylesheet" href="../../assets/css/bootstrap.css">
  <?php if (str_contains($path, 'pages')): ?>
    <link rel="stylesheet" href="../../assets/css/style.css" />
  <?php else: ?>
    <link rel="stylesheet" href="./assets/css/style.css" />
  <?php endif ?>
</head>

<body>
  <header class="navbar sticky-top bg-secondary flex-md-nowrap p-0 shadow-sm">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-5 text-white" href="/admin-panel/index.php">پنل ادمین</a>

    <button class="ms-2 nav-link px-3 text-white d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
      <i class="bi bi-justify-left fs-2"></i>
    </button>
  </header>