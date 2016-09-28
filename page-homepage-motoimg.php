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
	
	<div id="main"><!-- Using page-homepage.php	-->
	<!-- CUSTOM FORM CONTENT STARTS -->
	<?php echo lfm_quickquoteform();?>
	
	<section id="lenox_product_widget" class="widget widget_product clearfix">
		<div class="container clearfix">
			<div class="two-column">
				<img class="attachment-post-thumbnails size-post-thumbnails wp-post-image" title="Purchase" src="/wp-content/uploads/2016/05/Home-Page-Purchase-Image.jpg" sizes="(max-width: 768px) 100vw, 768px" srcset="/wp-content/uploads/2016/05/Home-Page-Purchase-Image.jpg 768w, /wp-content/uploads/2016/05/Home-Page-Purchase-Image-300x227.jpg 300w" alt="Purchase" width="768" height="580" />
				<div class="product-content"><a href="purchase" class="btn-default vivid btn-orange" title="Purchase">Purchase &nbsp; ❭</a></div>
			</div>
			<div class="two-column">
				<img class="attachment-post-thumbnails size-post-thumbnails wp-post-image" title="Purchase" src="/wp-content/uploads/2016/05/Home-Page-Refinance-Image.jpg" sizes="(max-width: 768px) 100vw, 768px" srcset="/wp-content/uploads/2016/05/Home-Page-Refinance-Image.jpg 768w, /wp-content/uploads/2016/05/Home-Page-Refinance-Image-300x227.jpg 300w" alt="Purchase" width="768" height="580" />
				<div class="product-content"><a href="refinance" class="btn-default vivid btn-orange" title="Refinance">Refinance &nbsp; ❭</a></div>
			</div>
		</div>
	</section>
	
	<section id="lfm_moto_widget-3" class="widget widget_moto clearfix">
		<div class="container clearfix">
			<div id="our-mission" class="two-column freesia-animation zoomIn" style="visibility: visible; animation-name: zoomIn;">
				<img class="attachment-post-thumbnails size-post-thumbnails wp-post-image" title="Purchase" src="/wp-content/uploads/2016/05/Home-Page-Purchase-Image.jpg" sizes="(max-width: 768px) 100vw, 768px" srcset="/wp-content/uploads/2016/05/Home-Page-Purchase-Image.jpg 768w, /wp-content/uploads/2016/05/Home-Page-Purchase-Image-300x227.jpg 300w" alt="Our Mission" width="768" height="580" />
				<div class="moto-content">
					<h3><strong>Our</strong> Mission</h3>
					<p>Our core focus is helping you achieve your homeownership goal. Whether you want to refinance or purchase a home, we provide stable and informative support throughout the entire process. When you feel empowered, then we are doing our job.</p>					
				</div>
				<div class="home-box-icon"><span id="home-box-icon-plus"></span></div>
			</div>
			<div id="our-belief" class="two-column freesia-animation zoomIn" style="visibility: visible; animation-name: zoomIn;">
				<img class="attachment-post-thumbnails size-post-thumbnails wp-post-image" title="Purchase" src="/wp-content/uploads/2016/05/Home-Page-Purchase-Image.jpg" sizes="(max-width: 768px) 100vw, 768px" srcset="/wp-content/uploads/2016/05/Home-Page-Purchase-Image.jpg 768w, /wp-content/uploads/2016/05/Home-Page-Purchase-Image-300x227.jpg 300w" alt="Our Belief" width="768" height="580" />
				<div class="moto-content">
					<h3><strong>Our</strong> Belief</h3>
					<p>Our customers come first. This is more than just business to us, and purchasing a home should be more than that for you as well. Your home is your largest investment, and our team of skilled, experienced financial professionals can make your new purchase or refinancing process as hassle-free and efficient as possible. While we offer low rates and no closing cost options, we pride ourselves on the excellent relationships we build with clients and our superior service.</p>
				</div>
				<div class="home-box-icon"><span id="home-box-icon-equal"></span></div>
			</div>
			<div id="your-advantage" class="one-column freesia-animation fadeInLeft" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;" data-wow-delay="0.1s">
				<img class="attachment-post-thumbnails size-post-thumbnails wp-post-image" title="Purchase" src="/wp-content/uploads/2016/05/Home-Page-Slider-1.jpg" sizes="(max-width: 1288px) 100vw, 1288px" srcset="/wp-content/uploads/2016/05/Home-Page-Slider-1.jpg 1288w, /wp-content/uploads/2016/05/Home-Page-Purchase-Image-300x227 300w" alt="Your Advantage" width="1288" />
				<div class="moto-content">
					<h3><strong>Your</strong> Advantage</h3>
					<p>Your Advantage</a></center>Welcome to Lenox Financial Mortgage Corporation dba WesLend Financial, where our high-level customer service puts us ahead of the other lenders in the game. <a href="contact-us/" title="Contact Us">Contact Us</a> today and confidently move forward with your home financing process.</p>					
				</div>				
			</div>
		</div>
	</section>


