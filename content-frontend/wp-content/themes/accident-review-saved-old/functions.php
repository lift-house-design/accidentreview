<?

if(!defined(ADMIN_ROLE)) define(ADMIN_ROLE,'1');
if(!defined(AGENT_ADMIN_ROLE)) define(AGENT_ADMIN_ROLE,'8');
if(!defined(AGENT_USER_ROLE)) define(AGENT_USER_ROLE,'9');
if(!defined(AGENT_GENERAL_ROLE)) define(AGENT_GENERAL_ROLE,'11');
if(!defined(AC_BACKEND_ADDRESS)) define(AC_BACKEND_ADDRESS,'http://backend.accidentreview.com/');

add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );



add_action( 'after_setup_theme', 'accident_setup' );

if ( !is_admin() ) {
function my_init_method() {
wp_deregister_script( 'l10n' );
}
add_action('init', 'my_init_method'); 
}

if ( ! function_exists( 'accident_setup' ) ):

    function accident_setup(){
        add_theme_support('menus');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => __('Primary Navigation', 'accident-review'), 
            'protected' => __('Protected Navigation', 'accident-review'), 
            'footer' => __('Footer Navigation', 'accident-review')
            )
        );
        
        register_sidebar(
            array(
                'id' => 'register-sidebar',
    			'name' => __( 'Register Page' ),
    			'description' => __( 'Sidebar for the Register Page.' ),
    			'before_widget' => '<div id="%1$s" class="widget %2$s">',
    			'after_widget' => '</div>',
    			'before_title' => '<h3 class="widget-title">',
    			'after_title' => '</h3>'
            )
        );
        
        register_sidebar(
            array(
                'id' => 'about-sidebar',
    			'name' => __( 'About Us Page' ),
    			'description' => __( 'Sidebar for the About Us Page.' ),
    			'before_widget' => '<div id="%1$s" class="widget %2$s">',
    			'after_widget' => '</div>',
    			'before_title' => '<h3 class="widget-title">',
    			'after_title' => '</h3>'
            )
        );
        
        register_sidebar(
            array(
                'id' => 'contact-sidebar',
    			'name' => __( 'Contact Us Page' ),
    			'description' => __( 'Sidebar for the Contact Us Page.' ),
    			'before_widget' => '<div id="%1$s" class="widget %2$s">',
    			'after_widget' => '</div>',
    			'before_title' => '<h3 class="widget-title">',
    			'after_title' => '</h3>'
            )
        );
        
        register_sidebar(
            array(
                'id' => 'submitjob-sidebar',
    			'name' => __( 'Submit Job Page' ),
    			'description' => __( 'Sidebar for the Submit Job Page.' ),
                'before_widget' => '<div class="instructions">
                                        <div class="top">
                                            <div class="bottom">
                                                <h3 class="unselectable toggler">Instructions</h3>
                                                <div id="toggleable">',
                'after_widget' =>   '</div>
                                   </div>
                                </div>
                                <script type="text/javascript">
                                    $(".toggler").click(function() {
                                        $("#toggleable").toggle();
                                        $(".toggler").toggleClass("toggled");
                                    })
                                </script>
                            </div>',
                'before_title' =>   '<p><strong>',
                'after_title' =>    '</strong></p>'
    			// 'before_widget' => '<div id="%1$s" class="widget %2$s">',
    			// 'after_widget' => '</div>',
    			// 'before_title' => '<h3 class="widget-title">',
    			// 'after_title' => '</h3>'
            )
        );
        
        register_sidebar(
                array(
                'id' => 'rep-home-right-sidebar',
    			'name' => __( 'Rep Home Right' ),
    			'description' => __( 'Sidebar for the Submit Job Page.' ),
    			'before_widget' => '<div id="%1$s" class="widget %2$s">',
    			'after_widget' => '</div>',
    			'before_title' => '<h3 class="widget-title">',
    			'after_title' => '</h3>'
            )
        );
        
        register_sidebar(
                array(
                'id' => 'rep-home-left-sidebar',
    			'name' => __( 'Rep Home Left' ),
    			'description' => __( 'Sidebar for the Submit Job Page.' ),
    			'before_widget' => '<div id="%1$s" class="widget %2$s">',
    			'after_widget' => '</div>',
    			'before_title' => '<h3 class="widget-title">',
    			'after_title' => '</h3>'
            )
        );
        
        register_sidebar(
                array(
                'id' => 'rep-support-left-sidebar',
    			'name' => __( 'Rep Support Left' ),
    			'description' => __( 'Sidebar for the Support Page.' ),
    			'before_widget' => '<div id="%1$s" class="widget %2$s">',
    			'after_widget' => '</div>',
    			'before_title' => '<h3 class="widget-title">',
    			'after_title' => '</h3>'
            )
        );
                
    }

