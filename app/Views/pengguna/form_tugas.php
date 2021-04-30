<?= $this->extend('with-login_layout') ?>

<?= $this->section('content') ?>

<section id="dashboard">
    <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="text-center">
                <h1 id="logo">Task Form</h1>
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
                <form action="<?php echo ($method == 2) ? base_url().'/pengguna/updateTugas/'.$id_tugas : base_url().'/pengguna/insertTugas/'; ?>" method="post">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="login-form" name="email" placeholder="Deadline" value="<?= $profil['email'] ?>" readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-3">
                            <label for="nama_tugas" class="form-label">Nama Tugas</label>
                            <input type="text" class="form-control" id="login-form" name="nama_tugas" placeholder="Nama Tugas" value="<?php echo ($method == 2) ? $data['nama_tugas'] : ''; ?>">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-3">
                            <label for="tipe_tugas" class="form-label">Tipe Tugas</label>
                            <select name="tipe_tugas" class="form-control">
                                <option value="" disabled selected>-- Pilih Tipe Tugas --</option>
                                <option value="Individu" <?php echo (($method == 2) && ($data['tipe_tugas'] == "Individu")) ? 'selected' : '' ; ?>>Individu</option>
                                <option value="Kelompok" <?php echo (($method == 2) && ($data['tipe_tugas'] == "Kelompok")) ? 'selected' : '' ; ?>>Kelompok</option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="datetime-local" class="form-control" id="login-form" name="deadline" placeholder="Deadline" value="<?php echo ($method == 2) ? $deadline : ''; ?>">
                        </div>
                    </div>
                        <div class="col-lg-11 col-md-11 col-sm-11 col-10 d-lg-flex justify-content-lg-end d-md-flex justify-content-md-end d-sm-flex justify-content-sm-end d-flex justify-content-end my-3">
                            <button type="submit" name="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection() ?>