<style>
.widget_moto .three-column{
	padding: 0 20px;
}

.widget_latest_blog .widget-title:after, 
.widget_latest_blog .widget-title:before {
	height: 0px;	
}

.widget_latest_blog {
	background: #f8f8f8;
	text-align: left;
	padding: 20px;
}
.widget_latest_blog .container {
	background: #fff;
	padding: 20px;
}
.latest-blog-sub-title {
	text-align: left;
}
@media only screen and (max-width: 1023px) {
	.widget_moto .three-column {
		width: 33%;
	}
	.widget_moto .three-column:nth-child(2n+3) {
 		clear: none;
	}
}
@media only screen and (max-width: 767px) {
	.widget_moto .three-column {
		width: 100%;
		padding: 0 0 60px 0;
	}	
}
</style>	
<!-- Latest Blog Widget ============================================= -->
<section id="freesiaempire_post_widget-3" class="widget widget_latest_blog clearfix">
	<div class="container clearfix">
		<div id="primary">
			<h2 class="widget-title freesia-animation fadeInDown" data-wow-delay="1s">LATEST FROM BLOG</h2>
			<p class="latest-blog-sub-title freesia-animation fadeInDown" data-wow-delay="1s">Maecenas sit amet suscipit orci, sit amet blandit felis. Ut bibendum tellus vitae sagittis tempor.</p>
			<?php
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
							$image .= get_the_post_thumbnail( $post->ID, 'post-thumbnails', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'<div class="blog-overlay">
										<a href="#">
											<span class="ico-link"></span>
										</a>
									</div><!-- end.blog-overlay -->'.'</div><!-- end.blog-img -->';
							echo $image;
						}?>
						<div class="blog-content freesia-animation fadeInUp" data-wow-delay="0.3s">
							<header class="entry-header">
								<h3 class="entry-title"><a rel="bookmark" href="<?php the_permalink();?>"><?php the_title(); ?> </a></h3>
							<?php if ( $checkbox != '' ) { ?>
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
							<?php } ?>
							</header><!-- end.entry-header -->
							<div class="entry-content"><p><?php echo substr(get_the_excerpt(), 0 , 120); ?> </p>
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
				the_widget( 'WP_Widget_Recent_Posts', $instance, $args );
				?>
			</aside>
			<aside id="newsletter-2" class="widget widget_recent_entries">
				<div class="newsletter newsletter-widget">

<script type="text/javascript">
//<![CDATA[
if (typeof newsletter_check !== "function") {
window.newsletter_check = function (f) {
    var re = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-]{1,})+\.)+([a-zA-Z0-9]{2,})+$/;
    if (!re.test(f.elements["ne"].value)) {
        alert("The email is not correct");
        return false;
    }
    for (var i=1; i<20; i++) {
    if (f.elements["np" + i] && f.elements["np" + i].required && f.elements["np" + i].value == "") {
        alert("");
        return false;
    }
    }
    if (f.elements["ny"] && !f.elements["ny"].checked) {
        alert("You must accept the privacy statement");
        return false;
    }
    return true;
}
}
//]]>
</script>
					<form action="#" onsubmit="return newsletter_check(this)" method="post"><input type="hidden" name="nr" value="widget"/><p><input class="newsletter-email" type="email" required name="ne" value="Email" onclick="if (this.defaultValue==this.value) this.value=''" onblur="if (this.value=='') this.value=this.defaultValue"/></p><p><input class="newsletter-submit" type="submit" value="Subscribe"/></p></form>
				</div>
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