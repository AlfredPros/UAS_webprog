<!DOCTYPE html>
<html>
<head>
    <?php
        echo $js;
        echo $css;
    ?>
    <title>Add Book</title>
</head>
<body>
    <?php
        echo $header;
    ?>

    <div class="container center md-10" style="padding-top:15px">
        <div class="row justify-content-end">
            <div class="text-center">
                <h1>
                    Add Book
                </h1>
            </div>
        </div>
        <hr>
    </div>

    <div class="container" style="margin-top: 35px;">
		<form class="col-md-4 offset-md-4" action="<?= base_url("index.php/home/do_add_book") ?>" method="POST" enctype="multipart/form-data">
			<div class="mb-3">
				<label for="Title">Title</label>
				<input type="text" class="form-control" id="Title" name="title" placeholder="Ya Yeet" value="<?= set_value("title") ?>"> 
				<div style="color:red"><?= form_error('Title'); ?></div>
			</div>

			<div class="mb-3">
				<label for="Year" style="margin-top:10px">Year</label>
				<input type="number" class="form-control" id="Year" name="year" placeholder="2021" value="<?= set_value("year") ?>"> 
				<div style="color:red"><?= form_error('Year'); ?></div>
			</div>

			<div class="mb-3">
				<label for="Publisher" style="margin-top:10px">Publisher</label>
				<input type="text" class="form-control" id="Publisher" name="publisher" placeholder="No one" value="<?= set_value("publisher") ?>"> 
				<div style="color:red"><?= form_error('Publisher'); ?></div>
			</div>

            <div class="mb-3">
				<label for="Author" style="margin-top:10px">Author</label>
				<input type="text" class="form-control" id="Author" name="author" placeholder="No one" value="<?= set_value("author") ?>"> 
				<div style="color:red"><?= form_error('Author'); ?></div>
			</div>

			<div class="mb-3">
				<label for="description">Description</label>
				<textarea class="form-control" id="description" name="description" placeholder="Ya Yeet" value="<?= set_value('description') ?>" rows="4"></textarea>
				<div style="color:red"><?= form_error('description'); ?></div>
			</div>

			<div class="mb-3">
				<label for="PosterLink" style="margin-top:10px">Cover</label>
				<input type="file" class="form-control" id="PosterLink" name="link_cover" value="<?= set_value("link_cover") ?>"> 
				<?php if (isset($error)) { ?>
					<div style="color:red"><?= $error['error']; ?></div>
				<?php } ?>
			</div>
			
			<br>
			<button type="submit" class="btn btn-primary" style="margin-right:10px">Add Book</button>
			<a href="<?= base_url('index.php/home/book_list') ?>" class="btn btn-danger" role="button">Cancel</a>
		</form>
	</div>
    <br>
    <br>
</body>
</html>