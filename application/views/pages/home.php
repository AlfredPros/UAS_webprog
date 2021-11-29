<!DOCTYPE html>
<html>
<head>
    <?php
        echo $js;
        echo $css;
    ?>
    <title>Week 13</title>
</head>
<body>
    <?php
        echo $header;
    ?>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Sign In</h5>
                </div>
                <form method="POST" action="<?= base_url("index.php/home/dologin") ?>">
                    <div class="modal-body">
                        <div class="form-group" style="padding-bottom:5px">
                            <label for="password" style="padding-bottom:5px">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="password" value="" required>
                        </div>
                        <p id="alert"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" style="margin-right:5px">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        <?php 
            if (isset($_SESSION['alertNotif'])) {
                echo "$('#alert').append('".$_SESSION['alertNotif']."'); $('#alert').css('color', 'red');";
                $this->session->unset_userdata('alertNotif');
            }

            if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
                $_SESSION['logged_in'] = false;
                echo "let myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {}); myModal.show();";
            }
        ?>
    </script>

    <!-- Top button -->
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
</body>
</html>