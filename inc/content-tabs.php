<?php
/**
 * @package LFM
 * @subpackage Lenox 2016
 * @since Lenox 2016 1.0
 */
?>
<?php
/************************* LFM CONTENT TABS **************************************/
//echo "Inlcude Content Tabs.php";
//print_r(get_post_meta(get_the_ID (), "", true));
//$tabs_title_values = simple_fields_values("tab_title");
global $TABS_VALUES;

if(isset($TABS_VALUES) && $TABS_VALUES) {
  // Avoid displaying tabs twice.
}
else {
	$TABS_VALUES = get_post_meta(get_the_ID (), "meta-box-lfm-repeat_tabs", true);
	if($TABS_VALUES) { ?>
	<div class="tabs-container clearfix">
		<ul class="tabs-menu">
			<?php
			for($i=0; $i < sizeof($TABS_VALUES); $i++) {
				echo '<li' . (($i==0)?' class="current"':'') . '><a href="#' . preg_replace("/[^A-Za-z0-9]/", '_', $TABS_VALUES[$i]['title']) . '">' . $TABS_VALUES[$i]['title'] . '</a></li>';
			}?>						
		</ul>
		<div class="tab">
		<?php 
		for($i=0; $i < sizeof($TABS_VALUES); $i++) {
			echo '<div id="' . preg_replace("/[^A-Za-z0-9]/", '_', $TABS_VALUES[$i]['title']) . '" class="tab-content' . (($i==0)?' tab-first':'') . '">' . apply_filters('the_content', $TABS_VALUES[$i]['content']) . ' </div>';
		}?>
		</div>
	</div>
	<?php }	
}
?>