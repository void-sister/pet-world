<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php petsworld_viewport(); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php wp_head(); ?>
</head>
<?php $bg = petsworld_option('pageoptions','notfound-bg');
$opacity = petsworld_opts_get('notfound-bg-opacity', '1');
$position = petsworld_opts_get('notfound-bg-position', 'center center');
$repeat = petsworld_opts_get('notfound-bg-repeat', 'no-repeat');
$color = petsworld_option('pageoptions','notfound-bg-color');

$estyle = petsworld_option('pageoptions','notfound-bg-style');
$color = !empty($color) ? petsworld_hex2rgb($color) : array('f', 'f', 'f');
$style = !empty($bg) ? "background:url($bg) $position $repeat;" : '';
$style .= !empty($color) ? "background-color:rgba(  $color[0] ,  $color[1],  $color[2], {$opacity});" : '';
$style .= !empty($estyle) ? $estyle : ''; ?>

<body <?php body_class(); ?> style="<?php echo esc_attr($style); ?>">

<div class="wrapper">
	<div class="container">
		<div class="center-content-wrapper">
			<div class="center-content"><?php
				$pageid = petsworld_option('pageoptions','notfound-pageid');
				if( petsworld_option('pageoptions','enable-404message') && !empty($pageid) ):
					$page = get_post( $pageid, ARRAY_A );
					echo DTCoreShortcodesDefination::dtShortcodeHelper ( stripslashes($page['post_content']) );
				elseif( petsworld_option('pageoptions','enable-404message') ):
					echo '<h2>'.esc_html__('404 - Page Not Found', 'petsworld').'</h2>';
					echo '<h5>'.esc_html__('The Page you are looking for is not found or does not exist.', 'petsworld').'</h5>';
					echo '<a class="dt-sc-button small icon-right with-icon rounded-corner type2" target="_self" href="'.esc_url(home_url('/')).'">'.esc_html__('Back to Home','petsworld').' <span class="fa fa-home"> </span></a>';
				endif;?>
            </div>                
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>