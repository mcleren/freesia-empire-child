<?php
/**
 * The template for displaying 404 pages
 *
 * @package Theme Freesia
 * @subpackage Freesia Empire
 * @since Freesia Empire 1.0
 */
get_header();
$freesiaempire_settings = freesiaempire_get_theme_options();
global $freesiaempire_content_layout;
if( $post ) {
	$layout = get_post_meta( $post->ID, 'freesiaempire_sidebarlayout', true );
}
if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
	$layout = 'default';
}
if( 'default' == $layout ) { //Settings from customizer
	if(($freesiaempire_settings['freesiaempire_sidebar_layout_options'] != 'nosidebar') && ($freesiaempire_settings['freesiaempire_sidebar_layout_options'] != 'fullwidth')){ ?>

<div id="primary">
	<?php }
}?>
<div class="site-content" role="main">
	<article id="post-0" class="post error404 not-found">
		<?php if ( is_active_sidebar( 'freesiaempire_404_page' ) ) :
			dynamic_sidebar( 'freesiaempire_404_page' );
		else:?>
		<section class="error-404 not-found">
			<?php 
			$path = current( explode( '/', trim( $_SERVER['REQUEST_URI'], '/' ) ) );
			if($path == 'careers' || $path == 'career') :
				echo lfm_media( array('postname'=>'Careers-Image') );
			?>			
			<div class="page-content">
				<p> <?php _e( 'Please visit our careers page <a href="' . site_url() . '/careers/" title="Careers">' . site_url() . '/careers/</a>' . ' to see our latest job opportunities.', 'freesia-empire' ); ?> </p>
			</div> <!-- .page-content -->	
			<?php 
			else:
				echo lfm_media( array('postname'=>'Reg-Page-Image-for-404-Message') );
			?>			
			<div class="page-content">
				<p> <?php _e( 'Please use the navigation bar above or visit our home page <a href="' . site_url() . '" title="' . get_bloginfo('name') . '">' . site_url() . '</a>', 'freesia-empire' ); ?> </p>
					<?php //get_search_form(); ?>
			</div> <!-- .page-content -->
			<?php endif; ?>
		</section> <!-- .error-404 -->
	<?php endif; ?>
	</article> <!-- #post-0 .post .error404 .not-found -->
</div> <!-- #content .site-content -->
<?php 
if( 'default' == $layout ) { //Settings from customizer
	if(($freesiaempire_settings['freesiaempire_sidebar_layout_options'] != 'nosidebar') && ($freesiaempire_settings['freesiaempire_sidebar_layout_options'] != 'fullwidth')): ?>
</div> <!-- #primary -->
<?php endif;
}
get_sidebar();
get_footer(); ?>