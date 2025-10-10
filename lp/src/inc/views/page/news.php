<?php $this->view('components/header', false); ?>

<main class="main">
    <h1><?php echo get_the_title(); ?></h1>
    <div class="block_editor_content">
        <?php the_content(); ?>
    </div>
</main>

<?php $this->view('components/footer', false); ?>