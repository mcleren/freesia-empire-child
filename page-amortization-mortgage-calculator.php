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
	<div id="main"><!-- Using page-rates.php	-->
	<?php global $post;
	if( have_posts() ) {
		while( have_posts() ) {
			the_post(); ?>
		<div class="entry-content">
			<?php 
				
			the_content();
				
			?>
			<div class="container widget_form clearfix" style="padding: 20px 0 0;">
				<form id="calc" name="calc" method="post" action="#">
				<div id="primary" class="centered">
					<div class="one-column">
						<div class="four-column area">
							<label for="principal">Loan Amount</label>
							<div class="input-group"><span class="input-group-addon-left">$</span><input id="principal" name="principal" type="number" value="250000" size="8" onfocus="this.value = this.value=='250000'?'':this.value;" onblur="this.value = this.value==''?'250000':this.value;" /></div>
						</div>
						<div class="four-column area">
							<label for="intRate">Interest Rate (APR)</label>
							<div class="input-group"><input id="intRate" name="intRate" type="number" value="3.5" size="8" onfocus="this.value = this.value=='3.5'?'':this.value;" onblur="this.value = this.value==''?'6':this.value;" /><span class="input-group-addon-right">%</span></div>
						</div>
						<div class="four-column area">
							<label for="numYears">Term</label>
							<div class="input-group"><input id="numYears" name="numYears" type="number" value="30" size="8" onfocus="this.value = this.value=='30'?'':this.value;" onblur="this.value = this.value==''?'30':this.value;" /><span class="input-group-addon-right">Years</span></div>
						</div>
						<div class="four-column area">
							<label for="closingcosts">Closing Costs ($0 if not in loan)</label>
							<div class="input-group"><span class="input-group-addon-left">$</span><input id="closingcosts" name="closingcosts" type="number" value="0" size="8" onfocus="this.value = this.value=='0'?'':this.value;" onblur="this.value = this.value==''?'0':this.value;" /></div>
						</div>
						<div class="one-column btn-section">
							<input type="button" name="schedview" value="Show Amortization Schedule" onClick="monthlyAmortSched(this.form,'div')" />
						</div>
						<input name="homevalue" type="hidden" value="300000" /> 
						<input name="annualTax" type="hidden" value="1.38" />
						<input name="annualInsurance" type="hidden" value="0.5" />
						<input name="monthlyPMI" type="hidden" value="0" />	
					</div>
				</div>
				</form>
			</div>
			<script src="/wp-content/themes/freesia-empire-child/js/custom.js" type="text/javascript"></script>
			<div id="amzdiv" class="clearfix js-slide-hidden"></div>
			<br>
			<h6>Calculator Disclaimer</h6>
			<p><small>Calculator feature is an informational tool only and should not be construed as a loan qualification or approval. Examples depicted are for illustrative purposes only and are hypothetical. We do not guarantee the accuracy of any calculation results scenarios. Contact us at <?php echo lfm_campaign_toolfree_ajx();?> for a more specific quote, based on your personal information or unique situation.</small></p>
				<?php
				wp_link_pages( array( 
				'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'freesia-empire' ),
				'after'             => '</div>',
				'link_before'       => '<span>',
				'link_after'        => '</span>',
				'pagelink'          => '%',
				'echo'              => 1
				) ); 
				
				// Load a template part: inc/content-banner.php into this template
				get_template_part('inc/content', 'tabs');
				?>
		</div> <!-- entry-content clearfix-->
		<?php comments_template(); ?>
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