<!DOCTYPE html>
<html>
<head>
    <?php
        echo $js;
        echo $css;
    ?>

    <title>Book Detail</title>
</head>
<body>
    <?php
        echo $header;
    ?>

    <div class="container" style="margin-top:28px">
        <div class="row">
            <h1 class="text-center"><?= $book[0]['title'] ?></h1>
        </div>
        <div class="row justify-content-center">
            <img src="<?= base_url($book[0]['link_cover']) ?>" style="max-width:256px;" draggable="false">
        </div>
        <div class="row">
            <p><?= $book[0]['description'] ?></p>
        </div>
        <br>
       
        <div class="d-flex justify-content-center align-items-center">
            <a class="btn btn-primary" role="button" style="margin-right:8px" href="<?= base_url("index.php/home/booking_manga?id_book=".$book[0]['id_book']) ?>">Book</a>
            <a class="btn btn-secondary" role="button" style="margin-left:8px" href="<?= base_url("index.php/home/book_list") ?>">Return to listing</a>
        </div>

        <br>
    </div>

    <style>
        .table-hover-cells > tbody > tr > th:hover,
.table-hover-cells > tbody > tr > td:hover {
  background-color: #f5f5f5;
}

.table-hover-cells > tbody > tr > th.active:hover,
.table-hover-cells > tbody > tr > td.active:hover,
.table-hover-cells > tbody > tr.active > th:hover,
.table-hover-cells > tbody > tr.active > td:hover {
  background-color: #e8e8e8;
}

.table-hover.table-hover-cells > tbody > tr:hover > th:hover,
.table-hover.table-hover-cells > tbody > tr:hover > td:hover {
  background-color: #e8e8e8;
}

.table-hover.table-hover-cells > tbody > tr.active:hover > th:hover,
.table-hover.table-hover-cells > tbody > tr.active:hover > td:hover {
  background-color: #d8d8d8;
}

h1 > .divider:before,
h2 > .divider:before,
h3 > .divider:before,
h4 > .divider:before,
h5 > .divider:before,
h6 > .divider:before,
.h1 > .divider:before,
.h2 > .divider:before,
.h3 > .divider:before,
.h4 > .divider:before,
.h5 > .divider:before,
.h6 > .divider:before {
  color: #777;
  content: "\0223E\0020";
}
    </style>

    <div class="container">
        <table class="table table-striped table-hover-cells" id="tableProduct">
            <thead>
                <tr>
                    <th>Mo</th>
                    <th>Tu</th>
                    <th>We</th>
                    <th>Th</th>
                    <th>Fr</th>
                    <th>Sa</th>
                    <th>Su</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $timestamp = strtotime('2021-12-01');
                    $startDay = date("l", $timestamp);
                    var_dump($startDay);
                    $days = cal_days_in_month(CAL_GREGORIAN, 12, 2021);
                    var_dump($days);
                ?>

                <?php for ($i=1; $i<$days+1; $i++) { ?>
                    <tr>
                        <td><?= ($i*7)+1; ?></td>
                        <td><?= ($i*7)+2; ?></td>
                        <td><?= ($i*7)+3; ?></td>
                        <td><?= ($i*7)+4; ?></td>
                        <td><?= ($i*7)+5; ?></td>
                        <td><?= ($i*7)+6; ?></td>
                        <td><?= ($i*7)+7; ?></td>
                    </tr>
                <?php }; ?>
            </tbody>
        </table>
    </div>
    
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
                <?php foreach($books as $book) { ?>
                    <tr>
                        <td><?= array_search($book, $books)+1; ?></td>
                        <td><?= $book['title']; ?></td>
                        <td><?= $book['author']; ?></td>
                        <td><?= $book['publisher']; ?></td>
                        <td><?= $book['year']; ?></td>
                        <td><img src="<?= base_url($book['link_cover']) ?>" style="max-height: 64px;" draggable="false"></td>
                        <td>
                            <a class="btn btn-primary" role="button" href="<?= base_url("index.php/home/edit_book?id_book=").$book['id_book']; ?>">✏️</a>
                            <a class="btn btn-danger" role="button" href="<?= base_url("index.php/home/delete_book?id_book=").$book['id_book']; ?>">❌</a>
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