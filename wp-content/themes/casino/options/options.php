<?php
ICL_LANGUAGE_CODE;


add_action('admin_head', 'theme_options_register_head');
function theme_options_register_head()
{
    $script_url = get_template_directory_uri() . '/options/options.js';
	$style_url = get_template_directory_uri() . '/options/style.css';
	echo "<link rel='stylesheet' href='$style_url' />";
    echo "<script src='$script_url'></script>";
}

// Enque scripts for media uploader


//if(function_exists( 'wp_enqueue_media' )){
//    wp_enqueue_media();
//}else{
//    wp_enqueue_style('thickbox');
//    wp_enqueue_script('media-upload');
//    wp_enqueue_script('thickbox');
//}



add_action('wp_enqueue_scripts', 'fg_styles_enqueue');

function fg_styles_enqueue() {





    $script_url = TEMPLATEPATH . '/options/options.js';

    $style_url = TEMPLATEPATH . '/options/style.css';


    wp_enqueue_style('style.css',  $style_url);
/*
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
*/

    wp_enqueue_script('options.js', $script_url);

}

function adming_print_media_scripts() {
    if(function_exists( 'wp_enqueue_media' )){
        wp_enqueue_media();
    }else{
        wp_enqueue_style('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
    }
}

function en_theme_menu()
{
	$menu = add_menu_page( 'Theme settings',//The text to be displayed in the title tags of the page when the menu is selected
		'Theme settings',//The on-screen name text for the menu
		'manage_options',//The capability required for this menu to be displayed to the user. User levels are deprecated and should not be used here!
		'en_theme_options_page',//The slug name to refer to this menu by (should be unique for this menu). Prior to Version 3.0 this was called the file (or handle) parameter. If the function parameter is omitted, the menu_slug should be the PHP file that handles the display of the menu page content.
		'en_options_page'//The function that displays the page content for the menu page.
	//icon_url
	//position
	);
    add_action( 'admin_print_scripts-' . $menu, 'adming_print_media_scripts' );
}
add_action('admin_menu', 'en_theme_menu');

function en_options_page()
{
	?>
	<div class="section panel">
		<h1>Theme settings</h1>

		<form method="post" enctype="multipart/form-data" action="options.php">

			<?php
			settings_fields(ICL_LANGUAGE_CODE . '_theme_options'//A settings group name. This should match the group name used in register_setting().
			);

			do_settings_sections('en_theme_options_page'//The slug name of the page whose settings sections you want to output. This should match the page name used in add_settings_section().
			);
			?>
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>

		</form>


	</div>
<?php
}

add_action( 'admin_init', 'pu_register_settings' );

/**
 * Function to register the settings
 */
function pu_register_settings()
{
	// Register the settings with Validation callback
	register_setting( ICL_LANGUAGE_CODE . '_theme_options',//A settings group name. Must exist prior to the register_setting call. This must match the group name in settings_fields()
		ICL_LANGUAGE_CODE . '_theme_options',//The name of an option to sanitize and save.
		'en_validate_settings'//A callback function that sanitizes the option's value.
	);

	// Add settings section
	add_settings_section( ICL_LANGUAGE_CODE . '_options_section',//String for use in the 'id' attribute of tags.
		'Main section',//Title of the section.
		'en_display_section',//Function that fills the section with the desired content. The function should echo its output.
		'en_theme_options_page'//The menu page on which to display this section. Should match $menu_slug from Function Reference/add theme page
	);

        //                                          FIRST DIVIDER
	// Create textbox field
	$field_args = array(
		'type'      => 'text',
		'id'        => 'divider_1',
		'name'      => 'divider_1',
		'desc'      => 'First divider',
		'std'       => '',
		'label_for' => 'divider_1',
		'class'     => 'dividers'
	);

	add_settings_field( 'en_divider_1',//String for use in the 'id' attribute of tags.
		'First divider',//Title of the field.
		'en_display_setting',//Function that fills the field with the desired inputs as part of the larger form. Passed a single argument, the $args array. Name and id of the input should match the $id given to this function. The function should echo its output.
		'en_theme_options_page',//The menu page on which to display this field. Should match $menu_slug from add_theme_page()
		ICL_LANGUAGE_CODE . '_options_section',//The section of the settings page in which to show the box (default or a section you added with add_settings_section(), look at the page in the source to see what the existing ones are.)
		$field_args );

	

    $img_div_args_1 = array(
        'type'      => 'text',
        'id'        => 'divider_img_1',
        'name'      => 'divider_img_1',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'divider_img_1',
        'class'     => 'divider_imgs'
    );

    add_settings_field( 'divider_img_1',
        '1 divider image',
        'img_divider_1',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $img_div_args_1 );

    $ico_div_args_1 = array(
        'type'      => 'text',
        'id'        => 'divider_ico_1',
        'name'      => 'divider_ico_1',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'divider_ico_1',
        'class'     => 'divider_imgs'
    );

    add_settings_field( 'divider_ico_1',
        '1 divider icon',
        'ico_divider_1',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $ico_div_args_1 );
    //                                              SECOND DIVIDER

    $divider_2_text_args = array(
        'type'      => 'text',
        'id'        => 'divider_2',
        'name'      => 'divider_2',
        'desc'      => 'Second divider',
        'std'       => '',
        'label_for' => 'divider_2',
        'class'     => 'dividers'
    );

    add_settings_field( 'en_divider_2',
        'Second divider',
        'divider_text_display_2',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $divider_2_text_args );

    $img_div_args_2 = array(
        'type'      => 'text',
        'id'        => 'divider_img_2',
        'name'      => 'divider_img_2',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'divider_img_2',
        'class'     => 'divider_imgs'
    );

    add_settings_field( 'divider_img_2',
        '2 divider image',
        'img_divider_2',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $img_div_args_2 );

    $ico_div_args_2 = array(
        'type'      => 'text',
        'id'        => 'divider_ico_2',
        'name'      => 'divider_ico_2',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'divider_ico_2',
        'class'     => 'divider_imgs'
    );

    add_settings_field( 'divider_ico_2',
        '2 divider icon',
        'ico_divider_2',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $ico_div_args_2 );
    //                                  THIRD DIVIDER
    $divider_3_text_args = array(
        'type'      => 'text',
        'id'        => 'divider_3',
        'name'      => 'divider_3',
        'desc'      => 'Third divider',
        'std'       => '',
        'label_for' => 'divider_3',
        'class'     => 'dividers'
    );

    add_settings_field( 'en_divider_3',
        'Third divider',
        'divider_text_display_3',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $divider_3_text_args );

    $img_div_args_3 = array(
        'type'      => 'text',
        'id'        => 'divider_img_3',
        'name'      => 'divider_img_3',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'divider_img_3',
        'class'     => 'divider_imgs'
    );

    add_settings_field( 'divider_img_3',
        '3 divider image',
        'img_divider_3',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $img_div_args_3 );

    $ico_div_args_3 = array(
        'type'      => 'text',
        'id'        => 'divider_ico_3',
        'name'      => 'divider_ico_3',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'divider_ico_3',
        'class'     => 'divider_imgs'
    );

    add_settings_field( 'divider_ico_3',
        '3 divider icon',
        'ico_divider_3',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $ico_div_args_3 );

    //                                  FOURTH DIVIDER
    $divider_4_text_args = array(
        'type'      => 'text',
        'id'        => 'divider_4',
        'name'      => 'divider_4',
        'desc'      => 'Fourth divider',
        'std'       => '',
        'label_for' => 'divider_4',
        'class'     => 'dividers'
    );

    add_settings_field( 'en_divider_4',
        'Fourth divider',
        'divider_text_display_4',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $divider_4_text_args );

    $img_div_args_4 = array(
        'type'      => 'text',
        'id'        => 'divider_img_4',
        'name'      => 'divider_img_4',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'divider_img_4',
        'class'     => 'divider_imgs'
    );

    add_settings_field( 'divider_img_4',
        '4 divider image',
        'img_divider_4',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $img_div_args_4 );

    $ico_div_args_4 = array(
        'type'      => 'text',
        'id'        => 'divider_ico_4',
        'name'      => 'divider_ico_4',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'divider_ico_4',
        'class'     => 'divider_imgs'
    );

    add_settings_field( 'divider_ico_4',
        '4 divider icon',
        'ico_divider_4',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $ico_div_args_4 );

    //                                  FIFTH DIVIDER
    $divider_5_text_args = array(
        'type'      => 'text',
        'id'        => 'divider_5',
        'name'      => 'divider_5',
        'desc'      => 'Fifth divider',
        'std'       => '',
        'label_for' => 'divider_5',
        'class'     => 'dividers'
    );

    add_settings_field( 'en_divider_5',
        'Fifth divider',
        'divider_text_display_5',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $divider_5_text_args );

    $img_div_args_5 = array(
        'type'      => 'text',
        'id'        => 'divider_img_5',
        'name'      => 'divider_img_5',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'divider_img_5',
        'class'     => 'divider_imgs'
    );

    add_settings_field( 'divider_img_5',
        '5 divider image',
        'img_divider_5',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $img_div_args_5 );

    $ico_div_args_5 = array(
        'type'      => 'text',
        'id'        => 'divider_ico_5',
        'name'      => 'divider_ico_5',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'divider_ico_5',
        'class'     => 'divider_imgs'
    );

    add_settings_field( 'divider_ico_5',
        '5 divider icon',
        'ico_divider_5',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $ico_div_args_5 );

    //                                  SIXTH DIVIDER
    $divider_6_text_args = array(
        'type'      => 'text',
        'id'        => 'divider_6',
        'name'      => 'divider_6',
        'desc'      => 'Sixth divider',
        'std'       => '',
        'label_for' => 'divider_6',
        'class'     => 'dividers'
    );

    add_settings_field( 'en_divider_6',
        'Sixth divider',
        'divider_text_display_6',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $divider_6_text_args );

    $img_div_args_6 = array(
        'type'      => 'text',
        'id'        => 'divider_img_6',
        'name'      => 'divider_img_6',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'divider_img_6',
        'class'     => 'divider_imgs'
    );

    add_settings_field( 'divider_img_6',
        '6 divider image',
        'img_divider_6',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $img_div_args_6 );

    $ico_div_args_6 = array(
        'type'      => 'text',
        'id'        => 'divider_ico_6',
        'name'      => 'divider_ico_6',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'divider_ico_6',
        'class'     => 'divider_imgs'
    );

    add_settings_field( 'divider_ico_6',
        '6 divider icon',
        'ico_divider_6',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $ico_div_args_6 );

    //                              SOCIALS
    $facebook_args = array(
        'type'      => 'text',
        'id'        => 'facebook',
        'name'      => 'facebook',
        'desc'      => 'Facebook link',
        'std'       => '',
        'label_for' => 'facebook',
        'class'     => 'socials'
    );

    add_settings_field( 'facebook',//String for use in the 'id' attribute of tags.
        'Facebook link',//Title of the field.
        'facebook_link_callback',//Function that fills the field with the desired inputs as part of the larger form. Passed a single argument, the $args array. Name and id of the input should match the $id given to this function. The function should echo its output.
        'en_theme_options_page',//The menu page on which to display this field. Should match $menu_slug from add_theme_page()
        ICL_LANGUAGE_CODE . '_options_section',//The section of the settings page in which to show the box (default or a section you added with add_settings_section(), look at the page in the source to see what the existing ones are.)
        $facebook_args );

    $vk_args = array(
        'type'      => 'text',
        'id'        => 'vk',
        'name'      => 'vk',
        'desc'      => 'VK link',
        'std'       => '',
        'label_for' => 'vk',
        'class'     => 'socials'
    );

    add_settings_field( 'vk',//String for use in the 'id' attribute of tags.
        'VK link',//Title of the field.
        'vk_link_callback',//Function that fills the field with the desired inputs as part of the larger form. Passed a single argument, the $args array. Name and id of the input should match the $id given to this function. The function should echo its output.
        'en_theme_options_page',//The menu page on which to display this field. Should match $menu_slug from add_theme_page()
        ICL_LANGUAGE_CODE . '_options_section',//The section of the settings page in which to show the box (default or a section you added with add_settings_section(), look at the page in the source to see what the existing ones are.)
        $vk_args );

    $classm_args = array(
        'type'      => 'text',
        'id'        => 'classmates',
        'name'      => 'classmates',
        'desc'      => 'Classmates link',
        'std'       => '',
        'label_for' => 'classmates',
        'class'     => 'socials'
    );

    add_settings_field( 'classmates',//String for use in the 'id' attribute of tags.
        'Classmates link',//Title of the field.
        'classmates_link_callback',//Function that fills the field with the desired inputs as part of the larger form. Passed a single argument, the $args array. Name and id of the input should match the $id given to this function. The function should echo its output.
        'en_theme_options_page',//The menu page on which to display this field. Should match $menu_slug from add_theme_page()
        ICL_LANGUAGE_CODE . '_options_section',//The section of the settings page in which to show the box (default or a section you added with add_settings_section(), look at the page in the source to see what the existing ones are.)
        $classm_args );

    $twitter_args = array(
    'type'      => 'text',
    'id'        => 'twitter',
    'name'      => 'twitter',
    'desc'      => 'Twitter link',
    'std'       => '',
    'label_for' => 'twitter',
    'class'     => 'socials'
);

    add_settings_field( 'twitter',//String for use in the 'id' attribute of tags.
        'Twitter link',//Title of the field.
        'twitter_link_callback',//Function that fills the field with the desired inputs as part of the larger form. Passed a single argument, the $args array. Name and id of the input should match the $id given to this function. The function should echo its output.
        'en_theme_options_page',//The menu page on which to display this field. Should match $menu_slug from add_theme_page()
        ICL_LANGUAGE_CODE . '_options_section',//The section of the settings page in which to show the box (default or a section you added with add_settings_section(), look at the page in the source to see what the existing ones are.)
        $twitter_args );

    $mail_args = array(
        'type'      => 'text',
        'id'        => 'mail',
        'name'      => 'mail',
        'desc'      => 'Mail link',
        'std'       => '',
        'label_for' => 'mail',
        'class'     => 'socials'
    );

    add_settings_field( 'mail',//String for use in the 'id' attribute of tags.
        'Mail link',//Title of the field.
        'mail_link_callback',//Function that fills the field with the desired inputs as part of the larger form. Passed a single argument, the $args array. Name and id of the input should match the $id given to this function. The function should echo its output.
        'en_theme_options_page',//The menu page on which to display this field. Should match $menu_slug from add_theme_page()
        ICL_LANGUAGE_CODE . '_options_section',//The section of the settings page in which to show the box (default or a section you added with add_settings_section(), look at the page in the source to see what the existing ones are.)
        $mail_args );

    $copyr_args = array(
        'type'      => 'text',
        'id'        => 'copyright',
        'name'      => 'copyright',
        'desc'      => 'Copyright text',
        'std'       => '',
        'label_for' => 'copyright',
        'class'     => 'socials'
    );

    add_settings_field( 'copyright',//String for use in the 'id' attribute of tags.
        'Copyright text',//Title of the field.
        'copyright_callback',//Function that fills the field with the desired inputs as part of the larger form. Passed a single argument, the $args array. Name and id of the input should match the $id given to this function. The function should echo its output.
        'en_theme_options_page',//The menu page on which to display this field. Should match $menu_slug from add_theme_page()
        ICL_LANGUAGE_CODE . '_options_section',//The section of the settings page in which to show the box (default or a section you added with add_settings_section(), look at the page in the source to see what the existing ones are.)
        $copyr_args );

    $casptxt_args = array(
        'type'      => 'text',
        'id'        => 'casino-page-text',
        'name'      => 'casino-page-text',
        'desc'      => 'Casino page text',
        'std'       => '',
        'label_for' => 'casino-page-text',
        'class'     => 'casino-text'
    );

    add_settings_field( 'casino-page-text',//String for use in the 'id' attribute of tags.
        'Casino page text',//Title of the field.
        'casino_page_text_callback',//Function that fills the field with the desired inputs as part of the larger form. Passed a single argument, the $args array. Name and id of the input should match the $id given to this function. The function should echo its output.
        'en_theme_options_page',//The menu page on which to display this field. Should match $menu_slug from add_theme_page()
        ICL_LANGUAGE_CODE . '_options_section',//The section of the settings page in which to show the box (default or a section you added with add_settings_section(), look at the page in the source to see what the existing ones are.)
        $casptxt_args );

    $gamptxt_args = array(
        'type'      => 'text',
        'id'        => 'gambl-page-text',
        'name'      => 'gambl-page-text',
        'desc'      => 'Gamebling page text',
        'std'       => '',
        'label_for' => 'gambl-page-text',
        'class'     => 'gambl-text'
    );

    add_settings_field( 'gambl-page-text',//String for use in the 'id' attribute of tags.
        'Gamebling page text',//Title of the field.
        'gamebling_page_text_callback',//Function that fills the field with the desired inputs as part of the larger form. Passed a single argument, the $args array. Name and id of the input should match the $id given to this function. The function should echo its output.
        'en_theme_options_page',//The menu page on which to display this field. Should match $menu_slug from add_theme_page()
        ICL_LANGUAGE_CODE . '_options_section',//The section of the settings page in which to show the box (default or a section you added with add_settings_section(), look at the page in the source to see what the existing ones are.)
        $gamptxt_args );

    $teasptxt_args = array(
        'type'      => 'text',
        'id'        => 'teaser-page-text',
        'name'      => 'teaser-page-text',
        'desc'      => 'Teaser page text',
        'std'       => '',
        'label_for' => 'teaser-page-text',
        'class'     => 'teaser-text'
    );

    add_settings_field( 'teaser-page-text',//String for use in the 'id' attribute of tags.
        'Teaser page text',//Title of the field.
        'teaser_page_text_callback',//Function that fills the field with the desired inputs as part of the larger form. Passed a single argument, the $args array. Name and id of the input should match the $id given to this function. The function should echo its output.
        'en_theme_options_page',//The menu page on which to display this field. Should match $menu_slug from add_theme_page()
        ICL_LANGUAGE_CODE . '_options_section',//The section of the settings page in which to show the box (default or a section you added with add_settings_section(), look at the page in the source to see what the existing ones are.)
        $teasptxt_args );

    $tradptxt_args = array(
        'type'      => 'text',
        'id'        => 'trading-page-text',
        'name'      => 'trading-page-text',
        'desc'      => 'Trading page text',
        'std'       => '',
        'label_for' => 'trading-page-text',
        'class'     => 'trading-text'
    );

    add_settings_field( 'trading-page-text',//String for use in the 'id' attribute of tags.
        'Trading page text',//Title of the field.
        'trading_page_text_callback',//Function that fills the field with the desired inputs as part of the larger form. Passed a single argument, the $args array. Name and id of the input should match the $id given to this function. The function should echo its output.
        'en_theme_options_page',//The menu page on which to display this field. Should match $menu_slug from add_theme_page()
        ICL_LANGUAGE_CODE . '_options_section',//The section of the settings page in which to show the box (default or a section you added with add_settings_section(), look at the page in the source to see what the existing ones are.)
        $tradptxt_args );

    $img_bitcoin_network_args = array(
        'type'      => 'text',
        'id'        => 'bitcoinnetw_img',
        'name'      => 'bitcoinnetw_img',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'bitcoinnetw_img',
        'class'     => 'top_imgs'
    );

    add_settings_field( 'top_bitcoinnetw_img',
        'top bitcoin network img',
        'top_bitcoinnetwork_img_callback',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $img_bitcoin_network_args );

    $img_top_cas_args = array(
        'type'      => 'text',
        'id'        => 'top_casinos_img',
        'name'      => 'top_casinos_img',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'top_casinos_img',
        'class'     => 'top_imgs'
    );

    add_settings_field( 'top_casinos_img',
        'top casinos img',
        'top_casinos_img_callback',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $img_top_cas_args );

    $img_bit_exch_args = array(
        'type'      => 'text',
        'id'        => 'bitcoin_exchange_img',
        'name'      => 'bitcoin_exchange_img',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'bitcoin_exchange_img',
        'class'     => 'top_imgs'
    );

    add_settings_field( 'bitcoin_exchange_img',
        'top bitcoin exchange img',
        'top_bitexchange_img_callback',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $img_bit_exch_args );

    $img_bit_gambl_args = array(
        'type'      => 'text',
        'id'        => 'bitcoin_gambling_img',
        'name'      => 'bitcoin_gambling_img',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'bitcoin_gambling_img',
        'class'     => 'top_imgs'
    );

    add_settings_field( 'bitcoin_gambling_img',
        'top bitcoin gambling img',
        'top_bitgambling_img_callback',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $img_bit_gambl_args );

    $adv1_args = array(
        'type'      => 'text',
        'id'        => 'adv1_img',
        'name'      => 'adv1_img',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'adv1_img',
        'class'     => 'advert_imgs'
    );

    add_settings_field( 'adv1_img',
        'Advertising banner 1',
        'advertising_img_callback_1',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $adv1_args );

    $adv2_args = array(
        'type'      => 'text',
        'id'        => 'adv2_img',
        'name'      => 'adv2_img',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'adv2_img',
        'class'     => 'advert_imgs'
    );

    add_settings_field( 'adv2_img',
        'Advertising banner 2',
        'advertising_img_callback_2',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $adv2_args );

    $adv3_args = array(
        'type'      => 'text',
        'id'        => 'adv3_img',
        'name'      => 'adv3_img',
        'desc'      => '',
        'std'       => '',
        'label_for' => 'adv3_img',
        'class'     => 'advert_imgs'
    );

    add_settings_field( 'adv3_img',
        'Advertising banner 3',
        'advertising_img_callback_3',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $adv3_args );

    $adv1_text_args = array(
        'type'      => 'text',
        'id'        => 'adv1-text',
        'name'      => 'adv1-text',
        'desc'      => 'Advertising 1 page text',
        'std'       => '',
        'label_for' => 'adv1-text',
        'class'     => 'adver-text'
    );

    add_settings_field( 'adv1-text',
        'Advertising 1 text',
        'adv1_text_callback',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $adv1_text_args );

    $adv2_text_args = array(
        'type'      => 'text',
        'id'        => 'adv2-text',
        'name'      => 'adv2-text',
        'desc'      => 'Advertising 2 page text',
        'std'       => '',
        'label_for' => 'adv2-text',
        'class'     => 'adver-text'
    );

    add_settings_field( 'adv2-text',
        'Advertising 2 text',
        'adv2_text_callback',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $adv2_text_args );

    $adv3_text_args = array(
        'type'      => 'text',
        'id'        => 'adv3-text',
        'name'      => 'adv3-text',
        'desc'      => 'Advertising 3 page text',
        'std'       => '',
        'label_for' => 'adv3-text',
        'class'     => 'adver-text'
    );

    add_settings_field( 'adv3-text',
        'Advertising 3 text',
        'adv3_text_callback',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $adv3_text_args );

    $news1_text_args = array(
        'type'      => 'text',
        'id'        => 'news1-text',
        'name'      => 'news1-text',
        'desc'      => 'Text 1 news page',
        'std'       => '',
        'label_for' => 'news1-text',
        'class'     => 'news1-text'
    );

    add_settings_field( 'news1-text',
        'Text 1 news page',
        'text_news1_callback',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $news1_text_args );

    $news1_text_args = array(
        'type'      => 'text',
        'id'        => 'news2-text',
        'name'      => 'news2-text',
        'desc'      => 'Text 2 news page',
        'std'       => '',
        'label_for' => 'news2-text',
        'class'     => 'news2-text'
    );

    add_settings_field( 'news2-text',
        'Text 2 news page',
        'text_news2_callback',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $news1_text_args );

    $top_cas_link_args = array(
        'type'      => 'text',
        'id'        => 'top-cas-link-text',
        'name'      => 'cas-link-text',
        'desc'      => 'Top casino link',
        'std'       => '',
        'label_for' => 'top-cas-link-text',
        'class'     => 'top-cas-link-text'
    );

    add_settings_field( 'top-cas-link-text',
        'Top casino link',
        'top_cas_link_callback',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $top_cas_link_args );

    $top_exch_link_args = array(
        'type'      => 'text',
        'id'        => 'top-exch-link-text',
        'name'      => 'exch-link-text',
        'desc'      => 'Top exchange link',
        'std'       => '',
        'label_for' => 'top-exch-link-text',
        'class'     => 'top-exch-link-text'
    );

    add_settings_field( 'top-exch-link-text',
        'Top exchange link',
        'top_exch_link_callback',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $top_exch_link_args );

    $top_gambl_link_args = array(
        'type'      => 'text',
        'id'        => 'top-gambl-link-text',
        'name'      => 'gambl-link-text',
        'desc'      => 'Top gambling link',
        'std'       => '',
        'label_for' => 'top-gambl-link-text',
        'class'     => 'top-gambl-link-text'
    );

    add_settings_field( 'top-gambl-link-text',
        'Top gambling link',
        'top_gambl_link_callback',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $top_gambl_link_args );

    $top_ad_link_args = array(
        'type'      => 'text',
        'id'        => 'top-ad-link-text',
        'name'      => 'ad-link-text',
        'desc'      => 'Top ad networks link',
        'std'       => '',
        'label_for' => 'top-ad-link-text',
        'class'     => 'top-ad-link-text'
    );

    add_settings_field( 'top-ad-link-text',
        'Top ad networks link',
        'top_ad_link_callback',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $top_ad_link_args );

    $advertising_1_args = array(
        'type'      => 'text',
        'id'        => 'advertising1-link-text',
        'name'      => 'advertising1-link-text',
        'desc'      => '1 advertising link',
        'std'       => '',
        'label_for' => 'advertising1-link-text',
        'class'     => 'advertising1-link-text'
    );

    add_settings_field( 'advertising1-link-text',
        '1 advertising link',
        'advertising1_link_callback',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $advertising_1_args );

    $advertising_2_args = array(
        'type'      => 'text',
        'id'        => 'advertising2-link-text',
        'name'      => 'advertising2-link-text',
        'desc'      => '2 advertising link',
        'std'       => '',
        'label_for' => 'advertising2-link-text',
        'class'     => 'advertising2-link-text'
    );

    add_settings_field( 'advertising2-link-text',
        '2 advertising link',
        'advertising2_link_callback',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $advertising_2_args );

    $advertising_3_args = array(
        'type'      => 'text',
        'id'        => 'advertising3-link-text',
        'name'      => 'advertising3-link-text',
        'desc'      => '3 advertising link',
        'std'       => '',
        'label_for' => 'advertising3-link-text',
        'class'     => 'advertising3-link-text'
    );

    add_settings_field( 'advertising3-link-text',
        '3 advertising link',
        'advertising3_link_callback',
        'en_theme_options_page',
        ICL_LANGUAGE_CODE . '_options_section',
        $advertising_3_args );
}

function en_display_section($section){

}

function en_display_setting($args)
{
	extract( $args );
	$option_name = ICL_LANGUAGE_CODE . '_theme_options';

	$options = get_option( $option_name );

	switch ( $type ) {
		case 'text':
			$options[$id] = stripslashes($options[$id]);
			$options[$id] = esc_attr( $options[$id]);
			echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;
	}
}

function img_divider_1($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='divider_img_1_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="divider_img_upl_1">Загрузить</a>';
            echo "<img class='divider_img_1' src='$options[$id]' height='50' width='700'/>";
            break;
    }
}
function ico_divider_1($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='divider_ico_1_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="divider_ico_upl_1">Загрузить</a>';
            echo "<img class='divider_ico_1' src='$options[$id]' height='50' width='50'/>";
            break;
    }
}

