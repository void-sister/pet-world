<?php
/* ---------------------------------------------------------------------------
 * Load default theme options
 * - To return default options to store in database.
 * --------------------------------------------------------------------------- */
function petsworld_default_option() {
     
    $general = array(
        'show-pagecomments' => 'false',
        'enable-responsive' => 'true',
        'show-mobileslider' => 'true'
    );

    $layout = array(
        'logo' => 'true',
        'retina-logo-width' => '72',
        'retina-logo-height' => '89',
        'show-breadcrumb' => 'true',
        'breadcrumb-delimiter' => 'fa fa-paw',
        'breadcrumb-style' => 'aligncenter',
        'header-type' => 'split-header fullwidth-header',
        'layout-stickynav' => 'true',
        'header-position' => 'above slider',
        'show-sociables' => 'on',
        'enable-footer' => 'true',
        'footer-columns' => '14',
        'footer-darkbg' => 'true',
        'enable-copyright' => 'true',
        'copyright-darkbg' => 'true',
        'copyright-content' => '[vc_column width="1/2"]Copyright © 2016 Pet Shop. All rights reserved[/vc_column]'
    );  

    $widgetarea = array(
		'wtitle-style' => 'default'
	);
    
    $social = array(
        'social-1' => array(
            'icon' => 'fa-facebook',
            'link' => '#'
        ),
        'social-2' => array(
            'icon' => 'fa-twitter',
            'link' => '#'
        ),
        'social-3' => array(
            'icon' => 'fa-google-plus',
            'link' => '#'
        )
    );

    $pageoptions = array(
        'show-standard-left-sidebar-for-post-archives' => 'true',
        'show-standard-right-sidebar-for-post-archives' => 'true',
		'post-style' => 'entry-center-align',
        'post-format-meta' => 'true',
        'post-author-meta' => 'true',
        'post-date-meta' => 'true',
        'post-comment-meta' => 'true',
        'post-category-meta' => 'true',
        'post-tag-meta' => 'true',
        'show-standard-left-sidebar-for-portfolio-archives' => 'true',
        'show-standard-right-sidebar-for-portfolio-archives' => 'true',
        'show-notfound-bg-color' => 'true',
        'show-launchdate' => 'true',
        'show-comingsoon-bg-color' => 'true',
        'single-post-comments' => 'true',
        'post-archives-enable-excerpt' => 'true',
        'post-archives-excerpt' => '50',
        'post-archives-enable-readmore' => 'true',
        'post-archives-readmore' => '[dt_sc_button title="Read More" style="filled" icon_type="fontawesome" iconalign="icon-right with-icon" iconclass="fa fa-long-arrow-right" class="type1"]',		
		'post-archives-page-layout' => 'content-full-width',
		'pets-archives-page-layout' => 'content-full-width',
		'pet-sitter-archives-page-layout' => 'content-full-width',
		'portfolio-archives-page-layout' => 'content-full-width',		
		'portfolio-custom-fields' => array( 'Client', 'Website', 'Date'),
        'enable-404message' => 'true',
        'notfound-style' => 'type8',
        'comingsoon-style' => 'type5',
        'comingsoon-launchdate' => '12/24/2016'
    );

    $woo = array(
        'product-style' => 'type6',
        'shop-page-product-layout' => 'one-third-column'
    );

    $fonts = array(
        'content-font' => 'Cabin',
        'menu-font' => 'Cabin',
        'pagetitle-font' => 'Cabin',
        'h1-font' => 'Bubblegum Sans',
        'h2-font' => 'Bubblegum Sans',
        'h3-font' => 'Bubblegum Sans',
        'h4-font' => 'Bubblegum Sans',
        'h5-font' => 'Bubblegum Sans',
        'h6-font' => 'Bubblegum Sans',
        'font-style' => array( '100', '100italic', '200', '200italic','300', '300italic','400', '400italic','500', '500italic','600', '600italic','700', '700italic','800', '800italic','900', '900italic'),
        'content-font-size' => '16',
        'menu-font-size' => '20',
        'h1-font-size' => '30',
        'h2-font-size' => '24',
        'h3-font-size' => '18',
        'h4-font-size' => '16',
        'h5-font-size' => '14',
        'h6-font-size' => '13',
        'menu-weight' => 'normal',
        'h1-weight' => 'normal',
        'h2-weight' => 'normal',
        'h3-weight' => 'normal',
        'h4-weight' => 'normal',
        'h5-weight' => 'normal',
        'h6-weight' => 'normal',
        'menu-letter-spacing' => '0px',
        'h1-letter-spacing' => '0px',
        'h2-letter-spacing' => '0px',
        'h3-letter-spacing' => '0px',
        'h4-letter-spacing' => '0px',
        'h5-letter-spacing' => '0px',
        'h6-letter-spacing' => '0px',
        'body-line-height' => '28'
    );
    
    $data = array(
        'general' => $general,
        'layout'  => $layout,
        'widgetarea'  => $widgetarea,
        'social'  => $social,
        'pageoptions' => $pageoptions,
        'woo'     => $woo,
        'fonts'   => $fonts
    );
    return $data;
}

