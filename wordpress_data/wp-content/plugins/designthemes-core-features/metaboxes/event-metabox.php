<?php
	#Event Meta Box
	add_action("add_meta_boxes", "petsworld_event_metabox");
	add_action('save_post','petsworld_event_meta_save');
	function petsworld_event_metabox(){
		add_meta_box("event-template-meta-container", __('Event Options', 'petsworld'), "petsworld_event_settings","tribe_events", "normal", "high");
	}

	function petsworld_event_settings($args){
		global $post;
		$tpl_default_settings = get_post_meta($post->ID,'_custom_settings',TRUE);
		$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();
		echo '<input type="hidden" name="dt_theme_event_meta_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';?>

        <!-- 0. Sub Title -->
        <div class="sub-title custom-box">
            <div class="column one-sixth"><?php _e( 'Title Background','petsworld');?></div>
            <div class="column five-sixth last">
                <div class="two-third column image-preview-container" style="width:60%;">
                    <?php $subtitlebg = array_key_exists ( 'sub-title-bg', $tpl_default_settings ) ? $tpl_default_settings ['sub-title-bg'] : '';?>
                    <input name="sub-title-bg" type="text" class="uploadfield medium" readonly="readonly" value="<?php echo esc_attr($subtitlebg);?>"/>
                    <input type="button" value="<?php esc_attr_e('Upload','petsworld');?>" class="upload_image_button show_preview" />
                    <input type="button" value="<?php esc_attr_e('Remove','petsworld');?>" class="upload_image_reset" />
                    <?php if( !empty($subtitlebg) ) petsworld_adminpanel_image_preview($subtitlebg );?>
                    <p class="note"><?php _e('Upload an image for the sub title background','petsworld');?></p>
                </div>
				<div class="one-eighth column"></div>
                <div class="one-third column last">
                    <label><?php _e('Opacity','petsworld');?></label>
                    <?php $opacity =  array_key_exists ( "sub-title-opacity", $tpl_default_settings ) ? $tpl_default_settings ['sub-title-opacity'] : ''; ?>
                    <select name="sub-title-opacity">
                        <option value=""><?php _e("Select",'petsworld');?></option>
                        <?php foreach( array('1','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9') as $option): ?>
                               <option value="<?php echo esc_attr($option);?>" <?php selected($option,$opacity);?>><?php echo esc_attr($option);?></option>
                        <?php endforeach;?>
                    </select>
                    <p class="note"><?php _e('Select background color opacity','petsworld');?></p>
                </div>    
            </div>
        </div>

        <div class="sub-title custom-box">
            <div class="column one-sixth"></div>
            <div class="column five-sixth last">
                <div class="column one-third">
                    <label><?php _e('Background Repeat','petsworld');?></label>
                    <?php $bgrepeat =  array_key_exists ( "sub-title-bg-repeat", $tpl_default_settings ) ? $tpl_default_settings ['sub-title-bg-repeat'] : ''; ?>
                    <div class="clear"></div>
                    <select class="dt-chosen-select" name="sub-title-bg-repeat">
                        <option value=""><?php _e("Select",'petsworld');?></option>
                        <?php foreach( array('repeat','repeat-x','repeat-y','no-repeat') as $option): ?>
                               <option value="<?php echo esc_attr($option);?>" <?php selected($option,$bgrepeat);?>><?php echo esc_attr($option);?></option>
                        <?php endforeach;?>
                    </select>
                    <p class="note"><?php _e('Select how would you like to repeat the background image','petsworld');?></p>
                </div>

                <div class="column one-third">
                    <label><?php _e('Background Position','petsworld');?></label>
                    <?php $bgposition =  array_key_exists ( "sub-title-bg-position", $tpl_default_settings ) ? $tpl_default_settings ['sub-title-bg-position'] : ''; ?>
                    <div class="clear"></div>
                    <select class="dt-chosen-select" name="sub-title-bg-position">
                        <option value=""><?php _e('Select','petsworld');?></option>
                        <?php foreach( array('top left','top center','top right','center left','center center','center right','bottom left','bottom center','bottom right') as $option): ?>
                            <option value="<?php echo esc_attr($option);?>" <?php selected($option,$bgposition);?>> <?php echo esc_attr($option);?></option>
                        <?php endforeach;?>
                    </select>
                    <p class="note"><?php _e('Select how would you like to position the background','petsworld');?></p>
                </div>

                <div class="column one-third last">
                <?php $label = 		__('Background Color','petsworld');
                      $name  =		'sub-title-bg-color';
                      $value =  	array_key_exists ( 'sub-title-bg-color', $tpl_default_settings ) ? $tpl_default_settings ['sub-title-bg-color'] : '';
                      $tooltip = 	__('Select background color for sub title section e.g. #f2d607','petsworld'); ?>
                      <label><?php echo ( $label );?></label>
                      <div class="clear"></div>
                      <?php petsworld_admin_color_picker("",$name,$value,'');?>
                      <p class="note"><?php echo ( $tooltip );?></p>
                </div>
            </div>
        </div><!-- 0. Sub title End-->

        <!-- Layout Start -->
        <div id="page-layout" class="custom-box">
			<div class="column one-sixth">                        
                <label><?php _e('Layout', 'petsworld');?> </label>
            </div>
			<div class="column five-sixth last">  
                <ul class="bpanel-layout-set"><?php
                	$homepage_layout = array( 'content-full-width'=>'without-sidebar', 'with-left-sidebar'=>'left-sidebar', 'with-right-sidebar'=>	'right-sidebar', 'with-both-sidebar'=>'both-sidebar');
					$v =  array_key_exists("layout",$tpl_default_settings) ?  $tpl_default_settings['layout'] : 'content-full-width';
					foreach($homepage_layout as $key => $value):
						$class = ($key == $v) ? " class='selected' " : "";
						echo "<li><a href='#' rel='{$key}' {$class}><img src='" . PETSWORLD_THEME_URI . "/framework/theme-options/images/columns/{$value}.png' /></a></li>";
					endforeach;?>
                </ul>
                <?php $v = array_key_exists("layout",$tpl_default_settings) ? $tpl_default_settings['layout'] : 'content-full-width';?>
                <input id="dttheme-event-layout" name="layout" type="hidden" value="<?php echo esc_attr($v);?>"/>
                <p class="note"> <?php _e("You can choose between a left, right or no sidebar layout.", 'petsworld');?> </p>
            </div>
        </div><!-- Layout End-->
    
		<?php 
         $sb_layout = array_key_exists("layout",$tpl_default_settings) ? $tpl_default_settings['layout'] : 'content-full-width';
         $sidebar_both = $sidebar_left = $sidebar_right = '';
         if($sb_layout == 'content-full-width') {
            $sidebar_both = 'style="display:none;"'; 
         } elseif($sb_layout == 'with-left-sidebar') {
            $sidebar_right = 'style="display:none;"'; 
         } elseif($sb_layout == 'with-right-sidebar') {
            $sidebar_left = 'style="display:none;"'; 
         } 
        ?>
        <div id="widget-area-options" <?php echo ($sidebar_both);?>>
            
            <div id="left-sidebar-container" class="page-left-sidebar" <?php echo ($sidebar_left); ?>>
                <!-- 2. Standard Sidebar Left Start -->
                <div id="page-commom-sidebar" class="sidebar-section custom-box">
                    <div class="column one-sixth"><label><?php _e('Show Standard Left Sidebar', 'petsworld');?></label></div>
                    <div class="column five-sixth last"><?php
                        $switchclass = array_key_exists("show-standard-sidebar-left",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                        $checked = array_key_exists("show-standard-sidebar-left",$tpl_default_settings) ? ' checked="checked"' : '';
						if(empty($tpl_default_settings) || array_key_exists("show-standard-sidebar-left",$tpl_default_settings)) {
						  $switchclass = 'checkbox-switch-on'; $checked = ' checked="checked"';
						}?>
                        <div data-for="dttheme-show-standard-sidebar-left" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                        <input id="dttheme-show-standard-sidebar-left" class="hidden" type="checkbox" name="show-standard-sidebar-left" value="true" <?php echo ($checked);?>/>
                        <p class="note"> <?php _e('Yes! to show "Standard Left Sidebar" on this page.', 'petsworld');?> </p>
                     </div>
                </div><!-- Standard Sidebar Left End-->

                <!-- 3. Choose Widget Areas Start -->
                <div id="page-sidebars" class="sidebar-section custom-box page-widgetareas">
                    <div class="column one-sixth"><label><?php _e('Choose Widget Area - Left Sidebar', 'petsworld');?></label></div>
                    <div class="column five-sixth last"><?php
                        $widgetareas = array_key_exists("widget-area-left",$tpl_default_settings) ? array_unique($tpl_default_settings["widget-area-left"]) : array();
                        $widgets = petsworld_option('widgetarea','custom');?>
                        <select class="dt-chosen-select" name="dttheme[widgetareas-left][]" multiple="multiple" data-placeholder="<?php esc_attr_e('Select Widget Area', 'petsworld');?>"><?php
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

            <div id="right-sidebar-container" class="page-right-sidebar" <?php echo ($sidebar_right); ?>>
                <!-- 3. Standard Sidebar Right Start -->
                <div id="page-commom-sidebar" class="sidebar-section custom-box page-right-sidebar">
                    <div class="column one-sixth"><label><?php _e('Show Standard Right Sidebar', 'petsworld');?></label></div>
                    <div class="column five-sixth last"><?php 
                        $switchclass = array_key_exists("show-standard-sidebar-right",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                        $checked = array_key_exists("show-standard-sidebar-right",$tpl_default_settings) ? ' checked="checked"' : '';
						if(empty($tpl_default_settings) || array_key_exists("show-standard-sidebar-right",$tpl_default_settings)) {
						  $switchclass = 'checkbox-switch-on'; $checked = ' checked="checked"';
						}?>
                        <div data-for="dttheme-show-standard-sidebar-right" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                        <input id="dttheme-show-standard-sidebar-right" class="hidden" type="checkbox" name="show-standard-sidebar-right" value="true" <?php echo ($checked);?>/>
                        <p class="note"> <?php _e('Yes! to show "Standard Right Sidebar" on this page.', 'petsworld');?> </p>
                     </div>
                </div><!-- Standard Sidebar Right End-->
                
                <!-- 3. Choose Widget Areas Start -->
                <div id="page-sidebars" class="sidebar-section custom-box page-widgetareas">
                    <div class="column one-sixth"><label><?php _e('Choose Widget Area - Right Sidebar', 'petsworld');?></label></div>
                    <div class="column five-sixth last"><?php
                        $widgetareas = array_key_exists("widget-area-right",$tpl_default_settings) ? array_unique($tpl_default_settings["widget-area-right"]) : array();
                        $widgets = petsworld_option('widgetarea','custom');?>
                        <select class="dt-chosen-select" name="dttheme[widgetareas-right][]" multiple="multiple" data-placeholder="<?php esc_attr_e('Select Widget Area', 'petsworld');?>"><?php
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

        <!-- Event Style-->
        <div class="custom-box">
            <div class="column one-sixth">
                <label><?php _e('Post Style','petsworld');?></label>
            </div>
            <div class="column five-sixth last"> 
                <select name="dttheme-event-post-style" class="dt-chosen-select">
                    <?php $selected = 	array_key_exists("event-post-style",$tpl_default_settings) ?  $tpl_default_settings['event-post-style'] : ''; ?>
                    <?php	$event_styles =  array( 
                              'type1' => __('Type 1','petsworld'),
                              'type2' => __('Type 2','petsworld'),
                              'type3' => __('Type 3','petsworld'),
                              'type4' => __('Type 4','petsworld'),
                              'type5' => __('Type 5','petsworld')
                          );
                          foreach( $event_styles as $es => $bv ):
                              echo "<option value='{$es}'".selected($selected,$es,false).">{$bv}</option>";
                          endforeach;?>
                </select>
                <p class="note"> <?php _e("Your event post page show at most selected style.",'petsworld');?> </p>
            </div>
        </div><!-- Event Style End-->
		
		<?php
		wp_reset_postdata();
    }

	function petsworld_event_meta_save($post_id){

		if( key_exists ( '_inline_edit',$_POST )) :
			if ( wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce')) return;
		endif;

		if( key_exists( 'dt_theme_post_meta_nonce',$_POST ) ) :
			if ( ! wp_verify_nonce( $_POST['dt_theme_post_meta_nonce'], basename(__FILE__) ) ) return;
		endif;
	 
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	 
		if (!current_user_can('edit_post', $post_id)) :
			return;
		endif;
	 
		if ( (key_exists('post_type', $_POST)) && ('tribe_events' == $_POST['post_type']) ) :

			$layout = isset($_POST['layout']) ? $_POST['layout'] : "";
			$settings = array();
			$settings['layout'] = $layout;
			
			$settings['sub-title-bg'] = isset ( $_POST['sub-title-bg'] ) ? $_POST['sub-title-bg'] : "";
			$settings['sub-title-bg-repeat'] = isset ( $_POST['sub-title-bg-repeat'] ) ? $_POST['sub-title-bg-repeat'] : "";
			$settings['sub-title-opacity'] = isset ( $_POST['sub-title-opacity'] ) ? $_POST['sub-title-opacity'] : "";
			$settings['sub-title-bg-position'] = isset ( $_POST['sub-title-bg-position'] ) ? $_POST['sub-title-bg-position'] : "";
			$settings['sub-title-bg-color'] = isset ( $_POST['sub-title-bg-color'] ) ? $_POST['sub-title-bg-color'] : "";
	
			if( $layout == 'with-both-sidebar') {
				$settings['show-standard-sidebar-left'] = isset( $_POST['show-standard-sidebar-left'] ) ? $_POST['show-standard-sidebar-left'] : '';
				$settings['show-standard-sidebar-right'] = isset( $_POST['show-standard-sidebar-right'] ) ? $_POST['show-standard-sidebar-right'] : '';
				$settings['widget-area-left'] = isset( $_POST['dttheme']['widgetareas-left'] ) ? array_unique(array_filter($_POST['dttheme']['widgetareas-left'])) : '';
				$settings['widget-area-right'] =  isset( $_POST['dttheme']['widgetareas-right'] ) ? array_unique(array_filter($_POST['dttheme']['widgetareas-right'])) : '';
			} elseif( $layout == 'with-left-sidebar') {
				$settings['show-standard-sidebar-left'] = isset( $_POST['show-standard-sidebar-left'] ) ? $_POST['show-standard-sidebar-left'] : '';
				$settings['widget-area-left'] =  isset( $_POST['dttheme']['widgetareas-left'] ) ? array_unique(array_filter($_POST['dttheme']['widgetareas-left'])) : '';
			} elseif( $layout == 'with-right-sidebar') {
				$settings['show-standard-sidebar-right'] = isset($_POST['show-standard-sidebar-right']) ? $_POST['show-standard-sidebar-right'] :'';
				$settings['widget-area-right'] =  isset($_POST['dttheme']['widgetareas-right']) ? array_unique(array_filter($_POST['dttheme']['widgetareas-right'])) :'';
			}
	
			$settings['event-post-style'] = isset ( $_POST['dttheme-event-post-style'] ) ? $_POST['dttheme-event-post-style'] : "";
	
			update_post_meta($post_id, "_custom_settings", array_filter($settings));
		endif;			
	}?>