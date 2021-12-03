<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    echo $js;
    echo $css;
    ?>
    <title>Page not found!</title>
    <link rel="icon" href="<?= base_url('assets/images/ThumbnailLogo.png') ?>">

    <style>
        html,
        body {
            height: 100%;
        }

        .container-fluid {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .home {
            color: #C90000;
            padding-top: auto;
            padding-bottom: auto;
        }
    </style>
</head>

<body>
    <?php
    echo $header;
    ?>

    <div class="container-fluid home">
        <div class="row" style="padding-bottom:25px">
            <h1 class="text-center" style="font-size: 100px;">Oof! Page doesn't exist.</h1>
        </div>
    </div>
</body>
</html>