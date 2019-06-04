<?php

// Include php files
include get_theme_file_path('/includes/shortcodes.php');

// Enqueue needed scripts
function needed_styles_and_scripts_enqueue() {
    
    // Add-ons

    
    // Custom script
    wp_enqueue_script( 'moc-custom-script', get_stylesheet_directory_uri() . '/assets/javascript/script.js' , array( 'jquery' ) );

}
add_action( 'wp_enqueue_scripts', 'needed_styles_and_scripts_enqueue' );

// Font Awesome Settings Customizer
function fa_customize_register( $wp_customize ) {
	$wp_customize->add_section(
        'fa_section',
        array(
            'title' => __( 'Font Awesome Settings', 'Divi' ),
            //'description' => __( 'This is a section for the typography', 'wp-bootstrap-starter' ),
            'priority' => 30,
        )
    );

    $wp_customize->add_setting( 'fa_settings', array(
        'default'   => 'default',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ) );

    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'fa_settings', array(
        'label' => __( 'Font Awesome Version', 'Divi' ),
        'section'    => 'fa_section',
        'settings'   => 'fa_settings',
        'type'    => 'select',
        'choices' => array(
            'default' => 'Font Awesome 4.7',
            'fa5' => 'Font Awesome 5',
        )
    ) ) );
}
add_action( 'customize_register', 'fa_customize_register' );


add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    if (get_theme_mod('fa_settings') === '') {
        // Font awesome version 4
        wp_enqueue_style( 'fa-4.7', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
    }

    if (get_theme_mod('fa_settings') === 'default') {
	    // Font awesome version 4
	    wp_enqueue_style( 'fa-4.7', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
	}

	if (get_theme_mod('fa_settings') === 'fa5') {
	    // Font awesome version 4
	    wp_enqueue_style( 'fa-5', 'https://use.fontawesome.com/releases/v5.6.3/css/all.css' );
	}
}

function cc_mime_types($mimes) {
$mimes['svg'] = 'image/svg+xml';
return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


add_filter( 'widget_text', 'do_shortcode' );

//Dynamic Year
function site_year(){
	ob_start();
	echo date( 'Y' );
	$output = ob_get_clean();
    return $output;
}
add_shortcode( 'site_year', 'site_year' );

//
// Your code goes below
//