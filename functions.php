<?php
function freesia_empire_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'freesia_empire_enqueue_styles' );

// Only on front-end pages, NOT in admin area
if (!is_admin()) {
	function my_scripts_enqueue() {
		wp_register_script('lfm-js', get_stylesheet_directory_uri() . '/js/lfm.js', array('jquery'), '1.0', true );
		//wp_register_script( 'bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js', array('jquery'), NULL, true );
		//wp_register_style( 'bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css', false, NULL, 'all' );
		wp_register_style( 'lfmicons', get_stylesheet_directory_uri() . '/lfmicons/styles.css', array(), '1.0' );
		wp_enqueue_style( 'lfm-responsive-css', get_stylesheet_directory_uri() . '/css/responsive.css' );

		wp_enqueue_script('lfm-js');
		wp_localize_script( 'lfm-js', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		//wp_enqueue_script( 'bootstrap-js' );
		//wp_enqueue_style( 'bootstrap-css' );
		wp_enqueue_style( 'lfmicons' );
		wp_enqueue_style( 'lfm-responsive-css' );
		
		// add custom js & css file per page
		if(is_front_page() ){
			wp_register_script('amplitude', get_stylesheet_directory_uri() . '/js/amplitude.js', '', '2.2');
			wp_register_style( 'amplitude', get_stylesheet_directory_uri() . '/css/amplitude.css', array(), '2.2' );
			wp_enqueue_script('amplitude');
			wp_enqueue_style( 'amplitude' );		
		}
		
		// add custom css file per template
		$current_template_css = '/css/' . substr(basename(get_page_template()), 0, -4) . '.css';
		//echo "inlcudes: $current_template_css if exists.";
		if ( file_exists(get_stylesheet_directory() . $current_template_css)) {
			wp_register_style( 'template-style', get_stylesheet_directory_uri() . $current_template_css, array(), '1.0' );
			wp_enqueue_style( 'template-style' );
		}
		
		// add custom js file per template
		$current_template_js = '/js/' . substr(basename(get_page_template()), 0, -4) . '.js';
		//echo "inlcudes: " . get_stylesheet_directory() . "$current_template_js if exists.";
		if ( file_exists(get_stylesheet_directory() . $current_template_js)) {
			wp_register_script( 'template-script', get_stylesheet_directory_uri() . $current_template_js, array('jquery'), '1.0', true );
			wp_enqueue_script( 'template-script' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'my_scripts_enqueue', 15);
} // end if !is_admin

// Add js per function
//wp_enqueue_script( 'custom',  get_stylesheet_directory_uri() . '/js/custom-script.js', __FILE__ , array('jquery'), '1.0', true );

/**
 * Disable Wordpress from adding <p> tags
 *
 */
//remove_filter( 'the_content', 'wpautop' );
//remove_filter('the_content', 'wptexturize');
//remove_filter( 'the_excerpt', 'wpautop' );

/**
 * Remove WP Emoji
 *
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Add tracking analytics
 *
 */
$tracking_arr = array(
					'Facebook Pixel Code - Base'=>'xxx4789784xxx',
					'Smart Pixel Adroll'=>'adroll_adv_id = "xxxOOOOFLZEJXFDOCWSxxx";adroll_pix_id = "xxx527BNVBBV5KFI47Rxxx";',
					'Bing'=>'5279xxx',
);
function lfm_tracking_analytics() {
	global $post, $tracking_arr;
	
	if(!isset($post->ID))
		return False;
	
	$checkbox_tracking = get_post_meta( $post->ID, "meta-box-lfm-checkbox_tracking", true);
	if(is_array($checkbox_tracking)) {
		if(in_array('Facebook Pixel Code - Base', $checkbox_tracking)) {?>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '<?php echo $tracking_arr['Facebook Pixel Code - Base'];?>');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=<?php echo $tracking_arr['Facebook Pixel Code - Base'];?>&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->
		<?php }
		
		if(in_array('Smart Pixel Adroll', $checkbox_tracking)) {?>
<!-- Smart Pixel Adroll -->
<script type="text/javascript">
<?php echo $tracking_arr['Smart Pixel Adroll'];?>
(function () {
var oldonload = window.onload;
window.onload = function(){
   __adroll_loaded=true;
   var scr = document.createElement("script");
   var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
   scr.setAttribute('async', 'true');
   scr.type = "text/javascript";
   scr.src = host + "/j/roundtrip.js";
   ((document.getElementsByTagName('head') || [null])[0] ||
    document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
   if(oldonload){oldonload()}};
}());
</script>
		<?php }
		
		if(in_array('Bing', $checkbox_tracking)) {?>
<!-- Bing -->
<script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"<?php echo $tracking_arr['Bing'];?>"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");</script><noscript><img src="//bat.bing.com/action/0?ti=<?php echo $tracking_arr['Bing'];?>&Ver=2" height="0" width="0" style="display:none; visibility: hidden;" /></noscript>
		<?php }
		
	}
	?>
<!-- Google Analytics -->	
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	ga('create', 'UA-XXXXXXXX-XX', 'auto');
	ga('send', 'pageview');
	
</script>
<?php }
add_action( 'wp_head', 'lfm_tracking_analytics', 10 );

/**
 * Php function for ajax call: addQuickqoute
 *
 */
//wp_enqueue_script('jquery');
function addQuickqoute() {
	// Spam filter by field trap: subject
	if(isset($_POST['subject']) && trim($_POST['subject']) != '') {
		wp_die();
	}
	
	global $wpdb;
	
	$lookingto = $_POST['lookingto'];
	$state = $_POST['state'];
	$email = is_email($_POST['email']);	
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$phone = $_POST['phone'];
	$utm_code = (isset($_POST['utm_code']) && trim($_POST['utm_code']) && $_POST['utm_code'] != 'null')?$_POST['utm_code']:'';
	$utm_code = (isset($_COOKIE['utm_code']) && trim($_COOKIE['utm_code']))?$_COOKIE['utm_code']:$utm_code;
	
	$campaign_id = 12; // Velocify Coorporate Campaing ID
	if(isset($_POST['campaign_id']) && $_POST['campaign_id']){
		$campaign_id = $_POST['campaign_id'];
	}
	else if($utm_code){
		$items = $wpdb->get_results("SELECT campaign_id FROM lfm_tollfreenumbers WHERE utm_code IN ('" . str_replace(',', "', '", $utm_code) . "') ORDER BY FIELD (utm_code, '" . str_replace(',',"', '", $utm_code) . "') LIMIT 1;", ARRAY_A);
		if(isset($items[0]['campaign_id'])) {
			$campaign_id = $items[0]['campaign_id'];
		}
	}	

	/*if($wpdb->insert('lfm_quickquotes',array(
									'lookingto'=>$lookingto,
									'state'=>$state,
									'email'=>$email,
									'firstname'=>$firstname,
									'lastname'=>$lastname,
									'phone'=>$phone,
									'utm_code'=>$utm_code
									))===FALSE) {
		echo "Error: " . $wpdb->last_error;
	}
	else {*/
		// Post data to Velocify: https://secure.velocify.com/Import.aspx?Provider=LenoxFinancialWeb&Client=LennoxFinancialMortgageCorp1&CampaignId=12		
		//$url = 'https://secure.velocify.com/Import.aspx?Provider=LenoxFinancialWeb&Client=LennoxFinancialMortgageCorp1&CampaignId=' . $campaign_id;
		$url = 'https://secure.velocify.com/Import.aspx';
		$response = wp_safe_remote_post ( $url, array(
			'method' => 'POST',
			'body' => array( 
						'FirstName' => $firstname, 
						'LastName' => $lastname, 
						'PhoneAreaCode' => substr($phone, 1, 3), 
						'PhonePrefix' => substr($phone, 5, 3), 
						'PhoneSuffix' => substr($phone, -4), 
						'EmailAddress' => $email, 
						'IdPropertyAddressState' => $state,
						'lookingto' => $lookingto,
						'utm_code' => $utm_code,
						)
			)
		);

		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			echo "Something went wrong: $error_message";
		} else {
			// To send HTML mail, the Content-type header must be set.				
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: Quick Quote Form <no-replay@lenoxhomeloans.com>' . "\r\n"; // Sender's Email
				
			$to = "haris.yusuf@lenoxhomeloans.com, marketing@lenoxhomeloans.com";
			$subject = "Quick Quote - Velocify Success Notification - Lenox";
			$sendmessage = "The following information has been submitted: \r\n\r\n";
			
			//echo 'Response:<pre>';print_r( $response );echo '</pre>';
			$the_body = wp_remote_retrieve_body( $response );
			if( trim($the_body) == 'Failure' ) {
				// Send email
				$to = "haris.yusuf@lenoxhomeloans.com, Mary.Caoile@lenoxhomeloans.com";
				//$to = "haris.yusuf@lenoxhomeloans.com";
				$subject = "Quick Quote - Velocify Failure Notification - Lenox";				
				$sendmessage = "Unable to submit the following information: \r\n\r\n";
				
				// Message
				//echo "Thank you, '".$firstname. " " . $lastname . "'! successfully added, row ID is ".$wpdb->insert_id;
			}
			
			$sendmessage .= "First Name: " . $firstname . "\r\n";
			$sendmessage .= "Last Name: " . $lastname . "\r\n";
			$sendmessage .= "Phone: " . $phone . "\r\n";
			$sendmessage .= "Email: " . $email . "\r\n";
			$sendmessage .= "State: " . $state . "\r\n";
			$sendmessage .= "Looking To: " . $lookingto . "\r\n";
			$sendmessage .= "Marketing ID: " . $utm_code . "\r\n";
			$sendmessage .= "\r\n************ Error Log ************\r\n";
			$sendmessage .= "Campaign ID: " . $campaign_id . "\r\n";
			$sendmessage .= "Post URL: " . $url . "\r\n";
			$sendmessage .= "Response: <pre>" . print_r( $response, true ) . "</pre>\r\n";
			$sendmessage .= "Server: <pre>" . print_r( $_SERVER, true ) . "</pre>\r\n";
			$sendmessage .= "Post: <pre>" . print_r( $_POST, true ) . "</pre>\r\n";
			$sendmessage .= "Cookies: <pre>" . print_r( $_COOKIE, true ) . "</pre>\r\n";
			$sendmessage = nl2br( $sendmessage );
			//echo $sendmessage;
			
			// Send mail by PHP Mail Function.
			//if( trim($the_body) == 'Failure' )
				wp_mail( $to, $subject, $sendmessage, $headers );
		}
		
		// Delete cookie: utm_code for 1 year
		setcookie('utm_code', "", time() - 3600, "/");
	//}
	wp_die();
}
add_action('wp_ajax_addQuickqoute', 'addQuickqoute');
add_action('wp_ajax_nopriv_addQuickqoute', 'addQuickqoute'); // not really needed


/**
 * Php function for ajax call: logAppForm
 *
 */
function lfm_log_page() {
	$utm_code = (isset($_COOKIE['utm_code']) && trim($_COOKIE['utm_code']))?$_COOKIE['utm_code']:'';
	
	// To send HTML mail, the Content-type header must be set.				
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: Log Page <no-replay@lenoxhomeloans.com>' . "\r\n"; // Sender's Email
		
	$to = "haris.yusuf@lenoxhomeloans.com, marketing@lenoxhomeloans.com";
	$subject = "Log Page - " . get_permalink();
	$sendmessage = "Log Info: \r\n\r\n";
	
	$sendmessage .= "Marketing ID: "  . $utm_code . "\r\n";
	$sendmessage .= "\r\n************ Logs ************\r\n";	
	$sendmessage .= "Server: <pre>" . print_r( $_SERVER, true ) . "</pre>\r\n";
	$sendmessage .= "Post: <pre>" . print_r( $_POST, true ) . "</pre>\r\n";
	$sendmessage .= "Get: <pre>" . print_r( $_GET, true ) . "</pre>\r\n";
	$sendmessage .= "Cookies: <pre>" . print_r( $_COOKIE, true ) . "</pre>\r\n";
	$sendmessage = nl2br( $sendmessage );
	//echo $sendmessage;
	
	// Send mail by PHP Mail Function.
	wp_mail( $to, $subject, $sendmessage, $headers );
		
	// Delete cookie: utm_code for 1 year
	setcookie('utm_code', "", time() - 3600, "/");
}
// Add a shortcode
add_shortcode('log_page', 'lfm_log_page');


/**
 * Save UTM Campaign Code.
 *
 */
function saveUtmCode() {
    if(isset($_GET['utm_code']) || isset($_POST['utm_code'])) {
		$utm_code = sanitize_text_field(isset($_POST['utm_code']) ? $_POST['utm_code']:$_GET['utm_code']);
		if($utm_code){
			/*if(!isset($_COOKIE['utm_code']) && !trim($_COOKIE['utm_code'])) {
				// Save cookie: utm_code for 1 year
				setcookie('utm_code', $utm_code, time() + 31556926, "/"); // 86400 = 1 day
			}*/
			$ex_cookies = (isset($_COOKIE['utm_code']))?explode(',', $_COOKIE['utm_code']):array();
			$cookies = array_unique($ex_cookies);
			if(end($cookies) != $utm_code)
			  $cookies[] =  $utm_code;

			// Save cookie: utm_code for 1 year
			setcookie('utm_code', implode(',', $cookies), time() + 31556926, "/"); // 86400 = 1 day
			
			global $toolfree_mkt, $wpdb;
			
			$items = $wpdb->get_results("SELECT phone FROM lfm_tollfreenumbers WHERE utm_code IN ('" . implode("', '", $cookies) . "') ORDER BY FIELD (utm_code, '" . implode("', '", $cookies) . "') LIMIT 1;", ARRAY_A);
			if(isset($items[0]['phone'])) {
				$toolfree_mkt = $items[0]['phone'];
				setcookie('mkt_tfn', $toolfree_mkt, time() + 31556926, "/"); // 86400 = 1 day
			}
		}
		
		if($_SERVER['REMOTE_HOST'] == '65.60.125.232' || (isset($_SERVER['SERVER_NAME']) && strtolower(substr($_SERVER['SERVER_NAME'], 0, 3)) == 'www'))
			return true;
		
		// Send UtmCode Log
		// To send HTML mail, the Content-type header must be set.				
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Web Admin <no-replay@lenoxhomeloans.com>' . "\r\n"; // Sender's Email
				
		$to = "haris.yusuf@lenoxhomeloans.com, marketing@lenoxhomeloans.com";
		//$to = "marketing@lenoxhomeloans.com";
		$subject = "UTM Code Log - Lenox";
		$sendmessage = "UTM Code: $utm_code\r\n\r\n";
		$sendmessage .= "User IP: " . (isset($_SERVER['REMOTE_HOST'])?$_SERVER['REMOTE_HOST']:'') . "\r\n";
		//$sendmessage .= "URL: " . (isset($_SERVER['HTTP_X_ORIGINAL_URL'])?$_SERVER['HTTP_X_ORIGINAL_URL']:'') . "\r\n";
		$sendmessage .= "Request URL: " . (isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:'') . "\r\n";
		$sendmessage .= "User Browser: " . (isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'') . "\r\n";
		$sendmessage .= "Referer: " . (isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'') . "\r\n";
		$sendmessage .= "Site: " . (isset($_SERVER['SERVER_NAME'])?$_SERVER['SERVER_NAME']:'') . "\r\n";

		$sendmessage .= "\r\n************ Status Log ************\r\n";
		if($utm_code) {
			$sendmessage .= "Existing Cookies: <pre>" . print_r( $ex_cookies, true ) . "</pre>\r\n";
			$sendmessage .= "Updated Cookies: <pre>" . print_r( $cookies, true ) . "</pre>\r\n";
			$sendmessage .= "Tollfree: " . $toolfree_mkt . "\r\n";
		}	
		//$sendmessage .= "Server: <pre>" . print_r( $_SERVER, true ) . "</pre>\r\n";
		$sendmessage .= "Cookies: <pre>" . print_r( $_COOKIE, true ) . "</pre>\r\n";
		$sendmessage = nl2br( $sendmessage );
		//echo $sendmessage;
			
		// Send mail by PHP Mail Function.		
		wp_mail( $to, $subject, $sendmessage, $headers );
	}	
}
add_action('wp', 'saveUtmCode');

/**
 * Custom Marketing Tool Free Number
 *
 */
/*function lfm_campaign_toolfree( $atts = array() ) {
	global $toolfree_mkt;
	
	$toolfree = '888.395.3669';
	if(isset($_COOKIE['mkt_tfn']))
		$toolfree = $_COOKIE['mkt_tfn'];
	if(trim($toolfree_mkt))
		$toolfree = $toolfree_mkt;
	if($page_phone = get_post_meta(get_the_ID (), "meta-box-lfm-text_meta_phone", true))
		$toolfree = $page_phone;	
	
	$string = '<a class="mkt-tollfree" href="tel:' . preg_replace('/\D/', '', $toolfree) . '" title="' . $toolfree . '">' . $toolfree . '</a>';
	return $string;
}*/
function lfm_campaign_toolfree_ajx( $atts = array() ) {
	global $toolfree_mkt;
	
	$toolfree = '888.395.3669';
	if(trim($toolfree_mkt))
		$toolfree = $toolfree_mkt;
	$string = '<a class="mkt-tollfree" href="tel:' . preg_replace('/\D/', '', $toolfree) . '" title="' . $toolfree . '">' . $toolfree . '</a>';
	if($page_phone = get_post_meta(get_the_ID (), "meta-box-lfm-text_meta_phone", true))
		$string = '<a class="page-tollfree" href="tel:' . preg_replace('/\D/', '', $page_phone) . '" title="' . $page_phone . '">' . $page_phone . '</a>';
	return $string;
}
// Add a shortcode
add_shortcode('maketing_campaign_toolfree', 'lfm_campaign_toolfree_ajx');

/**
 * Custom Latest Post 23
 *
 */
function wpb_postsbycategory($category_name = "", $posts_per_page = 3) {
	// the query
	$the_query = new WP_Query( array( 'category_name' => $category_name, 'posts_per_page' => $posts_per_page ) ); 	

	$string = '<ul class="postsbycategory widget_recent_entries">';		
	// The Loop
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			// if ( has_post_thumbnail() ) {
				// $string .= '<li>';
				// $string .= '<a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_post_thumbnail($post_id, array( 50, 50) ) . get_the_title() .'</a></li>';
			// } else { 
				// // if no featured image is found
				// $string .= '<li><a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_title() .'</a></li>';
			// }
			$string .= '<li><a href="' . get_the_permalink() . '" rel="bookmark">' . get_the_title() .'</a></li>';
		}
	} else {
		// no posts found
	}
	$string .= '</ul>';

	/* Restore original Post Data */
	wp_reset_postdata();
	
	return $string;
}
// Add a shortcode
add_shortcode('categoryposts', 'wpb_postsbycategory');

