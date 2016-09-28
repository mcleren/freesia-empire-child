<?php
/**
 * The template for displaying all pages.
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
	<div id="main">
	
	<!-- CUSTOM FORM CONTENT STARTS -->
	<?php echo lnx_quickquoteform();?>
	
	<style>
#lfm_product_widget-3 .three-column{
	    padding: 0 20px;
}
	.orange{
	color: #F8A41A !important;
}.green{
	color: #7BB643 !important;
}.blue-light{
	color: #009EE0 !important;
}.feature-content {
    position: relative;
border-top: 5px solid #009EE0;
}.home-box-icon {
    position: absolute;
    top: 40px;
    left: -43px; 
}.home-box-icon span {
    width: 45px;
    height: 45px;
    -webkit-border-radius: 40px;
    -moz-border-radius: 40px;
    border-radius: 40px;
    display: block;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    font-size: 24px;
    line-height: 44px;
    font-family: 'Genericons';
    background-color: #004579;
    text-align: center;
    color: #fff;
    -ms-transition: all 0.3s ease-out;
    -moz-transition: all 0.3s ease-out;
    -webkit-transition: all 0.3s ease-out;
    -o-transition: all 0.3s ease-out;
    transition: all 0.3s ease-out;
}#home-box-icon-plus:before {
    content: '\f510';
}.home-box-icon #home-box-icon-equal {
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    transform: rotate(90deg);
}#home-box-icon-equal:before {
    content: '\f448';	
}</style>
	<section id="lfm_moto_widget-3" class="widget widget_moto clearfix">
		<div class="column clearfix">
			<div class="three-column freesia-animation fadeInLeft" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;" data-wow-delay="0.1s">
				<div class="feature-content">
					<article>
						<h3 class="feature-title"><center><a class="orange" title="Our Belief" rel="bookmark" href="javascript:jQuery('#home-box-desc-1').slideToggle('slow')"><strong>Our</strong> Belief</a></center></h3>
						<p id="home-box-desc-1" style="display: none;">Our customers come first. This is more than just business to us, and purchasing a home should be more than that for you as well. Your home is your largest investment, and our team of skilled, experienced financial professionals can make your new purchase or refinancing process as hassle-free and efficient as possible. While we offer low rates and no closing cost options, we pride ourselves on the excellent relationships we build with clients and our superior service.</p>
					</article>
				</div>
				<!-- end .feature-content -->
			</div>
			<!-- end .three-column -->
			<div class="three-column freesia-animation fadeInLeft" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;" data-wow-delay="0.2s">
				<div class="feature-content">
					<article>
						<h3 class="feature-title"><center><a class="green" title="Our Mission" rel="bookmark" href="javascript:jQuery('#home-box-desc-2').slideToggle('slow')"><strong>Our</strong> Mission</a></center></h3>
						<p id="home-box-desc-2" style="display: none;">Our core focus is helping you achieve your homeownership goal. Whether you want to refinance or purchase a home, we provide stable and informative support throughout the entire process. When you feel empowered, then we are doing our job.</p>
					</article>
					<div class="home-box-icon"><span id="home-box-icon-plus"></span></div>
				</div>
				<!-- end .feature-content -->
			</div>
			<!-- end .three-column -->
			<div class="three-column freesia-animation fadeInLeft" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;" data-wow-delay="0.3s">
				<div class="feature-content">
					<article>
						<h3 class="feature-title"><center><a class="blue-light" title="Your Advantage" rel="bookmark" href="javascript:jQuery('#home-box-desc-3').slideToggle('slow')"><strong>Your</strong> Advantage</a></center></h3>
						<p id="home-box-desc-3" style="display: none;">Your Advantage</a></center>Welcome to Lenox Financial Mortgage Corporation dba WesLend Financial, where our high-level customer service puts us ahead of the other lenders in the game. <a>Contact Us</a> today and confidently move forward with your home financing process.</p>
					</article>
					<div class="home-box-icon"><span id="home-box-icon-equal"></span></div>
				</div>
				<!-- end .feature-content -->
			</div>
			<!-- end .three-column -->
		</div>
	</section>
	<section id="freesiaempire_portfolio_widget-3" class="widget widget_portfolio clearfix">
		<div class="portfolio-container clearfix">
			<div class="four-column-full-width freesia-animation zoomIn" data-wow-delay="0.3s">
				<h2 class="widget-title">ART OF WORK</h2>
				<p class="widget-highlighted-sub-title wow fadeInUp">Sed mattis ut ligula quis ultric ies. Integer vel condimentum enim. Praesent sed aliquet fringilla venenatis.</p>
			</div>
		</div>
	</section>
	<section id="freesiaempire_post_widget-3" class="widget widget_latest_blog">
		<div class="container clearfix">
			<h2 class="widget-title freesia-animation fadeInDown" data-wow-delay="1s">LATEST FROM BLOG</h2>
			<p class="latest-blog-sub-title freesia-animation fadeInDown" data-wow-delay="1s">Maecenas sit amet suscipit orci, sit amet blandit felis. Ut bibendum tellus vitae sagittis tempor.</p>
		</div>
	</section>
	<section id="freesiaempire_testimonial-3" class="widget widget_testimonial">
		<div class="testimonial_bg" style="background-image:url('http://demo.themefreesia.com/freesia-empire/wp-content/uploads/sites/6/2016/03/plx-img-2.jpg');">
			<div class="container clearfix">
				<img width="200" height="200" src="http://demo.themefreesia.com/freesia-empire/wp-content/uploads/sites/6/2016/01/quote-1.jpg" class="attachment-post-thumbnails size-post-thumbnails wp-post-image" alt="&#8211; August Ariana, pacific" title="&#8211; August Ariana, pacific" srcset="http://demo.themefreesia.com/freesia-empire/wp-content/uploads/sites/6/2016/01/quote-1.jpg 200w, http://demo.themefreesia.com/freesia-empire/wp-content/uploads/sites/6/2016/01/quote-1-150x150.jpg 150w" sizes="(max-width: 200px) 100vw, 200px"/><h2 class="widget-title">WHAT PEOPLE SAY ABOUT US</h2><p>&#8221; Sed vulputate libero in ex lacinia bibendum. Nam at placerat massa. Aenean a nisl eleifend, pellentesque mi vitae, posuere dolor. Sed porttitor blandit ante. Mauris porttitor nulla at lectus ultrices tempus. Maecenas ut nisl fermentum, tempor orci in &#8220;&#8221; Sed vulputate libero in ex lacinia bibendum. Nam at placerat massa. Aenean a nisl eleifend, pellentesque mi vitae, posuere dolor. Sed porttitor blandit ante. Mauris porttitor nulla at lectus ultrices tempus. Maecenas ut nisl fermentum, tempor orci in &#8220;</p>
				<cite>&#8211; August Ariana, pacific</cite>
			</div>
		</div>
	</section>
	<section id="newsletterwidget-3" class="widget widget_newsletterwidget">
		<h2 class="widget-title">Newsletter</h2>
		<div class="newsletter newsletter-widget"></div>
	</section>

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