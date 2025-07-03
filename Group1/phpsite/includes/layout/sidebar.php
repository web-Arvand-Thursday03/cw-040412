<?php

// var_dump($categories);
// var_dump($_GET);
$invalidName = "";
$invalidEmail = "";
$successfulSubscriberInsert = "";
if (isset($_POST['addSubscriber'])) {
	if (empty($_POST['name'])) {
		$invalidName = "نام الزامی است";
	}
	if (empty($_POST['email'])) {
		$invalidEmail = "درج ایمیل الزامی است";
	}
	$name = $_POST['name'];
	$email = $_POST['email'];
	if (!empty($_POST['name']) && !empty($_POST['email'])) {
		$stmt = $connection->query("INSERT INTO subscribers (name,email) VALUES ('$name','$email')");
		$successfulSubscriberInsert = "تبریک! عضویت شما با موفقیت انجام شد";
	}
}

?>
<div class="col-lg-4">
	<!-- Search Section -->
	<div class="card">
		<p class="fw-bold fs-6 card-header text-center">جستجو در سایت</p>
		<div class="card-body">
			<form action="search.php" method="get">
				<div class="input-group mb-3">
					<input type="text" class="form-control" placeholder="جستجو ..." name="search" />
					<button class="btn btn-secondary" type="submit">
						<i class="bi bi-search"></i>
					</button>
				</div>
			</form>
		</div>
	</div>

	<!-- Categories Section -->
	<div class="card mt-4">
		<div class="fw-bold fs-6 card-header text-center">دسته بندی ها</div>
		<ul class="list-group list-group-flush p-0">
			<ul class="list-group list-group-flush p-0">
				<?php foreach ($categories as $category): ?>
					<li class="list-group-item">
						<a class="link-body-emphasis text-decoration-none" href="index.php?id=<?= $category['id'] ?>">
							<?= $category['title'] ?>
						</a>
					</li>
				<?php endforeach ?>
			</ul>
		</ul>
	</div>

	<!-- Subscribe Section -->
	<div class="card mt-4">
		<p class="fw-bold fs-6 card-header text-center">عضویت در خبرنامه</p>
		<div class="card-body">
			<form method="post">
				<div class="mb-3">
					<label class="form-label">نام</label>
					<input type="text" class="form-control" name="name" />
					<p class="text-danger fs-6"><?= $invalidName ?></p>
				</div>
				<div class="mb-3">
					<label class="form-label">رایانامه</label>
					<input type="email" class="form-control" name="email" />
					<p class="text-danger fs-6"><?= $invalidEmail ?></p>
				</div>
				<div class="d-grid gap-2">
					<button type="submit" class="btn btn-secondary" name="addSubscriber">ارسال</button>
					<p class="text-success fs-6"><?= $successfulSubscriberInsert ?></p>
				</div>
			</form>
		</div>
	</div>

	<!-- About Section -->
	<div class="card mt-4">
		<p class="fw-bold fs-6 card-header text-center">درباره ما</p>
		<div class="card-body">
			<p class="text-justify">
				وظیفه اصلی یک مدرس در حوزه فناوری، کاهش زمان و انرژی لازم برای موفق شدن دانش پذیرانش است. برای رسیدن به این مهم باید از مشاور و مدرسی آموزش دید که یک متخصص
				واقعی با تجربه‌های بزرگ در شرکت‌های مطرح باشد و چالش‌های متفاوتی را در نرم افزارهای سطح بالا به صورت واقعی تجربه کرده باشد. افتخار می‌کنیم با مدرسینی همکاری
				داریم که متخصص و به شدت با تجربه هستند و در بزرگترین شرکت‌های نرم افزاری ایران تجربه کار جدی داشته اشته اند.
			</p>
		</div>
	</div>
</div>