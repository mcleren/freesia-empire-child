<?php
/**
 * Template Name: Homepage Template
 *
 * Displays the home page template.
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
	<div id="main">
	<?php global $post;
	if( have_posts() ) {
		while( have_posts() ) {
			the_post(); ?>
		<div class="entry-content">
			<!-- CUSTOM FORM CONTENT STARTS -->
			<!-- Portfolio Widget ============================================= -->
<style>
.form-container {
  margin-top: 20px;
}
	
#slideout {
  background: #fff;
  box-shadow: 0 0 5px rgba(0,0,0,.3);
  color: #333;
  position: fixed;
  top: 100px;
  left: -520px;
  width: 500px;
  -webkit-transition-duration: 0.3s;
  -moz-transition-duration: 0.3s;
  -o-transition-duration: 0.3s;
  transition-duration: 0.3s;
}
#slideout form {
  display: block;
  padding: 20px;
}
#slideout textarea {
  display:block;
  height: 100px;
  margin-bottom: 6px;
  width: 250px;
}
#slideout.on {
  left: 0;
}		
</style>
<div class="form-container">
  <button type="button" id="testbutton" class="btn btn-default">Toggle</button>

  <div id="slideout">
    <form>
      <textarea class="form-control"></textarea>
      <input class="btn btn-primary" type="submit" value="Post feedback"></input>
    </form>
  </div>
</div>  
<script type="text/javascript">
<!--
jQuery('#testbutton').click(function(){
  jQuery('#slideout').toggleClass('on');
});
-->
</script>			
			<div>
			  <div><strong>Get a Quick Quote</strong> at no obligation</div>
			  <div id="quickquote-container clearfix">
			    <div class="four-column"><strong>I Am Looking To</strong> <span class="required">*</span><br>
			      <select name="loans">
			        <option>Purchase</option>
			        <option>Refinance</option>
			      </select>
			    </div>
			    <div class="four-column"><strong>State</strong> <span class="required">*</span><br>
			      <select name="states" required="">
			        <option>AL</option>
			        <option>CA</option>
			        <option>TX</option>
			      </select>
			    </div>
			    <div class="four-column">
				  <strong>Email Address</strong> <span class="required">*</span><br>
			      <input class="newsletter-email" required="" type="email" />
			    </div>
				<div class="four-column">
			      <span class="required">*Required</span><br />
			      <input type="button" value="Continue">
				</div>
			  </div>
              <div id="quickquote-container clearfix" class="portfolio-content">
			    <div class="four-column"><strong>I Am Looking To</strong> <span class="required">*</span><br>
			      <select name="loans">
			        <option>Purchase</option>
			        <option>Refinance</option>
			      </select>
			    </div>
			    <div class="four-column"><strong>State</strong> <span class="required">*</span><br>
			      <select name="states" required="">
			        <option>AL</option>
			        <option>CA</option>
			        <option>TX</option>
			      </select>
			    </div>
			    <div class="four-column">
				  <strong>Email Address</strong> <span class="required">*</span><br>
			      <input class="newsletter-email" required="" type="email" />
			    </div>
				<div class="four-column">
			      <span class="required">*Required</span><br />
			      <input type="button" value="Continue">
				</div>
			  </div>			  
			  <div style="clear:left"></div>
			</div>

<!--div class="container clearfix">
  <div class="column clearfix">
    <div class="two-column">
	  <article class="">
	    <div id="main-left">
		  <img width="768" height="580" src="http://demo.themefreesia.com/freesia-empire/wp-content/uploads/sites/6/2016/01/post-image-1.jpg" class="attachment-post-thumbnails size-post-thumbnails wp-post-image" alt="Purchase" title="Purchase" srcset="http://demo.themefreesia.com/freesia-empire/wp-content/uploads/sites/6/2016/01/post-image-1.jpg 768w, http://demo.themefreesia.com/freesia-empire/wp-content/uploads/sites/6/2016/01/post-image-1-300x227.jpg 300w" sizes="(max-width: 768px) 100vw, 768px">
		  <div>Purchase &gt;</div>
		</div>	    
	  </article>	
	</div>
	<div class="two-column">
	  <article class="">
	    <div id="main-right">
          <img width="768" height="580" src="http://demo.themefreesia.com/freesia-empire/wp-content/uploads/sites/6/2016/01/post-image-2.jpg" class="attachment-post-thumbnails size-post-thumbnails wp-post-image" alt="Refinance" title="Refinance" srcset="http://demo.themefreesia.com/freesia-empire/wp-content/uploads/sites/6/2016/01/post-image-2.jpg 768w, http://demo.themefreesia.com/freesia-empire/wp-content/uploads/sites/6/2016/01/post-image-2-300x227.jpg 300w" sizes="(max-width: 768px) 100vw, 768px">
        </div>
		<div>Refinance &gt;</div>
	  </article>	
	</div>	
  </div>	
<div-->			
			<!-- CUSTOM FORM CONTENT ENDS -->
			<?php the_content();
				wp_link_pages( array( 
				'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'freesia-empire' ),
				'after'             => '</div>',
				'link_before'       => '<span>',
				'link_after'        => '</span>',
				'pagelink'          => '%',
				'echo'              => 1
				) ); ?>
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