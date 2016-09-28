<?php
/**
 * The template for displaying all pages.
 *
 * @package Theme Freesia
 * @subpackage Freesia Empire
 * @since Freesia Empire 1.0
 */

/**
 * Use mortgage rate page css
 *
 */ 
function mypage_head() {
    $current_template_css = '/css/page-mortgage-rates.css';
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . $current_template_css .'">'."\n";
}
add_action('wp_head', 'mypage_head');
 
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
				
				//the_content();

				
/**
 * Custom Read CSV File to HTML Table
 *
 */

$rs = array();
$inputFileName = "C:\LFMUploads\Secondary\data-rates-rates.csv";	
 
//  Read your CSV file
$row = 0;
$disclaimer = $rates = array();

if (file_exists($inputFileName) && ($handle = fopen($inputFileName, "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		if($row == 0) {
			$disclaimer = $data;
		}
		else if ($row >= 2) {
			$rates[$data[0]][$data[1]][] = $data;
		}			
		$row++;
	}
	fclose($handle);
	
	if(isset($disclaimer[1]))
		$disclaimer[1] = str_replace('[filemtime]', date("F d, Y", filemtime($inputFileName)), $disclaimer[1]);
}
//print_r($rates);
?>
<div class="container clearfix">
	<div class="two-column">
		<div id="loan-type">
			<h3><mark>Get Your Low Mortgage Rate</mark></h3>
			<h2>Loan Purpose</h2>
			<div class="clearfix">
				<ul class="tabs-menu">
					<?php
					$i=0;
					foreach($rates as $type => $progs) {
						echo '<li' . ($i ==0?' class="current"':'') . '><a href="#' . preg_replace("/[^A-Za-z0-9]/", '_', $type) . '" class="" title="' . $type . '">' . $type . '</a></li>';
						$i++;
					}
					?>
				</ul>
				<?php echo (sizeof($rates) == 0)?'<span>No Loan Informatin Available at this time.<span>':'';?>
			</div>
			<br>
			<div class="clearfix">
				<?php the_content();?>
			</div>
		</div>	
	</div>

	<div class="two-column">
		<?php $attachment = wp_get_attachment_by_post_name( 'Rates-Image' );?>
		<img class="attachment-post-thumbnails size-post-thumbnails wp-post-image" title="<?php echo (isset($attachment->post_title))?$attachment->post_title:'';?>" src="<?php echo esc_url($attachment->org);?>" sizes="(max-width: 768px) 100vw, 768px" srcset="<?php echo esc_url($attachment->org);?> 768w, <?php echo esc_url($attachment->med);?> 300w" alt="<?php echo (isset($attachment->alt))?$attachment->alt:'';?>" width="768" height="580" />
	</div>
</div>
<div class="container clearfix">
	<div class="two-column">
		<div id="rates-box">
			<div class="clearfix">
				<div>
					<?php
					$i=0;
					foreach($rates as $type => $progs) {
						echo '<div id="' . preg_replace("/[^A-Za-z0-9]/", '_', $type) . '" class="tab-content' . ($i ==0?' tab-first':'') . '">
							<h2>' . strtoupper($type) . ' RATES</h2>
							<ul class="tabs-menu">';
						$ii = 0;
						foreach($progs as $prog => $data) {
							echo '<li' . ($ii ==0?' class="current"':'') . '><a href="#' . preg_replace("/[^A-Za-z0-9]/", '_', $type . ' ' . $prog) . '" class="" title="' . $prog . '">' . $prog . '</a></li>';
							$ii++;
						}					
						echo '</ul>
						<div class="tab">';
							$ii = 0;
							foreach($progs as $prog => $data) {
								echo '
							<div id="' . preg_replace("/[^A-Za-z0-9]/", '_', $type . ' ' . $prog) . '" class="tab-content' . ($ii ==0?' tab-first':'') . '">
								<span class="home-icon"></span>
								<table class="rates">
									<tbody>
										<tr>
											<th>Term: ' . $prog . '</th>
											<th>Rate</th>
											<th>APR</th>
										</tr>';
										for($d=0; $d<sizeof($data);$d++) {
										echo '<tr>
											<td>' . $data[$d][2];
											echo (trim($data[$d][5]))?' 
												<a href="#" class="tooltip"><span>' . $data[$d][5] . '</span></a>':'';
											echo '</td>
											<td><b>' . $data[$d][3] . '</b></td>
											<td><b>' . $data[$d][4] . '</b></td>
										</tr>';
										}
										echo '
									</tbody>
								</table>
							</div>';
								$ii++;
							}						
						echo '</div>
						</div>';
						$i++;
					}
					echo (sizeof($rates) == 0)?'<span>No Loan Informatin Available at this time.<span>':'';
					?>
					<div style="clear: left;padding-top: 5px;">Like what you see? Get your customized rate within minutes! Call <?php echo lfm_campaign_toolfree_ajx();?> or Get your free quote <a href="/mortgage-quick-quote/" title="Mortgage Quick Quote">NOW</a>.</div>
				</div>
			</div>
		</div>	
	</div>

	<div class="two-column">
		<?php $attachment = wp_get_attachment_by_post_name( 'Rates-2-Image' );?>
		<img class="attachment-post-thumbnails size-post-thumbnails wp-post-image" title="<?php echo (isset($attachment->post_title))?$attachment->post_title:'';?>" src="<?php echo esc_url($attachment->org);?>" sizes="(max-width: 768px) 100vw, 768px" srcset="<?php echo esc_url($attachment->org);?> 768w, <?php echo esc_url($attachment->med);?> 300w" alt="<?php echo (isset($attachment->alt))?$attachment->alt:'';?>" width="768" height="580" />
	</div>
</div>
<br>
<?php 
echo (isset($disclaimer[0]) && trim($disclaimer[0]))?'<h6>' . $disclaimer[0] . '</h6>':'';
echo (isset($disclaimer[1]) && trim($disclaimer[1]))?'<p><small>' . $disclaimer[1] . '</small></p>':'';

			
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