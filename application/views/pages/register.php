<!DOCTYPE html>
<html>
<head>
    <?php
        echo $js;
        echo $css;
    ?>
    <title>Register</title>

	<!-- Recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LePRGcdAAAAAMph8kCaVrkCIIv4P14m0Rmez5xp"></script>

    <script>
        //function onSubmit(token) {
        //    document.getElementById("demo-form").submit();
        //}
        
        grecaptcha.ready(function() {
            grecaptcha.execute('6LePRGcdAAAAAMph8kCaVrkCIIv4P14m0Rmez5xp', {action: 'add_name'}).then(function(token) {
                // Add your logic to submit to your backend server here.
                $('#formToken').val(token);
                $('#formAction').val('add_name');
            });
        });
    </script>

    <style>
        .grecaptcha-badge { 
            visibility: hidden;
        }
    </style>
</head>
<body>
    <?php
        echo $header;
    ?>

	<div class="container col-md-3 center" style="margin-top: 35px;">
        <div class="row text-center" style="margin-top:26px">
            <h2>Register</h2>
        </div>
		<form action="<?= base_url("index.php/home/do_register") ?>" method="POST" style="margin-top:26px" enctype="multipart/form-data">
			<div class="row">
				<input type="email" class="form-control" id="email" name="email" placeholder="E-mail address" value="<?= set_value("email") ?>"> 
				<div style="color:red"><?= form_error('email'); ?></div>
			</div>

			<div class="row">
				<input type="password" class="form-control" id="password" name="password" placeholder="password" value="<?= set_value("password") ?>"> 
				<div style="color:red"><?= form_error('password'); ?></div>
			</div>

            <div class="row">
				<input type="text" class="form-control" id="name" name="name" placeholder="Kimi no nawa" value="<?= set_value("name") ?>"> 
				<div style="color:red"><?= form_error('name'); ?></div>
			</div>
            
            <div class="row">
				<input type="file" class="form-control" id="link_profile" name="link_profile" value="<?= set_value("link_profile") ?>"> 
				<?php if (isset($error)) { ?>
					<div style="color:red"><?= $error['error']; ?></div>
				<?php } ?>
			</div>

			<input type="hidden" name="token" id="formToken">
            <input type="hidden" name="action" id="formAction">

			<div class="row" style="margin-top:26px">
				<button type="submit" class="btn btn-primary" style="margin-right:10px">Register</button>
			</div>
			<div class="row" style="margin-top:8px">
				<a href="<?= base_url('index.php/home') ?>" class="btn btn-secondary" role="button">Cancel</a>
			</div>
		</form>
        <hr style="margin-top:26px">
        <div class="row" style="margin-top:6px">
            <p>This site is protected by reCAPTCHA Enterprise and the Google <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a href="https://policies.google.com/terms">Terms of Service</a> apply.</p>
        </div>
	</div>

    <br>
    <br>
</body>
</html>