// Enable shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');


/**
 * Custom Homepage Sliders
 *
 */
function lfm_image_sliders() {
	global $post, $audio;
	$audio = array();
	
	if(!isset( get_post( $post )->post_name))
		return FALSE;
	$slug = get_post( $post )->post_name;
	
	$rs = array();
	$inputFileName = "C:\LFMUploads\Marketing\data-slides-" . $slug . ".csv";
	//echo "inlcudes: $inputFileName if exists.";

	//  Read your CSV file
	$row = 0;
	if (file_exists($inputFileName) && ($handle = fopen($inputFileName, "r")) !== FALSE) {
		$string = '
<div class="main-slider">
	<div class="layer-slider' . ($slug !='homepage'?'-static container':'') . '">';
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$attachment = wp_get_attachment_by_post_name( $data[0] );
			if(!isset($attachment->org) || $row == 0) {
				$row++;
				continue;
			}			
			$string .= '
		<div id="slide_' . $row . '" class="slides ' . ($row == 1?'show':'hide') . '-display">
			<div class="image-slider clearfix" title="' . implode(' ' , array($data[1], $data[2], $data[3])) . '" style="background-image:url(\'' . esc_url($attachment->org) . '\')">
				<div class="container">
					<article class="slider-content clearfix freesia-animation fadeInRight">';						
						$sliderTitle = array();
						if(trim($data[1]))
						  $sliderTitle[] = '<span class="slider-title1">' . $data[1] . '</span>';
						if(trim($data[2]))
						  $sliderTitle[] = '<span class="slider-title2">' . $data[2] . '</span>';
						if(trim($data[3]))
						  $sliderTitle[] = '<span class="slider-title3">' . $data[3] . '</span>';					  
						$string .= (sizeof($sliderTitle) > 0)?'<h1 class="slider-title">' . implode('', $sliderTitle) . '</h1><!-- .slider-title -->':'';
						$string .= (trim($data[4]))?'<div class="slider-text"><h3>' . $data[4] . '</h3></div><!-- end .slider-text -->':'';
						$data[5] = (trim($data[6]))?$data[5]:'Click Here';
						$btn_icon = ($row == 3)?'<span class="icon-earphone"></span>':'';
						$btn_class = $audio_str = '';
						if(strstr($data[6], '.mp3')) {
							$btn_class = " btn-audio amplitude-play-pause";
							$audio_id = 'lfmAudio' . $row;	
							/*$audio_str .='<audio controls id="' . $audio_id . '" style="display: none;float:left;">
								<source src="' . $data[6] . '" type="audio/mpeg">
								Please <a href="' . $data[6] . '" download>download</a> the audio file.
								</audio>';*/
							$audio["songs"][] = array(
												"name" => "Low Rates and No Closing Cost Loan Options ",
												"artist" => "Wesley Hoaglund of Lenox Financial",
												"album" => "",
												"url" => $data[6]
												);
							$data[6] = '#' . $audio_id;							
						}	
						$string .= (trim($data[6]))?'<div class="slider-buttons"><a id="slide-button_' . $row .'" title="' . $data[5] . '" href="' . $data[6] . '" class="btn-default vivid' . $btn_class . '">' . $data[5] . '<span>&#10093;</span>' . $btn_icon . '</a>' . $audio_str . '</div>':'';
					$string .= '</article><!-- end .slider-content -->
				</div><!-- end .container -->
			</div><!-- end .image-slider -->
		</div><!-- end .slides -->';
			$row++;
		}
		$string .= '
	</div><!-- end .layer-slider -->
	' . ($row > 2?'<a class="slider-prev" id="prev2" href="#">&#10092;</a> <a class="slider-next" id="next2" href="#">&#10093;</a>':'') . '
	<nav class="slider-button"> </nav><!-- end .slider-button -->
</div>
<!-- end .main-slider -->';
		
		fclose($handle);		
	}
	else
		return $string = '<!-- Read CSV to HTML Table --><!-- Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'" --><!-- Read CSV to HTML Table -->';
	
	echo $string;
}	

