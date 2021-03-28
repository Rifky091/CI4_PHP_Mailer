<section id="header-home">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: ghostwhite;">
        <div class="container-fluid">
            <a href="<?= base_url().'/pengguna/dashboard' ?>" class="navbar-brand">
                <h4 class="logo" style="margin-left:3%;">schedular</h4>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mx-auto w-100 justify-content-end">
                    <li class="nav-item">
                        <a href="<?= base_url().'/pengguna/dashboard' ?>" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url().'/pengguna/listjadwal' ?>" class="nav-link">Schedule</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url().'/pengguna/listtask' ?>" class="nav-link">Task</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url().'/pengguna/profile' ?>" class="nav-link">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url().'/logout' ?>" class="nav-link">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>