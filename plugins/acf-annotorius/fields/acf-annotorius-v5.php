<?php

/*
*  ACF Image Field Class
*
*  All the logic for this field type
*
*  @class 		acf_field_annotorius
*  @extends		acf_field
*  @package		ACF
*  @subpackage	Fields
*/

if( ! class_exists('acf_field_annotorius') ) :

class acf_field_annotorius extends acf_field {
	
	
	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function __construct() {
		
		// vars
		$this->name = 'annotorius';
		$this->label = __("Annotorius",'acf');
		$this->category = 'content';
		$this->defaults = array(
			'return_format'	=> 'array',
            'annotorious_type'	=> 'polygon',
			'preview_size'	=> 'full',
			'library'		=> 'all',
			'min_width'		=> 0,
			'min_height'	=> 0,
			'min_size'		=> 0,
			'max_width'		=> 0,
			'max_height'	=> 0,
			'max_size'		=> 0,
			'mime_types'	=> ''
		);
		$this->l10n = array(
			'select'		=> __("Select Image",'acf'),
			'edit'			=> __("Edit Image",'acf'),
			'update'		=> __("Update Image",'acf'),
			'uploadedTo'	=> __("Uploaded to this post",'acf'),
			'all'			=> __("All images",'acf'),
		);
		
		
		// filters
		add_filter('get_media_item_args',				array($this, 'get_media_item_args'));
		add_filter('wp_prepare_attachment_for_js',		array($this, 'wp_prepare_attachment_for_js'), 10, 3);
		
		
		// do not delete!
    	parent::__construct();
    
    }
    /*
    *  input_admin_enqueue_scripts()
    *
    *  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
    *  Use this action to add CSS + JavaScript to assist your render_field() action.
    *
    *  @type    action (admin_enqueue_scripts)
    *  @since   3.6
    *  @date    23/01/13
    *
    *  @param   n/a
    *  @return  n/a
    */



