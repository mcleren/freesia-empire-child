<?php
/**
 * Template Name: Homepage Template
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
	<!-- Media Control Player ============================================= -->
	<?php if(isset($audio) && is_array($audio) && sizeof($audio) > 0) { ?>
	<!-- Begin Small Player -->
	<div id="small-player" class="js-slide-hidden">
		<!-- Begin Small Player Left -->
		<!--div id="small-player-left"></div-->
		<!-- End Small Player Left -->

		<!-- Begin Small Player Album Art -->
		<!--img id="small-player-album-art" amplitude-song-info="cover"/-->
		<span id="small-player-album-art-default" amplitude-song-info="cover" class="icon-earphone"></span>
		<!-- End Small Player Album Art -->

		<!-- Begin Small Player Middle -->
		<div id="small-player-middle">	
			<div id="small-player-middle-top">
				<div id="amplitude-close" class="amplitude-close amplitude-pause"></div>
				<!-- Begin Controls Container -->
				<div id="small-player-middle-controls">
					<div class="amplitude-play-pause amplitude-playing" amplitude-main-play-pause="true"></div>						
					<div id="amplitude-mute" class="amplitude-mute"></div>
					<!--div id="amplitude-volume" class="amplitude-volume">
						<input type="range" id="amplitude-volume-slider" class="amplitude-volume-slider" value="0"/>
					</div-->
					<span id="current-time">
						<span class="amplitude-current-minutes" amplitude-single-current-minutes="true">0</span>:<span class="amplitude-current-seconds" amplitude-single-current-seconds="true">00</span>/<span class="amplitude-duration-minutes" amplitude-single-duration-minutes="true">0</span>:<span class="amplitude-duration-seconds" amplitude-single-duration-seconds="true">00</span>
					</span>					
				</div>
				<!-- End Controls Container -->

				<!-- Begin Meta Container -->
				<div id="small-player-middle-meta">
					<div class="album-information"><span amplitude-song-info="artist"></span> <span amplitude-song-info="album"></span></div>
					<div id="now-playing-title" amplitude-song-info="name"></div>
				</div>
				<!-- End Meta Container -->				
			</div>
			
			<div id="small-player-middle-bottom">
				<!--div class="amplitude-song-time-visualization" amplitude-single-song-time-visualization="true" id="song-time-visualization"></div-->
				<div id="amplitude-song" class="amplitude-song">
					<input type="range" id="amplitude-song-slider" class="amplitude-song-slider" amplitude-singular-song-slider="true" value="0"/>
				</div>
			</div>
		</div>
		<!-- End Small Player Middle -->

		<!-- Begin Small Player Right -->
		<!--div id="small-player-right"></div-->
		<!-- End Small Player Right -->
	</div>
	<!-- End Small Player -->
	<script type="text/javascript">
		Amplitude.init(<?php echo json_encode($audio);?>);
	</script>
	<?php }?>
	<!-- end Media Control Player -->
		
	<div id="main"><!-- Using page-homepage.php	-->
	<!-- CUSTOM FORM CONTENT STARTS -->
	<?php echo lfm_quickquoteform();?>
	
	<section id="lenox_product_widget" class="widget widget_product clearfix">
		<div class="container clearfix">
			<div class="two-column">
				<?php $attachment = wp_get_attachment_by_post_name( 'Home-Page-Purchase-Image' );?>
				<a href="/purchase-loans/" title="Purchase">
					<img class="attachment-post-thumbnails size-post-thumbnails wp-post-image" title="<?php echo (isset($attachment->post_title))?$attachment->post_title:'';?>" src="<?php echo esc_url($attachment->org);?>" sizes="(max-width: 768px) 100vw, 768px" srcset="<?php echo esc_url($attachment->org);?> 768w, <?php echo esc_url($attachment->med);?> 300w" alt="<?php echo (isset($attachment->alt))?$attachment->alt:'';?>" width="768" height="580" />
				</a>	
				<div class="product-content"><h2><a href="/purchase-loans/" class="btn-default vivid btn-orange" title="Purchase">Purchase &nbsp; &#10093;</a></h2></div>
			</div>
			<div class="two-column">
				<?php $attachment = wp_get_attachment_by_post_name( 'Home-Page-Refinance-Image' );?>
				<a href="/refinance/" title="Refinance">
					<img class="attachment-post-thumbnails size-post-thumbnails wp-post-image" title="<?php echo (isset($attachment->post_title))?$attachment->post_title:'';?>" src="<?php echo esc_url($attachment->org);?>" sizes="(max-width: 768px) 100vw, 768px" srcset="<?php echo esc_url($attachment->org);?> 768w, <?php echo esc_url($attachment->med);?> 300w" alt="<?php echo (isset($attachment->alt))?$attachment->alt:'';?>" width="768" height="580" />
				</a>	
				<div class="product-content"><h2><a href="/refinance/" class="btn-default vivid btn-orange" title="Refinance">Refinance &nbsp; &#10093;</a></h2></div>
			</div>
		</div>
	</section>
	
	<section id="lfm_moto_widget-3" class="widget widget_moto clearfix">
		<div class="container clearfix">
			<div id="our-mission" class="two-column freesia-animation zoomIn" style="visibility: visible; animation-name: zoomIn;">
				<?php $attachment = wp_get_attachment_by_post_name( 'Our-Mission-Image' );?>
				<div class="two-image-moto clearfix" title="<?php echo (isset($attachment->post_title))?$attachment->post_title:'';?>" style="background-image:url('<?php echo esc_url($attachment->org);?>')">
					<div class="moto-content">
						<h3><strong>Our</strong> Mission</h3>
						<p>Our core focus is helping you achieve your homeownership goal. Whether you want to refinance or purchase a home, we provide stable and informative support throughout the entire process. When you feel empowered, then we are doing our job.</p>					
					</div>
				</div>
			</div>
			<div id="our-belief" class="two-column freesia-animation zoomIn" style="visibility: visible; animation-name: zoomIn;">
				<?php $attachment = wp_get_attachment_by_post_name( 'Our-Belief-Image' );?>
				<div class="two-image-moto clearfix" title="<?php echo (isset($attachment->post_title))?$attachment->post_title:'';?>" style="background-image:url('<?php echo esc_url($attachment->org);?>')">
					<div class="moto-content">
						<h3><strong>Our</strong> Belief</h3>
						<p>Our customers come first. This is more than just business to us, and purchasing a home should be more than that for you as well. Your home is your largest investment, and our team of skilled, experienced financial professionals can make your new purchase or refinancing process as hassle-free and efficient as possible. While we offer low rates and no closing cost options, we pride ourselves on the excellent relationships we build with clients and our superior service.</p>
					</div>
				</div>
			</div>
			<div id="your-advantage" class="one-column freesia-animation fadeInLeft" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;" data-wow-delay="0.1s">
				<?php $attachment = wp_get_attachment_by_post_name( 'Your-Advantage-Image' );?>
				<div class="one-image-moto clearfix" title="<?php echo (isset($attachment->post_title))?$attachment->post_title:'';?>" style="background-image:url('<?php echo esc_url($attachment->org);?>')">				
					<div class="moto-content">
						<h3><strong>Your</strong> Advantage</h3>
						<p>Welcome to Lenox Financial Mortgage Corporation dba WesLend Financial, where our high-level customer service puts us ahead of the other lenders in the game. <a href="/mortgage-quick-quote/" title="Contact Us">Contact Us</a> today and confidently move forward with your home financing process.</p>					
					</div>
				</div>	
			</div>
			<div id="home-box-icon-plus-cont" class="home-box-icon freesia-animation fadeInDown" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInDown;" data-wow-delay="0.1s"><span id="home-box-icon-plus"></span></div>
			<div id="home-box-icon-equal-cont" class="home-box-icon freesia-animation fadeInUp" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;" data-wow-delay="0.1s"><span id="home-box-icon-equal"></span></div>
		</div>
	</section>


<!-- Latest Blog Widget ============================================= -->
<section id="freesiaempire_post_widget-3" class="widget widget_latest_blog clearfix">
	<div class="container clearfix">
		<div id="primary">
			<?php
			//<p class="latest-blog-sub-title freesia-animation fadeInDown" data-wow-delay="1s">Maecenas sit amet suscipit orci, sit amet blandit felis. Ut bibendum tellus vitae sagittis tempor.</p>
			//the_widget( 'freesiaempire_post_widget', array('number' => 1), $args ); 
			?>
			<div class="column clearfix">
				<div class="one-column">
					<?php
					$get_featured_posts = new WP_Query( array( 'posts_per_page' => 1 ) ); 	
					$i=1;
					while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post(); 
						$format = get_post_format();
						if($format != ''){ ?>
						<article class="format-<?php echo $format; ?>">
						<?php
						}
						if( has_post_thumbnail() ) {
							$image = '';        			
							$title_attribute = get_the_title( $post->ID );
							$image .= '<div class="blog-img freesia-animation fadeInDown" data-wow-delay="0.3s">';
							$image .= get_the_post_thumbnail( $post->ID, 'medium', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'<div class="blog-overlay">
										<a href="' . get_permalink() . '">
											<span class="ico-link"></span>
										</a>
									</div><!-- end.blog-overlay -->'.'</div><!-- end.blog-img -->';
							echo $image;
						}?>
						<div class="blog-content freesia-animation fadeInUp" data-wow-delay="0.3s">
							<header class="entry-header">
								<h2 class="widget-title freesia-animation fadeInDown" data-wow-delay="1s">Latest Lenox/WesLend Blog</h2>
								<h3 class="entry-title"><a rel="bookmark" href="<?php the_permalink();?>"><?php the_title(); ?> </a></h3>
							<?php /*if ( $checkbox != '' ) { ?>
								<div class="entry-meta clearfix">
							<?php if ( current_theme_supports( 'post-formats', $format ) ) {
								printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
									sprintf(''),
									esc_url( get_post_format_link( $format ) ),
									get_post_format_string( $format ) );
								} ?> 
									<span class="author vcard"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a></span>
									<span class="posted-on"><a title="<?php echo esc_attr( get_the_time() ); ?>" href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span>
								</div>  <!-- end .entry-meta -->
							<?php }*/ ?>
							</header><!-- end.entry-header -->
							<div class="entry-content"><p><?php echo get_the_excerpt(); ?> </p>
							<?php $freesiaempire_tag_text = $freesiaempire_settings['freesiaempire_tag_text'];
							$excerpt = get_the_excerpt();
							$content = get_the_content();
							if(strlen($excerpt) < strlen($content)){ ?>
								<a class="more-link" title="<?php the_title_attribute();?>" href="<?php the_permalink();?>">
									<?php
									if($freesiaempire_tag_text == 'Read More' || $freesiaempire_tag_text == ''):
										_e('Read More', 'freesia-empire');
									else:
										echo esc_attr($freesiaempire_tag_text);
									endif;?>
								</a>
							<?php } ?>
							</div> <!-- end .entry-content -->
						</div> <!-- end .blog-content -->
						<?php if($format != ''){ ?>
						</article>
						<?php }
					endwhile;
					
					// Reset Post Data
					wp_reset_postdata(); 
					?>
				</div> <!-- end .two-column -->
			</div> <!-- end .column -->
		</div>	<!-- end #primary -->
		<aside id="secondary">
			<aside id="recent-posts-2" class="widget widget_recent_entries">
				<?php 
				// echo '<h2 class="widget-title">Recent Posts</h2>';
				// echo wpb_postsbycategory();
				the_widget( 'WP_Widget_Recent_Posts', array('title'=>'Recent Posts'));
				?>
			</aside>
			<aside id="newsletter-2" class="widget widget_recent_entries">
				<?php echo lfm_emailsubscriptionform();?>
			</aside>
		</aside>
	</div> <!-- end .container -->
</section><!-- end .widget_latest_blog -->
	
	<!-- CUSTOM FORM CONTENT ENDS -->
	
	<?php global $post;
	if( have_posts() ) {
		while( have_posts() ) {
			the_post(); ?>
		<div class="entry-content">			
			<?php the_content();
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