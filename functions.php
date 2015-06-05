<?php
/**
 * Implement an optional custom header for Twenty Twelve
 *
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/**
 * Set up the WordPress core custom header arguments and settings.
 *
 * @uses add_theme_support() to register support for 3.4 and up.
 * @uses lgbtdetroit_header_style() to style front-end.
 * @uses lgbtdetroit_admin_header_style() to style wp-admin form.
 * @uses lgbtdetroit_admin_header_image() to add custom markup to wp-admin form.
 *
 * @since Twenty Twelve 1.0
 */

add_theme_support( 'post-thumbnails' ); 
add_theme_support( 'woocommerce' );

function enqueue_cdn_content() {
	wp_register_style('fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
	wp_enqueue_style('fontawesome');
}

add_action( 'wp_enqueue_scripts', 'enqueue_cdn_content' );

function lgbtdetroit_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '515151',
		'default-image'          => '',

		// Set height and width, with a maximum value for the width.
		'height'                 => 250,
		'width'                  => 960,
		'max-width'              => 2000,

		// Support flexible height and width.
		'flex-height'            => true,
		'flex-width'             => true,

		// Random image rotation off by default.
		'random-default'         => false,

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'lgbtdetroit_header_style',
		'admin-head-callback'    => 'lgbtdetroit_admin_header_style',
		'admin-preview-callback' => 'lgbtdetroit_admin_header_image',
	);

	add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'lgbtdetroit_custom_header_setup' );

/**
 * Style the header text displayed on the blog.
 *
 * get_header_textcolor() options: 515151 is default, hide text (returns 'blank'), or any hex value.
 *
 * @since Twenty Twelve 1.0
 */
function lgbtdetroit_header_style() {
	$text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	// If we get this far, we have custom styles.
	?>
	<style type="text/css" id="lgbtdetroit-header-css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text, use that.
		else :
	?>
		.site-header h1 a,
		.site-header h2 {
			color: #<?php echo $text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}

/**
 * Style the header image displayed on the Appearance > Header admin panel.
 *
 * @since Twenty Twelve 1.0
 */
function lgbtdetroit_admin_header_style() {
?>
	<style type="text/css" id="lgbtdetroit-admin-header-css">
	.appearance_page_custom-header #headimg {
		border: none;
		font-family: "Open Sans", Helvetica, Arial, sans-serif;
	}
	#headimg h1,
	#headimg h2 {
		line-height: 1.84615;
		margin: 0;
		padding: 0;
	}
	#headimg h1 {
		font-size: 26px;
	}
	#headimg h1 a {
		color: #515151;
		text-decoration: none;
	}
	#headimg h1 a:hover {
		color: #21759b !important; /* Has to override custom inline style. */
	}
	#headimg h2 {
		color: #757575;
		font-size: 13px;
		margin-bottom: 24px;
	}
	#headimg img {
		max-width: <?php echo get_theme_support( 'custom-header', 'max-width' ); ?>px;
	}
	</style>
<?php
}

/**
 * Output markup to be displayed on the Appearance > Header admin panel.
 *
 * This callback overrides the default markup displayed there.
 *
 * @since Twenty Twelve 1.0
 */
