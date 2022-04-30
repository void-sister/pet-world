<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php petsworld_viewport(); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php wp_head(); ?>
</head>
<?php $bg = petsworld_option('pageoptions','comingsoon-bg');
$opacity = petsworld_opts_get('comingsoon-bg-opacity', '1');
$position = petsworld_opts_get('comingsoon-bg-position', 'center center');
$repeat = petsworld_opts_get('comingsoon-bg-repeat', 'no-repeat');
$color = petsworld_option('pageoptions','comingsoon-bg-color');
$showcolor = petsworld_option('pageoptions','show-comingsoon-bg-color');

$estyle = petsworld_option('pageoptions','comingsoon-bg-style');

$color = !empty($color) ? petsworld_hex2rgb($color) : array('f', 'f', 'f');
$style = !empty($bg) ? "background:url($bg) $position $repeat;" : '';
$style .= (!empty($color) && isset($showcolor) ) ? "background-color:rgba(  $color[0],  $color[1],  $color[2], {$opacity});" : '';
$style .= !empty($estyle) ? $estyle : ''; ?>

<body <?php body_class(); ?> style="<?php echo esc_attr($style); ?>">

<div class="wrapper"><?php
	$pageid = petsworld_option('pageoptions','comingsoon-pageid');
	if( !empty($pageid) ):
		$page = get_post( $pageid, ARRAY_A );
		echo DTCoreShortcodesDefination::dtShortcodeHelper ( stripslashes($page['post_content']) );
	endif; ?>
</div>
<?php wp_footer(); ?>
</body>
</html>