<div class="container" style="padding-top: 2rem;">
    <table id="table" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr style="text-align:left; font-weight: bold;">
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($data as $user) {
                    $id = $user['id_user'];
                    ?>
                    <tr style="text-align: center;">
                        <td><?= $id ?></td>
                        <td><?= $user['nama'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['role'] ?></td>
                        <td>
                        <div class="col-auto">
                            <a href="<?= base_url("index.php/Home/edit_user/$id") ?>">
                                <button class="btn btn-warning">Edit</button>
                            </a>
                        </div>    
                        <div class="col-auto">
                            <a href="<?= base_url("index.php/Home/deleteuser/$id") ?>">
                                <button class="btn btn-warning">X</button>
                            </a>
                        </div>
                        </td>
                    </tr>
                    <?php
                    }
                ?>
        </tbody>
    </table>
</div>