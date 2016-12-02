<?php get_header(); ?>

    <div class="wrapper casinos-page-2">
        <div class="container">
            <div class="row">
                <div class="col-xs-9">
                    <div class="casinos-content-full">
                        <div class="casinos-content">
                            <h1>CASINOS</h1>
                            <h2>Best Bitcoin Casinos</h2>
                            <p>These are simply the Best Bitcoin Casino Sites that exist. We test and review <br>each gambling site personally and only the best make it into our top casino list.</p>
                        </div>

                        <div class="row pading">
                            <div class="col-xs-12 clear ">
                                <div class="table">
                                    <div class="name">
                                        <div class="col-xs-12 name-bg">
                                            <div class="col-xs-2"><h1>Name</h1></div>
                                            <div class="col-xs-2"><h1>Site</h1></div>
                                            <div class="col-xs-2"><h1>Provably Fair</h1></div>
                                            <div class="col-xs-2"><h1>Games</h1></div>
                                            <div class="col-xs-2"><h1>Bonus</h1></div>
                                            <div class="col-xs-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
//                            $query = null;
//                            $query = new WP_Query( array( 'post_type' => 'casino',
//                                'posts_per_page' => '200') );
                            if(have_posts()) {
                                while(have_posts()) {
                                    the_post();
                                    ?>
                                    <div class="col-xs-12 site-con">
                                        <div class="col-xs-2 clear name"><img width="120" height="50" src="<?php
                                            echo get_post_meta( get_the_ID(), 'casino_logo', true );
                                            ?>" alt="Casino logo"> <a href="<?php the_permalink(); ?>">Read full Review</a></div>
                                        <div class="col-xs-2 clear site"><a href="<?php
                                            echo get_post_meta( get_the_ID(), 'casino_link', true );
                                            ?>"><?php
                                                echo get_post_meta( get_the_ID(), 'casino_site', true );
                                                ?></a></div>
                                        <div class="col-xs-2 clear fair">
                                            <?php
                                            $check = get_post_meta(get_the_ID(), 'casino_prov_fair',true);
                                            if($check == '') {
                                                echo '<img class="alignnone size-full wp-image-125" src="http://bitcoinsband.com/wp-content/uploads/2015/07/krest.png" alt="Not Available" width="39" height="43" />';
                                            }
                                            else
                                            {
                                                echo '<img class="alignnone size-full wp-image-127" src="http://bitcoinsband.com/wp-content/uploads/2015/07/galachka.png" alt="Available" width="53" height="41">';
                                            }?></div>
                                        <div class="col-xs-2 clear games"><p><?php
                                                echo get_post_meta( get_the_ID(), 'casino_games', true );
                                                ?></p></div>
                                        <div class="col-xs-2 clear bonus"><p><?php
                                                echo get_post_meta( get_the_ID(), 'casino_bonus', true );
                                                ?></p></div>
                                        <div class="col-xs-2 clear button"><a href="<?php
                                            echo get_post_meta( get_the_ID(), 'casino_link', true );
                                            ?>" class="button-red">PLAY NOW</a></div>
                                    </div>
                                <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <?php get_sidebar(); ?>
                <div class="col-xs-12">
                    <div class="header">
                        <?php dynamic_sidebar( 'footer_banner' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>