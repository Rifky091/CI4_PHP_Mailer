<?= $this->extend('with-login_layout') ?>

<?= $this->section('content') ?>

<section id="auth">
    <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="text-center">
                <h1 id="logo">Your Profile</h1>
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mx-auto text-center">
                    <form action="<?= base_url() ?>/pengguna/updateProfile/<?= $id_pengguna ?>" method="POST">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-4 mt-2 mb-2">
                                <label for="Username" class="col-form-label">Username</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-8 mt-2 mb-2">
                                <input type="text" class="form-control" id="login-form" name="username" placeholder="Username" value="<?= $data['username'] ?>">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-4 mt-2 mb-2">
                                <label for="Email" class="col-form-label">Email</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-8 mt-2 mb-2">
                                <input type="email" class="form-control" id="login-form" name="email" placeholder="Email" value="<?= $data['email'] ?>">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-4 mt-2 mb-2">
                                <label for="Password" class="col-form-label">Password</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-8 mt-2 mb-2">
                                <input type="password" class="form-control" id="password-form" name="password" placeholder="Password">
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-8 col-8 ms-auto mt-3">
                                <button type="submit" class="btn btn-dark"><i class="fas fa-save"></i> Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>