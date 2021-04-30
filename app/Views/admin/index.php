<?= $this->extend('with-login_layout') ?>

<?= $this->section('content') ?>

<section id="dashboard">
    <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="text-center">
                <h1 id="logo">User Table</h1>
            </div>
            <div id="login-card" class="mx-5 pt-5 px-5">
                <div class="text-center">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($pengguna as $data) { ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $data['username'] ?></td>
                                <td><?= $data['email'] ?></td>
                                <td>
                                    <a href="<?= base_url().'/admin/delete/'.$data['id_pengguna'] ?>" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection() ?>