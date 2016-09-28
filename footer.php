<?php
/**
 * The template for displaying the footer.
 *
 * @package Theme Freesia
 * @subpackage Freesia Empire
 * @since Freesia Empire 1.0
 */
$freesiaempire_settings = freesiaempire_get_theme_options();
if (!is_page_template('page-templates/freesiaempire-corporate.php') ){ 
  if(is_page_template('three-column-blog-template.php') || is_page_template('our-team-template.php') || is_page_template('about-us-template.php') || is_page_template('portfolio-template.php') ){

	}else{?>
</div>
<!-- end .container -->
<?php }
} ?>
</div>
<!-- end #content -->
<!-- Footer Start ============================================= -->
<div id="content-socialbar-floating">
	<div class="header-social-block">
		<div class="social-links clearfix">
			<ul>
				<li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="https://www.facebook.com/pages/Lenox-Financial-Mortgage-Corporation/376321825734875"><span class="screen-reader-text">Facebook</span></a></li>
				<li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="https://www.linkedin.com/company/weslend-financial?trk=top_nav_home"><span class="screen-reader-text">LinkedIn</span></a></li>
				<li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="https://twitter.com/LenoxLoans"><span class="screen-reader-text">Twitter</span></a></li>
				<li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="https://plus.google.com/u/0/b/117723656656373361479/+LenoxFinancialMortgageCorporationSantaAna/posts"><span class="screen-reader-text">Google Plus</span></a></li>
				<li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="/blog/"><span class="screen-reader-text">Blog</span></a></li>
			</ul>
		</div><!-- end .social-links -->
	</div><!-- end .header-social-block -->
</div>
<hr id="footerTopBorder">
<footer id="colophon" class="site-footer clearfix">	
	<div class="widget-wrap">
		<div class="container">
			<div class="widget-area clearfix">
				<div class="column-2">
					<aside id="footer-left" class="widget widget_text">
						<div class="footer-group clearfix">
							<span class="footer-group-title">Popular Links</span>
							<ul>
								<li><a href="https://corporate.lenoxhomeloans.com/startapp" title="Apply Online">Apply Online</a></li>
								<li><a href="https://corporate.lenoxhomeloans.com/index.php?s=members&a=login" title="Loan In Process">Loan In Process</a></li>
								<li><a href="https://lenoxhomeloans.estatusconnect.com/index.html#/home/login" title="Existing Customer">Existing Customer</a></li>
								<li><a href="/contact_us/" title="Contact Us">Contact Us</a></li>
							</ul>
						</div>
						<div class="footer-group clearfix">
							<ul>
								<li><a href="/licenses/" title="Licenses">Licenses</a></li>
								<li><a href="/disclosure/" title="Disclosure">Disclosure</a></li>
								<li><a href="/privacy/" title="Online Privacy">Online Privacy</a></li>
								<li><a href="/sitemap.xml" title="Sitemap">Sitemap</a></li>
							</ul>
						</div>
					</aside>
				</div><!-- end .column2  -->			
				<div class="column-2">
					<aside id="footer-right" class="widget widget_text">
						<div class="footer-group security textwidget">
							<ul>
								<li><a href="http://www.bbb.org/sdoc/business-reviews/mortgage-bankers/lenox-financial-mortgage-corp-in-santa-ana-ca-100039624/#bbbonlineclick" target="_blank" rel="nofollow"><img src="https://seal-sandiego.bbb.org/seals/blue-seal-293-61-whitetxt-bbb-100039624.png" style="border: 0;" alt="Lenox Financial Mortgage Corp BBB Business Review" /></a></li>								
								<li><a href="#"><img src="/wp-content/themes/freesia-empire-child/images/RapidSSL_SEAL-90x50.gif" id="RapidSSL-SEAL" alt="RapidSSL-SEAL" width="90"></a></li>
								<?php /*<li><a href="#"><img src="/wp-content/themes/freesia-empire-child/images/Lenox-WesLend_Dual_Brand_Logo.svg" id="site-logo" alt="Sandbox Lenox Home Loans" width="100" style="background-color:#fff;border:1px solid;"></a></li> */?>								
							</ul>
						</div>
					</aside>
				</div><!--end .column2-->
			</div> <!-- end .widget-area -->
		</div> <!-- end .container -->
	</div> <!-- end .widget-wrap -->	
	
	<div class="site-info">
		<div class="container">
			<?php if(has_nav_menu('footermenu')):
				$args = array(
					'theme_location' => 'footermenu',
					'container'      => '',
					'items_wrap'     => '<ul>%3$s</ul>',
				);
				echo '<nav id="footer-navigation">';
				wp_nav_menu($args);
				echo '</nav><!-- end #footer-navigation -->';
			endif; ?>
			<?php
			if(has_nav_menu('social-link') && $freesiaempire_settings['freesiaempire_buttom_social_icons'] == 0):
				do_action('social_links');
			endif;
				do_action('lfm_sitegenerator_footer'); ?>
			<div style="clear:both;"></div>
		</div> <!-- end .container -->
	</div> <!-- end .site-info -->

	<div class="side-botton">
		<div class="one-column">
			<a class="quick-quote-botton" title="<?php _e('Quick Quote','freesia-empire');?>" href="/mortgage-quick-quote/"><?php _e('Quick Quote','freesia-empire');?></a>
			<a class="chat-botton" title="<?php _e('Live Chat','freesia-empire');?>" href="http://messenger.providesupport.com/messenger/lenox.html" target="flm_live_chat" onclick="window.open(this.href,'flm_live_chat','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=650,height=680');return false;"><?php _e('Live Chat','freesia-empire');?></a>
		</div>	
	</div> <!-- end .side-botton -->
	<?php
		$disable_scroll = $freesiaempire_settings['freesiaempire_scroll'];
		if($disable_scroll == 0):?>
	<div class="go-to-top"><a title="<?php _e('Go to Top','freesia-empire');?>" href="#masthead"></a></div> <!-- end .go-to-top -->
	<?php endif; ?>
</footer> <!-- end #colophon -->
</div> <!-- end #page -->
<?php wp_footer(); ?>
</body>
</html>