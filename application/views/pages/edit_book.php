<!DOCTYPE html>
<html>
<head>
    <?php
        echo $js;
        echo $css;
    ?>
    <title>Edit Book</title>
</head>
<body>
    <?php
        echo $header;
    ?>

    <div class="container center md-10" style="padding-top:15px">
        <div class="row justify-content-end">
            <div class="text-center">
                <h1>
                    Edit Book
                </h1>
            </div>
        </div>
        <hr>
    </div>

    <div class="container" style="margin-top: 35px;">
		<form class="col-md-4 offset-md-4" action="<?= base_url("index.php/home/do_edit_book") ?>" method="POST" enctype="multipart/form-data">
			<div class="mb-3">
				<label for="id_book">Manga ID</label>
				<input type="text" class="form-control" id="id_book" name="id_book" placeholder="Ya Yeet" value="<?= $book[0]['id_book'] ?>" disabled> 
				<input type="hidden" class="form-control" id="id_book" name="id_book" placeholder="Ya Yeet" value="<?= $book[0]['id_book'] ?>"> 
				<div style="color:red"><?= form_error('id_book'); ?></div>
			</div>
		
			<div class="mb-3">
				<label for="Title">Title</label>
				<input type="text" class="form-control" id="title" name="title" placeholder="Ya Yeet" value="<?= $book[0]['title'] ?>"> 
				<div style="color:red"><?= form_error('title'); ?></div>
			</div>

			<div class="mb-3">
				<label for="Year" style="margin-top:10px">Year</label>
				<input type="number" class="form-control" id="year" name="year" placeholder="2021" value="<?= $book[0]['year'] ?>"> 
				<div style="color:red"><?= form_error('year'); ?></div>
			</div>

			<div class="mb-3">
				<label for="Publisher" style="margin-top:10px">Publisher</label>
				<input type="text" class="form-control" id="publisher" name="publisher" placeholder="No one" value="<?= $book[0]['publisher'] ?>"> 
				<div style="color:red"><?= form_error('publisher'); ?></div>
			</div>

            <div class="mb-3">
				<label for="author" style="margin-top:10px">Author</label>
				<input type="text" class="form-control" id="author" name="author" placeholder="No one" value="<?= $book[0]['author'] ?>"> 
				<div style="color:red"><?= form_error('author'); ?></div>
			</div>

			<div class="mb-3">
				<label for="description">Description</label>
				<textarea class="form-control" id="description" name="description" placeholder="Ya Yeet" rows="4"><?= $book[0]['description'] ?></textarea>
				<div style="color:red"><?= form_error('description'); ?></div>
			</div>

			<p><input type="file"  accept="image/*" name="link_cover" id="file"  onchange="loadFile(event)" style="display: none;" value="<?= base_url($book[0]['link_cover']) ?>"></p>
			<p><label for="file" style="cursor: pointer;">Manga Cover</label></p>

			<div class="image-upload">
				<label for="file-input">
					<img for="file" id="output" width="200" src="<?= base_url($book[0]['link_cover']) ?>"/>
				</label>

				<input id="file-input" accept="image/*" type="file" style="cursor: pointer;" onchange="loadFile(event)"  name="link_cover" hidden />
			</div>

			<script>
			var loadFile = function(event) {
				var image = document.getElementById('output');
				image.src = URL.createObjectURL(event.target.files[0]);
			};
			</script>
			
			<br>
			<button type="submit" class="btn btn-primary" style="margin-right:10px">Edit Book</button>
			<a href="<?= base_url('index.php/home/book_list') ?>" class="btn btn-danger" role="button">Cancel</a>
		</form>
	</div>
    <br>
    <br>
</body>
</html>