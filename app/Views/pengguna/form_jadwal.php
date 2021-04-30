<?= $this->extend('with-login_layout') ?>

<?= $this->section('content') ?>

<section id="dashboard">
    <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="text-center">
                <h1 id="logo">Schedule Form</h1>
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
                <form action="<?php echo ($method == 2) ? base_url().'/pengguna/updateJadwal/'.$id_jadwal : base_url().'/pengguna/insertJadwal/'; ?>" method="post">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="login-form" name="email" placeholder="Email" value="<?= $profil['email'] ?>" readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-3">
                            <label for="nama_jadwal" class="form-label">Nama Jadwal</label>
                            <input type="text" class="form-control" id="login-form" name="nama_jadwal" placeholder="Nama Jadwal" value="<?php echo ($method == 2) ? $data['nama_jadwal'] : ''; ?>">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-3">
                            <label for="hari" class="form-label">Hari</label>
                            <select name="hari" class="form-control">
                                <option value="" disabled selected>-- Pilih Hari --</option>
                                <option value="Monday" <?php echo (($method == 2) && ($data['hari'] == "Monday")) ? 'selected' : '' ; ?>>Senin</option>
                                <option value="Tuesday" <?php echo (($method == 2) && ($data['hari'] == "Tuesday")) ? 'selected' : '' ; ?>>Selasa</option>
                                <option value="Wednesday" <?php echo (($method == 2) && ($data['hari'] == "Wednesday")) ? 'selected' : '' ; ?>>Rabu</option>
                                <option value="Thursday" <?php echo (($method == 2) && ($data['hari'] == "Thursday")) ? 'selected' : '' ; ?>>Kamis</option>
                                <option value="Friday" <?php echo (($method == 2) && ($data['hari'] == "Friday")) ? 'selected' : '' ; ?>>Jumat</option>
                                <option value="Saturday" <?php echo (($method == 2) && ($data['hari'] == "Saturday")) ? 'selected' : '' ; ?>>Sabtu</option>
                                <option value="Sunday" <?php echo (($method == 2) && ($data['hari'] == "Sunday")) ? 'selected' : '' ; ?>>Minggu</option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-3">
                            <label for="jam" class="form-label">Jam</label>
                            <input type="time" class="form-control" id="login-form" name="jam" placeholder="Jam" value="<?php echo ($method == 2) ? $data['jam'] : ''; ?>">
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