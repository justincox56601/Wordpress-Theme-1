<?php

/*
========================
    Portflio Custom Post Type
========================
*/

function portfolio_portfolio_cpt(){
    $labels = array(
        "name" => "Portfolio",
        "singular_name" => "Portfolio",
        "add_new" => 'Add New',
        "all_items" => "All Items",
        "add_new_item" => "Add New",
        "edit_item" => "Edit Item",
        "new_item" => "New Item",
        'view_item' => "View Item",
        "search_item" => "Search Portfolio",
        "not_found" => "No Items Found",
        "not_found_in_trash" => "No Items Found In Trash",
        "parent_item_colon" => "Parent Item",
    );
    $args = array(
        "labels" => $labels, 
        "public" => TRUE, 
        "has_archive" => TRUE,
        'publicly_querable' => TRUE,
        "query_var" => true,
        "rewrite" => true,
        "capability_type" => 'post',
        'hierarchical' => FALSE,
        "supports" => array(
            "title", 'editor', "excerpt", "thumbnail", "revisions", "page-attributes", 
        ),
        "taxonomies" => array(
            "category", "post_tag",
        ),
        "menu_position" => 5,
        'exclude_from_search' => FALSE,
        'menu_icon' => 'dashicons-format-gallery',
    );
    register_post_type("portfolio", $args);
}
add_action("init", "portfolio_portfolio_cpt");

function portfolio_link_meta_box(){
    add_meta_box(
        "portfolio_link",
        "Portfolio Link",
        "portfolio_link_callback",
        "portfolio",
        "normal",
        "high"
    );
}
add_action('add_meta_boxes', "portfolio_link_meta_box");

function portfolio_link_callback($post){
    wp_nonce_field("portfolio_save_link_data", "portfolio_link_meta_box_nonce");
    $value = get_post_meta($post->ID, "_portfolio_link_value_key", true);
    echo '<label for="portfolio_link_field">Link: </label>';
    echo "<input type='url' id='portfolio_link_field' name='portfolio_link_field' value='". esc_url_raw($value) ."' size='25'>";
    
    
}

function portfolio_save_link_data($post_id){
    if(! isset($_POST["portfolio_link_meta_box_nonce"])){ 
        return;
    }
    if(! wp_verify_nonce($_POST["portfolio_link_meta_box_nonce"], "portfolio_save_link_data")){
        return;
    }   
    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE){
        return;
    }
    if(! current_user_can("edit_post", $post_id)){
        return;
    }
    if(! isset($_POST["portfolio_link_field"])){
        return;
    }

    $link = esc_url_raw($_POST["portfolio_link_field"]);

    update_post_meta($post_id, "_portfolio_link_value_key", $link);
}
add_action("save_post", "portfolio_save_link_data");

function portfolio_portfolio_get_tags($p){
    $tags = array();
    if( $p->have_posts()){
        while ( $p->have_posts() ) {
            $p->the_post();
            $tAry = get_the_tags(get_the_ID()); 
            if($tAry){
                foreach($tAry as $t){
                $tags[] = $t->name;
                }
            }
        }
    }
    $tags = array_unique($tags);
    $resp = "<div class='p-tags'><p class='p-tag'>All</p>";
    foreach($tags as $t){
        $resp .= "<p class='p-tag'>" . $t . "</p>";
    }
    $resp .= "</div>";
    return $resp;
}

function portfolio_display_item_tags($ID){
    $tAry = get_the_tags($ID);
    $tags = array();
    if($tAry){
        foreach($tAry as $t){
            $tags[]= strtoupper($t->name);
        }
        $tags = implode(" / ", $tags);
        return $tags;
    }else{
        return "";
    }
}