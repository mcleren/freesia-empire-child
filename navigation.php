<?php
/**
 * The template for displaying navigation.
 *
 * @package Theme Freesia
 * @subpackage Freesia Empire
 * @since Freesia Empire 1.0
 */
if ( !class_exists( 'Jetpack') || class_exists( 'Jetpack') && !Jetpack::is_module_active( 'infinite-scroll' ) ){
	if ( function_exists('wp_pagenavi' ) ) :
		wp_pagenavi();
	else: 
	global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) : ?>
		<ul class="default-wp-page clearfix">
			<li class="previous">
				<?php previous_posts_link( __( '&#10092; Previous Page', 'freesia-empire' ) ); ?>
			</li>
			<li class="next">
				<?php next_posts_link( __( 'Next Page &#10093;', 'freesia-empire' ) ); ?>
			</li>
		</ul>
		<?php  endif;
	endif; 
}?>