<?php
/*
    Plugin Name: Bitcoin Ticker Widget
    Plugin URI: http://99bitcoins.com/bitcoin-ticker-widget-plugin/
    Description: Displays a ticker widget on your site of latest Bitcoin prices
    Author: Ofir Beigel
    Version: 2.0.4
    Author URI: ofir@99bitcoins.com
*/

DEFINE("BTW_API_URL","http://coinsapi.com/api/v1/");
DEFINE("BTW_API_URL_REGISTER","http://coinsapi.com/api/v1/index.php");
DEFINE("BTW_CACHE_DURATION",300); // 5 minutes, because API is regenerated every 5 minutes

register_activation_hook( __FILE__,  "btw_install" );

register_deactivation_hook( __FILE__ , "btw_uninstall" );

function btw_install(){

	wp_remote_post( BTW_API_URL_REGISTER, array(
		'method' => 'POST',
		'timeout' => 15,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking' => false,
		'body' => array( 'name' => get_bloginfo("name"), 'url' => get_bloginfo("url") , "action" => "activate" )
	    )
	);

	btw_update_data();
}

function btw_uninstall(){

	wp_remote_post( BTW_API_URL_REGISTER, array(
		'method' => 'POST',
		'timeout' => 15,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking' => false,
		'body' => array( 'name' => get_bloginfo("name"), 'url' => get_bloginfo("url") , "action" => "deactivate" )
	    )
	);
}

function btw_update_data(){

	$response = wp_remote_get( BTW_API_URL , array(
		"sslverify" => false,
		"timeout" => 10
	) );

	$btw_options = get_option("btw_options");

	$update_time = time();

	if( !$btw_options ) $btw_options = array();

	if( !$btw_options["data"] )
		$btw_options["data"] = array( 
			"chart" => array() , 
			"ticker" =>array( 
				'buy' => 0,
				'sell' => 0,
				'high' => 0,
				'low' => 0,
				'volume' => 0
			),
			'updated' => $update_time
		);

	if ( is_wp_error( $response ) ):

		$btw_options["data"]["updated"] = $update_time;

		update_option( "btw_options" , array(
			"last_updated" => $update_time,
			"data" => $btw_options["data"]
		) );
		
		return;

	endif;

	$json = json_decode( $response["body"] , true );

	if( isset( $json["error"] ) && $json["error"] == true ):

		$btw_options["data"]["updated"] = $update_time;

		update_option( "btw_options" , array(
			"last_updated" => $update_time,
			"data" => $btw_options["data"]
		) );
	else :

		$json["updated"] = $update_time;

		update_option( "btw_options" , array(
			"last_updated" => $update_time,
			"data" => $json
		) );

	endif;
}

function btw_get_options( $update = true){
	
	// Get BTC data
	$btw_options = get_option( "btw_options" );
	if( $update && ( !$btw_options || $btw_options["last_updated"] < time() - BTW_CACHE_DURATION ) ):
		btw_update_data();
		$btw_options = get_option( "btw_options" );
	endif;
	
	$data['btc'] = $btw_options['data']['BTC'];
	$data['lcw'] = $btw_options['data']['LTC'];

	return $data;
}

function btw_data(){	
	
	$btw_options = btw_get_options();

	btw_output_json( $btw_options );
	
}

add_action('wp_ajax_btw_data', 'btw_data');
add_action('wp_ajax_nopriv_btw_data', 'btw_data');

add_action('wp_ajax_lcw_data', 'btw_data');
add_action('wp_ajax_nopriv_lcw_data', 'btw_data');

function btw_output_json( $data ){

	header("Content-type:application/json");

	echo json_encode( $data );
	exit;

}
/**
 * Proper way to enqueue scripts and styles
 */
function bitcoin_scripts() {
	wp_enqueue_style( 'bitcoin-style',  plugin_dir_url(__FILE__) . 'css/style.css' );
        
	wp_enqueue_script( 'googleapi' , 'https://www.google.com/jsapi' );
	wp_enqueue_script( 'bitcoin-plugins', plugin_dir_url(__FILE__) . 'js/plugins.js', array('jquery'), '', false );
	wp_enqueue_script( 'bitcoin-script', plugin_dir_url(__FILE__) . 'js/script.js', array('jquery'), '', false );
	wp_enqueue_script( 'litecoin-script', plugin_dir_url(__FILE__) . 'js/script_litecoin.js', array('jquery'), '', false );
	wp_enqueue_script( 'bitcoin-drop-down', plugin_dir_url(__FILE__) . 'js/drop_down_script.js', array('jquery'), '', false );
	
	wp_localize_script( 'jquery', 'ajax_url', site_url() . '/wp-admin/admin-ajax.php' );
}

function bitcoin_admin_scripts() {
		wp_enqueue_style( 'bitcoin-style',  plugin_dir_url(__FILE__) . 'css/style.css' );

        if(!wp_script_is('jquery'))
            wp_enqueue_script( 'jquery');
}

add_action( 'wp_enqueue_scripts', 'bitcoin_scripts' );
add_action( 'admin_enqueue_scripts', 'bitcoin_admin_scripts' );

function bitcoin_head() {
	?>
	<script type='text/javascript'>var btw_ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>"; </script>
	<script type='text/javascript'>var lcw_ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>"; </script>
	
	<?php
}

add_action( 'wp_head', 'bitcoin_head' , 1 );

/**
 * Adds Bitcoin widget.
 */

global $btw_widget_index;

$btw_widget_index = 0;

