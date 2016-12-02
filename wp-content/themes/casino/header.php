<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body>
 <div class="menu-wrap">
				<nav class="menu">
					<div class="icon-list">
						<?php wp_nav_menu( array(
                    'theme_location'  => 'main_menu',
                    'menu'            => '',
                    'container'       => 'div',
                    'container_class' => 'menu',
                    'container_id'    => '',
                    'menu_class'      => '',
                    'menu_id'         => 'nav',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '',
                    'link_after'      => '',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => ''
                ) ); ?>
					</div>
				</nav>
				<button class="close-button" id="close-button">Close Menu</button>
			</div>
			<button class="menu-button" id="open-button">Open Menu</button>
<div class="wrapper block-1 cbp-af-header">
             
    <div class="container cbp-af-inner">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="language">
                    <div id="sb-search" class="sb-search">
						<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input class="sb-search-input" placeholder="Enter your search term..." type="text" value="<?php echo get_search_query(); ?>" name="s" id="s">
							<input class="sb-search-submit" type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>">
							<span class="sb-icon-search"></span>
						</form>
					</div>
                    <?php
                    //do_action('wpml_add_language_selector');
                    //echo '<pre>';
                    $languages = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');
                    //echo '</pre>';
                    ?>
                    <ul>
                        <li><a href="<?php echo $languages['ru']['url']; ?>"><img src="<?php bloginfo('template_url') ?>/images/rus-flag.png" alt=""></a></li>
                        <li><a href="<?php echo $languages['en']['url']; ?>"><img src="<?php bloginfo('template_url') ?>/images/english-flag.png" alt="English version"></a></li>
                    </ul>
                </div>
                <div class="logo">
                    <a href="<?php $url = home_url( '/' ); echo $url;?>"><img src="<?php bloginfo('template_url') ?>/images/logo.png" alt="BitcoinsBand logo"></a>
                </div>
                <?php wp_nav_menu( array(
                    'theme_location'  => 'main_menu',
                    'menu'            => '',
                    'container'       => 'div',
                    'container_class' => 'menu',
                    'container_id'    => '',
                    'menu_class'      => '',
                    'menu_id'         => 'nav',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '',
                    'link_after'      => '',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => ''
                ) ); ?>
             
                
     
            </div>
        </div>
    </div>
</div>
<div class="wrapper block-header">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="header">
<!--<ins class="bmadblock-5667132ffe8f76610d1cf7b7" style="display:inline-block;width:728px;height:90px;"></ins>
<script async type="application/javascript" src="//ad.bitmedia.io/js/adbybm.js/5667132ffe8f76610d1cf7b7"></script>
                                    </div>-->
									<!--Start www.bitteaser.com code-->

<div id="teaser_1556"><a href="//bitteaser.com/">BitTeaser</a></div>
<script type="text/javascript">document.write('<scr'+'ipt type="text/jav'+'ascript" src="//bitteaser.com/show/?block_id=1556&r='+escape(document.referrer)+'&'+Math.round(Math.random()*100000)+'"></scr'+'ipt>');</script>

<!--End www.bitteaser.com code-->
			</div>
		</div>
	</div>
</div>