/**
 * Custom Quick Quote
 *
 */
function lfm_quickquoteform( $atts = array() ) {
	$quick_quote_atts = shortcode_atts( array(
        'show_all' => FALSE,
		'campaign_id' => ''
    ), $atts );	
	//print_r($quick_quote_atts);
	
	$cont_btn = $show_cls = $disabled = $campaign_inpt = '';
	$input_req = ' required';
	if(!$quick_quote_atts['show_all']) {
		$cont_btn = '<div class="four-column btn-section" id="btn-quickquote-continue-section">
											<span class="required"><sub>*</sub> Required Field</span>
											<input id="btn-quickquote-continue" class="btn-blue open-slide" type="button" value="Continue &nbsp; &#10093;">
										</div>';
		$show_cls = ' js-slide-hidden';
		$input_req = '';
		$disabled = ' disabled';
	}
	if($quick_quote_atts['campaign_id']) {
		$campaign_inpt = '<input type="hidden" name="campaign_id" value="' . $quick_quote_atts['campaign_id'] . '"/>';
	}
	
	$string = '
				<section class="widget widget_form quick_quote">
					<div class="container clearfix">
						<div class="">
							<h2><mark>Get a Quick Quote</mark> <span class="no-wrap">at no obligation</span></h2>
							<div class="form">
								<form id="form-quickquote" action="#">';
									
									// if(isset($_COOKIE['utm_code'])) {
										// $string .= "UTM Code: " . $_COOKIE['utm_code'];
									// }
									
									$string .= '<div class="row clearfix msg-slide js-slide-hidden">
										<div class="one-column area">
											<h3>Thank you!</h3>
											<p id="results-quickquote"></p>
										</div>								
									</div>
									<div class="clearfix row">
										<div class="four-column area">
											<label for="lookingto">I Am Looking To <span class="required">*</span></label>									
											<select id="lookingto" name="lookingto" required>
												<option value="">Please select one</option>
												<option value="Refinance">Refinance</option>
												<option value="Purchase">Purchase</option>
											</select><br />
											<div id="lookingto-err-msg" class="required"></div>
										</div>
										<div class="four-column area">
											<label for="state">State <span class="required">*</span></label>
											<select id="state" name="state" required>
												<option value="">Please select one</option>
												<option value="AL">Alabama</option>
												<option value="AK">Alaska</option>
												<option value="AZ">Arizona</option>
												<option value="AR">Arkansas</option>
												<option value="CA">California</option>
												<option value="CO">Colorado</option>
												<option value="CT">Connecticut</option>
												<option value="DE">Delaware</option>
												<option value="DC">District Of Columbia</option>
												<option value="FL">Florida</option>
												<option value="GA">Georgia</option>
												<option value="HI">Hawaii</option>
												<option value="ID">Idaho</option>
												<option value="IL">Illinois</option>
												<option value="IN">Indiana</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
												<option value="LA">Louisiana</option>
												<option value="ME">Maine</option>
												<option value="MD">Maryland</option>
												<option value="MA">Massachusetts</option>
												<option value="MI">Michigan</option>
												<option value="MN">Minnesota</option>
												<option value="MS">Mississippi</option>
												<option value="MO">Missouri</option>
												<option value="MT">Montana</option>
												<option value="NE">Nebraska</option>
												<option value="NV">Nevada</option>
												<option value="NH">New Hampshire</option>
												<option value="NJ">New Jersey</option>
												<option value="NM">New Mexico</option>
												<option value="NY">New York</option>
												<option value="NC">North Carolina</option>
												<option value="ND">North Dakota</option>
												<option value="OH">Ohio</option>
												<option value="OK">Oklahoma</option>
												<option value="OR">Oregon</option>
												<option value="PA">Pennsylvania</option>
												<option value="RI">Rhode Island</option>
												<option value="SC">South Carolina</option>
												<option value="SD">South Dakota</option>
												<option value="TN">Tennessee</option>
												<option value="TX">Texas</option>
												<option value="UT">Utah</option>
												<option value="VT">Vermont</option>
												<option value="VA">Virginia</option>
												<option value="WA">Washington</option>
												<option value="WV">West Virginia</option>
												<option value="WI">Wisconsin</option>
												<option value="WY">Wyoming</option>
											</select>
											<div id="state-err-msg" class="required"></div>
										</div>
										<div class="four-column area">
											<label for="email">Email Address <span class="required">*</span></label>
											<input type="email" id="email" name="email" required maxlength="250">
											<div id="email-err-msg" class="required"></div>
										</div>' . $cont_btn . '</div>
									<div class="row clearfix form-slide' . $show_cls . '">
										<div class="four-column area">
											<label for="firstname">First Name <span class="required">*</span></label>
											<input type="text" id="firstname" name="firstname" maxlength="50"' . $input_req . '>
											<div id="firstname-err-msg" class="required"></div>
										</div>
										<div class="four-column area">
											<label for="lastname">Last Name <span class="required">*</span></label>
											<input type="text" id="lastname" name="lastname" maxlength="50"' . $input_req . '>
											<div id="lastname-err-msg" class="required"></div>
										</div>
										<div class="four-column area">
											<label for="phone">Primary Number <span class="required">*</span></label>
											<input type="tel" id="phone" name="phone" title="Primary Number (Format: (999)999-9999)" maxlength="13" pattern=".{13,}"' . $input_req . '>
											<div id="phone-err-msg" class="required"></div>
										</div>
										<div class="four-column btn-section">
											<span class="required"><sub>*</sub> Required Field</span>
											<input type="text" name="subject" style="display: none;">
											<input type="hidden" name="action" value="addQuickqoute"/>
											' . $campaign_inpt . '
											<input id="btn-quickquote-submit" class="btn-orange" type="submit" value="Get My Free Quote &nbsp; &#10093;"' . $disabled . '>
										</div>
										<div class="one-column"><small>By providing information and clicking on Submit form you agree to our Online Policy and are expressly consenting for us to contact you by telephone, mobile device, email and including text message, automated or prerecorded means, even if your telephone number is on a state, corporate or national Do Not Call Registry. Your consent is not required as a condition to obtain a loan.</small></div>
									</div>
								</form>
							</div>
						</div>
						
					</div>
				</section>';
	return $string;
}
// Add a shortcode
add_shortcode('quickquoteform', 'lfm_quickquoteform');

/**
 * Php function for ajax call: contactUs
 *
 */
