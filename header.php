<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('title'); ?></title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Bootstrap Icons -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> -->
    <!-- Estilos personalizados -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo bloginfo("title");
                }
                ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Formaciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
                </ul> -->
                <?php
                wp_nav_menu(array(
                    "theme_location" => "sbt_primary_menu_id",
                    "container" => false,
                    "items_wrap" => '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">%3$s</ul>'
                ));
                ?>
                <!-- <div class="ms-auto d-flex align-items-center">
                    <span class="me-3">$0,00 <i class="bi bi-cart-fill"></i></span>
                </div> -->
                <?php if (class_exists('WooCommerce')) : ?>
                    <!-- Carrito de compras y Usuario -->
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                        <li class="nav-item position-relative">
                            <a class="nav-link p-0 position-relative d-inline-block" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('View cart', 'textdomain'); ?>">
                                <i class="fas fa-shopping-cart fa-lg"></i>
                                <span class="badge bg-eg-verde-1 text-dark rounded-circle position-absolute"
                                    style="top: -6px; right: -6px; font-size: 0.6rem; min-width: 16px; height: 16px; padding: 0; line-height: 16px;">
                                    <?php echo WC()->cart->get_cart_contents_count(); ?>
                                </span>
                            </a>
                        </li>

                        <li class="nav-item position-relative ms-0 ms-lg-2">
                            <?php if (is_user_logged_in()) : ?>
                                <a class="nav-link p-0 position-relative d-inline-block" href="<?php echo get_permalink(get_option("woocommerce_myaccount_page_id")); ?>" title="<?php _e('User', 'textdomain'); ?>">
                                <?php else : ?>
                                    <a class="nav-link p-0 position-relative d-inline-block" href="<?php echo get_permalink(get_option("woocommerce_myaccount_page_id")); ?>" title="<?php _e('Login/Register', 'textdomain'); ?>">
                                    <?php endif; ?>
                                    <i class="fas fa-user fa-lg"></i>
                                    </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div id="page-content">