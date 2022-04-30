<?php global $post;
$pet_sitter_settings = get_post_meta ( $post->ID, '_custom_settings', TRUE );
$pet_sitter_settings = is_array ( $pet_sitter_settings ) ? $pet_sitter_settings : array ();
echo '<input type="hidden" name="dt_theme_pet_sitter_meta_nonce" value="'.wp_create_nonce('dt_theme_pet_sitter_nonce').'" />'; ?>

<!-- Price -->
<div class="sub-title custom-box">
    <div class="column one-sixth"><?php 
		esc_html_e( 'Price','petsworld-core');
		if( function_exists('get_woocommerce_currency_symbol') ) {
			
			echo ' ('.get_woocommerce_currency_symbol().')';
		}
		
		$price = array_key_exists ( 'price', $pet_sitter_settings ) ? $pet_sitter_settings ['price'] : '';
	?></div>
    <div class="column five-sixth last">
    	<input name="price" type="text" class="small" value="<?php echo esc_attr($price);?>"/>
    </div>
</div>
<!-- Price -->

<!-- Google -->
<div class="sub-title custom-box">
    <div class="column one-sixth"><?php 
		esc_html_e( 'Google Link','petsworld-core');		
		$google_social_link = array_key_exists ( 'google_social_link', $pet_sitter_settings ) ? $pet_sitter_settings ['google_social_link'] : '';
	?></div>
    <div class="column five-sixth last">
    	<input name="google_social_link" type="text" class="medium" value="<?php echo esc_attr($google_social_link);?>"/>
    </div>
</div>
<!-- Google -->

<!-- Twitter -->
<div class="sub-title custom-box">
    <div class="column one-sixth"><?php 
		esc_html_e( 'Twitter Link','petsworld-core');
		$twitter_social_link = array_key_exists ( 'twitter_social_link', $pet_sitter_settings ) ? $pet_sitter_settings ['twitter_social_link'] : '';
	?></div>
    <div class="column five-sixth last">
    	<input name="twitter_social_link" type="text" class="medium" value="<?php echo esc_attr($twitter_social_link);?>"/>
    </div>
</div>
<!-- Twitter -->

<!-- Facebook  -->
<div class="sub-title custom-box">
    <div class="column one-sixth"><?php 
		esc_html_e( 'Facebook Link','petsworld-core');
		
		$facebook_social_link = array_key_exists ( 'facebook_social_link', $pet_sitter_settings ) ? $pet_sitter_settings ['facebook_social_link'] : '';
	?></div>
    <div class="column five-sixth last">
    	<input name="facebook_social_link" type="text" class="medium" value="<?php echo esc_attr($facebook_social_link);?>"/>
    </div>
</div>
<!-- Twitter -->


<!-- 0. Sub Title -->
<div class="sub-title custom-box">
    <div class="column one-sixth"><?php esc_html_e( 'Title Background','petsworld-core');?></div>
    <div class="column five-sixth last">
        <div class="two-third column image-preview-container" style="width:60%;">
            <?php $subtitlebg = array_key_exists ( 'sub-title-bg', $pet_sitter_settings ) ? $pet_sitter_settings ['sub-title-bg'] : '';?>
            <input name="sub-title-bg" type="text" class="uploadfield medium" readonly="readonly" value="<?php echo esc_attr($subtitlebg);?>"/>
            <input type="button" value="<?php esc_html_e('Upload','petsworld-core');?>" class="upload_image_button show_preview" />
            <input type="button" value="<?php esc_html_e('Remove','petsworld-core');?>" class="upload_image_reset" />
            <?php if( !empty($subtitlebg) ) petsworld_adminpanel_image_preview($subtitlebg );?>
            <p class="note"><?php esc_html_e('Upload an image for the sub title background','petsworld-core');?></p>
        </div>
        <div class="one-eighth column"></div>
        <div class="one-third column last">
            <label><?php esc_html_e('Opacity','petsworld-core');?></label>
            <?php $opacity =  array_key_exists ( "sub-title-opacity", $pet_sitter_settings ) ? $pet_sitter_settings ['sub-title-opacity'] : ''; ?>
            <select name="sub-title-opacity">
                <option value=""><?php esc_html_e("Select",'petsworld-core');?></option>
                <?php foreach( array('1','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9') as $option): ?>
                       <option value="<?php echo esc_attr($option);?>" <?php selected($option,$opacity);?>><?php echo esc_attr($option);?></option>
                <?php endforeach;?>
            </select>
            <p class="note"><?php esc_html_e('Select background color opacity','petsworld-core');?></p>
        </div>    
    </div>
