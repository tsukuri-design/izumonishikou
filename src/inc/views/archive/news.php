<?php $this->view('components/header', false); ?>

<main class="main">
    <?php Mvc::run('components/news/list'); ?>
</main>

<?php $this->view('components/footer', false); ?>