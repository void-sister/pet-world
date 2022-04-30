<?php add_action( 'vc_before_init', 'dt_sc_twitter_tweets_vc_map' );
function dt_sc_twitter_tweets_vc_map() {

	vc_map( array( 
		"name" => esc_html__( "Twitter tweets", 'petsworld-core' ),
		"base" => "dt_sc_twitter_tweets",
		"icon" => "dt_sc_twitter_tweets",
		"category" => DT_VC_CATEGORY,
		"params" => array(

			# Consumer Key
			array(
				'type' => 'textfield',
				'param_name' => 'consumerkey',
				'heading' => esc_html__( 'Consumer key', 'petsworld-core' ),
				'description' => esc_html__( 'Enter Consumer key', 'petsworld-core' ),
			),

			# Consumer secret
			array(
				'type' => 'textfield',
				'param_name' => 'consumersecret',
				'heading' => esc_html__( 'Consumer secret', 'petsworld-core' ),
				'description' => esc_html__( 'Enter Consumer secret', 'petsworld-core' ),
			),

			# Access token 
			array(
				'type' => 'textfield',
				'param_name' => 'accesstoken',
				'heading' => esc_html__( 'Access token', 'petsworld-core' ),
				'description' => esc_html__( 'Enter Access token', 'petsworld-core' ),
			),

			# Access token secret
			array(
				'type' => 'textfield',
				'param_name' => 'accesstokensecret',
				'heading' => esc_html__( 'Access token secret', 'petsworld-core' ),
				'description' => esc_html__( 'Enter Access token secret', 'petsworld-core' ),
			),

			# Consumer Key
			array(
				'type' => 'textfield',
				'param_name' => 'username',
				'heading' => esc_html__( 'Twitter username', 'petsworld-core' ),
				'description' => esc_html__( 'Enter Twitter username', 'petsworld-core' ),
			),

			# Avatar
			array(
				'type' => 'dropdown',
				'param_name' => 'useravatar',
				'heading' => esc_html__('Show avatar?','petsworld-core'),
				'value' => array( esc_html__('Yes','petsworld-core') => 'yes' , esc_html__('No','petsworld-core') => 'no' ),
				'std' => 'no'
			)
		)		
	) );
}?>