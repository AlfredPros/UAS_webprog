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
                <a href="<?= base_url("index.php/home/user_list") ?>" class="btn btn-primary" role="button">Users Listing</a>
                <a href="<?= base_url("index.php/home/facilities_list") ?>" class="btn btn-primary" role="button">Facilities Listing</a>
                <a href="<?= base_url("index.php/home/request_list") ?>" class="btn btn-primary" role="button">Requests Listing</a>
            </div>
        </div>
        <br>
    </div>
    <div class="container" style="padding-top:25px; padding-bottom:30px">
        <table class="table table-striped table-hover" id="tableProduct">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Operation</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($users as $user) { ?>
                    <tr>
                        <td><?= array_search($user, $users)+1; ?></td>
                        <td><?= $user['name']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td><?= $user['role']; ?></td>
                        <td>
                            <a class="btn btn-primary" role="button" href="<?= base_url("index.php/home/edit_user?id_user=").$user['id_user']; ?>">✏️</a>
                            <a class="btn btn-danger" role="button" href="<?= base_url("index.php/home/delete_user?id_user=").$user['id_user']; ?>">❌</a>
                        </td>
                    </tr>
                <?php }; ?>
            </tbody>

            <tfoot>
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
        } );
    </script>
</body>
</html>