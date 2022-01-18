<?php
/*
============================
    Contact Form Custom Contact Type
============================
*/
function portfolio_contact_cpt(){
    $labels = array(
        "name" => "Contact",
        "singular_name" => "Contact",
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
        "has_archive" => false,
        'publicly_querable' => TRUE,
        "query_var" => true,
        "rewrite" => false,
        "capability_type" => 'post',
        'hierarchical' => FALSE,
        "supports" => array(
            "title", 'editor', 
        ),
        "taxonomies" => array(),
        "menu_position" => 5,
        'exclude_from_search' => TRUE,
        'menu_icon' => 'dashicons-email-alt',
    );
    register_post_type("contact", $args);
}
add_action("init", "portfolio_contact_cpt");

/*
============================
    Contact Form Custom Meta box
============================
*/

function contact_email_meta_box(){
    add_meta_box(
        "contact_email",
        "Contact Email",
        "contact_email_callback",
        "contact",
        "normal",
        "high"
    );
}
add_action('add_meta_boxes', "contact_email_meta_box");


function contact_email_callback($post){
    wp_nonce_field("contact_email_save_data", "contact_email_meta_box_nonce");
    $value = get_post_meta($post->ID, "_contact_email_value_key", true);
    echo '<label for="contact_email_field">Email: </label>';
    echo "<input type='text' id='contact_email_field' name='contact_email_field' value='". esc_attr($value) ."' size='25'>";
      
}

function contact_email_save_data($post_id){
    if(! isset($_POST["contact_email_meta_box_nonce"])){return;}
    if(! wp_verify_nonce($_POST["contact_email_meta_box_nonce"], "contact_email_save_data")){ return;}   
    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE){return;}
    if(! current_user_can("edit_post", $post_id)){return;}
    if(! isset($_POST["contact_email_field"])){return;}

    $email = sanitize_text_field($_POST["contact_email_field"]);

    update_post_meta($post_id, "_contact_email_value_key", $email);
}
add_action("save_post", "contact_email_save_data");

function contact_form_post(){
    if($_POST["name"] != "" && $_POST["email"] != "" && $_POST["message"] != ""){
        $name = esc_attr($_POST["name"]);
        $email = sanitize_email($_POST["email"]);
        $message = esc_attr($_POST["message"]);
        $args = array(
            "post_author" => 0,
            "post_content" => $message,
            "post_title" => $name,
            "post_type" => "contact",
            "post_status" => "publish",
            "meta_input" => array(
                "_contact_email_value_key" => $email
            )
        );

        if(wp_insert_post($args) >0){
            $to = get_bloginfo("admin_email");
            $subject = $name . " just sent you a message";
            $email_message = "Hey Justin, you just recieved the following message from $name.  $message";
            wp_mail($to, $subject, $email_message);

            echo "That's really interesting.  Let me think on it for a bit and I will get back to you shortly.";
        }else{
            echo "It seems something has gone wrong.";
        }
    }
    else{
        echo "Seems like you are missing something.  Wanna fix that?";
    }
    
    die();
}
add_action('wp_ajax_nopriv_contact_form_post', 'contact_form_post');
add_action('wp_ajax_contact_form_post', 'contact_form_post');


