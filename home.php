<?php get_header(); ?>

<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries -->
        <div class="col-md-12">
            <div class="row mt-5">
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();

                        $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                        $url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id, "thumbnail") : false;
                ?>
                        <div class="col-lg-4 mb-4">
                            <div class="card h-100">
                                <?php if ($url) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img class="card-img-top blog" src="<?php echo esc_url($url); ?>" alt="<?php the_title(); ?>" />
                                    </a>
                                <?php endif; ?>
                                <div class="card-body d-flex flex-column">
                                    <h2 class="card-title">
                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                    <p class="card-text flex-grow-1"><?php the_excerpt(); ?></p>
                                    <a class="btn btn-primary mt-auto" href="<?php the_permalink(); ?>">Read more →</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<p>No posts found.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>