class Bitcoin_Widget extends WP_Widget {
	public $bitcoin_error;
	//public $error_msg;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'bitcoin_widget', // Base ID
			'Bitcoin Widget', // Name
			array( 'description' => __( 'Bitcoin Price Widget', 'text_domain' ), ) // Args
		);
		
		$this->bitcoin_error = new WP_Error();
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
		$link = apply_filters( 'widget_title', $instance['link'] );
		echo $args['before_widget'];
		if (empty($instance)) {
			$instance['bitcoin'] = '1';
			$instance['litecoin'] = '1';
			$instance['btn_coins'] = 'BTC';
			//$instance['bitcoin_mtgox'] = '1';
			//$instance['bitcoin_btcchina'] = '1';
			$instance['bitcoin_btcavg'] = '1';
			$instance['bitcoin_btce'] = '1';
			$instance['bitcoin_bitstamp'] = '1';
			$instance['bitcoin_hitbtc'] = '1';
			$instance['litecoin_btce'] = '1';
			$instance['bitcoin_btn_ex'] = 'btce';
			$instance['buy'] = '1';
			$instance['sell'] = '1';
			$instance['high'] = '1';
			$instance['low'] = '1';
			$instance['volume'] = '1';
		}

		$bitcoin = (esc_attr($instance['bitcoin']) == '1') ? true : false;
		$litecoin = (esc_attr($instance['litecoin']) == '1') ? true : false;
		$btn_coins_default = (esc_attr($instance['btn_coins']) == 'litecoin') ? 'LTC' : 'BTC';
		if ((!$bitcoin && !$litecoin) || !$litecoin) {
			$btn_coins_default = 'BTC';
			$bitcoin = true;
		}
		
		//$mtgox = (esc_attr($instance['bitcoin_mtgox']) == '1') ? true : false;
		//$btcchina = (esc_attr($instance['bitcoin_btcchina']) == '1') ? true : false;
		$btcavg = (esc_attr($instance['bitcoin_btcavg']) == '1') ? true : false;
		$btce = (esc_attr($instance['bitcoin_btce']) == '1') ? true : false;
		$bitstamp = (esc_attr($instance['bitcoin_bitstamp']) == '1') ? true : false;
		$hitbtc = (esc_attr($instance['bitcoin_hitbtc']) == '1') ? true : false;
		$litecoin_btce = (esc_attr($instance['litecoin_btce']) == '1') ? true : false;
		
		$bitcoin_btn_ex = esc_attr($instance['bitcoin_btn_ex']);
		
				
		switch ($bitcoin_btn_ex) {
			/*case 'mtgox':
				$selected_bitcoin_ex = 'Mt. Gox';
				break;*/
			case 'btce':
				$selected_bitcoin_ex = 'BTC-E';
				break;
			case 'bitstamp':
				$selected_bitcoin_ex = 'BitStamp';
				break;
			case 'hitbtc':
				$selected_bitcoin_ex = 'HitBTC';
				break;
			/*case 'btcchina':
				$selected_bitcoin_ex = 'BTC China';
				break;*/
			case 'btcavg':
				$selected_bitcoin_ex = 'BTC Avg';
				break;
			default:
				$selected_bitcoin_ex = 'BTC-E';
				break;
		}
		
		$buy = (esc_attr($instance['buy']) == '1') ? true : false;
		$sell = (esc_attr($instance['sell']) == '1') ? true : false;
		$high = (esc_attr($instance['high']) == '1') ? true : false;
		$low = (esc_attr($instance['low']) == '1') ? true : false;
		$volume = (esc_attr($instance['volume']) == '1') ? true : false;
		
		$btw_data = btw_get_options( false );
		
		$btw_options = $btw_data['btc'];
		$lcw_options = $btw_data['lcw'];

		global $btw_widget_index;

		$btw_widget_index++;
		
		?>
