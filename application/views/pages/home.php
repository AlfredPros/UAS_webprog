<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    echo $js;
    echo $css;
    ?>

    <title>MangaBook</title>
    <link rel="icon" href="<?= base_url('assets/images/ThumbnailLogo.png') ?>">

    <style>
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
            <h2 style="font-weight: 900;">Selamat Datang di</h2>
            <img src="<?= base_url('assets/images/MangaBookLogoColor.png') ?>" alt="" draggable="false">
            <a href="<?= base_url('index.php/home/register') ?>" class="btn red-btn" role="button" style="margin-top: 26px;">Register</a>
            <a href="<?= base_url('index.php/home/login') ?>" class="btn red-outline-btn" role="button" style="margin-top: 6px;">Login</a>
            <hr style="margin-top:26px">
            <div style="margin-top: 6px;">
                <p>This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a href="https://policies.google.com/terms">Terms of Service</a> apply.</p>
            </div>
        </div>
    </div>
</body>
</html>