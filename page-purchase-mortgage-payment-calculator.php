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
					<div class="three-column">
						<div class="one-column area">
							<label for="homevalue">Home Value</label>
							<div class="input-group"><span class="input-group-addon-left">$</span><input id="homevalue" name="homevalue" type="number" value="300000" size="8" onfocus="this.value = this.value=='300000'?'':this.value;" onblur="this.value = this.value==''?'300000':this.value;" tabindex="1" /></div></div>
						<div class="one-column area">
							<label for="principal">Loan Amount</label>
							<div class="input-group"><span class="input-group-addon-left">$</span><input id="principal" name="principal" type="number" value="250000" size="8" onfocus="this.value = this.value=='250000'?'':this.value;" onblur="this.value = this.value==''?'250000':this.value;" tabindex="2" /></div></div>
						<div class="one-column area">
							<label for="intRate">Interest Rate (APR)</label>
							<div class="input-group"><input id="intRate" name="intRate" type="number" value="3.5" size="8" onfocus="this.value = this.value=='3.5'?'':this.value;" onblur="this.value = this.value==''?'6':this.value;" tabindex="3" /><span class="input-group-addon-right">%</span></div></div>
						<div class="one-column area">
							<label for="numYears">Term</label>
							<div class="input-group"><input id="numYears" name="numYears" type="number" value="30" size="8" onfocus="this.value = this.value=='30'?'':this.value;" onblur="this.value = this.value==''?'30':this.value;" tabindex="4" /><span class="input-group-addon-right">Years</span></div></div>
					</div>
					<div class="three-column">	
						<div class="one-column area">
							<label for="annualTax">Property Taxes</label>
							<div class="input-group"><span class="input-group-addon-left">$</span><input id="annualTax" name="annualTax" type="number" value="4140" step=0.01 size="8" onfocus="this.value = this.value=='345'?'':this.value;" onblur="this.value = this.value==''?'4140':this.value;" tabindex="5" /><span class="input-group-addon-right">/Year</span></div></div>
						<div class="one-column area">
							<label for="annualInsurance">Homeowners Insurance</label>
							<div class="input-group"><span class="input-group-addon-left">$</span><input id="annualInsurance" name="annualInsurance" type="number" value="1500" step=0.1 size="8" onfocus="this.value = this.value=='0.5'?'':this.value;" onblur="this.value = this.value==''?'1500':this.value;" tabindex="6" /><span class="input-group-addon-right">/Year</span></div></div>
						<div class="one-column area">
							<label for="monthlyPMI">PMI</label> <a href="#" class="tooltip bottom"><span>A risk-management product that protects lenders against loss if a borrower defaults. Most lenders require private mortgage insurance (PMI) for loans with loan-to-value (LTV) percentages in excess of 80% (the buyer put down less than 20% of the home's value upon purchase).</span></a>
							<div class="input-group"><span class="input-group-addon-left">$</span><input id="monthlyPMI" name="monthlyPMI" type="number" value="0" step=0.1 size="8" onfocus="this.value = this.value=='0.5'?'':this.value;" onblur="this.value = this.value==''?'0':this.value;" tabindex="7" /><span class="input-group-addon-right">/Year</span></div></div>
						<div class="one-column area">
							<label for="closingcosts">Closing Costs ($0 if not in loan)</label>
							<div class="input-group"><span class="input-group-addon-left">$</span><input id="closingcosts" name="closingcosts" type="number" value="0" size="8" onfocus="this.value = this.value=='0'?'':this.value;" onblur="this.value = this.value==''?'3700':this.value;" tabindex="8" /></div></div>
						<div class="one-column area btn-section">
							<input type="button" name="compute" value="Calculate &nbsp; &#10093;" onClick="computeForm(this.form)" tabindex="9" /><a href="javascript:document.getElementById('calc').reset();reset_position();" class="btn-link">Reset</a>
						</div>
					</div>
				</div>
				<div id="secondary" class="three-column clearfix js-slide-hidden">  
					<div class="one-column area">
						<label for="monthlyPmt">Total Monthly Payment</label>
						<div id="monthlyPmt"></div>
					</div>
					<div class="one-column area">
						<label for="monthlyPI">Monthly Principal & Interest</label>
						<div id="monthlyPI"></div>
					</div>
					<div class="one-column area">
						<label for="otherPmts">Monthly Taxes, Insurance &amp; PMI</label>
						<div id="otherPmts"></div>
					</div>
					<div class="one-column area">
						<label for="downpayment">Down Payment (excluding closing cost)</label>
						<div id="downpayment"></div>
					</div>			
				</div>
				</form>
			</div>
			<script src="/wp-content/themes/freesia-empire-child/js/custom.js" type="text/javascript"></script>
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