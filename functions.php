<?php
// Charge manuellement les hooks Astra si surcharge du template complet
//require_once get_template_directory() . '/inc/core/hooks/class-astra-hooks.php';

function enqueue_child_styles() {
    // Styles du thème parent Astra
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    // Feuille de style principale du thème enfant
    wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( 'parent-style' ) );

    // Feuille de style supplémentaire happyhues.css
    wp_enqueue_style(
        'happyhues',
        get_stylesheet_directory_uri() . '/happyhues.css',
        array( 'child-style' ),
        filemtime( get_stylesheet_directory() . '/happyhues.css' )
    );
}
add_action( 'wp_enqueue_scripts', 'enqueue_child_styles' );

add_filter('body_class', function($classes){
    $classes[] = 'happy-theme';
    return $classes;
});

add_action('wp_enqueue_scripts', function () {
  // 1) Parent Astra
  wp_enqueue_style(
    'astra-style',
    get_template_directory_uri() . '/style.css',
    [],
    wp_get_theme('astra')->get('Version')
  );

  // 2) Enfant (après parent)
  wp_enqueue_style(
    'universfantastiques-child',
    get_stylesheet_uri(),
    ['astra-style'],
    wp_get_theme()->get('Version')
  );
}, 20);


?>