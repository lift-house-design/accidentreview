<?


add_shortcode('agent-login-form', 'accident_login_form');

function accident_login_form($atts, $content = null, $code = "")
{
    /**
     * Agent Login Form.  Linked to AC Users
     * 
     */
    global $wpdb;
    if (!isset($wpdb))
        $wpdb = new wpdb(DB_USER, DB_PASS, DB_NAME, DB_HOST);

    extract(shortcode_atts(array(
        'type'=>'register'
    ), $atts));


    $continue = false;
    
    if($type == 'register' || (isset($_GET['do']) && $_GET['do'] == 'register')) $show_register = true;
    else $show_register = false;
    
    if($type == 'login' || (isset($_GET['do']) && $_GET['do'] == 'login')) $show_login = true;
    else $show_login = false;
    
    if($type == 'logout' || (isset($_GET['do']) && $_GET['do'] == 'logout')) $show_logout = true;
    else $show_logout = false;

    $error = false;
    $errors = array();

    $AC_LICENSE = 'wMhitCnAtu8d3DBmSmK8A0kck3QpvJLZ42v9iy2z';

    if ($_POST) {
        if (isset($_POST['submit_login'])) {
            $username = $password = $hash_password = '';

            if (isset($_POST['username']) && $_POST['username'] != '') {
                $username = $_POST['username'];
            } else {
                $error = true;
                $errors[] = 'Please enter your username.';
            }

            if (isset($_POST['password']) && $_POST['password'] != '') {
                $password = $_POST['password'];
                $hash_password = sha1($AC_LICENSE . $password);
            } else {
                $error = true;
                $errors[] = 'Please enter your password.';
            }

            if ($username != '' && $password != '') {
                $check_s = 'SELECT `id`,`email`,`first_name`,`last_name`,`company_id` FROM acx_users WHERE `email`=\'' . $username . '\' AND password=\'' . $hash_password . '\'';
                $check_q = $wpdb->get_results($check_s,'ARRAY_A');
                if(!$check_q || count($check_q) == 0){
                    $error = true;
                    $errors[] = 'Invalid Username or Password.';
                    echo $wpdb->error_message;
                }
            }

            if (!$error) {
                $_SESSION['agent_user_id'] = $check_q[0]['id'];
                $_SESSION['agent_user_name'] = $check_q[0]['first_name'].' '.$check_q[0]['last_name'];
                //$_SESSION['agent_user_data'] = array();
                $_SESSION['agent_user_company'] = $check_q[0]['company_id'];
                
               // $info_s = 'SELECT * FROM representatives WHERE ac_user_id=\''.$_SESSION['agent_user_id'].'\'';
//                $info_q = $wpdb->get_results($info_s,'ARRAY_A');
//                if($info_q && count($info_q) > 0){
//                    $_SESSION['agent_user_data'] = $info_q[0];
//                }
                
                $project_s = 'SELECT id FROM acx_projects WHERE company_id=\''.$_SESSION['agent_user_company'].'\'';
                $project_q = $wpdb->get_results($project_s,'ARRAY_A');
                if($project_q && count($project_q) > 0){
                    $_SESSION['default_project_id'] = $project_q[0]['id'];
                }

                $address_s = 'SELECT street, city, state, zip FROM representatives WHERE ac_user_id =\''.$_SESSION['agent_user_id'].'\'';
                $address_q = $wpdb->get_results($address_s,'ARRAY_A');
                if($address_q && count($address_q) > 0){
                    $_SESSION['agent_rep_data']['street'] = $address_q[0]['street'];
                    $_SESSION['agent_rep_data']['city'] = $address_q[0]['city'];
                    $_SESSION['agent_rep_data']['state'] = state_abbrev($address_q[0]['state']);
                    $_SESSION['agent_rep_data']['zip'] = $address_q[0]['zip'];
                }

                //$content .= '<br /><pre>'.print_r($_SESSION,true).'</pre></div>';
                $continue = true;
            } else {
                $content .= '<div class="ui-state-error ui-corner-all">';
                foreach($errors as $a_message){
                    $content .= '<p>'.$a_message.'</p>';
                }
                $content .= '</div>';
            }
        } elseif (isset($_POST['submit_register'])) {


            if (!$error) {

                
            } else {

            }
        }
    }
    
    if(isset($_SESSION['agent_user_id']) && $show_login) $continue = true;

    if($show_logout){
        unset($_SESSION['agent_user_id']);
        unset($_SESSION['agent_user_name']);
        unset($_SESSION['agent_user_data']);
        unset($_SESSION['agent_rep_data']);
        
        $content .= '
        <h4>You have Logged Out successfully!</h4>
        ';
        $show_logout = false; $show_login = true; $continue = false;
    }

    if ($continue) {
        
        if($show_login && !$show_logout){
            $content .= '
            <div class="ui-state-highlight"><p>Successful Login!</p></div>
            <br class="clear" />
            <div class="agent-go-links">
                <div class="ui-corner-all left shadow_border">
                    <a href="/agents/request">
                        Submit a New Assignment
                    </a>
                </div>
                <div class="ui-corner-all right shadow_border">
                    <a href="/agents/jobs">
                        View the Status of your Assignments
                    </a>
                </div>
                <br class="clear" />
            </div>
            ';        
        } 
        
        if($show_register){
            
        }
        
    } else {

        if ($show_login) {
            
            if(isset($_GET['do']) && $_GET['do'] == 'logoutsuccess'){
                $content .= '
            <h5>You have logged out successfully!</h5><br />
                ';
            }
            
            $content .= '
            <div class=agent-login-form">
                <form class="accident-form" method="post" action="/reps/login">
                    <label for="username">Email Address:</label>
                    <input type="text" name="username" value="'.(($_POST)?$_POST['username']:'').'" class="ui-corner-all"/>
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="ui-corner-all"/>
                    <br />
                    <input type="hidden" name="submit_login" />
                    <input type="image" src="'.get_bloginfo('stylesheet_directory').'/images/submit-login.png" name="submit_login_image" value="Login" style="width:86px;"/>
                </form>
            </div>';
            
        }

        if ($show_register) {
            $content .= '
            <div class="general_information">
        		<form method="post" class="accident-form">
                    <div style="float:left;">
            			<label for="company_name">Company Name:</label>
                        <input name="company_name" type="text" value="'.($_POST ? $_POST['company_name'] : '') .'" class="ui-corner-all" placeholder="Name of your Organization"/><br/>
            			<label for="representative_name">Representative Name:</label>
                        <input name="representative_name" type="text" value="'.($_POST ? $_POST['representative_name'] : '') .'" class="ui-corner-all" placeholder="Name of Main Organization Contact"/><br/>
            			<label for="title">Title:</label>
                        <input name="title" type="text" value="'.($_POST ? $_POST['title'] : '') .'" class="ui-corner-all"  placeholder="Title of Main Organization Contact"/><br/>
                        
            			<div class="inline">
                            <label> Please Choose the correct department </label>    <br />
                			<input name="department_siu" type="checkbox" value="'.($_POST ? $_POST['department'] : '') .'" />
                            <label>SIU</label><br />
                			<input name="department_claims" type="checkbox" value="'.($_POST ? $_POST['department'] : '') .'" />
                            <label>Claims</label><br />
                			<input name="department_subrogation" type="checkbox" value="'.($_POST ? $_POST['department'] : '') .'" />
                            <label>Subrogation</label><br />
                			<input name="department_legal" type="checkbox" value="'.($_POST ? $_POST['department'] : '') .'" />
                            <label>Legal</label><br />
                			<input name="department_other" type="checkbox" value="'.($_POST ? $_POST['department'] : '') .'" />
                            <label>Other, Specify:</label>
                			<input name="department" type="text" value="'.($_POST ? $_POST['department'] : '') .'" class="ui-corner-all" placeholder="Other Dept. Name"/><br/>
                        </div>
                        <label for="email">E-mail:</label>
                        <input name="email" type="text" value="'.($_POST ? $_POST['email'] : '') .'" class="ui-corner-all"  placeholder="Email Address Used for Login"/><br/>
                        <label for="password">Password:</label>
                        <input name="password" type="password" value="'.($_POST ? $_POST['password'] : '') .'" class="ui-corner-all" placeholder="Enter a Password"/><br/>
            			<label for="password_confirm">Confirm Password:</label>
                        <input name="password_confirm" type="password" value="'.($_POST ? $_POST['password_confirm'] : '') .'" class="ui-corner-all"  placeholder="Confirm your Password"/><br/>
                    </div>
                    <div style="float:left;margin-left:15px;">
            			<label for="street">Street: </label>
                        <input name="street" type="text" value="'.($_POST ? $_POST['street'] : '') .'" class="ui-corner-all" placeholder="Street Address, Including Suite"/><br/>
            			<label for="city">City: </label>
                        <input name="city" type="text" value="'.($_POST ? $_POST['city'] : '') .'" class="ui-corner-all" placeholder="City Name"/><br/>
            			<label for="state">State:</label>
                        <input name="state" type="text" value="'.($_POST ? $_POST['state'] : '') .'" class="ui-corner-all" placeholder="State Abbreviation"/><br/>
            			<label for="zip">Zip:</label>
                        <input name="zip" type="text" value="'.($_POST ? $_POST['zip'] : '') .'" class="ui-corner-all" placeholder="Zip Code"/><br/>
            			<label for="home_phone">Phone:</label>
                        <input name="home_phone" type="text" value="'.($_POST ? $_POST['home_phone'] : '') .'" class="ui-corner-all" placeholder="Business Phone Number"/><br/>
            			<label for="mobile_phone">Mobile:</label>
                        <input name="mobile_phone" type="text" value="'.($_POST ? $_POST['mobile_phone'] : '') .'" class="ui-corner-all" placeholder="Mobile Phone Number"/><br/>
            			<label for="fax">Fax: </label>
                        <input name="fax" type="text" value="'.($_POST ? $_POST['fax'] : '') .'" class="ui-corner-all" placeholder="Fax Number"/><br/>
                    </div>
                    <br class="clear" />
                    <input type="image" src="'.get_bloginfo('stylesheet_directory').'/images/submit-register.png" name="submit" value="Submit" style="width:86px;float:left;"/>
        		</form>
            </div>';
        }
    }

    return $content;
}

