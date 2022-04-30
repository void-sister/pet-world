<!--backup -->
<div id="backup" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel"> 
            <li><a href="#tab1"><?php esc_html_e('Backup', 'petsworld'); ?></a></li>
        </ul>
        
        <!--tab1-backup -->
        <div id="tab1" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Backup & Restore Options', 'petsworld'); ?></h3>
                </div>

                <div class="box-content">
                	<div><?php
                    	esc_html_e('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'petsworld'); ?>
                    </div><?php
					$backup = get_option('dt_theme_backup');
					$log = ( is_array( $backup) && array_key_exists('backup',$backup) ) ? $backup['backup'] : esc_html__('No backups yet', 'petsworld'); ?>
					<p><strong><?php esc_html_e('Last Backup : ', 'petsworld'); ?><span class="backup-log"><?php echo esc_html( $log ); ?></span></strong></p>
					<div class="clar"></div>
					<div class="hr_invisible"></div>
					<a href="#" id="dttheme_backup_button" class="bpanel-button black-btn" title="<?php esc_attr_e('Backup Options', 'petsworld'); ?>"><?php esc_html_e('Backup Options', 'petsworld'); ?></a>
					<a href="#" id="dttheme_restore_button" class="bpanel-button black-btn" title="<?php esc_attr_e('Restore Options', 'petsworld'); ?>"><?php esc_html_e('Restore Options', 'petsworld'); ?></a>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->
        </div><!--tab1-backup end-->

    </div><!-- .bpanel-main-content end-->
</div><!--backup end-->