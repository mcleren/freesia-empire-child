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
				<form id="affordcalc" name="affordcalc" method="post" action="#">
				<div id="primary" class="centered">
					<div class="one-column">
						<div class="four-column area">
							<label for="HowMuchCalcInput1">Annual Income</label> <a href="#" class="tooltip"><span class="">Total amount of income earned annually. Gross annual income represents the amount of money a person earns in one year from all sources before taxes. When preparing an income tax return, the gross annual income figure is the base figure with which to start.</span></a>
							<div class="input-group"><span class="input-group-addon-left">$</span><input type="number" id="HowMuchCalcInput1" value="70000" onkeppress="noenter()" name="HowMuchCalcInput1"></div>
							<div id="HowMuchCalcInput1-err-msg" class="required"></div>
						</div>
						<div class="four-column area">
							<label for="HowMuchCalcInput2">Monthly Debt</label> <a href="#" class="tooltip bottom"><span class="">The required payments made every month on credit cards, home equity loans, installment loans, and other debt commitments, but it does not include payments on the loan that was applied for.</span></a>
							<div class="input-group"><span class="input-group-addon-left">$</span><input type="number" id="HowMuchCalcInput2" value="2000" onkeppress="noenter()" name="HowMuchCalcInput2"></div>
							<div id="HowMuchCalcInput2-err-msg" class="required"></div>
						</div>
						<div class="four-column area">
							<label for="HowMuchCalcInput3">Down Payment</label> <a href="#" class="tooltip"><span class="">An upfront payment made by the home buyer toward the property purchase price, usually ranging from five to 20 percent. The remainder of the sales prices makes up the mortgage loan amount.</span></a>
							<div class="input-group"><span class="input-group-addon-left">$</span><input type="number" id="HowMuchCalcInput3" value="0" onkeppress="noenter()" name="HowMuchCalcInput3"></div>
							<div id="HowMuchCalcInput3-err-msg" class="required"></div>
						</div>
						<div class="four-column area">
							<label for="HowMuchCalcInput4">Interest Rate</label> <a href="#" class="tooltip bottom"><span class="">The rate of interest charged on a mortgage. They are determined by the lender in most cases, and can be either fixed, stay the same for the term of the mortgage, or variable, fluctuate with a benchmark interest rate. Mortgage rates rise and fall with interest rates and can drastically affect the homebuyers' market.</span></a>
							<div class="input-group"><input type="number" id="HowMuchCalcInput4" value="3.5" onkeppress="noenter()" name="HowMuchCalcInput4"><span class="input-group-addon-right">%</span></div>
							<div id="HowMuchCalcInput4-err-msg" class="required"></div>
						</div>
						<div class="four-column area">
							<label for="HowMuchCalcInput5">Term</label> <a href="#" class="tooltip"><span class="">The length of your mortgage. Most are 30 years, though 15 years is also very common.</span></a>
							<div class="input-group"><input type="number" id="HowMuchCalcInput5" value="30" onkeppress="noenter()" name="HowMuchCalcInput5"><span class="input-group-addon-right">Years</span></div>
							<div id="HowMuchCalcInput5-err-msg" class="required"></div>
						</div>
						<div class="one-column area btn-section">			
							<input type="button" onclick="HowMuchCalcProcess();" value="Calculate &nbsp; &#10093;" id="Button1" name="Button1"><a href="javascript:HowMuchCalcReset();" class="btn-link">Reset</a>
						</div>
					</div>
				</div>
				<div id="secondary" class="three-column clearfix js-slide-hidden">  
					<div class="one-column area">
						<label for="mp">Monthly Payment</label> <a href="#" class="tooltip bottom"><span class="">A regularly scheduled payment which includes principal and interest paid by borrower to lender of home loan. The payment amount may or may not include real estate taxes and property insurance. The principal portion is used to pay off the original loan amount; the interest is paid to the lender.</span></a><div id="HowMuchCalcOutput5"></div></div>
					<div class="one-column area">
						<label for="pi">Principal &amp; Interest</label><div id="HowMuchCalcOutput6"></div></div>
					<div class="one-column area">
						<label for="ti">Property Tax &amp; Insurance</label><div id="HowMuchCalcOutput7"></div></div>
					<div class="one-column area">
						<label for="pmi">PMI</label><div id="HowMuchCalcOutput8"></div></div>
						
					<div class="one-column area">
						<label for="hv">You could afford a house worth</label><div id="HowMuchCalcOutput1"></div></div>
					<div class="one-column area">
						<label for="la">Loan Amount</label><div id="HowMuchCalcOutput2"></div></div>
					<div class="one-column area">
						<label for="dp">Down Payment</label><div id="HowMuchCalcOutput3"></div></div>
					<div class="one-column area">
						<label for="ltv">Loan-to-value</label><div id="HowMuchCalcOutput4"></div></div>
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