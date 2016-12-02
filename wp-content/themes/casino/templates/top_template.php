<?php
$options_top_imgs = get_option( ICL_LANGUAGE_CODE.'_theme_options' );
function get_top($post_type,$taxonomy,$term)
{
    $query = null;
    $query = new WP_Query( array(
        'post_type' => $post_type,
        'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
                'field'    => 'slug',
                'terms'    => $term,
            ),
        )
    ) );
    if($query->have_posts()){
        while($query->have_posts()) {
            $query->the_post();
//            var_dump(get_post_meta(get_the_ID(),'top_post_img', true));
            $top_img_url = get_post_meta(get_the_ID(),'top_post_img', true);
            
            if( $top_img_url != '' ) {
                echo '<a href="'.get_the_permalink().'"><img width="20" height="20" src="'.$top_img_url.
                    '" alt="Best Bitcoin sites"/></a>';
            }
//            echo '<a href="'.get_the_permalink().'"><img width="20" height="20" src="'.wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ).
//                '" alt="Best Bitcoin sites"/></a>';
        }
    }
}

$taxonomies = array(
    'casinos_categories'
);

$args = array(
    'orderby'           => 'id',
    'order'             => 'DESC',
    'hide_empty'        => false,
    'exclude'           => array(),
    'exclude_tree'      => array(),
    'include'           => array(),
    'number'            => '',
    'fields'            => 'all',
    'slug'              => '',
    'parent'            => '',
    'hierarchical'      => true,
    'child_of'          => 0,
    'childless'         => false,
    'get'               => '',
    'name__like'        => '',
    'description__like' => '',
    'pad_counts'        => false,
    'offset'            => '',
    'search'            => '',
    'cache_domain'      => 'core'
);
$terms = get_terms( $taxonomies, $args );

