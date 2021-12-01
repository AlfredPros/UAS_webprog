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
            <h1 class="text-center">Manga Listing</h1>
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
    <!--
    <div class="col-md-4">
        <a href="<?= base_url("index.php/home/book_detail?id_book=") . $book['id_book'] . "&month=" . date('m') . "&year=" . date('Y'); ?>">
            <img src="<?= base_url($book['link_cover']) ?>">
        </a>
        <div class="row">
            <a href="<?= base_url("index.php/home/book_detail?id_book=") . $book['id_book'] . "&month=" . date('m') . "&year=" . date('Y'); ?>">
                <p class="text-center"><?= $book['title'] ?></p>
            </a>
        </div>
    </div>
        -->

    <!--
    <div class="container" style="padding-top:25px; padding-bottom:30px">
        <div class="col" style="margin-bottom: 2rem;">
        <a class="btn btn-primary" role="button" href="<?= base_url('index.php/home/add_book') ?>">Add</a>
        </div>
        <table class="table table-striped table-hover" id="tableProduct">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Year</th>
                    <th>Cover</th>
                    <th>Operation</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($books as $book) { ?>
                    <tr>
                        <td><?= array_search($book, $books) + 1; ?></td>
                        <td><?= $book['title']; ?></td>
                        <td><?= $book['author']; ?></td>
                        <td><?= $book['publisher']; ?></td>
                        <td><?= $book['year']; ?></td>
                        <td><img src="<?= base_url($book['link_cover']) ?>" style="max-height: 64px;" draggable="false"></td>
                        <td>
                            <a class="btn btn-primary" role="button" href="<?= base_url("index.php/home/edit_book?id_book=") . $book['id_book']; ?>">✏️</a>
                            <a class="btn btn-danger" role="button" href="<?= base_url("index.php/home/delete_book?id_book=") . $book['id_book']; ?>">❌</a>
                        </td>
                    </tr>
                <?php }; ?>
            </tbody>

            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Year</th>
                    <th>Cover</th>
                    <th>Operation</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#tableProduct').DataTable();
        } );
    </script>
</body>
</html>