<!DOCTYPE html>
<html>
<head>
    <?php
        echo $js;
        echo $css;
    ?>
    <title>Add Book</title>

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
            <h2>Login</h2>
        </div>
		<form action="<?= base_url("index.php/home/do_login") ?>" method="POST" style="margin-top:26px">
			<div class="row">
				<input type="email" class="form-control" id="email" name="email" placeholder="E-mail address" value="<?= set_value("email") ?>"> 
				<div style="color:red"><?= form_error('email'); ?></div>
			</div>

			<div class="row">
				<input type="password" class="form-control" id="password" name="password" placeholder="password" value="<?= set_value("password") ?>"> 
				<div style="color:red"><?= form_error('password'); ?></div>
			</div>

			<input type="hidden" name="token" id="formToken">
            <input type="hidden" name="action" id="formAction">

			<div class="row" style="margin-top:26px">
				<button type="submit" class="btn btn-primary" style="margin-right:10px">Login</button>
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