function lgbtdetroit_admin_header_image() {
	?>
	<div id="headimg">
		<?php
		if ( ! display_header_text() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 id="desc" class="displaying-header-text"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		<?php endif; ?>
	</div>



<?php }

/**
 * Register our sidebars and widgetized areas.
 *
 */
function lgbtdetroit_widgets_init() {

	register_sidebar( array(
		'name' => 'Footer',
		'id' => 'footer_widgets',
		'before_widget' => '<div class="col-md-3 footer-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => 'HTJ Footer',
		'id' => 'htj_footer_widgets',
		'before_widget' => '<div class="col-md-6 footer-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );


	register_sidebar( array(
		'name' => 'Home Sidebar',
		'id' => 'home_sidebar_widgets',
		'before_widget' => '<div class="%1$s home-sidebar-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="subheading">',
		'after_title' => '</h2><div class="arrow-down center-block"></div>',
	) );



	register_sidebar( array(
		'name' => 'Hotter Than July Sidebar',
		'id' => 'htj-sidebar-widgets',
		'before_widget' => '<div class="sidebar-module">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );



}



add_action( 'widgets_init', 'lgbtdetroit_widgets_init' );
 
add_filter('timber_context', 'add_to_context');
function add_to_context($data){             
    $data['menu'] = new TimberMenu('main-nav-menu');
    $data['htjmenu'] = new TimberMenu('Hotter Than July Nav'); 
    $data['ishome'] = is_home(); 
    $data['ispage'] = is_page();
    $data['issingle'] = is_single();     
    $data['issearch'] = is_search();   
    $data['iswoocommerce'] = is_woocommerce();     
    $data['home_id'] = get_option('page_on_front'); 
    return $data;
}


if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_staff-details',
		'title' => 'Staff Details',
		'fields' => array (
			array (
				'key' => 'field_5472d86d601bd',
				'label' => 'Photo',
				'name' => 'slide_image',
				'type' => 'image',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5472d882601be',
				'label' => 'Job title',
				'name' => 'job_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5472d889601bf',
				'label' => 'Bio',
				'name' => 'bio',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_5472d88f601c0',
				'label' => '',
				'name' => '',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'staff',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_layout',
		'title' => 'Layout',
		'fields' => array (
			array (
				'key' => 'field_546d43d8cd3ed',
				'label' => 'Select layout',
				'name' => 'layout',
				'type' => 'select',
				'instructions' => 'Choose the layout for this page.',
				'required' => 1,
				'choices' => array (
					'page-default' => 'Default',
					'partners' => 'Partners',
					'staff' => 'Staff',
					'donate' => 'Donate',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_partner-data',
		'title' => 'Partner data',
		'fields' => array (
			array (
				'key' => 'field_546d2a4be75d1',
				'label' => 'Partner tagline',
				'name' => 'partner_tagline',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_546d296333887',
				'label' => 'Partner link',
				'name' => 'partner_link',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_546d298533888',
				'label' => 'Partner Image',
				'name' => 'partner_image',
				'type' => 'image',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'partners',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_page-data',
		'title' => 'Page data',
		'fields' => array (
			array (
				'key' => 'field_5455b3828da7f',
				'label' => 'Slide image',
				'name' => 'slide_image',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5455832552eab',
				'label' => 'Slide video',
				'name' => 'slide_video',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5455833052eac',
				'label' => 'Slide link',
				'name' => 'slide_link',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5455833852ead',
				'label' => 'Slide link text',
				'name' => 'slide_link_text',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5455b3688da7e',
				'label' => 'Exclude from menu',
				'name' => 'exclude_from_menu',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'slide',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'htjslide',
					'order_no' => 0,
					'group_no' => 0,
				),
			),			
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}



  /**
* Step 1: Create link to the menu page.
*/
add_action('admin_menu', 'lgbtdetroit_create_menu');
function lgbtdetroit_create_menu() {

	//create nlgbtdetroit top-level menu
	add_menu_page(__('Theme Settings', 'lgbtdetroit'), __('Theme Options', 'lgbtdetroit'), 'administrator', 'lgbtdetroit-theme-settings', 'lgbtdetroit_settings_page', 'dashicons-megaphone');	
}

/**
* Step 2: Create settings fields.
*/
add_action( 'admin_init', 'register_lgbtdetroitsettings' );
function register_lgbtdetroitsettings() {
	register_setting( 'lgbtdetroit-settings-general', 'lgbtdetroit_analytics_code' );
	register_setting( 'lgbtdetroit-settings-general', 'htj_logo' );
	register_setting( 'lgbtdetroit-settings-general', 'lgbtalt_logo' );	
}

function enqueue_lgbtdetroit_scripts(){
	wp_enqueue_script('jquery');
 
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
 
        wp_enqueue_script('media-upload');
}

add_action('admin_init', 'enqueue_lgbtdetroit_scripts');

/** 
* Step 3: Create the markup for the options page
*/
function lgbtdetroit_settings_page() {

?>

<script language="JavaScript">
jQuery(document).ready(function() {
jQuery('.upload_img_btn').click(function() {
formfield = jQuery('.upload_img').attr('name');
tb_show('', 'media-upload.php?type=image&TB_iframe=true');
return false;
});

window.send_to_editor = function(html) {
imgurl = jQuery('img',html).attr('src');
jQuery('.upload_img').val(imgurl);
tb_remove();
}

});
</script>

<div class="wrap">
<h2><?php _e('Theme Settings', 'lgbtdetroit'); ?></h2>

<form method="post" action="options.php">
	
	<?php if(isset( $_GET['settings-updated'])) { ?>
	<div class="updated">
        <p><?php _e('Settings updated successfully', $textdomain); ?></p>
    </div>
	<?php } ?>

    <table class="form-table">

		<tr valign="top">
	<td>Select Hotter Than July Logo</td>
	<td><label for="htj_logo">
		<input class="upload_img" id="upload_image" type="text" size="36" name="htj_logo" value="<?php echo get_option('htj_logo'); ?>" />
		<input class="upload_img_btn" id="upload_image_button" type="button" value="Upload Image" />
		<br /><p class="description">Enter an URL or upload an image for Hotter Than July.</p>
		</label>
	</td>
</tr>


	<tr valign="top">
	<td>Select LGBT Detroit logo for Hotter Than July pages</td>
	<td><label for="lgbtalt_logo">
		<input class="upload_img" id="upload_image" type="text" size="36" name="lgbtalt_logo" value="<?php echo get_option('lgbtalt_logo'); ?>" />
		<input class="upload_img_btn" id="upload_image_button" type="button" value="Upload Image" />
		<br /><p class="description">Enter an alternate logo LGBT Detroit on Hotter Than July pages.</p>
		</label>
	</td>
</tr>
		
		<?php settings_fields( 'lgbtdetroit-settings-general' ); ?>
		<?php do_settings_sections( 'lgbtdetroit-settings-general' ); ?>
    </table>
    
    <?php submit_button(); ?>
</form>
</div>
<?php 
  
}


/**
 * Adds whats_up_Widget widget.
 */
class whats_up_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'whats_up_widget', // Base ID
			__( 'Widget Title', 'text_domain' ), // Name
			array( 'description' => __( 'Whats Up Sidebar Widget', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		$whatsupquery = new WP_Query('post_type=post');
		if ($whatsupquery->have_posts()) : 
			while ($whatsupquery->have_posts()) : $whatsupquery->the_post(); ?>
			<div class="whatsup item <?php if ($i == 0){echo "active";}  ?>">
              <h4 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>              
    	    </div>
        	<?php $i++; ?>
			<?php endwhile; ?>
		</div>			
	<?php else : ?>

		<h2>Nothing found </h2>

	<?php endif;
		echo '<div class="join-mlist"><h2 class="subheading">Stay in touch!</h2>';
		echo '<div class="arrow-down center-block"></div>';
		echo '<center><p>Us? Spam? Never. We don&#39;t share your info.</p><form name="ccoptin" action="http://visitor.constantcontact.com/d.jsp" target="_blank" method="post" style="margin-bottom:2;">';
		echo '<input type="hidden" name="m" value="1101779703343">';
		echo '<input type="hidden" name="p" value="oi">';
		echo '<input type="text" name="ea" size="20" value="Your eMail" style="font-size:10pt; border:1px solid #999999;">';
		echo '<button type="submit" name="go" value="" class="fa fa-envelope-o submit" style="font-family:Arial,Helvetica,sans-serif; font-size:10pt;">';
		echo '</form></center>';
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class whats_up_Widget


// register whats_up_Widget widget
function register_whats_up_widget() {
    register_widget( 'whats_up_Widget' );
}
add_action( 'widgets_init', 'register_whats_up_widget' );



 ?>
