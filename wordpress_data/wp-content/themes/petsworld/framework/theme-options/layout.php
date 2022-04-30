<!--layout -->
<div id="layout" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel"> 
            <li><a href="#tab1"><?php esc_html_e('General', 'petsworld'); ?></a></li>
            <li><a href="#tab2"><?php esc_html_e('Header', 'petsworld'); ?></a></li>
			<li><a href="#tab3"><?php esc_html_e('Menu', 'petsworld'); ?></a></li>
            <li><a href="#tab4"><?php esc_html_e('Sociable', 'petsworld'); ?></a></li>
            <li><a href="#tab5"><?php esc_html_e('Footer', 'petsworld'); ?></a></li>
            <li><a href="#tab6"><?php esc_html_e('Custom Css &amp; Js', 'petsworld'); ?></a></li>
        </ul>

        <!--tab1-general -->
        <div id="tab1" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Logo', 'petsworld'); ?></h3>
                </div>
                
                <div class="box-content">
                    <div class="column three-fifth">
                        <div class="bpanel-option-set"><?php
							$logo = array( 'id'=> 'logo',
			                               'options'=> array( 'true'	=> esc_html__('Custom Image Logo', 'petsworld'),
										   					  ''=> 	esc_html__('Display Site Title', 'petsworld').' <small><a href="'.esc_url("options-general.php").'">(click here to edit site title)</a></small>'));
							$output = "";
							$i = 0;
							foreach($logo['options'] as $key => $option):
								$checked = ( $key ==  petsworld_option('layout',$logo['id']) ) ? ' checked="checked"' : '';
								$output .= "<label><input type='radio' name='dttheme[layout][$logo[id]]' value='{$key}' $checked />$option</label>";
								if($i == 0):
									$output .='<div class="clear"></div>';
								endif;
							$i++;
							endforeach;
							echo "{$output}";?>
                        </div>
                    </div>
                    <div class="column two-fifth last">
                        <p class="note"><?php esc_html_e('You can choose whether you wish to display a custom logo or your site title.', 'petsworld'); ?></p>
                    </div>
                    <div class="hr"> </div>
                    <div class="clear"></div>

                    <h6><?php esc_html_e('Logo', 'petsworld'); ?></h6>
                    <div class="image-preview-container">
                        <input id="dttheme-logo" name="dttheme[layout][logo-url]" type="text" class="uploadfield" readonly="readonly" value="<?php echo petsworld_option('layout','logo-url'); ?>" />
                        <input type="button" value="<?php esc_attr_e('Upload', 'petsworld'); ?>" class="upload_image_button show_preview" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'petsworld'); ?>" class="upload_image_reset" />
                        <?php petsworld_adminpanel_image_preview(petsworld_option('layout','logo-url'),false,'logo.png'); ?>
                    </div>
                    <p class="note"><?php esc_html_e('Upload a logo for your theme, or specify the image url of your on-line logo.', 'petsworld'); ?></p>
                    <div class="hr"></div>
                    <div class="clear"></div>

                    <h6><?php esc_html_e('Retina Logo', 'petsworld'); ?></h6>
                    <div class="image-preview-container">
                        <input id="dttheme-retina-logo" name="dttheme[layout][retina-logo-url]" type="text" class="uploadfield" readonly="readonly" value="<?php echo petsworld_option('layout','retina-logo-url'); ?>"/>
                        <input type="button" value="<?php esc_attr_e('Upload', 'petsworld'); ?>" class="upload_image_button show_preview" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'petsworld'); ?>" class="upload_image_reset" />
                        <?php petsworld_adminpanel_image_preview(petsworld_option('layout','retina-logo-url'),false,'logo@2x.png'); ?>
                    </div>
                    <p class="note"><?php esc_html_e('Upload a retina logo for your theme, or specify the image url of your on-line logo.', 'petsworld'); ?></p>
                    <div class="clear"></div>

                    <div class="one-half-content">
                        <h6><?php esc_html_e('Width', 'petsworld'); ?></h6>
                        <input type="text" class="medium" name="dttheme[layout][retina-logo-width]" value="<?php echo petsworld_option('layout','retina-logo-width'); ?>" />
                        <?php esc_html_e('px', 'petsworld'); ?>
                    </div>
  
                    <div class="one-half-content last">
                        <h6><?php esc_html_e('Height', 'petsworld'); ?></h6>
                        <input type="text" class="medium" name="dttheme[layout][retina-logo-height]" value="<?php echo petsworld_option('layout','retina-logo-height'); ?>"/>
                        <?php esc_html_e('px', 'petsworld'); ?>
                    </div>
                    <p class="note"><?php esc_html_e('If retina logo is uploaded, enter the standard logo width and height in above respective boxes.', 'petsworld'); ?></p>
                    <div class="clear"></div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->
            
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Favicon', 'petsworld'); ?></h3>
                </div>
                
                <div class="box-content">
                    <h6><?php esc_html_e('Custom Favicon', 'petsworld'); ?></h6>
                    <div class="image-preview-container">
                        <input id="dttheme-favicon" name="dttheme[layout][favicon-url]" type="text" class="uploadfield" value="<?php echo  petsworld_option('layout','favicon-url'); ?>" />
                        <input type="button" value="<?php esc_attr_e('Upload', 'petsworld'); ?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'petsworld'); ?>" class="upload_image_reset" />
                        <?php petsworld_adminpanel_image_preview(petsworld_option('layout','favicon-url'),false,'favicon.png'); ?>
                    </div>
                    <p class="note"> <?php esc_html_e('Upload a favicon for your theme, or specify the oneline URL for favicon', 'petsworld'); ?>  </p>
                    <div class="hr"></div>
                    <div class="clear"></div>

                    <h6><?php esc_html_e('Apple iPhone Icon', 'petsworld'); ?></h6>
                    <div class="image-preview-container">
                        <input id="dttheme-apple-icon" name="dttheme[layout][apple-favicon]" type="text" class="uploadfield" value="<?php echo petsworld_option('layout','apple-favicon'); ?>"/>
                        <input type="button" value="<?php esc_attr_e('Upload', 'petsworld'); ?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'petsworld'); ?>" class="upload_image_reset" />
                        <?php petsworld_adminpanel_image_preview(petsworld_option('layout','apple-favicon'),false,'apple-touch-icon.png'); ?>
                    </div>
                    <p class="note"> <?php esc_html_e('Upload your custom iPhone icon (57px by 57px), or specify the oneline URL for favicon', 'petsworld'); ?>  </p>
                    <div class="hr"></div>
                    <div class="clear"></div>

                    <h6><?php esc_html_e('Apple iPhone Retina Icon', 'petsworld'); ?></h6>
                    <div class="image-preview-container">
                        <input id="dttheme-apple-icon" name="dttheme[layout][apple-retina-favicon]" type="text" class="uploadfield" value="<?php echo petsworld_option('layout','apple-retina-favicon'); ?>"/>
                        <input type="button" value="<?php esc_attr_e('Upload', 'petsworld'); ?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'petsworld'); ?>" class="upload_image_reset" />
                        <?php petsworld_adminpanel_image_preview(petsworld_option('layout','apple-retina-favicon'),false,'apple-touch-icon-114x114.png'); ?>
                    </div>
                    <p class="note"><?php esc_html_e('Upload your custom iPhone retina icon (114px by 114px), or specify the oneline URL for favicon', 'petsworld'); ?></p>
                    <div class="hr"></div>
                    <div class="clear"></div>

                    <h6><?php esc_html_e('Apple iPad Icon', 'petsworld'); ?></h6>
                    <div class="image-preview-container">
                        <input id="dttheme-apple-icon" name="dttheme[layout][apple-ipad-favicon]" type="text" class="uploadfield" value="<?php echo petsworld_option('layout','apple-ipad-favicon'); ?>"/>
                        <input type="button" value="<?php esc_attr_e('Upload', 'petsworld'); ?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'petsworld'); ?>" class="upload_image_reset" />
                        <?php petsworld_adminpanel_image_preview(petsworld_option('layout','apple-ipad-favicon'),false,'apple-touch-icon-72x72.png'); ?>
                    </div>
                    <p class="note"> <?php esc_html_e('Upload your custom iPad icon (72px by 72px), or specify the oneline URL for favicon', 'petsworld'); ?></p>
                    <div class="hr"></div>
                    <div class="clear"></div>
                    
                    <h6><?php esc_html_e('Apple iPad Retina Icon', 'petsworld'); ?></h6>
                    <div class="image-preview-container">
                        <input id="dttheme-apple-icon" name="dttheme[layout][apple-ipad-retina-favicon]" type="text" class="uploadfield" value="<?php echo petsworld_option('layout','apple-ipad-retina-favicon'); ?>"/>
                        <input type="button" value="<?php esc_attr_e('Upload', 'petsworld'); ?>" class="upload_image_button" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'petsworld'); ?>" class="upload_image_reset" />
                        <?php petsworld_adminpanel_image_preview(petsworld_option('layout','apple-ipad-retina-favicon'),false,'apple-touch-icon-144x144.png'); ?>
                    </div>
                    <p class="note"><?php esc_html_e('Upload your custom iPad retina icon (144px by 144px), or specify the oneline URL for favicon', 'petsworld'); ?></p>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->

            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Others', 'petsworld'); ?></h3>
                </div>

                <div class="box-content">
                	<div class="one-half column">
                        <h6><?php esc_html_e('Show Breadcrumb', 'petsworld'); ?></h6>
                        <div class="column one-fifth">
                             <?php $checked = ( "true" ==  petsworld_option('layout','show-breadcrumb') ) ? ' checked="checked"' : ''; ?>
                             <?php $switchclass = ( "true" ==  petsworld_option('layout','show-breadcrumb') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                             <div data-for="dttheme-layout-breadcrumb" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                             <input class="hidden" id="dttheme-layout-breadcrumb" name="dttheme[layout][show-breadcrumb]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                        </div>
                        <div class="column four-fifth last">
                            <p class="note"><?php esc_html_e('Yes! to show breadcrumbs for all pages here', 'petsworld'); ?></p>
                        </div>
                    </div>
                    <div class="one-half column last">
                        <h6><?php esc_html_e('Breadcrumb Delimiter', 'petsworld'); ?></h6>
                        <select id="dttheme-breadcrumb-delimiter" name="dttheme[layout][breadcrumb-delimiter]" class="dt-chosen-select"><?php
                          $bIcons = array('fa default' => esc_html__('Default', 'petsworld'),
						  	'fa fa-paw' => esc_html__('Paw', 'petsworld'),
						  	'fa fa-angle-double-right' => esc_html__('Double Right', 'petsworld'),
							'fa fa-sort' => esc_html__('Sort', 'petsworld'), 'fa fa-arrow-circle-right' => esc_html__('Arrow Circle Right', 'petsworld'), 'fa fa-angle-right' => esc_html__('Angle Right', 'petsworld'),
							'fa fa-caret-right' => esc_html__('Caret Right', 'petsworld'), 'fa fa-angle-double-right' => esc_html__('Double Angle Right', 'petsworld'),
							'fa fa-arrow-right' => esc_html__('Arrow Right', 'petsworld'), 'fa fa-chevron-right' => esc_html__('Chevron Right', 'petsworld'),
							'fa fa-hand-o-right' => esc_html__('Hand Right', 'petsworld'), 'fa fa-plus' => esc_html__('Plus', 'petsworld'), 'fa fa-remove' => esc_html__('Remove', 'petsworld'),
							'fa fa-glass' => esc_html__('Glass', 'petsworld') );
							
                          foreach($bIcons as $key => $bIcon):
                              $s = selected(petsworld_option('layout','breadcrumb-delimiter'),$key,false);
                              echo "<option value='{$key}' $s >$bIcon</option>";
                          endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select the symbol that will appear in between your breadcrumbs', 'petsworld'); ?></p>
                    </div>
                    <div class="one-half column">
                        <h6><?php esc_html_e('Breadcrumb Dark BG', 'petsworld'); ?></h6>
                        <div class="column one-fifth">
                             <?php $checked = ( "true" ==  petsworld_option('layout','breadcrumb-darkbg') ) ? ' checked="checked"' : ''; ?>
                             <?php $switchclass = ( "true" ==  petsworld_option('layout','breadcrumb-darkbg') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                             <div data-for="dttheme-layout-breadcrumb-darkbg" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                             <input class="hidden" id="dttheme-layout-breadcrumb-darkbg" name="dttheme[layout][breadcrumb-darkbg]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                        </div>
                        <div class="column four-fifth last">
                            <p class="note"><?php esc_html_e('Yes! to show dark background for breadcrumb in all the pages', 'petsworld'); ?></p>
                        </div>
                    </div>
                    <div class="one-half column last">
                        <h6><?php esc_html_e('Breadcrumb Style', 'petsworld'); ?></h6>
                        <select id="dttheme-breadcrumb-style" name="dttheme[layout][breadcrumb-style]" class="dt-chosen-select"><?php
                            $bstyles = array('default' => esc_html__('Default', 'petsworld'), 'aligncenter' => esc_html__('Align Center','petsworld'),
                                'alignright' => esc_html__('Align Right','petsworld'), 'breadcrumb-left' => esc_html__('Left Side Breadcrumb','petsworld'),
                                'breadcrumb-right' => esc_html__('Right Side Breadcrumb','petsworld'), 'breadcrumb-top-right-title-center' => esc_html__('Top Right Title Center', 'petsworld'),
								'breadcrumb-top-left-title-center' => esc_html__('Top Left Title Center', 'petsworld'));

                            foreach( $bstyles as $key => $bstyle ):
                              $s = selected(petsworld_option('layout','breadcrumb-style'),$key,false);
                              echo "<option value='{$key}' $s >$bstyle</option>";
                            endforeach;
                        ?></select>
                        <p class="note"><?php esc_html_e('Select the style that will be added to your breadcrumbs', 'petsworld'); ?></p>
					</div>

                    <div class="one-half column">
						<h6><?php esc_html_e( 'Sub Title Background','petsworld'); ?></h6>
                        <div class="image-preview-container" style="width:86%;">
                            <?php $breadbg = petsworld_option('layout','sub-title-bg'); ?>
                            <input name="dttheme[layout][sub-title-bg]" type="text" class="uploadfield large" readonly="readonly" value="<?php echo esc_attr($breadbg); ?>"/>  
                            <div class="hr_invisible"></div>                          
                            <input type="button" value="<?php esc_attr_e('Upload','petsworld'); ?>" class="upload_image_button show_preview" />
                            <input type="button" value="<?php esc_attr_e('Remove', 'petsworld'); ?>" class="upload_image_reset" />
                            <?php if( !empty($breadbg) ) petsworld_adminpanel_image_preview($breadbg ); ?>
                            <p class="note"><?php esc_html_e('Upload an image for the sub title background','petsworld'); ?></p>
                        </div>
                    </div>
                    <div class="one-half column last">
                        <h6><?php esc_html_e('Opacity','petsworld'); ?></h6>
                        <?php $opacity = petsworld_option('layout','sub-title-opacity'); ?>
                        <select name="dttheme[layout][sub-title-opacity]" class="dt-chosen-select">
                            <option value=""><?php esc_html_e("Select",'petsworld'); ?></option>
                            <?php foreach( array('1','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9') as $option): ?>
                                   <option value="<?php echo esc_attr($option); ?>" <?php selected($option,$opacity); ?>><?php echo esc_attr($option); ?></option>
                            <?php endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select background color opacity','petsworld'); ?></p>
                        <div class="hr_invisible"></div>
                    </div>
                    <div class="clear"></div>

                    <div class="one-third column">
                        <h6><?php esc_html_e('Background Repeat','petsworld'); ?></h6>
                        <?php $bgrepeat = petsworld_option('layout','sub-title-bg-repeat'); ?>
                        <select class="medium" name="dttheme[layout][sub-title-bg-repeat]">
                            <option value=""><?php esc_html_e("Select",'petsworld'); ?></option>
                            <?php foreach( array('repeat','repeat-x','repeat-y','no-repeat') as $option): ?>
                                   <option value="<?php echo esc_attr($option); ?>" <?php selected($option,$bgrepeat); ?>><?php echo esc_attr($option); ?></option>
                            <?php endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select how would you like to repeat the background image','petsworld'); ?></p>
                    </div>

                    <div class="one-third column">
                        <h6><?php esc_html_e('Background Position','petsworld'); ?></h6>
                        <?php $bgposition = petsworld_option('layout','sub-title-bg-position'); ?>
                        <select class="medium" name="dttheme[layout][sub-title-bg-position]">
                            <option value=""><?php esc_html_e('Select','petsworld'); ?></option>
                            <?php foreach( array('top left','top center','top right','center left','center center','center right','bottom left','bottom center','bottom right') as $option): ?>
                                <option value="<?php echo esc_attr($option); ?>" <?php selected($option,$bgposition); ?>> <?php echo esc_attr($option); ?></option>
                            <?php endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select how would you like to position the background','petsworld'); ?></p>
                    </div>

                    <div class="one-third column last">
                    <?php $label = 		esc_html__('Background Color','petsworld');
                          $name  =		'dttheme[layout][sub-title-bg-color]';
                          $value =  	petsworld_option('layout','sub-title-bg-color');
                          $tooltip = 	esc_html__('Select background color for sub title section e.g. #f2d607','petsworld'); ?>
                          <h6><?php echo esc_html($label); ?></h6>
                          <div class="clear"></div>
                          <?php petsworld_admin_color_picker("",$name,$value,''); ?>
                          <p class="note"><?php echo esc_html($tooltip); ?></p>
                    </div>		

                    <div class="hr"></div>
                    <div class="clear"></div>
 
                    <div class="column one-third">
                        <label><?php esc_html_e('Mailchimp API Key', 'petsworld'); ?></label>
                    </div>
                    <div class="column two-third last">
                        <input name="dttheme[layout][mailchimp-key]" type="text" class="large" value="<?php echo petsworld_option('layout','mailchimp-key'); ?>" />
                        <p class="note"><?php esc_html_e('Put a valid mailchimp account api key here', 'petsworld'); ?></p>
                    </div> 	

                    <div class="hr"></div>
                    <div class="clear"> </div>

                    <div class="column one-third">
                    	<label><?php esc_html_e('Google Map API KEY', 'petsworld');?></label>
                    </div>
                    <div class="column two-third last">
                        <input name="dttheme[layout][googlemap-api-key]" type="text" value="<?php echo petsworld_option('layout','googlemap-api-key'); ?>" />
                    	<p class="note"><?php esc_html_e('Paste your google map api key here.', 'petsworld'); ?></p>
                    </div>
                     
                   
                    		
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->
        </div><!--tab1-general end-->

        <!--tab2-header -->
        <div id="tab2" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Header Style', 'petsworld'); ?></h3>
                </div>

                <div class="box-content">
                	<h6><?php esc_html_e('Header Types', 'petsworld'); ?></h6>
                    <p class="note no-margin"> <?php esc_html_e("Choose the header type", 'petsworld'); ?> </p>
                    <div class="hr_invisible"> </div>
					<div class="bpanel-option-set">
                         <ul class="bpanel-layout-set bpanel-post-layout"><?php
							 $htypes = array(
							 	"fullwidth-header" => "fullwidth-header",
								"split-header fullwidth-header" => "splitted-fullwidth-header",
								"fullwidth-header header-align-center fullwidth-menu-header" => "fullwidth-menu-center", 
								"fullwidth-header header-align-left fullwidth-menu-header" => "fullwidth-menu-left",
								);
							 foreach( $htypes as $key => $htype):
								$class = ( $key ==  petsworld_option('layout','header-type')) ? " class='selected' " : "";?>
								<li class="headerlayout"><a href="#" rel="<?php echo esc_attr($key); ?>" <?php echo "{$class}";?> title="<?php echo esc_attr($htype); ?>">
									<img src="<?php echo PETSWORLD_THEME_URI . "/framework/theme-options/images/headers/{$htype}.jpg";?>" />
								</a></li><?php
							 endforeach; ?>
                         </ul>
                         <input id="dttheme[layout][header-type]" name="dttheme[layout][header-type]" type="hidden" value="<?php echo petsworld_option('layout','header-type'); ?>"/>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->

            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Others', 'petsworld'); ?></h3>
                </div>

                <div class="box-content">
                	<div class="column one-half">
                        <h6><?php esc_html_e('Enable Sticky Navigation', 'petsworld'); ?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  petsworld_option('layout','layout-stickynav') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  petsworld_option('layout','layout-stickynav') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-layout-stickynav" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                              <input class="hidden" id="dttheme-layout-stickynav" name="dttheme[layout][layout-stickynav]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to use sticky header for this site.', 'petsworld'); ?></p>
                        </div>
                    </div>
                	<div class="column one-half last">
                        <h6><?php esc_html_e('Header Dark BG', 'petsworld'); ?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  petsworld_option('layout','header-darkbg') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  petsworld_option('layout','header-darkbg') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-layout-header-darkbg" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                              <input class="hidden" id="dttheme-layout-header-darkbg" name="dttheme[layout][header-darkbg]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to use dark bg header for this site.', 'petsworld'); ?></p>
                        </div>
                    </div>
                    <div class="hr"></div>

                	<div class="column one-half">
                        <h6><?php esc_html_e('Header Position', 'petsworld'); ?></h6>
                        <div class="column one-fifth">
                            <select id="dttheme-header-position" name="dttheme[layout][header-position]" class="dt-chosen-select"><?php
                              $hpos = array('above slider', 'on slider', 'below slider');
                              foreach($hpos as $v):
                                  $s = selected(petsworld_option('layout','header-position'),$v,false);
                                  echo "<option $s >$v</option>";
                              endforeach;?>
                            </select>
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('Select header Position for this site.', 'petsworld'); ?></p>
                        </div>
                    </div>
                	<div class="column one-half last">
                        <h6><?php esc_html_e('Header Transparency', 'petsworld'); ?></h6>
                        <div class="column one-fifth">
                            <select id="dttheme-header-transparant" name="dttheme[layout][header-transparant]" class="dt-chosen-select"><?php
                              $htrans = array('' =>'Choose any one', 'semi-transparent-header' => 'Semi Transparent', 'transparent-header' => 'Transparent');
                              foreach($htrans as $key => $v):
                                  $s = selected(petsworld_option('layout','header-transparant'),$key,false);
                                  echo "<option value='{$key}' $s>$v</option>";
                              endforeach;?>
                            </select>
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('Select header Transparency for this site.', 'petsworld'); ?></p>
                        </div>
                    </div>
                    <div class="hr"></div>
					<div class="clear"></div>

                    <div class="column one-third">
						<h6><?php esc_html_e( 'Header Background','petsworld'); ?></h6>
                        <div class="image-preview-container" style="width:86%;">
                            <?php $headbg = petsworld_option('layout','header-bg'); ?>
                            <input name="dttheme[layout][header-bg]" type="text" class="uploadfield large" readonly="readonly" value="<?php echo esc_attr($headbg); ?>"/>  
                            <div class="hr_invisible"></div>                          
                            <input type="button" value="<?php esc_attr_e('Upload','petsworld'); ?>" class="upload_image_button show_preview" />
                            <input type="button" value="<?php esc_attr_e('Remove', 'petsworld'); ?>" class="upload_image_reset" />
                            <?php if( !empty($headbg) ) petsworld_adminpanel_image_preview($headbg ); ?>
                            <p class="note"><?php esc_html_e('Upload an image for the header background.','petsworld'); ?></p>
                        </div>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Background Repeat','petsworld'); ?></h6>
                        <?php $bgrepeat = petsworld_option('layout','header-bg-repeat'); ?>
                        <select class="medium" name="dttheme[layout][header-bg-repeat]">
                            <option value=""><?php esc_html_e("Select",'petsworld'); ?></option>
                            <?php foreach( array('repeat','repeat-x','repeat-y','no-repeat') as $option): ?>
                                   <option value="<?php echo esc_attr($option); ?>" <?php selected($option,$bgrepeat); ?>><?php echo esc_attr($option); ?></option>
                            <?php endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select how would you like to repeat the background image.','petsworld'); ?></p>
                    </div>
                    <div class="column one-third last">
                        <h6><?php esc_html_e('Background Position','petsworld'); ?></h6>
                        <?php $bgposition = petsworld_option('layout','header-bg-position'); ?>
                        <select class="medium" name="dttheme[layout][header-bg-position]">
                            <option value=""><?php esc_html_e('Select','petsworld'); ?></option>
                            <?php foreach( array('top left','top center','top right','center left','center center','center right','bottom left','bottom center','bottom right') as $option): ?>
                                <option value="<?php echo esc_attr($option); ?>" <?php selected($option,$bgposition); ?>> <?php echo esc_attr($option); ?></option>
                            <?php endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select how would you like to position the background.','petsworld'); ?></p>
                    </div>
                    <div class="hr"></div>
					<div class="clear"></div>

                    <div class="column one-half">
                    	<h6><?php esc_html_e('Enable Top Bar', 'petsworld'); ?></h6>
                        <div class="column one-half">
                              <?php $checked = ( "true" ==  petsworld_option('layout','layout-topbar') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  petsworld_option('layout','layout-topbar') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-layout-topbar" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                              <input class="hidden" id="dttheme-layout-topbar" name="dttheme[layout][layout-topbar]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                              <p class="note"><?php esc_html_e('YES! to enable top bar', 'petsworld'); ?></p>
                        </div>
                        <div class="column one-column last">
                        	<div class="clear"></div>
                        	<div class="hr_invisible"></div>
                        	<textarea id="dttheme[layout][top-content]" name="dttheme[layout][top-content]"><?php echo stripslashes(petsworld_option('layout', 'top-content')); ?></textarea>
                            <p class="note"><?php esc_html_e('Any code you place here will appear above header of your site.', 'petsworld'); ?></p>
                        </div>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->
        </div><!--tab2-header end-->

        <!--tab3-menu -->
        <div id="tab3" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Menu', 'petsworld'); ?></h3>
                </div>
                
                <div class="box-content">
                	<div class="column one-half">
                        <h6><?php esc_html_e('Search Icon', 'petsworld'); ?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  petsworld_option('layout','menu-searchicon') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  petsworld_option('layout','menu-searchicon') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-layout-menu-searchicon" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                              <input class="hidden" id="dttheme-layout-menu-searchicon" name="dttheme[layout][menu-searchicon]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                        </div>
                        <div class="column one-column last">
                              <p class="note"><?php esc_html_e('YES! to show search icon for this site.', 'petsworld'); ?></p>
                        </div>
                    </div>
                	<div class="column one-half last">
						<h6><?php esc_html_e('Top Left Content', 'petsworld'); ?></h6>
                    	<div class="column one-column">
	                    	<textarea id="dttheme[layout][menu-top-left-content]" name="dttheme[layout][menu-top-left-content]"><?php echo stripslashes(petsworld_option('layout', 'menu-top-left-content')); ?></textarea>
                        </div>
                        <div class="column one-column last">
                              <p class="note"><?php esc_html_e('This content will appear top left side of menu, <br>applies only for selected headers.', 'petsworld'); ?></p>
                        </div>
					</div>
                    <div class="hr"></div>
					<div class="clear"></div>
                    
                	<div class="column one-half">
                        <h6><?php esc_html_e('Cart Icon', 'petsworld'); ?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  petsworld_option('layout','menu-carticon') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  petsworld_option('layout','menu-carticon') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-layout-menu-carticon" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                              <input class="hidden" id="dttheme-layout-menu-carticon" name="dttheme[layout][menu-carticon]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                        </div>
                        <div class="column one-column last">
                              <p class="note"><?php esc_html_e('YES! to show cart icon for this site.', 'petsworld'); ?></p>
                        </div>
					</div>
                	<div class="column one-half last">
						<h6><?php esc_html_e('Top Right Content', 'petsworld'); ?></h6>
                    	<div class="column one-column">
	                    	<textarea id="dttheme[layout][menu-top-right-content]" name="dttheme[layout][menu-top-right-content]"><?php echo stripslashes(petsworld_option('layout', 'menu-top-right-content')); ?></textarea>
                        </div>
                        <div class="column one-column last">
                              <p class="note"><?php esc_html_e('This content will appear top right side of menu, <br>applies only for selected headers.', 'petsworld'); ?></p>
                        </div>
                    </div>
                    <div class="hr"></div>
					<div class="clear"></div>

                	<div class="column one-half">
						<h6><?php esc_html_e('Left Header Content', 'petsworld'); ?></h6>
                    	<div class="column one-column">
	                    	<textarea id="dttheme[layout][menu-left-header-content]" name="dttheme[layout][menu-left-header-content]"><?php echo stripslashes(petsworld_option('layout', 'menu-left-header-content')); ?></textarea>
                        </div>
                        <div class="column one-column last">
                              <p class="note"><?php esc_html_e('This content will appear bottom of menu, <br>applies only left header.', 'petsworld'); ?></p>
                        </div>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->

            <!-- Sub Menu .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Sub Menu or Mega Menu','petsworld'); ?></h3>
                </div>
                <div class="box-content">
                	<h4><?php esc_html_e('Mega Menu & Sub Menu Container Options', 'petsworld'); ?></h4>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Hover Animation', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last">
                        <select id="dttheme-menu-hover-style" name="dttheme[layout][menu-hover-style]" class="dt-chosen-select"><?php
                            $hover_styles = array(
                                '' => esc_html__('Default','petsworld'), "bigEntrance" => "bigEntrance", "bounce" => "bounce",
                                "bounceIn" => "bounceIn", "bounceInDown" => "bounceInDown", "bounceInLeft" => "bounceInLeft",
                                "bounceInRight" => "bounceInRight", "bounceInUp" => "bounceInUp", "bounceOut" => "bounceOut",
                                "bounceOutDown" => "bounceOutDown","bounceOutLeft" => "bounceOutLeft", "bounceOutRight" => "bounceOutRight",
                                "bounceOutUp" => "bounceOutUp", "expandOpen" => "expandOpen","expandUp" => "expandUp", "fadeIn" => "fadeIn",
                                "fadeInDown" => "fadeInDown", "fadeInDownBig" => "fadeInDownBig", "fadeInLeft" => "fadeInLeft",
                                "fadeInLeftBig" => "fadeInLeftBig", "fadeInRight" => "fadeInRight", "fadeInRightBig" => "fadeInRightBig",
                                "fadeInUp" => "fadeInUp","fadeInUpBig" => "fadeInUpBig", "fadeOut" => "fadeOut", "fadeOutDownBig" => "fadeOutDownBig",
                                "fadeOutLeft" => "fadeOutLeft","fadeOutLeftBig" => "fadeOutLeftBig", "fadeOutRight" => "fadeOutRight",
                                "fadeOutUp" => "fadeOutUp", "fadeOutUpBig" => "fadeOutUpBig", "flash" => "flash","flip" => "flip", "flipInX" => "flipInX",
                                "flipInY" => "flipInY", "flipOutX" => "flipOutX", "flipOutY" => "flipOutY", "floating" => "floating","hatch" => "hatch",
                                "hinge" => "hinge", "lightSpeedIn" => "lightSpeedIn", "lightSpeedOut" => "lightSpeedOut", "pullDown" => "pullDown",
                                "pullUp" => "pullUp", "pulse" => "pulse", "rollIn" => "rollIn", "rollOut" => "rollOut", "rotateIn" => "rotateIn",
                                "rotateInDownLeft" => "rotateInDownLeft","rotateInDownRight" => "rotateInDownRight", "rotateInUpLeft" => "rotateInUpLeft",
                                "rotateInUpRight" => "rotateInUpRight", "rotateOut" => "rotateOut","rotateOutDownRight" => "rotateOutDownRight",
                                "rotateOutUpLeft" => "rotateOutUpLeft", "rotateOutUpRight" => "rotateOutUpRight", "shake" => "shake",
                                "slideDown" => "slideDown", "slideExpandUp" => "slideExpandUp", "slideLeft" => "slideLeft", "slideRight" => "slideRight",
                                "slideUp" => "slideUp","stretchLeft" => "stretchLeft", "stretchRight" => "stretchRight","swing" => "swing", "tada" => "tada",
                                "tossing" => "tossing", "wobble" => "wobble","fadeOutDown" => "fadeOutDown", "fadeOutRightBig" => "fadeOutRightBig",
                                "rotateOutDownLeft" => "rotateOutDownLeft");
                            foreach($hover_styles as $key => $v):
                                $s = selected(petsworld_option('layout','menu-hover-style'),$key,false);
                                echo "<option value ='{$key}' $s >$v</option>";
                            endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select sub menu hover animation for this site.', 'petsworld'); ?></p>
                    </div>
                    <div class="hr"></div>

                	<h4><?php esc_html_e('Border', 'petsworld'); ?></h4>
                    
                    <div class="column one-third">&nbsp;</div>
                    <div class="column two-third last"><?php
                    	$checked = ( "true" ==  petsworld_option('layout','menu-border') ) ? ' checked="checked"' : ''; ?>
                        <?php $switchclass = ( "true" ==  petsworld_option('layout','menu-border') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div data-for="dttheme-layout-menu-border" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                        <input class="hidden" id="dttheme-layout-menu-border" name="dttheme[layout][menu-border]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                        <p class="note"><?php esc_html_e('YES! to show menu border for this site.', 'petsworld'); ?></p>
                    </div>                     
                    
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Width', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last">
                    	<div class="column one-fifth" style="width:22%;">
                        	<p class="note no-margin"><?php esc_html_e('Top (in px)', 'petsworld'); ?></p>
                            <input type="text" name="dttheme[layout][menu-border-width-top]" class="small" value="<?php echo petsworld_option('layout','menu-border-width-top'); ?>" />
                        </div>
                    	<div class="column one-fifth" style="width:22%;">
                        	<p class="note no-margin"><?php esc_html_e('Right (in px)', 'petsworld'); ?></p>
                            <input type="text" name="dttheme[layout][menu-border-width-right]" class="small" value="<?php echo petsworld_option('layout','menu-border-width-right'); ?>" />
                        </div>
                    	<div class="column one-fifth" style="width:21%;">
                        	<p class="note no-margin"><?php esc_html_e('Bottom (in px)', 'petsworld'); ?></p>
                            <input type="text" name="dttheme[layout][menu-border-width-bottom]" class="small" value="<?php echo petsworld_option('layout','menu-border-width-bottom'); ?>" />
                        </div>
                    	<div class="column one-fifth last" style="width:21%;">
                        	<p class="note no-margin"><?php esc_html_e('Left (in px)', 'petsworld'); ?></p>
                            <input type="text" name="dttheme[layout][menu-border-width-left]" class="small" value="<?php echo petsworld_option('layout','menu-border-width-left'); ?>" />
                        </div>
                        <p class="note"><?php esc_html_e('Set border width of menu container for this site.', 'petsworld'); ?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Style', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last">
                        <select id="dttheme-menu-border-style" name="dttheme[layout][menu-border-style]" class="dt-chosen-select"><?php
                            $border_styles = array( 'dotted' => esc_html__('Dotted','petsworld'), 'dashed' => esc_html__('Dashed','petsworld'),'solid' => esc_html__('Solid','petsworld'), 'double' => esc_html__('Double','petsworld'),
								'groove' => esc_html__('Groove','petsworld'), 'ridge' => esc_html__('Ridge','petsworld'));
                            foreach($border_styles as $key => $v):
                                $s = selected(petsworld_option('layout','menu-border-style'),$key,false);
                                echo "<option value ='{$key}' $s >$v</option>";
                            endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select border style of menu container for this site.', 'petsworld'); ?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Color', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last"><?php
                        $name  =  "dttheme[layout][menu-border-color]";
                        $value =  (petsworld_option('layout','menu-border-color') != NULL) ? petsworld_option('layout','menu-border-color') : "";
                        petsworld_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Set a custom border color of the menu container.(e.g. #a314a3)', 'petsworld'); ?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Radius', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last">
                    	<div class="column one-fifth" style="width:22%;">
                        	<p class="note no-margin"><?php esc_html_e('Top Left (in px)', 'petsworld'); ?></p>
                            <input type="text" name="dttheme[layout][menu-border-radius-top]" class="small" value="<?php echo petsworld_option('layout','menu-border-radius-top'); ?>" />
                        </div>
                    	<div class="column one-fifth" style="width:22%;">
                        	<p class="note no-margin"><?php esc_html_e('Top Right (in px)', 'petsworld'); ?></p>
                            <input type="text" name="dttheme[layout][menu-border-radius-right]" class="small" value="<?php echo petsworld_option('layout','menu-border-radius-right'); ?>" />
                        </div>
                    	<div class="column one-fifth" style="width:21%;">
                        	<p class="note no-margin"><?php esc_html_e('Bottom Right (in px)', 'petsworld'); ?></p>
                            <input type="text" name="dttheme[layout][menu-border-radius-bottom]" class="small" value="<?php echo petsworld_option('layout','menu-border-radius-bottom'); ?>" />
                        </div>
                    	<div class="column one-fifth last" style="width:21%;">
                        	<p class="note no-margin"><?php esc_html_e('Bottom Left (in px)', 'petsworld'); ?></p>
                            <input type="text" name="dttheme[layout][menu-border-radius-left]" class="small" value="<?php echo petsworld_option('layout','menu-border-radius-left'); ?>" />
                        </div>
                        <p class="note"><?php esc_html_e('Set border radius of menu container for this site.', 'petsworld'); ?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third">
                        <h6><?php esc_html_e('Box Shadow', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last"><?php
                    	$checked = ( "true" ==  petsworld_option('layout','menu-boxshadow') ) ? ' checked="checked"' : ''; ?>
                        <?php $switchclass = ( "true" ==  petsworld_option('layout','menu-boxshadow') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div data-for="dttheme-layout-menu-boxshadow" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                        <input class="hidden" id="dttheme-layout-menu-boxshadow" name="dttheme[layout][menu-boxshadow]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                        <p class="note"><?php esc_html_e('YES! to show box shadow for this site.', 'petsworld'); ?></p>
                    </div>
                    <div class="hr"></div>

                	<h4><?php esc_html_e('Background', 'petsworld'); ?></h4>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Background Color', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last"><?php
                        $name  =  "dttheme[layout][menu-bg-color]";
                        $value =  (petsworld_option('layout','menu-bg-color') != NULL) ? petsworld_option('layout','menu-bg-color') : "";
                        petsworld_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Set a custom background color of the menu container.(e.g. #a314a3)', 'petsworld'); ?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Gradient Background', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last"><?php
                        $name  =  "dttheme[layout][menu-gradient-color1]";
                        $value =  (petsworld_option('layout','menu-gradient-color1') != NULL) ? petsworld_option('layout','menu-gradient-color1') : "";
                        petsworld_admin_color_picker_two($name,$value);

                        $name  =  "dttheme[layout][menu-gradient-color2]";
                        $value =  (petsworld_option('layout','menu-gradient-color2') != NULL) ? petsworld_option('layout','menu-gradient-color2') : "";
                        petsworld_admin_color_picker_two($name,$value); ?><br />

                        <input type="text" name="dttheme[layout][menu-gradient-percent1]" style="width:29%;" placeholder="20%" class="small" value="<?php echo petsworld_option('layout','menu-gradient-percent1'); ?>" />
                        <input type="text" name="dttheme[layout][menu-gradient-percent2]" style="width:29%;" placeholder="80%" class="small" value="<?php echo petsworld_option('layout','menu-gradient-percent2'); ?>" />

                        <p class="note"><?php esc_html_e('Set a custom gradient color of the menu container.', 'petsworld'); ?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Background Image', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last"><?php
                    	$checked = ( "true" ==  petsworld_option('layout','menu-bgimage') ) ? ' checked="checked"' : ''; ?>
                        <?php $switchclass = ( "true" ==  petsworld_option('layout','menu-bgimage') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div data-for="dttheme-layout-menu-bgimage" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                        <input class="hidden" id="dttheme-layout-menu-bgimage" name="dttheme[layout][menu-bgimage]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                        <p class="note"><?php esc_html_e('YES! to show background image for menu items.', 'petsworld'); ?></p>
                    </div>
                    <div class="hr"></div>

                	<h4><?php esc_html_e('Mega Menu Column Title', 'petsworld'); ?></h4> 
                            
                    
                    <div class="column one-third">
                        <h6><?php esc_html_e('Default', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last">
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('Text Color', 'petsworld'); ?></p><?php
							$name  =  "dttheme[layout][menu-title-text-dcolor]";
							$value =  (petsworld_option('layout','menu-title-text-dcolor') != NULL) ? petsworld_option('layout','menu-title-text-dcolor') : "";
							petsworld_admin_color_picker_two($name,$value); ?>
                        </div>
                        <div class="column one-fourth last">
                            <p class="note no-margin"><?php esc_html_e('Hover Color', 'petsworld'); ?></p><?php
							$name  =  "dttheme[layout][menu-title-text-dhcolor]";
							$value =  (petsworld_option('layout','menu-title-text-dhcolor') != NULL) ? petsworld_option('layout','menu-title-text-dhcolor') : "";
							petsworld_admin_color_picker_two($name,$value); ?>
                        </div>
                        <p class="note"><?php esc_html_e('Pick a default color options of the menu title.(e.g. #a314a3)', 'petsworld'); ?></p>
                    </div>     
                           
                                     
                    <div class="column one-third">
                        <h6><?php esc_html_e('With Background', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last"><?php
                    	$checked = ( "true" ==  petsworld_option('layout','menu-title-bg') ) ? ' checked="checked"' : ''; ?>
                        <?php $switchclass = ( "true" ==  petsworld_option('layout','menu-title-bg') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div data-for="dttheme-layout-menu-title-bg" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                        <input class="hidden" id="dttheme-layout-menu-title-bg" name="dttheme[layout][menu-title-bg]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                        <p class="note"><?php esc_html_e('YES! to show mega menu column title background for this site.', 'petsworld'); ?></p>
                    </div>  
                    <div class="column one-third">&nbsp;</div>
                    <div class="column two-third last">
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('BG Color', 'petsworld'); ?></p><?php
							$name  =  "dttheme[layout][menu-title-bg-color]";
							$value =  (petsworld_option('layout','menu-title-bg-color') != NULL) ? petsworld_option('layout','menu-title-bg-color') : "";
							petsworld_admin_color_picker_two($name,$value); ?>
                        </div>
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('Text Color', 'petsworld'); ?></p><?php
							$name  =  "dttheme[layout][menu-title-text-color]";
							$value =  (petsworld_option('layout','menu-title-text-color') != NULL) ? petsworld_option('layout','menu-title-text-color') : "";
							petsworld_admin_color_picker_two($name,$value); ?>
                        </div>
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('Hover BG Color', 'petsworld'); ?></p><?php
							$name  =  "dttheme[layout][menu-title-hoverbg-color]";
							$value =  (petsworld_option('layout','menu-title-hoverbg-color') != NULL) ? petsworld_option('layout','menu-title-hoverbg-color') : "";
							petsworld_admin_color_picker_two($name,$value); ?>
                        </div>
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('Hover Text Color', 'petsworld'); ?></p><?php
							$name  =  "dttheme[layout][menu-title-hovertext-color]";
							$value =  (petsworld_option('layout','menu-title-hovertext-color') != NULL) ? petsworld_option('layout','menu-title-hovertext-color') : "";
							petsworld_admin_color_picker_two($name,$value); ?>
                        </div>
                        <p class="note"><?php esc_html_e('Pick a custom color options of the menu title.(e.g. #a314a3)', 'petsworld'); ?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Radius', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last">
                        <div class="column one-fourth">
                            <input type="text" name="dttheme[layout][menu-title-border-radius]" class="small" value="<?php echo petsworld_option('layout','menu-title-border-radius'); ?>" />
                        </div>
                        <p class="note"><?php esc_html_e('Set border radius value, when using background color.', 'petsworld'); ?></p>
                        <div class="hr_invisible"></div>
                    </div>
                    
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Width', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last">
                    	<div class="column one-fifth" style="width:22%;">
                        	<p class="note no-margin"><?php esc_html_e('Top (in px)', 'petsworld'); ?></p>
                            <input type="text" name="dttheme[layout][menu-title-border-width-top]" class="small" value="<?php echo petsworld_option('layout','menu-title-border-width-top'); ?>" />
                        </div>
                    	<div class="column one-fifth" style="width:22%;">
                        	<p class="note no-margin"><?php esc_html_e('Right (in px)', 'petsworld'); ?></p>
                            <input type="text" name="dttheme[layout][menu-title-border-width-right]" class="small" value="<?php echo petsworld_option('layout','menu-title-border-width-right'); ?>" />
                        </div>
                    	<div class="column one-fifth" style="width:21%;">
                        	<p class="note no-margin"><?php esc_html_e('Bottom (in px)', 'petsworld'); ?></p>
                            <input type="text" name="dttheme[layout][menu-title-border-width-bottom]" class="small" value="<?php echo petsworld_option('layout','menu-title-border-width-bottom'); ?>" />
                        </div>
                    	<div class="column one-fifth last" style="width:21%;">
                        	<p class="note no-margin"><?php esc_html_e('Left (in px)', 'petsworld'); ?></p>
                            <input type="text" name="dttheme[layout][menu-title-border-width-left]" class="small" value="<?php echo petsworld_option('layout','menu-title-border-width-left'); ?>" />
                        </div>
                        <p class="note"><?php esc_html_e('Set border width of menu title for this site.', 'petsworld'); ?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Style', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last">
                        <select id="dttheme-menu-title-border-style" name="dttheme[layout][menu-title-border-style]" class="dt-chosen-select"><?php
                            $border_styles = array( 'dotted' => esc_html__('Dotted','petsworld'), 'dashed' => esc_html__('Dashed','petsworld'),'solid' => esc_html__('Solid','petsworld'), 'double' => esc_html__('Double','petsworld'),
								'groove' => esc_html__('Groove','petsworld'), 'ridge' => esc_html__('Ridge','petsworld'));
                            foreach($border_styles as $key => $v):
                                $s = selected(petsworld_option('layout','menu-title-border-style'),$key,false);
                                echo "<option value ='{$key}' $s >$v</option>";
                            endforeach;?>
                        </select>
                        <p class="note"><?php esc_html_e('Select border style of menu title for this site.', 'petsworld'); ?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Color', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last"><?php
                        $name  =  "dttheme[layout][menu-title-border-color]";
                        $value =  (petsworld_option('layout','menu-title-border-color') != NULL) ? petsworld_option('layout','menu-title-border-color') : "";
                        petsworld_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Set a custom border color of the menu title.(e.g. #a314a3)', 'petsworld'); ?></p>
                    </div>
                    <div class="hr"></div>
                    
                	<h4><?php esc_html_e('Mega Menu & Sub Menu Links', 'petsworld'); ?></h4>
                    <div class="column one-third">
                        <h6><?php esc_html_e('Default', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last">
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('Text Color', 'petsworld'); ?></p><?php
							$name  =  "dttheme[layout][menu-link-text-dcolor]";
							$value =  (petsworld_option('layout','menu-link-text-dcolor') != NULL) ? petsworld_option('layout','menu-link-text-dcolor') : "";
							petsworld_admin_color_picker_two($name,$value); ?>
                        </div>
                        <div class="column one-fourth last">
                            <p class="note no-margin"><?php esc_html_e('Hover Color', 'petsworld'); ?></p><?php
							$name  =  "dttheme[layout][menu-link-text-dhcolor]";
							$value =  (petsworld_option('layout','menu-link-text-dhcolor') != NULL) ? petsworld_option('layout','menu-link-text-dhcolor') : "";
							petsworld_admin_color_picker_two($name,$value); ?>
                        </div>
                        <p class="note"><?php esc_html_e('Pick a default color options of the menu link.(e.g. #a314a3)', 'petsworld'); ?></p>
                    </div>
                    <div class="column one-third">
                        <h6><?php esc_html_e('With Background', 'petsworld'); ?></h6>
                    </div>
                    
                    <div class="column two-third last"><?php
                    	$checked = ( "true" ==  petsworld_option('layout','menu-links-bg') ) ? ' checked="checked"' : ''; ?>
                        <?php $switchclass = ( "true" ==  petsworld_option('layout','menu-links-bg') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div data-for="dttheme-layout-menu-links-bg" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                        <input class="hidden" id="dttheme-layout-menu-links-bg" name="dttheme[layout][menu-links-bg]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                        <p class="note"><?php esc_html_e('YES! to show menu links background for this site.', 'petsworld'); ?></p>
                    </div>
                    
                    <div class="column one-third"> &nbsp; </div>
                    
                    <div class="column two-third last">
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('BG Color', 'petsworld'); ?></p><?php
							$name  =  "dttheme[layout][menu-link-bg-color]";
							$value =  (petsworld_option('layout','menu-link-bg-color') != NULL) ? petsworld_option('layout','menu-link-bg-color') : "";
							petsworld_admin_color_picker_two($name,$value); ?>
                        </div>
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('Text Color', 'petsworld'); ?></p><?php
							$name  =  "dttheme[layout][menu-link-text-color]";
							$value =  (petsworld_option('layout','menu-link-text-color') != NULL) ? petsworld_option('layout','menu-link-text-color') : "";
							petsworld_admin_color_picker_two($name,$value); ?>
                        </div>
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('Hover BG Color', 'petsworld'); ?></p><?php
							$name  =  "dttheme[layout][menu-link-hoverbg-color]";
							$value =  (petsworld_option('layout','menu-link-hoverbg-color') != NULL) ? petsworld_option('layout','menu-link-hoverbg-color') : "";
							petsworld_admin_color_picker_two($name,$value); ?>
                        </div>
                        <div class="column one-fourth">
                            <p class="note no-margin"><?php esc_html_e('Hover Text Color', 'petsworld'); ?></p><?php
							$name  =  "dttheme[layout][menu-link-hovertext-color]";
							$value =  (petsworld_option('layout','menu-link-hovertext-color') != NULL) ? petsworld_option('layout','menu-link-hovertext-color') : "";
							petsworld_admin_color_picker_two($name,$value); ?>
                        </div>
                        <p class="note"><?php esc_html_e('Pick a custom color options of the menu link.(e.g. #a314a3)', 'petsworld'); ?></p>
                    </div>                    
                    <div class="column one-third">
                        <h6><?php esc_html_e('Border Radius', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last">
                        <div class="column one-fourth">
                            <input type="text" name="dttheme[layout][menu-link-border-radius]" class="small" value="<?php echo petsworld_option('layout','menu-link-border-radius'); ?>" />
                        </div>
                        <p class="note"><?php esc_html_e('Set border radius value, when using background color.', 'petsworld'); ?></p>
                        <div class="hr_invisible"></div>
                    </div>
                    
                    <div class="column one-third">
                        <h6><?php esc_html_e('With Hover Border', 'petsworld'); ?></h6>
                    </div>
                    
                    <div class="column two-third last"><?php
                    	$checked = ( "true" ==  petsworld_option('layout','menu-hover-border') ) ? ' checked="checked"' : ''; ?>
                        <?php $switchclass = ( "true" ==  petsworld_option('layout','menu-hover-border') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div data-for="dttheme-layout-menu-hover-border" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                        <input class="hidden" id="dttheme-layout-menu-hover-border" name="dttheme[layout][menu-hover-border]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                        <p class="note"><?php esc_html_e('YES! to show menu links hover border for this site.', 'petsworld'); ?></p>
                    </div>


                    <div class="column one-third">
                        <h6><?php esc_html_e('Hover Border Color', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last"><?php
                        $name  =  "dttheme[layout][menu-link-hborder-color]";
                        $value =  (petsworld_option('layout','menu-link-hborder-color') != NULL) ? petsworld_option('layout','menu-link-hborder-color') : "";
                        petsworld_admin_color_picker_two($name,$value); ?>
                        <p class="note"><?php esc_html_e('Set a custom hover border color of the menu link.(e.g. #a314a3)', 'petsworld'); ?></p>
                    </div>
                    <div class="hr"></div>
                    
                    <div class="column one-third">
                        <h6><?php esc_html_e('With Bottom Border', 'petsworld'); ?></h6>
                    </div>
                    
                    <div class="column two-third last"><?php
                    	$checked = ( "true" ==  petsworld_option('layout','menu-links-border') ) ? ' checked="checked"' : ''; ?>
                        <?php $switchclass = ( "true" ==  petsworld_option('layout','menu-links-border') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div data-for="dttheme-layout-menu-links-border" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                        <input class="hidden" id="dttheme-layout-menu-links-border" name="dttheme[layout][menu-links-border]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                        <p class="note"><?php esc_html_e('YES! to show menu links border for this site.', 'petsworld'); ?></p>
                    </div>
                    
                    <div class="column one-third"> &nbsp; </div> 
                    
                    <div class="column two-third last">
                        <div class="column one-fourth" style="width:23%;">
                        	<p class="note no-margin"><?php esc_html_e('Border Width', 'petsworld'); ?></p>
                            <input type="text" name="dttheme[layout][menu-link-border-width]" class="medium" value="<?php echo petsworld_option('layout','menu-link-border-width'); ?>" />
                        </div>
                        <div class="column one-fourth" style="width:32%;">
                            <p class="note no-margin"><?php esc_html_e('Border Color', 'petsworld'); ?></p><?php
							$name  =  "dttheme[layout][menu-link-border-color]";
							$value =  (petsworld_option('layout','menu-link-border-color') != NULL) ? petsworld_option('layout','menu-link-border-color') : "";
							petsworld_admin_color_picker_two($name,$value); ?>
                        </div>
                        <div class="column one-fourth last">
                            <p class="note no-margin"><?php esc_html_e('Border Style', 'petsworld'); ?></p>
                            <select id="dttheme-menu-link-border-style" name="dttheme[layout][menu-link-border-style]" class="small"><?php
                                $border_style = array( 'dotted' => esc_html__('Dotted','petsworld'), 'dashed' => esc_html__('Dashed','petsworld'),'solid' => esc_html__('Solid','petsworld'), 'double' => esc_html__('Double','petsworld'),
								'groove' => esc_html__('Groove','petsworld'), 'ridge' => esc_html__('Ridge','petsworld'));
                                foreach($border_style as $key => $v):
                                    $s = selected(petsworld_option('layout','menu-link-border-style'),$key,false);
                                    echo "<option value ='{$key}' $s >$v</option>";
                                endforeach;?>
                            </select>
                        </div>
                        <p class="note"><?php esc_html_e('Pick bottom border options for menu link.', 'petsworld'); ?></p>
                    </div>                    
                    <div class="column one-third">
                        <h6><?php esc_html_e('Default Arrow', 'petsworld'); ?></h6>
                    </div>
                    <div class="column two-third last">
                        <div class="column one-fourth">
							<p class="note no-margin"><?php esc_html_e('Enable Arrow', 'petsworld'); ?></p><?php
							$checked = ( "true" ==  petsworld_option('layout','menu-link-arrow') ) ? ' checked="checked"' : ''; ?>
							<?php $switchclass = ( "true" ==  petsworld_option('layout','menu-link-arrow') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
							<div data-for="dttheme-layout-menu-link-arrow" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
							<input class="hidden" id="dttheme-layout-menu-link-arrow" name="dttheme[layout][menu-link-arrow]" type="checkbox" value="true" <?php echo "{$checked}";?>/>
                        </div>
                        <div class="column one-fourth last">
                            <p class="note no-margin"><?php esc_html_e('Arrow Style', 'petsworld'); ?></p>
                            <select id="dttheme-menu-link-arrow-style" name="dttheme[layout][menu-link-arrow-style]" class="small"><?php
                                $arrow_style = array( 'single' => esc_html__('Single','petsworld'),'double' => esc_html__('Double','petsworld'),'disc' => esc_html__('Disc','petsworld'));
                                foreach($arrow_style as $key => $v):
                                    $s = selected(petsworld_option('layout','menu-link-arrow-style'),$key,false);
                                    echo "<option value ='{$key}' $s >$v</option>";
                                endforeach;?>
                            </select>
                        </div>
                        <p class="note"><?php esc_html_e('Pick a default arrow & it style of the menu link.', 'petsworld'); ?></p>
                    </div>
                </div>
            </div><!-- Sub Menu .bpanel-box end -->

        </div><!--tab3-menu end-->

        <!--tab4-sociable -->
        <div id="tab4" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Sociable', 'petsworld'); ?></h3>
                </div>

                <div class="box-content">
                	<div class="bpanel-option-set">
                        <h6><?php esc_html_e('Show Sociable', 'petsworld'); ?></h6>
                        <div class="column one-fifth">
                           <?php $switchclass = ( "on" ==  petsworld_option('layout','show-sociables') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                           <div data-for="dttheme-show-sociables" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                           <input class="hidden" id="dttheme-show-sociables" name="dttheme[layout][show-sociables]" type="checkbox" 
                           <?php checked(petsworld_option('layout','show-sociables'),'on'); ?>/>
                        </div>
                        <input type="button" value="<?php esc_attr_e('Add New Sociable', 'petsworld'); ?>" class="black dttheme_add_item" />
                        <div class="column four-fifth last">
                           <p class="note"><?php esc_html_e('YES! to show social icons & Add new to the list to display', 'petsworld'); ?></p>
                        </div>
                        <div class="hr_invisible"></div>
					</div>

					<div class="bpanel-option-set">
                        <ul class="menu-to-edit">
                        <?php $socials = petsworld_option('social');
						      if(is_array($socials)):
							  	$keys = array_keys($socials);
								$i=0;
								
						 	  foreach($socials as $s):?>
                                  <li id="<?php echo esc_attr($keys[$i]); ?>">
                                    <div class="item-bar">
                                        <span class="item-title"><?php $n = $s['icon']; $n = substr($n, 3); $n = ucwords($n); echo esc_html( $n ); ?></span>
                                        <span class="item-control"><a class="item-edit"><?php esc_html_e('Edit', 'petsworld'); ?></a></span>
                                    </div>
                                    <div class="item-content" style="display: none;">
                                        <span><label><?php esc_html_e('Sociable Icon', 'petsworld'); ?></label>
                                            <?php echo petsworld_sociables_selection($keys[$i],$s['icon']); ?></span>
                                        <span><label><?php esc_html_e('Sociable Link', 'petsworld'); ?></label>
                                            <input type="text" class="social-link" name="dttheme[social][<?php echo esc_attr($keys[$i]); ?>][link]" value="<?php echo esc_attr($s['link']); ?>"/></span>
                                        <div class="remove-cancel-links">
                                            <span class="remove-item"><?php esc_html_e('Remove', 'petsworld'); ?></span>
                                            <span class="meta-sep"> | </span>
                                            <span class="cancel-item"><?php esc_html_e('Cancel', 'petsworld'); ?></span>
                                        </div>
                                    </div>
                                  </li>
                        <?php $i++; endforeach; endif;?> 
                        </ul>
                        
                        <ul class="sample-to-edit" style="display:none;">
                        	<li><!-- Social Item -->
                            	<div class="item-bar"><!-- .item-bar -->
                                	<span class="item-title"><?php esc_html_e('Sociable', 'petsworld'); ?></span>
                                    <span class="item-control"><a class="item-edit"><?php esc_html_e('Edit', 'petsworld'); ?></a></span>
                                </div><!-- .item-bar -->
                                <div class="item-content"><!-- .item-content -->                                
                                	<span><label><?php esc_html_e('Sociable Icon', 'petsworld'); ?></label><?php echo petsworld_sociables_selection(); ?></span>
                                    <span><label><?php esc_html_e('Sociable Link', 'petsworld'); ?></label><input type="text" class="social-link" /></span>
                                    <div class="remove-cancel-links">
                                        <span class="remove-item"><?php esc_html_e('Remove', 'petsworld'); ?></span>
                                        <span class="meta-sep"> | </span>
                                        <span class="cancel-item"><?php esc_html_e('Cancel', 'petsworld'); ?></span>
                                    </div>
                                </div><!-- .item-content end -->
                            </li><!-- Social Item End-->
                        </ul>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->            
        </div><!--tab4-sociable end-->

        <!--tab5-footer -->
        <div id="tab5" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">

                <div class="box-title">
                    <h3><?php esc_html_e('Footer', 'petsworld'); ?></h3>
                </div>
                
                <div class="box-content">

                    <div class="column one-half">
                        <h6><?php esc_html_e('Enable Footer Columns', 'petsworld'); ?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  petsworld_option('layout','enable-footer') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  petsworld_option('layout','enable-footer') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-layout-footer" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                              <input class="hidden" id="dttheme-layout-footer" name="dttheme[layout][enable-footer]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to use footer columns for this site.', 'petsworld'); ?></p>
                        </div>
                    </div>

                    <div class="column one-half last">
                        <h6><?php esc_html_e('Footer Dark BG', 'petsworld'); ?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  petsworld_option('layout','footer-darkbg') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  petsworld_option('layout','footer-darkbg') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-layout-footer-darkbg" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                              <input class="hidden" id="dttheme-layout-footer-darkbg" name="dttheme[layout][footer-darkbg]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to use dark background footer for this site.', 'petsworld'); ?></p>
                        </div>
                    </div>

                    <div class="hr"></div>

                    <div class="bpanel-option-set">
                        <h6><?php esc_html_e('Footer Column Layout', 'petsworld'); ?></h6>
                        <p class="note"><?php esc_html_e("Select a perfect column layout style for your theme's footer.", 'petsworld'); ?></p>
                        <ul class="bpanel-layout-set bpanel-post-layout">
                        <?php $footer_layouts = array(
									1=>'one-column',							2=>'one-half-column',
									3=>'one-third-column',						4=>'one-fourth-column',
									5=>'one-fifth-column',						6=>'one-sixth-column',
									12=>'onefourth-onefourth-onehalf-column',	13=>'onehalf-onefourth-onefourth-column',
                                    11 => 'onefourth-onehalf-onefourth-column',
									7=>'onefourth-threefourth-column',			8=>'threefourth-onefourth-column',
									9=>'onethird-twothird-column',				10=>'twothird-onethird-column',
                                    14 => 'twosixth-onesixth-onesixth-twosixth-column');
						//Footer layout options...
                        foreach($footer_layouts as $k => $v): 
                            $class = ( $k ==  petsworld_option('layout','footer-columns')) ? " class='selected' " : "";?>
                            <li><a href="#" rel="<?php echo esc_attr($k); ?>" <?php echo "{$class}";?>><img src="<?php echo PETSWORLD_THEME_URI . "/framework/theme-options/images/columns/{$v}.png";?>" /></a></li><?php 
                        endforeach;?>
                        </ul>
                        <input id="dttheme[layout][footer-columns]" name="dttheme[layout][footer-columns]" type="hidden" value="<?php echo petsworld_option('layout','footer-columns'); ?>"/>
	                    <div class="hr"></div>
                    </div>

                    <!-- footer-bg -->
                    <h6><?php esc_html_e('Footer Background Image', 'petsworld'); ?></h6>
                    <div class="image-preview-container">
                        <input id="dttheme-footerbg" name="dttheme[layout][footer-bg]" type="text" class="uploadfield" readonly="readonly" value="<?php echo petsworld_option('layout','footer-bg'); ?>" />
                        <input type="button" value="<?php esc_attr_e('Upload', 'petsworld'); ?>" class="upload_image_button show_preview" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'petsworld'); ?>" class="upload_image_reset" />
                        <?php petsworld_adminpanel_image_preview(petsworld_option('layout','footer-bg')); ?>
                    </div>
                    <p class="note"><?php esc_html_e('Upload an image for footer background, or specify the image url directly', 'petsworld'); ?></p>
                    <div class="clear"></div>
                    <!-- footer-bg -->
                    
                    <!-- Boxed Layout BG Settings -->
                    <div class="column one-half">

	                    <?php $bg_settings = array("repeat","repeat-x","repeat-y","no-repeat"); ?>

                        <div class="bpanel-option-set">
                          <label><?php esc_html_e('Background Image Repeat', 'petsworld'); ?></label>
                          <div class="clear"></div>
                          <select name="dttheme[layout][footer-bg-repeat]" class="dt-chosen-select">
                              <option value=""><?php esc_html_e("Select", 'petsworld'); ?></option>
                              <?php foreach($bg_settings as $option):?>
                                  <option value="<?php echo esc_attr($option); ?>"
                                      <?php selected($option,petsworld_option('layout', 'footer-bg-repeat')); ?>><?php echo esc_html( $option ); ?></option>
                              <?php endforeach;?>
                          </select>
                          <p class="note"><?php esc_html_e("Select how would you like to repeat the background image", 'petsworld'); ?></p>
                          <div class="hr_invisible"> </div>
                        </div>

                    </div><!-- Boxed Layout BG Settings End -->

                    <div class="column one-half last">

                    	<?php $bg_settings = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right"); ?>

                        <div class="bpanel-option-set">
                          <label><?php esc_html_e('Background Image Position', 'petsworld'); ?></label>
                          <div class="clear"></div>
                          <select name="dttheme[layout][footer-bg-position]" class="dt-chosen-select">
                              <option value=""><?php esc_html_e("Select", 'petsworld'); ?></option>
                              <?php foreach($bg_settings as $option):?>
                                  <option value="<?php echo esc_attr($option); ?>"
                                      <?php selected($option,petsworld_option('layout', 'footer-bg-position')); ?>><?php echo esc_html( $option ); ?></option>
                              <?php endforeach;?>
                          </select>
                          <p class="note"><?php esc_html_e("Select how would you like to position the background", 'petsworld'); ?></p>
                          <div class="hr_invisible"> </div>
                        </div>
                    </div><!-- Boxed Layout BG Settings End -->

                </div><!-- .box-content -->

                <div class="box-title">
                    <h3><?php esc_html_e('Copyright Section', 'petsworld'); ?></h3>
                </div>
                <div class="box-content">

                    <!-- enable-copyright -->
                    <div class="column one-half">
                        <h6><?php esc_html_e('Show Copyright Text', 'petsworld'); ?></h6>
                        <div class="column one-fifth">
                          <?php $checked = ( "true" ==  petsworld_option('layout','enable-copyright') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  petsworld_option('layout','enable-copyright') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-layout-copyright" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                          <input class="hidden" id="dttheme-layout-copyright" name="dttheme[layout][enable-copyright]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                        </div>
                        <div class="column four-fifth last">
                        <p class="note"><?php esc_html_e('YES! to show copyright text.', 'petsworld'); ?></p>
                        </div>
                        <div class="clear"></div>
                        <div class="hr_invisible"></div>
                        <!-- copyright content -->
                        <textarea id="dttheme[layout][copyright-content]" name="dttheme[layout][copyright-content]"><?php echo stripslashes(petsworld_option('layout', 'copyright-content')); ?></textarea>
                        <p class="note no-margin"><?php esc_html_e('Enter copyright text in this box. <br>This will be automatically added to the footer.', 'petsworld'); ?></p>
                        <!-- copyright content -->
                    </div><!-- enable-copyright -->

                    <!-- enable-copyright-darkbg -->
                    <div class="column one-half">
                        <h6><?php esc_html_e('Copyright Dark BG', 'petsworld'); ?></h6>
                        <div class="column one-fifth">
                            <?php $checked = ( "true" ==  petsworld_option('layout','copyright-darkbg') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  petsworld_option('layout','copyright-darkbg') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                            <div data-for="dttheme-layout-copyright-darkbg" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                            <input class="hidden" id="dttheme-layout-copyright-darkbg" name="dttheme[layout][copyright-darkbg]" type="checkbox" value="true" <?php echo "{$checked}";?>/>
                        </div>
                        <div class="column four-fifth last">
                            <p class="note"><?php esc_html_e('YES! to use dark bg copyright for this site.', 'petsworld'); ?></p>
                        </div>
                        <div class="clear"></div>
                        <div class="hr_invisible"></div>
                    </div><!-- enable-copyright-darkbg -->
                </div>
            </div><!-- .bpanel-box end -->            
        </div><!--tab5-footer end-->

        <!--tab6-hooks -->
        <div id="tab6" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Custom CSS', 'petsworld'); ?></h3>
                </div>

                <div class="box-content">
                     <h6><?php esc_html_e('Enable Custom CSS', 'petsworld'); ?></h6>
                     <div class="column one-fifth">
                          <?php $checked = ( "true" ==  petsworld_option('layout','enable-customcss') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  petsworld_option('layout','enable-customcss') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-layout-customcss" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                          <input class="hidden" id="dttheme-layout-customcss" name="dttheme[layout][enable-customcss]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                     </div>
                     <div class="column four-fifth last">
                        <p class="note"><?php esc_html_e('YES! to use custom CSS.', 'petsworld'); ?></p>
                     </div>
                     <div class="clear"></div>
                     <div class="hr_invisible_large"></div>
                     <textarea id="dttheme[layout][customcss-content]" name="dttheme[layout][customcss-content]"><?php echo stripslashes(petsworld_option('layout', 'customcss-content')); ?></textarea>
                     <p class="note"><?php esc_html_e('Enter your custom CSS code here.', 'petsworld'); ?></p>

                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->            

            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Custom JS', 'petsworld'); ?></h3>
                </div>

                <div class="box-content">
                     <h6><?php esc_html_e('Enable Custom JS', 'petsworld'); ?></h6>
                     <div class="column one-fifth">
                          <?php $checked = ( "true" ==  petsworld_option('layout','enable-customjs') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  petsworld_option('layout','enable-customjs') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-layout-customjs" class="checkbox-switch <?php echo esc_attr($switchclass); ?>"></div>
                          <input class="hidden" id="dttheme-layout-customjs" name="dttheme[layout][enable-customjs]" type="checkbox" value="true" <?php echo "{$checked}";?> />
                     </div>
                     <div class="column four-fifth last">
                        <p class="note"><?php esc_html_e('YES! to use custom JS', 'petsworld'); ?></p>
                     </div>
                     <div class="clear"></div>
                     <div class="hr_invisible_large"></div>
                     <textarea id="dttheme[layout][customjs-content]" name="dttheme[layout][customjs-content]"><?php echo stripslashes(petsworld_option('layout', 'customjs-content')); ?></textarea>
                     <p class="note"><?php esc_html_e('Enter your custom JS code here. <br><b>To use jQuery code wrap it into jQuery(function($){ ... });</b>', 'petsworld'); ?></p>

                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->
        </div><!--tab6-hooks end-->
    </div><!-- .bpanel-main-content end-->
</div><!--layout end-->