<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    echo $js;
    echo $css;
    ?>

    <title>Manga Detail - MangaBook</title>
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
            <h1 class="text-center"><?= $book[0]['title'] ?></h1>
        </div>
    </div>
    <hr>
    <div class="container" style="margin-top:28px">
        <div class="row justify-content-center">
            <img src="<?= base_url($book[0]['link_cover']) ?>" style="max-width:256px;" draggable="false">
        </div>
        <br>
        <div class="row">
            <p><?= $book[0]['description'] ?></p>
        </div>
        <br>
        <div class="d-flex justify-content-center align-items-center">
            <a class="btn red-btn" role="button" style="margin-right:8px" href="<?= base_url("index.php/home/booking_manga?id_book=" . $book[0]['id_book']) ?>">Book</a>
            <a class="btn red-outline-btn" role="button" style="margin-left:8px" href="<?= base_url("index.php/home/book_list") ?>">Return to Manga List</a>
        </div>
    </div>
    <hr>
    <style>
        .table-hover-cells>tbody>tr>th:hover,
        .table-hover-cells>tbody>tr>td:hover {
            background-color: #f5f5f5;
        }

        .table-hover-cells>tbody>tr>th.active:hover,
        .table-hover-cells>tbody>tr>td.active:hover,
        .table-hover-cells>tbody>tr.active>th:hover,
        .table-hover-cells>tbody>tr.active>td:hover {
            background-color: #e8e8e8;
        }

        .table-hover.table-hover-cells>tbody>tr:hover>th:hover,
        .table-hover.table-hover-cells>tbody>tr:hover>td:hover {
            background-color: #e8e8e8;
        }

        .table-hover.table-hover-cells>tbody>tr.active:hover>th:hover,
        .table-hover.table-hover-cells>tbody>tr.active:hover>td:hover {
            background-color: #d8d8d8;
        }

        h1>.divider:before,
        h2>.divider:before,
        h3>.divider:before,
        h4>.divider:before,
        h5>.divider:before,
        h6>.divider:before,
        .h1>.divider:before,
        .h2>.divider:before,
        .h3>.divider:before,
        .h4>.divider:before,
        .h5>.divider:before,
        .h6>.divider:before {
            color: #777;
            content: "\0223E\0020";
        }
    </style>

    <div class="container text-center">
        <h3>Waktu Ketersediaan Manga</h3>
        <br>
        <div class="dropdown">
            <a class="btn red-btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <?= 'Month: ' . $month . ' | Year: ' . $year; ?>
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <?php
                for ($i = 0; $i < 2; $i++) {
                    for ($j = 0; $j < 12; $j++) {
                        if ($i != 0 || $j >= date('m') - 1) { ?>
                            <li><a class='dropdown-item' href='<?= base_url("index.php/home/book_detail?id_book=" . $book[0]["id_book"] . "&month=" . ($j + 1) . "&year=" . ($i + 2021)); ?>'>Month: <?= $j + 1 ?> | Year: <?= $i + 2021 ?></a></li>
                <?php
                        }
                    }
                }
                ?>
            </ul>
        </div>
        <table class="table table-striped table-hover-cells" id="tableProduct">
            <thead class="text-center" style="color: #C90000;">
                <tr>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                    <th>Sun</th>
                </tr>
            </thead>

            <tbody class="text-center" style="color: #C90000;">
                <?php
                $timestamp = strtotime("$year-$month-01");
                $nameDay = date("l", $timestamp);
                switch ($nameDay) {
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
                foreach ($requests as $request) {  // Get ReqDay
                    array_push($startReqDay, substr($request['start_time'], 8, 2));
                    array_push($endReqDay, substr($request['end_time'], 8, 2));
                }
                foreach ($requests as $request) {  // Get ReqMonth
                    array_push($startReqMonth, substr($request['start_time'], 5, 2));
                    array_push($endReqMonth, substr($request['end_time'], 5, 2));
                }
                foreach ($requests as $request) {  // Get ReqYear
                    array_push($startReqYear, substr($request['start_time'], 0, 4));
                    array_push($endReqYear, substr($request['end_time'], 0, 4));
                }

                for ($i = 0; $i < sizeof($startReqDay); $i++) {
                    if ($endReqDay[$i] - $startReqDay[$i] > 0 && $startReqMonth[$i] == $month && $endReqMonth[$i] == $month && $year == $startReqYear[$i] && $year == $endReqYear[$i]) {
                        for ($j = 0; $j < $endReqDay[$i] - $startReqDay[$i] + 1; $j++) {
                            array_push($dayTaken, $startReqDay[$i] + $j);
                        }
                    } else if ($startReqMonth[$i] - $endReqMonth[$i] == -1 && $month == $endReqMonth[$i] && $year == $startReqYear[$i] && $year == $endReqYear[$i]) {
                        for ($j = 0; $j < $endReqDay[$i] + 1; $j++) {
                            array_push($dayTaken, $j);
                        }
                    } else if ($startReqMonth[$i] - $endReqMonth[$i] == -1 && $month == $startReqMonth[$i] && $year == $startReqYear[$i] && $year == $endReqYear[$i]) {
                        for ($j = 0; $j < $days - $startReqDay[$i] + 1; $j++) {
                            array_push($dayTaken, $startReqDay[$i] + $j);
                        }
                    } else if ($startReqMonth[$i] - $endReqMonth[$i] == 11 && $month == $startReqMonth[$i] && $year == $startReqYear[$i]) {
                        for ($j = 0; $j < $days - $startReqDay[$i] + 1; $j++) {
                            array_push($dayTaken, $startReqDay[$i] + $j);
                        }
                    } else if ($startReqMonth[$i] - $endReqMonth[$i] == 11 && $month == $endReqMonth[$i] && $year == $endReqYear[$i]) {
                        for ($j = 0; $j < $endReqDay[$i] + 1; $j++) {
                            array_push($dayTaken, $j);
                        }
                    }
                }

                // Check if day is requested by the user
                $startReqDay = [];
                $endReqDay = [];
                $startReqMonth = [];
                $endReqMonth = [];
                $startReqYear = [];
                $endReqYear = [];
                $dayReq = [];  // All days taken
                foreach ($requested as $request) {  // Get ReqDay
                    array_push($startReqDay, substr($request['start_time'], 8, 2));
                    array_push($endReqDay, substr($request['end_time'], 8, 2));
                }
                foreach ($requested as $request) {  // Get ReqMonth
                    array_push($startReqMonth, substr($request['start_time'], 5, 2));
                    array_push($endReqMonth, substr($request['end_time'], 5, 2));
                }
                foreach ($requested as $request) {  // Get ReqYear
                    array_push($startReqYear, substr($request['start_time'], 0, 4));
                    array_push($endReqYear, substr($request['end_time'], 0, 4));
                }

                for ($i = 0; $i < sizeof($startReqDay); $i++) {
                    if ($endReqDay[$i] - $startReqDay[$i] > 0 && $startReqMonth[$i] == $month && $endReqMonth[$i] == $month && $year == $startReqYear[$i] && $year == $endReqYear[$i]) {
                        for ($j = 0; $j < $endReqDay[$i] - $startReqDay[$i] + 1; $j++) {
                            array_push($dayReq, $startReqDay[$i] + $j);
                        }
                    } else if ($startReqMonth[$i] - $endReqMonth[$i] == -1 && $month == $endReqMonth[$i] && $year == $startReqYear[$i] && $year == $endReqYear[$i]) {
                        for ($j = 0; $j < $endReqDay[$i] + 1; $j++) {
                            array_push($dayReq, $j);
                        }
                    } else if ($startReqMonth[$i] - $endReqMonth[$i] == -1 && $month == $startReqMonth[$i] && $year == $startReqYear[$i] && $year == $endReqYear[$i]) {
                        for ($j = 0; $j < $days - $startReqDay[$i] + 1; $j++) {
                            array_push($dayReq, $startReqDay[$i] + $j);
                        }
                    } else if ($startReqMonth[$i] - $endReqMonth[$i] == 11 && $month == $startReqMonth[$i] && $year == $startReqYear[$i]) {
                        for ($j = 0; $j < $days - $startReqDay[$i] + 1; $j++) {
                            array_push($dayReq, $startReqDay[$i] + $j);
                        }
                    } else if ($startReqMonth[$i] - $endReqMonth[$i] == 11 && $month == $endReqMonth[$i] && $year == $endReqYear[$i]) {
                        for ($j = 0; $j < $endReqDay[$i] + 1; $j++) {
                            array_push($dayReq, $j);
                        }
                    }
                }
                ?>

                <tr style="color: #C90000;">
                    <?php
                    for ($i = 0; $i < $startDay; $i++) {
                        echo "<td></td>";
                    }

                    for ($i = 1; $i < $days + 1; $i++) {
                        if (($i + $startDay) % 7 == 1) {
                            echo "<tr style='color: #C90000;'>";
                        }

                        if (in_array($i, $dayTaken)) {
                            echo "<td class='table-danger' style='color: #C90000;'>$i</td>";
                        } else if (in_array($i, $dayReq)) {
                            echo "<td class='table-info' style='color: #C90000;'>$i</td>";
                        } else {
                            echo "<td style='color: #C90000;'>$i</td>";
                        }

                        if (($i + $startDay) % 7 == 0) {
                            echo "</tr>";
                        }
                    };
                    ?>
                </tr>
            </tbody>
        </table>
        <p><span style="color:#FF4F63">Red</span> = Taken</p>
        <p><span style="color:#009EAF">Blue</span> = Requested by you</p>
    </div>

    <br>
    <br>
    
</body>
</html>