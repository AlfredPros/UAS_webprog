<!DOCTYPE html>
<html>

<head>
    <?php
    echo $js;
    echo $css;
    ?>

    <title>Home - MangaBook</title>
    <link rel="icon" href="<?= base_url('assets/images/ThumbnailLogo.png') ?>">

    <style>
        .red-btn {
            background-color: #C90000;
            color: white;
            transition: 0.3s;
        }

        .red-btn:hover {
            background-color: #A00000;
            color: white;
        }

        .home-picture {
            background-image: url("<?= base_url('assets/images/LandingBackgroundLow.png') ?>");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            color: #C90000;
            padding-top: 150px;
            padding-bottom: 150px;
            background-attachment: fixed;
        }

        .menu-picture {
            background-color: #C90000;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            color: white;
            padding-top: 100px;
            padding-bottom: 100px;
        }
    </style>
</head>

<body>
    <?php
    echo $header;
    ?>

    <div class="container-fluid center home-picture">
        <div class="row">
            <div class="col text-center">
                <img src="<?= base_url($_SESSION['link_profile']) ?>" alt="" style="height: 200px; width: 200px; border-radius: 100%; object-fit: cover; margin-bottom: 8px; box-shadow: 0 0 50px #FFFFFF;" draggable="false">
                <h1 style="text-shadow: 0 0 10px #FFFFFF;">Hello, <?= $_SESSION['name']; ?>!</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid center menu-picture">
        <div class="row">
            <h4 class="text-center">This is your menu</h4>
            <div class="col text-center">
                <div class="card" style="width: 18rem; display:inline-block; margin: 10px;">
                    <img src="<?= base_url('assets/images/User.png') ?>" class="card-img-top" alt="" style="width: 100%; height: 250px; object-fit: cover" draggable="false">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #C90000;">Users List</h5>
                        <a href="<?= base_url("index.php/home/user_list") ?>" class="btn red-btn" role="button">Go To Link</a>
                    </div>
                </div>
                <div class="card" style="width: 18rem; display:inline-block; margin: 10px;">
                    <img src=" <?= base_url('assets/images/Manga.png') ?>" class="card-img-top" alt="" style="width: 100%; height: 250px; object-fit: cover" draggable="false">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #C90000;">Manga List</h5>
                        <a href="<?= base_url("index.php/home/book_list") ?>" class="btn red-btn" role="button">Go To Link</a>
                    </div>
                </div>
                <div class="card" style="width: 18rem; display:inline-block; margin: 10px;">
                    <img src=" <?= base_url('assets/images/Request.png') ?>" class="card-img-top" alt="" style="width: 100%; height: 250px; object-fit: cover" draggable="false">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #C90000;">Requests List</h5>
                        <a href="<?= base_url("index.php/home/request_list") ?>" class="btn red-btn" role="button">Go To Link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>