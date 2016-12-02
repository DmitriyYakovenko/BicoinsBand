<?php get_header(); ?>
    <div class="wrapper casinos-page-1">
        <div class="container">
            <div class="row">
                <div class="col-xs-9 page-1-content">
                    <?php if(have_posts()){
                        while(have_posts()){
                            the_post();
                            the_content();
                        }
                    } ?>
                </div>
                <?php get_sidebar(); ?>

            </div>
            <div class="row header">
                <?php
                dynamic_sidebar( 'footer_banner' );
                ?>
            </div>
        </div>
    </div>
<?php if(have_posts()) {
    while(have_posts()) {
        the_post();
    }
} ?>

<?php get_footer(); ?>