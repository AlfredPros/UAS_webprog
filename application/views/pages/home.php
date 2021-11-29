<!DOCTYPE html>
<html>
<head>
    <?php
        echo $js;
        echo $css;
    ?>

    <!-- Recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LePRGcdAAAAAMph8kCaVrkCIIv4P14m0Rmez5xp"></script>

    <script>
        //function onSubmit(token) {
        //    document.getElementById("demo-form").submit();
        //}
        
        grecaptcha.ready(function() {
            grecaptcha.execute('6LePRGcdAAAAAMph8kCaVrkCIIv4P14m0Rmez5xp', {action: 'add_name'}).then(function(token) {
                // Add your logic to submit to your backend server here.
                $('#formToken').val(token);
                $('#formAction').val('add_name');
            });
        });
    </script>

    <style>
        .grecaptcha-badge { 
            visibility: hidden;
        }
    </style>

    <title>Landing page</title>
</head>
<body>
    <?php
        echo $header;
    ?>

    <div class="container col-md-4 offset-md-4" style="margin-top: 35px;">
        <div class="row" style="margin-top:26px">
            <h2>Anime Manga Kawaii Desu</h2>
        </div>
        <div class="row" style="margin-top:26px">
            <a href="<?= base_url('index.php/home/register') ?>" class="btn btn-primary" role="button">Lubang Pengatur Panas</a>
        </div>
        <div class="row" style="margin-top:26px">
		    <a href="<?= base_url('index.php/home/login') ?>" class="btn btn-secondary" role="button">Gabung</a>
        </div>
        <hr style="margin-top:26px">
        <div class="row" style="margin-top:6px">
            <p>This site is protected by reCAPTCHA Enterprise and the Google <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a href="https://policies.google.com/terms">Terms of Service</a> apply.</p>
        </div>
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