<?php get_header(); ?>
    <div class="wrapper news">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php
                    $options = get_option( 'en_theme_options' );
                    if(ICL_LANGUAGE_CODE == 'ru') {
                        echo '<h1>'.$options['news1-text'].'</h1><h2>'.$options['news2-text'].'</h2>';
                    }
                    else {
                        echo '<h1>'.$options['news1-text'].'</h1><h2>'.$options['news2-text'].'</h2>';
                    }
                    ?>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                        <?php if(have_posts()){
                            while(have_posts()) {
                                the_post();
                                ?>
                                <div class="news-c">
                                    <?php the_post_thumbnail(); ?>
                                    <div class="news-content">
                                        <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                                        <h4> <?php the_time(get_option('date_format')); ?> <span>
                                                <?php the_author(); ?>
                                            </span></h4>
                                        <p>
                                            <?php echo get_the_excerpt(); ?>
                                        </p>
                                    </div>
                                </div>
                                <?php
                            }
                        } ?>

                    </div>
                
                   		<?php get_sidebar(); ?>
                                    	
                    <div class="header">
                        <ins class="bmadblock-5667136bfe8f76610d1cf7d7" style="display:inline-block;width:728px;height:90px;"></ins>
<script async type="application/javascript" src="//ad.bitmedia.io/js/adbybm.js/5667136bfe8f76610d1cf7d7"></script>
                
                    </div>  
                </div>
            
        </div>
    </div>
</div>
<?php get_footer(); ?>