function contactUs() {
	// Spam filter by field trap: subject
	if(isset($_POST['subject']) && trim($_POST['subject']) != '') {
		wp_die();
	}
	
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = is_email($_POST['email']);	
	$phone = $_POST['phone'];
	$state = $_POST['state'];
	$message = $_POST['message'];
	
	$to = "haris.yusuf@lenoxhomeloans.com, Mary.Caoile@lenoxhomeloans.com, info@lenoxhomeloans.com";
	$subject = "Contact Us Form New Website Inquiry - $firstname $lastname";
	// To send HTML mail, the Content-type header must be set.
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: ' . $firstname . ' ' . $lastname . ' <' . $email. ">\r\n"; // Sender's Email
	//$headers .= 'Cc:' . $email. "\r\n"; // Carbon copy to Sender
	/*$template = '<div style="padding:50px; color:white;">Hello ' . $firstname . ' ' . $lastname . ',<br/>'
	. '<br/>Thank you...! For Contacting Us.<br/><br/>'
	. 'Name: ' . $firstname . ' ' . $lastname . '<br/>'
	. 'Email: ' . $email . '<br/>'
	. 'Contact No: ' . $phone . '<br/>'
	. 'State: ' . $state . '<br/>'
	. 'Message: ' . $message . '<br/><br/>'
	. 'This is a Contact Confirmation mail.'
	. '<br/>'
	. 'We Will contact You as soon as possible .</div>';
	$sendmessage = "<div style=\"background-color:#7E7E7E; color:white;\">" . $template . "</div>";
	// Message lines should not exceed 70 characters (PHP rule), so wrap it.
	$sendmessage = wordwrap($sendmessage, 70);*/	
	
	$sendmessage = "A contact request has been submitted on our Lenox/WesLend website. Please contact as soon as possible, thank you!\r\n\r\n";
	$sendmessage .= 'Name: ' . $firstname . ' ' . $lastname . "\r\n";
	$sendmessage .= "Email: " . $email . "\r\n";
	$sendmessage .= 'Contact No: ' . $phone . "\r\n";
	$sendmessage .= 'State: ' . $state . "\r\n";
	$sendmessage .= "Site: " . ($_SERVER[SERVER_NAME]?$_SERVER[SERVER_NAME]:'') . "\r\n";
	$sendmessage .= 'Message: ' . $message . "\r\n\r\n";	
	$sendmessage = nl2br( $sendmessage );
	
	// Send mail by PHP Mail Function.	
	wp_mail( $to, $subject, $sendmessage, $headers );
	
	echo "Your Query has been received, We will contact you soon.";
	
	wp_die();
}
add_action('wp_ajax_nopriv_contactUs', 'contactUs');
add_action('wp_ajax_contactUs', 'contactUs');

/**
 * Custom Contact Us Form
 *
 */
function lfm_contactusform() {
	$string = '
				<section id="section-contact_us" class="widget widget_form contact_us">
					<div class="container clearfix">
						<div class="">
							<h2><mark>Contact Request</mark></h2>
							<div class="form">
								<form id="form-contactus" action="#">
									<div class="row clearfix msg-slide js-slide-hidden">									
										<div class="one-column area">
											<h3>Thank you!</h3>
											<p id="results-contactus"></p>
										</div>								
									</div>
									<div class="clearfix row">
										<div class="four-column area">
											<label for="firstname">First Name <span class="required">*</span></label>
											<input type="text" id="firstname" name="firstname" required maxlength="50">
											<div id="firstname-err-msg" class="required"></div>
										</div>
										<div class="four-column area">
											<label for="lastname">Last Name <span class="required">*</span></label>
											<input type="text" id="lastname" name="lastname" required maxlength="50">
											<div id="lastname-err-msg" class="required"></div>
										</div>										
										<div class="four-column area">
											<label for="email">Email Address <span class="required">*</span></label>
											<input type="email" id="email" name="email" required maxlength="250">
											<div id="email-err-msg" class="required"></div>
										</div>										
									</div>
									<div class="row clearfix">
										<div class="four-column area">
											<label for="phone">Primary Number <span class="required">*</span></label>
											<input type="tel" id="phone" name="phone" required title="Primary Number (Format: (999)999-9999)" maxlength="13" pattern=".{13,}">
											<div id="phone-err-msg" class="required"></div>
										</div>
										<div class="four-column area">
											<label for="state">State <span class="required">*</span></label>
											<select id="state" name="state" required>
												<option value="">Please select one</option>
												<option value="AL">Alabama</option>
												<option value="AK">Alaska</option>
												<option value="AZ">Arizona</option>
												<option value="AR">Arkansas</option>
												<option value="CA">California</option>
												<option value="CO">Colorado</option>
												<option value="CT">Connecticut</option>
												<option value="DE">Delaware</option>
												<option value="DC">District Of Columbia</option>
												<option value="FL">Florida</option>
												<option value="GA">Georgia</option>
												<option value="HI">Hawaii</option>
												<option value="ID">Idaho</option>
												<option value="IL">Illinois</option>
												<option value="IN">Indiana</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
												<option value="LA">Louisiana</option>
												<option value="ME">Maine</option>
												<option value="MD">Maryland</option>
												<option value="MA">Massachusetts</option>
												<option value="MI">Michigan</option>
												<option value="MN">Minnesota</option>
												<option value="MS">Mississippi</option>
												<option value="MO">Missouri</option>
												<option value="MT">Montana</option>
												<option value="NE">Nebraska</option>
												<option value="NV">Nevada</option>
												<option value="NH">New Hampshire</option>
												<option value="NJ">New Jersey</option>
												<option value="NM">New Mexico</option>
												<option value="NY">New York</option>
												<option value="NC">North Carolina</option>
												<option value="ND">North Dakota</option>
												<option value="OH">Ohio</option>
												<option value="OK">Oklahoma</option>
												<option value="OR">Oregon</option>
												<option value="PA">Pennsylvania</option>
												<option value="RI">Rhode Island</option>
												<option value="SC">South Carolina</option>
												<option value="SD">South Dakota</option>
												<option value="TN">Tennessee</option>
												<option value="TX">Texas</option>
												<option value="UT">Utah</option>
												<option value="VT">Vermont</option>
												<option value="VA">Virginia</option>
												<option value="WA">Washington</option>
												<option value="WV">West Virginia</option>
												<option value="WI">Wisconsin</option>
												<option value="WY">Wyoming</option>
											</select>
											<div id="state-err-msg" class="required"></div>
										</div>																				
									</div>
									<div class="row clearfix">
										<div class="one-column area">
											<label for="message">How May We Help You? <span class="required">*</span></label>
											<input type="text" name="subject" style="display: none;">
											<textarea id="message" name="message" cols="40" rows="6" required></textarea>
											<div id="message-err-msg" class="required"></div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="one-column btn-section">
											<span class="required"><sub>*</sub> Required Field</span>
											<input type="hidden" name="action" value="contactUs"/>
											<input id="btn-contactus-submit" type="submit" value="Send Message &nbsp; &#10093;">
										</div>
									</div>
									<div class="one-column"><small>By providing information and clicking on Submit form you agree to our Online Policy and are expressly consenting for us to contact you by telephone, mobile device, email and including text message, automated or prerecorded means, even if your telephone number is on a state, corporate or national Do Not Call Registry. Your consent is not required as a condition to obtain a loan.</small></div>
								</form>
							</div>
						</div>
						
					</div>
				</section>';
	return $string;
}
// Add a shortcode
add_shortcode('contactusform', 'lfm_contactusform');

/**
 * Php function for ajax call: emailSubscription
 *
 */
function emailSubscription() {
	// Spam filter by field trap: subject
	if(isset($_POST['subject']) && trim($_POST['subject']) != '') {
		wp_die();
	}
	
	$email = is_email($_POST['ne']);	
	
	//$to = "marketing@lenoxhomeloans.com";
	$to = "haris.yusuf@lenoxhomeloans.com, Mary.Caoile@lenoxhomeloans.com, marketing@lenoxhomeloans.com";	
	$subject = "Please add me to your blog subscription";
	// To send HTML mail, the Content-type header must be set.
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: Email Subscription Form <no-replay@lenoxhomeloans.com>' . "\r\n"; // Sender's Email
	/*$template = '<div style="padding:50px; color:white;">Hello,<br/>'
	. '<br/>We just received new blog subscriber.<br/><br/>'
	. 'Email: ' . $email . '<br/>'
	. '<br/>'
	. 'Please add to the blog subscription list.</div>';
	$sendmessage = "<div style=\"background-color:#666; color:white; padding:20px;\">" . $template . "</div>";
	// Message lines should not exceed 70 characters (PHP rule), so wrap it.
	$sendmessage = wordwrap($sendmessage, 70);*/
	$sendmessage = "Hello,\r\n\r\n";
	$sendmessage .= "We just received new blog subscriber.\r\n";
	$sendmessage .= "Email: " . $email . "\r\n";
	$sendmessage .= "Site: " . ($_SERVER[SERVER_NAME]?$_SERVER[SERVER_NAME]:'') . "\r\n";
	$sendmessage .= "Please add to the blog subscription list.\r\n";	
	$sendmessage = nl2br( $sendmessage );
	
	// Send mail by PHP Mail Function.	
	wp_mail( $to, $subject, $sendmessage, $headers );
	
	echo "Thank you for subscribing to our newsletter.";
	
	wp_die();
}
add_action('wp_ajax_nopriv_emailSubscription', 'emailSubscription');
add_action('wp_ajax_emailSubscription', 'emailSubscription');

/**
 * Custom Email Subscription Form
 *
 */
