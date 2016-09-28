<?php
/**
 * Displays the header content
 *
 * @package Theme Freesia
 * @subpackage Freesia Empire
 * @since Freesia Empire 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
$freesiaempire_settings = freesiaempire_get_theme_options(); ?>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php
$keywords = get_post_meta(get_the_ID (), "meta-box-lfm-text_meta_keywords", true);
$description = get_post_meta(get_the_ID (), "meta-box-lfm-textarea_meta_description", true);
$robots = get_post_meta(get_the_ID (), "meta-box-lfm-dropdown_robots", true);
if(is_home() || is_category() || is_single())
	$robots = 'NOINDEX, FOLLOW';
echo trim($description)?'<meta name="description" content="' . $description . '">' . "\n":'';
echo trim($keywords)?'<meta name="keywords" content="' . $keywords . '">' . "\n":'';
echo trim($robots)?'<meta name="robots" content="' . $robots . '">' . "\n":'';
?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
<!-- Masthead ============================================= -->
<header id="masthead" class="site-header">
	<?php
				if($header_image = $freesiaempire_settings['freesiaempire_display_header_image'] == 'top'){
					do_action('freesiaempire_header_image');
				}
				echo '<div class="top-header">
						<div class="container clearfix">';
						//do_action('freesiaempire_site_branding');
						echo '<div id="site-branding">
								<img src="' . get_stylesheet_directory_uri() . '/images/Lenox-WesLend_Dual_Brand_Logo.svg" id="site-logo" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" width="400" height="79">							
						</div>';

						echo '<div class="menu-toggle">      
								<div class="line-one"></div>
								<div class="line-two"></div>
								<div class="line-three"></div>
							</div>';

						echo '<div class="header-info clearfix">';
							if(has_nav_menu('social-link') && $freesiaempire_settings['freesiaempire_top_social_icons'] == 0):
								echo '<div class="header-social-block">';
									do_action('social_links');
								echo '</div>'.'<!-- end .header-social-block -->';
							endif;
							/* if( is_active_sidebar( 'freesiaempire_header_info' )) {
								dynamic_sidebar( 'freesiaempire_header_info' );
							} */
							?>
							<!-- Contact Us ============================================= -->
							<div id="freesiaempire_contact_widgets-2" class="info clearfix">
								<h3 class="widget-title">Contact Title</h3> <!-- end .widget-title -->
								<ul>
									<li class="icon-apply-online"><a href="https://corporate.lenoxhomeloans.com/startapp">Apply Online</a></li>
									<li class="icon-phone"><?php echo lfm_campaign_toolfree_ajx();?></li>		
								</ul>
							</div><!-- end .contact_widget -->
							<?php
						echo ' </div> <!-- end .header-info -->';
						?>
							<!-- Main Header============================================= -->
							<div id="sticky_header">
								<div class="container clearfix">
									<!-- Main Nav ============================================= -->
									<?php
										/*if (has_nav_menu('primary')) { ?>
									<?php $args = array(
										'theme_location' => 'primary',
										'container'      => '',
										'items_wrap'     => '<ul class="menu">%3$s</ul>',
										); ?>
									<nav id="site-navigation" class="main-navigation clearfix">
										<?php wp_nav_menu($args);//extract the content from apperance-> nav menu ?>
									</nav> <!-- end #site-navigation -->
									<?php } else {// extract the content from page menu only ?>
									<nav id="site-navigation" class="main-navigation clearfix">
										<?php	wp_page_menu(array('menu_class' => 'menu')); ?>
									</nav> <!-- end #site-navigation -->
									<?php }*/ ?>
									
									<div id="content-contactbar-nav" class="header-contact-block" style="display: none">
										<div class="contact-links clearfix">
											<ul>
												<li class="icon-phone"><?php echo lfm_campaign_toolfree_ajx();?></li>
											</ul>
										</div><!-- end .contact-links -->										
									</div><!-- end .nav-contact-block -->
									<?php /*
									<div id="content-socialbar-nav" class="header-social-block" style="display: none">
										<div class="social-links clearfix">
											<ul>
												<li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="https://www.facebook.com/pages/Lenox-Financial-Mortgage-Corporation/376321825734875"><span class="screen-reader-text">Facebook</span></a></li>
												<li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="https://www.linkedin.com/company/weslend-financial?trk=top_nav_home"><span class="screen-reader-text">LinkedIn</span></a></li>
												<li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="https://twitter.com/LenoxLoans"><span class="screen-reader-text">Twitter</span></a></li>
												<li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="https://plus.google.com/u/0/b/117723656656373361479/+LenoxFinancialMortgageCorporationSantaAna/posts"><span class="screen-reader-text">Google Plus</span></a></li>
												<li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="/blog/"><span class="screen-reader-text">Blog</span></a></li>
											</ul>
										</div><!-- end .social-links -->
									</div><!-- end .nav-social-block -->
									*/ ?>
									
								</div> <!-- end .container -->
							</div> <!-- end #sticky_header -->
						<?php
					echo '</div> <!-- end .container -->
				</div> <!-- end .top-header -->';
			if($header_image = $freesiaempire_settings['freesiaempire_display_header_image'] == 'below'){
				do_action('freesiaempire_header_image');
			} 
			
		$enable_slider = $freesiaempire_settings['freesiaempire_enable_slider'];
		freesiaempire_slider_value();
		lfm_image_sliders();
		/*if ($enable_slider=='frontpage'|| $enable_slider=='enitresite'){
			if(is_front_page() && ($enable_slider=='frontpage') ) {
				if($freesiaempire_settings['freesiaempire_slider_type'] == 'default_slider') {
						//freesiaempire_page_sliders();
						lfm_image_sliders();
				}else{
					if(class_exists('Freesia_Empire_Plus_Features')):
						freesiaempire_image_sliders();
					endif;
				}
			}
			if($enable_slider=='enitresite'){
				if($freesiaempire_settings['freesiaempire_slider_type'] == 'default_slider') {
						//freesiaempire_page_sliders();
						lfm_image_sliders();
				}else{
					if(class_exists('Freesia_Empire_Plus_Features')):
						freesiaempire_image_sliders();
					endif;
				}
			}
		}*/
		
		if(is_page()) {
			// Load a template part: inc/content-banner.php into this template
			get_template_part('inc/content', 'banner');
		}
				
		//if(!is_page_template('page-templates/freesiaempire-corporate.php') && !is_page_template('alter-front-page-template.php') && !is_page()) {
		/*if((!is_page_template('page-templates/freesiaempire-corporate.php') && !is_page_template('alter-front-page-template.php') && !has_post_thumbnail()) || is_single() || is_home()) {
			if (('' != freesiaempire_header_title()) || function_exists('bcn_display_list')) {
				if(is_home()) {
					if($freesiaempire_settings['freesiaempire_blog_header_display'] == 'show'){ ?>
						<div class="page-header clearfix">
							<div class="container">
									<h2 class="page-title"><?php echo freesiaempire_header_title();?></h2> <!-- .page-title -->
									<?php freesiaempire_breadcrumb(); ?>
							</div> <!-- .container -->
						</div> <!-- .page-header -->
					<?php }
				} else { 
					if(!is_front_page()) {?>
						<div class="page-header clearfix">
							<div class="container">
									<h1 class="page-title"><?php echo freesiaempire_header_title();?></h1> <!-- .page-title -->
									<?php freesiaempire_breadcrumb(); ?>
							</div> <!-- .container -->
						</div> <!-- .page-header -->
				<?php }
				}
			}
		}*/
		
		if( (is_page() && has_post_thumbnail()) // Any pages that does not have feature image/banner
			|| is_front_page() 					// Not on homepage
			|| is_page(array('mortgage-quick-quote'))  // Any specified pages
		) {}
		else {?>
						<div class="page-header clearfix">
							<div class="container">
									<h1 class="page-title"><?php echo lfm_header_title();?></h1> <!-- .page-title -->
									<?php freesiaempire_breadcrumb(); ?>
							</div> <!-- .container -->
						</div> <!-- .page-header -->
		<?php }?>
</header> <!-- end #masthead -->
<!-- Main Page Start ============================================= -->
<div id="content">
<?php if (!is_page_template('page-templates/freesiaempire-corporate.php') ){ 
  if(is_page_template('three-column-blog-template.php') || is_page_template('our-team-template.php') || is_page_template('about-us-template.php') || is_page_template('portfolio-template.php') ){

	}else{?>
<div class="container clearfix">
<?php }
	} ?>