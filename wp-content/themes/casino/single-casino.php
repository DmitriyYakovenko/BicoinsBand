<?php get_header(); ?>
    <div class="wrapper casinos-page-1">
        <div class="container">
            <div class="row">

                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 page-1-content">

                    <img class="alignnone size-full wp-image-122" src="<?php
                    if(have_posts()) {
                        while (have_posts()) {
                            the_post();
                            if(get_post_meta(get_the_ID(), 'main_image_inside', true) == '') {
                                echo 'http://placehold.it/843x422';
                            }
                            else {
                                echo get_post_meta(get_the_ID(), 'main_image_inside', true);
                            }
                        }
                    }
                    ?>" alt="casino-5" width="843" height="422" />
                    <div class="convert">
                        <?php
                        if(have_posts()) {
                            while (have_posts()) {
                                the_post();
//                                if( get_post_meta(get_the_ID(), '_my_meta_value_key',true) == '' ) {
//                                    echo '<h1> Place</h1><h2> for text. </h2>';
//                                }
//                                else {
//                                    echo get_post_meta(get_the_ID(), '_my_meta_value_key',true);
//                                }
                            }
                        }
                        ?>
<!--
                        <a class="button-red" href="#"><?php
                            if(ICL_LANGUAGE_CODE == 'ru') {
                                echo 'ИГРАТЬ';
                            }
                            else {
                                echo 'PLAY NOW';
                            }
                            ?></a>
-->

                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <img class="alignnone size-full wp-image-124" src="<?php
                        if(have_posts()) {
                            while (have_posts()) {
                                the_post();
                                if(get_post_meta(get_the_ID(), 'casino_logo',true) == '') {
                                    echo 'http://placehold.it/195x95';
                                }else {
                                echo get_post_meta(get_the_ID(), 'casino_logo',true);
                                }
                            }
                        }
                        ?>" alt="betchain" width="216" height="111" />
                    </div>
                    <div class="col-xs-9">
<?php
                        if(have_posts()) {
                        while (have_posts()) {
                        the_post();
                        echo get_post_meta(get_the_ID(), 'casino_description',true);
                        }
                        }
?>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12 name">
                        <div class="col-lg-3 col-md-3 col-sm-3  col-xs-3">
                            <h1><?php
                                if(ICL_LANGUAGE_CODE == 'ru') {
                                    echo 'Сайт';
                                }
                                else {
                                    echo 'Site';
                                }
                                ?></h1>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-2 ">
                            <h1><?php
                                if(ICL_LANGUAGE_CODE == 'ru') {
                                    echo 'Доказуемо честное';
                                }
                                else {
                                    echo 'Provably fair';
                                }
                                ?></h1>
                        </div>
                        <div class=" col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <h1><?php
                                if(ICL_LANGUAGE_CODE == 'ru') {
                                    echo 'Игры';
                                }
                                else {
                                    echo 'Games';
                                }
                                ?></h1>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-2">
                            <h1><?php
                                if(ICL_LANGUAGE_CODE == 'ru') {
                                    echo 'Бонусы';
                                }
                                else {
                                    echo 'Bonus';
                                }
                                ?></h1>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3  col-xs-3"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12 site-con">
                        <div class="col-lg-3 col-md-3 col-sm-3  col-xs-3 clear site">
<?php
                            if(have_posts()) {
                            while (have_posts()) {
                            the_post();
                                ?>
                                <a href="https://<?php echo get_post_meta(get_the_ID(), 'casino_site',true); ?>">
                                    <?php echo get_post_meta(get_the_ID(), 'casino_site',true); ?>
                                    <?php

                            }
                            }

