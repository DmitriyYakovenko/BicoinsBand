<?php get_header(); ?>
    <div class="wrapper casinos-page-1">
    <div class="container">
    <div class="row">

    <div class="col-lg-9 col-md-9 col-sm-9  col-xs-9 page-1-content">
        <?php if(have_posts()) {
            while(have_posts()) {
                the_post();
                the_content();
            }
        } ?>
    </div>

    <?php get_sidebar(); ?>
    </div>
    </div>
    </div>


<?php get_footer(); ?>