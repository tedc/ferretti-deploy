<?php 
add_action( 'admin_init', 'address_settings_init' );

function address_add_admin_menu(  ) { 

	#add_submenu_page( null, null, null, 'manage_options', 'social', 'social_options_page' );
	add_menu_page( __('Indirizzi<br/>e telefono'), __('Indirizzi<br/>e telefono'), 'manage_options', 'address', 'address_options_page' );
}

add_action( 'admin_menu', 'address_add_admin_menu' );
function address_settings_init() { 
	add_settings_section(
		'address_settings', 
		__( 'Indirizzi e telefono', 'frt' ), 
		'address_settings_section_callback', 
		'address'
	);
    register_setting( 'address', 'address_settings' );
	add_settings_field(
		'contact', 
		__( 'E-mail form contatti', 'frt' ), 
		'contact_field', 
		'address', 
		'address_settings' 
	);
    add_settings_field( 
		'appointment', 
		__( 'E-mail appuntamenti', 'frt' ), 
		'app_field', 
		'address', 
		'address_settings' 
	);
    add_settings_field( 
		'phone', 
		__( 'Telefono', 'frt' ), 
		'phone_field', 
		'address', 
		'address_settings' 
	);
	
}
function address_settings_section_callback(  ) { 

	echo __( 'Campi per i form e il footer', 'frt' );

}
function contact_field(  ) { 

	$options = get_option( 'address_settings' );
	?>
	<input type='text' name='address_settings[contact]' value='<?php echo $options['contact']; ?>'>
	<?php

}
function app_field(  ) { 

	$options = get_option( 'address_settings' );
	?>
	<input type='text' name='address_settings[appointment]' value='<?php echo $options['appointment']; ?>'>
	<?php

}
function phone_field(  ) { 

	$options = get_option( 'address_settings' );
	?>
	<input type='text' name='address_settings[phone]' value='<?php echo $options['phone']; ?>'>
	<?php

}

function address_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<?php
		settings_fields( 'address' );
		do_settings_sections( 'address' );
		submit_button();
		?>

	</form>
	<?php

}


// SOCIAL
add_action( 'admin_init', 'social_settings_init' );

function social_add_admin_menu(  ) { 

	#add_submenu_page( null, null, null, 'manage_options', 'social', 'social_options_page' );
	add_menu_page( __('Social network settings'), __('Social'), 'manage_options', 'social', 'social_options_page' );
}

add_action( 'admin_menu', 'social_add_admin_menu' );

function social_settings_init(  ) { 
	
    register_setting( 'social', 'ga_settings' );
    
	add_settings_section(
		'ga_section', 
		__( 'Google Analytics', 'frt' ), 
		'ga_settings_section_callback', 
		'social'
	);
    add_settings_field( 
		'ga_id', 
		__( 'Identificativo Google Analitycs', 'frt' ), 
		'ga_field', 
		'social', 
		'ga_section' 
	);
    
    
    
    register_setting( 'social', 'social_settings' );
	register_setting( 'social', 'instagram_settings' );
	register_setting( 'social', 'facebook_settings' );
    
    
	add_settings_section(
		'social_section', 
		__( 'Link social', 'frt' ), 
		'social_settings_section_callback', 
		'social'
	);

	add_settings_field( 
		'facebook', 
		__( 'Facebook', 'frt' ), 
		'social_facebook_field', 
		'social', 
		'social_section' 
	);
	
	add_settings_field( 
		'facebook_page_id', 
		__( 'Facebook Page Id', 'frt' ), 
		'social_facebook_pi_field', 
		'social', 
		'social_section' 
	);
	
	add_settings_field( 
		'facebook_app_id', 
		__( 'Facebook App Id', 'frt' ), 
		'social_facebook_ai_field', 
		'social', 
		'social_section' 
	);
    add_settings_field( 
		'facebook_app_secret', 
		__( 'Facebook App Secret', 'frt' ), 
		'social_facebook_as_field', 
		'social', 
		'social_section' 
	);
    add_settings_field( 
		'facebook_access_token', 
		__( 'Facebook Access Token', 'frt' ), 
		'social_facebook_at_field', 
		'social', 
		'social_section' 
	);

	add_settings_field( 
		'instagram', 
		__( 'Instagram', 'frt' ), 
		'social_instagram_field', 
		'social', 
		'social_section' 
	);
    add_settings_field( 
		'instagram_client_id', 
		__( 'Instagram client id', 'frt' ), 
		'social_instagram_ci_field', 
		'social', 
		'social_section' 
	);
    add_settings_field( 
		'instagram_client_secret', 
		__( 'Instagram client secret', 'frt' ), 
		'social_instagram_cs_field', 
		'social', 
		'social_section' 
	);
    add_settings_field( 
		'instagram_access_token', 
		__( 'Instagram access token', 'frt' ), 
		'social_instagram_at_field', 
		'social', 
		'social_section' 
	);
    
    add_settings_field( 
		'instagram_user_id', 
		__( 'Instagram user id', 'frt' ), 
		'social_instagram_ui_field', 
		'social', 
		'social_section' 
	);
    
    add_settings_field( 
		'instagram_count', 
		__( 'Quantità di foto da mostrare', 'frt' ), 
		'social_instagram_count_field', 
		'social', 
		'social_section' 
	);

}
function ga_field(  ) { 

	$options = get_option( 'ga_settings' );
	?>
	<input type='text' name='ga_settings[ga_id]' value='<?php echo $options['ga_id']; ?>'>
	<?php

}


function social_facebook_field(  ) { 

	$options = get_option( 'social_settings' );
	?>
	<input type='text' name='social_settings[facebook]' value='<?php echo $options['facebook']; ?>'>
	<?php

}
function social_facebook_pi_field(  ) { 

	$options = get_option( 'facebook_settings' );
	?>
	<input type='text' name='facebook_settings[facebook_page_id]' value='<?php echo $options['facebook_page_id']; ?>'>	
<?php

}
function social_facebook_ai_field(  ) { 

	$options = get_option( 'facebook_settings' );
	?>
	<input type='text' name='facebook_settings[facebook_app_id]' value='<?php echo $options['facebook_app_id']; ?>'>	
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
<?php if(isset(get_option('facebook_settings')['facebook_error_message'])) : ?>
<div><?php echo get_option('facebook_settings')['facebook_error_message']; ?></div>
	<?php endif; ?>
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


function social_settings_section_callback(  ) { 

	echo __( 'Link per le pagine social', 'frt' );

}


function social_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<h2>Social networks settings</h2>

		<?php
		settings_fields( 'social' );
		do_settings_sections( 'social' );
		submit_button();
		?>

	</form>
	<?php

}

function update_facebook_social_settings($new_value, $old_value) {
	if($old_value['facebook_access_token'] != $new_value['facebook_access_token']) {
		$new_value = extend_access_token($new_value);
	} else {
		$new_value = $old_value;
	}
	return $new_value;
}
function facebook_at_init() {
	add_filter('pre_update_option_facebook_settings', 'update_facebook_social_settings', 10, 2);
}
						  
add_action('init', 'facebook_at_init');