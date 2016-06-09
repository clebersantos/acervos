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

add_image_size( 'sidebar', 280, 126, true );

/**
 * Sidebar structure
 *
 * @param string 
 * @return void
 */
function register_theme_sidebar( $id, $name )
{
	register_sidebar( array(
		'id'          => $id,
		'name'          => $name,
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_head'   => '<div class="widget-head">',
		'after_head'    => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		'before_body'   => '<div class="widget-body">',
		'after_body'    => '</div>',
		'before_foot'   => '<div class="widget-foot">',
		'after_foot'    => '</div>',
	) );
}

/**
* Register sidebars
*
* @param void
* @return void
*/
if(function_exists('register_sidebar'))
{	
	register_theme_sidebar('sidebar-1','home-destaques');

}


function acervos_time_ago($date) {
 
	global $post;
 
	$date = $date; //get_post_time('G', true, $post);
 
	/**
	 * Where you see 'acervos' below, you'd
	 * want to replace those with whatever term
	 * you're using in your theme to provide
	 * support for localization.
	 */ 
 
	// Array of time period chunks
	$chunks = array(
		array( 60 * 60 * 24 * 365 , __( 'ano', 'acervos' ), __( 'anos', 'acervos' ) ),
		array( 60 * 60 * 24 * 30 , __( 'mês', 'acervos' ), __( 'meses', 'acervos' ) ),
		array( 60 * 60 * 24 * 7, __( 'semana', 'acervos' ), __( 'semanas', 'acervos' ) ),
		array( 60 * 60 * 24 , __( 'dia', 'acervos' ), __( 'dias', 'acervos' ) ),
		array( 60 * 60 , __( 'hora', 'acervos' ), __( 'horas', 'acervos' ) ),
		array( 60 , __( 'minutos', 'acervos' ), __( 'minutos', 'acervos' ) ),
		array( 1, __( 'segundo', 'acervos' ), __( 'segundos', 'acervos' ) )
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
		return __( 'sometime', 'acervos' );
 
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
		$output = '0 ' . __( 'seconds', 'acervos' );
	}
 
	$output .= __(' atrás', 'acervos');
 
	return $output;
}
 
// Filter our acervos_time_ago() function into WP's the_time() function
add_filter('the_time', 'acervos_time_ago');


function filter_highlight_content_widget( $content, $highlight, $entry ) {
	
	$class_separator = "";
	$entry["date"] 	 = acervos_time_ago($entry["date"]);
	$i 				 = $entry["interator"];
	$c 				 = "";

	if( $i == 1)
		$class_separator = "highlight-main";
	elseif( $i==2 )
		$class_separator = "highlights-small col-md-6";

	if( $i!=3)
		$c = "<div class='{$class_separator}'>";
	
	$c .= "<article id='post-{$entry["ID"]}' class='card {$class_excerpt} item-{$i}'>";
	$c .=	"<div class='entry-thumb'>";
	$c .=		"<a href={$entry["permalink"]} title='{$highlight["highlight_title"]}'>{$entry["thumbnail"]}</a>";
	$c .=	"</div>";
	$c .=	"<header class='entry-header'>";	
	$c .=		"<div class='entry-meta'>{$entry["categories"]}</div>";
	$c .=		"<h1 class='entry-title'>";
	$c .=			"<a href={$entry["permalink"]}' title='{$highlight["highlight_title"]}'>{$entry["title"]}</a>";
	$c .= 		"</h1>";
	$c .=		"<div class='entry-meta'>{$entry["date"]}</div>";
	// $c .=		"<div class='entry-excerpt'>{$entry["excerpt"]}</div>";
	$c .=	"</header>";
	$c .= "</article>";
	
	if( $i != 2 )
		$c .= "</div>";

	return $c;
}
add_filter('highlight_content_widget', 'filter_highlight_content_widget', 10, 3);

add_filter('highlight_before_widget', function() { return ''; });
add_filter('highlight_after_widget', function() { return ''; });