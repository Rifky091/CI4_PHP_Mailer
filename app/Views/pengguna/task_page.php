<?= $this->extend('with-login_layout') ?>

<?= $this->section('content') ?>

<section id="dashboard">
    <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="text-center">
                <h1 id="logo">Task Table</h1>
            </div>
            <div id="login-card" class="mx-5 pt-5 px-5">
                <?php
                if(session()->getFlashData('success')){
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashData('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
                </div>
                <?php
                }
                ?>
                <?php
                if(session()->getFlashData('danger')){
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashData('danger') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
                </div>
                <?php
                }
                ?>
                <div class="text-center">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Title</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($tugas as $data) { ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $data['nama_tugas'] ?></td>
                                <td><?= $data['deadline'] ?></td>
                                <td>
                                    <a href="<?= base_url().'/pengguna/editTugas/'.$data['id_tugas'] ?>" class="btn btn-warning">
                                        <i class="fas fa-pencil"></i> Edit
                                    </a>
                                    <a href="<?= base_url().'/pengguna/deleteTugas/'.$data['id_tugas'] ?>" class="btn btn-success">
                                        <i class="fas fa-check"></i> Selesai
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