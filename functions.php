<?php

// register nav menu
function simple_bootstrap_theme_nav_config()
{
    add_theme_support("woocommerce", array(
        "thumbnail_image_width" => 150,
        "single_image_width" => 200,
        "product_grid" => array(
            "default_columns" => 3,
            "default_rows" => 4,
            "min_columns" => 2,
            "max_columns" => 3,
            "min_rows" => 2
        )
    ));

    register_nav_menus(array(
        "sbt_primary_menu_id" => "SBT Primary Menu (Top Menu)",
        "sbt_primary2_menu_id" => "SBT Primary2 Menu (Top Menu)",
        "sbt_secondary_menu_id" => "SBT Secondary Menu"
    ));

    add_theme_support('custom-logo', [
        "height" => 70,
        "width" => 95,
        "flex_height" => true,
        "flex_width" => true
    ]);

    // register theme support
    add_theme_support("post-thumbnails");

    add_theme_support("wc-product-gallery-zoom");
    add_theme_support("wc-product-gallery-lightbox");
    add_theme_support("wc-product-gallery-slider");

}

add_action("after_setup_theme", "simple_bootstrap_theme_nav_config");
// Diagnóstico temporal
/* add_action("after_setup_theme", function () {
    if (current_theme_supports("woocommerce")) {
        error_log("✅ Soporte de WooCommerce activado correctamente.");
    } else {
        error_log("❌ Soporte de WooCommerce NO está activado.");
    }
}); */


function simple_bootstrap_theme_load_scripts()
{
    // css files
    wp_enqueue_style("bootstrap", get_template_directory_uri()."/assets/css/bootstrap.min.css", array(), "1.0", "all");

    wp_enqueue_style("style", get_stylesheet_uri(), array(), "1.0", "all");

    wp_enqueue_style("animate", get_template_directory_uri()."/assets/css/animate.min.css", array(), "1.0", "all");

    wp_enqueue_style("owl", get_template_directory_uri() . "/assets/lib/owlcarousel/assets/owl.carousel.min.css", array(), "1.0", "all");
    
    wp_enqueue_style("fontawesome", get_template_directory_uri() . "/assets/lib/fontawesome/css/all.min.css", array(), "1.0", "all");

    wp_enqueue_style("bootstrapicons", get_template_directory_uri() . "/assets/lib/bi/bootstrap-icons.min.css", array(), "1.0", "all");

    wp_enqueue_style("main", get_template_directory_uri() . "/assets/css/main.css", array(), "1.0", "all");

    // js scripts
    wp_enqueue_script("jquery", get_template_directory_uri() . "/assets/js/jquery-3.7.1.min.js", array(), "1.0", true);

    wp_enqueue_script("bootstrap-bundle", get_template_directory_uri()."/assets/js/bootstrap.bundle.min.js", array(), "1.0", true);

    wp_enqueue_script("owl", get_template_directory_uri() . "/assets/lib/owlcarousel/owl.carousel.min.js", array(), "1.0", true);

    wp_enqueue_script("wow", get_template_directory_uri() . "/assets/js/wow.min.js", array(), "1.0", true);

    wp_enqueue_script("easing", get_template_directory_uri() . "/assets/lib/easing/easing.min.js", array(), "1.0", true);

    wp_enqueue_script("waypoints", get_template_directory_uri() . "/assets/lib/waypoints/waypoints.min.js", array(), "1.0", true);

    wp_enqueue_script("mainscript", get_template_directory_uri() . "/assets/js/main.js", array(), "1.0", true);

}

add_action("wp_enqueue_scripts", "simple_bootstrap_theme_load_scripts");



// adding li class
function simple_bootstrap_theme_add_li_class($classes, $items, $arguments)
{
    $classes[] = 'nav-item';
    return $classes;
}

add_filter("nav_menu_css_class", "simple_bootstrap_theme_add_li_class", 1, 3);

// adding class to anchor links
function simple_bootstrap_theme_add_anchor_links($atts, $items, $args)
{
    $atts['class'] = "nav-link text-white";
    return $atts;
}

add_filter("nav_menu_link_attributes", "simple_bootstrap_theme_add_anchor_links", 1, 3);

// WooCommerce modifications
if (class_exists('WooCommerce')) {
include_once get_template_directory().'/includes/wc-modifications.php';
}



// THEME CUSTOMIZER
function simple_bootstrap_theme_load_wp_customizer($wp_customize)
{
    $wp_customize->add_section("sec_copyright", array(
        "title" => "Copyright Section",
        "description" => "This is a copyright section",
    ));
    
     // adding settings/field
     $wp_customize->add_setting("set_copyright", array(
        "type" => "theme_mod",
        "default" => "",
        "sanitize_callback" => "sanitize_text_field",
     ));

     // control
     $wp_customize->add_control("set_copyright", array(
        "label" => "Copyright",
        "description" => "Please fill the copyright text",
        "section" => "sec_copyright",
        "type" => "text",
     ));
}

add_action("customize_register", "simple_bootstrap_theme_load_wp_customizer");


function esglobal_custom_hero_styles()
{
    $hero_bg = get_template_directory_uri() . '/assets/img/fondo_hero.jpg';
    echo "
    <style>
    .hero-section::before {
        background-image: url('{$hero_bg}') !important;
    }
    </style>
    ";
}
add_action('wp_head', 'esglobal_custom_hero_styles');