/**
 *                                     SECOND DIVIDER
 */

function divider_text_display_2($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

function img_divider_2($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='divider_img_2_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="divider_img_upl_2">Загрузить</a>';
            echo "<img class='divider_img_2' src='$options[$id]' height='50' width='700'/>";
            break;
    }
}

function ico_divider_2($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='divider_ico_2_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="divider_ico_upl_2">Загрузить</a>';
            echo "<img class='divider_ico_2' src='$options[$id]' height='50' width='50'/>";
            break;
    }
}
/**
 *                                     THIRD DIVIDER
 */

function divider_text_display_3($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

function img_divider_3($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='divider_img_3_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="divider_img_upl_3">Загрузить</a>';
            echo "<img class='divider_img_3' src='$options[$id]' height='50' width='700'/>";
            break;
    }
}

function ico_divider_3($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='divider_ico_3_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="divider_ico_upl_3">Загрузить</a>';
            echo "<img class='divider_ico_3' src='$options[$id]' height='50' width='50'/>";
            break;
    }
}
/**
 *                                     FOURTH DIVIDER
 */

function divider_text_display_4($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

function img_divider_4($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='divider_img_4_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="divider_img_upl_4">Загрузить</a>';
            echo "<img class='divider_img_4' src='$options[$id]' height='50' width='700'/>";
            break;
    }
}

