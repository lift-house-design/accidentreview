<?php



function add_login_logout_link($items, $args) {
    if ($args->theme_location == 'primary') {
        if (isset($_SESSION['agent_user_id'])){
           /* Comment out this part 
 $items .= '
<li class="repmenu">
                <a href="/reps/home">My Review</a>
                <ul>
                    <li><a href="/reps/assignments">My Assignments</a></li>
                    <li><a href="/reps/home">New Assignment</a></li>';
            if($_SESSION['agent_user_admin']) $items .= '
                    <li><a href="/reps/users">Manage Reps</a></li>';
            $items .= '
                </ul>
            </li>';
*/
        } else {
           
        }    
    }
    if($args->theme_location == 'footer'){
        if(is_user_logged_in() && current_user_can('manage_options')){
            $items .= '
            <li>
                <a href="/wp-admin/">Dashboard</a>
            </li>
            <li>
                <a href="' . wp_logout_url('index.php')  . '">Logout</a>
            </li>
            ';
        }
    }
    return $items;
}

add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);

//add_action('wp_footer','add_session_vars_to_footer');

function add_session_vars_to_footer(){
    echo '<pre>'.print_r($_SESSION,true).'</pre>';
}
?>