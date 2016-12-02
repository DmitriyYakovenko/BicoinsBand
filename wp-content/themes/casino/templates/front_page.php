<?php
/**
 * Template name: Front page
 */
?>
<?php get_header(); ?>

    <div class="wrapper block-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 ">
                    <div class="slider">
                        <div id="owl-demo" class="owlCarousel owl-theme">

                            <?php
                            $query = new WP_Query( array('post_type' => 'main_page_slider') );
                            if($query->have_posts()) {
                                while($query->have_posts()) {
                                    $query->the_post();
                                    ?>
                                    <div class="item">
                                    <a class='itemLink' href="<?php echo get_post_meta(get_the_ID(), 'slider_link', true ); ?>">
                                        <?php the_post_thumbnail(); ?>
                                
                                        <h1><?php the_title(); ?></h1>
                                      <!--   <a href="<?php echo get_post_meta(get_the_ID(), 'slider_link', true ); ?>">
                                            <?php the_excerpt(); ?></a> -->
                                    </a>
                                    </div>
                                <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 clear-l">
                    <div class="sidebar">
                        <?php get_template_part( 'templates/top_template' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper block-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="content">

<!--                        --><?php
//                        $query = null;
//                        $query = new WP_Query( array(
//                            'post_type' => 'post',
//                            'cat' => 5,
//                            'posts_per_page' => '4' ) );
//                        if($query->have_posts()) {
//                            while($query->have_posts()){
//                                $query->the_post();
//                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3  clear">

                                    <?php dynamic_sidebar( 'first_price_ticker' ); ?>
                                </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 clear">
                            <?php dynamic_sidebar( 'sec_price_ticker' ); ?>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 clear">
                            <?php dynamic_sidebar( 'third_price_ticker' ); ?>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 clear">
<!--                            --><?php //dynamic_sidebar( 'fourth_price_ticker' ); ?>

                            <div id="btc-quote"></div>
                            <script type="text/javascript" src="https://cdn-gh.firebase.com/btcquote/embed.js"></script>

                        </div>
<!--                                --><?php
//                            }
//                        }
//                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$options = get_option( ICL_LANGUAGE_CODE.'_theme_options' );


?>
    <div class="wrapper block-4" style="background: url(<?php echo $options['divider_img_1']; ?>)no-repeat;">
        <h2><?php echo $options['divider_1']; ?></h2>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img class="img-page" src="<?php echo $options['divider_ico_1']; ?>" alt="best bitcoin casinos ico">

                    <?php
                    $query = null;
                    $query = new WP_Query( array(
                        'post_type' => 'casino',
                        'tax_query' => array(
                        array(
                            'taxonomy' => 'casinos_categories',
                            'field' => 'name',
                            'terms'    => 'mp-casinos'
                        ))
                    ) );

                    if($query->have_posts()) {
                        while($query->have_posts()) {
                            $query->the_post();
                            ?>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3  clear">
                                <h5><?php the_title(); ?></h5>
                                <div class="tr">
                                    <a href="<?php the_permalink() ?>">
                                <div class="bg-img-4"></div>
                                    </a>
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <a href="<?php echo get_post_meta( get_the_ID(), 'casino_link', true ); ?>" target="blanc" class="button-red"><?php
                                    if(ICL_LANGUAGE_CODE == 'ru') {
                                        echo 'ИГРАТЬ СЕЙЧАС';
                                    }
                                    else {
                                        echo 'PLAY NOW';
                                    }
                                    ?></a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<!--     <div class="wrapper block-5" style="background: url(<?php echo $options['divider_img_2'];  ?>)no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2><?php echo $options['divider_2']; ?></h2>
                    <img class="img-page" src="<?php echo $options['divider_ico_2']; ?>" alt="">


                    <?php
                    $query = null;
                    $query = new WP_Query( array(
                        'post_type' => 'casino',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'casinos_categories',
                                'field' => 'name',
                                'terms'    => 'deposit-bonus'
                            ))
                    ) );

                    if($query->have_posts()) {
                        while($query->have_posts()) {
                            $query->the_post();
                            ?>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
                               
                                <?php the_post_thumbnail(); ?>
                                <div class="block-5-content">
                                    <h1><?php the_title(); ?></h1>

                                </div>
                                <a href="<?php the_permalink(); ?>" target="blanc"  class="button-red"><?php
                                    if(ICL_LANGUAGE_CODE == 'ru') {
                                        echo 'ИГРАТЬ СЕЙЧАС';
                                    }
                                    else {
                                        echo 'Get Bonus';
                                    }
                                    ?></a>
                            </div>
                        <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div> -->
    <div class="wrapper  block-bg block-bg-2"></div>
    <div class="wrapper block-6" style="background: url(<?php echo $options['divider_img_3'];  ?>)no-repeat;">
  
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2><?php echo $options['divider_3']; ?></h2>
                    
                    <img class="img-page" src="<?php echo $options['divider_ico_3']; ?>" alt="Best bitcoin gambling sites ico">

                    <?php
                    $query = null;
                    $query = new WP_Query( array( 'post_type'=> 'gambling', 'posts_per_page' => '3' ) );
                    $counter = 0;
                    if($query->have_posts()) {
                        while($query->have_posts()) {
                            $query->the_post();
                            ?>
                            <div class="col-xs-4 clear">
                                <h5><?php the_title(); ?></h5>

                               <a href="<?php
//                               the_permalink();
                               if( $counter == 0 ) echo _get_page_link( 331 );
                               if( $counter == 1 ) echo _get_page_link( 327 );
                               if( $counter == 2 ) echo _get_page_link( 246 );
                               $counter++;
                               ?>"> <div class="bg-img-3"></div>
									<?php the_post_thumbnail(); ?></a>
                          
                            </div>
                            <?php
                        }
                    }
                    ?>


<?php
//$taxonomies = array(
//    'casinos_categories'
//);
//
//$args = array(
//    'orderby'           => 'name',
//    'order'             => 'ASC',
//    'hide_empty'        => false,
//    'exclude'           => array(),
//    'exclude_tree'      => array(),
//    'include'           => array(),
//    'number'            => '',
//    'fields'            => 'all',
//    'slug'              => '',
//    'parent'            => '',
//    'hierarchical'      => true,
//    'child_of'          => 0,
//    'childless'         => false,
//    'get'               => '',
//    'name__like'        => '',
//    'description__like' => '',
//    'pad_counts'        => false,
//    'offset'            => '',
//    'search'            => '',
//    'cache_domain'      => 'core'
//);
//$terms = get_terms( $taxonomies, $args );
//foreach ($terms as $term) {
//    ?>



                </div>
            </div>
        </div>
    </div>
    <div class="wrapper block-7" style="background: url(<?php echo $options['divider_img_4'];  ?>)no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2><?php echo $options['divider_4']; ?></h2>
                    
                    <img class="img-page" src="<?php echo $options['divider_ico_4']; ?>" alt="Best bitcoin exchanges ico">
                    <?php
                    $query = null;
                    $query = new WP_Query( array(
                        'post_type' => 'trading',
                        'posts_per_page' => '4'
                    ) );
                    if($query->have_posts()){
                        while($query->have_posts()){
                            $query->the_post();
                            ?>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
                                <h5><?php the_title(); ?></h5>
                                <div class="tr">
                                    <a href="<?php the_permalink(); ?>">
                                <div class="bg-img-4"></div>
                                    </a>
									<?php the_post_thumbnail(); ?></div>
                                <a href="<?php echo get_post_meta( get_the_ID(), 'casino_link', true ); ?>" target="blanc" class="button-blue"><?php
                                    if(ICL_LANGUAGE_CODE == 'ru') {
                                        echo 'ИГРАТЬ СЕЙЧАС';
                                    }
                                    else {
                                        echo 'Visit Now';
                                    }
                                    ?></a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper block-8" style="background: url(<?php echo $options['divider_img_5'];  ?>)no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <h2><?php echo $options['divider_5']; ?></h2>
                    
                    <img  class="img-block-8 img-page" src="<?php echo $options['divider_ico_5']; ?>" alt="Best bitcoin ad networks ico">
                    <?php
                    $query = null;
                    $query = new WP_Query( array(
                        'post_type' => 'teaser',
                        'posts_per_page' => '4'
                    ) );
                    if($query->have_posts()){
                        while($query->have_posts()) {
                            $query->the_post();
                            ?>
                            <div class="col-xs-3 ">
                                <h5><?php the_title(); ?></h5>
                                <div class="tr">
                                    <a href="<?php the_permalink(); ?>">
                                <div class="bg-img-4"></div>
                                    </a>
									<?php the_post_thumbnail(); ?></div>
                                
                                <a href="<?php echo get_post_meta( get_the_ID(), 'casino_link', true ); ?>" target="blanc" class="button-blue"><?php
                                    if(ICL_LANGUAGE_CODE == 'ru') {
                                        echo 'ИГРАТЬ СЕЙЧАС';
                                    }
                                    else {
                                        echo 'Visit Now';
                                    }
                                    ?></a>
                            </div>
                                <?php
                            }
                            ?>
                            <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper  block-bg"></div>
    <div class="wrapper block-9" style="background: url(<?php echo $options['divider_img_6'];  ?>)no-repeat;">
       
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12">
                    <h2><?php echo $options['divider_6']; ?></h2>
                    <img class="img-page" src="<?php echo $options['divider_ico_6']; ?>" alt="Bitcoin news ico">

                    <?php
                    $query = null;
                    $query = new WP_Query( array(
                        'cat' => 1,
                        'posts_per_page' => '4'
                    ) );
                    if($query->have_posts()) {
                        while($query->have_posts()) {
                            $query->the_post();
                            ?>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                               <div class="tr">
                                <div class="bg-img-4"></div>
								   <?php the_post_thumbnail(); ?></div>
                                <h4><?php the_title(); ?></h4>
                                <p>
                                    <?php the_excerpt(); ?>
                                    <?php
                                    if(ICL_LANGUAGE_CODE == 'ru') {
                                        echo '<a href="'.get_the_permalink().'">Подробнее</a>';
                                    }
                                    else {
                                        echo '<a href="'.get_the_permalink().'">Read More</a>';
                                    }
                                    ?>
                                </p>
                            
							</div>
													
                            <?php
                        }
                    }
                    ?>

                    
                </div>
				<ins class="bmadblock-5667136bfe8f76610d1cf7d7" style="display:inline-block;width:728px;height:90px;"></ins>
<script async type="application/javascript" src="//ad.bitmedia.io/js/adbybm.js/5667136bfe8f76610d1cf7d7"></script>
                 <?php dynamic_sidebar( 'footer_banner' );?>


            </div>
           
       
       </div> 
    </div>
<?php get_footer(); ?>