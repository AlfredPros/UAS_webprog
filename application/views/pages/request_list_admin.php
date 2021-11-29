<!DOCTYPE html>
<html>
<head>
    <?php
        echo $js;
        echo $css;
    ?>

    <title>Home request</title>
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
                <a href="<?= base_url("index.php/home/user_list") ?>" class="btn btn-primary" role="button">User Listing</a>
                <a href="<?= base_url("index.php/home/book_list") ?>" class="btn btn-primary" role="button">Manga Listing</a>
                <a href="<?= base_url("index.php/home/request_list") ?>" class="btn btn-primary" role="button">Requests Listing</a>
            </div>
        </div>
        <br>
    </div>
    
    <div class="container" style="padding-top:25px; padding-bottom:30px">
        <div class="row" style="margin-bottom: 2rem;">
        <a href="<?= base_url('index.php/home/add_request') ?>">
            <button class="btn btn-primary">Add</button>
        </a>
        </div>
        <table class="table table-striped table-hover" id="tableProduct">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Requester</th>
                    <th>Requested Manga</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Operation</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($requests as $request) { ?>
                    <tr>
                        <td><?= array_search($request, $requests)+1; ?></td>
                        <td><?= $request['name']; ?></td>
                        <td><?= $request['title']; ?></td>
                        <td><?= $request['start_time']; ?></td>
                        <td><?= $request['end_time']; ?></td>
                        <td>
                            <a class="btn btn-danger" role="button" href="<?= base_url("index.php/home/delete_request?id_request=").$request['id_request']; ?>">❌</a>
                        </td>
                    </tr>
                <?php }; ?>
            </tbody>

            <tfoot>
                <tr>
                <th>#</th>
                    <th>Requester</th>
                    <th>Requested Manga</th>
                    <th>Start Date</th>
                    <th>End Date</th>
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