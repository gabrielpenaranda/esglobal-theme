<?php
remove_action("woocommerce_sidebar", "woocommerce_get_sidebar");

function open_container_row_div_classes()
{
    echo "<div class='container'><div class='row mt-5'>";
}

add_filter("woocommerce_before_main_content", "open_container_row_div_classes", 5);

function close_container_row_div_classes()
{
    echo "</div></div>";
}

add_filter("woocommerce_after_main_content", "close_container_row_div_classes", 5);




function load_template_layout()
{
    if (is_shop()) {

        function open_sidebar_column_grid()
        {
            echo "<div class='col-sm-4'>";
        }

        add_filter("woocommerce_before_main_content", "open_sidebar_column_grid", 6);

        // add_action("woocommerce_before_main_content", "woocommerce_get_sidebar", 7);


        /**
         * Paso 2: Inyecta la función de lista de categorías directamente en el lugar del sidebar.
         */
        function mostrar_solo_categorias_woocommerce()
        {
            echo '<div id="custom-categories-sidebar" class="widget woocommerce">';

            // 1. Título de la sección
            echo '<h4 class="widget-title">Categorías de Productos</h4>';

            // 2. Lista de categorías:
            // Argumentos para wp_list_categories para listar las categorías de WooCommerce
            $args = array(
                'taxonomy'      => 'product_cat', // Taxonomía de las categorías de producto
                'hierarchical'  => 1,             // Muestra la jerarquía (categorías padre/hijo)
                'title_li'      => '',            // Elimina el título predeterminado de la lista
                'hide_empty'    => 1,             // Oculta categorías sin productos
                'show_count'    => 0,             // Muestra el número de productos (1 para mostrar, 0 para ocultar)
                'orderby'       => 'menu_order',  // Ordenar por el orden definido en el menú
            );

            echo '<ul>';
            wp_list_categories($args);
            echo '</ul>';

            echo '</div>';
        }
        // Agregamos nuestra nueva función de categorías en el hook original del sidebar.
        add_action('woocommerce_before_main_content', 'mostrar_solo_categorias_woocommerce', 7);


        function close_sidebar_column_grid()
        {
            echo "</div>";
        }

        add_filter("woocommerce_before_main_content", "close_sidebar_column_grid", 8);


        function open_content_column_grid()
        {
        echo "<div class='col-sm-8'>";
        }

        add_filter("woocommerce_before_main_content", "open_content_column_grid", 9);


        function close_content_column_grid()
        {
        echo "</div'>";
        }

        add_filter("woocommerce_before_main_content", "close_content_column_grid", 11);


        function toggle_page_tittle($val)
        {
            $val = false;
            return $val;
        }

        add_filter("woocommerce_show_page_title", "toggle_page_tittle");

        remove_action("woocommerce_before_shop_loop", "woocommerce_result_count", 20);
        remove_action("woocommerce_before_shop_loop", "woocommerce_catalog_ordering", 30);

}

add_action("template_redirect", "load_template_layout");


// remove elements from archive-product.php
remove_action("woocommerce_before_main_content", "woocommerce_breadcrumb", 20);

add_filter('woocommerce_coupons_enabled', '__return_false');