<div id='bitcoin-widget-<?php echo $btw_widget_index; ?>'>
	<div id="bitcoin-widget" class='bitcoin-widget'>
        
        <div class="main_category">
        	<div class="category_label">Coin</div>
            <div class="category_value" id="widget_coin"><?php echo $btn_coins_default; ?></div>
            <div class="clear"></div>
            <div class="dropdown">
                <div class="bitcoin-tab-nav">
					<?php if ($bitcoin) { ?>
                    <a class="drop_options" href="javascript:void(0)" data-name="">BTC</a>
					<?php }
					if ($litecoin) { ?>
                    <a class="drop_options" href="javascript:void(0)" data-name="">LTC</a>
                    <div class="clear line"></div>
					<?php } ?>
                </div>
            </div>
        </div>
        
        <div id="btc_info" <?php if ($btn_coins_default == 'LTC') echo 'style="display:none;"'?>>
        
			<div class="main_category">
				<div class="category_label">Exchange</div>
				<div class="category_value widget_exchange"><?php echo $selected_bitcoin_ex; ?></div>
				<div class="clear"></div>
				<div class="dropdown">
					<div class="bitcoin-tab-nav">
						<?php 
						/*if ($mtgox) {
							$links_btc_tabs['Mt. Gox'] = '<a class="bitcoin-tab-link bitcoin-first-tab-link drop_options" href="javascript:void(0)" data-name="mtgox">Mt. Gox</a>';
						}*/
						if ($btce) {
							$links_btc_tabs['BTC-E'] = '<a class="bitcoin-tab-link bitcoin-last-tab-link drop_options" href="javascript:void(0)" data-name="btce">BTC-E</a>';
						} 
						if ($bitstamp) {
							$links_btc_tabs['BitStamp'] = '<a class="bitcoin-tab-link bitcoin-first-tab-link drop_options" href="javascript:void(0)" data-name="bitstamp">BitStamp</a>';
						}
						/*if ($btcchina) {
							$links_btc_tabs['BTC China'] = '<a class="bitcoin-tab-link bitcoin-last-tab-link drop_options" href="javascript:void(0)" data-name="btc-china">BTC China</a>';
						}*/
						if ($btcavg) {
							$links_btc_tabs['BTC Avg'] = '<a class="bitcoin-tab-link bitcoin-last-tab-link drop_options" href="javascript:void(0)" data-name="btc-avg">BTC Avg</a>';
						} 
						if ($hitbtc) {
							$links_btc_tabs['HitBTC'] = '<a class="bitcoin-tab-link bitcoin-last-tab-link drop_options" href="javascript:void(0)" data-name="btc-hitbtc">HitBTC</a>';
						} 
						
						if (isset($links_btc_tabs[$selected_bitcoin_ex])) {
							echo $links_btc_tabs[$selected_bitcoin_ex];
						}
						if (is_array($links_btc_tabs)) {
							foreach ($links_btc_tabs as $key => $val) {
								if ($key != $selected_bitcoin_ex) {
									echo $val;
								}
							}
						}
						?>
						<div class="clear line"></div>
					</div>
				</div>
			</div>
			
			<div class="bitcoin-widget-tabs">
			<?php 
			/*
			if ($mtgox) {
				$content_btc_tabs['Mt. Gox'] = '<div class="bitcoin-tab" id="bitcoin-tab-mtgox">
					<div class="bitcoin-tab-content" >
						<div class="main_category">
							<div class="category_label">Period</div>
							<div class="category_value widget_period"></div>
							<div class="clear"></div>
							
							<div class="dropdown">
								<div class="bitcoin-login-status">
								   <a href="javascript:void(0)" data-time="daily" class="active drop_options" >24h</a>
								   <a href="javascript:void(0)" data-time="weekly" class="drop_options">7d</a>
								   <a href="javascript:void(0)" data-time="monthly" class="drop_options">30d</a>
								   <div class="clear line"></div>
								</div>
							</div>
						</div>
						
						<div class="main_category currency">
							<div class="category_label">Currency</div>
							<div class="category_value"><span class="bitcoin-last-price">$</span></div>
							<div class="clear"></div>
						</div>
						
						<div class="graph_container">
							<div class="graph">
								<div class="show_graph">
									<div class="bitcoin-chart"></div>
                                    <div class="loading"><img src="'.plugin_dir_url(__FILE__) . 'image/loading.gif" /></div>
								</div>
							</div>
						</div>
						
						<div class="details">
							<div class="bitcoin-data">
								<ul>';
			if ($buy)
			$content_btc_tabs['Mt. Gox'] .= '<li>Buy  <span class="item_val">$'.number_format($btw_options["mtgox"]["ticker"]["buy"],2).'</span></li>';
			
			if ($sell)
			$content_btc_tabs['Mt. Gox'] .= '<li>Sell  <span class="item_val">$'.number_format($btw_options["mtgox"]["ticker"]["sell"],2).'</span></li>';
			
			if ($high)
			$content_btc_tabs['Mt. Gox'] .= '<li>High  <span class="item_val">$'.number_format($btw_options["mtgox"]["ticker"]["high"],2).'</span></li>';
			
			if ($low)
			$content_btc_tabs['Mt. Gox'] .= '<li>Low  <span class="item_val">$'.number_format($btw_options["mtgox"]["ticker"]["low"],2).'</span></li>';
			
			if ($volume)
			$content_btc_tabs['Mt. Gox'] .= '<li>Volume  <span class="item_val">'.number_format($btw_options["mtgox"]["ticker"]["volume"],0).' BTC</span></li>';
									
			$content_btc_tabs['Mt. Gox'] .= '</ul>
										</div>
									</div>
								</div>
							</div>';
			}
			*/
			if ($btce) {
				$content_btc_tabs['BTC-E'] = '<div class="bitcoin-tab" id="bitcoin-tab-btce">
					<div class="bitcoin-tab-content" >
						<div class="main_category">
							<div class="category_label">Period</div>
							<div class="category_value widget_period"></div>
							<div class="clear"></div>
							
							<div class="dropdown">
								<div class="bitcoin-login-status">
								   <a href="javascript:void(0)" data-time="daily" class="active drop_options" >24h</a>
								   <a href="javascript:void(0)" data-time="weekly" class="drop_options">7d</a>
								   <a href="javascript:void(0)" data-time="monthly" class="drop_options">30d</a>
								   <div class="clear line"></div>
								</div>
							</div>
						</div>
						
						<div class="main_category currency">
							<div class="category_label">Currency</div>
							<div class="category_value"><span class="bitcoin-last-price">$</span></div>
							<div class="clear"></div>
						</div>
						
						<div class="graph_container">
							<div class="graph">
								<div class="show_graph">
									<div class="bitcoin-chart"></div>
                                    <div class="loading"><img src="'.plugin_dir_url(__FILE__) . 'image/loading.gif" /></div>
								</div>
							</div>
						</div>
						<div class="details">
							<div class="bitcoin-data">
								<ul>';
			if ($buy)
			$content_btc_tabs['BTC-E'] .= '<li>Buy  <span class="item_val">$'.number_format($btw_options["btce"]["ticker"]["buy"],2).'</span></li>';
			
			if ($sell)
			$content_btc_tabs['BTC-E'] .= '<li>Sell  <span class="item_val">$'.number_format($btw_options["btce"]["ticker"]["sell"],2).'</span></li>';
			
			if ($high)
			$content_btc_tabs['BTC-E'] .= '<li>High  <span class="item_val">$'.number_format($btw_options["btce"]["ticker"]["high"],2).'</span></li>';
			
			if ($low)
			$content_btc_tabs['BTC-E'] .= '<li>Low  <span class="item_val">$'.number_format($btw_options["btce"]["ticker"]["low"],2).'</span></li>';
			
			if ($volume)
			$content_btc_tabs['BTC-E'] .= '<li>Volume  <span class="item_val">'.number_format($btw_options["btce"]["ticker"]["volume"],0).' BTC</span></li>';
									
			$content_btc_tabs['BTC-E'] .= '</ul>
										</div>
									</div>
								</div>
							</div>';
			} 
			if ($bitstamp) {
				$content_btc_tabs['BitStamp'] = '<div class="bitcoin-tab" id="bitcoin-tab-bitstamp">
					<div class="bitcoin-tab-content" >
					
						<div class="main_category">
							<div class="category_label">Period</div>
							<div class="category_value widget_period"></div>
							<div class="clear"></div>
							
							<div class="dropdown">
								<div class="bitcoin-login-status">
								   <a href="javascript:void(0)" data-time="daily" class="active drop_options" >24h</a>
								   <a href="javascript:void(0)" data-time="weekly" class="drop_options">7d</a>
								   <a href="javascript:void(0)" data-time="monthly" class="drop_options">30d</a>
								   <div class="clear line"></div>
								</div>
							</div>
						</div>
						
						<div class="main_category currency">
							<div class="category_label">Currency</div>
							<div class="category_value"><span class="bitcoin-last-price">$</span></div>
							<div class="clear"></div>
						</div>
						
						<div class="graph_container">
							<div class="graph">
								<div class="show_graph">
									<div class="bitcoin-chart"></div>
                                    <div class="loading"><img src="'.plugin_dir_url(__FILE__) . 'image/loading.gif" /></div>
								</div>
							</div>
						</div>
						<div class="details">
							<div class="bitcoin-data">
								<ul>';
			if ($buy)
			$content_btc_tabs['BitStamp'] .= '<li>Buy  <span class="item_val">$'.number_format($btw_options["bitstamp"]["ticker"]["buy"],2).'</span></li>';
			
			if ($sell)
			$content_btc_tabs['BitStamp'] .= '<li>Sell  <span class="item_val">$'.number_format($btw_options["bitstamp"]["ticker"]["sell"],2).'</span></li>';
			
			if ($high)
			$content_btc_tabs['BitStamp'] .= '<li>High  <span class="item_val">$'.number_format($btw_options["bitstamp"]["ticker"]["high"],2).'</span></li>';
			
			if ($low)
			$content_btc_tabs['BitStamp'] .= '<li>Low  <span class="item_val">$'.number_format($btw_options["bitstamp"]["ticker"]["low"],2).'</span></li>';
			
			if ($volume)
			$content_btc_tabs['BitStamp'] .= '<li>Volume  <span class="item_val">'.number_format($btw_options["bitstamp"]["ticker"]["volume"],0).' BTC</span></li>';
									
			$content_btc_tabs['BitStamp'] .= '</ul>
										</div>
									</div>
								</div>
							</div>';
			}
			/*if ($btcchina) {
				$content_btc_tabs['BTC China'] = '<div class="bitcoin-tab" id="bitcoin-tab-btc-china">
					<div class="bitcoin-tab-content" >
						<div class="main_category">
							<div class="category_label">Period</div>
							<div class="category_value widget_period"></div>
							<div class="clear"></div>
							
							<div class="dropdown">
								<div class="bitcoin-login-status">
								   <a href="javascript:void(0)" data-time="daily" class="active drop_options" >24h</a>
								   <a href="javascript:void(0)" data-time="weekly" class="drop_options">7d</a>
								   <a href="javascript:void(0)" data-time="monthly" class="drop_options">30d</a>
								   <div class="clear line"></div>
								</div>
							</div>
						</div>
						
						<div class="main_category currency">
							<div class="category_label">Currency</div>
							<div class="category_value"><span class="bitcoin-last-price">&yen;</span></div>
							<div class="clear"></div>
						</div>
						
						<div class="graph_container">
							<div class="graph">
								<div class="show_graph">
									<div class="bitcoin-chart"></div>
                                    <div class="loading"><img src="'.plugin_dir_url(__FILE__) . 'image/loading.gif" /></div>
								</div>
							</div>
						</div>
						<div class="details">
							<div class="bitcoin-data">
								<ul>';
			if ($buy)
			$content_btc_tabs['BTC China'] .= '<li>Buy  <span class="item_val">&yen; '.number_format($btw_options["btc-china"]["ticker"]["buy"],2).'</span></li>';
			
			if ($sell)
			$content_btc_tabs['BTC China'] .= '<li>Sell  <span class="item_val">&yen; '.number_format($btw_options["btc-china"]["ticker"]["sell"],2).'</span></li>';
			
			if ($high)
			$content_btc_tabs['BTC China'] .= '<li>High  <span class="item_val">&yen; '.number_format($btw_options["btc-china"]["ticker"]["high"],2).'</span></li>';
			
			if ($low)
			$content_btc_tabs['BTC China'] .= '<li>Low  <span class="item_val">&yen; '.number_format($btw_options["btc-china"]["ticker"]["low"],2).'</span></li>';
			
			if ($volume)
			$content_btc_tabs['BTC China'] .= '<li>Volume  <span class="item_val">'.number_format($btw_options["btc-china"]["ticker"]["volume"],0).' BTC</span></li>';
									
			$content_btc_tabs['BTC China'] .= '</ul>
										</div>
									</div>
								</div>
							</div>';
			}*/
			if ($btcavg) {
				$content_btc_tabs['BTC Avg'] = '<div class="bitcoin-tab" id="bitcoin-tab-btc-avg">
					<div class="bitcoin-tab-content" >
						<div class="main_category">
							<div class="category_label">Period</div>
							<div class="category_value widget_period"></div>
							<div class="clear"></div>
							
							<div class="dropdown">
								<div class="bitcoin-login-status">
								   <a href="javascript:void(0)" data-time="daily" class="active drop_options" >24h</a>
								   <a href="javascript:void(0)" data-time="weekly" class="drop_options">7d</a>
								   <a href="javascript:void(0)" data-time="monthly" class="drop_options">30d</a>
								   <div class="clear line"></div>
								</div>
							</div>
						</div>
						
						<div class="main_category currency">
							<div class="category_label">Currency</div>
							<div class="category_value"><span class="bitcoin-last-price">$</span></div>
							<div class="clear"></div>
						</div>
						
						<div class="graph_container">
							<div class="graph">
								<div class="show_graph">
									<div class="bitcoin-chart"></div>
                                    <div class="loading"><img src="'.plugin_dir_url(__FILE__) . 'image/loading.gif" /></div>
								</div>
							</div>
						</div>
						<div class="details">
							<div class="bitcoin-data">
								<ul>';
			if ($buy)
			$content_btc_tabs['BTC Avg'] .= '<li>Buy  <span class="item_val">$'.number_format($btw_options["btc-avg"]["ticker"]["buy"],2).'</span></li>';
			
			if ($sell)
			$content_btc_tabs['BTC Avg'] .= '<li>Sell  <span class="item_val">$'.number_format($btw_options["btc-avg"]["ticker"]["sell"],2).'</span></li>';
			
			if ($high)
			$content_btc_tabs['BTC Avg'] .= '<li>High  <span class="item_val">NA</span></li>';
			
			if ($low)
			$content_btc_tabs['BTC Avg'] .= '<li>Low  <span class="item_val">NA</span></li>';
			
			if ($volume)
			$content_btc_tabs['BTC Avg'] .= '<li>Volume  <span class="item_val">'.number_format($btw_options["btc-avg"]["ticker"]["volume"],0).' BTC</span></li>';
									
			$content_btc_tabs['BTC Avg'] .= '</ul>
										</div>
									</div>
								</div>
							</div>';
			}
				
			if ($hitbtc) {
				$content_btc_tabs['HitBTC'] = '<div class="bitcoin-tab" id="bitcoin-tab-btc-hitbtc">
					<div class="bitcoin-tab-content" >
					
						<div class="main_category">
							<div class="category_label">Period</div>
							<div class="category_value widget_period"></div>
							<div class="clear"></div>
							
							<div class="dropdown">
								<div class="bitcoin-login-status">
								   <a href="javascript:void(0)" data-time="daily" class="active drop_options" >24h</a>
								   <a href="javascript:void(0)" data-time="weekly" class="drop_options">7d</a>
								   <a href="javascript:void(0)" data-time="monthly" class="drop_options">30d</a>
								   <div class="clear line"></div>
								</div>
							</div>
						</div>
						
						<div class="main_category currency">
							<div class="category_label">Currency</div>
							<div class="category_value"><span class="bitcoin-last-price">$</span></div>
							<div class="clear"></div>
						</div>
						
						<div class="graph_container">
							<div class="graph">
								<div class="show_graph">
									<div class="bitcoin-chart"></div>
                                    <div class="loading"><img src="'.plugin_dir_url(__FILE__) . 'image/loading.gif" /></div>
								</div>
							</div>
						</div>
						<div class="details">
							<div class="bitcoin-data">
								<ul>';
			if ($buy)
			$content_btc_tabs['HitBTC'] .= '<li>Buy  <span class="item_val">$'.number_format($btw_options["btc-hitbtc"]["ticker"]["buy"],2).'</span></li>';
			
			if ($sell)
			$content_btc_tabs['HitBTC'] .= '<li>Sell  <span class="item_val">$'.number_format($btw_options["btc-hitbtc"]["ticker"]["sell"],2).'</span></li>';
			
			if ($high)
			$content_btc_tabs['HitBTC'] .= '<li>High  <span class="item_val">$'.number_format($btw_options["btc-hitbtc"]["ticker"]["high"],2).'</span></li>';
			
			if ($low)
			$content_btc_tabs['HitBTC'] .= '<li>Low  <span class="item_val">$'.number_format($btw_options["btc-hitbtc"]["ticker"]["low"],2).'</span></li>';
			
			if ($volume)
			$content_btc_tabs['HitBTC'] .= '<li>Volume  <span class="item_val">'.number_format($btw_options["btc-hitbtc"]["ticker"]["volume"],0).' BTC</span></li>';
									
			$content_btc_tabs['HitBTC'] .= '</ul>
										</div>
									</div>
								</div>
							</div>';
			}
			
						if (isset($content_btc_tabs[$selected_bitcoin_ex])) {
							echo $content_btc_tabs[$selected_bitcoin_ex];
						}
						if (is_array($content_btc_tabs)) {
							foreach ($content_btc_tabs as $key => $val) {
								if ($key != $selected_bitcoin_ex) {
									echo $val;
								}
							}
						}
			
			?>
				
				
			</div>	
		</div>
        
        <div id="ltc_info" <?php if ($btn_coins_default == 'BTC') echo 'style="display:none;"'?>>
			<div class="main_category">
				<div class="category_label">Exchange</div>
				<div class="category_value widget_exchange">BTC-E</div>
				<div class="clear"></div>
				<div class="dropdown">
					<div class="litecoin-tab-nav">
						<a class="litecoin-tab-link bitcoin-first-tab-link drop_options" href="javascript:void(0)" data-name="ltc-btce">BTC-E</a>
						<div class="clear line"></div>
					</div>
				</div>
			</div>
			
			<div class="bitcoin-widget-tabs">
				<div class="litecoin-tab" id="litecoin-tab-ltc-btce">
					<div class="bitcoin-tab-content">
						<div class="main_category">
							<div class="category_label">Period</div>
							<div class="category_value widget_period"></div>
							<div class="clear"></div>
							
							<div class="dropdown">
								<div class="litecoin-login-status">
								   <a href='javascript:void(0)' data-time='daily' class='active drop_options' >24h</a>
								   <a href='javascript:void(0)' data-time='weekly' class="drop_options">7d</a>
								   <a href='javascript:void(0)' data-time='monthly' class="drop_options">30d</a>
								   <div class="clear line"></div>
								</div>
							</div>
						</div>
						
						<div class="main_category currency">
							<div class="category_label">Currency</div>
							<div class="category_value"><span class="bitcoin-last-price">$</span></div>
							<div class="clear"></div>
						</div>
						
						<div class="graph_container">
							<div class="graph">
								<div class="show_graph">
									<div class="litecoin-chart"></div>
                                    <div class="loading"><img src="<?php echo plugin_dir_url(__FILE__) . 'image/';?>loading.gif" /></div>
								</div>
							</div>
						</div>
						<div class="details">
							<div class="litecoin-data">
								<ul>
									<li <?php if (!$buy) echo 'style="display:none;"';?>>Buy <span class="item_val">$<?php echo number_format($lcw_options["ltc-btce"]["ticker"]["buy"],2); ?></span></li>
									<li <?php if (!$sell) echo 'style="display:none;"';?>>Sell <span class="item_val">$<?php echo number_format($lcw_options["ltc-btce"]["ticker"]["sell"],2); ?></span></li>
									<li <?php if (!$high) echo 'style="display:none;"';?>>High <span class="item_val">$<?php echo number_format($lcw_options["ltc-btce"]["ticker"]["high"],2); ?></span></li>
									<li <?php if (!$low) echo 'style="display:none;"';?>>Low <span class="item_val">$<?php echo number_format($lcw_options["ltc-btce"]["ticker"]["low"],2); ?></span></li>
									<li <?php if (!$volume) echo 'style="display:none;"';?>>Volume <span class="item_val"><?php echo number_format($lcw_options["ltc-btce"]["ticker"]["volume"],0); ?> LTC</span></li>
								</ul>
							 </div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <input type="hidden" id="bitcoin-widget-<?php echo $btw_widget_index; ?>-buy" value="<?php if($buy) {echo '1';} else {echo '0';} ?>">
		<input type="hidden" id="bitcoin-widget-<?php echo $btw_widget_index; ?>-sell" value="<?php if($sell) {echo '1';} else {echo '0';} ?>">
		<input type="hidden" id="bitcoin-widget-<?php echo $btw_widget_index; ?>-high" value="<?php if($high) {echo '1';} else {echo '0';} ?>">
		<input type="hidden" id="bitcoin-widget-<?php echo $btw_widget_index; ?>-low" value="<?php if($low) {echo '1';} else {echo '0';} ?>">
		<input type="hidden" id="bitcoin-widget-<?php echo $btw_widget_index; ?>-volume" value="<?php if($volume) {echo '1';} else {echo '0';} ?>">
        <div class="bitcoin-link-row">
			<span class="bitcoin-last-updated">Last updated: <span class="bitcoin-timeago" >5 minutes ago</span></span>
		</div>
		<div class="powered_by_container">
            <a href="http://99bitcoins.com/" rel="nofollow" target="_blank"><div class="powered_by"></div></a>
        </div>
	</div>
