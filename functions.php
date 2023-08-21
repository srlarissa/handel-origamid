<?php 

   function handel_add_woocommerce_support() {
        add_theme_support('woocommerce');
   }
   add_action('after_setup_theme', 'handel_add_woocommerce_support');

   function handel_add_style() {
        wp_register_style('handel-style', get_template_directory_uri() . '/style.css', [], '1.0.0', false);
        wp_enqueue_style('handel-style');
   }
   add_action('wp_enqueue_scripts', 'handel_add_style');

   function handel_custom_images(){
     add_image_size('slide', 1000, 800, ['center', 'top']);
     update_option('medium_crop', 1);
   }
   add_action('after_setup_theme', 'handel_custom_images');

?>