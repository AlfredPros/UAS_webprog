<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #C90000; color:#C90000; border-radius:0px 0px 10px 10px">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url("index.php/home") ?>">
            <img src="<?= base_url('assets/images/MangaBookLogoWhite.png') ?>" alt="" width="150px" draggable="false">
        </a>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'User') { ?>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url("index.php/home/book_list") ?>" style="color: white;">Manga</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url("index.php/home/request_list") ?>" style="color: white;">Requests</a>
                </li>
            </ul>
        <?php } else if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') { ?>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url("index.php/home/user_list") ?>" style="color: white;">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url("index.php/home/book_list") ?>" style="color: white;">Manga</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url("index.php/home/request_list") ?>" style="color: white;">Requests</a>
                </li>
            </ul>
        <?php } else if (isset($_SESSION['role']) && $_SESSION['role'] == 'Manager') { ?>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url("index.php/home/book_list") ?>" style="color: white;">Manga</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url("index.php/home/request_list") ?>" style="color: white;">Requests</a>
                </li>
            </ul>
        <?php } ?>


        <!-- Button for smaller-size -->
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li>
                        <img src="<?= base_url($_SESSION['link_profile']) ?>" style="height:42px; width: 42px; margin-right:8px; border-radius: 100%; object-fit: cover;" draggable="False">
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
                            <?= $this->session->userdata('name'); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="<?= base_url("index.php/home/logout") ?>" style="color: #C90000;">Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        <?php } ?>
    </div>
</nav>