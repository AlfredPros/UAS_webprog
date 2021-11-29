<!DOCTYPE html>
<html>
<head>
    <?php
        echo $js;
        echo $css;
    ?>
    <title>Edit User</title>
</head>
<body>
    <?php
        echo $header;
    ?>

    <div class="container center md-10" style="padding-top:15px">
        <div class="row justify-content-end">
            <div class="text-center">
                <h1>
                    Edit User
                </h1>
            </div>
        </div>
        <hr>
    </div>

    <div class="container" style="margin-top: 35px;">
		<form class="col-md-4 offset-md-4" action="<?= base_url("index.php/home/do_edit_user") ?>" method="POST" enctype="multipart/form-data">
			<div class="mb-3">
				<input type="hidden" class="form-control" id="id_user" name="id_user" placeholder="Ya Yeet" value="<?= $user[0]['id_user'] ?>"> 
				<div style="color:red"><?= form_error('id_user'); ?></div>
			</div>
		
			<div class="mb-3">
				<label for="email">Email</label>
				<input type="hidden" class="form-control" id="email" name="email" placeholder="Ya Yeet" value="<?= $user[0]['email'] ?>"> 
				<input type="text" class="form-control" id="email" name="email" placeholder="Ya Yeet" value="<?= $user[0]['email'] ?>" disabled> 
				<div style="color:red"><?= form_error('email'); ?></div>
			</div>

			<div class="mb-3">
				<label for="name" style="margin-top:10px">Name</label>
				<input type="text" class="form-control" id="name" name="name" placeholder="" value="<?= $user[0]['name'] ?>"> 
				<div style="color:red"><?= form_error('name'); ?></div>
			</div>

			<div class="mb-3">
				<label for="role" style="margin-top:10px">Role</label>
				<select class="form-select" aria-label="Default select example" name="role" id="role">
					<option selected><?= $user[0]['role'] ?></option>
					<option value="Admin">Admin</option>
					<option value="Manager">Manager</option>
					<option value="User">User</option>
				</select>
				<div style="color:red"><?= form_error('role'); ?></div>
			</div>

			<p><input type="file"  accept="image/*" name="link_profile" id="file"  onchange="loadFile(event)" style="display: none;" value="<?= base_url($user[0]['link_profile']) ?>"></p>
			<p><label for="file" style="cursor: pointer;">Profile Picture</label></p>

			<div class="image-upload">
				<label for="file-input">
					<img for="file" id="output" width="200" src="<?= base_url($user[0]['link_profile']) ?>"/>
				</label>

				<input id="file-input" accept="image/*" type="file" style="cursor: pointer;" onchange="loadFile(event)"  name="link_profile" hidden />
			</div>

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
			<button type="submit" class="btn btn-primary" style="margin-right:10px">Edit User</button>
			<a href="<?= base_url('index.php/home') ?>" class="btn btn-danger" role="button">Cancel</a>
		</form>
	</div>
    <br>
    <br>
</body>
</html>