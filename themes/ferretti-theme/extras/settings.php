<?php 

add_action( 'admin_init', 'social_settings_init' );

function social_add_admin_menu(  ) { 

	add_submenu_page( null, null, null, 'manage_options', 'general', 'social_options_page' );

}


function social_settings_init(  ) { 

	
    register_setting( 'general', 'ga_settings' );
    
	add_settings_section(
		'ga_section', 
		__( 'Google Analytics', 'frt' ), 
		'ga_settings_section_callback', 
		'general'
	);
    add_settings_field( 
		'ga_id', 
		__( 'Identificativo Google Analitycs', 'frt' ), 
		'ga_field', 
		'general', 
		'ga_section' 
	);
    
    register_setting( 'general', 'tour_settings' );
	add_settings_field( 
		'tour_email', 
		__( 'Indirizzo email di ricezione per gli itinerari', 'frt' ), 
		'tour_field', 
		'general', 
		'tour_section' 
	);
    add_settings_section(
		'tour_section', 
		__( 'Gli itinerari di frt', 'frt' ), 
		'tour_settings_section_callback', 
		'general'
	);
    
    register_setting( 'general', 'social_settings' );
	register_setting( 'general', 'instagram_settings' );
	register_setting( 'general', 'facebook_settings' );
    
    
	add_settings_section(
		'social_section', 
		__( 'Link social', 'frt' ), 
		'social_settings_section_callback', 
		'general'
	);

	add_settings_field( 
		'facebook', 
		__( 'Facebook', 'frt' ), 
		'social_facebook_field', 
		'general', 
		'social_section' 
	);
	
	add_settings_field( 
		'facebook_app_id', 
		__( 'Facebook App Id', 'frt' ), 
		'social_facebook_ai_field', 
		'general', 
		'social_section' 
	);
    add_settings_field( 
		'facebook_app_secret', 
		__( 'Facebook App Secret', 'frt' ), 
		'social_facebook_as_field', 
		'general', 
		'social_section' 
	);
    add_settings_field( 
		'facebook_access_token', 
		__( 'Instagram Access Token', 'frt' ), 
		'social_facebook_at_field', 
		'general', 
		'social_section' 
	);

	add_settings_field( 
		'instagram', 
		__( 'Instagram', 'frt' ), 
		'social_instagram_field', 
		'general', 
		'social_section' 
	);
    add_settings_field( 
		'instagram_client_id', 
		__( 'Instagram client id', 'frt' ), 
		'social_instagram_ci_field', 
		'general', 
		'social_section' 
	);
    add_settings_field( 
		'instagram_client_secret', 
		__( 'Instagram client secret', 'frt' ), 
		'social_instagram_cs_field', 
		'general', 
		'social_section' 
	);
    add_settings_field( 
		'instagram_access_token', 
		__( 'Instagram access token', 'frt' ), 
		'social_instagram_at_field', 
		'general', 
		'social_section' 
	);
    
    add_settings_field( 
		'instagram_user_id', 
		__( 'Instagram user id', 'frt' ), 
		'social_instagram_ui_field', 
		'general', 
		'social_section' 
	);
    
    add_settings_field( 
		'instagram_count', 
		__( 'Quantità di foto da mostrare', 'frt' ), 
		'social_instagram_count_field', 
		'general', 
		'social_section' 
	);

}
function ga_field(  ) { 

	$options = get_option( 'ga_settings' );
	?>
	<input type='text' name='ga_settings[ga_id]' value='<?php echo $options['ga_id']; ?>'>
	<?php

}

function tour_field(  ) { 

	$options = get_option( 'tour_settings' );
	?>
	<input type='email' name='tour_settings[email]' value='<?php echo $options['email']; ?>'>
	<?php

}

function social_facebook_field(  ) { 

	$options = get_option( 'social_settings' );
	?>
	<input type='text' name='social_settings[facebook]' value='<?php echo $options['facebook']; ?>'>
	<?php

}

function social_facebook_ai_field(  ) { 

	$options = get_option( 'facebook_settings' );
	?>
	<input type='text' name='facebooksettings[facebook_app_id]' value='<?php echo $options['facebook_app_id']; ?>'>	
<?php

}
function social_facebook_as_field(  ) { 

	$options = get_option( 'facebook_settings' );
	?>
	<input type='text' name='facebook_settings[facebook_app_secret]' value='<?php echo $options['facebook_app_secret']; ?>'>	
<?php

}
function social_facebook_at_field(  ) { 

	$options = get_option( 'facebook_settings' );
	?>
	<input type='text' name='facebook_settings[facebook_access_token]' value='<?php echo $options['facebook_access_token']; ?>'>	
<?php

}


function social_instagram_field(  ) { 

	$options = get_option( 'social_settings' );
	?>
	<input type='text' name='social_settings[instagram]' value='<?php echo $options['instagram']; ?>'>
		
<?php

}

function social_instagram_ci_field(  ) { 

	$options = get_option( 'instagram_settings' );
	?>
	<input type='text' name='instagram_settings[instagram_client_id]' value='<?php echo $options['instagram_client_id']; ?>'>	
<?php

}
function social_instagram_cs_field(  ) { 

	$options = get_option( 'instagram_settings' );
	?>
	<input type='text' name='instagram_settings[instagram_client_secret]' value='<?php echo $options['instagram_client_secret']; ?>'>	
<?php

}
function social_instagram_at_field(  ) { 

	$options = get_option( 'instagram_settings' );
	?>
	<input type='text' name='instagram_settings[instagram_access_token]' value='<?php echo $options['instagram_access_token']; ?>'>	
<?php

}
function social_instagram_ui_field(  ) { 

	$options = get_option( 'instagram_settings' );
	?>
	<input type='text' name='instagram_settings[instagram_user_id]' value='<?php echo $options['instagram_user_id']; ?>'>	
<?php

}
function social_instagram_count_field(  ) { 

	$options = get_option( 'instagram_settings' );
	?>
	<input type='text' name='instagram_settings[instagram_count]' value='<?php echo $options['instagram_count']; ?>'>	
<?php

}
function ga_settings_section_callback(  ) { 

	echo __( 'Impostazioni per il codice di Google Analytics', 'frt' );

}

function tour_settings_section_callback(  ) { 

	echo __( 'Impostazioni per il form dei singoli itinerari', 'frt' );

}

function social_settings_section_callback(  ) { 

	echo __( 'Link per le pagine social', 'frt' );

}


function social_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<h2>Social</h2>

		<?php
		settings_fields( 'general' );
		do_settings_sections( 'general' );
		submit_button();
		?>

	</form>
	<?php

}