<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#F1F4F5">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url("index.php/home") ?>">Quiz 2</a>
        <!-- Button for smaller-size -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if ($this->uri->uri_string() == "home") { ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url("index.php/home") ?>">Book List</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= base_url("index.php/home") ?>">Book List</a>
                    </li>
                <?php } ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="<?= base_url("index.php/home/logout") ?>">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