function lfm_emailsubscriptionform() {
	$string = '<div class="newsletter newsletter-widget">
					<form id="form-emailsubscription" action="#">
						<div id="msg-emailsubscription" class="clearfix msg-slide js-slide-hidden">
							<h3>Thank you!</h3>
							<p id="results-emailsubscription"></p>
						</div>						
						<input type="hidden" name="nr" value="widget"/>
						<p>
							<input type="text" name="subject" style="display: none;">
							<input class="newsletter-email" type="email" required name="ne" id="ne" value="Email" onclick="if (this.defaultValue==this.value) this.value=\'\'" onblur="if (this.value==\'\') this.value=this.defaultValue"/>
							<input class="newsletter-submit" type="submit" value="Subscribe &nbsp; &#10093;"/>
						</p>
						<div id="ne-err-msg" class="required"></div>
						<input type="hidden" name="action" value="emailSubscription"/>						
					</form>
				</div>';
	return $string;
}
// Add a shortcode
add_shortcode('emailsubscriptionform', 'lfm_emailsubscriptionform');

/**
 * Custom Read XLS File to HTML Table.
 *
 */
function lfm_xls_to_html_table() {
	include('../lib/PHPExcel.php');
	 
	$inputFileName = "C:\inetpub\wwwroot\Book1.xlsx";	
	 
	//  Read your Excel workbook
	try {
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($inputFileName);
	} catch(Exception $e) {
		//die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		return $string = '<!-- Read XLS to HTML Table --><!-- Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage() . ' --><!-- Read XLS to HTML Table -->';
	}

	//  Get worksheet dimensions
	$sheet = $objPHPExcel->getSheet(0); 
	$highestRow = $sheet->getHighestRow(); 
	$highestColumn = $sheet->getHighestColumn();

	//  Loop through each row of the worksheet in turn
	$string = '<table>
	<colgroup>
		<col />
		<col />
		<col />
	</colgroup>
	<tbody>';
	for ($row = 1; $row <= $highestRow; $row++) { 
		//  Read a row of data into an array
		$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
										NULL,
										TRUE,
										FALSE);
		$string .= '<tr>';
		for ($col = 0; $col < sizeof($rowData[0]); $col++) {
			$cell = $sheet->getCellByColumnAndRow($col, $row);
            $val = $cell->getValue();
			$color = $cell->getStyle()->getFill()->getStartColor()->getRGB();
            $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
			
			$style = ($color != '000000')?' style="background-color:#' . $color . '; color:#fff;"':'';			
			$string .= ($row == 1)?'<th' . $style . '>':'<td' . $style . '>';
			//$string .= $val . ' - ' . $dataType . ' - ' . $color;
			$string .= $val;
			$string .= ($row == 1)?'</th>':'</td>';
		}
		$string .= '</tr>';
	}
	$string .= '</tbody>
</table>';
	return $string;
}
// Add a shortcode
add_shortcode('xlstohtmltable1', 'lfm_xls_to_html_table');

/**
 * Custom Read CSV File to HTML Table.
 *
 */
function convert( $str ) {
    return iconv( "Windows-1252", "UTF-8", $str );
}
 