endif;

include('custom/admin-page.php');
include('custom/agent-login-form.php');
include('custom/ajax.php');
include('custom/ac-functions-new.php');
include('custom/ac-user-functions.php');
include('custom/ac-email-functions.php');
include('custom/menu-hooks.php');
include('custom/get-jobs.php');
include('custom/rewrites.php');
include('custom/template-redirect.php');
include('custom/user-screens.php');
include('custom/post-types.php');
include('custom/vin-functions.php');
include('custom/widgets.php');

add_shortcode('request-form-type','accident_type_form');
add_shortcode('request-form','accident_info_form');
add_shortcode('get-jobs','get_company_jobs');

// @TODO: Integrate into app when approved
require('custom/dev.php');

function accident_type_form(){
    if(!isset($_SESSION['agent_user_id'])) header('/reps/login');
    include('custom/main-request-type.php');
}

function accident_info_form(){
    if(!isset($_SESSION['agent_user_id'])) header('/reps/login');
    include('custom/main-request-form.php');    
}

add_action( 'wp_enqueue_scripts', 'accident_add_header' );
add_action( 'admin_enqueue_scripts','accident_add_header',1);
add_action( 'wp_footer','accident_add_footer');

function accident_add_header(){
    if(!is_admin()){
        wp_deregister_script('jquery');
        wp_register_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-js','https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js');
        wp_enqueue_style('jquery-ui-css',get_bloginfo('stylesheet_directory').'/lib/accident-jqueryui-theme/jquery-ui-1.8.15.custom.css');
        
        
        wp_enqueue_script('accident-custom-js',get_bloginfo('stylesheet_directory').'/js/accident-review.js'); 

        wp_enqueue_script('uploadify-js',get_bloginfo('stylesheet_directory').'/lib/uploadify/swfobject.js');
        wp_enqueue_script('uploadify-js2',get_bloginfo('stylesheet_directory').'/lib/uploadify/jquery.uploadify.min.js');
        wp_enqueue_style('uploadify-css', get_bloginfo('stylesheet_directory').'/lib/uploadify/uploadify.css');
    }
    
    
    wp_enqueue_script('jquery-metadata',get_bloginfo('stylesheet_directory').'/lib/tablesorter/jquery.metadata.js');
    wp_enqueue_script('jquery-tablesorter',get_bloginfo('stylesheet_directory').'/lib/tablesorter/jquery.tablesorter.min.js');
    wp_enqueue_script('jquery-textarea-resize',get_bloginfo('stylesheet_directory').'/js/autoresize.jquery.min.js');
    wp_enqueue_script('jquery-chosen-js',get_bloginfo('stylesheet_directory').'/lib/chosen/chosen.jquery.min.js');
    wp_enqueue_style('jquey-chosen-css',get_bloginfo('stylesheet_directory').'/lib/chosen/chosen.css');
    wp_enqueue_script('jquery-scroll-to',get_bloginfo('stylesheet_directory').'/js/jquery.scrollTo-1.4.2-min.js');

    if(is_front_page()){
        wp_enqueue_script('jquery-scrollpane',get_bloginfo('stylesheet_directory').'/lib/jscrollpane/jquery.jscrollpane.min.js');
        wp_enqueue_style('jquery-scrollpane-css',get_bloginfo('stylesheet_directory').'/lib/jscrollpane/jquery.jscrollpane.css');    
    }
    
    
}

function accident_add_footer(){
    
}


add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );
?>
