<?
add_shortcode('agent-user-screen', 'accident_user_screen');

function accident_user_screen($atts, $content = null, $code = "")
{
    if(!isset($_SESSION['agent_user_id'])) header('/reps/login');
    global $wpdb;
    if (!isset($wpdb))
        $wpdb = new wpdb(DB_USER, DB_PASS, DB_NAME, DB_HOST);

    extract(shortcode_atts(array(
        'type'=>'list'
    ), $atts));

    if(!isset($_GET['do'])){
        $_GET['do'] = $type;
    }
    switch($_GET['do']){
        case 'add':
            if(!$_SESSION['agent_user_admin']){
                $content .= '
                <div class="ui-state-alert">
                    You do not have the permissions required to add a representative.<br />
                    <a href="/reps/assignments">Manage your Jobs</a>
                </div>
                ';
            } else {
                $content .= '
                <div class="accident_breadcrumb" id="crumb">
                    <ul>
                        <li><a href="/reps/home/">Home</a></li>
                        <li>»</li>
                        <li><a href="/reps/users">Manage Representatives</a></li>
                        <li>»</li>
                        <li>Add a Representative</li>
                    </ul>
                    <br class="clear" />
                </div>
                <div class="sidebar" id="navsidebar">
                <ul>
                <li><h2>Representatives</h2><br class="clear"></li>
                <li><a href="/reps/users">Manage Representatives »</a></li>
                </ul>
                </div>
                <script type="text/javascript">
                $("#replaceme").replaceWith($("#crumb"));  
                $("#sidebar").replaceWith($("#navsidebar"));
                </script>
                <br />
                ';
                
                $continue = false;
                if($_POST){
                    $error = false;
                    $errors = array();
                    
                    if(!isset($_POST['ue_email_address']) || $_POST['ue_email_address'] == ''){
                        $error = true;
                        $errors[] = 'Please enter an email address for the Representative.';
                    }
                    
                    if(!isset($_POST['ue_name_first']) || $_POST['ue_name_first'] == ''){
                        $error = true;
                        $errors[] = 'Please enter a First Name for the Representative.';
                    }
                    
                    if(!isset($_POST['ue_name_last']) || $_POST['ue_name_last'] == ''){
                        $error = true;
                        $errors[] =  'Please enter a Last name for the Representative.';
                    }
                    
                    if(!isset($_POST['password']) || $_POST['password'] == '' || !isset($_POST['password_confirm']) || $_POST['password_confirm'] == ''){
                        $error = true;
                        $errors[] = 'Please enter the representative\'s password twice.';
                    }
                    
                    if($_POST['password'] != $_POST['password_confirm']){
                        $error = true;
                        $errors[] = 'The Passwords do not match.';
                    }
                    
                    if(isset($_POST['department_other']) && $_POST['department'] == ''){
                        $error = true;
                        $errors[] = 'Please specify the other department';
                    }
                    
                    if(!$error){
                        
                        $department = $department_name = '';
                        
                        if(isset($_POST['department_siu'])) $department = 'siu';
                        if(isset($_POST['department_claims'])) $department = 'claims';
                        if(isset($_POST['department_subrogation'])) $department = 'subrogation';
                        if(isset($_POST['departement_legal'])) $department = 'legal';
                        if(isset($_POST['department_other'])){
                            $department = 'other';
                            $department_name = $_POST['department'];
                        }
                        
                        
                        $user_data = array(
                            'email' => $_POST['ue_email_address'],
                            'first' => $_POST['ue_name_first'],
                            'last' => $_POST['ue_name_last'],
                            'password' => $_POST['password'],
                            'department' => $department,
                            'department_name' => $department_name,
                            'street' => $_POST['street'],
                            'city' => $_POST['city'],
                            'state' => $_POST['state'],
                            'zip' => $_POST['zip'],
                            'phone' => $_POST['phone'],
                            'mobile' => $_POST['mobile'],
                            'fax' => $_POST['fax']
                        );
                        
                        $user_id = accident_add_company_user($_SESSION['agent_user_company'],$user_data);
                        
                        if(isset($_POST['ue_is_admin']) && $_POST['ue_is_admin'] != 0){
                            if($_POST['ue_is_admin'] == 1 && !accident_is_user_admin($_GET['id'])) accident_make_user_admin($user_id);
                            if($_POST['ue_is_admin'] == 0 && accident_is_user_admin($_GET['id'])) accident_make_user_normal($user_id);
                        }
                        
                        $content .= '
                        <div class="">
                            <p>The User has been Added.</p>
                            <p>
                                <a href="/reps/users/?do=edit&id='.$user_id.'">Edit this Representative</a> | 
                                <a href="/reps/users/?do=add">Add Another Representative</a> | 
                                <a href="/reps/users/">Manage all Representatives</a>
                            </p>
                        </div>
                        ';
                        $continue = true;
                        
                    } else {
                        $content .= '
                        <div class="ui-state-error">';
                        foreach($errors as $a_message){
                            $content .= '
                            <p>'.$a_message.'</p>';
                        }
                        $content .= '
                        </div>';
                    }

                }
                if(!$continue) {
                $content .= '
                <div class="information">
                <form class="accident-form" method="post">
                    <div style="float:left;">
                        <label for="ue_email_address">Email Address:</label>
                        <input type="text" name="ue_email_address" value="'.(($_POST)?$_POST['ue_email_address']:'').'" class="field" placeholder="User\' Email Address"/>
                        <br class="clear" />
                        <label for="ue_name_first">First Name:</label>
                        <input type="text" name="ue_name_first" value="'.(($_POST)?$_POST['ue_name_first']:'').'"  class="field" placeholder="User\'s First Name"/>
                        <br class="clear" />
                        <label for="ue_name_last">Last Name:</label>
                        <input type="text" name="ue_name_last" value="'.(($_POST)?$_POST['ue_name_last']:'').'"  class="field" placeholder="User\'s Last Name"/>
                        <br class="clear" />
                        <label for="password">Password:</label><input name="password" type="password" value=""  class="field" placeholder="Enter a Password"/><br/>
            			<label for="password_confirm">Confirm Password:</label><input name="password_confirm" type="password" value="" class="field" placeholder="Confirm the Password"/>
                        <div class="inline">
                            <label style="margin-bottom:7px;"> Please Choose the correct department </label>    <br class="clear" />
                            <ul class="department_list">
                                <li>
                                    <input name="department_siu" type="checkbox" value="siu" 
                                        '. ($_POST && isset($_POST['department_siu']) ? 'checked="checked"': '') .' />
                                    <label for="department_siu">SIU</label>
                                </li>
                    			<li>
                                    <input name="department_claims" type="checkbox" value="claims" 
                                        '. ($_POST && isset($_POST['department_claims']) ? 'checked="checked"': '') .' />
                                    <label for="department_claims">Claims</label>
                                </li>
                    			<li>
                                    <input name="department_subrogation" type="checkbox" value="subrogation" 
                                        '. ($_POST && isset($_POST['department_subrogation']) ? 'checked="checked"': '') .' />
                                    <label for="department_subrogation">Subrogation</label></li>
                    			<li>
                                    <input name="department_legal" type="checkbox" value="legal" 
                                        '. ($_POST && isset($_POST['department_legal']) ? 'checked="checked"': '') .' />
                                    <label for="department_legal">Legal</label></li>
                    			<li class="other">
                                    <input name="department_other" type="checkbox" value="other" 
                                        '. ($_POST && isset($_POST['department_other']) ? 'checked="checked"': '') .' />
                                    <label for="department_other">Other, Specify:</label>
                                    <input name="department" type="text" value="'.($_POST ? $_POST['department'] : '') .'" class="field" placeholder="Other Dept. Name"/></li>
                            </ul>
                            <br class="clear" />
                        </div>
                    </div>
                    <div style="float:left;">
            			<label for="street">Street: </label>
                        <input name="street" type="text" value="'.($_POST ? $_POST['street'] : '') .'" class="field" placeholder="Street Address, Including Suite"/><br/>
            			<label for="city">City: </label>
                        <input name="city" type="text" value="'.($_POST ? $_POST['city'] : '') .'" class="field" placeholder="City Name"/><br/>
            			<label for="state">State:</label>
                        <input name="state" type="text" value="'.($_POST ? $_POST['state'] : '') .'" class="field" placeholder="State Abbreviation"/><br/>
            			<label for="zip">Zip:</label>
                        <input name="zip" type="text" value="'.($_POST ? $_POST['zip'] : '') .'" class="field" placeholder="Zip Code"/><br/>
            			
            			<label for="home_phone">Phone:</label>
                        <input name="phone" type="text" value="'.($_POST ? $_POST['phone'] : '') .'" class="field" placeholder="Business Phone Number"/><br/>
            			<label for="mobile_phone">Mobile:</label>
                        <input name="mobile" type="text" value="'.($_POST ? $_POST['mobile'] : '') .'" class="field" placeholder="Mobile Phone Number" /><br/>
            			<label for="fax">Fax: </label>
                        <input name="fax" type="text" value="'.($_POST ? $_POST['fax'] : '') .'" class="field" placeholder="Fax Number"/><br/>
            			<br class="clear" />
                        <label style="display:inline;margin-right:10px;">User is Admin</label>
                        <div class="buttongroup inline">
                            <input type="radio" name="ue_is_admin" id="ue_is_admin_true" value="1" '.(($_POST && $_POST['ue_is_admin'])?'checked="checked"':'').' />
                            <label for="ue_is_admin_true">Yes</label>
                            <input type="radio" name="ue_is_admin" id="ue_is_admin_false" value="0" '.(($_POST && !$_POST['ue_is_admin'])?'checked="checked"':(!$_POST)?'checked="checked"':'').'/>
                            <label for="ue_is_admin_false">No</label>
                        </div>
                        <br class="clear" />
                    </div>
                    <br class="clear" /><br />
                    <input type="submit" name="submit_ue" value="Create Representative »" class="submit-button" />
                </form>
                </div>
                '; 
                }
            }
            break;
        case 'edit':
            $found = false;
            $company_users = accident_get_company_users($_SESSION['agent_user_company']);
            foreach($company_users as $a_user) if ($a_user['id'] == $_GET['id']) $found = true;
            if(!$found || !$_SESSION['agent_user_admin']){
                $content .= '
                <div class="ui-state-alert">
                    You do not have the permissions required to edit this representative.<br />
                    <a href="/reps/users">Manage your Representatives</a>
                </div>
                ';
            } else {
                $content .= '
                <div class="accident_breadcrumb" id="crumb">
                    <ul>
                        <li><a href="/reps/home/">Home</a></li>
                        <li>»</li>
                        <li><a href="/reps/users">Manage Representatives</a></li>
                        <li>»</li>
                        <li>Edit Representative</li>
                    </ul>
                    <br class="clear" />
                </div>
                <div class="sidebar" id="navsidebar">
                <ul>
                <li><h2>Representatives</h2><br class="clear"></li>
                <li><a href="/reps/users">Manage Representatives »</a></li>
                </ul>
                </div>
                <script type="text/javascript">
                $("#replaceme").replaceWith($("#crumb"));  
                $("#sidebar").replaceWith($("#navsidebar"));
                </script>
                <br />
                ';
                
                $continue = false;
                
                $the_user = accident_get_user_details($_GET['id']);
                $the_rep = accident_get_user_rep_details($_GET['id']);
                if($_POST){
                    
                    $error = false;
                    $errors = array();
                    
                    if(!isset($_POST['ue_email_address']) || $_POST['ue_email_address'] == ''){
                        $error = true;
                        $errors[] = 'Please enter an email address for the Representative.';
                    }
                    
                    if(!isset($_POST['ue_name_first']) || $_POST['ue_name_first'] == ''){
                        $error = true;
                        $errors[] = 'Please enter a First Name for the Representative.';
                    }
                    
                    if(!isset($_POST['ue_name_last']) || $_POST['ue_name_last'] == ''){
                        $error = true;
                        $errors[] =  'Please enter a Last name for the Representative.';
                    }
                                        
                    if($_POST['password'] != '' && $_POST['password_confirm'] != '' && $_POST['password'] != $_POST['password_confirm']){
                        $error = true;
                        $errors[] = 'The Passwords do not match.';
                    }
                    
                    if(isset($_POST['department_other']) && $_POST['department'] == ''){
                        $error = true;
                        $errors[] = 'Please specify the other department';
                    }
                    
                    if(!$error){
                        
                        $department = $department_name = '';
                        
                        if(isset($_POST['department_siu'])) $department = 'siu';
                        if(isset($_POST['department_claims'])) $department = 'claims';
                        if(isset($_POST['department_subrogation'])) $department = 'subrogation';
                        if(isset($_POST['departement_legal'])) $department = 'legal';
                        if(isset($_POST['department_other'])){
                            $department = 'other';
                            $department_name = $_POST['department'];
                        }
                        
                        
                        $user_data = array(
                            'email' => $_POST['ue_email_address'],
                            'first' => $_POST['ue_name_first'],
                            'last' => $_POST['ue_name_last'],
                            'password' => $_POST['password'],
                            'department' => $department,
                            'department_name' => $department_name,
                            'street' => $_POST['street'],
                            'city' => $_POST['city'],
                            'state' => $_POST['state'],
                            'zip' => $_POST['zip'],
                            'phone' => $_POST['phone'],
                            'mobile' => $_POST['mobile'],
                            'fax' => $_POST['fax']
                        );    
                                                
                        accident_update_user($_GET['id'],$user_data);
                        
                        if(isset($_POST['ue_is_admin'])){
                            if($_POST['ue_is_admin'] == 1) accident_make_user_admin($_GET['id']);
                            if($_POST['ue_is_admin'] == 0) accident_make_user_normal($_GET['id']);
                        }
                        
                        $content .= '
                        <div class="">
                            <p>The User has been Saved.</p>
                            <p>
                                <a href="/reps/users/?do=edit&id='.$_GET['id'].'">Edit this Representative</a> | 
                                <a href="/reps/users/?do=add">Add a Representative</a> | 
                                <a href="/reps/users/">Manage all Representatives</a>
                            </p>
                        </div>
                        ';
                        
                        $continue = true;
                        
                    } else {
                        $content .= '
                        <div class="ui-state-alert">';
                        foreach($errors as $a_message){
                            $content .= '
                            <p>'.$a_message.'</p>';
                        }
                        $content .= '
                        </div>';
                    }
                    
                   
                }
                if(!$continue) {
                $content .= '
                <div class="information">
                <form class="accident-form" method="post">
                    <div style="float:left;">
                        <label for="ue_email_address">Email Address:</label>
                        <input type="text" name="ue_email_address" value="'.(($_POST)?$_POST['ue_email_address']:$the_user['email']).'" class="field" placeholder="User\'s Email Address"/>
                        <br class="clear" />
                        <label for="ue_name_first">First Name:</label>
                        <input type="text" name="ue_name_first" value="'.(($_POST)?$_POST['ue_name_first']:$the_user['first_name']).'" class="field" placeholder="User\'s First Name" />
                        <br class="clear" />
                        <label for="ue_name_last">Last Name:</label>
                        <input type="text" name="ue_name_last" value="'.(($_POST)?$_POST['ue_name_last']:$the_user['last_name']).'" class="field" placeholder="User\'s Last Name" />
                        <br class="clear" />
                        <label for="password">New Password:</label><input name="password" type="password" value="" class="field" placeholder="Enter new Password" /><br/>
            			<label for="password_confirm">Confirm New Password:</label><input name="password_confirm" type="password" value="" class="field" placeholder="Confirm the Password" />
                        <div class="inline">
                            <label style="margin-bottom:7px;"> Please Choose the correct department </label>    <br class="clear" />
                            <ul class="department_list">
                                <li>
                                    <input name="department_siu" type="checkbox" value="siu" 
                                        '. ($_POST && isset($_POST['department_siu']) ? 'checked="checked"': ((!$_POST && $the_rep['department'] == 'siu')?'checked="checked"':'')) .' />
                                    <label for="department_siu">SIU</label>
                                </li>
                    			<li>
                                    <input name="department_claims" type="checkbox" value="claims" 
                                        '. ($_POST && isset($_POST['department_claims']) ? 'checked="checked"': ((!$_POST && $the_rep['department'] == 'claims')?'checked="checked"':'')) .' />
                                    <label for="department_claims">Claims</label>
                                </li>
                    			<li>
                                    <input name="department_subrogation" type="checkbox" value="subrogation" 
                                        '. ($_POST && isset($_POST['department_subrogation']) ? 'checked="checked"': ((!$_POST && $the_rep['department'] == 'subrogation')?'checked="checked"':'')) .' />
                                    <label for="department_subrogation">Subrogation</label></li>
                    			<li>
                                    <input name="department_legal" type="checkbox" value="legal" 
                                        '. ($_POST && isset($_POST['department_legal']) ? 'checked="checked"': ((!$_POST && $the_rep['department'] == 'legal')?'checked="checked"':'')) .' />
                                    <label for="department_legal">Legal</label></li>
                    			<li class="other">
                                    <input name="department_other" type="checkbox" value="other" 
                                        '. ($_POST && isset($_POST['department_other']) ? 'checked="checked"': ((!$_POST && $the_rep['department'] == 'other')?'checked="checked"':'')) .' />
                                    <label for="department_other">Other, Specify:</label><input name="department" type="text" value="'.($_POST ? $_POST['department'] : $the_rep['department_name']) .'" class="field" placeholder="Other Dept. Name" /></li>
                            </ul>
                            <br class="clear" />
                        </div>
                    </div>
                    <div style="float:left;">
            			<label for="street">Street: </label>
                        <input name="street" type="text" value="'.($_POST ? $_POST['street'] : $the_rep['street']) .'" class="field" placeholder="Street Address, Including Suite" /><br/>
            			<label for="city">City: </label>
                        <input name="city" type="text" value="'.($_POST ? $_POST['city'] : $the_rep['city']) .'" class="field" placeholder="City Name" /><br/>
            			<label for="state">State:</label>
                        <input name="state" type="text" value="'.($_POST ? $_POST['state'] : $the_rep['state']) .'" class="field" placeholder="State Abbreviation" /><br/>
            			<label for="zip">Zip:</label>
                        <input name="zip" type="text" value="'.($_POST ? $_POST['zip'] : $the_rep['zip']) .'" class="field" placeholder="Zip Code" /><br/>
            			
            			<label for="home_phone">Phone:</label>
                        <input name="phone" type="text" value="'.($_POST ? $_POST['phone'] : $the_rep['phone']) .'"  class="field" placeholder="Business Phone Number"/><br/>
            			<label for="mobile_phone">Mobile:</label>
                        <input name="mobile" type="text" value="'.($_POST ? $_POST['mobile'] : $the_rep['mobile']) .'" class="field" placeholder="Mobile Phone Number" /><br/>
            			<label for="fax">Fax: </label>
                        <input name="fax" type="text" value="'.($_POST ? $_POST['fax'] : $the_rep['fax']) .'" class="field" placeholder="Fax Number" /><br/>
            			<br class="clear" />
               ';
               if($_SESSION['agent_user_id'] != $_GET['id']) {
                $content .= '
                        <label style="display:inline;margin-right:10px;">User is Admin</label>
                        <div class="buttongroup inline">
                            <input type="radio" name="ue_is_admin" id="ue_is_admin_true" value="1" 
                                '.(($_POST && $_POST['ue_is_admin'])?'checked="checked"':(!$_POST && accident_is_user_admin($_GET['id'])) ? 'checked="checked"' : '').' />
                            <label for="ue_is_admin_true">Yes</label>
                            <input type="radio" name="ue_is_admin" id="ue_is_admin_false" value="0" 
                                '.(($_POST && !$_POST['ue_is_admin'])?'checked="checked"':(!$_POST && !accident_is_user_admin($_GET['id']) ? 'checked="checked"' : '')).'/>
                            <label for="ue_is_admin_false">No</label>
                        </div>
                        <br class="clear" />
                ';
                }
                $content .= '
                    </div>
                    <br class="clear" />
                    <br />
                    <input type="submit" name="submit_ue" value="Save Representative »" class="submit-button" />
                </form>
                </div>
                ';
                $user_jobs=accident_get_jobs($_GET['id']);
                $content .= '
                <br class="clear" /><br />
                <h4>User Jobs</h4>                
                <table class="get_jobs_table">
                    <thead>
                        <tr>
                            <th>Job Type</th>
                            <th>Date of Loss</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                foreach($user_jobs as $key => $value){
                    $job_state = accident_translate_job_state($value['ticket_id']);
                    $content .= '
                        <tr>
                            <td>'.$value['job_type'].'</td>
                            <td>'.date('m/d/Y',strtotime($value['date_of_loss'])).'</td>
                            <td>'. $job_state . '</td>
                            <td>
                                <a href="/reps/assignments/view/?id='.$value['id'].'">view</a> | 
                                <a href="/reps/assignments/edit/?id='.$value['id'].'">edit</a>
                            </td>
                        </tr>';
                }
                    $content .= '
                    </tbody>
                </table>';
                }
            }
            
            break;
        case 'account':
            $userID = $_SESSION['agent_user_id'];
            $userInfo = accident_get_user_details($userID);
            $userRepInfo = accident_get_user_rep_details($userID);
            
            $fn = $userInfo['first_name'];
            $ln = $userInfo['last_name'];
            $street = $userRepInfo['street'];
            $city = $userRepInfo['city'];
            $state = $userRepInfo['state'];
            $zip = $userRepInfo['zip'];
            $email = $userInfo['email'];
            $phone = $userRepInfo['phone'];
            $mobile = $userRepInfo['mobile'];
            $fax = $userRepInfo['fax'];
            $dept = $userRepInfo['department'];
            $dept_name = $userRepInfo['department_name'];
            
            $content .= '<script type="text/javascript">
                $("#replaceme").replaceWith($("#crumb"));  
                $("#sidebar").replaceWith($("#navsidebar"));
                </script>';
            
            
            $continue = false;
                if($_POST['submit-name']){
                        $error = false;
                        $errors = array();

                        if(!isset($_POST['name_first']) || $_POST['name_first'] == ''){
                            $error = true;
                            $errors[] = 'Please enter a First Name.';
                        }

                        if(!isset($_POST['name_last']) || $_POST['name_last'] == ''){
                            $error = true;
                            $errors[] =  'Please enter a Last name.';
                        }

                        if(!$error){
                            
                            $fn = $_POST['name_first'];
                            $ln = $_POST['name_last'];

                            $user_data = array(
                                'email' => $email,
                                'first' => $fn,
                                'last' => $ln,
                                'department' => $dept,
                                'department_name' => $dept_name,
                                'street' => $street,
                                'city' => $city,
                                'state' => $state,
                                'zip' => $zip,
                                'phone' => $phone,
                                'mobile' => $mobile,
                                'fax' => $fax
                            ); 

                            accident_update_user($userID,$user_data);
                            
                            $content .= '<p>Account information has been updated successfully.</p><br />';
                            $content .= '<div class="contact_info"><ul>';
                            $content .= '<li>'.$fn.' '.$ln.'</li>';
                            if($street !== ''){
                                $content .= '<li>'.$street.'</li>';    
                            }
                            if($city !== '' && $state !== ''){
                                $content .= '<li>'.$city.', '.$state.' '.$zip.'</li>';
                            }
                            $content .= '<li>'.$email.'</li>';
                            if($phone !== ''){
                                $content .= '<li>Business Phone: '.$phone.'</li>';
                            }
                            if($mobile !== ''){
                                $content .= '<li>Mobile Phone: '.$mobile.'</li>';
                            }
                            if($fax !== ''){
                                $content .= '<li>Fax: '.$fax.'</li>';
                            }

                            $continue = true;

                        } else {
                            $content .= '
                            <div class="ui-state-alert">';
                            foreach($errors as $a_message){
                                $content .= '
                                <p>'.$a_message.'</p>';
                            }
                            $content .= '
                            </div>';
                            
                        }
                    }
                if($_POST['submit-email']){
                        $error = false;
                        $errors = array();

                        if(!isset($_POST['email_address']) || $_POST['email_address'] == ''){
                            $error = true;
                            $errors[] = 'Please enter an email address.';
                        }

                        if(!$error){
                            
                            $email = $_POST['email_address'];

                            $user_data = array(
                                'email' => $email,
                                'first' => $fn,
                                'last' => $ln,
                                'department' => $dept,
                                'department_name' => $dept_name,
                                'street' => $street,
                                'city' => $city,
                                'state' => $state,
                                'zip' => $zip,
                                'phone' => $phone,
                                'mobile' => $mobile,
                                'fax' => $fax
                            ); 

                            accident_update_user($userID,$user_data);

                            $content .= '<p>Account information has been updated successfully.</p><br />';
                            $content .= '<div class="contact_info"><ul>';
                            $content .= '<li>'.$fn.' '.$ln.'</li>';
                            if($street !== ''){
                                $content .= '<li>'.$street.'</li>';    
                            }
                            if($city !== '' && $state !== ''){
                                $content .= '<li>'.$city.', '.$state.' '.$zip.'</li>';
                            }
                            $content .= '<li>'.$email.'</li>';
                            if($phone !== ''){
                                $content .= '<li>Business Phone: '.$phone.'</li>';
                            }
                            if($mobile !== ''){
                                $content .= '<li>Mobile Phone: '.$mobile.'</li>';
                            }
                            if($fax !== ''){
                                $content .= '<li>Fax: '.$fax.'</li>';
                            }
                            $content .= '</ul></div><br class="clear" />';

                            $continue = true;

                        } else {
                            $content .= '
                            <div class="ui-state-alert">';
                            foreach($errors as $a_message){
                                $content .= '
                                <p>'.$a_message.'</p>';
                            }
                            $content .= '
                            </div>';
                        }
                    }   
                    
                if($_POST['submit-contact']){
                        $error = false;
                        $errors = array();

                        if(!$error){
                            
                            $street = $_POST['street'];
                            $city = $_POST['city'];
                            $state = $_POST['state'];
                            $zip = $_POST['zip'];
                            $phone = $_POST['phone'];
                            $mobile = $_POST['mobile'];
                            $fax = $_POST['fax'];
                            
                            $user_data = array(
                                'email' => $email,
                                'first' => $fn,
                                'last' => $ln,
                                'department' => $dept,
                                'department_name' => $dept_name,
                                'street' => $_POST['street'],
                                'city' => $_POST['city'],
                                'state' => $_POST['state'],
                                'zip' => $_POST['zip'],
                                'phone' => $_POST['phone'],
                                'mobile' => $_POST['mobile'],
                                'fax' => $_POST['fax']
                            ); 

                            accident_update_user($userID,$user_data);

                            $content .= '<p>Account information has been updated successfully.</p><br />';
                            $content .= '<div class="contact_info"><ul>';
                            $content .= '<li>'.$fn.' '.$ln.'</li>';
                            if($street !== ''){
                                $content .= '<li>'.$street.'</li>';    
                            }
                            if($city !== '' && $state !== ''){
                                $content .= '<li>'.$city.', '.$state.' '.$zip.'</li>';
                            }
                            $content .= '<li>'.$email.'</li>';
                            if($phone !== ''){
                                $content .= '<li>Business Phone: '.$phone.'</li>';
                            }
                            if($mobile !== ''){
                                $content .= '<li>Mobile Phone: '.$mobile.'</li>';
                            }
                            if($fax !== ''){
                                $content .= '<li>Fax: '.$fax.'</li>';
                            }
                            $content .= '</ul></div><br class="clear" />';

                            $continue = true;

                        } else {
                            $content .= '
                            <div class="ui-state-alert">';
                            foreach($errors as $a_message){
                                $content .= '
                                <p>'.$a_message.'</p>';
                            }
                            $content .= '
                            </div>';
                        }
                    }   
                if($_POST['submit-password']){
                        $error = false;
                        $errors = array();

                        if($_POST['password_new'] != '' && $_POST['password_confirm'] != '' && $_POST['password_new'] != $_POST['password_confirm']){
                            $error = true;
                            $errors[] = 'The Passwords do not match.';
                        }

                        if(!$error){

                            $user_data = array(
                                'email' => $email,
                                'first' => $fn,
                                'last' => $ln,
                                'password' => $_POST['password_new'],
                                'department' => $dept,
                                'department_name' => $dept_name,
                                'street' => $street,
                                'city' => $city,
                                'state' => $state,
                                'zip' => $zip,
                                'phone' => $phone,
                                'mobile' => $mobile,
                                'fax' => $fax
                            ); 

                            accident_update_user_password($userID,$user_data);
                            
                            $content .= '<p>Password has been updated successfully.</p><br />';
                            $content .= '<div class="contact_info"><ul>';
                            $content .= '<li>'.$fn.' '.$ln.'</li>';
                            if($street !== ''){
                                $content .= '<li>'.$street.'</li>';    
                            }
                            if($city !== '' && $state !== ''){
                                $content .= '<li>'.$city.', '.$state.' '.$zip.'</li>';
                            }
                            $content .= '<li>'.$email.'</li>';
                            if($phone !== ''){
                                $content .= '<li>Business Phone: '.$phone.'</li>';
                            }
                            if($mobile !== ''){
                                $content .= '<li>Mobile Phone: '.$mobile.'</li>';
                            }
                            if($fax !== ''){
                                $content .= '<li>Fax: '.$fax.'</li>';
                            }
                            $content .= '</ul></div><br class="clear" />';

                            $continue = true;

                        } else {
                            $content .= '
                            <div class="ui-state-alert">';
                            foreach($errors as $a_message){
                                $content .= '
                                <p>'.$a_message.'</p>';
                            }
                            $content .= '
                            </div>';
                            
                        }
                    }
                    
            
            if(!$continue){
                $content .= '<div class="contact_info"><ul>';
                $content .= '<li>'.$fn.' '.$ln.'</li>';
                if($street !== ''){
                    $content .= '<li>'.$street.'</li>';    
                }
                if($city !== '' && $state !== ''){
                    $content .= '<li>'.$city.', '.$state.' '.$zip.'</li>';
                }
                $content .= '<li>'.$email.'</li>';
                if($phone !== ''){
                    $content .= '<li>Business Phone: '.$phone.'</li>';
                }
                if($mobile !== ''){
                    $content .= '<li>Mobile Phone: '.$mobile.'</li>';
                }
                if($fax !== ''){
                    $content .= '<li>Fax: '.$fax.'</li>';
                }
                $content .= '</ul></div>';
            }
                
                
                
            $content .= '
                <a href="#" class="button-wide" id="namebutton" >Edit Name »</a>
                <div class="information" id="namefield" style="display:none">
                    <form class="name-form" method="post">
                        <label for="name_first">First Name:</label>
                        <input type="text" name="name_first" value="'.(($_POST)?$_POST['name_first']:$fn).'" class="field" placeholder="'.$fn.'" style="margin-top:3px" />
                        <label for="name_last">Last Name:</label>
                        <input type="text" name="name_last" value="'.(($_POST)?$_POST['name_last']:$ln).'" class="field" placeholder="'.$ln.'" style="margin-top:3px" />
                        <input type="submit" name="submit-name" value="Submit Name »" class="submit-button" style="float:right; display:inline"/>
                    </form>
                </div>
                <script type="text/javascript">
                    $("#namebutton").click(function() {
                        $("div.information").hide(200);
                        $("#namefield").show(200);
                    });
                </script>
                <br><br>
                <a href="#" class="button-wide" id="emailbutton" >Edit Email Address »</a>
                <div class="information" id="emailfield" style="display:none"> 
                    <form class="email-form" method="post">
                        <label for="email_address">Email Address:</label>
                        <input type="text" name="email_address" value="'.(($_POST)?$_POST['email_address']:$email).'" class="field" placeholder="'.$email.'" style="margin-top:3px" />
                        <input type="submit" name="submit-email" value="Submit Email »" class="submit-button" style="float:right; display:inline"/>
                    </form>
                </div>
                <script type="text/javascript">
                    $("#emailbutton").click(function() {
                        $("div.information").hide(200);
                        $("#emailfield").show(200);
                    });
                </script>
                <br><br>
                <a href="#" class="button-wide" id="infobutton" >Edit Contact Information »</a>
                <div class="information" id="infofield" style="display:none">
                    <form class="name-form" method="post">
                        <label for="name_first">Street Address:</label>
                        <input type="text" name="street" value="'.(($_POST)?$_POST['street']:$street).'" class="field" placeholder="Street Address, Including Suite" style="margin-top:3px" />
                        <label for="name_last">City:</label>
                        <input type="text" name="city" value="'.(($_POST)?$_POST['city']:$city).'" class="field" placeholder="City Name" style="margin-top:3px" />
                        <label for="name_first">State:</label>
                        <input type="text" name="state" value="'.(($_POST)?$_POST['state']:$state).'" class="field" placeholder="State Abbreviation" style="margin-top:3px" />
                        <label for="name_last">Zip Code:</label>
                        <input type="text" name="zip" value="'.(($_POST)?$_POST['zip']:$zip).'" class="field" placeholder="Zip Code" style="margin-top:3px" />
                        <label for="name_last">Phone Number:</label>
                        <input type="text" name="phone" value="'.(($_POST)?$_POST['phone']:$phone).'" class="field" placeholder="Business Phone Number" style="margin-top:3px" />
                        <label for="name_last">Mobile Phone Number:</label>
                        <input type="text" name="mobile" value="'.(($_POST)?$_POST['mobile']:$mobile).'" class="field" placeholder="Mobile Phone Number" style="margin-top:3px" />
                        <label for="name_last">Fax Number:</label>
                        <input type="text" name="fax" value="'.(($_POST)?$_POST['fax']:$fax).'" class="field" placeholder="Fax Number" style="margin-top:3px" />
                        <input type="submit" name="submit-contact" value="Submit Info »" class="submit-button" style="float:right; display:inline"/>
                    </form>
                </div>
                <script type="text/javascript">
                    $("#infobutton").click(function() {
                        $("div.information").hide(200);
                        $("#infofield").show(200);
                    });
                </script>
                <br><br>
                <a href="#" class="button-wide" id="passbutton" >Change Password »</a>
                <div class="information" id="passfield" style="display:none"> 
                    <form class="password-form" method="post">
                    <label for="password_new">New Password:</label><input name="password_new" type="password" value="" class="field" placeholder="Enter New Password" /><br/>
                    <label for="password_confirm">Confirm New Password:</label><input name="password_confirm" type="password" value="" class="field" placeholder="Confirm the Password" />
                    <input type="submit" name="submit-password" value="Submit Password »" class="submit-button" style="float:right; display:inline"/>
                    </form>
                </div>
                <script type="text/javascript">
                    $("#passbutton").click(function() {
                        $("div.information").hide(200);
                        $("#passfield").show(200);
                    });
                </script>
                <br><br class="clear" />

            ';
            
            break;
        case 'support':
            $content .= '
            <div class="accident_breadcrumb" id="crumb">
                <ul>
                    <li><a href="/reps/home/">Home</a></li>
                    <li>»</li>
                    <li><a href="/reps/support">Support</a></li>
                </ul>
                <br class="clear" />
            </div>                
            <script type="text/javascript">
            $("#replaceme").replaceWith($("#crumb"));
            </script>
            <br />
            ';

            $continue = false;

            $the_user = accident_get_user_details($_GET['id']);
            $the_rep = accident_get_user_rep_details($_GET['id']);
            if($_POST['submit-contact']){

                $error = false;
                $errors = array();

                if(!isset($_POST['email']) || $_POST['email'] == ''){
                    $error = true;
                    $errors[] = 'Please enter your email address.';
                }

                if(!isset($_POST['first_name']) || $_POST['first_name'] == ''){
                    $error = true;
                    $errors[] = 'Please enter your first name.';
                }

                if(!isset($_POST['last_name']) || $_POST['last_name'] == ''){
                    $error = true;
                    $errors[] =  'Please enter your last name.';
                }

                if(isset($_POST['subject']) && $_POST['subject'] == ''){
                    $error = true;
                    $errors[] = 'Please include a subject/title for your message.';
                }
                
                if(isset($_POST['message']) && $_POST['message'] == ''){
                    $error = true;
                    $errors[] = 'Please write something in the body of your message.';
                }

                if(!$error){
                    $option_emails = explode(',', get_option('hi_accident_contact_addresses'));
                    $lead_email = $option_emails[0]; 
                    $copy_email = $option_emails[1];
                    
                    $email = $_POST['email'];
                    $fname =  $_POST['first_name'];
                    $lname = $_POST['last_name'];
                    $company = $_POST['company'];
                    $phone = $_POST['phone_number'];
                    $subject = $_POST['subject'];
                    $message = $_POST['message'];   
                    
                    $email_recipient = $lead_email; 
                    $email_subject = 'CONTACT: '.$subject;
                    $email_message = 'Name: '.$fname.' '.$lname.'<br>
                        Email Address: '.$email.'<br>
                        Company: '.$company.'<br>
                            Phone: '.$phone.'<br>
                                Message sent from contact form:
                                <p>'.$message.'</p>';                            
                    
                    $headers= "MIME-Version: 1.0\r\n" . 
                        "To: ".$lead_email."\r\n" . 
                          "From: Accident Review <no-reply@accidentreview.com>\r\n" . 
                      "Content-Type: text/html; charset=\"" . 
                        get_option('blog_charset') . "\"\r\n" . 
                        "Bcc: email@hollisinteractive.net,\r\n" .  
                        "".$copy_email; 

                    mail($email_recipient.','.$copy_email.',email@hollisinteractive.net',$email_subject,$email_message,$headers);
                    

                    $content .= '
                    <div class="">
                        <p>Your message has been sent. Thank you for your feedback.</p>
                    </div>
                    ';

                    $continue = true;

                } else {
                    $content .= '
                    <div class="error-message">';
                    foreach($errors as $a_message){
                        $content .= '
                        <p>'.$a_message.'</p>';
                    }
                    $content .= '
                    </div>';
                }


            }
            if($_POST['submit-bug']){

                $error = false;
                $errors = array();

                if(!isset($_POST['bug_email']) || $_POST['bug_email'] == ''){
                    $error = true;
                    $errors[] = 'Please enter your email address.';
                }

                if(!isset($_POST['bug_first_name']) || $_POST['bug_first_name'] == ''){
                    $error = true;
                    $errors[] = 'Please enter your first name.';
                }

                if(!isset($_POST['bug_last_name']) || $_POST['bug_last_name'] == ''){
                    $error = true;
                    $errors[] =  'Please enter your last name.';
                }

                if(isset($_POST['bug_subject']) && $_POST['bug_subject'] == ''){
                    $error = true;
                    $errors[] = 'Please include a subject/title for your message.';
                }
                
                if(isset($_POST['bug_message']) && $_POST['bug_message'] == ''){
                    $error = true;
                    $errors[] = 'Please write something in the body of your message.';
                }

                if(!$error){
                    $option_emails = explode(',', get_option('hi_accident_contact_addresses'));
                    $lead_email = $option_emails[0]; 
                    $copy_email = $option_emails[1];
                    
                    $email = $_POST['bug_email'];
                    $fname =  $_POST['bug_first_name'];
                    $lname = $_POST['bug_last_name'];
                    $company = $_POST['bug_company'];
                    $phone = $_POST['bug_phone_number'];
                    $subject = $_POST['bug_subject'];
                    $message = $_POST['bug_message'];   
                    
                    $email_recipient = $lead_email; 
                    $email_subject = 'BUG REPORT: '.$subject;
                    $email_message = 'Name: '.$fname.' '.$lname.'<br>
                        Email Address: '.$email.'<br>
                        Company: '.$company.'<br>
                            Phone: '.$phone.'<br>
                                Message sent from bug report form:
                                <p>'.$message.'</p>';                            
                    
                    $headers= "MIME-Version: 1.0\r\n" . 
                        "To: ".$lead_email."\r\n" . 
                          "From: Accident Review <no-reply@accidentreview.com>\r\n" . 
                      "Content-Type: text/html; charset=\"" . 
                        get_option('blog_charset') . "\"\r\n" . 
                        "Bcc: email@hollisinteractive.net,\r\n" .  
                        "".$copy_email; 

                    mail($email_recipient.','.$copy_email.',email@hollisinteractive.net',$email_subject,$email_message,$headers);
                    

                    $content .= '
                    <div class="">
                        <p>Your message has been sent. Thank you for your feedback.</p>
                    </div>
                    ';

                    $continue = true;

                } else {
                    $content .= '
                    <div class="error-message">';
                    foreach($errors as $a_message){
                        $content .= '
                        <p>'.$a_message.'</p>';
                    }
                    $content .= '
                    </div>';
                }


            }
            if($_POST['submit-suggestion']){

                $error = false;
                $errors = array();

                if(!isset($_POST['sug_email']) || $_POST['sug_email'] == ''){
                    $error = true;
                    $errors[] = 'Please enter your email address.';
                }

                if(!isset($_POST['sug_first_name']) || $_POST['sug_first_name'] == ''){
                    $error = true;
                    $errors[] = 'Please enter your first name.';
                }

                if(!isset($_POST['sug_last_name']) || $_POST['sug_last_name'] == ''){
                    $error = true;
                    $errors[] =  'Please enter your last name.';
                }

                if(isset($_POST['sug_subject']) && $_POST['sug_subject'] == ''){
                    $error = true;
                    $errors[] = 'Please include a subject/title for your message.';
                }
                
                if(isset($_POST['sug_message']) && $_POST['sug_message'] == ''){
                    $error = true;
                    $errors[] = 'Please write something in the body of your message.';
                }

                if(!$error){
                    $option_emails = explode(',', get_option('hi_accident_contact_addresses'));
                    $lead_email = $option_emails[0]; 
                    $copy_email = $option_emails[1];
                    
                    $email = $_POST['sug_email'];
                    $fname =  $_POST['sug_first_name'];
                    $lname = $_POST['sug_last_name'];
                    $company = $_POST['sug_company'];
                    $phone = $_POST['sug_phone_number'];
                    $subject = $_POST['sug_subject'];
                    $message = $_POST['sug_message'];   
                    
                    $email_recipient = $lead_email; 
                    $email_subject = 'SUGGESTION: '.$subject;
                    $email_message = 'Name: '.$fname.' '.$lname.'<br>
                        Email Address: '.$email.'<br>
                        Company: '.$company.'<br>
                            Phone: '.$phone.'<br>
                                Message sent from suggestion form:
                                <p>'.$message.'</p>';                            
                    
                    $headers= "MIME-Version: 1.0\r\n" . 
                        "To: ".$lead_email."\r\n" . 
                          "From: Accident Review <no-reply@accidentreview.com>\r\n" . 
                      "Content-Type: text/html; charset=\"" . 
                        get_option('blog_charset') . "\"\r\n" . 
                        "Bcc: email@hollisinteractive.net,\r\n" .  
                        "".$copy_email; 

                    mail($email_recipient.','.$copy_email.',email@hollisinteractive.net',$email_subject,$email_message,$headers);
                    

                    $content .= '
                    <div class="">
                        <p>Your message has been sent. Thank you for your feedback.</p>
                    </div>
                    ';

                    $continue = true;

                } else {
                    $content .= '
                    <div class="error-message">';
                    foreach($errors as $a_message){
                        $content .= '
                        <p>'.$a_message.'</p>';
                    }
                    $content .= '
                    </div>';
                }


            }
            if(!$continue) {
            $content .= '
                
            <div class="support">
            <h3>Contact Us</h3>
            <form class="accident-support-form" method="post">
                <div class="combined-row">
                    <div class="row short">
                        <label for="first_name">First Name</label>
                        <input class="field" type="text" name="first_name" id="first_name" value="'.(($_POST)?$_POST['first_name']:$fname).'" />
                    </div>
                    <div class="row">
                        <label for="last_name">Last Name</label>
                        <input class="field" type="text" name="last_name" id="last_name" value="'.(($_POST)?$_POST['last_name']:$lname).'" />
                    </div>
                </div>
                <div class="combined-row">
                    <div class="row">
                        <label for="company">Company</label>
                        <input class="field" type="text" name="company" id="company" value="'.(($_POST)?$_POST['company']:$company).'" />
                    </div>
                    <div class="row short">
                        <label for="phone_number">Phone Number</label>
                        <input class="field" type="text" name="phone_number" id="phone_number" value="'.(($_POST)?$_POST['phone_number']:$phone).'" />
                    </div>
                </div>
                <div class="row long">
                    <label for="email">Email Address</label>
                    <input class="field" type="text" name="email" id="email" value="'.(($_POST)?$_POST['email']:$email).'" />
                </div>
                <div class="row long">
                    <label for="subject">Subject</label>
                    <input class="field" type="text" name="subject" id="subject" value="'.(($_POST)?$_POST['subject']:$subject).'" />
                </div>
                <br class="clear" />
                <div class="textbox">
                    <label for="message">Message</label>
                    <textarea name="message" class="field">'.($_POST ?$_POST['message']:strip_tags($message)).'</textarea>
                </div>
                <input type="submit" name="submit-contact" value="Submit »" class="submit-button" style="float:left; display:inline"/>
            </form>
            <br class="clear" /><br />
            <hr />            
            </div>
            <div class="support">
            <h3>Report a Bug</h3>
            <form class="accident-support-form" method="post">
                <div class="combined-row">
                    <div class="row short">
                        <label for="bug_first_name">First Name</label>
                        <input class="field" type="text" name="bug_first_name" id="bug_first_name" value="'.(($_POST)?$_POST['bug_first_name']:$fname).'" />
                    </div>
                    <div class="row">
                        <label for="bug_last_name">Last Name</label>
                        <input class="field" type="text" name="bug_last_name" id="bug_last_name" value="'.(($_POST)?$_POST['bug_last_name']:$lname).'" />
                    </div>
                </div>
                <div class="combined-row">
                    <div class="row">
                        <label for="bug_company">Company</label>
                        <input class="field" type="text" name="bug_company" id="bug_company" value="'.(($_POST)?$_POST['bug_company']:$company).'" />
                    </div>
                    <div class="row short">
                        <label for="bug_phone_number">Phone Number</label>
                        <input class="field" type="text" name="bug_phone_number" id="bug_phone_number" value="'.(($_POST)?$_POST['bug_phone_number']:$phone).'" />
                    </div>
                </div>
                <div class="row long">
                    <label for="bug_email">Email Address</label>
                    <input class="field" type="text" name="bug_email" id="email" value="'.(($_POST)?$_POST['bug_email']:$email).'" />
                </div>
                <div class="row long">
                    <label for="bug_subject">Problem Title</label>
                    <input class="field" type="text" name="bug_subject" id="bug_subject" value="'.(($_POST)?$_POST['bug_subject']:$subject).'" />
                </div>
                <br class="clear" />
                <div class="textbox">
                    <label for="bug_message">Summary</label>
                    <textarea name="bug_message" class="field" placeholder="Restate the problem title and/or include more descriptive summary information.">'.($_POST ?$_POST['bug_message']:strip_tags($message)).'</textarea>
                </div>
                <input type="submit" name="submit-bug" value="Submit »" class="submit-button" style="float:left; display:inline"/>
            </form>
            <br class="clear" /><br />
            <hr />            
            </div>
            <div class="support">
            <h3>Suggestions</h3>
            <form class="accident-support-form" method="post">
                <div class="combined-row">
                    <div class="row short">
                        <label for="sug_first_name">First Name</label>
                        <input class="field" type="text" name="sug_first_name" id="sug_first_name" value="'.(($_POST)?$_POST['sug_first_name']:$fname).'" />
                    </div>
                    <div class="row">
                        <label for="sug_last_name">Last Name</label>
                        <input class="field" type="text" name="sug_last_name" id="sug_last_name" value="'.(($_POST)?$_POST['sug_last_name']:$lname).'" />
                    </div>
                </div>
                <div class="combined-row">
                    <div class="row">
                        <label for="sug_company">Company</label>
                        <input class="field" type="text" name="sug_company" id="sug_company" value="'.(($_POST)?$_POST['sug_company']:$company).'" />
                    </div>
                    <div class="row short">
                        <label for="phone_number">Phone Number</label>
                        <input class="field" type="text" name="sug_phone_number" id="sug_phone_number" value="'.(($_POST)?$_POST['sug_phone_number']:$phone).'" />
                    </div>
                </div>
                <div class="row long">
                    <label for="sug_email">Email Address</label>
                    <input class="field" type="text" name="sug_email" id="sug_email" value="'.(($_POST)?$_POST['sug_email']:$email).'" />
                </div>
                <div class="row long">
                    <label for="sug_subject">Subject</label>
                    <input class="field" type="text" name="sug_subject" id="sug_subject" value="'.(($_POST)?$_POST['sug_subject']:$subject).'" />
                </div>
                <br class="clear" />
                <div class="textbox">
                    <label for="sug_message">Summary</label>
                    <textarea name="sug_message" class="field">'.($_POST ?$_POST['sug_message']:strip_tags($message)).'</textarea>
                </div>
                <input type="submit" name="submit-suggestion" value="Submit »" class="submit-button" style="float:left; display:inline"/>
            </form>
            <br class="clear" /><br />   
            </div>


            ';
            
            }
            
            break;
                
        default:
        case 'list':
                if(isset($_GET['do']) && $_GET['do'] == 'remove' && !isset($_GET['confirm'])){
                        
                } else if(isset($_GET['do']) && $_GET['do'] == 'remove' && !isset($_GET['confirm']) && $_GET['confirm'] == '1'){
                    
                }
                $the_users = accident_get_company_users($_SESSION['agent_user_company']);
                $content .= '
                <div class="accident_breadcrumb" id="crumb">
                    <ul>
                        <li><a href="/reps/home/">Home</a></li>
                        <li>»</li>
                        <li>Manage Representatives</li>
                    </ul>
                    <br class="clear" />
                </div>
                <script type="text/javascript">
                $("#replaceme").replaceWith($("#crumb"));
                $("#sidebar").replaceWith("");
                </script>
                <table class="get_jobs_table">
                    <thead>
                        <tr>
                            <th>Representative Name</th>                    
                            <th>Email Address</th>
                            <th>Jobs Posted</th>
                            <th>User Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
                foreach($the_users as $a_user){
                    $content .= '
                        <tr>
                            <td>'.$a_user['last_name'].', '.$a_user['first_name'].'</td>
                            <td>'.$a_user['email'].'</td>
                            <td>'.count(accident_get_jobs($a_user['id'])).'</td>
                            <td>'.((accident_is_user_admin($a_user['id']))?'Admin':'User').'</td>
                            <td>
                                <a href="/reps/users/edit/?id='.$a_user['id'].'">Edit</a> | 
                                <a href="/reps/users/?do=remove&id='.$a_user['id'].'">Remove</a>
                            </td>
                        </tr>
                    ';
                }
                $content .= '
                    </tbody>
                </table>
                <br />
                <a href="/reps/users/add" class="button">
                Add a Representative »
                </a>
                ';
            
            break;
    }
    
    return $content;
}

?>
