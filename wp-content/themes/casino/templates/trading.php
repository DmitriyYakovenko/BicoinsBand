<?php
/**
 * Template name: Tradings list
 */
get_header();
?>

    <div class="wrapper casinos-page-2">
        <div class="container">
            <div class="row">
                <div class="col-xs-9">
                    <div class="casinos-content-full">
                        <div class="trading-content">
                            <?php
                            $options = get_option( ICL_LANGUAGE_CODE.'_theme_options' );
                            echo $options['trading-page-text'];
                            ?>

                        </div>

                        <div class="row pading">
                            <div class="col-xs-12 clear ">
                                <div class="table">
                                    <div class="name">
                                        <div class="col-xs-12 name-bg">
                                            <div class="col-xs-2"><h3><?php
                                                    if(ICL_LANGUAGE_CODE == 'ru') {
                                                        echo 'Название';
                                                    }
                                                    else {
                                                        echo 'Exchange';
                                                    }
                                                    ?></h3></div>
                                            <div class="col-xs-2"><h3><?php
                                                    if(ICL_LANGUAGE_CODE == 'ru') {
                                                        echo 'Сайт';
                                                    }
                                                    else {
                                                        echo 'Site';
                                                    }
                                                    ?></h3></div>
                                            <div class="col-xs-2"><h3><?php
                                                    if(ICL_LANGUAGE_CODE == 'ru') {
                                                        echo 'Страна';
                                                    }
                                                    else {
                                                        echo 'Country';
                                                    }
                                                    ?></h3></div>
                                            <div class="col-xs-2"><h3><?php
                                                    if(ICL_LANGUAGE_CODE == 'ru') {
                                                        echo 'Валюты';
                                                    }
                                                    else {
                                                        echo '#Markets';
                                                    }
                                                    ?></h3></div>
                                            <div class="col-xs-2"><h3><?php
                                                    if(ICL_LANGUAGE_CODE == 'ru') {
                                                        echo '24 часа';
                                                    }
                                                    else {
                                                        echo '24h vol';
                                                    }
                                                    ?></h3></div>
                                            <div class="col-xs-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $query = null;
                            $query = new WP_Query( array( 'post_type' => 'trading',
                                'posts_per_page' => '200') );
                            if($query->have_posts()) {
                                while($query->have_posts()) {
                                    $query->the_post();
                                    ?>
                                    <div class="col-xs-12 site-con">
                                        <div class="col-xs-2 clear name"><img width="120" height="50" src="<?php
                                            echo get_post_meta( get_the_ID(), 'casino_logo', true );
                                            ?>" alt="Bitcoin exchange site logo"> <a href="<?php the_permalink(); ?>"><?php
                                                if(ICL_LANGUAGE_CODE == 'ru') {
                                                    echo 'Подробная статистика';
                                                }
                                                else {
                                                    echo 'View Markets';
                                                }
                                                ?></a></div>
                                        <div class="col-xs-2 clear site"><a href="<?php
                                            echo get_post_meta( get_the_ID(), 'casino_link', true );
                                            ?>"><?php
                                                echo get_post_meta( get_the_ID(), 'casino_site', true );
                                                ?></a></div>
                                        <div class="col-xs-2 clear fair">
                                            <?php
                                            $check = get_post_meta(get_the_ID(), 'casino_prov_fair',true);
                                            if($check == '') {
                                                echo '<img class="alignnone size-full wp-image-125" src="http://bitcoinsband.com/wp-content/uploads/2015/11/United States Flag Icon.png" alt="Country" width="39" height="43" />';
                                            }
                                            else
                                            {
                                                echo '<img class="alignnone size-full wp-image-127" src="http://bitcoinsband.com/wp-content/uploads/2015/11/United Kingdom Flag icon.png" alt="Country" width="53" height="41">';
                                            }?></div>
                                        <div class="col-xs-2 clear games"><p><?php
                                                echo get_post_meta( get_the_ID(), 'casino_games', true );
                                                ?></p></div>
                                        <div class="col-xs-2 clear bonus"><p><?php
                                                echo get_post_meta( get_the_ID(), 'casino_bonus', true );
                                                ?></p></div>
                                        <div class="col-xs-2 clear button"><a href="<?php
                                            echo get_post_meta( get_the_ID(), 'casino_link', true );
                                            ?>" class="button-red"><?php
                                                if(ICL_LANGUAGE_CODE == 'ru') {
                                                    echo 'Перейти на сайт';
                                                }
                                                else {
                                                    echo 'Visit Now';
                                                }
                                                ?></a></div>
                                    </div>
                                <?php
                                }
                            }
                            ?>

                        </div>
                    
				</div>
				<br>
	<br>
	<ins class="bmadblock-5667132ffe8f76610d1cf7b7" style="display:inline-block;width:728px;height:90px;"></ins>
<script async type="application/javascript" src="//ad.bitmedia.io/js/adbybm.js/5667132ffe8f76610d1cf7b7"></script>
<br>
	<br>
<div id="teaser_1565"><a href="//bitteaser.com/">BitTeaser</a></div>
<script type="text/javascript">document.write('<scr'+'ipt type="text/jav'+'ascript" src="//bitteaser.com/show/?block_id=1565&r='+escape(document.referrer)+'&'+Math.round(Math.random()*100000)+'"></scr'+'ipt>');</script>
                </div>
                <?php get_sidebar(); ?>
                <div class="col-xs-12">
                    <div class="header">
                        <?php dynamic_sidebar( 'header_banner' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>