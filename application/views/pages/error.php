<!DOCTYPE html>
<html>
<head>
    <?php
        echo $js;
        echo $css;
    ?>
    <title>Page not found! OwO</title>
</head>
<body>
    <?php
        echo $header;
    ?>

    <div class="container" style="padding-top:25px">
        <div class="row" style="padding-bottom:25px">
            <h1 class="text-center">Oof! Page doesn't exist.</h1>
        </div>

        <image src="<?= base_url("assets/images/91552656_1.jpg") ?>" draggable="false" class="mx-auto d-block img-fluid">
    </div>

</body>
</html>