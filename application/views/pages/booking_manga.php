<!DOCTYPE html>
<html>
<head>
    <?php
        echo $js;
        echo $css;
    ?>
    <title>Booking Manga</title>
</head>
<body>
    <?php
        echo $header;
    ?>

    <div class="container center md-10" style="padding-top:15px">
        <div class="row justify-content-end">
            <div class="text-center">
                <h1>
					Booking Manga
                </h1>
            </div>
        </div>
        <hr>
    </div>

    <div class="container" style="margin-top: 35px;">
		<?php if (isset($_SESSION['alert'])) { ?>
			<p style="color:red" class="text-center"><?= $_SESSION['alert'] ?></p>
		<?php unset($_SESSION['alert']); } ?>

		<form class="col-md-4 offset-md-4" action="<?= base_url("index.php/home/do_booking_manga") ?>" method="POST">
			<div class="mb-3">
				<label for="id_book">Manga ID</label>
				<input type="text" class="form-control" id="id_book" name="id_book" placeholder="Ya Yeet" value="<?= $book[0]['id_book'] ?>" disabled> 
				<input type="hidden" class="form-control" id="id_book" name="id_book" value="<?= $book[0]['id_book'] ?>"> 
				<input type="hidden" class="form-control" id="id_user" name="id_user" value="<?= $_SESSION['id'] ?>"> 
				<div style="color:red"><?= form_error('id_book'); ?></div>
				<div style="color:red"><?= form_error('id_user'); ?></div>
			</div>

			<div class="mb-3">
				<label for="start_time">Borrow Date</label>
				<input type="date" class="form-control" id="start_time" name="start_time" placeholder="dd-mm-yyyy" value="<?= set_value("start_time") ?>"> 
				<div style="color:red"><?= form_error('start_time'); ?></div>
			</div>

			<div class="mb-3">
				<label for="end_time">Return Date</label>
				<input type="date" class="form-control" id="end_time" name="end_time" placeholder="dd-mm-yyyy" value="<?= set_value("end_time") ?>"> 
				<div style="color:red"><?= form_error('end_time'); ?></div>
			</div>
		
			<button type="submit" class="btn btn-primary" style="margin-right:10px">Add Book</button>
			<a href="<?= base_url('index.php/home/book_list') ?>" class="btn btn-danger" role="button">Cancel</a>
		</form>
	</div>
    <br>
    <br>
</body>
</html>