<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <td class="text-center"><?= $request['title']; ?></td>
                        <td class="text-center"><?= $request['start_time']; ?></td>
                        <td class="text-center"><?= $request['end_time']; ?></td>
                        <td class="text-center">
                            <a class="btn red-btn" role="button" href="<?= base_url("index.php/home/approve_request?id_request=") . $request['id_request']; ?>">✔️</a>
                            <a class="btn red-outline-btn" role="button" href="<?= base_url("index.php/home/reject_request?id_request=") . $request['id_request']; ?>">❌</a>
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