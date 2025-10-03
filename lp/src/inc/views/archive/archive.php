<?php $this->view('components/header', false); ?>

<main class="main">
    <?php if (have_posts()) : ?>

    <section class="article_list">
        <h1><?php echo get_queried_object()->label; ?></h1>

        <?php while (have_posts()) : ?>
        <?php the_post(); ?>
        <article class="item">
            <a class="link" href="<?php echo htmlEsc(get_the_permalink()); ?>">
                <h2><?php echo get_the_title(); ?></h2>
            </a>
        </article>

        <?php endwhile; ?>
    </section>

    <?php endif; ?>
</main>

<?php $this->view('components/footer', false); ?>