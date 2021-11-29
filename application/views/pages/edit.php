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
		<form class="col-md-4 offset-md-4" action="<?= base_url("index.php/home/do_edit_user") ?>" method="POST" enctype="multipart/form-data">
			<div class="mb-3">
				<label for="id_buku">Book ID</label>
				<input type="text" class="form-control" id="id_buku" name="id_buku" placeholder="Ya Yeet" value="<?= $buku[0]['id_buku'] ?>" disabled> 
				<input type="hidden" class="form-control" id="id_buku" name="id_buku" placeholder="Ya Yeet" value="<?= $buku[0]['id_buku'] ?>"> 
				<div style="color:red"><?= form_error('id_buku'); ?></div>
			</div>
		
			<div class="mb-3">
				<label for="Title">Title</label>
				<input type="text" class="form-control" id="Title" name="Title" placeholder="Ya Yeet" value="<?= $buku[0]['judul_buku'] ?>"> 
				<div style="color:red"><?= form_error('Title'); ?></div>
			</div>

			<div class="mb-3">
				<label for="Year" style="margin-top:10px">Year</label>
				<input type="number" class="form-control" id="Year" name="Year" placeholder="2021" value="<?= $buku[0]['tahun_terbit'] ?>"> 
				<div style="color:red"><?= form_error('Year'); ?></div>
			</div>

			<div class="mb-3">
				<label for="Publisher" style="margin-top:10px">Publisher</label>
				<input type="text" class="form-control" id="Publisher" name="Publisher" placeholder="No one" value="<?= $buku[0]['penerbit_buku'] ?>"> 
				<div style="color:red"><?= form_error('Publisher'); ?></div>
			</div>

            <div class="mb-3">
				<label for="Author" style="margin-top:10px">Author</label>
				<input type="text" class="form-control" id="Author" name="Author" placeholder="No one" value="<?= $buku[0]['penulis_buku'] ?>"> 
				<div style="color:red"><?= form_error('Author'); ?></div>
			</div>

			<!--
			<div class="mb-3">
				<label for="PosterLink" style="margin-top:10px">Poster</label>
				<input type="file" class="form-control" id="PosterLink" name="PosterLink" value="<?= set_value("PosterLink") ?>"> 
				<?php if (isset($error)) { ?>
					<div style="color:red"><?= $error['error']; ?></div>
				<?php } ?>
			</div>
			-->

			<p><input type="file"  accept="image/*" name="PosterLink" id="file"  onchange="loadFile(event)" style="display: none;" value="<?= base_url($buku[0]['link_poster']) ?>"></p>
			<p><label for="file" style="cursor: pointer;">Poster</label></p>
			<p><img id="output" width="200" src="<?= base_url($buku[0]['link_poster']) ?>"/></p>
			<?php if (isset($error)) { ?>
				<div style="color:red"><?= $error['error']; ?></div>
			<?php } ?>

			<script>
			var loadFile = function(event) {
				var image = document.getElementById('output');
				image.src = URL.createObjectURL(event.target.files[0]);
			};
			</script>
			
			<br>
			<button type="submit" class="btn btn-primary" style="margin-right:10px">Edit Book</button>
			<a href="<?= base_url('index.php/home') ?>" class="btn btn-danger" role="button">Cancel</a>
		</form>
	</div>
    <br>
    <br>
</body>
</html>