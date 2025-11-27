<?php get_header(); ?>

<!-- Page header with logo and tagline-->
<!-- <header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome to Our Blog!</h1>
            <p class="lead mb-0">A Bootstrap 5 starter layout for your next page</p>
        </div>
    </div>
</header> -->

<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-sm-12">
            <?php
            if (have_posts()) {
                while (have_posts()) {

                    the_post();

                    /* $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), "thumbnail"); */
                    /* $url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), "thumbnail"); */
            ?>
                    <div class="card mb-4 mt-4">
                        <!-- <a href="#!"><img class="card-img-top" src="<?php echo $url ?>" alt="..." /></a> -->
                        <div class="card-body">
                            <h2 class="card-title"><?php the_title(); ?></h2>
                            <p class="card-text"><?php the_content(); ?></p>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>