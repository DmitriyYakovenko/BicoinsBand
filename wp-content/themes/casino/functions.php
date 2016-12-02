<?php

add_action('admin_head', 'common_js_register_head');
function common_js_register_head()
{
    $script_url = get_template_directory_uri() . '/js/custom-admin.js';
    echo "<script src='$script_url'></script>";
}

require_once(TEMPLATEPATH . '/options/options.php');
add_theme_support( 'post-thumbnails' );
add_filter('widget_text', 'do_shortcode');
add_action( 'wp_enqueue_scripts', 'casino_styles_scripts' );
function casino_styles_scripts() {
    wp_enqueue_style( 'casino-fonts', get_template_directory_uri() . '/css/fonts.css' );
    wp_enqueue_style( 'casino-style', get_template_directory_uri() . '/css/style.css' );
    wp_enqueue_style( 'casino-media', get_template_directory_uri() . '/css/media.css' );
    wp_enqueue_style( 'casino-owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css' );
    wp_enqueue_style( 'casino-owl-theme', get_template_directory_uri() . '/css/owl.theme.css' );
    wp_enqueue_style( 'casino-owl-transitions', get_template_directory_uri() . '/css/owl.transitions.css' );
    wp_enqueue_style( 'casino-bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme.min.css' );
    wp_enqueue_style( 'casino-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'casino-set1', get_template_directory_uri() . '/css/set1.css' );

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'modernizr-js', get_template_directory_uri() . '/js/modernizr.custom.js' );
    wp_enqueue_script( 'classie-2', get_template_directory_uri() . '/js/classie-2.js' );
    wp_enqueue_script( 'uisearch-js', get_template_directory_uri() . '/js/uisearch.js' );
    wp_register_script( 'hitbtc', 'https://hitbtc.com/get_widget' );
    wp_enqueue_script( 'hitbtc' );
    wp_enqueue_script( 'casino-jquery-validate-js', get_template_directory_uri() . '/js/jquery.validate.min.js' );
    wp_enqueue_script( 'casino-owl-js', get_template_directory_uri() . '/js/owl.carousel.min.js' );
    wp_enqueue_script( 'casino-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js' );
    wp_enqueue_script( 'casino-npm-js', get_template_directory_uri() . '/js/npm.js' );
    wp_enqueue_script( 'casino-common-js', get_template_directory_uri() . '/js/common.js' );


}
add_action( 'after_setup_theme', 'register_main_menu' );
function register_main_menu() {
    register_nav_menu( 'main_menu', 'Place for main menu of theme' );
}

add_action( 'after_setup_theme', 'register_footer_menu' );
function register_footer_menu() {
    register_nav_menu( 'footer_menu', 'Place for footer menu of theme' );
}