</div>

<div class="sub-title custom-box">
    <div class="column one-sixth"></div>
    <div class="column five-sixth last">
        <div class="column one-third">
            <label><?php esc_html_e('Background Repeat','petsworld-core');?></label>
            <?php $bgrepeat =  array_key_exists ( "sub-title-bg-repeat", $pet_sitter_settings ) ? $pet_sitter_settings ['sub-title-bg-repeat'] : ''; ?>
            <div class="clear"></div>
            <select class="dt-chosen-select" name="sub-title-bg-repeat">
                <option value=""><?php esc_html_e("Select",'petsworld-core');?></option>
                <?php foreach( array('repeat','repeat-x','repeat-y','no-repeat') as $option): ?>
                       <option value="<?php echo esc_attr($option);?>" <?php selected($option,$bgrepeat);?>><?php echo esc_attr($option);?></option>
                <?php endforeach;?>
            </select>
            <p class="note"><?php esc_html_e('Select how would you like to repeat the background image','petsworld-core');?></p>
        </div>

        <div class="column one-third">
            <label><?php esc_html_e('Background Position','petsworld-core');?></label>
            <?php $bgposition =  array_key_exists ( "sub-title-bg-position", $pet_sitter_settings ) ? $pet_sitter_settings ['sub-title-bg-position'] : ''; ?>
            <div class="clear"></div>
            <select class="dt-chosen-select" name="sub-title-bg-position">
                <option value=""><?php esc_html_e('Select','petsworld-core');?></option>
                <?php foreach( array('top left','top center','top right','center left','center center','center right','bottom left','bottom center','bottom right') as $option): ?>
                    <option value="<?php echo esc_attr($option);?>" <?php selected($option,$bgposition);?>> <?php echo esc_attr($option);?></option>
                <?php endforeach;?>
            </select>
            <p class="note"><?php esc_html_e('Select how would you like to position the background','petsworld-core');?></p>
        </div>

        <div class="column one-third last">
        <?php $label = 		esc_html__('Background Color','petsworld-core');
              $name  =		'sub-title-bg-color';
              $value =  	array_key_exists ( 'sub-title-bg-color', $pet_sitter_settings ) ? $pet_sitter_settings ['sub-title-bg-color'] : '';
              $tooltip = 	esc_html__('Select background color for sub title section e.g. #f2d607','petsworld-core'); ?>
              <label><?php echo esc_html($label);?></label>
              <div class="clear"></div>
              <?php petsworld_admin_color_picker("",$name,$value,'');?>
              <p class="note"><?php echo $tooltip;?></p>
        </div>
    </div>
</div><!-- 0. Sub title End-->

<!-- Layout -->
<div id="page-layout" class="custom-box">
    <div class="column one-sixth"><label><?php esc_html_e('Layout','petsworld-core');?> </label></div>
    <div class="column five-sixth last">
        <ul class="bpanel-layout-set"><?php
			$portfolio_layout = array( 'content-full-width'=>'without-sidebar', 'with-left-sidebar'=>'left-sidebar', 'with-right-sidebar'=>'right-sidebar' );
			$v =  array_key_exists("layout",$pet_sitter_settings) ?  $pet_sitter_settings['layout'] : 'content-full-width';
			foreach($portfolio_layout as $key => $value):
				$class = ($key == $v) ? " class='selected' " : "";
				echo "<li><a href='#' rel='{$key}' {$class}><img src='" . plugin_dir_url ( __FILE__ ) . "images/columns/{$value}.png' /></a></li>";
			endforeach;?>
        </ul>
        <input id="dttheme-page-layout" name="layout" type="hidden"  value="<?php echo esc_attr($v);?>"/>
        <p class="note"> <?php esc_html_e("You can choose between a left, right or no sidebar layout.",'petsworld-core');?> </p>
    </div>
