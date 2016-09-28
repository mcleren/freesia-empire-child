<?php
/**
 * Template Name: Subpage Template
 *
 * Displays the home page template.
 *
 * @package Theme Freesia
 * @subpackage Freesia Empire
 * @since Freesia Empire 1.0
 */

get_header();
	$freesiaempire_settings = freesiaempire_get_theme_options();
	global $post;
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
	}else{ // for page/ post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){ ?>
<div id="primary">
	<?php }
	}?>
	<div id="main">Using: subpage-template.php
	<?php global $post;
	if( have_posts() ) {
		while( have_posts() ) {
			the_post(); ?>
		<div class="entry-content">
			<?php 
				if ( has_post_thumbnail() ) {
					$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				?>
				<div class="main-slider">
					<div class="layer-slider-static">
						<div class="slides">
							<div class="image-slider clearfix" style="background-image: url('<?php echo $feat_image;?>');" title="<?php echo get_the_title();?>">
								<div class="container">
								<article class="slider-content clearfix freesia-animation fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
									<h2 class="slider-title"><?php echo get_the_title();?></h2>
									<div class="slider-text"><h3><?php echo simple_fields_value('sub_heading_text');?></h3></div>
									&nbsp;
									<div class="slider-buttons">
										<a title="View Existing Mortgage" href="<?php echo simple_fields_value('heading_link_url');?>" class="btn-default vivid"><?php echo simple_fields_value('heading_link_text');?></span></a>
									</div>
								</article>
								</div>
							</div>
						</div>
					</div>
				</div>
				&nbsp;
				<?php }?>
				
				<div id="tabs-container" class="clearfix">
					<ul class="tabs-menu">
						<?php $tabs_title_values = simple_fields_values("tab_title");
						for($i=0; $i < sizeof($tabs_title_values); $i++) {
							echo '<li' . (($i==0)?' class="current"':'') . '><a href="#tab-' . ($i+1) . '">' . $tabs_title_values[$i] . '</a></li>';
						}?>						
					</ul>
					<div class="tab">
					<?php $tabs_content_values = simple_fields_values("tab_content");
					for($i=0; $i < sizeof($tabs_content_values); $i++) {
						echo '<div id="tab-' . ($i+1) . '" class="tab-content' . (($i==0)?' tab-first':'') . '">' . $tabs_content_values[$i] . ' </div>';
					}?>
					</div>
				</div>
				<?php 				
				
				echo '<!-- CONTENT STARTS-->';
				the_content();				
				echo '<!-- CONTENT ENDS-->';
				
				wp_link_pages( array( 
				'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'freesia-empire' ),
				'after'             => '</div>',
				'link_before'       => '<span>',
				'link_after'        => '</span>',
				'pagelink'          => '%',
				'echo'              => 1
				) ); ?>
		</div> <!-- entry-content clearfix-->
		<?php  comments_template(); ?>
	<?php }
	} else { ?>
	<h1 class="entry-title"> <?php _e( 'No Posts Found.', 'freesia-empire' ); ?> </h1>
	<?php
	} ?>
	</div> <!-- #main -->
	<?php 
if( 'default' == $layout ) { //Settings from customizer
	if(($freesiaempire_settings['freesiaempire_sidebar_layout_options'] != 'nosidebar') && ($freesiaempire_settings['freesiaempire_sidebar_layout_options'] != 'fullwidth')): ?>
</div> <!-- #primary -->
<?php endif;
}else{ // for page/post
	if(($layout != 'no-sidebar') && ($layout != 'full-width')){
		echo '</div><!-- #primary -->';
	} 
}
get_sidebar();
get_footer(); ?>