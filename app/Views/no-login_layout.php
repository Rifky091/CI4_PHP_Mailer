<?= $this->include('header') ?>
<title><?= esc($title); ?></title>

<?= $this->renderSection('content') ?>

<?= $this->include('footer') ?>