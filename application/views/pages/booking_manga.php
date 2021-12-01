<!DOCTYPE html>
<html>

<head>
	<?php
	echo $js;
	echo $css;
	?>

	<title>Booking Manga - MangaBook</title>
	<link rel="icon" href="<?= base_url('assets/images/ThumbnailLogo.png') ?>">

	<style>
		body {
			color: #C90000;
		}

		.red-btn {
			background-color: #C90000;
			color: white;
			transition: 0.3s;
		}

		.red-btn:hover {
			background-color: #A00000;
			color: white;
		}

		.red-outline-btn {
			border: 1px solid #C90000;
			color: #C90000;
			transition: 0.3s;
		}

		.red-outline-btn:hover {
			background-color: #C90000;
			color: white;
		}

		a {
			text-decoration: none;
		}
	</style>
</head>

<body>
	<?php
	echo $header;
	?>

	<div class="container-fluid" style="margin-top:28px">
		<div class="row justify-content-end">
			<div class="text-center">
				<h1>
					Booking Manga
				</h1>
			</div>
		</div>
	</div>
	<hr>

	<div class="container" style="margin-top: 35px;">
		<?php if (isset($_SESSION['alert'])) { ?>
			<p style="color:red" class="text-center"><?= $_SESSION['alert'] ?></p>
		<?php unset($_SESSION['alert']);
		} ?>

		<form class="col-md-4 offset-md-4" action="<?= base_url("index.php/home/do_booking_manga") ?>" method="POST">
			<div class="mb-3 text-center">
				<label for="id_book">Manga ID</label>
				<input type="text" class="form-control" id="id_book" name="id_book" placeholder="Ya Yeet" value="<?= $book[0]['id_book'] ?>" disabled>
				<input type="hidden" class="form-control" id="id_book" name="id_book" value="<?= $book[0]['id_book'] ?>">
				<input type="hidden" class="form-control" id="id_user" name="id_user" value="<?= $_SESSION['id'] ?>">
				<div style="color:red"><?= form_error('id_book'); ?></div>
				<div style="color:red"><?= form_error('id_user'); ?></div>
			</div>

			<div class="mb-3 text-center">
				<label for="start_time">Borrow Date</label>
				<input type="date" class="form-control" id="start_time" name="start_time" placeholder="dd-mm-yyyy" value="<?= set_value("start_time") ?>">
				<div style="color:red"><?= form_error('start_time'); ?></div>
			</div>

			<div class="mb-3 text-center">
				<label for="end_time">Return Date</label>
				<input type="date" class="form-control" id="end_time" name="end_time" placeholder="dd-mm-yyyy" value="<?= set_value("end_time") ?>">
				<div style="color:red"><?= form_error('end_time'); ?></div>
			</div>
			<br>
			<div class="text-center">
				<button type="submit" class="btn red-btn" style="margin-right:10px">Add Book</button>
				<a href="<?= base_url('index.php/home/book_list') ?>" class="btn red-outline-btn" role="button">Cancel</a>
			</div>
		</form>
	</div>
	<br>
	<br>
</body>

</html>