</div><!-- Layout End-->
<?php 
 $sb_layout = array_key_exists("layout",$pet_sitter_settings) ? $pet_sitter_settings['layout'] : 'content-full-width';
 $sidebar_both = $sidebar_left = $sidebar_right = '';
 if($sb_layout == 'content-full-width') {
	$sidebar_both = 'style="display:none;"'; 
 } elseif($sb_layout == 'with-left-sidebar') {
	$sidebar_right = 'style="display:none;"'; 
 } elseif($sb_layout == 'with-right-sidebar') {
	$sidebar_left = 'style="display:none;"'; 
 } 
?>
<div id="widget-area-options" <?php echo $sidebar_both;?>>
	<div id="left-sidebar-container" class="page-left-sidebar" <?php echo $sidebar_left; ?>>
		<!-- 2. Standard Sidebar Left Start -->
		<div id="page-commom-sidebar" class="sidebar-section custom-box">
			<div class="column one-sixth"><label><?php esc_html_e('Show Standard Left Sidebar','petsworld-core');?></label></div>
			<div class="column five-sixth last"><?php 
				$switchclass = array_key_exists("show-standard-sidebar-left",$pet_sitter_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
				$checked = array_key_exists("show-standard-sidebar-left",$pet_sitter_settings) ? ' checked="checked"' : '';?>
				
				<div data-for="dttheme-show-standard-sidebar-left" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
				<input id="dttheme-show-standard-sidebar-left" class="hidden" type="checkbox" name="show-standard-sidebar-left" value="true" <?php echo $checked;?>/>
				<p class="note"> <?php esc_html_e('Yes! to show "Standard Left Sidebar" on this page.','petsworld-core');?> </p>
			 </div>
		</div><!-- Standard Sidebar Left End-->

		<!-- 3. Choose Widget Areas Start -->
		<div id="page-sidebars" class="sidebar-section custom-box page-widgetareas">
			<div class="column one-sixth"><label><?php esc_html_e('Choose Widget Area - Left Sidebar','petsworld-core');?></label></div>
			<div class="column five-sixth last"><?php
				$widgetareas = array_key_exists("widget-area-left",$pet_sitter_settings) ? array_unique($pet_sitter_settings["widget-area-left"]) : array();
				$widgets = petsworld_option('widgetarea','custom');?>
				<select class="dt-chosen-select" name="dttheme[widgetareas-left][]" multiple="multiple" data-placeholder="<?php esc_attr_e('Select Widget Area', 'petsworld-core');?>"><?php
					echo "<option value=''></option>";
					foreach ( $widgets as $widget ) :
						$id = mb_convert_case($widget, MB_CASE_LOWER, "UTF-8");
						$id = str_replace(" ", "-", $id);
						$selected = in_array( $id , $widgetareas ) ? " selected='selected' " : "";
						echo "<option value='{$id}' {$selected}>{$widget}</option>";
					endforeach;?>
				</select>
			</div>
		</div><!-- Choose Widget Areas End -->
	</div>
	<div id="right-sidebar-container" class="page-right-sidebar" <?php echo $sidebar_right; ?>>
		<!-- 3. Standard Sidebar Right Start -->
		<div id="page-commom-sidebar" class="sidebar-section custom-box page-right-sidebar">
			<div class="column one-sixth"><label><?php esc_html_e('Show Standard Right Sidebar','petsworld-core');?></label></div>
			<div class="column five-sixth last"><?php 
				$switchclass = array_key_exists("show-standard-sidebar-right",$pet_sitter_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
				$checked = array_key_exists("show-standard-sidebar-right",$pet_sitter_settings) ? ' checked="checked"' : '';?>
				
				<div data-for="dttheme-show-standard-sidebar-right" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
				<input id="dttheme-show-standard-sidebar-right" class="hidden" type="checkbox" name="show-standard-sidebar-right" value="true" <?php echo $checked;?>/>
				<p class="note"> <?php esc_html_e('Yes! to show "Standard Right Sidebar" on this page.','petsworld-core');?> </p>
			 </div>
		</div><!-- Standard Sidebar Right End-->

		<!-- 3. Choose Widget Areas Start -->
		<div id="page-sidebars" class="sidebar-section custom-box page-widgetareas">
			<div class="column one-sixth"><label><?php esc_html_e('Choose Widget Area - Right Sidebar','petsworld-core');?></label></div>
			<div class="column five-sixth last"><?php
				$widgetareas = array_key_exists("widget-area-right",$pet_sitter_settings) ? array_unique($pet_sitter_settings["widget-area-right"]) : array();
				$widgets = petsworld_option('widgetarea','custom');?>
				<select class="dt-chosen-select" name="dttheme[widgetareas-right][]" multiple="multiple" data-placeholder="<?php esc_attr_e('Select Widget Area', 'petsworld-core');?>"><?php
					echo "<option value=''></option>";
					foreach ( $widgets as $widget ) :
						$id = mb_convert_case($widget, MB_CASE_LOWER, "UTF-8");
						$id = str_replace(" ", "-", $id);
						$selected = in_array( $id , $widgetareas ) ? " selected='selected' " : "";
						echo "<option value='{$id}' {$selected}>{$widget}</option>";
					endforeach;?>
				</select>
			</div>
		</div><!-- Choose Widget Areas End -->
	</div>
</div>

<!-- Medias -->
<div class="custom-box" style="display:none;">
	<div class="column one-sixth">
		<label><?php esc_html_e('Images','petsworld-core');?> </label>
	</div>
	<div class="column five-sixth last">
		<div class="dt-media-btns-container">
			<a href="#" class="dt-open-media button button-primary"><?php esc_html_e( 'Click Here to Add Images', 'petsworld-core' );?> </a>
			<a href="#" class="hidden dt-add-video button button-primary"><?php esc_html_e( 'Click Here to Add Video', 'petsworld-core' );?> </a>
		</div>
		<div class="clear"></div>

		<div class="dt-media-container">
			<ul class="dt-items-holder"><?php
			if (array_key_exists ( "items", $pet_sitter_settings )) {
				foreach ( $pet_sitter_settings ["items_thumbnail"] as $key => $thumbnail ) {
					$item = $pet_sitter_settings ['items'] [$key];
					$out = "";
					$name = "";
					$foramts = array ( 'jpg', 'jpeg', 'gif', 'png');
					$parts = explode ( '.', $item );
					$ext = strtolower ( $parts [count ( $parts ) - 1] );
					if (in_array ( $ext, $foramts )) {
						$name = $pet_sitter_settings ['items_name'] [$key];
						$out .= "<li>";
						$out .= "<img src='{$thumbnail}' alt='' />";
						$out .= "<span class='dt-image-name'>{$name}</span>";
						$out .= "<input type='hidden' name='items[]' value='{$item}' />";
					} else {
						$name = "video";
						$out .= "<li>";
						$out .= "<span class='dt-video'></span>";
						$out .= "<input type='text' name='items[]' value='{$item}' />";
					}
					
					$out .= "<input class='dt-image-name' type='hidden' name='items_name[]' value='{$name}' />";
					$out .= "<input type='hidden' name='items_thumbnail[]' value='{$thumbnail}' />";
					$out .= "<span class='my_delete'></span>";
					$out .= "</li>";
					echo $out;
				}
			}
			?></ul>
		</div>
	</div>
</div><!-- Medias End -->