<?php
    /*
        About me section : my image
    */
    $args = array(
        'post_type' => "page",
        "name" => "about",
        "page_limit" => 1

    );

    $about = new WP_Query($args);
?>
<div class="dark">
    <div class="section" id="about-section">
        <h2>About</h2>
        <?php if($about->have_posts()){
            while($about->have_posts()){
                $about->the_post();
                the_content();
            }
        } ?>

    </div>
</div>

<?php wp_reset_postdata();?>