    function input_admin_enqueue_scripts() {
        $dir = plugin_dir_url(dirname( __FILE__ ));


        // // register & include JS
        // wp_register_script( 'acf-input-image_crop', "{$dir}js/input.js" );
        // wp_enqueue_script('acf-input-image_crop');


        // // register & include CSS
        // wp_register_style( 'acf-input-image_crop', "{$dir}css/input.css" );
        // wp_enqueue_style('acf-input-image_crop');

        // register acf scripts
        //wp_register_script('acf-input-image', "{$dir}../advanced-custom-fields-pro/js/input/image.js");
        wp_register_script('acf-jquery-observe', "{$dir}assets/js/jquery-observe.js", array('jquery'));
        wp_register_script('acf-annotorious', "{$dir}assets/js/annotorious/annotorious.min.js", array('acf-input', 'imgareaselect'));
        wp_register_script('acf-freehand', "{$dir}assets/js/annotorious/polygon_selector.js", array('acf-input', 'imgareaselect'));
        wp_register_script('acf-input-image-annotorious', "{$dir}assets/js/input.js", array('acf-input', 'imgareaselect'));

        wp_register_style('acf-annotorious', "{$dir}assets/css/annotorious.css", array('acf-input'));

        // scripts
        wp_enqueue_script(array(
                'acf-jquery-observe',
                'acf-annotorious',
                'acf-input-image-annotorious',
                'acf-freehand'
        ));

        //wp_localize_script( 'acf-input-image_crop', 'ajax', array('nonce' => wp_create_nonce('acf_nonce')) );

//        // styles
        wp_enqueue_style(array(
                'acf-annotorious',
                'imgareaselect'
        ));


    }
	
	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function render_field( $field ) {
		 // validate value
        if(empty($field)){
		  $field['value'] = array();
        }
        // value
		$field['value'] = wp_parse_args($field['value'], array('annotation_data' => false, 'annotation' => false, 'image' => false));
        // vars
		$uploader = acf_get_setting('uploader');
		
		// enqueue
		if( $uploader == 'wp' ) {
			
			acf_enqueue_uploader();
			
		}
		
		
		// vars
		$url = '';
		$alt = '';
		$div = array(
			'class'					=> 'acf-image-uploader acf-cf acf-image-annotorius',
			'data-preview_size'		=> $field['preview_size'],
			'data-library'			=> $field['library'],
			'data-mime_types'		=> $field['mime_types'],
            'data-annotorious-type' => $field['annotorious_type']
		);
		
		
		// has value?
		if( $field['value']['image'] ) {
			
			// update vars
			$url = wp_get_attachment_image_src($field['value']['image'], $field['preview_size']);
			$alt = get_post_meta($field['value']['image'], '_wp_attachment_image_alt', true);
			
			
			// url exists
			if( $url ) $url = $url[0];
			
			
			// url exists
			if( $url ) {
				
				$div['class'] .= ' has-value';
			
			}
						
		}
		
		// get size of preview value
		$size = acf_get_image_size($field['preview_size']);
		
?>
<div <?php acf_esc_attr_e( $div ); ?>>
	<div class="acf-hidden">
        <?php foreach($field['value'] as $k => $v ) : ?>
        <?php $val = ($v) ? 'value="'.esc_attr( $v ).'"' : ''; ?>
        <input type="hidden" class="input-<?php echo $k; ?>" name="<?php echo esc_attr($field['name']); ?>[<?php echo $k; ?>]" <?php echo $val; ?> data-name="annotorius-<?php echo $k; ?>" />
        <?php endforeach; ?>
	</div>
	<div class="view show-if-value acf-soh" <?php if( $size['width'] ) echo 'style="max-width: '.$size['width'].'px"'; ?>>
		<img data-name="image" src="<?php echo $url; ?>" alt="<?php echo $alt; ?>" class="annotatable"/>
		<ul class="acf-hl acf-soh-target">
			<?php if( $uploader != 'basic' ): ?>
				<li><a class="acf-icon -pencil dark" data-name="edit" href="#" title="<?php _e('Edit', 'acf'); ?>"></a></li>
			<?php endif; ?>
			<li><a class="acf-icon -cancel dark" data-name="remove" href="#" title="<?php _e('Remove', 'acf'); ?>"></a></li>
		</ul>
		<div class="annotorious-popup-field">
			<div class="acf-input">
				<select class="" name="render_kind">
					<option value=""><?php echo __('- Cosa è? -', 'frt'); ?></option>
					<option value="floor"><?php echo __('Piano', 'frt'); ?></option>
					<option value="house"><?php echo __('Unità abitativa', 'frt'); ?></option>
					<option value="room"><?php echo __('Locali', 'frt'); ?></option>
				</select>
			</div>
			<div class="acf-input" data-render-type="floor">
				<div class="acf-input-prepend"><?php echo __('Piano', 'frt'); ?></div><div class="acf-input-wrap"><input type="number" name="floor" /></div>
			</div>
			<div class="acf-input" data-render-type="house">
				<?php if(isset($_GET['post'])) {
					$args = array(
						'post_type' => 'immobili',
						'posts_per_page' => -1,
						'post_status' => 'publish',
						'post_parent' => $_GET['post']
					);
				} else {
					$args = array(
						'post_type' => 'immobili',
						'posts_per_page' => -1,
						'post_status' => 'publish'
					);
				} ?>
				<?php $q = new WP_Query($args); ?>
				<?php if($q->have_posts()) : ?>
				<select class="" name="house">
					<option value=""><?php echo __('- Seleziona un\'unità abitativa -', 'frt'); ?></option>
					<?php while($q->have_posts()) : $q->the_post(); ?>
					<option value="<?php the_ID(); ?>"><?php the_title(); ?></option>
					<?php endwhile; ?>
				</select>
				<?php else : ?>
				<p><?php echo __('L\'immobile non ha ancora apparatamenti assegnati', 'frt'); ?></p>
				<?php endif; ?>
				
			</div>
			<nav class="annotorious-buttons">
					
				<a hre="#" class="button button-primary delete"><?php echo __('Rimuovi', 'frt'); ?></a>
					
				<a hre="#" class="button button-primary update"><?php echo __('Aggiorna', 'frt'); ?></a>
		
				<a hre="#" class="button button-primary cancel"><?php echo __('Annulla', 'frt'); ?></a>
					
				<a hre="#" class="button button-primary save"><?php echo __('Salva', 'frt'); ?></a>
					
			</nav>
		</div>
	</div>
	<div class="view hide-if-value">
		<?php if( $uploader == 'basic' ): ?>
			
			<?php if( $field['value']['image'] && !is_numeric($field['value']['image']) ): ?>
				<div class="acf-error-message"><p><?php echo $field['value']['image']; ?></p></div>
			<?php endif; ?>
			
			<input type="file" name="<?php echo $field['name']['image']; ?>" id="<?php echo $field['id']; ?>" />
			
		<?php else: ?>
			
			<p style="margin:0;"><?php _e('No image selected','acf'); ?> <a data-name="add" class="acf-button button" href="#"><?php _e('Add Image','acf'); ?></a></p>
			
		<?php endif; ?>
	</div>
</div>
<?php
		
	}
	
	
	/*
	*  render_field_settings()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/
	
	function render_field_settings( $field ) {
		
		// clear numeric settings
		$clear = array(
			'min_width',
			'min_height',
			'min_size',
			'max_width',
			'max_height',
			'max_size'
		);
		
		foreach( $clear as $k ) {
			
			if( empty($field[$k]) ) {
				
				$field[$k] = '';
				
			}
			
		}
		
		
		// return_format
		acf_render_field_setting( $field, array(
			'label'			=> __('Return Value','acf'),
			'instructions'	=> __('Specify the returned value on front end','acf'),
			'type'			=> 'radio',
			'name'			=> 'return_format',
			'layout'		=> 'horizontal',
			'choices'		=> array(
				'array'			=> __("Image Array",'acf'),
				'url'			=> __("Image URL",'acf'),
				'id'			=> __("Image ID",'acf')
			)
		));
		
		
		// preview_size
		acf_render_field_setting( $field, array(
			'label'			=> __('Preview Size','acf'),
			'instructions'	=> __('Shown when entering data','acf'),
			'type'			=> 'select',
			'name'			=> 'preview_size',
			'choices'		=> acf_get_image_sizes()
		));
        
		
		// preview_size
		acf_render_field_setting( $field, array(
			'label'			=> __('Preview Size','acf'),
			'instructions'	=> __('Shown when entering data','acf'),
			'type'			=> 'radio',
			'name'			=> 'annotorious_type',
			'choices'		=> array(
				'rect'			=> __("Rect",'acf'),
				'polygon'		=> __("Polygon",'acf')
			)
		));
		
		
		// library
		acf_render_field_setting( $field, array(
			'label'			=> __('Library','acf'),
			'instructions'	=> __('Limit the media library choice','acf'),
			'type'			=> 'radio',
			'name'			=> 'library',
			'layout'		=> 'horizontal',
			'choices' 		=> array(
				'all'			=> __('All', 'acf'),
				'uploadedTo'	=> __('Uploaded to post', 'acf')
			)
		));
		
		
	}
	
	
	/*
	*  format_value()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value which was loaded from the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*
	*  @return	$value (mixed) the modified value
	*/
	