function state_abbrev($state_name){

    if(strlen($state_name) > 2){

        $states = array(
            'alabama'=>'AL',
            'alaska'=>'AK',
            'arizona'=>'AZ',
            'arkansas'=>'AR',
            'california'=>'CA',
            'colorado'=>'CO',
            'connecticut'=>'CT',
            'delaware'=>'DE',
            'florida'=>'FL',
            'georgia'=>'GA',
            'hawaii'=>'HI',
            'idaho'=>'ID',
            'illinois'=>'IL',
            'indiana'=>'IN',
            'iowa'=>'IA',
            'kansas'=>'KS',
            'kentucky'=>'KY',
            'louisiana'=>'LA',
            'maine'=>'ME',
            'maryland'=>'MD',
            'massachusetts'=>'MA',
            'michigan'=>'MI',
            'minnesota'=>'MN',
            'mississippi'=>'MS',
            'missouri'=>'MO',
            'montana'=>'MT',
            'nebraska'=>'NE',
            'nevada'=>'NV',
            'new hampshire'=>'NH',
            'new jersey'=>'NJ',
            'new mexico'=>'NM',
            'new york'=>'NY',
            'north carolina'=>'NC',
            'north dakota'=>'ND',
            'ohio'=>'OH',
            'oklahoma'=>'OK',
            'oregon'=>'OR',
            'pennsylvania'=>'PA',
            'rhode island'=>'RI',
            'south carolina'=>'SC',
            'south dakota'=>'SD',
            'tennessee'=>'TN',
            'texas'=>'TX',
            'utah'=>'UT',
            'vermont'=>'VT',
            'virginia'=>'VA',
            'washington'=>'WA',
            'west virginia'=>'WV',
            'wisconsin'=>'WI',
            'wyoming'=>'WY'
            );

        $name = strtolower($state_name);
        if(isset($states[$name])){
            $abbrev = $states[$name];
        } else {
            return $state_name;
        }

    } else {
        $abbrev = $state_name;
    }

    return strtoupper($abbrev);

}






?>