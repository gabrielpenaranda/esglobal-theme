<?php

// 1. ELIMINAR EL SIDEBAR POR DEFECTO (Correcto)
remove_action("woocommerce_sidebar", "woocommerce_get_sidebar");


// 2. ABRIR Y CERRAR EL CONTENEDOR PRINCIPAL (Correcto)
// Estos hooks envuelven TODO el contenido de la tienda.
function open_container_row_div_classes()
{
    echo "<div class='container'><div class='row mt-5'>";
}
add_action("woocommerce_before_main_content", "open_container_row_div_classes", 1); // Baja la prioridad a 1 para que sea lo primero

function close_container_row_div_classes()
{
    echo "</div></div>";
}
add_action("woocommerce_after_main_content", "close_container_row_div_classes", 999); // Sube la prioridad para que sea lo último

// --- Funciones del Layout (Definidas Globalmente) ---

/**
 * Abre la columna del Sidebar (col-sm-4)
 * Se ejecuta al principio del contenido principal.
 */
function open_sidebar_column_grid()
{
    echo "<div class='col-sm-4'>";
}


/**
 * Muestra solo las categorías de productos (tu contenido de sidebar)
 * Se ejecuta inmediatamente después de abrir la columna del sidebar.
 */
function mostrar_solo_categorias_woocommerce()
{
    echo '<div id="custom-categories-sidebar" class="widget woocommerce">';

    // 1. Título de la sección
    echo '<h4 class="widget-title">Categorías de Productos</h4>';

    // 2. Lista de categorías:
    $args = array(
        'taxonomy'      => 'product_cat',
        'hierarchical'  => 1,
        'title_li'      => '',
        'hide_empty'    => 1,
        'show_count'    => 1,
        'orderby'       => 'menu_order',
    );

    echo '<ul>';
    wp_list_categories($args);
    echo '</ul>';

    echo '</div>';
}


/**
 * Cierra la columna del Sidebar.
 * Se ejecuta antes de abrir la columna de contenido.
 */
function close_sidebar_column_grid()
{
    echo "</div>";
}


/**
 * Abre la columna de Contenido de Productos (col-sm-8)
 * Se ejecuta inmediatamente después de cerrar la columna del sidebar.
 */
function open_content_column_grid()
{
    echo "<div class='col-sm-8'>";
}


/**
 * Cierra la columna de Contenido de Productos.
 * Se ejecuta después del loop de productos.
 */
function close_content_column_grid()
{
    echo "</div>"; // CORREGIDO: Cierre correcto
}


// --- Lógica Condicional para aplicar los hooks ---

function load_template_layout()
{
    // Solo aplica los cambios si estamos en la página de la tienda
    if (is_shop() || is_product_category() || is_product_tag()) {

        // 1. INYECTAR SIDEBAR (COLUMNA 1: col-sm-4)
        add_action("woocommerce_before_main_content", "open_sidebar_column_grid", 5);
        add_action('woocommerce_before_main_content', 'mostrar_solo_categorias_woocommerce', 6);
        add_action("woocommerce_before_main_content", "close_sidebar_column_grid", 7); // Cierra la columna del sidebar

        // 2. INYECTAR CONTENIDO (COLUMNA 2: col-sm-8)
        add_action("woocommerce_before_main_content", "open_content_column_grid", 8); // Abre el contenido antes de que empiece el loop
        add_action("woocommerce_after_main_content", "close_content_column_grid", 4); // Cierra el contenido antes del cierre global

        // 3. OTRAS MODIFICACIONES (Correctas)
        add_filter("woocommerce_show_page_title", "__return_false"); // Simplificación de tu función toggle_page_tittle
        remove_action("woocommerce_before_shop_loop", "woocommerce_result_count", 20);
        remove_action("woocommerce_before_shop_loop", "woocommerce_catalog_ordering", 30);
    }
}
add_action("template_redirect", "load_template_layout");


// --- Hooks que aplican globalmente ---
remove_action("woocommerce_before_main_content", "woocommerce_breadcrumb", 20);
add_filter('woocommerce_coupons_enabled', '__return_false');
