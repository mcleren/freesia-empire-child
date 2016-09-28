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
				<form id="reficalc" name="calc" method="post" action="#">
				<div id="primary" class="centered">
					<div class="three-column">
						<div class="one-column area">
							<label for="principal">Current Principal Balance of your Mortgage</label>
							<div class="input-group"><span class="input-group-addon-left">$</span><input type="number" id="principal" name="principal" value="150000" size="15" onkeyup="clear_results(this.form)" tabindex="1"></div>
							<div id="principal-err-msg" class="required"></div>
						</div>
						<div class="one-column area">	
							<label for="intRate">Current Interest Rate</label>
							<div class="input-group"><input align="center" type="number" id="intRate" name="intRate" value="7" size="15" onkeyup="clear_results(this.form)" tabindex="2"><span class="input-group-addon-right">%</span></div>
							<div id="intRate-err-msg" class="required"></div>
						</div>
						<div class="one-column area">	
							<label for="payment">Current Monthly Mortgage Payment</label>
							<div class="input-group"><span class="input-group-addon-left">$</span><input type="number" id="payment" name="payment" value="997.96" size="15" onkeyup="clear_results(this.form)" tabindex="3"></div>
							<div id="payment-err-msg" class="required"></div>
						</div>
					</div>
					<div class="three-column">
						<div class="one-column area">
							<label for="nper2">New Term</label>
							<div class="input-group"><input type="number" id="nper2" name="nper2" value="30" size="15" onkeyup="clear_results(this.form)" tabindex="4"><span class="input-group-addon-right">Years</span></div>
							<div id="nper2-err-msg" class="required"></div>
						</div>				
						<div class="one-column area">
							<label for="intRate2">New Interest Rate</label>
							<div class="input-group"><input type="number" id="intRate2" name="intRate2" value="3.5" size="15" onkeyup="clear_results(this.form)" tabindex="5"><span class="input-group-addon-right">%</span></div>
							<div id="intRate2-err-msg" class="required"></div>
						</div>
						<div class="one-column area">
							<label for="closingCost">Closing Costs</label>
							<input type="hidden" name="ptsDol" value="dollar"><div class="input-group"><span class="input-group-addon-left">$</span><input type="number" id="closingCost" name="closingCost" size="15" value="0" onkeyup="clear_results(this.form)" tabindex="6"></div>
							<div id="closingCost-err-msg" class="required"></div>
						</div>			
						<div class="one-column area">
							<label for="yesNo">Would you like to finance the Closing Costs?</label>
							<select name="yesNo" size="1" onchange="clear_results(this.form)" width="80" style="width: 80px" tabindex="7">
								<option value="No">No</option>
								<option value="Yes">Yes</option>
								</select>
							<div id="yesNo-err-msg" class="required"></div>
						</div>
					</div>		
					<div class="one-column area btn-section">			
						<input type="button" class="table-btn" value="Calculate" onclick="computeForm2(this.form)" tabindex="8"><a href="javascript:reset_calc2(this.form);" class="btn-link">Reset</a>
					</div>
				</div>
				<div id="secondary" class="three-column clearfix js-slide-hidden">  
					<div class="one-column area">
						<label for="mp">New Monthly Payment</label> <a href="#" class="tooltip bottom"><span>A regularly scheduled payment which includes principal and interest paid by borrower to lender of home loan. The payment amount may or may not include real estate taxes and property insurance. The principal portion is used to pay off the original loan amount; the interest is paid to the lender.</span></a><div id="payment2"></div></div>
					<div class="one-column area">
						<label for="moSave">Monthly Payment Reduction</label>
						<div id="moSave"></div>
					</div>
					<div class="one-column area">
						<label for="closeMo"># of months for interest savings to offset closing costs</label>
						<div id="closeMo"></div>
					</div>
					<div class="one-column area">
						<label for="origInt">This is how much interest you will pay under your current monthly payment plan</label>
						<div id="origInt"></div>
					</div>
					<div class="one-column area">
						<label for="totInt2">This is how much interest you will pay under your refinanced monthly payment plan</label>
						<div id="totInt2"></div>
					</div>
					<div class="one-column area">
						<label for="intSave">This is how much interest you will save if you refinance</label>
						<div id="intSave"></div>
					</div>
					<div class="one-column area">
						<label for="netSave">Net Refinancing Savings (interest savings less closing costs)</label>
						<div id="netSave"></div>
					</div>
					<div class="one-column area">
						<label for="summary">Summary</label><div id="summary"></div>
					</div>		
				</div>
				</form>
			</div>
			<script src="/wp-content/themes/freesia-empire-child/js/custom.js" type="text/javascript"></script>
			<br>
			<h6>Calculator Disclaimer</h6>
			<small>Calculator feature is an informational tool only and should not be construed as a loan qualification or approval. Examples depicted are for illustrative purposes only and are hypothetical. We do not guarantee the accuracy of any calculation results scenarios. Contact us at <?php echo lfm_campaign_toolfree_ajx();?> for a more specific quote, based on your personal information or unique situation.</small>				
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