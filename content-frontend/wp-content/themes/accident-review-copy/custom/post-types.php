<?php

add_action('init','create_custom_types');
add_action('admin_init','custom_meta_init');
add_action('save_post','custom_meta_save',10);
add_action('save_post', 'accident_post_save',12);

define('MY_THEME_PATH','/wp-content/themes/accident-review');

$custom_types = array(	
	'TechBio'=>array(
		'name'=>'technician-bio',			// Slug Name of Custom Type
		'args'=>array(				// Args array for register_post_type
			'labels'=>array(		// Naming Conventions
				'name' => __( 'Technician Bios' ),									// Plural				i.e		Apples					Tree		
				'singular_name' => __( 'Technician Bio' ),							// Singular				i.e		Apple					Trees
				'add_new' => __( 'Add Technician Bio' ),						// Add Singular			i.e		Add Apple				Add Tree
				'add_new_item' => __( 'Add New Technician Bio' ),				// Add New Singular		i.e		Add new Apple			Add New Tree
				'edit_item' => __('Edit Technician Bio'),						// Edit Singular		
				'new_item' => __( 'New Technician bio' ),						// New Singular
				'view_item' => __( 'View Technician bio' ),							// View Singular
				'search_items' => __( 'Search for Technician Bio' ),					// ...
				'not_found' => __( 'No Technician Bios Found' ),						// ..
				'not_found_in_trash' => __( 'No Technician biosfound in Trash' ),	// .
				'menu_name'=>__( 'Tech Bios' )
			),
			'description'=>'Technician Bios',
			'hierarchical'=> false,	// Can the custom type have a parent?
			'public' => true,		// Can this custom type be queried by the theme?
			'publicly_queriable'=>true,
			'menu_position'=>34,										// Position in menu
			'menu_icon'=> MY_THEME_PATH . '/images/technician-bio.png',		// Icon for menu
			'supports'=> array(		// Capabilities
				'title',			// title			Can it be named? 
				'thumbnail',		// thumbnail		featured image, current theme must also support post-thumbnails)
				'editor',			// editor			Textual content
				'excerpt',			// excerpt			(slightly shorter) Textually content 
				'page-attributes',	// page-attributes	(template and menu order, hierarchical must be true to show Parent option)
				'revisions',		// revisions		Store previous versions?
				'custom-fields',	// custom-fields	Fun...anyone?
				//'author',			// author			Link to user
				//'trackbacks',		// trackbacks		Link to other blogs (change notification / credit)?
				//'comments',		// comments			(also will see comment count balloon on edit screen)	 
			),
			//'rewrite'=>array(
				//'slug'=>'solutions',
				//'with_front'=>'',
				//'feeds'=>false,
				//'pages'=>true,
			//),
			 'taxonomies' => array()
		),
		'taxonomies'=>array(),
		'post-save' => 'accident_post_save_technician_bios',
		'widget-location' => 'normal',
		'widget-priority' => 'high',
		'meta'=>array(					// Meta Values (custom-fields must be enabled)
			'_technician_bio_public'    => array ( 'default' => '0', 'single' => true )           
		)
	)
);


function create_custom_types(){
	global $custom_types;
        global $wpdb;
	foreach($custom_types as $a_custom_type){
		register_post_type($a_custom_type['name'],$a_custom_type['args']);
		if(isset($a_custom_type['taxonomies'])){
			foreach($a_custom_type['taxonomies'] as $a_name=>$a_taxonomy){
				register_taxonomy($a_name, array($a_custom_type['name']),$a_taxonomy);
                $meta_name = $a_name.'meta';
                $table_name = $wpdb->prefix.$meta_name;
                $wpdb->$meta_name = $table_name;
			}
		}
    
        add_filter('manage_edit-'.$a_custom_type['name'].'_columns','custom_type_columns');
        add_action('manage_'.$a_custom_type['name'].'_posts_custom_column', 'custom_type_columns_display');
        
	}
    flush_rewrite_rules( false );
}

function custom_type_columns($columns){
    $columns['app_status'] = 'App Status';
    return $columns;
}

function custom_type_columns_display($name){
    global $post;
    switch($name){
        case 'app_status':
            switch(get_post_type($post->ID)){
                case 'frames': $app_status = get_post_meta($post->ID,'_frame_app_status',true); break;
                case 'mats':   $app_status = get_post_meta($post->ID,'_mat_app_status',true); break; 
                case 'artwork': $app_status = get_post_meta($post->ID,'_artwork_app_status',true); break;
            }
            if($app_status == 1){
                ?>
                <span style="color: green;">Enabled</span>
                <?
            } else {
                ?>
                <span style="color: red;">Disabled</span>
                <?
            }
            break;
    }
}



