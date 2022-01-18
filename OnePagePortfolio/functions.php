<?php 

/*
=======================
    includes
=======================
*/

include get_template_directory(). "/portfolio_cpt/portfolio_cpt.php";
include get_template_directory(). "/contact_cpt/contact_cpt.php";



/*
=======================
    Engueueing Scripts
=======================
*/

function portfolio_enqueue_scripts(){
    wp_enqueue_style("portfoliostyle", get_template_directory_uri() . "/css/portfolio.css", array(), "1.0", 'all');
    wp_enqueue_script('portfoliojs', get_template_directory_uri() . "/js/portfolio.js", array(), "1.0", TRUE);
}
add_action("wp_enqueue_scripts", "portfolio_enqueue_scripts");

function portfolio_custom_blocks(){
    wp_enqueue_script('blockjs', get_template_directory_uri() . "/js/blocks.js", array("wp-blocks", "wp-i18n", "wp-editor"), "1.0", TRUE);
    wp_enqueue_style("blockstyle", get_template_directory_uri() . "/css/block.css", array(), "1.0", 'all');
}
add_action("enqueue_block_editor_assets", "portfolio_custom_blocks");

/*
=======================
    Register Menus
=======================
*/
function portfolio_register_menus(){
    register_nav_menu("primary", "Main Header Navigation");
}
add_action("init", "portfolio_register_menus");
/*
=======================
    Theme Supports
=======================
*/

add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('custom-logo', array(
    "flex-width" => true,
    "flex-height" => true,
));
add_theme_support('html5');
add_theme_support('title-tag');


