<?= $this->include('header') ?>
<title><?= esc($title); ?></title>
<?= $this->include('navbar') ?>

<?= $this->renderSection('content') ?>

<?= $this->include('footer') ?>