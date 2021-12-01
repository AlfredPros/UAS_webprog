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
    
    <div class="container" style="padding-top:25px; padding-bottom:30px">
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
                            <a class="btn btn-success" role="button" href="<?= base_url("index.php/home/approve_request?id_request=").$request['id_request']; ?>">Approve</a>
                            <a class="btn btn-danger" role="button" href="<?= base_url("index.php/home/reject_request?id_request=").$request['id_request']; ?>">Reject</a>
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