<?php
    $wtstyle = petsworld_opts_get('wtitle-style', '');

    $before_title = '<h3 class="widgettitle"> <span class="fa fa-paw"></span>';
    $after_title = '</h3>';

    if( $wtstyle == 'type17' ) {
        $before_title = ' <div class="mz-title"> <div class="mz-title-content"> <h3 class="widgettitle">';
        $after_title  = '</h3> </div> </div>';
    } elseif( $wtstyle == 'type18' ) {
        $before_title = ' <div class="mz-stripe-title"> <div class="mz-stripe-title-content"> <h3 class="widgettitle">';
        $after_title  = '</h3> </div> </div>';
    }

    // standard left sidebar
    register_sidebar(array(
        'name'          =>  esc_html__('Standard | Left Sidebar', 'petsworld'),
        'id'            =>  'standard-sidebar-left',
        'description'   =>  esc_html__("Appears in the Left side of the site, one enabled.",'petsworld'),
        'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  =>  '</aside>',
        'before_title'  =>  $before_title,
        'after_title'   =>  $after_title));

    // standard right sidebar
    register_sidebar(array(
        'name'          =>  esc_html__('Standard | Right Sidebar', 'petsworld'),
        'id'            =>  'standard-sidebar-right',
        'description'   =>  esc_html__("Appears in the Right side of the site, one enabled.",'petsworld'),
        'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  =>  '</aside>',
        'before_title'  =>  $before_title,
        'after_title'   =>  $after_title));

    // custom widget area
    $widget_area = petsworld_option('widgetarea','custom');
    $widget_area = is_array($widget_area) ? array_unique($widget_area) : array();
    $widget_area = array_filter($widget_area);
    foreach ($widget_area as $key => $value) {
        $id = mb_convert_case($value, MB_CASE_LOWER, "UTF-8");
        $id = str_replace(" ", "-", $id);

        register_sidebar(array(
            'name'          =>  $value,
            'id'            =>  $id,
            'description'   =>  esc_html__("Custom sidebar created in Theme Options.",'petsworld'),
            'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</aside>',
            'before_title'  =>  $before_title,
            'after_title'   =>  $after_title));
    }

    // post archives sidebar
    $layout = petsworld_option('pageoptions','post-archives-page-layout');
    $layout = !empty($layout) ? $layout : "content-full-width";
    switch($layout) :
        case 'with-left-sidebar':
            register_sidebar(array(
                'name'          =>  esc_html__("Post Archives | Left Sidebar",'petsworld'),
                'id'            =>  'post-archives-sidebar-left',
                'description'   =>  esc_html__("Appears in the Left side of Post Archives Page.",'petsworld'),
                'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  =>  '</aside>',
                'before_title'  =>  $before_title,
                'after_title'   =>  $after_title));
        break;

        case 'with-right-sidebar':
            register_sidebar(array(
                'name'          =>  esc_html__("Post Archives | Right Sidebar",'petsworld'),
                'id'            =>  'post-archives-sidebar-right',
                'description'   =>  esc_html__("Appears in the Right side of Post Archives Page.",'petsworld'),
                'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  =>  '</aside>',
                'before_title'  =>  $before_title,
                'after_title'   =>  $after_title));
        break;

        case 'with-both-sidebar':
            register_sidebar(array(
                'name'          =>  esc_html__("Post Archives | Left Sidebar",'petsworld'),
                'id'            =>  'post-archives-sidebar-left',
                'description'   =>  esc_html__("Appears in the Left side of Post Archives Page.",'petsworld'),
                'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  =>  '</aside>',
                'before_title'  =>  $before_title,
                'after_title'   =>  $after_title));

            register_sidebar(array(
                'name'          =>  esc_html__("Post Archives | Right Sidebar",'petsworld'),
                'id'            =>  'post-archives-sidebar-right',
                'description'   =>  esc_html__("Appears in the Right side of Post Archives Page.",'petsworld'),
                'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  =>  '</aside>',
                'before_title'  =>  $before_title,
                'after_title'   =>  $after_title));
        break;
    endswitch;

    // events everywhere sidebar
    if( class_exists('Tribe__Events__Main') ):
        // left sidebar
        register_sidebar(array(
            'name'          =>  esc_html__('Events | Left Sidebar', 'petsworld'),
            'id'            =>  'events-everywhere-sidebar-left',
            'description'   =>  esc_html__("Main sidebar for The Events Calendar pages that appears on the left.",'petsworld'),
            'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</aside>',
            'before_title'  =>  $before_title,
            'after_title'   =>  $after_title));

        // right sidebar
        register_sidebar(array(
            'name'          =>  esc_html__('Events | Right Sidebar', 'petsworld'),
            'id'            =>  'events-everywhere-sidebar-right',
            'description'   =>  esc_html__("Main sidebar for The Events Calendar pages that appears on the right.",'petsworld'),
            'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</aside>',
            'before_title'  =>  $before_title,
            'after_title'   =>  $after_title));
    endif;

    // portfolio archives sidebar
    if( class_exists( 'DTCorePlugin' ) ):

        # Pets
        $layout = petsworld_option('pageoptions','pets-archives-page-layout');
        $layout = !empty($layout) ? $layout : "content-full-width";
        
        switch($layout) :
            case 'with-left-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Pet Archives | Left Sidebar",'petsworld'),
                    'id'            =>  'custom-post-pet-archives-sidebar-left',
                    'description'   =>  esc_html__("Appears in the Left side of Pet Archives Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;

            case 'with-right-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Pet Archives | Right Sidebar",'petsworld'),
                    'id'            =>  'custom-post-pet-archives-sidebar-right',
                    'description'   =>  esc_html__("Appears in the Right side of Pet Archives Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;

            case 'with-both-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Pet Archives | Left Sidebar",'petsworld'),
                    'id'            =>  'custom-post-pet-archives-sidebar-left',
                    'description'   =>  esc_html__("Appears in the Left side of Pet Archives Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));

                register_sidebar(array(
                    'name'          =>  esc_html__("Pet Archives | Right Sidebar",'petsworld'),
                    'id'            =>  'custom-post-pet-archives-sidebar-right',
                    'description'   =>  esc_html__("Appears in the Right side of Pet Archives Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;
        endswitch;

        # Pet Sitters
        $layout = petsworld_option('pageoptions','pet-sitter-archives-page-layout');
        $layout = !empty($layout) ? $layout : "content-full-width";
        switch($layout) :
            case 'with-left-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Pet Sitter Archives | Left Sidebar",'petsworld'),
                    'id'            =>  'custom-post-pet-sitter-archives-sidebar-left',
                    'description'   =>  esc_html__("Appears in the Left side of Pet Sitter Archives Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;

            case 'with-right-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Pet Sitter Archives | Right Sidebar",'petsworld'),
                    'id'            =>  'custom-post-pet-sitter-archives-sidebar-right',
                    'description'   =>  esc_html__("Appears in the Right side of Pet Sitter Archives Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;

            case 'with-both-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Pet Sitter Archives | Left Sidebar",'petsworld'),
                    'id'            =>  'custom-post-pet-sitter-archives-sidebar-left',
                    'description'   =>  esc_html__("Appears in the Left side of Pet Sitter Archives Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));

                register_sidebar(array(
                    'name'          =>  esc_html__("Pet Sitter Archives | Right Sidebar",'petsworld'),
                    'id'            =>  'custom-post-pet-sitter-archives-sidebar-right',
                    'description'   =>  esc_html__("Appears in the Right side of Pet Sitter Archives Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;
        endswitch;
    
        # Portfolio
        $layout = petsworld_option('pageoptions','portfolio-archives-page-layout');
        $layout = !empty($layout) ? $layout : "content-full-width";
        switch($layout) :
            case 'with-left-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Portfolio Archives | Left Sidebar",'petsworld'),
                    'id'            =>  'custom-post-portfolio-archives-sidebar-left',
                    'description'   =>  esc_html__("Appears in the Left side of Portfolio Archives Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;

            case 'with-right-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Portfolio Archives | Right Sidebar",'petsworld'),
                    'id'            =>  'custom-post-portfolio-archives-sidebar-right',
                    'description'   =>  esc_html__("Appears in the Right side of Portfolio Archives Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;

            case 'with-both-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Portfolio Archives | Left Sidebar",'petsworld'),
                    'id'            =>  'custom-post-portfolio-archives-sidebar-left',
                    'description'   =>  esc_html__("Appears in the Left side of Portfolio Archives Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));

                register_sidebar(array(
                    'name'          =>  esc_html__("Portfolio Archives | Right Sidebar",'petsworld'),
                    'id'            =>  'custom-post-portfolio-archives-sidebar-right',
                    'description'   =>  esc_html__("Appears in the Right side of Portfolio Archives Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;
        endswitch;
    endif;

    // shop everywhere sidebar
    if( class_exists('woocommerce') ):
        // left sidebar
        register_sidebar(array(
            'name'          =>  esc_html__('Shop | Left Sidebar', 'petsworld'),
            'id'            =>  'shop-everywhere-sidebar-left',
            'description'   =>  esc_html__("Main sidebar for The Shop pages that appears on the left.",'petsworld'),
            'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</aside>',
            'before_title'  =>  $before_title,
            'after_title'   =>  $after_title));

        // right sidebar
        register_sidebar(array(
            'name'          =>  esc_html__('Shop | Right Sidebar', 'petsworld'),
            'id'            =>  'shop-everywhere-sidebar-right',
            'description'   =>  esc_html__("Main sidebar for The Shop pages that appears on the right.",'petsworld'),
            'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</aside>',
            'before_title'  =>  $before_title,
            'after_title'   =>  $after_title));

        // custom left sidebars for product
        $layout = petsworld_option('woo','product-layout');
        $layout = !empty($layout) ? $layout : "content-full-width";
        switch($layout) :
            case 'with-left-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Product Detail | Left Sidebar", 'petsworld'),
                    'id'            =>  "product-detail-sidebar-left",
                    'description'   =>  esc_html__("Appears in the Left side of Product details Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;

            case 'with-right-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Product Detail | Right Sidebar", 'petsworld'),
                    'id'            =>  "product-detail-sidebar-right",
                    'description'   =>  esc_html__("Appears in the Right side of Product details Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;

            case 'with-both-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Product Detail | Left Sidebar", 'petsworld'),
                    'id'            =>  "product-detail-sidebar-left",
                    'description'   =>  esc_html__("Appears in the Left side of Product details Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));

                register_sidebar(array(
                    'name'          =>  esc_html__("Product Detail | Right Sidebar", 'petsworld'),
                    'id'            =>  "product-detail-sidebar-right",
                    'description'   =>  esc_html__("Appears in the Right side of Product details Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;
        endswitch;

        // custom left sidebars for product category
        $layout = petsworld_option('woo','product-category-layout');
        $layout = !empty($layout) ? $layout : "content-full-width";
        switch($layout) :
            case 'with-left-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Product Category | Left Sidebar", 'petsworld'),
                    'id'            =>  "product-category-sidebar-left",
                    'description'   =>  esc_html__("Appears on Left side of Product Category Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;

            case 'with-right-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Product Category | Right Sidebar", 'petsworld'),
                    'id'            =>  "product-category-sidebar-right",
                    'description'   =>  esc_html__("Appears on Right side of Product Category Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;

            case 'with-both-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Product Category | Left Sidebar", 'petsworld'),
                    'id'            =>  "product-category-sidebar-left",
                    'description'   =>  esc_html__("Appears on Left side of Product Category Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));

                register_sidebar(array(
                    'name'          =>  esc_html__("Product Category | Right Sidebar", 'petsworld'),
                    'id'            =>  "product-category-sidebar-right",
                    'description'   =>  esc_html__("Appears on Right side of Product Category Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;
        endswitch;

        // custom left sidebars for product tag
        $layout = petsworld_option('woo','product-tag-layout');
        $layout = !empty($layout) ? $layout : "content-full-width";
        switch($layout) :
            case 'with-left-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Product Tag | Left Sidebar", 'petsworld'),
                    'id'            =>  "product-tag-sidebar-left",
                    'description'   =>  esc_html__("Appears on Left side of Product Tag Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;

            case 'with-right-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Product Tag | Right Sidebar", 'petsworld'),
                    'id'            =>  "product-tag-sidebar-right",
                    'description'   =>  esc_html__("Appears on Right side of Product Tag Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;

            case 'with-both-sidebar':
                register_sidebar(array(
                    'name'          =>  esc_html__("Product Tag | Left Sidebar", 'petsworld'),
                    'id'            =>  "product-tag-sidebar-left",
                    'description'   =>  esc_html__("Appears on Left side of Product Tag Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));

                register_sidebar(array(
                    'name'          =>  esc_html__("Product Tag | Right Sidebar", 'petsworld'),
                    'id'            =>  "product-tag-sidebar-right",
                    'description'   =>  esc_html__("Appears on Right side of Product Tag Page.",'petsworld'),
                    'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  =>  '</aside>',
                    'before_title'  =>  $before_title,
                    'after_title'   =>  $after_title));
            break;
        endswitch;
    endif;

    // footer columnns      
    $footer_columns =  petsworld_option('layout','footer-columns');
    petsworld_footer_widgetarea($footer_columns, $before_title , $after_title);

    /* ---------------------------------------------------------------------------
     * Registering Footer Widget Areas
     * --------------------------------------------------------------------------- */
    function petsworld_footer_widgetarea($count, $before_title , $after_title ) {
        $name = esc_html__( "Footer Column", 'petsworld' );
        if ($count <= 6) :
            for($i = 1; $i <= $count; $i ++) :
                register_sidebar ( array (
                    'name' => $name . "-{$i}",
                    'id' => "footer-sidebar-{$i}",
                    'description' => esc_html__('Appears in the footer section of the site.', 'petsworld'),
                    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                    'after_widget' => '</aside>',
                    'before_title' => $before_title,
                    'after_title' => $after_title
                ) );
            endfor;
         elseif( $count == 14 ):
            $a = array ( "2-6", "1-6", "1-6", "2-6");
            foreach ( $a as $k => $v ) :
                register_sidebar ( array (
                    'name' => $name . "-{$v}",
                    'id' => "footer-sidebar-{$k}-{$v}",
                    'description' => esc_html__('Appears in the footer section of the site.', 'petsworld'),
                    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                    'after_widget' => '</aside>',
                    'before_title' => $before_title,
                    'after_title' => $after_title
                ) );
            endforeach;
         elseif ($count == 12 || $count == 13) :
            $a = array ("1-4", "1-4", "1-2" );
            $a = ($count == 12) ? $a : array_reverse ( $a );
            foreach ( $a as $k => $v ) :
                register_sidebar ( array (
                    'name' => $name . "-{$v}",
                    'id' => "footer-sidebar-{$k}-{$v}",
                    'description' => esc_html__('Appears in the footer section of the site.', 'petsworld'),
                    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                    'after_widget' => '</aside>',
                    'before_title' => $before_title,
                    'after_title' => $after_title
                ) );
            endforeach;
         elseif ($count == 7 || $count == 8) :
            $a = array ("1-4", "3-4");
            $a = ($count == 7) ? $a : array_reverse ( $a );
            foreach ( $a as $k => $v ) :
                register_sidebar ( array (
                    'name' => $name . "-{$v}",
                    'id' => "footer-sidebar-{$k}-{$v}",
                    'description' => esc_html__('Appears in the footer section of the site.', 'petsworld'),
                    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                    'after_widget' => '</aside>',
                    'before_title' => $before_title,
                    'after_title' => $after_title
                ) );
            endforeach;
         elseif ($count == 9 || $count == 10) :
            $a = array ("1-3", "2-3");
            $a = ($count == 9) ? $a : array_reverse ( $a );
            foreach ( $a as $k => $v ) :
                register_sidebar ( array (
                    'name' => $name . "-{$v}",
                    'id' => "footer-sidebar-{$k}-{$v}",
                    'description' => esc_html__('Appears in the footer section of the site.', 'petsworld'),
                    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                    'after_widget' => '</aside>',
                    'before_title' => $before_title,
                    'after_title' => $after_title
                ) );
            endforeach;
        elseif( $count == 11 ):
            $a = array ("1-4", "1-2", "1-4" );
            foreach ( $a as $k => $v ) :
                register_sidebar ( array (
                    'name' => $name . "-{$v}",
                    'id' => "footer-sidebar-{$k}-{$v}",
                    'description' => esc_html__('Appears in the footer section of the site.', 'petsworld'),
                    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                    'after_widget' => '</aside>',
                    'before_title' => $before_title,
                    'after_title' => $after_title
                ) );
            endforeach;         
        endif;
    } ?>