/* ---------------------------------------------------------------------------
 * Load default theme options
 * - To return default options to store in database.
 * --------------------------------------------------------------------------- */
function petsworld_show_footer_widgetarea( $count ) {
    $classes = array (
        "1" => "dt-sc-full-width",
        "dt-sc-one-half",
        "dt-sc-one-third",
        "dt-sc-one-fourth",
        "dt-sc-one-fifth",
        "dt-sc-one-sixth",
        "1-2" => "dt-sc-one-half",
        "1-3" => "dt-sc-one-third",
        "1-4" => "dt-sc-one-fourth",
        "3-4" => "dt-sc-three-fourth",
        "2-3" => "dt-sc-two-third",
		"2-6" => 'dt-sc-two-sixth',
		'1-6' => 'dt-sc-one-sixth');

    if ($count <= 6) :
        for($i = 1; $i <= $count; $i ++) :

            $class = $classes [$count];
            $class = esc_attr( $class );

            $first = ($i == 1) ? "first" : "";
            $first = esc_attr( $first );

            echo "<div class='column {$class} {$first}'>";
                if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$i}" )) : endif;
            echo "</div>";
        endfor;
    elseif( $count == 14 ):
        $a = array (
            "2-6",
            "1-6",
            "1-6",
            "2-6");

        foreach ( $a as $k => $v ) :
            $class = $classes [$v];
            $class = esc_attr( $class );

            $first = ($k == 0 ) ? "first" : "";
            $first = esc_attr( $first );

            echo "<div class='column {$class} {$first}'>";
                if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$k}-{$v}" )) : endif;
            echo "</div>";
        endforeach;
    elseif ($count == 12 || $count == 13) :

        $a = array (
            "1-4",
            "1-4",
            "1-2" );

        $a = ($count == 12) ? $a : array_reverse ( $a );
        foreach ( $a as $k => $v ) :
            $class = $classes [$v];
            $class = esc_attr( $class );

            $first = ($k == 0 ) ? "first" : "";
            $first = esc_attr( $first );

            echo "<div class='column {$class} {$first}'>";
                if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$k}-{$v}" )) : endif;
            echo "</div>";
        endforeach;
    elseif ($count == 7 || $count == 8) :
        $a = array (
            "1-4",
            "3-4");

        $a = ($count == 7) ? $a : array_reverse ( $a );
        foreach ( $a as $k => $v ) :
            $class = $classes [$v];
            $class = esc_attr( $class );

            $first = ($k == 0 ) ? "first" : "";
            $first = esc_attr( $first );


            echo "<div class='column {$class} {$first}'>";
                if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$k}-{$v}" )) :endif;
            echo "</div>";
        endforeach;
    elseif ($count == 9 || $count == 10) :
        $a = array ( 
            "1-3",
            "2-3" );
        $a = ($count == 9) ? $a : array_reverse ( $a );

        foreach ( $a as $k => $v ) :
            $class = $classes [$v];
            $class = esc_attr( $class );

            $first = ($k == 0 ) ? "first" : "";
            $first = esc_attr( $first );

            echo "<div class='column {$class} {$first}'>";
                if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$k}-{$v}" )) :endif;
            echo "</div>";
        endforeach;
    elseif ($count == 11 ) :
        $a = array ( "1-4", "1-2", "1-4" );
        foreach ( $a as $k => $v ) :
            $class = $classes [$v];
            $class = esc_attr( $class );
            $first = ($k == 0 ) ? "first" : "";
            $first = esc_attr( $first );
            echo "<div class='column {$class} {$first}'>";
                if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$k}-{$v}" )) : endif;
            echo "</div>";
        endforeach;
    endif;
}?>