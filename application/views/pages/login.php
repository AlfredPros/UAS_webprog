<!DOCTYPE html>
<html>

<head>
    <?php
    echo $js;
    echo $css;
    ?>
    <title>Login</title>

    <!-- Recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LePRGcdAAAAAMph8kCaVrkCIIv4P14m0Rmez5xp"></script>
    <link rel="icon" href="<?= base_url('assets/images/ThumbnailLogo.png') ?>">

    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LePRGcdAAAAAMph8kCaVrkCIIv4P14m0Rmez5xp', {
                action: 'add_name'
            }).then(function(token) {
                $('#formToken').val(token);
                $('#formAction').val('add_name');
            });
        });
    </script>

    <style>
        .grecaptcha-badge {
            visibility: hidden;
        }

        html,
        body {
            height: 100%;
        }

        .container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
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

        body {
            background-image: url("<?= base_url('assets/images/LandingBackground.png') ?>");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }

        .box {
            background-color: white;
            border-radius: 25px;
        }
    </style>
</head>

<body>
    <div class="container col-lg-3 center">
        <div class="box row text-center" style="color: #C90000; padding: 28px">
            <h2 style="font-weight: 900;">Login</h2>
            <img src="<?= base_url('assets/images/MangaBookLogoColor.png') ?>" alt="" draggable="false">
            <?php if (isset($_SESSION['alert'])) { ?>
                <p style="color:red"><?= $_SESSION['alert'] ?></p>
            <?php unset($_SESSION['alert']);
            } ?>
            <form action="<?= base_url("index.php/home/do_login") ?>" method="POST" style="margin-top:26px">
                <div class="row">
                    <label for="email">E-Mail Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="lightyagami@mangabook.com" value="<?= set_value("email") ?>">
                    <div style="color:red"><?= form_error('email'); ?></div>
                </div>

                <div class="row" style="padding-top: 6px;">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= set_value("password") ?>">
                    <div style="color:red"><?= form_error('password'); ?></div>
                </div>

                <input type="hidden" name="token" id="formToken">
                <input type="hidden" name="action" id="formAction">

                <div class="row" style="margin-top:26px">
                    <button type="submit" class="btn red-btn" style="margin-right:10px">Login</button>
                </div>
                <div class="row" style="margin-top:8px">
                    <a href="<?= base_url('index.php/home') ?>" class="btn red-outline-btn" role="button">Cancel</a>
                </div>
            </form>
            <hr style="margin-top:26px">
            <div style="margin-top:6px">
                <p>This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a href="https://policies.google.com/terms">Terms of Service</a> apply.</p>
            </div>
        </div>
    </div>
</body>
</html>