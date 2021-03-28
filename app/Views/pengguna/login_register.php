<?= $this->extend('no-login_layout') ?>

<?= $this->section('content') ?>

<section id="auth">
    <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="text-center">
                <h1 id="logo">schedular</h1>
            </div>
            <div id="login-card" style="margin-left: 5%; margin-right: 5%; padding-top: 3%;">
                <div class="row text-center">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <form action="">
                            <div class="input-group-mb3 justify-content-md-center">
                                <h2 style="font-family: 'Exo 2', sans-serif;">LOGIN</h2>
                                <div class="form-group mt-5 mb-5">
                                    <input type="text" class="form-control" id="login-form" placeholder="Username" style="margin-left: 5%">
                                </div>
                                <div class="form-group mb-5">
                                    <input type="password" class="form-control" id="password-form" placeholder="Password" style="margin-left:5%;">
                                </div>
                                <button type="submit" class="btn btn-dark" style="margin-left: 60%;">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <form action="">
                            <div class="input-group-mb3">
                                <h2 style="font-family: 'Exo 2', sans-serif;">SIGN UP</h2>
                                <div class="form-group mt-5 mb-3">
                                    <input type="text" class="form-control" id="login-form" placeholder="Username" style="margin-left:5%;">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" id="email-form" placeholder="Email" style="margin-left:5%;">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" class="form-control" id="password-form" placeholder="Password" style="margin-left:5%;">
                                </div>
                                <button type="submit" class="btn btn-dark"  style="margin-left: 55%;">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>