function header_banner_widget_init() {

    register_sidebar( array(
        'name'          => 'header_banner',
        'id'            => 'header_banner_1',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => 'footer_banner',
        'id'            => 'footer_banner_1',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => 'first_price_ticker',
        'id'            => 'first_price_ticker',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => 'sec_price_ticker',
        'id'            => 'sec_price_ticker',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => 'third_price_ticker',
        'id'            => 'third_price_ticker',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => 'fourth_price_ticker',
        'id'            => 'fourth_price_ticker',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );

}
add_action( 'widgets_init', 'header_banner_widget_init' );


add_action( 'init', 'casino_post_types_init' );

function casino_post_types_init(){
register_post_type( 'main_page_slider',
    array(
        'labels' => array(
            'name' => 'Main Page Slider',
            'singular_name' => 'Main Page Slide',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Slide',
            'edit' => 'Edit',
            'edit_item' => 'Edit Slide',
            'new_item' => 'New Slide',
            'view' => 'View',
            'view_item' => 'View Slide',
            'search_items' => 'Search Slider',
            'not_found' => 'No Slides found',
            'not_found_in_trash' => 'No Movie Slides found in Trash',
            'parent' => 'Parent Slide'
        ),

        'public' => true,
        'menu_position' => 13,
        'supports' => array( 'title', 'excerpt', 'thumbnail', 'custom-fields' ),
        'taxonomies' => array( '' ),
        'menu_icon' => 'dashicons-images-alt2',
        'has_archive' => true
    )
);

register_post_type( 'casino',
    array(
        'labels' => array(
            'name' => 'Сasinos',
            'singular_name' => 'Casino',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Casino',
            'edit' => 'Edit',
            'edit_item' => 'Edit Casino',
            'new_item' => 'New Casino',
            'view' => 'View',
            'view_item' => 'View Casino',
            'search_items' => 'Search Casino',
            'not_found' => 'No Casinos found',
            'not_found_in_trash' => 'No Casinos found in Trash',
            'parent' => 'Parent Casino'
        ),

        'public' => true,
        'menu_position' => 14,
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
        'taxonomies' => array( '' ),
        'menu_icon' => 'dashicons-index-card',
        'has_archive' => true
    )
);



    register_post_type( 'gambling',
        array(
            'labels' => array(
                'name' => 'Gambling',
                'singular_name' => 'Gambling',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Gambling',
                'edit' => 'Edit',
                'edit_item' => 'Edit Gambling',
                'new_item' => 'New Gambling',
                'view' => 'View',
                'view_item' => 'View Gambling',
                'search_items' => 'Search Gambling',
                'not_found' => 'No Gambling found',
                'not_found_in_trash' => 'No Gambling found in Trash',
                'parent' => 'Parent Gambling'
            ),

            'public' => true,
            'menu_position' => 14,
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-tickets-alt',
            'has_archive' => true
        )
    );

    register_post_type( 'trading',
        array(
            'labels' => array(
                'name' => 'Trading',
                'singular_name' => 'Trading',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Trading',
                'edit' => 'Edit',
                'edit_item' => 'Edit Trading',
                'new_item' => 'New Trading',
                'view' => 'View',
                'view_item' => 'View Trading',
                'search_items' => 'Search Trading',
                'not_found' => 'No Trading found',
                'not_found_in_trash' => 'No Trading found in Trash',
                'parent' => 'Parent Trading'
            ),

            'public' => true,
            'menu_position' => 14,
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-cart',
            'has_archive' => true
        )
    );

    register_post_type( 'teaser',
        array(
            'labels' => array(
                'name' => 'Teaser',
                'singular_name' => 'Teaser',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Teaser',
                'edit' => 'Edit',
                'edit_item' => 'Edit Teaser',
                'new_item' => 'New Teaser',
                'view' => 'View',
                'view_item' => 'View Teaser',
                'search_items' => 'Search Teaser',
                'not_found' => 'No Teaser found',
                'not_found_in_trash' => 'No Teaser found in Trash',
                'parent' => 'Parent Teaser'
            ),

            'public' => true,
            'menu_position' => 14,
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-format-video',
            'has_archive' => true
        )
    );
    //this
    register_post_type( 'poker',
        array(
            'labels' => array(
                'name' => 'Poker',
                'singular_name' => 'Poker',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Poker',
                'edit' => 'Edit',
                'edit_item' => 'Edit Poker',
                'new_item' => 'New Poker',
                'view' => 'View',
                'view_item' => 'View Poker',
                'search_items' => 'Search Poker',
                'not_found' => 'No Poker found',
                'not_found_in_trash' => 'No Poker found in Trash',
                'parent' => 'Parent Poker'
            ),

            'public' => true,
            'menu_position' => 14,
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-smiley',
            'has_archive' => true
        )
    );
    register_post_type( 'dice',
        array(
            'labels' => array(
                'name' => 'Dice',
                'singular_name' => 'Dice',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Dice',
                'edit' => 'Edit',
                'edit_item' => 'Edit Dice',
                'new_item' => 'New Dice',
                'view' => 'View',
                'view_item' => 'View Dice',
                'search_items' => 'Search Dice',
                'not_found' => 'No Dice found',
                'not_found_in_trash' => 'No Dice found in Trash',
                'parent' => 'Parent Dice'
            ),

            'public' => true,
            'menu_position' => 14,
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-tablet',
            'has_archive' => true
        )
    );
    register_post_type( 'sportsbook',
        array(
            'labels' => array(
                'name' => 'Sportsbook',
                'singular_name' => 'Sportsbook',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Sportsbook',
                'edit' => 'Edit',
                'edit_item' => 'Edit Sportsbook',
                'new_item' => 'New Sportsbook',
                'view' => 'View',
                'view_item' => 'View Sportsbook',
                'search_items' => 'Search Sportsbook',
                'not_found' => 'No Sportsbook found',
                'not_found_in_trash' => 'No Sportsbook found in Trash',
                'parent' => 'Parent Sportsbook'
            ),

            'public' => true,
            'menu_position' => 14,
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-book',
            'has_archive' => true
        )
    );

    register_taxonomy(
        'casinos_categories',
        array('casino','teaser','trading','gambling'),
        array(
            'labels' => array(
                'name' => 'Categories',
                'add_new_item' => 'Add New Category',
                'new_item_name' => "New Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );

}

add_action( 'wp_enqueue_scripts', 'enqueue_form_scripts' );


function enqueue_form_scripts() {

//    wp_enqueue_script( 'ajaxformcustom', get_template_directory_uri() . '/js/ajax-form.js' );
    wp_localize_script( 'casino-common-js', 'sendform', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));
}

add_action( 'wp_ajax_nopriv_sendform_ajax', 'sendform_ajax' );
add_action( 'wp_ajax_sendform_ajax', 'sendform_ajax' );
function sendform_ajax() {

    if(isset($_REQUEST['advertising'])){
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $message = $_REQUEST['message'];
        $website = $_REQUEST['website'];
        $subject = $_REQUEST['subject'];

        $message = "Тема: Заявка с сайта casino!\nИмя: $name \nE-mail: $email\nСайт: $website\nТема: $subject\nТекст сообщения: $message";
        $headers = 'From: ' . 'admin@admin.com' . "\r\n";
        $to = "advertising@bitcoinsband.com";

        mail($to, $subject, $message, $headers);
        echo 'Thank you for request. We will contact you soon.';

    }
    else{
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $message = $_REQUEST['message'];
        $website = $_REQUEST['website'];
        $subject = $_REQUEST['subject'];

        $message = "Тема: Заявка с сайта casino!\nИмя: $name \nE-mail: $email\nСайт: $website\nТема: $subject\nТекст сообщения: $message";
        $headers = 'From: ' . 'admin@admin.com' . "\r\n";
        $to = "info@bitcoinsband.com";

        mail($to, $subject, $message, $headers);
        echo 'Thank you for request. We will contact you soon.';
    }
    
    die();
}


/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function casino_add_meta_box() {

    $screens = array( 'casino', 'gambling', 'trading', 'teaser','poker','sportsbook','dice');

    foreach ( $screens as $screen ) {
        add_meta_box(
            'casino_sectionid',
            'Casinos properties',
            'casino_meta_box_callback',
            $screen
        );
    }

     add_meta_box(
            'main_page_slider_id',
            'Main page slider',
            'main_page_slider_callback',
            'main_page_slider',
            'advanced',
            'high'
        );


}
add_action( 'add_meta_boxes', 'casino_add_meta_box' );


/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function main_page_slider_callback( $post ) {

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'casino_save_meta_box_data', 'myplugin_meta_box_nonce' );
    $slider_link=get_post_meta( $post->ID, 'slider_link', true );
    ?>
        <p>
            <label for="slider_link">Slide link</label>
            <input  type = "text" class = "widefat" name="slider_link" id="slider_link" value="<?php echo $slider_link;?>">
        </p>
    <?php
}



/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function casino_meta_box_callback( $post ) {

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'casino_save_meta_box_data', 'myplugin_meta_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $value = get_post_meta( $post->ID, '_my_meta_value_key', true );
    $main_image_inside_val = get_post_meta( $post->ID, 'main_image_inside', true );
    $casino_logo = get_post_meta( $post->ID, 'casino_logo', true );
    $casino_description = get_post_meta( $post->ID, 'casino_description', true );
    $casino_site = get_post_meta( $post->ID, 'casino_site', true );
    $casino_prov_fair = get_post_meta( $post->ID, 'casino_prov_fair', true );
    $casino_games = get_post_meta( $post->ID, 'casino_games', true );
    $casino_bonus = get_post_meta( $post->ID, 'casino_bonus', true );
    $casino_link = get_post_meta( $post->ID, 'casino_link', true );
    $table_divider = get_post_meta( $post->ID, 'table_divider', true );
    $casino_jackpot = get_post_meta( $post->ID, 'casino_jackpot', true );
    $casino_highroller = get_post_meta( $post->ID, 'casino_highroller', true );
    $mobile_v = get_post_meta( $post->ID, 'casino_mobilev', true );
    $live_dealers = get_post_meta( $post->ID, 'casino_livedealers', true );
    $poker_room = get_post_meta( $post->ID, 'casino_poker_room', true );
    $sportsbook = get_post_meta( $post->ID, 'casino_sportsbook', true );

    $top_post_img = get_post_meta( $post->ID, 'top_post_img', true );

    echo '<label for="myplugin_new_field">';
    echo 'Main text';
    echo '</label> ';
    echo '<input type="text" id="myplugin_new_field" name="myplugin_new_field" value="' . esc_attr( $value ) . '" size="25" /><br>';

    echo '<label for="upload_image">Main image</label>';
    echo '<input id="upload_image" type="text" size="36" name="upload_image" value="'.esc_attr($main_image_inside_val).'" />';
    echo '<input id="upload_image_button" type="button" value="Upload Image" /><br>';

    echo '<lable for="upload_casino_logo">Casino logo</lable>';
    echo '<input id="upload_casino_logo" type="text" size="36" name="upload_casino_logo" value="'.esc_attr($casino_logo).'" />';
    echo '<input id="upload_logo_button" type="button" value="Upload Logo" /><br>';

    echo '<lable for="casino_descr">Casino Description</lable>';
    echo '<textarea rows="3" cols="50" id="casino_descr" name="casino_descr">'.$casino_description.'</textarea><br>';

    echo '<label for="cas_site">';
    echo 'Casino site';
    echo '</label> ';
    echo '<input type="text" id="cas_site" name="cas_site" value="' . $casino_site . '" size="25" /><br>';
    if($casino_prov_fair == 'on') {
        echo '<input checked="checked" type="checkbox" name="prov_fair"/>Provably Fair<br>';
    }
    else {
        echo '<input type="checkbox" name="prov_fair"/>Provably Fair<br>';
    }
    echo '<label for="cas_games">';
    echo 'Casino games';
    echo '</label> ';
    echo '<input type="text" id="cas_games" name="cas_games" value="' . $casino_games . '" size="25" /><br>';

    echo '<label for="cas_bonus">';
    echo 'Casino bonus';
    echo '</label> ';
    echo '<input type="text" id="cas_bonus" name="cas_bonus" value="' . $casino_bonus . '" size="25" /><br>';

    echo '<label for="cas_link">';
    echo 'Casino link';
    echo '</label> ';
    echo '<input type="text" id="cas_link" name="cas_link" value="' . $casino_link . '" size="25" /><br>';

    echo '<lable for="table_divider_img">Table divider image</lable>';
    echo '<input id="table_divider_img" type="text" size="36" name="table_divider_img" value="'.$table_divider.'" />';
    echo '<input id="upload_divider_img" type="button" value="Upload Divider Img" /><br>';

    if($casino_jackpot == 'on') {
        echo '<input checked="checked" type="checkbox" name="jackpot"/>Jackpot<br>';
    }
    else {
        echo '<input type="checkbox" name="jackpot"/>Jackpot<br>';
    }

    if($casino_highroller == 'on') {
        echo '<input checked="checked" type="checkbox" name="highroller"/>High Roller<br>';
    }
    else {
        echo '<input type="checkbox" name="highroller"/>High Roller<br>';
    }

    if($mobile_v == 'on') {
        echo '<input checked="checked" type="checkbox" name="mobilev"/>Mobile Version<br>';
    }
    else {
        echo '<input type="checkbox" name="mobilev"/>Mobile Version<br>';
    }

    if($live_dealers == 'on') {
        echo '<input checked="checked" type="checkbox" name="live_dealers"/>Live Dealers<br>';
    }
    else {
        echo '<input type="checkbox" name="live_dealers"/>Live Dealers<br>';
    }

    if($poker_room == 'on') {
        echo '<input checked="checked" type="checkbox" name="poker_room"/>Poker Room<br>';
    }
    else {
        echo '<input type="checkbox" name="poker_room"/>Poker Room<br>';
    }
    if($sportsbook == 'on') {
        echo '<input checked="checked" type="checkbox" name="sportsbook"/>Sportsbook<br>';
    }
    else {
        echo '<input type="checkbox" name="sportsbook"/>Sportsbook<br>';
    }

    echo '<lable for="top_img">Top image</lable>';
    echo '<input id="top_img" type="text" size="36" name="top_img" value="'.$top_post_img.'" />';
    echo '<input id="upload_top_img" type="button" value="Upload Top Img" /><br>';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function casino_save_meta_box_data( $post_id ) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'casino_save_meta_box_data' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }
    if(isset( $_POST['slider_link'] )){
        update_post_meta( $post_id, 'slider_link', $_POST['slider_link'] );
    }

    /* OK, it's safe for us to save the data now. */

    // Make sure that it is set.
    if ( isset( $_POST['myplugin_new_field'] ) ) {
        $my_data = $_POST['myplugin_new_field'];
        $main_image = $_POST['upload_image'];
        $casino_logo_send = $_POST['upload_casino_logo'];
        $casino_descr_send = $_POST['casino_descr'];
        $casino_site_send = $_POST['cas_site'];
        $casino_prov_fair_send = $_POST['prov_fair'];
        $casino_games_send = $_POST['cas_games'];
        $casino_bonus_send = $_POST['cas_bonus'];
        $casino_link_send = $_POST['cas_link'];
        $table_divider_send = $_POST['table_divider_img'];
        $casino_jackpot_send = $_POST['jackpot'];
        $casino_highroller_send = $_POST['highroller'];
        $casino_mobilev_send = $_POST['mobilev'];
        $casino_livedealers_send = $_POST['live_dealers'];
        $casino_pokerromm_send = $_POST['poker_room'];
        $casino_sportsbook_send = $_POST['sportsbook'];
        $top_post_img_upload = $_POST['top_img'];

        // Update the meta field in the database.
        update_post_meta( $post_id, '_my_meta_value_key', $my_data );
        update_post_meta( $post_id, 'main_image_inside', $main_image );
        update_post_meta( $post_id, 'casino_logo', $casino_logo_send );
        update_post_meta( $post_id, 'casino_description', $casino_descr_send );
        update_post_meta( $post_id, 'casino_site', $casino_site_send );
        update_post_meta( $post_id, 'casino_prov_fair', $casino_prov_fair_send );
        update_post_meta( $post_id, 'casino_games', $casino_games_send );
        update_post_meta( $post_id, 'casino_bonus', $casino_bonus_send );
        update_post_meta( $post_id, 'casino_link', $casino_link_send );
        update_post_meta( $post_id, 'table_divider', $table_divider_send );
        update_post_meta( $post_id, 'casino_jackpot', $casino_jackpot_send );
        update_post_meta( $post_id, 'casino_highroller', $casino_highroller_send );
        update_post_meta( $post_id, 'casino_mobilev', $casino_mobilev_send );
        update_post_meta( $post_id, 'casino_livedealers', $casino_livedealers_send );
        update_post_meta( $post_id, 'casino_poker_room', $casino_pokerromm_send );
        update_post_meta( $post_id, 'casino_sportsbook', $casino_sportsbook_send );
        update_post_meta( $post_id, 'top_post_img', $top_post_img_upload );
    }
}
add_action( 'save_post', 'casino_save_meta_box_data' );

function custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


