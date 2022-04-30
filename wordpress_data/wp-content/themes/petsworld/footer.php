        </div><!-- **Container - End** -->

        </div><!-- **Main - End** --><?php

		do_action( 'petsworld_hook_content_after' );

        // footer sections
        $footer 			= petsworld_option('layout','enable-footer');
        $copyright_section  = petsworld_option('layout','enable-copyright');

        if( isset($footer) || isset( $copyright_section) ) {?>
            <!-- **Footer** -->
            <footer id="footer"><?php
                if( isset( $footer ) ):
                    $darkbg = petsworld_option('layout','footer-darkbg');
                    $class = isset( $darkbg ) ? " dt-sc-dark-bg" : ""; ?>

                    <div class="footer-widgets<?php echo esc_attr( $class ); ?>">
                        <div class="container"><?php
                            $columns = petsworld_option ('layout','footer-columns');
                            petsworld_show_footer_widgetarea($columns); ?>
                        </div>
                    </div><?php
                endif;

                if( isset( $copyright_section) ):
                    $darkbg = petsworld_option('layout','copyright-darkbg');
                    $class = isset( $darkbg ) ? " dt-sc-dark-bg" : ""; ?>

                    <div class="footer-copyright<?php echo esc_attr( $class ); ?>">
                        <div class="container"><?php
                            $content = petsworld_option('layout','copyright-content');
                            $content = stripslashes ( $content );
                            $content = do_shortcode( $content );
                            if( class_exists ( 'DTCorePlugin' ) ):						
                                echo petsworld_wp_kses( $content );
                            endif; ?>
                        </div>
                    </div><?php
                endif;?>
            </footer><!-- **Footer - End** --><?php
        } ?>

	</div><!-- **Inner Wrapper - End** -->
</div><!-- **Wrapper - End** -->
<?php do_action( 'petsworld_hook_bottom' ); ?>
<?php wp_footer(); ?>
</body>
</html>