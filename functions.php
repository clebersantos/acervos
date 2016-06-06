<?php 

// variáveis

define ('CHILD_DIRECTORY', get_stylesheet_directory_uri() );
define ('PARENT_DIRECORY', get_template_directory_uri() );

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles',99);
function child_enqueue_styles() {
    $parent_style = 'parent-style';
    wp_enqueue_style( $parent_style, PARENT_DIRECORY . '/style.css' );
    wp_enqueue_style( 'child-style', CHILD_DIRECTORY . '/style.css' );
     //wp_enqueue_style( 'child-style',get_stylesheet_directory_uri() . '/custom.css', array( $parent_style ));

    wp_enqueue_style( 'alizee-font-awesome', CHILD_DIRECTORY. '/fonts/font-awesome.min.css' );

    // wp_enqueue_script('slick', get_stylesheet_directory_uri() . '/js/slick.min.js', array('jquery'), true );
    wp_enqueue_script('child-script', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), true );

    // wp_enqueue_script( 'alizee-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'), true );
}


function themeblvd_time_ago($date) {
 
	global $post;
 
	$date = $date; //get_post_time('G', true, $post);
 
	/**
	 * Where you see 'themeblvd' below, you'd
	 * want to replace those with whatever term
	 * you're using in your theme to provide
	 * support for localization.
	 */ 
 
	// Array of time period chunks
	$chunks = array(
		array( 60 * 60 * 24 * 365 , __( 'ano', 'themeblvd' ), __( 'anos', 'themeblvd' ) ),
		array( 60 * 60 * 24 * 30 , __( 'mês', 'themeblvd' ), __( 'meses', 'themeblvd' ) ),
		array( 60 * 60 * 24 * 7, __( 'semana', 'themeblvd' ), __( 'semanas', 'themeblvd' ) ),
		array( 60 * 60 * 24 , __( 'dia', 'themeblvd' ), __( 'dias', 'themeblvd' ) ),
		array( 60 * 60 , __( 'hora', 'themeblvd' ), __( 'horas', 'themeblvd' ) ),
		array( 60 , __( 'minutos', 'themeblvd' ), __( 'minutos', 'themeblvd' ) ),
		array( 1, __( 'segundo', 'themeblvd' ), __( 'segundos', 'themeblvd' ) )
	);
 
	if ( !is_numeric( $date ) ) {
		$time_chunks = explode( ':', str_replace( ' ', ':', $date ) );
		$date_chunks = explode( '-', str_replace( ' ', '-', $date ) );
		$date = gmmktime( (int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0] );
	}
 
	$current_time = current_time( 'mysql', $gmt = 0 );
	$newer_date = strtotime( $current_time );
 
	// Difference in seconds
	$since = $newer_date - $date;
 
	// Something went wrong with date calculation and we ended up with a negative date.
	if ( 0 > $since )
		return __( 'sometime', 'themeblvd' );
 
	/**
	 * We only want to output one chunks of time here, eg:
	 * x years
	 * xx months
	 * so there's only one bit of calculation below:
	 */
 
	//Step one: the first chunk
	for ( $i = 0, $j = count($chunks); $i < $j; $i++) {
		$seconds = $chunks[$i][0];
 
		// Finding the biggest chunk (if the chunk fits, break)
		if ( ( $count = floor($since / $seconds) ) != 0 )
			break;
	}
 
	// Set output var
	$output = ( 1 == $count ) ? '1 '. $chunks[$i][1] : $count . ' ' . $chunks[$i][2];
 
 
	if ( !(int)trim($output) ){
		$output = '0 ' . __( 'seconds', 'themeblvd' );
	}
 
	$output .= __(' atrás', 'themeblvd');
 
	return $output;
}
 
// Filter our themeblvd_time_ago() function into WP's the_time() function
add_filter('the_time', 'themeblvd_time_ago');