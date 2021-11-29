<!DOCTYPE html>
<html>
<head>
    <?php
        echo $js;
        echo $css;
    ?>

    <title>Home user</title>
</head>
<body>
    <?php
        echo $header;
    ?>

    <div class="container" style="margin-top:28px">
        <div class="row">
            <h1 class="text-center">Hello, <?= $_SESSION['name']; ?>!</h1>
        </div>
        <div class="row">
            <img src="<?= base_url("assets/images/screenshot0032.png") ?>">
        </div>
        <br>
        <div class="row">
            <div class="col text-center">
                <a href="<?= base_url("index.php/home/book_list") ?>" class="btn btn-primary" role="button">Manga Listing</a>
                <a href="<?= base_url("index.php/home/request_list") ?>" class="btn btn-primary" role="button">Requests Listing</a>
            </div>
        </div>
        <br>
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
                <?php foreach($list_buku as $yum) { ?>
                    <tr>
                        <td><?= array_search($yum, $list_buku)+1; ?></td>
                        <td><?= $yum['judul_buku']; ?></td>
                        <td><?= $yum['tahun_terbit']; ?></td>
                        <td><?= $yum['penulis_buku']; ?></td>
                        <td><?= $yum['penerbit_buku']; ?></td>
                        <td><img src="<?= base_url($yum['link_poster']); ?>" class="img-fluid" style="max-height:128px"></td>
                        <td>
                            <a class="btn btn-secondary" role="button" href="<?= base_url("index.php/home/detail_buku?id_buku=").$yum['id_buku']; ?>">🔍</a>
                            <a class="btn btn-primary" role="button" href="<?= base_url("index.php/home/edit_buku?id_buku=").$yum['id_buku']; ?>">✏️</a>
                            <a class="btn btn-danger" role="button" href="<?= base_url("index.php/home/delete_buku?id_buku=").$yum['id_buku']; ?>">❌</a>
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