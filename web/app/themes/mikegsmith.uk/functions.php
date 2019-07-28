<?php
/*remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');*/

function enqueue_child_theme_styles(){
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}
add_action('wp_enqueue_scripts', 'enqueue_child_theme_styles', PHP_INT_MAX);

/*function clean_script_tag($input) {
    $input = str_replace("type='text/javascript' ", '', $input);
    $input = str_replace("type=\"text/javascript\" ", '', $input);
    return str_replace("'", '"', $input);
}
add_filter('script_loader_tag', 'clean_script_tag');

function clean_style_tag($input) {
    $input = str_replace('type="text/css" ', '', $input);
    return str_replace("'", '"', $input);
}
add_filter('style_loader_tag',  'clean_style_tag');*/