?>

                            </a></div>
                        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-2 clear fair">
                            <?php
                            if(have_posts()) {
                            while (have_posts()) {
                            the_post();
                            $check = get_post_meta(get_the_ID(), 'casino_prov_fair',true);
                            ?>
                            <?php if($check == '') {
                                    echo '<img class="alignnone size-full wp-image-125" src="http://bitcoinsband.com/wp-content/uploads/2015/07/krest.png" alt="Not Available" width="39" height="43" />';
                                }else {
                                    echo '<img class="alignnone size-full wp-image-127" src="http://bitcoinsband.com/wp-content/uploads/2015/07/galachka.png" alt="Available" width="53" height="41">';
                                }
                             ?>
                           <?php }
                            } ?>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-2 clear games">

                            <?php echo get_post_meta(get_the_ID(), 'casino_games',true); ?>

                        </div>
                        <div class=" col-lg-2 col-md-2 col-sm-2 col-xs-2 clear bonus">

                            <?php echo get_post_meta(get_the_ID(), 'casino_bonus',true); ?>

                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3  col-xs-3 clear button"><a class="button-red" href="<?php echo get_post_meta(get_the_ID(), 'casino_link', true); ?>"><?php
                                if(ICL_LANGUAGE_CODE == 'ru') {
                                    echo 'ИГРАТЬ';
                                }
                                else {
                                    echo 'PLAYNOW';
                                }
                                ?></a></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12"><img class="alignnone size-full wp-image-126" src="<?php

                        if(get_post_meta(get_the_ID(), 'table_divider', true) == '') {
                            echo 'http://placehold.it/801x118';
                        }else {
                        echo get_post_meta(get_the_ID(), 'table_divider', true);
                        }

                        ?>" alt="casino-6" width="801" height="118" /></div>
                    <div class="col-xs-12 name">
                        <div class="col-xs-2 clear">
                            <h1><?php
                                if(ICL_LANGUAGE_CODE == 'ru') {
                                    echo 'Джекпот';
                                }
                                else {
                                    echo 'Jackpot';
                                }
                                ?></h1>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-2 clear">
                            <h1><?php
                                if(ICL_LANGUAGE_CODE == 'ru') {
                                    echo 'High Roller';
                                }
                                else {
                                    echo 'High Roller';
                                }
                                ?></h1>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-2 clear">
                            <h1><?php
                                if(ICL_LANGUAGE_CODE == 'ru') {
                                    echo 'Мобильная версия';
                                }
                                else {
                                    echo 'Mobile version';
                                }
                                ?></h1>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-2 clear">
                            <h1><?php
                                if(ICL_LANGUAGE_CODE == 'ru') {
                                    echo 'Живые диллеры';
                                }
                                else {
                                    echo 'Live dealers';
                                }
                                ?></h1>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-2 clear">
                            <h1><?php
                                if(ICL_LANGUAGE_CODE == 'ru') {
                                    echo 'Покер';
                                }
                                else {
                                    echo 'Pokerroom';
                                }
                                ?></h1>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-2 clear">
                            <h1><?php
                                if(ICL_LANGUAGE_CODE == 'ru') {
                                    echo 'Тотализаторы';
                                }
                                else {
                                    echo 'Sportsbook';
                                }
                                ?></h1>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12 ico ">
                        <div class=" col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <?php
                            $check = get_post_meta(get_the_ID(), 'casino_jackpot',true);
                             if($check == '') {
                                echo '<img class="alignnone size-full wp-image-125" src="http://bitcoinsband.com/wp-content/uploads/2015/07/krest.png" alt="Not Available" width="39" height="43" />';
                            }else {
                                echo '<img class="alignnone size-full wp-image-127" src="http://bitcoinsband.com/wp-content/uploads/2015/07/galachka.png" alt="Available" width="53" height="41">';
                            }
                            ?>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-2">

                            <?php
                            $check = get_post_meta(get_the_ID(), 'casino_highroller',true);
                            if($check == '') {
                                echo '<img class="alignnone size-full wp-image-125" src="http://bitcoinsband.com/wp-content/uploads/2015/07/krest.png" alt="Not Available" width="39" height="43" />';
                            }else {
                                echo '<img class="alignnone size-full wp-image-127" src="http://bitcoinsband.com/wp-content/uploads/2015/07/galachka.png" alt="Available" width="53" height="41">';
                            }
                            ?>

                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-2">

                            <?php
                            $check = get_post_meta(get_the_ID(), 'casino_mobilev',true);
                            if($check == '') {
                                echo '<img class="alignnone size-full wp-image-125" src="http://bitcoinsband.com/wp-content/uploads/2015/07/krest.png" alt="krest" width="39" height="43" />';
                            }else {
                                echo '<img class="alignnone size-full wp-image-127" src="http://bitcoinsband.com/wp-content/uploads/2015/07/galachka.png" alt="galachka" width="53" height="41">';
                            }
                            ?>
                        </div>
                        <div class=" col-lg-2 col-md-2 col-sm-2  col-xs-2">

                            <?php
                            $check = get_post_meta(get_the_ID(), 'casino_livedealers',true);
                            if($check == '') {
                                echo '<img class="alignnone size-full wp-image-125" src="http://bitcoinsband.com/wp-content/uploads/2015/07/krest.png" alt="Not Available" width="39" height="43" />';
                            }else {
                                echo '<img class="alignnone size-full wp-image-127" src="http://bitcoinsband.com/wp-content/uploads/2015/07/galachka.png" alt="Available" width="53" height="41">';
                            }
                            ?>
                        </div>
                        <div class=" col-lg-2 col-md-2 col-sm-2 col-xs-2">

                            <?php
                            $check = get_post_meta(get_the_ID(), 'casino_poker_room',true);
                            if($check == '') {
                                echo '<img class="alignnone size-full wp-image-125" src="http://bitcoinsband.com/wp-content/uploads/2015/07/krest.png" alt="Not Available" width="39" height="43" />';
                            }else {
                                echo '<img class="alignnone size-full wp-image-127" src="http://bitcoinsband.com/wp-content/uploads/2015/07/galachka.png" alt="Available" width="53" height="41">';
                            }
                            ?>
                        </div>
                        <div class=" col-lg-2 col-md-2 col-sm-2 col-xs-2">

                            <?php
                            $check = get_post_meta(get_the_ID(), 'casino_sportsbook',true);
                            if($check == '') {
                                echo '<img class="alignnone size-full wp-image-125" src="http://bitcoinsband.com/wp-content/uploads/2015/07/krest.png" alt="krest" width="39" height="43" />';
                            }else {
                                echo '<img class="alignnone size-full wp-image-127" src="http://bitcoinsband.com/wp-content/uploads/2015/07/galachka.png" alt="galachka" width="53" height="41">';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12">
                        <div class="text">
                            <?php if(have_posts()){
                                while(have_posts()){
                                    the_post();
                                    the_content();
                                }
                            } ?>
                        </div>
                    </div>
                </div>

                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php if(have_posts()) {
    while(have_posts()) {
        the_post();
    }
} ?>

<?php get_footer(); ?>