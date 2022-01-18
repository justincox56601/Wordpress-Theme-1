<?php
    $args = array(
        'post_type' => "portfolio",
        'nopaging' => TRUE,

    );

    $portfolio = new WP_Query($args);

    $tags = portfolio_portfolio_get_tags($portfolio)

    
    

?>
<div class="section" id="portfolio-section">


    <h2>Portfolio</h2>
    <?php echo $tags ?>
    
    <div class="portfolio">
        <?php if ( $portfolio->have_posts() ) {
            while ( $portfolio->have_posts() ) {
                $portfolio->the_post(); ?>
                <?php 
                    $attachments = get_posts(array(
                        'post_type' => 'attachment', 
                        'post_mime_type' => 'image',
                        'numberposts' => -1, 
                        'post_status' => null, 
                        'post_parent' => get_the_ID(),  
                    ));
                    $img = "";
                    foreach($attachments as $att){ 
                        $pic = wp_get_attachment_url($att->ID);
                       $img .= "<img src='$pic' alt=''>"; 
                       //$img .= "ID: " . $att->ID . " Image URL: ". wp_get_attachment_url($att->ID) ."<br>" . wp_get_attachment_image($att->ID);
                    }

                    $link = get_post_meta(get_the_ID(), "_portfolio_link_value_key", true);
                ?>
                <div class="p-item">
                    <div class="image">
                        <img src="<?php echo wp_get_attachment_url($attachments[0]->ID) ?>" alt="">
                    </div>
                    <div class="content">
                        <div>
                            <h3><?php the_title(); ?></h3>
                            <p class="small"><?php echo portfolio_display_item_tags(get_the_ID());?></p>
                            <span class="button m-open"><p>Learn More</p></span>
                        </div>
                        
                    </div>
                    <div class="modal">
                        <!-- image slider, title, excerpt, visit Site -->
                        <div class="m-container">
                            <div class="m-image">
                                <?php echo $img?>
                                <span class="m-left"><span class="iconify" data-icon="bx:bxs-chevron-left" data-inline="false" ></span></span>
                                <span class="m-right"><span class="iconify" data-icon="bx:bxs-chevron-right" data-inline="false"></span></span>
                            </div>
                            
                            <div class="m-content">
                                <h3><?php the_title(); ?></h3>
                                <?php the_excerpt()?>
                                <a href="<?php echo $link ?>" target="_blank">Visit Site</a>
                                <span class="m-close"><span class="iconify" data-icon="eva:close-fill" data-inline="false"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            <?php } 
        } ?>
    </div>  
</div>

<?php wp_reset_postdata();?>