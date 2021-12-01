<!DOCTYPE html>
<html>

<head>
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
        }

        .box {
            background-color: white;
            border-radius: 10%;
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
        <!--<div class="row" style="margin-top:26px">
            <h3>Anime Manga Kawaii Desu</h3>
        </div>
        <div class="row" style="margin-top:26px">
            <a href="<?= base_url('index.php/home/register') ?>" class="btn btn-primary" role="button">Tingkat Nada</a>
        </div>
        <div class="row" style="margin-top:8px">
            <a href="<?= base_url('index.php/home/login') ?>" class="btn btn-secondary" role="button">Gabung</a>
        </div>
        <hr style="margin-top:26px">
        <div class="row" style="margin-top:6px">
            <p>This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a href="https://policies.google.com/terms">Terms of Service</a> apply.</p>
        </div>-->
    </div>

    <!-- Top button -->
    <!--
    <div class="container" style="padding-top:15px">
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="<?= base_url("index.php/home/add_buku") ?>" class="btn btn-success" role="button">
                    + Book
                </a>
            </div>
        </div>
    </div>

    <div class="container" style="padding-top:25px; padding-bottom:30px">
        <table class="table table-striped table-hover" id="tableProduct">
            <thead>
                <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Year</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Poster</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($list_buku as $yum) { ?>
                    <tr>
                        <td><?= array_search($yum, $list_buku) + 1; ?></td>
                        <td><?= $yum['judul_buku']; ?></td>
                        <td><?= $yum['tahun_terbit']; ?></td>
                        <td><?= $yum['penulis_buku']; ?></td>
                        <td><?= $yum['penerbit_buku']; ?></td>
                        <td><img src="<?= base_url($yum['link_poster']); ?>" class="img-fluid" style="max-height:128px"></td>
                        <td>
                            <a class="btn btn-secondary" role="button" href="<?= base_url("index.php/home/detail_buku?id_buku=") . $yum['id_buku']; ?>">🔍</a>
                            <a class="btn btn-primary" role="button" href="<?= base_url("index.php/home/edit_buku?id_buku=") . $yum['id_buku']; ?>">✏️</a>
                            <a class="btn btn-danger" role="button" href="<?= base_url("index.php/home/delete_buku?id_buku=") . $yum['id_buku']; ?>">❌</a>
                        </td>
                    </tr>
                <?php }; ?>
            </tbody>

            <tfoot>
                <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Year</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Poster</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#tableProduct').DataTable();
        } );
    </script>

    -->
</body>

</html>