	function format_value( $value, $post_id, $field ) {
		
		// bail early if no value
		if( empty($value) ) return false;
		
		foreach($value as $k => $v) {
            if($k == 'image'){
                // bail early if not numeric (error message)
                if( !is_numeric($v) ) return false;


                // convert to int
                $v = intval($v);


                // format
                if( $field['return_format'] == 'url' ) {

                    return wp_get_attachment_url( $v );

                } elseif( $field['return_format'] == 'array' ) {

                    return acf_get_attachment( $v );

                }
            }
		}
		// return
		return $value;
		
	}
	
	
	/*
	*  get_media_item_args
	*
	*  description
	*
	*  @type	function
	*  @date	27/01/13
	*  @since	3.6.0
	*
	*  @param	$vars (array)
	*  @return	$vars
	*/
	
	function get_media_item_args( $vars ) {
	    $vars['send'] = true;
	    return($vars);
	    
	}
		
	
	/*
	*  wp_prepare_attachment_for_js
	*
	*  this filter allows ACF to add in extra data to an attachment JS object
	*  This sneaky hook adds the missing sizes to each attachment in the 3.5 uploader. 
	*  It would be a lot easier to add all the sizes to the 'image_size_names_choose' filter but 
	*  then it will show up on the normal the_content editor
	*
	*  @type	function
	*  @since:	3.5.7
	*  @date	13/01/13
	*
	*  @param	{int}	$post_id
	*  @return	{int}	$post_id
	*/
	
	function wp_prepare_attachment_for_js( $response, $attachment, $meta ) {
        // only for image
		if( $response['type'] != 'image' ) {
		
			return $response;
			
		}
		
		
		// make sure sizes exist. Perhaps they dont?
		if( !isset($meta['sizes']) ) {
		
			return $response;
			
		}
		
		
		$attachment_url = $response['url'];
		$base_url = str_replace( wp_basename( $attachment_url ), '', $attachment_url );
		
		if( isset($meta['sizes']) && is_array($meta['sizes']) ) {
		
			foreach( $meta['sizes'] as $k => $v ) {
			
				if( !isset($response['sizes'][ $k ]) ) {
				
					$response['sizes'][ $k ] = array(
						'height'      => $v['height'],
						'width'       => $v['width'],
						'url'         => $base_url .  $v['file'],
						'orientation' => $v['height'] > $v['width'] ? 'portrait' : 'landscape',
					);
				}
				
			}
			
		}

		return $response;
	}
	
	
	/*
	*  update_value()
	*
	*  This filter is appied to the $value before it is updated in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value which will be saved in the database
	*  @param	$post_id - the $post_id of which the value will be saved
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the modified value
	*/
	
	function update_value( $value, $post_id, $field ) {
		
		// numeric
		if( is_numeric($value) ) return $value;
		
		
		// array?
		if( is_array($value) && isset($value['ID']) ) return $value['ID'];
		
		
		// object?
		if( is_object($value) && isset($value->ID) ) return $value->ID;
		
		
		// return
		return $value;
		
	}
	
}


// initialize
acf_register_field_type( new acf_field_annotorius() );

endif; // class_exists check

?>
