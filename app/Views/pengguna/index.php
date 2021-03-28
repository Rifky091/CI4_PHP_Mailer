<?= $this->extend('with-login_layout') ?>

<?= $this->section('content') ?>

<section id="dashboard">
    <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="text-center">
                <h1 id="logo">schedular</h1>
            </div>
            <div id="login-card" style="margin-left: 5%; margin-right: 5%; padding-top: 3%;">
                <div class="row text-center">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <h2 style="font-family: 'Exo 2', sans-serif;">SCHEDULE</h2>
                        <a href="<?= base_url().'/pengguna/listjadwal/' ?>" class="btn btn-dark w-75 mt-4 mb-4">EDIT SCHEDULE</a>
                        <a href="<?= base_url().'/pengguna/addjadwal' ?>" class="btn btn-dark w-75 mb-4">CREATE SCHEDULE</a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <h2 style="font-family: 'Exo 2', sans-serif;">TASK</h2>
                        <a href="<?= base_url().'/pengguna/listtask' ?>" class="btn btn-dark w-75 mt-4 mb-4">EDIT TASK</a>
                        <a href="<?= base_url().'/pengguna/addtask' ?>" class="btn btn-dark w-75 mb-4">CREATE TASK</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection() ?>