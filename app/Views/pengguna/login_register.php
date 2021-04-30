<?= $this->extend('no-login_layout') ?>

<?= $this->section('content') ?>

<section id="auth">
    <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="text-center">
                <h1 id="logo">schedular</h1>
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
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <form action="<?= base_url() ?>/login-auth" method="POST">
                            <div class="input-group-mb3">
                                <h2 style="font-family: 'Exo 2', sans-serif;" class="text-center">LOGIN</h2>
                                <div class="form-group mt-5 mb-5">
                                    <input type="text" class="form-control" id="login-form" name="username" placeholder="Username" style="margin-left: 5%">
                                </div>
                                <div class="form-group mb-5">
                                    <input type="password" class="form-control" id="password-form" name="password" placeholder="Password" style="margin-left:5%;">
                                </div>
                                <div class="form-group mb-5">
                                    <button type="submit" class="btn btn-dark btn-login"><i class="fas fa-sign-in"></i> Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <form action="<?= base_url() ?>/register" method="POST">
                            <div class="input-group-mb3">
                                <h2 style="font-family: 'Exo 2', sans-serif;" class="text-center">SIGN UP</h2>
                                <div class="form-group mt-5 mb-3">
                                    <input type="text" class="form-control" id="login-form" name="username_reg" placeholder="Username" style="margin-left:5%;">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="email" class="form-control" id="email-form" name="email" placeholder="Email" style="margin-left:5%;">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" class="form-control" id="password-form" name="password_reg" placeholder="Password" style="margin-left:5%;">
                                </div>
                                <div class="form-group mb-3 ms-auto">
                                    <button type="submit" class="btn btn-dark btn-register"><i class="fas fa-sign-in-alt"></i> Sign Up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>