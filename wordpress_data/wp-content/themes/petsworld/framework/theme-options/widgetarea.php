<!--widgetarea -->
<div id="widgetarea" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel"> 
            <li><a href="#tab1"><?php esc_html_e('Sidebar', 'petsworld'); ?></a></li>
        </ul>
        
        <!--tab1-custom-widgetarea -->
        <div id="tab1" class="tab-content">

            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Create New Widget Area', 'petsworld'); ?></h3>
                </div>
                
                <div class="box-content">
                    <p class="note"><?php esc_html_e("You can create widget areas here, and assign them in individual page / post", 'petsworld'); ?></p>
                    <div class="bpanel-option-set">
                        <input type="button" data-for="custom" value="<?php esc_attr_e('Add New Widget Area', 'petsworld'); ?>" class="black dttheme_add_widgetarea" />
                        <div class="hr_invisible"></div><?php
                        $widgets = petsworld_option('widgetarea','custom');
                        $widgets = is_array($widgets) ? array_unique($widgets) : array();
                        $widgets = array_filter($widgets); ?>
                    </div>
                    <div class="bpanel-option-set">
                      <ul class="added-menu"><?php
                          foreach( $widgets as $k => $v){?>
                              <li>
                                <div class="item-bar">
                                  <span class="item-title"><?php esc_html_e('Widget Area:', 'petsworld'); echo" $v";?></span>
                                  <span class="item-control"><a class="item-edit"><?php esc_html_e('Edit', 'petsworld'); ?></a></span>
                                </div>
                                <div class="item-content" style="display: none;">
                                  <span><label><?php esc_html_e('Name', 'petsworld'); ?></label><input type="text" name="dttheme[widgetarea][custom][]" class="social-link" value="<?php echo esc_attr($v); ?>" /></span>
                                  <div class="remove-cancel-links">
                                    <span class="remove-item"><?php esc_html_e('Remove', 'petsworld'); ?></span>
                                    <span class="meta-sep"> | </span>
                                    <span class="cancel-item"><?php esc_html_e('Cancel', 'petsworld'); ?></span>
                                  </div>
                                </div>
                              </li><?php
                          }?>
                      </ul>

                      <ul class="sample-to-edit" style="display:none;">
                        <li>
                          <div class="item-bar">
                            <span class="item-title"><?php esc_html_e('Widget Area', 'petsworld'); ?></span>
                            <span class="item-control"><a class="item-edit"><?php esc_html_e('Edit', 'petsworld'); ?></a></span>
                          </div>

                          <div class="item-content">
                            <span><label><?php esc_html_e('Name', 'petsworld'); ?></label><input type="text" class="social-link" /></span>
                            <div class="remove-cancel-links">
                              <span class="remove-item"><?php esc_html_e('Remove', 'petsworld'); ?></span>
                              <span class="meta-sep"> | </span>
                              <span class="cancel-item"><?php esc_html_e('Cancel', 'petsworld'); ?></span>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->

        </div><!--tab1-custom-widgetarea end-->

    </div><!-- .bpanel-main-content end-->
</div><!--widgetarea end-->