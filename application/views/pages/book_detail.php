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
        <h3>Waktu ketersediaan manga:</h3>
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
                    if (!isset($month) && !isset($year)) {
                        $month = 12;
                        $year = 2012;
                    }
                    echo "Month: $month<br>Year: $year";

                    $timestamp = strtotime("$year-$month-01");
                    $nameDay = date("l", $timestamp);
                    switch($nameDay) {
                        case 'Monday': {
                            $startDay = 0;
                            break;
                        }
                        case 'Tuesday': {
                            $startDay = 1;
                            break;
                        }
                        case 'Wednesday': {
                            $startDay = 2;
                            break;
                        }
                        case 'Thursday': {
                            $startDay = 3;
                            break;
                        }
                        case 'Friday': {
                            $startDay = 4;
                            break;
                        }
                        case 'Saturday': {
                            $startDay = 5;
                            break;
                        }
                        case 'Sunday': {
                            $startDay = 6;
                            break;
                        }
                    }
                    $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                    // Check if day is taken
                    $startReqDay = [];
                    $endReqDay = [];
                    $startReqMonth = [];
                    $endReqMonth = [];
                    $startReqYear = [];
                    $endReqYear = [];
                    $dayTaken = [];  // All days taken
                    foreach($requests as $request) {  // Get ReqDay
                        array_push($startReqDay, substr($request['start_time'], 8, 2));
                        array_push($endReqDay, substr($request['end_time'], 8, 2));
                    }
                    foreach($requests as $request) {  // Get ReqMonth
                        array_push($startReqMonth, substr($request['start_time'], 5, 2));
                        array_push($endReqMonth, substr($request['end_time'], 5, 2));
                    }
                    foreach($requests as $request) {  // Get ReqYear
                        array_push($startReqYear, substr($request['start_time'], 0, 4));
                        array_push($endReqYear, substr($request['end_time'], 0, 4));
                    }

                    for ($i=0; $i<sizeof($startReqDay); $i++){
                        if ($endReqDay[$i]-$startReqDay[$i] > 0 && $startReqMonth[$i] == $month && $endReqMonth[$i] == $month && $year == $startReqYear[$i] && $year == $endReqYear[$i]) {
                            for($j=0; $j<$endReqDay[$i]-$startReqDay[$i]+1; $j++) {
                                array_push($dayTaken, $startReqDay[$i]+$j);
                            }
                        }
                        else if ($startReqMonth[$i] - $endReqMonth[$i] == -1 && $month == $endReqMonth[$i] && $year == $startReqYear[$i] && $year == $endReqYear[$i]) {
                            for($j=0; $j<$endReqDay[$i]+1; $j++) {
                                array_push($dayTaken, $j);
                            }
                        }
                        else if ($startReqMonth[$i] - $endReqMonth[$i] == -1 && $month == $startReqMonth[$i] && $year == $startReqYear[$i] && $year == $endReqYear[$i]) {
                            for($j=0; $j<$days-$startReqDay[$i]+1; $j++) {
                                array_push($dayTaken, $startReqDay[$i]+$j);
                            }
                        }
                        else if ($startReqMonth[$i] - $endReqMonth[$i] == 11 && $month == $startReqMonth[$i] && $year == $startReqYear[$i]) {
                            for($j=0; $j<$days-$startReqDay[$i]+1; $j++) {
                                array_push($dayTaken, $startReqDay[$i]+$j);
                            }
                        }
                        else if ($startReqMonth[$i] - $endReqMonth[$i] == 11 && $month == $endReqMonth[$i] && $year == $endReqYear[$i]) {
                            for($j=0; $j<$endReqDay[$i]+1; $j++) {
                                array_push($dayTaken, $j);
                            }
                        }
                    }
                    
                    // Debugging
                    /*
                    echo "<br><br>";
                    var_dump($startReqYear);
                    echo "<br>";
                    var_dump($endReqYear);
                    echo "<br>";
                    var_dump($startReqMonth);
                    echo "<br>";
                    var_dump($endReqMonth);
                    echo "<br>";
                    var_dump($startReqDay);
                    echo "<br>";
                    var_dump($endReqDay);
                    echo "<br><br>";
                    var_dump($dayTaken);
                    */
                ?>

                <tr>
                    <?php 
                        for ($i=0; $i<$startDay; $i++) { 
                            echo "<td></td>"; 
                        } 

                        for ($i=1; $i<$days+1; $i++) { 
                            if (($i + $startDay) % 7 == 1) { 
                                echo "<tr>"; 
                            }

                            if (in_array($i, $dayTaken)) {
                                echo "<td class='table-danger'>$i</td>";
                            }
                            else {
                                echo "<td>$i</td>";
                            }
                            
                            if (($i + $startDay) % 7 == 0) { 
                                echo "</tr>"; 
                            } 
                        }; 
                    ?>
                </tr>
            </tbody>
        </table>
    </div>

    <br>
    
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