function lfm_csv_to_html_table_noclosingcost() {
	$rs = array();
	$inputFileName = "C:\LFMUploads\Secondary\data-costs-no-closing-cost.csv";	
	 
	//  Read your CSV file
	$row = 0;
	if (file_exists($inputFileName) && ($handle = fopen($inputFileName, "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$data = array_map( "convert", $data );
			for ($c=0; $c < sizeof($data); $c++) {			
				$rs[$row][$c] = $data[$c];				
			}			
			$row++;
		}
		fclose($handle);
		
		$string = '<table>
				<colgroup>
					<col style="background-color:#BFBFBF;" />
					<col />
					<col />
				</colgroup>
				<tbody>
					<tr>
						<th>' . $rs[0][0] . '</th>
						<th style="background-color:#00B0F0; color:#fff;text-align:center;font-weight:bold;">' . $rs[0][1] . '</th>
						<th style="background-color:#9BBB59; color:#fff;text-align:center;font-weight:bold;">' . $rs[0][2] . '</th>
					</tr>
					<tr>
						<td style="color:#fff;text-align:right;font-weight:bold;">' . $rs[1][0] . '</td>
						<td style="color:#046ba5;text-align:center;font-weight:bold;">' . $rs[1][1] . '</td>
						<td style="color:#046ba5;text-align:center;font-weight:bold;">' . $rs[1][2] . '</td>
					</tr>
					<tr>
						<td style="color:#fff;text-align:right;font-weight:bold;">' . $rs[2][0] . '</td>
						<td style="color:#046ba5;text-align:center;">' . $rs[2][1] . '</td>
						<td style="color:#046ba5;text-align:center;">' . $rs[2][2] . '</td>
					</tr>
					<tr>
						<td style="color:#fff;text-align:right;font-weight:bold;">' . $rs[3][0] . '</td>
						<td style="color:#046ba5;text-align:center;">' . $rs[3][1] . '</td>
						<td style="color:#046ba5;text-align:center;">' . $rs[3][2] . '</td>
					</tr>
					<tr>
						<td style="color:#fff;text-align:right;font-weight:bold;">' . $rs[4][0] . '</td>
						<td style="color:#046ba5;text-align:center;font-weight:bold;">' . $rs[4][1] . '</td>
						<td style="color:#046ba5;text-align:center;font-weight:bold;">' . $rs[4][2] . '</td>
					</tr>
					<tr>
						<td style="color:#fff;text-align:right;font-weight:bold;">' . $rs[5][0] . '</td>
						<td style="color:#046ba5;text-align:center;">' . $rs[5][1] . '</td>
						<td style="color:#046ba5;text-align:center;">' . $rs[5][2] . '</td>
					</tr>
				</tbody>
			</table>
			<p class="bodyfont">' . $rs[6][0] . ' <a href="#cost-more-detail" class="btn-toggle">Click here for more details.</a></p>
			<p id="cost-more-detail" class="bodyfont js-slide-hidden">
				<small>' . nl2br($rs[7][0]) . '</small>
			</p>
			<p>' . nl2br($rs[8][0]) . '</p>';

	}
	else
		return $string = '<!-- Read CSV to HTML Table --><!-- Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'" --><!-- Read CSV to HTML Table -->';
	return $string;
}
// Add a shortcode.
add_shortcode('csvtohtmltable1', 'lfm_csv_to_html_table_noclosingcost');

/**
 * Custom get media in html
 *
 */
function lfm_media( $atts = array() ) {
	$media_atts = shortcode_atts( array(
        'postname' => '',
		'linkurl' => '',
		'linktitle' => ''
    ), $atts );	
	
	$attachment = wp_get_attachment_by_post_name( $media_atts['postname'] );
	//print_r($media_atts);print_r($attachment);
	
	if(!is_object($attachment))
		return False;
	
	if((is_string($attachment->post_content) &&
            (is_object(json_decode($attachment->post_content)) ||
            is_array(json_decode($attachment->post_content))))) {
				$media_atts = array_merge($media_atts, json_decode($attachment->post_content, true));
	}
	
	$string = '';
	$string .= (trim($media_atts['linkurl']))?'<a href="' . $media_atts['linkurl'] . '"':'';
	$string .= (trim($media_atts['linkurl']) && trim($media_atts['linktitle']))?' title="' . $media_atts['linktitle'] . '"':'';
	$string .= (trim($media_atts['linkurl']))?'>':'';
	$string .= ($attachment->org)?'<img src="' . esc_url($attachment->org) . '"':'';
	$string .= ($attachment->org && $attachment->post_title)?' alt="' . $attachment->post_title . '" title="' . $attachment->post_title . '" ':'';
	$string .= ($attachment->org)?'/>':'';
	$string .= (trim($media_atts['linkurl']))?'</a>':'';
	return $string;
}
// Add a shortcode
add_shortcode('media', 'lfm_media');
	
function lfm_site_footer() {
	if ( is_active_sidebar( 'freesiaempire_footer_options' ) ) :
		dynamic_sidebar( 'freesiaempire_footer_options' );
	else:
		$svg = file_get_contents( "/images/Equal-Housing-Opportunity-Logo.svg", FILE_USE_INCLUDE_PATH );
		echo '<div class="copyright">
			' . $svg . '
			' .'&copy; ' . get_the_time('Y') .' '; ?>Lenox Financial Mortgage Corporation dba WesLend Financial All Rights Reserved. 
				<a title="<?php echo esc_attr__( 'NMLS# 3304', 'freesia-empire' );?>" href="<?php echo esc_url( '/licenses/' );?>"><?php _e('NMLS # 3304','freesia-empire'); ?></a>		
			</div>
	<?php endif;
}
add_action( 'lfm_sitegenerator_footer', 'lfm_site_footer');

/**
 * Customize Search Results: Exclude by Author: Campaign Marketing.
 *
 */ 
function SearchFilter($query) {
	if ($query->is_search && (!is_admin())) {
		$user = get_user_by( 'email', 'marketing@lenoxhomeloans.com' );
		$query->set('author', $user->ID * -1);
	}
	return $query;
}
add_filter('pre_get_posts','SearchFilter');

function lfm_header_title() {
	$format = get_post_format();
	if( is_archive() ) {
		if ( is_category() ) :
			$freesiaempire_header_title = single_cat_title( '', FALSE );
		elseif ( is_tag() ) :
			$freesiaempire_header_title = single_tag_title( '', FALSE );
		elseif ( is_author() ) :
			the_post();
			$freesiaempire_header_title =  sprintf( __( 'Author: %s', 'freesia-empire' ), '<span class="vcard">' . get_the_author() . '</span>' );
			rewind_posts();
		elseif ( is_day() ) :
			$freesiaempire_header_title = sprintf( __( 'Day: %s', 'freesia-empire' ), '<span>' . get_the_date() . '</span>' );
		elseif ( is_month() ) :
			$freesiaempire_header_title = sprintf( __( 'Month: %s', 'freesia-empire' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
		elseif ( is_year() ) :
			$freesiaempire_header_title = sprintf( __( 'Year: %s', 'freesia-empire' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
		elseif ( $format == 'audio' ) :
			$freesiaempire_header_title = __( 'Audios', 'freesia-empire' );
		elseif ( $format =='aside' ) :
			$freesiaempire_header_title = __( 'Asides', 'freesia-empire');
		elseif ( $format =='image' ) :
			$freesiaempire_header_title = __( 'Images', 'freesia-empire' );
		elseif ( $format =='gallery' ) :
			$freesiaempire_header_title = __( 'Galleries', 'freesia-empire' );
		elseif ( $format =='video' ) :
			$freesiaempire_header_title = __( 'Videos', 'freesia-empire' );
		elseif ( $format =='status' ) :
			$freesiaempire_header_title = __( 'Status', 'freesia-empire' );
		elseif ( $format =='quote' ) :
			$freesiaempire_header_title = __( 'Quotes', 'freesia-empire' );
		elseif ( $format =='link' ) :
			$freesiaempire_header_title = __( 'links', 'freesia-empire' );
		elseif ( $format =='chat' ) :
			$freesiaempire_header_title = __( 'Chats', 'freesia-empire' );
		elseif ( class_exists('WooCommerce') && (is_shop() || is_product_category()) ):
  			$freesiaempire_header_title = woocommerce_page_title( false );
  		elseif ( class_exists('bbPress') && is_bbpress()) :
  			$freesiaempire_header_title = get_the_title();
		else :
			$freesiaempire_header_title = __( 'Archives', 'freesia-empire' );
		endif;
	} elseif (is_home()){
		$freesiaempire_header_title = get_the_title( get_option( 'page_for_posts' ) );
	} elseif (is_404()) {
		$path = current( explode( '/', trim( $_SERVER['REQUEST_URI'], '/' ) ) );
		if($path == 'careers' || $path == 'career') :
			$freesiaempire_header_title = __('This position is no longer available', 'freesia-empire');
		else :	
			$freesiaempire_header_title = __('Sorry, this page cannot be found', 'freesia-empire');
		endif;	
	} elseif (is_search()) {
		$freesiaempire_header_title = __('Search Results', 'freesia-empire');
	} elseif (is_page_template()) {
		$freesiaempire_header_title = get_the_title();
	} else {
		$freesiaempire_header_title = get_the_title();
	}
	return $freesiaempire_header_title;
}

function filter_pagetitle($title) {
    if (is_404()) {
		$path = current( explode( '/', trim( $_SERVER['REQUEST_URI'], '/' ) ) );
		if($path == 'careers' || $path == 'career') :
			$title = __('Career not found', 'freesia-empire');		
		endif;	
	}
	return $title;
}
add_filter('pre_get_document_title', 'filter_pagetitle');


/**
 * Customizing the Admin Area.
 *
 */
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/lenox_weslend_logo.png);
            -webkit-background-size: 320px;
			background-size: 320px;
			font-size: 20px;
			width: 320px;
        }		
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Lenox Financial Mortgage Corporation';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

// function my_login_stylesheet() {
    // wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css' );
    // wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/js/style-login.js' );
// }
// add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

/**
 * Remove unecessary menu in admin bar.
 *
 */ 
function annointed_admin_bar_remove() {
	global $wp_admin_bar, $wp_filter;
	
	/* Remove their stuff */
	$wp_admin_bar->remove_menu('wp-logo');
	
	/* Plugin: Simple Fields - Remove promotion meta box */
	//$ar = $wp_filter['simple_fields_options_print_nav_tabs'][10];
	// $ar);
	//remove_action('simple_fields_options_print_nav_tabs', key($ar));
}
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);

/**
 * Remove unecessary top level admin menu.
 * Docs: https://codex.wordpress.org/Function_Reference/remove_menu_page
 *
 */
function remove_menus() {  
	remove_menu_page( 'edit-comments.php' );          //Comments
}
add_action( 'admin_menu', 'remove_menus' );

/**
 * Remove unecessary meta boxes.
 *
 */
function remove_wp_post_metaboxes() {
	// remove_action( 'admin_notices', 'update_nag', 3 );
	remove_meta_box( 'commentstatusdiv','post','normal' ); // Comments Status Metabox
	remove_meta_box( 'formatdiv','post','normal' ); // Format Status Metabox
	remove_meta_box( 'postcustom','post','normal' ); // Custom Fields Metabox
	remove_meta_box( 'trackbacksdiv','post','normal' ); // Trackback Metabox
	
	if (! current_user_can( 'administrator' ) ) {
		//remove_meta_box( 'pageparentdiv','page','normal' ); // Parent/Template/Order Metabox
		
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'BraftonDashAtAGlance', 'dashboard', 'normal' );
		
		update_user_meta( get_current_user_id(), 'freesiaempire_dismissed_notice_freesiaempire', 1 );
	}	
	remove_meta_box( 'postcustom','page','normal' ); // Custom Fields Metabox
	remove_meta_box( 'commentsdiv','page','normal' ); // Comments Metabox
	remove_meta_box( 'commentstatusdiv','page','normal' ); // Comments Status Metabox
	remove_meta_box( 'trackbacksdiv','page','normal' ); // Trackback Metabox
}
add_action('admin_menu','remove_wp_post_metaboxes');

/**
 * Get custom field value with shortcode.
 *
 */
function shortcode_field($atts) {
    extract(shortcode_atts(array(
                  'post_id' => NULL,
               ), $atts));
	if(!isset($atts[0])) return;
	$field = esc_attr($atts[0]);
	global $post;
	$post_id = (NULL === $post_id) ? $post->ID : $post_id;
	return get_post_meta($post_id, $field, true);
}
add_shortcode('field', 'shortcode_field');

/**
 * Custom CSS for Banner
 *
 */
function lfm_banner_css() {
	$string = '<STYLE type="text/css">
<!--';
	$content = file_get_contents( '/css/banner.css', FILE_USE_INCLUDE_PATH );
	$string .= (trim($content))?$content:'';	
	$string .= '-->
</STYLE>';
	return $string;
}
// Add a shortcode
add_shortcode('bannercss', 'lfm_banner_css');

/**
 * Insert Tabs into content
 *
 */
function lfm_tabs() {
	ob_start();
	get_template_part('inc/content', 'tabs');
	$output = ob_get_clean();
	return $output;
}
// Add a shortcode
add_shortcode('tabs', 'lfm_tabs');

/**
 * Register our sidebars and widgetized areas.
 *
 */
/*function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Loan Officer sidebar',
		'id'            => 'loan_officer_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );*/

/**
 * Remove parent theme page templates from a child theme.
 *
 */
function my_remove_page_template( $pages_templates ) {
    unset( $pages_templates['page-templates/contact-template.php'] );
	unset( $pages_templates['page-templates/freesiaempire-corporate.php'] );
	unset( $pages_templates['page-templates/gallery-template.php'] );
	
    return $pages_templates;
}
add_filter( 'theme_page_templates', 'my_remove_page_template' );

/**
 * Adding Custom Meta Boxes.
 *
 */
function custom_meta_box_meta($object) {
    global $tracking_arr;
	wp_nonce_field(basename(__FILE__), "meta-box-nonce");
    ?>
        <div>
			<p><strong>Title</strong></p>
			<label class="screen-reader-text" for="meta-box-lfm-text_meta_title">Title</label>
			<input name="meta-box-lfm-text_meta_title" id="meta-box-lfm-text_meta_title" type="text" size="30" value="<?php echo get_post_meta($object->ID, "meta-box-lfm-text_meta_title", true); ?>" spellcheck="true" autocomplete="off" style="width: 100%;" placeholder="Enter the title here if you want to replace default page title">
			
			<p><strong>Keywords</strong></p>
			<label class="screen-reader-text" for="meta-box-lfm-text_meta_keywords">Keywords</label>
			<input name="meta-box-lfm-text_meta_keywords" id="meta-box-lfm-text_meta_keywords" type="text" size="100" value="<?php echo get_post_meta($object->ID, "meta-box-lfm-text_meta_keywords", true); ?>">
            
			<p><strong>Description</strong></p>
			<label class="screen-reader-text" for="meta-box-lfm-textarea_meta_description">Description</label>
			<textarea name="meta-box-lfm-textarea_meta_description" id="meta-box-lfm-textarea_meta_description" rows="4" cols="80" placeholder="Modify your meta description by editing it right here"><?php echo get_post_meta($object->ID, "meta-box-lfm-textarea_meta_description", true); ?></textarea>
            
			<p><strong>Robots</strong></p>
			<label class="screen-reader-text" for="meta-box-lfm-dropdown_robots">Robots</label>
            <select name="meta-box-lfm-dropdown_robots">
                <?php 
                    $option_values = array("", "NOINDEX, FOLLOW", "INDEX, NOFOLLOW", "NOINDEX, NOFOLLOW");
                    foreach($option_values as $key => $value) {
                        if($value == get_post_meta($object->ID, "meta-box-lfm-dropdown_robots", true))
                            echo '<option selected>' . $value . '</option>';
                        else
                            echo '<option>' . $value . '</option>';                     
                    }
                ?>
            </select>
			
			<p><strong>Page Phone #</strong></p>
			<label class="screen-reader-text" for="meta-box-lfm-text_meta_phone">Page Phone #</label>
			<input name="meta-box-lfm-text_meta_phone" id="meta-box-lfm-text_meta_phone" type="text" size="16" value="<?php echo get_post_meta($object->ID, "meta-box-lfm-text_meta_phone", true); ?>" spellcheck="true" autocomplete="off" style="width: 33%;" placeholder="xxx.xxx.xxxx">
			<p class="howto" id="set-post-meta-phone">Enter a phone number if you want to replace default & marketing toll free number</p>
			
            <p><strong>Include Tracking Code</strong></p>
            <label class="screen-reader-text">Include Tracking Code</label>
            <?php
				$checkbox_tracking = get_post_meta($object->ID, "meta-box-lfm-checkbox_tracking", true);
				$i=0;
				foreach($tracking_arr as $t_name => $t_val) {
					echo '<input id="meta-box-lfm-checkbox_tracking' . $i . '" name="meta-box-lfm-checkbox_tracking[]" type="checkbox" value="' . $t_name . '"' . ((is_array($checkbox_tracking) && in_array($t_name, $checkbox_tracking))?' checked':'') . '> <label for="meta-box-lfm-checkbox_tracking' . $i . '">' .  $t_name . ' (' . $t_val . ')</label><br>' ;
					$i++;
				}
            ?>
        </div>		
    <?php  
}

function custom_meta_box_banner($object) {
    ?>
        <div>
			<p><strong>Heading Text</strong></p>
			<label class="screen-reader-text" for="meta-box-lfm-text_banner_headingtext">Heading Text</label>
			<input name="meta-box-lfm-text_banner_headingtext" id="meta-box-lfm-text_banner_headingtext" type="text" size="30" value="<?php echo get_post_meta($object->ID, "meta-box-lfm-text_banner_headingtext", true); ?>" spellcheck="true" autocomplete="off" style="width: 100%;" placeholder="">
			
			<p><strong>Sub Heading Text</strong></p>
			<label class="screen-reader-text" for="meta-box-lfm-text_banner_subheadingtext">Sub Heading Text</label>
			<input name="meta-box-lfm-text_banner_subheadingtext" id="meta-box-lfm-text_banner_subheadingtext" type="text" size="30" value="<?php echo get_post_meta($object->ID, "meta-box-lfm-text_banner_subheadingtext", true); ?>" spellcheck="true" autocomplete="off" style="width: 100%;" placeholder="">
			
			<p><strong>Heading Link Text</strong></p>
			<label class="screen-reader-text" for="meta-box-lfm-text_banner_headinglinktext">Heading Link Text</label>
			<input name="meta-box-lfm-text_banner_headinglinktext" id="meta-box-lfm-text_banner_headinglinktext" type="text" size="100" value="<?php echo get_post_meta($object->ID, "meta-box-lfm-text_banner_headinglinktext", true); ?>" placeholder="">
			
			<p><strong>Heading Link URL</strong></p>
			<label class="screen-reader-text" for="meta-box-lfm-text_banner_headinglinkurl">Heading Link URL</label>
			<input name="meta-box-lfm-text_banner_headinglinkurl" id="meta-box-lfm-text_banner_headinglinkurl" type="text" size="100" value="<?php echo get_post_meta($object->ID, "meta-box-lfm-text_banner_headinglinkurl", true); ?>" placeholder="">
        </div>		
    <?php  
}

function custom_meta_box_tabs($object) { ?>
        <ul id="repeatable-fieldset-one" class="sortable ui-sortable">
		<?php
		$repeat_tabs = get_post_meta($object->ID, 'meta-box-lfm-repeat_tabs', true);
		$i=0;
		if ( $repeat_tabs ) :		
			foreach ( $repeat_tabs as $tab ) {?>
			<li class="field-group">
				<code class='field-group-handle hndle'> &#8597; </code>
				<a class="button remove-row" href="#">Remove</a>
				
				<p><strong>Tab Title</strong></p>
				<label class="screen-reader-text" for="meta-box-lfm-repeat_tab_title<?php echo $i;?>">Tab Title</label>
				<input type="text" class="widefat" id="meta-box-lfm-repeat_tab_title<?php echo $i;?>" name="meta-box-lfm-repeat_tab_title[]" value="<?php if($tab['title'] != '') echo esc_attr( $tab['title'] ); ?>" /><br>	
				
				<p><strong>Tab Content</strong></p>
				<label class="screen-reader-text" for="meta-box-lfm-repeat_tab_content<?php echo $i;?>">Tab Content</label>				
				<?php echo wp_editor( $tab['content'], 'meta-box-lfm-repeat_tab_content' . $i, array(																				
																				'textarea_name' => 'meta-box-lfm-repeat_tab_content[]',
																				'textarea_rows' => 10,
																			));?>
			</li>
		<?php 
				$i++;
			}
		/*else :
		// show a blank one
		?>
			<li class="field-group">
				<code class='field-group-handle hndle'> &#8597; </code>
				<a class="button remove-row" href="#">Remove</a>
				
				<p><strong>Tab Title1</strong></p>
				<label class="screen-reader-text" for="meta-box-lfm-repeat_tab_title">Tab Title1</label>
				<input type="text" class="widefat" name="meta-box-lfm-repeat_tab_title[]" /><br>
			
				<p><strong>Tab Content</strong></p>
				<label class="screen-reader-text" for="meta-box-lfm-repeat_tab_content">Tab Content</label>				
				<?php echo wp_editor( '', 'meta-box-lfm-repeat_tab_content[]', array(
																				'wpautop'       => true,
																				'textarea_name' => 'meta-box-lfm-repeat_tab_content[]',
																				'textarea_rows' => 10,
																			));?>
			</li>
		<?php */endif; ?>
			<!-- empty hidden one for jQuery -->
			<li class="empty-row screen-reader-text field-group">
				<code class='field-group-handle hndle'> &#8597; </code>
				<a class="button remove-row" href="#">Remove</a></td>
				
				<p><strong>New Tab Title</strong></p>
				<label class="screen-reader-text" for="meta-box-lfm-repeat_tab_title">New Tab Title</label>
				<input type="text" class="widefat" name="meta-box-lfm-repeat_tab_title[]" /><br>
			
				<p><strong>New Tab Content</strong></p>
				<label class="screen-reader-text" for="meta-box-lfm-repeat_tab_content">New Tab Content</label>				
				<?php echo wp_editor( '', 'meta-box-lfm-repeat_tab_content_new', array(
																				'textarea_name' => 'meta-box-lfm-repeat_tab_content[]',
																				'textarea_rows' => 10,
																			));?>
			</li>
		</ul>		
		<p><a id="add-row" class="button" href="#">+ Add New Tab</a></p>
		

		<?php /*<p><a class="button" href="#" id="add_content">+ Add New Tab</a></p>		
<script>
jQuery(document).ready(function(){	
	var startingContent = <?php echo --$i; ?>;
	jQuery( '#add_content' ).on('click', function() {	
		startingContent++;
		var contentID = 'meta-box-lfm-repeat_tab_content' + startingContent,
			contentRow = '<li class="field-group"><code class="field-group-handle hndle"> &#8597; </code><a class="button remove-row" href="#">Remove</a></td><p><strong>New Tab Title</strong></p><label class="screen-reader-text" for="meta-box-lfm-repeat_tab_title' + startingContent + '">New Tab Title</label><input type="text" class="widefat" name="meta-box-lfm-repeat_tab_title[]" /><br><p><strong>New Tab Content</strong></p><label class="screen-reader-text" for="' + contentID + '">New Tab Content</label><textarea name="meta-box-lfm-repeat_tab_content[]" id="' + contentID + '" rows="10"></textarea></li>';

		jQuery('#repeatable-fieldset-one').append(contentRow);
		//tinymce.init({ selector: '#' + contentID });
		tinymce.EditorManager.execCommand('mceAddEditor', false, contentID);
		tinymce.EditorManager.execCommand('mceAddControl', false, contentID);
		return false;
	});
});	
</script>*/
}

function custom_meta_box_shortcode($object) {
    global $shortcode_tags;
	echo '<dl>';
	ksort($shortcode_tags);
	foreach($shortcode_tags as $code => $desc) {
		if(substr($desc, 0, 3) == 'lfm') {
			echo '<dd>[' . $code . '] - </dd>';
			echo '<dt>' . str_replace('_', ' ', $desc) . '</dt>';	
		}
	}
	echo '</dl>';
}

function custom_meta_box_tollfreenumber($object) {
	global $wpdb;
	$result = $wpdb->get_results("SELECT * FROM lfm_tollfreenumbers;", ARRAY_A);
	?>
	<div>
		<label for="meta-box-lfm-text_tollfree_utmcode">Dropdown</label>
		<select id="meta-box-lfm-text_tollfree_utmcode" name="meta-box-lfm-text_tollfree_utmcode">
			echo '<option value=""></option>';
			<?php 
			foreach($result as $key => $value) {
				if($value['utm_code'] == get_post_meta($object->ID, "meta-box-dropdown", true)) {
					echo '<option selected value="' . $value['utm_code'] . '">[' . $value['utm_code'] . '] - ' . $value['title'] . ' : ' . $value['utm_code'] . '</option>';
				}
				else {
					echo '<option value="' . $value['utm_code'] . '">[' . $value['utm_code'] . '] - ' . $value['title'] . ' : ' . $value['utm_code'] . '</option>';
				}
			}
			?>
		</select>

		<br>

		<label for="meta-box-checkbox">Check Box</label>
		<?php
			$checkbox_value = get_post_meta($object->ID, "meta-box-checkbox", true);

			if($checkbox_value == "")
			{
				?>
					<input name="meta-box-checkbox" type="checkbox" value="true">
				<?php
			}
			else if($checkbox_value == "true")
			{
				?>  
					<input name="meta-box-checkbox" type="checkbox" value="true" checked>
				<?php
			}
		?>
	</div>
	<?php
}

function add_custom_meta_box() {
    add_meta_box("lfm-meta-box_meta", "Metadata", "custom_meta_box_meta", "", "normal", "high", null);
	add_meta_box("lfm-meta-box_banner", "Banner", "custom_meta_box_banner", "page", "normal", "high", null);
	add_meta_box("lfm-meta-box_tabs", "Tabs", "custom_meta_box_tabs", "page", "normal", "high", null);
	add_meta_box("lfm-meta-box_shortcode", "Shortcode", "custom_meta_box_shortcode", "", "side", "low", null);
	//add_meta_box("lfm-meta-box_tollfreenumber", "Tool Free Number", "custom_meta_box_tollfreenumber", "page", "normal", "high", null);
}
add_action("add_meta_boxes", "add_custom_meta_box");

function save_custom_meta_box($post_id, $post, $update) {
	
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $allowed_types = array("post", "page");
	if(!in_array($post->post_type, $allowed_types))	
        return $post_id;    
	
	// Put all tabs value in 1 vars
	$titles = $_POST['meta-box-lfm-repeat_tab_title'];
	$contents = $_POST['meta-box-lfm-repeat_tab_content'];
	for ( $i = 0; $i < sizeof($titles); $i++ ) {
		if ( $titles[$i] != '' ) :
			$new[$i]['title'] = stripslashes( strip_tags( $titles[$i] ) );			
			$new[$i]['content'] = $contents[$i];
		endif;
	}
	$_POST['meta-box-lfm-repeat_tabs'] = $new;
	unset($_POST['meta-box-lfm-repeat_tab_title']);
	unset($_POST['meta-box-lfm-repeat_tab_content']);
	
	// Set Empty val for checkboxes
	if(!isset($_POST['meta-box-lfm-checkbox_tracking']))
		$_POST['meta-box-lfm-checkbox_tracking'] = '';
	
	foreach($_POST as $id => $val) {
		if(substr($id, 0, 12) == 'meta-box-lfm' || substr($id, 0, 13) == 'freesiaempire') {			
			//update_post_meta($post_id, $id, $val);
			$old = get_post_meta($post_id, $id, true);			
			if ( !empty( $val ) && $val != $old ) {
				//echo 'update ' . $id . '<br>';
				update_post_meta( $post_id, $id, $val);
			}	
			elseif ( empty($val) && $old ) {
				//echo 'delete ' . $id . '<br>';
				delete_post_meta( $post_id, $id, $old);
			}
		}		
	}
	
	// Sync to other wordpress	
	// $wp_request_headers = array(
		// 'Authorization' => 'Basic ' . base64_encode( 'hyusuf:testing' )
	// );
	
	// $wp_request_body = array(
		// //'date'	=> $_POST[''] // The date the object was published, in the site's timezone.
		// //,'date_gmt'	=> $_POST[''] // The date the object was published, as GMT.
		// 'password'	=> $_POST['post_password'] // A password to protect access to the post.		
		// ,'status'	=> $_POST['post_status'] // A named status for the object. One of: publish, future, draft, pending, private
		// ,'title'	=> $_POST['post_title'] // The title for the object.
		// ,'content'	=> $_POST['content'] // The content for the object.
		// ,'author'	=> $_POST['post_author'] // The id for the author of the object.
		// ,'excerpt'	=> $_POST['excerpt'] // The excerpt for the object.
		// //,'featured_media'	=> $_POST[''] // The id of the featured media for the object.
		// ,'comment_status'	=> $_POST['comment_status'] // Whether or not comments are open on the object. One of: open, closed
		// ,'ping_status'	=> $_POST['ping_status'] // Whether or not the object can be pinged. One of: open, closed
		// ,'format'	=> ($_POST['post_format'] == 0)?'standard':$_POST['post_format'] // The format for the object. One of: standard, aside, chat, gallery, link, image, quote, status, video, audio
		// //,'sticky'	=> $_POST[''] // Whether or not the object should be treated as sticky.
		// ,'categories'	=> $_POST['post_category'] // The terms assigned to the object in the category taxonomy.
		// ,'tags'	=> $_POST['tax_input'] // The terms assigned to the object in the post_tag taxonomy.
		// ,'meta-box-lfm-text_meta_title'	=> $_POST['meta-box-lfm-text_meta_title']
		// ,'meta-box-lfm-text_meta_keywords'	=> $_POST['meta-box-lfm-text_meta_keywords']
		// ,'meta-box-lfm-textarea_meta_description'	=> $_POST['meta-box-lfm-textarea_meta_description']
		// ,'meta-box-lfm-dropdown_robots'	=> $_POST['meta-box-lfm-dropdown_robots']
	// );
	// if(trim($_POST['post_name']))
		// $wp_request_body['slug']	= $_POST['post_name']; // An alphanumeric identifier for the object unique to its type.
	
	// $wp_request_args = array(
		// 'method'    => 'POST',
		// 'headers'   => $wp_request_headers,
		// 'body'		=> $wp_request_body
		// );
	
	// //print_r($_POST);
	// //print_r($wp_request_args);
	
	// /* 
	// // GET
	// $wp_request_url = 'http://wpdev1.lenoxhq.lcl/wp-json/wp/v2/posts/498'; 
	// $response = wp_remote_get( $wp_request_url, $wp_request_args );
	// print_r(json_decode(wp_remote_retrieve_body($response)));*/
	
	// // POST
	// $json_post_type = $_POST['post_type'];
	// if($json_post_type == 'post')
		// $json_post_type = 'posts';
	// else if($json_post_type == 'page')
		// $json_post_type = 'pages';
	
	// $wp_request_url = 'http://wpdev1.lenoxhq.lcl/wp-json/wp/v2/' . $json_post_type; 
	// $response = wp_remote_get( $wp_request_url, $wp_request_args );
	// print_r($response);
	// //print_r(json_decode(wp_remote_retrieve_body($response)));
	
	// exit;
}
add_action("save_post", "save_custom_meta_box", 10, 3);


/**
 * Function to get attachment by post name.
 *
 */
if( ! ( function_exists( 'wp_get_attachment_by_post_name' ) ) ) {
    function wp_get_attachment_by_post_name( $post_name ) {
        $args = array(
            'post_per_page' => 1,
            'post_type'     => 'attachment',
            'name'          => trim ( $post_name ),
        );
        $get_posts = new Wp_Query( $args );		

        if ( isset($get_posts->posts[0]) ) {
			$get_posts->posts[0]->alt = get_post_meta($get_posts->posts[0]->ID, '_wp_attachment_image_alt', true);
			$small_image_url = wp_get_attachment_image_src($get_posts->posts[0]->ID, 'medium' );
			$get_posts->posts[0]->med = $small_image_url[0];
			$full_image_url = wp_get_attachment_image_src($get_posts->posts[0]->ID, 'full' );
			$get_posts->posts[0]->org = $full_image_url[0];
			return $get_posts->posts[0];
		}
        else
			return false;
    }
}

/**
 * Function to get an attachments caption / title / alt / description.
 *
 */
function wp_get_attachment( $attachment_id ) {
	$attachment = get_post( $attachment_id );
	if(isset($attachment->ID)) {
		return array(
			'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption' => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href' => get_permalink( $attachment->ID ),
			'src' => wp_get_attachment_url($attachment->ID),
			'title' => $attachment->post_title
		);
	}	
}

// Update CSS within in Admin
function admin_style_script() {
  wp_enqueue_style('admin-styles', get_stylesheet_directory_uri() . '/css/admin.css');
  wp_enqueue_script('admin-script', get_stylesheet_directory_uri() . '/js/admin.js');
}
add_action('admin_enqueue_scripts', 'admin_style_script');

/**
 * Replace title tag separator to '|'.
 *
 */
function lfm_document_title_separator( $sep ) {
    $sep = "|";
    return $sep;
}
add_filter( 'document_title_separator', 'lfm_document_title_separator' );

/**
 * Override default post/page title.
 *
*/
function lfm_override_post_title($title) {
	// change title for singular blog post
    $seo_title = trim(get_post_meta(get_the_ID (), "meta-box-lfm-text_meta_title", true));
	if( $seo_title ){ 
        // change title parts here
        $title['title'] = $seo_title; 
		//$title['page'] = '2'; // optional
		//$title['tagline'] = 'Home Of Genesis Themes'; // optional
    	//$title['site'] = 'DevelopersQ'; //optional
    }    
    return $title; 
}
add_filter('document_title_parts', 'lfm_override_post_title', 10);

/**
 * Filter posts by author in WordPress admin area.
 *
*/
function lfm_filter_by_the_author() {
	global $post_type;
	
	if ( ! current_user_can( 'edit_pages' ) || ! in_array($post_type, array('page')))
		return;
	
	$params = array(
		'name' => 'author', // this is the "name" attribute for filter <select>
		'show_option_all' => 'All authors' // label for all authors (display posts without filter)
	);
 
	if ( isset($_GET['user']) )
		$params['selected'] = $_GET['user']; // choose selected user by $_GET variable
 
	wp_dropdown_users( $params ); // print the ready author list
}
 
add_action('restrict_manage_posts', 'lfm_filter_by_the_author');

/**
 * Create sitemap.xml.
 *
*/
function eg_create_sitemap() {
  $postsForSitemap = get_posts(array(
    'numberposts' => -1,
    'orderby' => 'modified',
    'post_type'  => array('post','page', 'career'),
    'order'    => 'DESC'
  ));

  $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
  $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

  foreach($postsForSitemap as $post) {
    setup_postdata($post);

    $postdate = explode(" ", $post->post_modified);

    $sitemap .= '<url>'.
      '<loc>'. get_permalink($post->ID) .'</loc>'.
      '<lastmod>'. $postdate[0] .'</lastmod>'.
      '<changefreq>monthly</changefreq>'.
    '</url>';
  }

  $sitemap .= '</urlset>';

  $fp = fopen(ABSPATH . "sitemap.xml", 'w');
  fwrite($fp, $sitemap);
  fclose($fp);
}
add_action("publish_post", "eg_create_sitemap");
add_action("publish_page", "eg_create_sitemap");
add_action("publish_career", "eg_create_sitemap");

//add_filter( 'http_request_host_is_external', function() { return true; });

?>