foreach ($terms as $term) {


    if( $term->slug == 'top-kazino-ru' ) {
        ?>
       
        <a id="cas-list-show" href="<?php
        //echo get_term_link( $term->slug, 'casinos_categories' );
        echo $options_top_imgs['top-cas-link-text'];
        ?>">
            <p><?php echo $term->name; ?></p>
            <img src="<?php echo $options_top_imgs['bitcoinnetw_img']; ?>" alt="Bitcoin casino TOP 1">
        </a>
        
        <ul id="top-cas-list">

            <li><?php get_top('casino','casinos_categories','top-kazino-1'); ?></li>
       
            <li><?php get_top('casino','casinos_categories','top-kazino-2'); ?></li>
       
            <li><?php get_top('casino','casinos_categories','top-kazino-3'); ?></li>
       
            <li><?php get_top('casino','casinos_categories','top-kazino-4'); ?></li>
       
        </ul>
    <?php
    }
    if( $term->slug == 'top-ekschejnzh' ) {
        ?>
        
        <a id="trading-list-show" href="<?php
        //echo get_term_link( $term->slug, 'casinos_categories' );
        echo $options_top_imgs['top-exch-link-text'];
        ?>">
            <p><?php echo $term->name; ?></p>
            
            <img src="<?php echo $options_top_imgs['top_casinos_img']; ?>" alt="Bitcoin exchanges TOP 1">
		
        </a>
        <ul id="top-tradings-list">
      
            <li><?php get_top('trading','casinos_categories','top-torgovyh-1'); ?></li>
       
            <li><?php get_top('trading','casinos_categories','top-torgovyh-2'); ?></li>
       
            <li><?php get_top('trading','casinos_categories','top-torgovyh-3'); ?></li>
       
            <li><?php get_top('trading','casinos_categories','top-torgovyh-4'); ?></li>
        </ul>
    <?php
    }
    if( $term->slug == 'top-igrovyh-ru' ) {
        ?>
        
        <a id="gambl-list-show" href="<?php
        // echo get_term_link( $term->slug, 'casinos_categories' );
        echo $options_top_imgs['top-gambl-link-text'];
        ?>">
            <p><?php echo $term->name; ?></p>
              
            <img src="<?php echo $options_top_imgs['bitcoin_exchange_img']; ?>" alt="Bitcoin gambling sites TOP 1">
		  
        </a>
        <ul id="top-gambling-list">
           
            <li><?php get_top('gambling','casinos_categories','top-igrovyh-1'); ?></li>
       
            <li><?php get_top('gambling','casinos_categories','top-igrovyh-2'); ?></li>
       
            <li><?php get_top('gambling','casinos_categories','top-igrovyh-3'); ?></li>
       
            <li><?php get_top('gambling','casinos_categories','top-igrovyh-4'); ?></li>
        </ul>
    <?php
    }
    if( $term->slug == 'top-ad-ru' ) {
        ?>
        <a id="teasers-list-show" href="<?php
        // echo get_term_link( $term->slug, 'casinos_categories' );
        echo $options_top_imgs['top-ad-link-text'];
        ?>">
            <p><?php echo $term->name; ?></p>
              
            <img src="<?php echo $options_top_imgs['bitcoin_gambling_img']; ?>" alt="Bitcoin ad networks TOP 1">
			
        </a>
        <ul id="top-teasers-list">
           
            <li><?php get_top('teaser','casinos_categories','top-tizer-1'); ?></li>
       
            <li><?php get_top('teaser','casinos_categories','top-tizer-2'); ?></li>
       
            <li><?php get_top('teaser','casinos_categories','top-tizer-3'); ?></li>
       
            <li><?php get_top('teaser','casinos_categories','top-tizer-4'); ?></li>
        </ul>
    <?php
    }



    if( $term->slug == 'top-casinos' ) {
        ?>
        <a id="cas-list-show" href="<?php
        //echo get_term_link( $term->slug, 'casinos_categories' );
        echo $options_top_imgs['top-cas-link-text'];
        ?>">
            <p><?php echo $term->name; ?></p>
            <div class="bg-img"></div>
            <img src="<?php echo $options_top_imgs['bitcoinnetw_img']; ?>" alt="Bitcoin casinos TOP 1">
        </a>

        <ul id="top-cas-list">
           
            <li><?php get_top('casino','casinos_categories','top-casinos-1'); ?></li>
       
            <li><?php get_top('casino','casinos_categories','top-casinos-2'); ?></li>
       
            <li><?php get_top('casino','casinos_categories','top-casinos-3'); ?></li>
       
            <li><?php get_top('casino','casinos_categories','top-casinos-4'); ?></li>

        </ul>
    <?php
    }
    if( $term->slug == 'top-exchange' ) {
        ?>
        <a id="trading-list-show" href="<?php
        // echo get_term_link( $term->slug, 'casinos_categories' );
        echo $options_top_imgs['top-exch-link-text'];
        ?>">
            <p><?php echo $term->name; ?></p>
            <div class="bg-img"></div>
            <img src="<?php echo $options_top_imgs['top_casinos_img']; ?>" alt="Bitcoin exchanges TOP 1">
        </a>
        <ul id="top-tradings-list">
         
            <li><?php get_top('trading','casinos_categories','top-trading-1'); ?></li>
       
            <li><?php get_top('trading','casinos_categories','top-trading-2'); ?></li>
       
            <li><?php get_top('trading','casinos_categories','top-trading-3'); ?></li>
       
            <li><?php get_top('trading','casinos_categories','top-trading-4'); ?></li>

        </ul>
    <?php
    }
    if( $term->slug == 'top-gambling' ) {
        ?>
        <a id="gambl-list-show" href="<?php
        // echo get_term_link( $term->slug, 'casinos_categories' );
        echo $options_top_imgs['top-gambl-link-text'];
        ?>">
            <p><?php echo $term->name; ?></p>
            <div class="bg-img"></div>
            <img src="<?php echo $options_top_imgs['bitcoin_exchange_img'] ?>" alt="Bitcoin gambling sites TOP 1">
        </a>
        <ul id="top-gambling-list">
          
            <li><?php get_top('gambling','casinos_categories','top-gambling-1'); ?></li>
       
            <li><?php get_top('gambling','casinos_categories','top-gambling-2'); ?></li>
       
            <li><?php get_top('gambling','casinos_categories','top-gambling-3'); ?></li>
       
            <li><?php get_top('gambling','casinos_categories','top-gambling-4'); ?></li>

        </ul>
    <?php
    }
    if( $term->slug == 'top-ad' ) {
        ?>
        <a id="teasers-list-show" href="<?php
        // echo get_term_link( $term->slug, 'casinos_categories' );
        echo $options_top_imgs['top-ad-link-text'];
        ?>">
            <p><?php echo $term->name; ?></p>
            <div class="bg-img"></div>
            <img src="<?php echo $options_top_imgs['bitcoin_gambling_img'] ?>" alt="Bitcoin ad networks TOP 1">
        </a>
        <ul id="top-teasers-list">
           
            <li><?php get_top('teaser','casinos_categories','top-teaser-1'); ?></li>
       
            <li><?php get_top('teaser','casinos_categories','top-teaser-2'); ?></li>
       
            <li><?php get_top('teaser','casinos_categories','top-teaser-3'); ?></li>
       
            <li><?php get_top('teaser','casinos_categories','top-teaser-4'); ?></li>
        </ul>
    <?php
    }
    
}
?>