function ico_divider_4($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='divider_ico_4_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="divider_ico_upl_4">Загрузить</a>';
            echo "<img class='divider_ico_4' src='$options[$id]' height='50' width='50'/>";
            break;
    }
}
/**
 *                                     FIFTH DIVIDER
 */

function divider_text_display_5($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

function img_divider_5($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='divider_img_5_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="divider_img_upl_5">Загрузить</a>';
            echo "<img class='divider_img_5' src='$options[$id]' height='50' width='700'/>";
            break;
    }
}

function ico_divider_5($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='divider_ico_5_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="divider_ico_upl_5">Загрузить</a>';
            echo "<img class='divider_ico_5' src='$options[$id]' height='50' width='50'/>";
            break;
    }
}
/**
 *                                     SIXTH DIVIDER
 */

function divider_text_display_6($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

function img_divider_6($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='divider_img_6_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="divider_img_upl_6">Загрузить</a>';
            echo "<img class='divider_img_6' src='$options[$id]' height='50' width='700'/>";
            break;
    }
}

function ico_divider_6($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='divider_ico_6_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="divider_ico_upl_6">Загрузить</a>';
            echo "<img class='divider_ico_6' src='$options[$id]' height='50' width='50'/>";
            break;
    }
}


function facebook_link_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}
function vk_link_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}


