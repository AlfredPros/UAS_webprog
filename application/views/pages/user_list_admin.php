<!DOCTYPE html>
<html>

<head>
    <?php
    echo $js;
    echo $css;
    ?>

    <title>Users List - MangaBook</title>
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
    </style>
</head>

<body>
    <?php
    echo $header;
    ?>

    <div class="container-fluid" style="margin-top:28px">
        <div class="row">
            <h1 class="text-center">Users List</h1>
            <hr>
        </div>
        <!--<div class="row">
            <img src="<?= base_url("assets/images/screenshot0032.png") ?>">
        </div>
        <br>
        <div class="row">
            <div class="col text-center">
                <a href="<?= base_url("index.php/home/user_list") ?>" class="btn btn-primary" role="button">Users Listing</a>
                <a href="<?= base_url("index.php/home/book_list") ?>" class="btn btn-primary" role="button">Manga Listing</a>
                <a href="<?= base_url("index.php/home/request_list") ?>" class="btn btn-primary" role="button">Requests Listing</a>
            </div>
        </div>
        <br>-->
    </div>
    <div class="container" style="padding-top:25px; padding-bottom:30px;">
        <table class="table table-striped table-hover" id="tableProduct">
            <thead class="text-center" style="color: #C90000;">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Operation</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr style="color: #C90000;">
                        <td class="text-center"><?= array_search($user, $users) + 1; ?></td>
                        <td><?= $user['name']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td class="text-center"><?= $user['role']; ?></td>
                        <td class="text-center">
                            <a class="btn red-btn" role="button" href="<?= base_url("index.php/home/edit_user?id_user=") . $user['id_user']; ?>">✏️</a>
                            <a class="btn red-outline-btn" role="button" href="<?= base_url("index.php/home/delete_user?id_user=") . $user['id_user']; ?>">❌</a>
                        </td>
                    </tr>
                <?php }; ?>
            </tbody>

            <tfoot class="text-center" style="color: #C90000;">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Operation</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#tableProduct').DataTable();
        });
    </script>
</body>

</html>