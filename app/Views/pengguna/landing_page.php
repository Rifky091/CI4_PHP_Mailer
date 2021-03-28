<?= $this->extend('no-login_layout') ?>

<?= $this->section('content') ?>

<section id="panel-landing">
    <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="text-center">
                <h1 class="logo-landing">schedular</h1><br>
                <h3 style="padding-top: -5%;">Your Smart Future Scheduler</h3>
                <a href="<?= base_url().'/login' ?>" class="btn btn-dark btn-lg mt-3">LOGIN/SIGNUP</a>
            </div>
        </div>
    </div>
</section>
    <section id="info-schedular">
        <div class="container-fluid">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <h3>Manage your schedule!</h3>
                <h6>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsam perferendis corrupti, consequuntur vitae eius, ipsum iure nostrum delectus voluptatem molestias labore voluptatum sit quos nemo odit quod fugit. Provident, voluptatum. Lorem ipsum
                    dolor, sit amet consectetur adipisicing elit. Beatae labore illo, corporis iusto ex nobis magnam expedita nihil soluta! Quia ex pariatur ut est, possimus illum fuga beatae et accusantium! Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Esse eveniet ut cum quo debitis dicta similique, quae, consectetur vel nam atque aperiam possimus ea aspernatur omnis quasi quod maxime dignissimos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque reprehenderit aspernatur
                    aliquam, fuga, blanditiis voluptatibus quo neque minima minus aut iste numquam excepturi non? Harum, accusamus reprehenderit. Illum, accusantium voluptatum?</h6>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>