function classmates_link_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}


function twitter_link_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}


function mail_link_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

function copyright_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

function casino_page_text_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}


function gamebling_page_text_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}


function teaser_page_text_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}


function trading_page_text_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}



function top_bitcoinnetwork_img_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='bitcoinnetw_img_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="bitcoinnetw_img_upl">Загрузить</a>';
            echo "<img class='bitcoinnetw_img' src='$options[$id]' height='70' width='277'/>";
            break;
    }
}



function top_casinos_img_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='top_cas_img_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="top_cas_img_upl">Загрузить</a>';
            echo "<img class='top_cas_img' src='$options[$id]' height='70' width='277'/>";
            break;
    }
}


function top_bitexchange_img_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='top_bitexch_img_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="top_bitexch_img_upl">Загрузить</a>';
            echo "<img class='top_bitexch_img' src='$options[$id]' height='70' width='277'/>";
            break;
    }
}


function top_bitgambling_img_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='top_bitgambl_img_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="top_bitgambl_img_upl">Загрузить</a>';
            echo "<img class='top_bitgambl_img' src='$options[$id]' height='70' width='277'/>";
            break;
    }
}

function advertising_img_callback_1($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='adv1_img_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br/><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="adv1_img_upl">Загрузить</a>';
            echo "<img class='adv1_img' src='$options[$id]' height='100' width='100'/>";
            break;
    }
}


