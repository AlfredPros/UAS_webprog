<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#F1F4F5">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url("index.php/home") ?>">Logo ya</a>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'User') { ?>
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?= base_url("index.php/home/facilities_list") ?>">Facilities</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?= base_url("index.php/home/request_list") ?>">Requests</a>
            </li>
        </ul>
        <?php } else if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') { ?>
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?= base_url("index.php/home/user_list") ?>">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?= base_url("index.php/home/facilities_list") ?>">Facilities</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?= base_url("index.php/home/request_list") ?>">Requests</a>
            </li>
        </ul>
        <?php } else if (isset($_SESSION['role']) && $_SESSION['role'] == 'Manager') { ?>
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?= base_url("index.php/home/facilities_list") ?>">Facilities</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?= base_url("index.php/home/request_list") ?>">Requests</a>
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
                    <img src="<?= base_url($_SESSION['link_profile']) ?>" style="max-height:42px; margin-right:8px" draggable="False">
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $this->session->userdata('name'); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?= base_url("index.php/home/logout") ?>">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <?php } ?>
    </div>
</nav>
