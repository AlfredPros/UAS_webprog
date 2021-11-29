<!DOCTYPE html>
<html>
<head>
    <?php
        echo $js;
        echo $css;
    ?>
    <title>Detail</title>
</head>
<body>
    <?php
        echo $header;
    ?>

    <div class="container" style="padding-top:15px">
        <div class="row justify-content-end">
            <div class="col">
                <h1>
                    <?= $buku[0]['judul_buku'] ?>
                </h1>
            </div>

            <div class="col-auto">
                <a href="<?= base_url("index.php/home") ?>" class="btn btn-primary" role="button">
                    < Back
                </a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-4 offset-1">
                <h5>
                    Published Year: <?= $buku[0]['tahun_terbit'] ?><br>
                    Publisher: <?= $buku[0]['penerbit_buku'] ?><br>
                    Author: <?= $buku[0]['penulis_buku'] ?><br>
                </h5>
            </div>
            <div class="col-6 col-auto offset-1">
                <img src="<?= base_url($buku[0]['link_poster']); ?>" class="img-fluid" style="max-height:512px">
            </div>
        </div>
    </div>
    
</body>
</html>