function advertising_img_callback_2($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='adv2_img_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br/><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="adv2_img_upl">Загрузить</a>';
            echo "<img class='adv2_img' src='$options[$id]' height='100' width='100'/>";
            break;
    }
}


function advertising_img_callback_3($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='adv3_img_url regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br/><span class='description'>$desc</span>" : "";
            echo '<a href="#" class="adv3_img_upl">Загрузить</a>';
            echo "<img class='adv3_img' src='$options[$id]' height='100' width='100'/>";
            break;
    }
}

function adv1_text_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

function adv2_text_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}
function adv3_text_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

function text_news1_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

function text_news2_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

function top_cas_link_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

function top_exch_link_callback($args){
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

function top_gambl_link_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

function top_ad_link_callback($args) {
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

function advertising1_link_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

function advertising2_link_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}
function advertising3_link_callback($args)
{
    extract( $args );
    $option_name = ICL_LANGUAGE_CODE . '_theme_options';
    $options = get_option( $option_name );
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

function en_validate_settings($input)
{
	return $input;
	/**
	foreach($input as $k => $v)
	{
		$newinput[$k] = trim($v);

		// Check the input is a letter or a number
		if(!preg_match('/^[A-Z0-9 _]*$/i', $v)) {
			$newinput[$k] = '';
		}
	}

	return $newinput;
	 */
}