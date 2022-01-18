<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title("", true, "right")?></title>
    <?php wp_head();?>
    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>
</head>
<body>
<div class="mobile-nav-icon">
    <div class="one"></div>
    <div class="two"></div>
    <div class="three"></div>
</div>
<nav>
    
    <?php wp_nav_menu(array(
        "theme_location" => "primary"
    ))?>
</nav>    
    
