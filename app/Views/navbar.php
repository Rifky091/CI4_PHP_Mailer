<section id="header-home">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: ghostwhite;">
        <div class="container-fluid">
            <a href="<?php echo (session()->get('priviledge') == 'pengguna') ? base_url().'/pengguna' : base_url().'/admin'; ?>" class="navbar-brand">
                <h4 class="logo" style="margin-left:3%;">schedular</h4>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mx-auto w-100 justify-content-end">
                    <?php
                    if (session()->get('priviledge') == 'pengguna') { ?>
                        <?php
                        $link = explode("/", current_url());
                        ?>
                        <li class="nav-item">
                            <a href="<?= base_url().'/pengguna' ?>" class="nav-link active">Home</a>
                        </li>
                        <?php
                        if (count($link) > 4):
                        ?>
                        <li class="nav-item">
                            <a href="<?= base_url().'/pengguna/listJadwal' ?>" class="nav-link">Schedule</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url().'/pengguna/listTugas' ?>" class="nav-link">Task</a>
                        </li>
                        <?php
                        endif;
                        ?>
                        <li class="nav-item">
                            <a href="<?= base_url().'/pengguna/profile' ?>" class="nav-link">Profile</a>
                        </li>
                    <?php
                    }
                    else{ ?>
                        <li class="nav-item">
                            <a href="<?= base_url().'/admin' ?>" class="nav-link active">Home</a>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a href="<?= base_url().'/logout' ?>" class="nav-link">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>