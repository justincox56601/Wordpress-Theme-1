<?php get_header(); ?>
<h1>The Single</h1>
<?php if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		$attachments = get_posts(array(
			'post_type' => 'attachment', 
			'post_mime_type' => 'image',
			'numberposts' => -1, 
			'post_status' => null, 
			'post_parent' => get_the_ID(), 
		));
		$img = "";
		//var_dump($attachments);
		//echo "Count: " . count($attachments) ."<br>";
		echo "ID: " . $attachments[0]->ID . "<br>";
		echo "URL: " . wp_get_attachment_url($attachments[0]->ID) . "<br>";
		the_title();
		?> <img src="<?php echo wp_get_attachment_url($attachments[0]->ID)?>" alt="" width="300"> <?php
        //the_content();
	} 
}  ?>

<?php get_footer();
