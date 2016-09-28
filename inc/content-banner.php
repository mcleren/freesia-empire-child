<?php
/**
 * @package LFM
 * @subpackage Lenox 2016
 * @since Lenox 2016 1.0
 */
?>
<?php
/************************* LFM CONTENT BANNER **************************************/
//echo "Inlcude Content Banner.php";
if ( has_post_thumbnail() ) {
	$attachment = wp_get_attachment( get_post_thumbnail_id($post->ID) );
	$slidertitle = get_post_meta(get_the_ID (), "meta-box-lfm-text_banner_headingtext", true);
	$slidertitle = (trim($slidertitle))?$slidertitle:get_the_title();
	$slidertext = get_post_meta(get_the_ID (), "meta-box-lfm-text_banner_subheadingtext", true);
	$sliderlinkurl = get_post_meta(get_the_ID (), "meta-box-lfm-text_banner_headinglinkurl", true);
	$sliderlinktext = get_post_meta(get_the_ID (), "meta-box-lfm-text_banner_headinglinktext", true);
?>
<div id="page-main-slider" class="main-slider">
	<div class="layer-slider-static container">
		<div class="slides">
			<div class="image-slider clearfix" style="background-image: url('<?php echo esc_url( $attachment['src'] );?>');" title="<?php echo (trim($attachment['title']))?$attachment['title']:get_the_title();?>">
				<div class="container">
				<article class="slider-content clearfix freesia-animation fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
					<?php
					//echo (trim($slidertitle))?'<h1 class="slider-title">' . $slidertitle . '</h1>':'';
					//echo (trim($slidertext))?'<div class="slider-text"><h2>' . $slidertext . '</h2></div>':'';
					echo '<h1 class="slider-title">' . $slidertitle;
					echo (trim($slidertext))?'<div class="slider-text">' . $slidertext . '</div>':'';
					echo '</h1>';
					echo (trim($sliderlinkurl))?'&nbsp;
					<div class="slider-buttons">
						<a title="' . $sliderlinktext . '" href="' . $sliderlinkurl . '" class="btn-default vivid">' . $sliderlinktext . '<span>&#10093;</span></a>
					</div>':'';
					?>
				</article>
				</div>
			</div>
		</div>
	</div>
</div>
&nbsp;
<?php }
?>