   <div class="block-bg  block-footer">   </div> 

    <div class="wrapper footer">

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  bg">
                <div class="footer-mnu">
                    <img src="<?php bloginfo('template_url') ?>/images/logo-2.png" alt="Footer logo">
                    <?php wp_nav_menu( array(
                        'theme_location'  => 'footer_menu',
                        'menu'            => '',
                        'container'       => 'div',
                        'container_class' => 'menu-footer',
                        'container_id'    => '',
                        'menu_class'      => '',
                        'menu_id'         => '',
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
<!--                    <div class="soc">-->
<!--                        <ul>-->
                            <?php $options = get_option( ICL_LANGUAGE_CODE.'_theme_options' ); ?>
<!--                            <li><a href="--><?php //echo $options['facebook']; ?><!--" class="fb"></a></li>-->
<!--                            <li><a href="--><?php //echo $options['vk']; ?><!--" class="vk"></a></li>-->
<!--                            <li><a href="--><?php //echo $options['classmates']; ?><!--" class="ok"></a></li>-->
<!--                            <li><a href="--><?php //echo $options['twitter']; ?><!--" class="tw"></a></li>-->
<!--                            <li><a href="--><?php //echo $options['mail']; ?><!--" class="ml"></a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
                    <p class="copiright"><?php echo $options['copyright']; ?></p>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
			new UISearch( document.getElementById( 'sb-search' ) );
</script>
<script>
	var cbpAnimatedHeader = (function() {

    var docElem = document.documentElement,
        header = document.querySelector( '.cbp-af-header' ),
        didScroll = false,
        changeHeaderOn = 150;

    function init() {
        window.addEventListener( 'scroll', function( event ) {
            if( !didScroll ) {
                didScroll = true;
                setTimeout( scrollPage, 250 );
            }
        }, false );
    }

    function scrollPage() {
        var sy = scrollY();
        if ( sy >= changeHeaderOn ) {
            classie.add( header, 'cbp-af-header-shrink' );
        }
        else {
            classie.remove( header, 'cbp-af-header-shrink' );
        }
        didScroll = false;
    }

    function scrollY() {
        return window.pageYOffset || docElem.scrollTop;
    }

    init();

})();
</script>
   <script>
       (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
           (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
           m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
       })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

       ga('create', 'UA-67551734-1', 'auto');
       ga('send', 'pageview');

   </script>
<?php wp_footer(); ?>
</body>
</html>