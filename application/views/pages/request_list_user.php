<!DOCTYPE html>
<html>

<head>
    <?php
    echo $js;
    echo $css;
    ?>

    <title>Requests List - MangaBook</title>
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

    <div class="container-fluid" style="margin-top:28px">
        <div class="row">
            <h1 class="text-center">Requests List</h1>
        </div>
    </div>
    <hr>

    <!--<div class="row">
        <img src="<?= base_url("assets/images/screenshot0032.png") ?>">
    </div>
    <br>
    <div class="row">
        <div class="col text-center">
            <a href="<?= base_url("index.php/home/book_list") ?>" class="btn btn-primary" role="button">Manga Listing</a>
            <a href="<?= base_url("index.php/home/request_list") ?>" class="btn btn-primary" role="button">Requests Listing</a>
        </div>
    </div>
    <br>-->

    <div class="container" style="padding-top:25px; padding-bottom:30px">
        <table class="table table-striped table-hover" id="tableProduct">
            <thead class="text-center" style="color: #C90000;">
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
                <?php foreach ($requests as $request) { ?>
                    <tr style="color: #C90000;">
                        <td class="text-center"><?= array_search($request, $requests) + 1; ?></td>
                        <td><?= $request['name']; ?></td>
                        <td><?= $request['title']; ?></td>
                        <td class="text-center"><?= $request['start_time']; ?></td>
                        <td class="text-center"><?= $request['end_time']; ?></td>
                        <td class="text-center">
                            <?php
                            switch ($request['status']) {
                                case '1':
                                    echo "Approved";
                                    break;
                                case '0':
                                    echo "Rejected";
                                    break;
                                default:
                                    echo "Waiting for approval";
                                    break;
                            }
                            ?>
                        </td>
                    </tr>
                <?php }; ?>
            </tbody>

            <tfoot class="text-center" style="color: #C90000;">
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
        });
    </script>
</body>

</html>