<?php get_header(); 
/*
    1) hero section
    2) portfolio
    3) about
    4)contact
*/
get_template_part("content/content", 'hero-section');
get_template_part("content/content", 'portfolio-section');
get_template_part("content/content", 'about-section');
get_template_part("content/content", 'contact-section');
?>



<?php get_footer();?>