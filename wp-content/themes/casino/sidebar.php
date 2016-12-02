<?php $options = get_option( ICL_LANGUAGE_CODE.'_theme_options' ); ?>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
   
    <div class="sidebar">

        <?php get_template_part( 'templates/top_template' ) ?>
<div class="row">



        <?php
        $count = 0;
        $query = null;
        $query = new WP_Query( array( 'post_type' => 'post',
                                        'posts_per_page' => '4') );
        if($query->have_posts()) {
            while($query->have_posts()) {
                $query->the_post();
                $count += 1;
                if($count < 3) {
                    ?>
<!--
                    
        <?php
                }
            }
        }
        ?>



    <!--                                    <h2>--><?php //the_title(); ?><!--</h2>-->
<!--                                    <a href="--><?php //echo get_the_permalink(); ?><!--">-->
<!--                                        --><?php //the_post_thumbnail(); ?>
<!--                         
                                  </a>-->
        </div>
        <div class="row">
                            <div class="vidjit">
                            <?php dynamic_sidebar( 'first_price_ticker' ); ?>
						</div>
                       <div class="vidjit">
                           <?php dynamic_sidebar( 'sec_price_ticker' ); ?>
                     </div>
                    <div class="vidjit">
                           <?php dynamic_sidebar( 'third_price_ticker' ); ?>
                    </div>
                     
<!--                            --><?php //dynamic_sidebar( 'fourth_price_ticker' ); ?>
<div class="vidjit">
                           <div id="btc-quote"></div>
                           <script type="text/javascript" src="https://cdn-gh.firebase.com/btcquote/embed.js"></script>
                            </div>
        </div>

		

<!--<a href="<?php echo $options['advertising1-link-text']; ?>">-->
    <div class="advertising adve-top">
        <!--<div id="teaser_1558"><a href="//bitteaser.com/">BitTeaser</a></div>
<script type="text/javascript">document.write('<scr'+'ipt type="text/jav'+'ascript" src="//bitteaser.com/show/?block_id=1558&r='+escape(document.referrer)+'&'+Math.round(Math.random()*100000)+'"></scr'+'ipt>');</script>-->
		<ins class="bmadblock-56671387fe8f76610d1cf7de" style="display:inline-block;width:300px;height:250px;"></ins>
<script async type="application/javascript" src="//ad.bitmedia.io/js/adbybm.js/56671387fe8f76610d1cf7de"></script>
    </div> 
	
</a>
        <!--<a href="<?php echo $options['advertising2-link-text']; ?>"> -->
    <div class="advertising">
        <div id="teaser_1559"><a href="//bitteaser.com/">BitTeaser</a></div>
<script type="text/javascript">document.write('<scr'+'ipt type="text/jav'+'ascript" src="//bitteaser.com/show/?block_id=1559&r='+escape(document.referrer)+'&'+Math.round(Math.random()*100000)+'"></scr'+'ipt>');</script>
		<!--<ins class="bmadblock-566713affe8f76610d1cf7f4" style="display:inline-block;width:300px;height:100px;"></ins>
<script async type="application/javascript" src="//ad.bitmedia.io/js/adbybm.js/566713affe8f76610d1cf7f4"></script>-->
    </div>
        </a>
        <!--<a href="<?php echo $options['advertising3-link-text']; ?>">-->
    <div class="advertising">
        <div id="teaser_1560"><a href="//bitteaser.com/">BitTeaser</a></div>
<script type="text/javascript">document.write('<scr'+'ipt type="text/jav'+'ascript" src="//bitteaser.com/show/?block_id=1560&r='+escape(document.referrer)+'&'+Math.round(Math.random()*100000)+'"></scr'+'ipt>');</script>
		<!--<ins class="bmadblock-566713d1fe8f76610d1cf801" style="display:inline-block;width:300px;height:250px;"></ins>
<script async type="application/javascript" src="//ad.bitmedia.io/js/adbybm.js/566713d1fe8f76610d1cf801"></script>-->
    </div>
        </a>
<!--<a href="<?php echo $options['advertising4-link-text']; ?>">-->
    <div class="advertising">
        <!--<ins class="bmadblock-5673f9b33112aa7205328aa6" style="display:inline-block;width:300px;height:100px;"></ins>
<script async type="application/javascript" src="//ad.bitmedia.io/js/adbybm.js/5673f9b33112aa7205328aa6"></script>-->
    </div> 
	
</a>

    
    </div>
<div class="vidjit">
                    <script src="http://coinwidget.com/widget/coin.js"></script>
<script>
CoinWidgetCom.go({
 wallet_address: "197pjJYbbSUGZPY2HfarXWc9xHByBL1ctg"
 , currency: "bitcoin"
 , counter: "count"
 , alignment: "bl"
 , qrcode: true
 , auto_show: true
 , lbl_button: "Share The Love"
 , lbl_address: "My Bitcoin Address:"
 , lbl_count: "Donations"
 , lbl_amount: "BTC"
});
</script>
	</div>
</div>