</div>
			
			
            <script type='text/javascript' >
                jQuery(document).ready(function($){
					
                	var btw_data_bitcoin  = <?php echo json_encode( $btw_options ); ?>;
					var lwc_data_bitcoin  = <?php echo json_encode( $lcw_options ); ?>;

                	$("#bitcoin-widget-<?php echo $btw_widget_index; ?>").bitcoinWidget( btw_data_bitcoin );
					$("#bitcoin-widget-<?php echo $btw_widget_index; ?>").litecoinWidget( lwc_data_bitcoin );

                });
            </script>
			
                <?php
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
	
		//return;
						
		if( $instance) 
		{
			$bitcoin = esc_attr($instance['bitcoin']);
			$litecoin = esc_attr($instance['litecoin']);
			
			//$bitcoin_mtgox = esc_attr($instance['bitcoin_mtgox']);
			//$bitcoin_btcchina = esc_attr($instance['bitcoin_btcchina']);
			$bitcoin_btce = esc_attr($instance['bitcoin_btce']);
			$bitcoin_bitstamp = esc_attr($instance['bitcoin_bitstamp']);
			$bitcoin_btcavg = esc_attr($instance['bitcoin_btcavg']);
			$bitcoin_hitbtc = esc_attr($instance['bitcoin_hitbtc']);
			
			$litecoin_btce = esc_attr($instance['litecoin_btce']);
			
			$buy = esc_attr($instance['buy']);
			$sell = esc_attr($instance['sell']);
			$high = esc_attr($instance['high']);
			$low = esc_attr($instance['low']);
			$volume = esc_attr($instance['volume']);
			
			$btn_coins = esc_attr($instance['btn_coins']);
			
			$bitcoin_btn_ex = esc_attr($instance['bitcoin_btn_ex']);
			
			$litecoin_btn_ex = esc_attr($instance['litecoin_btn_ex']);
			
			//echo "bit coin value $bitcoin";

		}
		else
		{
			$bitcoin = '1';
			$litecoin = '1';
			
			//$bitcoin_mtgox = '1';
			//$bitcoin_btcchina = '1';
			$bitcoin_btce = '1';
			$bitcoin_bitstamp = '1';
			$bitcoin_hitbtc = '1';
			$bitcoin_btcavg = '1';
			
			$litecoin_btce = '1';
			
			$buy = '1';
			$sell = '1';
			$high = '1';
			$low = '1';
			$volume = '1';
			
			$btn_coins ='bitcoin';
			
			$bitcoin_btn_ex ='btce';
			
			$litecoin_btn_ex ='btce';
		}
	?>	
		<div>
			<h4 class="bt-tab-head">Coins in Ticker</h4>
			
			<table class="bt-table">
				<?php
				if($this->bitcoin_error->get_error_message('coins_ticker') !=='')
				{
				?>
				<tr>
					<td colspan="3" class="bitcoin_error"><?php echo $this->bitcoin_error->get_error_message('coins_ticker'); ?></td>
					
				</tr>
				<?php
				}
				if($this->bitcoin_error->get_error_message('coins_default_ticker') !=='')
				{
				?>
				<tr>
					<td colspan="3" class="bitcoin_error"><?php echo $this->bitcoin_error->get_error_message('coins_default_ticker'); ?></td>
					
				</tr>
				<?php
				}
				?>
				<tr>
					<td></td>
					<td>Show</td>
					<td>Default</td>
				</tr>
				<tr>
					<td>Bitcoin</td>
					
					<td><input type="checkbox" id="<?php echo $this->get_field_id('bitcoin'); ?>" name="<?php echo $this->get_field_name('bitcoin'); ?>"  <?php if($bitcoin=='1') echo "checked" ;?> value="1" /></td>
					
					<td><input type="radio"  name="<?php echo $this->get_field_name('btn_coins'); ?>"  <?php if($btn_coins!='' && $btn_coins=='bitcoin') echo "checked" ;?> value="<?php echo esc_attr( 'bitcoin'); ?>" class="coin_default" /></td>
				</tr>
				<tr>
					<td>Litecoin</td>
					
					<td><input type="checkbox"  id="<?php echo $this->get_field_id('litecoin'); ?>" name="<?php echo $this->get_field_name('litecoin'); ?>" <?php if($litecoin=='1') echo "checked" ;?> value="1"/></td>
					
					<td><input type="radio"  name="<?php echo $this->get_field_name('btn_coins'); ?>" value="<?php echo esc_attr( 'litecoin'); ?>" <?php if($btn_coins!='' && $btn_coins=='litecoin') echo "checked" ;?> /></td>
				</tr>
			</table>
			<h4 class="bt-tab-head">Bitcoin Exchanges</h4>
			<table class="bt-table">
			<?php
				if($this->bitcoin_error->get_error_message('exchange_ticker_bitcoin') !=='')
				{
				?>
				<tr>
					<td colspan="3" class="bitcoin_error"><?php echo $this->bitcoin_error->get_error_message('exchange_ticker_bitcoin'); ?></td>
					
				</tr>
				<?php
				}
				
				if($this->bitcoin_error->get_error_message('exchange_bitcoin_default') !=='')
				{
				?>
				<tr>
					<td colspan="3" class="bitcoin_error"><?php echo $this->bitcoin_error->get_error_message('exchange_bitcoin_default'); ?></td>
					
				</tr>
				<?php
				}
			
				?>
				<tr>
					<td></td>
					<td>Show</td>
					<td>Default</td>
				</tr>
				<!--<tr>
					<td>Mt Gox</td>
					
					<td><input type="checkbox" id="<?php //echo $this->get_field_id('bitcoin_mtgox'); ?>" name="<?php //echo $this->get_field_name('bitcoin_mtgox'); ?>" <?php //if($bitcoin_mtgox!='' && $bitcoin_mtgox=='1') echo "checked" ;?> value="1" /></td>
					
					<td><input type="radio" name="<?php //echo $this->get_field_name('bitcoin_btn_ex');?>" value="<?php //echo esc_attr( 'mtgox'); ?>"  <?php //if($bitcoin_btn_ex!='' && $bitcoin_btn_ex=='mtgox') echo "checked" ;?> /></td>
				</tr>-->
				<tr>
					<td>BTC-E</td>
					
					<td><input type="checkbox" id="<?php echo $this->get_field_id('bitcoin_btce'); ?>" name="<?php echo $this->get_field_name('bitcoin_btce'); ?>" <?php if($bitcoin_btce!='' && $bitcoin_btce=='1') echo "checked" ;?> value="1" /></td>
					
					<td><input type="radio" name="<?php echo $this->get_field_name('bitcoin_btn_ex');?>" value="<?php echo esc_attr( 'btce'); ?>" <?php if($bitcoin_btn_ex!='' && $bitcoin_btn_ex=='btce') echo "checked" ;?>  /></td>
				</tr>
				<tr>
					<td>BitStamp</td>
					
					<td><input type="checkbox" id="<?php echo $this->get_field_id('bitcoin_bitstamp'); ?>" name="<?php echo $this->get_field_name('bitcoin_bitstamp');?>" <?php if($bitcoin_bitstamp!='' && $bitcoin_bitstamp=='1') echo "checked" ;?> value="1"/></td>
					
					<td><input type="radio" name="<?php echo $this->get_field_name('bitcoin_btn_ex');?>" value="<?php echo esc_attr( 'bitstamp'); ?>" <?php if($bitcoin_btn_ex!='' && $bitcoin_btn_ex=='bitstamp') echo "checked" ;?> /></td>
				</tr>
				<!--<tr>
					<td>BTC China</td>
					
					<td><input type="checkbox"  id="<?php //echo $this->get_field_id('bitcoin_btcchina'); ?>" name="<?php //echo $this->get_field_name('bitcoin_btcchina'); ?>" <?php //if($bitcoin_btcchina!='' && $bitcoin_btcchina=='1') echo "checked" ;?> value="1"/></td>
					
					<td><input type="radio" name="<?php //echo $this->get_field_name('bitcoin_btn_ex');?>" value="<?php //echo esc_attr( 'btcchina'); ?>" <?php //if($bitcoin_btn_ex!='' && $bitcoin_btn_ex=='btcchina') echo "checked" ;?> /></td>
				</tr>-->
				<tr>
					<td>HitBTC</td>
					
					<td><input type="checkbox"  id="<?php echo $this->get_field_id('bitcoin_hitbtc'); ?>" name="<?php echo $this->get_field_name('bitcoin_hitbtc'); ?>" <?php if($bitcoin_hitbtc!='' && $bitcoin_hitbtc=='1') echo "checked" ;?> value="1"/></td>
					
					<td><input type="radio" name="<?php echo $this->get_field_name('bitcoin_btn_ex');?>" value="<?php echo esc_attr( 'hitbtc'); ?>" <?php if($bitcoin_btn_ex!='' && $bitcoin_btn_ex=='hitbtc') echo "checked" ;?> /></td>
				</tr>
				<tr>
					<td>BTC Avg</td>
					
					<td><input type="checkbox"  id="<?php echo $this->get_field_id('bitcoin_btcavg'); ?>" name="<?php echo $this->get_field_name('bitcoin_btcavg'); ?>" <?php if($bitcoin_btcavg!='' && $bitcoin_btcavg=='1') echo "checked" ;?> value="1"/></td>
					
					<td><input type="radio" name="<?php echo $this->get_field_name('bitcoin_btn_ex');?>" value="<?php echo esc_attr( 'btcavg'); ?>" <?php if($bitcoin_btn_ex!='' && $bitcoin_btn_ex=='btcavg') echo "checked" ;?> /></td>
				</tr>
				
			</table>
			
			<h4 class="bt-tab-head" >Litecoin Exchanges</h4>
			<table class="bt-table">
			<?php
				if($this->bitcoin_error->get_error_message('exchange_ticker_litecoin') !=='')
				{
				?>
				<tr>
					<td colspan="3" class="bitcoin_error"><?php echo $this->bitcoin_error->get_error_message('exchange_ticker_litecoin'); ?></td>
					
				</tr>
				<?php
				}
				if($this->bitcoin_error->get_error_message('exchange_litecoin_default') !=='')
				{
				?>
				<tr>
					<td colspan="3" class="bitcoin_error"><?php echo $this->bitcoin_error->get_error_message('exchange_litecoin_default'); ?></td>
					
				</tr>
				<?php
				}
				?>
			
				<tr>
					<td></td>
					<td>Show</td>
					<td>Default</td>
				</tr>
				
				<tr>
					<td>BTC-E</td>
					
					<td><input type="checkbox" id="<?php echo $this->get_field_id('litecoin_btce'); ?>" name="<?php echo $this->get_field_name('litecoin_btce'); ?>" checked disabled value="1"/></td>
					
					<td><input type="radio" name="<?php echo $this->get_field_name('litecoin_btn_ex');?>"  value="<?php echo esc_attr( 'btce'); ?>" checked  /></td>
				</tr>
			</table>
			
			<h4 class="bt-tab-head" >Data in Ticker</h4>
			<table class="bt-table">
			<?php
				if($this->bitcoin_error->get_error_message('data_ticker') !=='')
				{
				?>
				<tr>
					<td colspan="3" class="bitcoin_error"><?php echo $this->bitcoin_error->get_error_message('data_ticker'); ?></td>
					
				</tr>
				<?php
				}
				?>
				<tr>
					<td></td>
					<td>Show</td>
					<td></td>
				</tr>
				<tr>
					<td>Buy</td>
					<td><input type="checkbox" id="<?php echo $this->get_field_id('buy'); ?>" name="<?php echo $this->get_field_name('buy'); ?>" <?php if($buy!='' && $buy=='1') echo "checked" ;?> value="1" /></td>
					<td></td>
				</tr>
				<tr>
					<td>Sell</td>
					<td><input type="checkbox" id="<?php echo $this->get_field_id('sell'); ?>" name="<?php echo $this->get_field_name('sell'); ?>"  <?php if($sell!='' && $sell=='1') echo "checked" ;?> value="1" /></td>
					<td></td>
				</tr>
				<tr>
					<td>High</td>
					<td><input type="checkbox" id="<?php echo $this->get_field_id('high'); ?>" name="<?php echo $this->get_field_name('high'); ?>" <?php if($high!='' && $high=='1') echo "checked" ;?> value="1" /></td>
					<td></td>
				</tr>
				<tr>
					<td>Low</td>
					<td><input type="checkbox" id="<?php echo $this->get_field_id('low'); ?>" name="<?php echo $this->get_field_name('low'); ?>" <?php if($low!='' && $low=='1') echo "checked" ;?> value="1"/></td>
					<td></td>
				</tr>
				<tr>
					<td>Volume</td>
					<td><input type="checkbox" id="<?php echo $this->get_field_id('volume'); ?>" name="<?php echo $this->get_field_name('volume');?>" <?php if($volume!='' && $volume=='1') echo "checked" ;?> value="1" /></td>
					<td></td>
				</tr>
			</table>
			
		</div>
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
		
		$error_msg = array();
		$error_msg['choose_one']= 'Please select at least one option.';
		$error_msg['choose_default']= 'Default can only be selected from displayed options.';
		
		
		$instance['bitcoin'] = ( ! empty( $new_instance['bitcoin'] ) ) ? strip_tags( $new_instance['bitcoin'] ) : '';
		$instance['litecoin'] =( ! empty( $new_instance['litecoin'] ) ) ? strip_tags( $new_instance['litecoin'] ) : '';
		
		
		//$instance['bitcoin_mtgox'] = ( ! empty( $new_instance['bitcoin_mtgox'] ) ) ? strip_tags( $new_instance['bitcoin_mtgox'] ) : '';
		//$instance['bitcoin_btcchina'] = ( ! empty( $new_instance['bitcoin_btcchina'] ) ) ? strip_tags( $new_instance['bitcoin_btcchina'] ) : '';
		$instance['bitcoin_hitbtc'] = ( ! empty( $new_instance['bitcoin_hitbtc'] ) ) ? strip_tags( $new_instance['bitcoin_hitbtc'] ) : '';
		$instance['bitcoin_btcavg'] = ( ! empty( $new_instance['bitcoin_btcavg'] ) ) ? strip_tags( $new_instance['bitcoin_btcavg'] ) : '';
		$instance['bitcoin_btce'] = ( ! empty( $new_instance['bitcoin_btce'] ) ) ? strip_tags( $new_instance['bitcoin_btce'] ) : '';
		$instance['bitcoin_bitstamp'] = ( ! empty( $new_instance['bitcoin_bitstamp'] ) ) ? strip_tags( $new_instance['bitcoin_bitstamp'] ) : '';
		
		/*$instance['litecoin_btce'] = ( ! empty( $new_instance['litecoin_btce'] ) ) ? strip_tags( $new_instance['litecoin_btce'] ) : '';*/
		
		$instance['buy'] = ( ! empty( $new_instance['buy'] ) ) ? strip_tags( $new_instance['buy'] ) : '';
		$instance['sell'] = ( ! empty( $new_instance['sell'] ) ) ? strip_tags( $new_instance['sell'] ) : '';
		$instance['high'] = ( ! empty( $new_instance['high'] ) ) ? strip_tags( $new_instance['high'] ) : '';
		$instance['low'] = ( ! empty( $new_instance['low'] ) ) ? strip_tags( $new_instance['low'] ) : '';
		$instance['volume'] = ( ! empty( $new_instance['volume'] ) ) ? strip_tags( $new_instance['volume'] ) : '';
		
		$instance['btn_coins'] = ( ! empty( $new_instance['btn_coins'] ) ) ? strip_tags( $new_instance['btn_coins'] ) : '';
		
		
		$instance['bitcoin_btn_ex'] = ( ! empty( $new_instance['bitcoin_btn_ex'] ) ) ? strip_tags( $new_instance['bitcoin_btn_ex'] ) : '';
		
		/*$instance['litecoin_btn_ex'] = ( ! empty( $new_instance['litecoin_btn_ex'] ) ) ? strip_tags( $new_instance['litecoin_btn_ex'] ) : '';*/
		
		/* error msg for showing one checkbox checked   */
		
		if( !( $instance['bitcoin']=='1') && !($instance['litecoin']=='1'))
		{
			//$this->bitcoin_error->add('coins_ticker', __('Please choose one fields from Coin ticker tab'));
			$this->bitcoin_error->add('coins_ticker', $error_msg['choose_one']);
		}
		
		if( !( $instance['buy']=='1') && !($instance['sell']=='1') && !( $instance['high']=='1') && !($instance['low']=='1') && !($instance['volume']=='1'))
		{
			$this->bitcoin_error->add('data_ticker', $error_msg['choose_one']);
		}
		
		if( !($instance['bitcoin_hitbtc']=='1') && !( $instance['bitcoin_btce']=='1') && !($instance['bitcoin_bitstamp']=='1') && !($instance['bitcoin_btcavg']=='1'))
		{
			$this->bitcoin_error->add('exchange_ticker_bitcoin',$error_msg['choose_one']);
		}
		
		
		/*
		if( !( $instance['litecoin_btce']=='1'))
		{
			$this->bitcoin_error->add('exchange_ticker_litecoin',$error_msg['choose_one']);
		}
		*/
		/* default value validation */
		
		if( !( $instance['bitcoin']=='1') && ($instance['btn_coins']=='bitcoin'))
		{
			$this->bitcoin_error->add('coins_default_ticker', $error_msg['choose_default']);
		}
		
		if( !( $instance['litecoin']=='1') && ($instance['btn_coins']=='litecoin'))
		{
			$this->bitcoin_error->add('coins_default_ticker', $error_msg['choose_default']);
		}
		
		/*if( !( $instance['bitcoin_mtgox']=='1') && ($instance['bitcoin_btn_ex']=='mtgox'))
		{
			$this->bitcoin_error->add('exchange_bitcoin_default', $error_msg['choose_default']);
		}
		
		if( !( $instance['bitcoin_btcchina']=='1') && ($instance['bitcoin_btn_ex']=='btcchina'))
		{
			$this->bitcoin_error->add('exchange_bitcoin_default',$error_msg['choose_default']);
		}*/
		
		if( !( $instance['bitcoin_hitbtc']=='1') && ($instance['bitcoin_btn_ex']=='hitbtc'))
		{
			$this->bitcoin_error->add('exchange_bitcoin_default',$error_msg['choose_default']);
		}
		
		if( !( $instance['bitcoin_btcavg']=='1') && ($instance['bitcoin_btn_ex']=='btcavg'))
		{
			$this->bitcoin_error->add('exchange_bitcoin_default',$error_msg['choose_default']);
		}
		
		if( !( $instance['bitcoin_btce']=='1') && ($instance['bitcoin_btn_ex']=='btce'))
		{
			$this->bitcoin_error->add('exchange_bitcoin_default', $error_msg['choose_default']);
		}
		
		if( !( $instance['bitcoin_bitstamp']=='1') && ($instance['bitcoin_btn_ex']=='bitstamp'))
		{
			$this->bitcoin_error->add('exchange_bitcoin_default', $error_msg['choose_default']);
		}
		
		if( !( $instance['litecoin_btce']=='1') && ($instance['litecoin_btn_ex']=='btce'))
		{
			$this->bitcoin_error->add('exchange_litecoin_default',$error_msg['choose_default']);
		}
		
		return $instance;
	}

} // class Bitcoin_Widget

function register_bitcoin_widget(){
    register_widget( 'Bitcoin_Widget' );
}
add_action( 'widgets_init', 'register_bitcoin_widget');


function bitcoin_activate() {

    // Activation code here...
    if(!function_exists('curl_version')){
        deactivate_plugins(__FILE__);
        wp_die('This plugin requires PHP CURL module which is not enabled on your server. Please contact your server administrator');
    }
	
}
register_activation_hook( __FILE__, 'bitcoin_activate' );