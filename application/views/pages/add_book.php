<!DOCTYPE html>
<html>

<head>
	<?php
	echo $js;
	echo $css;
	?>

	<title>Add Manga - MangaBook</title>
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
	</style>
</head>

<body>
	<?php
	echo $header;
	?>

	<div class="container-fluid" style="margin-top:28px">
		<div class="row">
			<h1 class="text-center">
				Add Manga
			</h1>
		</div>
	</div>
	<hr>
	<div class="container text-center" style="margin-top: 35px;">
		<form class="col-md-4 offset-md-4" action="<?= base_url("index.php/home/do_add_book") ?>" method="POST" enctype="multipart/form-data">
			<div class="mb-3">
				<label for="Title">Title</label>
				<input type="text" class="form-control" id="Title" name="title" placeholder="Title" value="<?= set_value("title") ?>">
				<div style="color:red"><?= form_error('title'); ?></div>
			</div>

			<div class="mb-3">
				<label for="Year" style="margin-top:10px">Year</label>
				<input type="number" class="form-control" id="Year" name="year" placeholder="2021" value="<?= set_value("year") ?>">
				<div style="color:red"><?= form_error('year'); ?></div>
			</div>

			<div class="mb-3">
				<label for="Publisher" style="margin-top:10px">Publisher</label>
				<input type="text" class="form-control" id="Publisher" name="publisher" placeholder="Publisher" value="<?= set_value("publisher") ?>">
				<div style="color:red"><?= form_error('publisher'); ?></div>
			</div>

			<div class="mb-3">
				<label for="Author" style="margin-top:10px">Author</label>
				<input type="text" class="form-control" id="Author" name="author" placeholder="Author" value="<?= set_value("author") ?>">
				<div style="color:red"><?= form_error('author'); ?></div>
			</div>

			<div class="mb-3">
				<label for="description">Description</label>
				<textarea class="form-control" id="description" name="description" placeholder="Description" value="<?= set_value('description') ?>" rows="4"></textarea>
				<div style="color:red"><?= form_error('description'); ?></div>
			</div>

			<div class="mb-3">
				<label for="PosterLink" style="margin-top:8px">Manga Cover</label>
				<input type="file" class="form-control" id="PosterLink" name="link_cover" value="<?= set_value("link_cover") ?>">
				<?php if (isset($error)) { ?>
					<div style="color:red"><?= $error['error']; ?></div>
				<?php } ?>
			</div>

			<br>
			<button type="submit" class="btn red-btn" style="margin-right:10px">Add Book</button>
			<a href="<?= base_url('index.php/home/book_list') ?>" class="btn red-outline-btn" role="button">Cancel</a>
		</form>
	</div>
	<br>
	<br>
</body>
</html>