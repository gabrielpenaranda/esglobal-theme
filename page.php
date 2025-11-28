<?php get_header('secundario'); ?>

<!-- Page header with logo and tagline-->

<!-- Page content-->
<div class="container">
    <div class="row mt-5">
        <!-- Blog entries-->
        <div class="col-sm-12">
            <?php
            if (have_posts()) {
                while (have_posts()) {

                    the_post();


            ?>
                <article">
                    <a href="#!"><img class="card-img-top" src="<?php echo $url ?>" alt="..." /></a>
                    <div class="card-body">
                        <h2 class="card-title"><?php the_title(); ?></h2>
                        <p class="card-text"><?php the_content(); ?></p>
                    </div>
                </article>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
