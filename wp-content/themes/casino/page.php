<?php get_header(); ?>
    <div class="wrapper contakt">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 page-1-content">
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
    <ins class="bmadblock-5667136bfe8f76610d1cf7d7" style="display:inline-block;width:728px;height:90px;"></ins>
<script async type="application/javascript" src="//ad.bitmedia.io/js/adbybm.js/5667136bfe8f76610d1cf7d7"></script>
	</div>
	
<?php if(have_posts()) {
    while(have_posts()) {
        the_post();
    }
} ?>

<?php get_footer(); ?>