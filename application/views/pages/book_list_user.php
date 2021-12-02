<!DOCTYPE html>
<html>

<head>
    <?php
    echo $js;
    echo $css;
    ?>

    <title>Manga List - MangaBook</title>
    <link rel="icon" href="<?= base_url('assets/images/ThumbnailLogo.png') ?>">

    <style>
        body {
            color: #C90000;
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

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php
    echo $header;
    ?>

    <div class="container" style="margin-top:28px">
        <div class="row">
            <h1 class="text-center">Manga List</h1>
        </div>
        <div class="row">
            <p class="text-center">Preview and book manga from this page.</p>
        </div>
    </div>
    <hr>
    <div class="container" style="margin-top:28px">
        <div class="row">
            <?php
            foreach (array_slice($books, 0) as $book) {
            ?>
                <div class="col text-center">
                    <div class="card center" style="width: 18rem; display:inline-block; margin: 5px;">
                        <a href="<?= base_url("index.php/home/book_detail?id_book=") . $book['id_book'] . "&month=" . date('m') . "&year=" . date('Y'); ?>">
                            <img src="<?= base_url($book['link_cover']) ?>" class="card-img-top" alt="" style="width: 100%; height: 250px; object-fit: cover" draggable="false">
                        </a>
                        <div class="card-body">
                            <a href="<?= base_url("index.php/home/book_detail?id_book=") . $book['id_book'] . "&month=" . date('m') . "&year=" . date('Y'); ?>">
                                <h5 class="card-title" style="color: #C90000;"><?= $book['title'] ?></h5>
                            </a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>
</html>