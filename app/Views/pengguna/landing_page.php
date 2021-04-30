<?= $this->extend('no-login_layout') ?>

<?= $this->section('content') ?>

<section id="panel-landing">
    <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="text-center">
                <h1 class="logo-landing">schedular</h1><br>
                <h3 style="padding-top: -5%;">Your Smart Future Scheduler</h3>
                <a href="<?= base_url().'/login' ?>" class="btn btn-dark btn-lg mt-3"><i class="fas fa-sign-in"></i> LOGIN/SIGNUP</a>
            </div>
        </div>
    </div>
</section>
    <section id="info-schedular">
        <div class="container-fluid">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 text-center mb-5">
                        <i class="far fa-calendar-alt fa-7x"></i>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                        <h3>Apa itu Schedular?</h3>
                        <h6>Schedular adalah aplikasi untuk pegawai, mahasiswa, maupun siswa sekolah
                            untuk mencatat tugas serta jadwal kegiatan mereka, dan mereka akan mudah
                            mengingat jadwal atau deadline tugas mereka melalui email yang dikirimkan
                            aplikasi Schedular ini.</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="info-tasks">
        <div class="container-fluid">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-12 mb-5">
                        <h3>Simpan Jadwal Dan Tugas Anda Bersama Kami</h3>
                        <h6>Schedular berkomitmen untuk memberikan peringatan mengenai jadwal
                        dan deadline tugas anda melalui pesan email, serta menjamin keamanan data
                        pribadi anda.</h6>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 text-center">
                        <i class="fas fa-tasks fa-7x"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>