function custom_meta_init(){
	global $custom_types;
    global $post;
    


    //$css_file = MY_THEME_PATH . '/css/meta-boxes.css';
    //$js_file = MY_THEME_PATH . '/js/meta-boxes.js';
    
    $post_type_names = array();
    foreach($custom_types as $type=>$data) $post_type_names[] = $data['name'];

    wp_enqueue_style( 'accident_theme_admin_css',	$css_file );
    wp_enqueue_script('accident_theme_admin_js', $js_file, array('jquery'));
        
	foreach($custom_types as $type=>$a_custom_type){
        if(( isset($_GET['post_type']) && $_GET['post_type'] == $a_custom_type['name'] ) || (isset($_GET['post']) && get_post_type($_GET['post']) == $a_custom_type['name'])){
            
            $css_file = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/accident-review/css/'.$a_custom_type['name'].'.css';
            $js_file = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/accident-review/js/'.$a_custom_type['name'].'.js';
            
            if(is_file($css_file)){ 
                wp_enqueue_style('accident_theme_'.$a_custom_type['name'].'_css',get_bloginfo('stylesheet_directory').'/css/'.$a_custom_type['name'].'.css'); 
            }
            if(is_file($js_file)){ 
                wp_enqueue_script('accident_theme_'.$a_custom_type['name'].'_js',get_bloginfo('stylesheet_directory').'/js/'.$a_custom_type['name'].'.js');  
            }
        }
		add_meta_box($a_custom_type['name'].'_meta',$type.' Information','custom_meta_set',$a_custom_type['name'],$a_custom_type['widget-location'],$a_custom_type['widget-priority']);
		add_meta_box('ctx_ps_sidebar_security', 'Restrict Access', 'ctx_ps_sidebar_security',$a_custom_type['name'],'side','low');
                
		add_action('save_post',$a_custom_type['post-save']);
	}
}

function custom_meta_set(){
	global $post;
	global $custom_types;
	$post_meta = array();
	$post_type = $post->post_type;
	foreach($custom_types as $type=>$a_custom_type){
		if($a_custom_type['name'] == $post_type){
			foreach($a_custom_type['meta'] as $key=>$values){
				$post_meta[''.$key] = get_post_meta($post->ID,''.$key,$values['single']);
			}
			$meta_file = MY_THEME_FOLDER . '/custom/'.$a_custom_type['name'].'.php'; 
			if( file_exists($meta_file) ) include($meta_file);
		}	
	}
}

function custom_meta_save($post_id){
	global $custom_types;
		
	if (!current_user_can('edit_post', $post_id)) return $post_id;
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
    if (isset( $_POST['previd'] ) || isset( $_POST['nextid'] )) return $post_id;
	
	$accepted_fields = array();
	
	foreach($custom_types as $type=>$a_custom_type){
		if(array_key_exists('meta', $a_custom_type)){
			$accepted_fields[''.$a_custom_type['name']] = array();
			foreach($a_custom_type['meta'] as $key=>$values){
				$accepted_fields[''.$a_custom_type['name']][] = $key;
			}	
		}		
	}			
				
	$post_type_id = get_post_type($post_id);
	
	foreach($accepted_fields[$post_type_id] as $key){
		$custom_field = $_POST[$key];
        if(is_array($custom_field)){
            $custom_field = array_filter($custom_field,function($value){ return !empty($value); });
            if(count($custom_field) == 1) $custom_field = $custom_field[0];           
        }
        
		if(is_null($custom_field)) {
			delete_post_meta($post_id, $key);
		} elseif(isset($custom_field) && !is_null($custom_field)) {
			update_post_meta($post_id,$key,$custom_field);
		} else {
			add_post_meta($post_id, $key, $custom_field, TRUE);
		}
	}

	return $post_id;
}

add_filter( 'parse_query', 'accident_admin_posts_filter' );
add_action( 'restrict_manage_posts', 'accident_admin_posts_filter_restrict_manage_posts' );

function accident_admin_posts_filter( $query )
{
    global $pagenow;
    if ( is_admin() && $pagenow=='edit.php' && isset($_GET['accident_status_value']) && $_GET['accident_status_value'] != '') {
        $values = explode('|',$_GET['accident_status_value']);
        
        if($values[1] == 0){
            set_query_var( 'meta_query', array(array('key' => $values[0], 'value' => '1', 'compare' => '!=')));
        } else {
            set_query_var( 'meta_query', array(array('key' => $values[0], 'value' => $values[1])));    
        }
    }
}

function accident_admin_posts_filter_restrict_manage_posts()
{
    //global $wpdb;
    
    $var_name = '';
    switch($_GET['post_type']){
        case 'frame':
        case 'frames':
            $var_name = '_frame_app_status';
        break;
        case 'mat':
        case 'mats':
            $var_name = '_mat_app_status';
        break;
        case 'artwork':
            $var_name = '_artwork_app_status';
        break;
    }
    if($var_name != ''){
?>
<select name="accident_status_value">
    <option value=""><?php _e('Filter By App Status', 'accident-review'); ?></option>
    <option value="<?=$var_name?>|1" <?=(isset($_GET['accident_status_value']) && $_GET['accident_status_value'] == $var_name.'|1')?'selected="selected"':''?>><?php _e('Enabled', 'accident-review'); ?></option>
    <option value="<?=$var_name?>|0" <?=(isset($_GET['accident_status_value']) && $_GET['accident_status_value'] == $var_name.'|0')?'selected="selected"':''?>><?php _e('Disabled', 'accident-review'); ?></option>
</select>
<?php
    }
}

add_action("admin_print_styles", 'plugin_admin_styles' );
add_action("admin_print_scripts", 'plugin_admin_scripts' );
function plugin_admin_styles() {
	wp_enqueue_style('thickbox'); // needed for find posts div
}

function plugin_admin_scripts() {
	wp_enqueue_script('thickbox'); // needed for find posts div
	wp_enqueue_script('media');
	wp_enqueue_script('wp-ajax-response');
}


?>
