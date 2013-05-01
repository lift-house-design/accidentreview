<?php

function get_company_jobs($atts, $content = null, $code = ""){
    if(!isset($_SESSION['agent_user_id'])) header('/reps/login');
    
    extract(shortcode_atts(array(
        'type'=>'list'
    ), $atts));

    if(!isset($_GET['do'])){
        $_GET['do'] = $type;
    }
    
    
    echo'<div id="get_jobs_page">';
    
    
    switch($_GET['do']){
        case 'view':
            $questions=get_all_questions();
            $id=$_GET['id'];
            $job=accident_get_job_details($id);
            $files=accident_get_job_files($id);
            if(array_key_exists('comment_text',$_POST)){
                $comment_text='<p>'.$_POST['comment_text'].'</p>';
                accident_create_comment($id,$comment_text);
            }
            $comments=accident_get_job_comments($id);
            echo print_job_details_table($id,true,true,true);
              
            break;//end of view case
            
//******************************************************************************            
        case 'pdf':
            $questions=get_all_questions();
            $id=$_GET['id'];
            $job=accident_get_job_details($id);
            $files=accident_get_job_files($id);
            if(array_key_exists('comment_text',$_POST)){
                $comment_text='<p>'.$_POST['comment_text'].'</p>';
                accident_create_comment($id,$comment_text);
            }
            $comments=accident_get_job_comments($id);
            echo print_job_details_table($id,true,true,true);
              
            break;//end of view case
            
//******************************************************************************            
        case 'edit':
            $questions=get_all_questions();
            $id=$_GET['id'];
            $job=accident_get_job_details($id);
            $files=accident_get_job_files($id);
            if(array_key_exists('comment_text',$_POST)){
                $comment_text='<p>'.$_POST['comment_text'].'</p>';
                accident_create_comment($id,$comment_text);
            }
            $comments=accident_get_job_comments($id);
            include('main-request-form.php');
            //update_array();

            break;//end of edit case
        
//******************************************************************************        
        case 'list':
        default:
            echo '
            <div class="search-box">
                <!--<h3>Search Assignments</h3>-->
                <input type="text" name="search_assignments" id="search_assignments" placeholder="Search Assignments"/>
                <img class="searching-spinner" src="'.get_bloginfo('stylesheet_directory').'/images/ajax-loader.gif" alt="Searching..." />
                <!--<input type="image" name="reset_assignments_image" value="Reset" src="'.get_bloginfo('stylesheet_directory').'/images/be-reset.png" style="width:72px;" />-->
                <input type="image" name="search_assignments_image" id="search_assignments_button" value="Search Assignments" src="'.get_bloginfo('stylesheet_directory').'/images/be-search.png" style="width:72px;margin-top:0px;" />
            </div>
            <div class="accident_breadcrumb"  id="crumb">
                <ul>
                    <li><a href="/reps/home/">Home</a></li>
                    <li>»</li>
                    <li><a href="/reps/assignments">Manage Assignments</a></li>
                </ul><br class="clear" />
            </div>
            <script type="text/javascript">
            $("#replaceme").replaceWith($("#crumb"));
            </script>
            
            <div class="sidebar" id="navsidebar">
            <ul>
            <li><h2>Assignments</h2><br class="clear"></li>
            <li><a href="/reps/home">Make New Assignment »</a></li>
            </ul>
            </div>

            <script type="text/javascript">
            $("#sidebar").replaceWith($("#navsidebar"));
            </script>
            
            <script type="text/javascript">
            $(function() {
                    $( "#content #tabs" ).tabs();
            });
            </script>
            




            <strong>'.$_SESSION['agent_company_name'].'</strong><br />';
            if($_SESSION['agent_company_data']['office_address'] != ''){
                echo '
            <div id="address">
                '.$_SESSION['agent_company_data']['office_address'].'
            </div>
                ';
            } else if($_SESSION['agent_rep_data']['street'] != ''){
                echo '
            <div id="address">
                '.$_SESSION['agent_rep_data']['street'].'<br />
                '.$_SESSION['agent_rep_data']['city'].' '.$_SESSION['agent_rep_data']['state'].', '.$_SESSION['agent_rep_data']['zip'].'
            </div>  
            '; 
            }
            
            if($_SESSION['agent_user_admin']){
                $jobs=accident_get_company_jobs($_SESSION['agent_user_company']);
                
                $open_jobs = array();
                $pending_jobs = array();
                $complete_jobs = array();
                
                foreach($jobs as &$a_job){
                    switch(accident_translate_job_state($a_job['ticket_id'])){
                        case 'Open':
                            $open_jobs[] = $a_job;
                            break;
                        case 'Pending':
                            $pending_jobs[] = $a_job;
                            break;
                        case 'Complete':
                            $complete_jobs[] = $a_job;
                            break;
                    }
                }
                
                if(count($pending_jobs) > 0){
                    echo '
                        <div id="tabs">
                            <ul>
                                <li><a href="#open">OPEN ['.count($open_jobs).']</a></li>
                                <li><a href="#pending">PENDING ['.count($pending_jobs).']</a></li>
                                <li><a href="#complete">COMPLETE ['.count($complete_jobs).']</a></li>
                            </ul>      
                    ';
                }else{
                    echo'
                        <div id="tabs">
                            <ul>
                                <li><a href="#open">OPEN ['.count($open_jobs).']</a></li>
                                <li><a href="#complete">COMPLETE ['.count($complete_jobs).']</a></li>
                            </ul>
                    ';
                }               
                
                if(count($pending_jobs) > 0){
                echo '
                    <div id="pending">
                <table class="get_jobs_table">
                    <thead>
                        <tr>
                            <th class="header">File #</th>
                            <th class="{sorter:false}">&nbsp;</th>
                            <th class="header">Insured</th>
                            <th class="header" style="width:75px">Date of Loss</th>
                            <th class="header">AR#</th>
                            <th class="header">Submitted</th>
                            <th class="header">&nbsp</th>
                            <th class="header">Loss Type</th>
                            <th class="header">Rep Name</th>
                            <th class="{sorter:false}" style="width:75px">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach($pending_jobs as $key => $value){
                            //$job_state = accident_translate_job_state($pending_jobs[$key]['ticket_id']);
                            
                            if(count($pending_jobs[$key]['files']) > 0){
                                $attachment_link = '<a href="/reps/assignments/view/?id='.$pending_jobs[$key]['id'].'"><img src="'.get_bloginfo('stylesheet_directory').'/images/paperclip.png" /></a>';
                            } else {
                                $attachment_link = '&nbsp;';
                            }
                            
                            if(empty($pending_jobs[$key]['last_name'])){
                                $pending_jobs[$key]['last_name']='~';
                            }
                            if(empty($pending_jobs[$key]['first_name'])){
                                $pending_jobs[$key]['first_name']='~';
                            }
                            
                            if(accident_get_new_comments($pending_jobs[$key]['id']) > 0)
                            {
                                //$comm = ' <a href="/reps/assignments/view/?id='.$pending_jobs[$key]['id'].'#comments"><div class="comments-icon">['.count($pending_jobs[$key]['comments']).']</div></a>';
                                $comm = ' <a href="/reps/assignments/view/?id='.$pending_jobs[$key]['id'].'#comments"><div class="comments-icon" style="margin-bottom: -3px;">&nbsp</div></a>';
                                //$comm = accident_get_new_comments($pending_jobs[$key]['id']);
                            }else{
                                //$comm = accident_get_new_comments($pending_jobs[$key]['id']);
                                $comm = '';
                            }
                            
                            echo '
                        <tr>
                            <td>'.$pending_jobs[$key]['client_file_id'].'</td>
                            <td>'.$comm.'</td>
                            <td>'.$pending_jobs[$key]['claimant_a_owner_name'].'</td>
                            <td>'.date('m/d/Y',strtotime($pending_jobs[$key]['date_of_loss'])).'</td>
                            <td>'.$pending_jobs[$key]['id'].'</td>
                            <td>'.date('m/d/Y',strtotime($pending_jobs[$key]['ticket']['created_on'])).'</td>
                            <td></td>
                            <td>'.$pending_jobs[$key]['job_type'].'</td>
                            <td>'.$pending_jobs[$key]['last_name'].', '.$pending_jobs[$key]['first_name'].'</td>
                            <td>
                                <a href="/reps/assignments/view/?id='.$pending_jobs[$key]['id'].'">View</a> | <a href="/reps/assignments/edit/?id='.$pending_jobs[$key]['id'].'">Edit</a>
                            </td>
                        </tr>
                            ';
                            /*echo '<tr>';
                            echo '<td>'.date('m/d/Y',strtotime($pending_jobs[$key]['ticket']['created_on'])).'</td>';
                            echo '<td>'.$pending_jobs[$key]['id'].'</td>';
                            echo '<td>'.$pending_jobs[$key]['client_file_id'].'</td>';
                            echo '<td style="text-align:center;vertical-align:middle;">'.$attachment_link.'</td>';
                            echo '<td>'.$pending_jobs[$key]['last_name'].', '.$pending_jobs[$key]['first_name'].'</td>';
                            echo '<td>'.$pending_jobs[$key]['job_type'].'</td>';
                            echo '<td>'.date('m/d/Y',strtotime($pending_jobs[$key]['date_of_loss'])).'</td>';
                            //echo '<td>'; echo $job_state; echo'</td>';
                            echo '<td><a href="/reps/assignments/view/?id='.$pending_jobs[$key]['id'].'">View</a> | <a href="/reps/assignments/edit/?id='.$pending_jobs[$key]['id'].'">Edit</a></td>';
                            echo '</tr>';*/
                        }
                    echo '
                    </tbody>
                </table></div>';
                }
                echo '
                    <div id="open">
                <table class="get_jobs_table">
                    <thead>
                        <tr>
                            <th class="header">File #</th>
                            <!--<th class="{sorter:false}">&nbsp;</th>-->
                            <th class="header">Insured</th>
                            <th class="header"  style="width:75px">Date of Loss</th>
                            <th class="header">AR#</th>
                            <th class="header">Submitted</th>
                            <th class="header">&nbsp</th>
                            <th class="header">Loss Type</th>
                            <th class="header">Rep Name</th>
                            <th class="{sorter:false}" style="width:75px">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach($open_jobs as $key => $value){
                            //$job_state = accident_translate_job_state($open_jobs[$key]['ticket_id']);
                            
                            if(count($open_jobs[$key]['files']) > 0){
                                $attachment_link = '<a href="/reps/assignments/view/?id='.$open_jobs[$key]['id'].'"><img src="'.get_bloginfo('stylesheet_directory').'/images/paperclip.png" /></a>';
                            } else {
                                $attachment_link = '&nbsp;';
                            }
                            
                            if(empty($open_jobs[$key]['last_name'])){
                                $open_jobs[$key]['last_name']='~';
                            }
                            if(empty($open_jobs[$key]['first_name'])){
                                $open_jobs[$key]['first_name']='~';
                            }
                            
                            if(accident_get_new_comments($open_jobs[$key]['id']) > 0)
                            {
                                //$comm = ' <a href="/reps/assignments/view/?id='.$open_jobs[$key]['id'].'#comments">['.count($open_jobs[$key]['comments']).']</a>';
                                $comm = ' <a href="/reps/assignments/view/?id='.$open_jobs[$key]['id'].'#comments"><div class="comments-icon" style="margin-bottom: -3px;">&nbsp</div></a>';
                            }else{
                                $comm = '';
                            }
                            
                            echo '
                        <tr>
                            <td>'.$open_jobs[$key]['client_file_id'].$comm.'</td>
                            <!--<td>'.$attachment_link.'</td>-->
                            <td>'.$open_jobs[$key]['claimant_a_owner_name'].'</td>
                            <td>'.date('m/d/Y',strtotime($open_jobs[$key]['date_of_loss'])).'</td>
                            <td>'.$open_jobs[$key]['id'].'</td>
                            <td>'.date('m/d/Y',strtotime($open_jobs[$key]['ticket']['created_on'])).'</td>
                            <td></td>
                            <td>'.$open_jobs[$key]['job_type'].'</td>
                            <td>'.$open_jobs[$key]['last_name'].', '.$open_jobs[$key]['first_name'].'</td>
                            <td>
                                <a href="/reps/assignments/view/?id='.$open_jobs[$key]['id'].'">View</a> | <a href="/reps/assignments/edit/?id='.$open_jobs[$key]['id'].'">Edit</a>
                            </td>
                        </tr>
                            ';
                            /*echo '<tr>';
                            echo '<td>'.date('m/d/Y',strtotime($open_jobs[$key]['ticket']['created_on'])).'</td>';
                            echo '<td>'.$open_jobs[$key]['id'].'</td>';
                            echo '<td>'.$open_jobs[$key]['client_file_id'].'</td>';
                            echo '<td style="text-align:center;vertical-align:middle;">'.$attachment_link.'</td>';
                            echo '<td>'.$open_jobs[$key]['last_name'].', '.$open_jobs[$key]['first_name'].'</td>';
                            echo '<td>'.$open_jobs[$key]['job_type'].'</td>';
                            echo '<td>'.date('m/d/Y',strtotime($open_jobs[$key]['date_of_loss'])).'</td>';
                            //echo '<td>'; echo $job_state; echo'</td>';
                            echo '<td><a href="/reps/assignments/view/?id='.$open_jobs[$key]['id'].'">View</a> | <a href="/reps/assignments/edit/?id='.$open_jobs[$key]['id'].'">Edit</a></td>';
                            echo '</tr>';*/
                        }
                    echo '
                    </tbody>
                </table>
                </div>
                <div id="complete">
                <table class="get_jobs_table">
                    <thead>
                        <tr>
                            <th class="header">File #</th>
                            <!--<th class="{sorter:false}">&nbsp;</th>-->
                            <th class="header">Insured</th>
                            <th class="header" style="width:75px">Date of Loss</th>
                            <th class="header">AR#</th>
                            <th class="header">Submitted</th>
                            <th class="header">Completed</th>
                            <th class="header">Loss Type</th>
                            <th class="header">Rep Name</th>
                            <th class="{sorter:false}" style="width:75px">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach($complete_jobs as $key => $value){
                            //$job_state = accident_translate_job_state($complete_jobs[$key]['ticket_id']);
                            
                            if(count($complete_jobs[$key]['files']) > 0){
                                $attachment_link = '<a href="/reps/assignments/view/?id='.$complete_jobs[$key]['id'].'"><img src="'.get_bloginfo('stylesheet_directory').'/images/paperclip.png" /></a>';
                            } else {
                                $attachment_link = '&nbsp;';
                            }
                            
                            if(empty($complete_jobs[$key]['last_name'])){
                                $complete_jobs[$key]['last_name']='~';
                            }
                            if(empty($complete_jobs[$key]['first_name'])){
                                $complete_jobs[$key]['first_name']='~';
                            }
                            
                            $comm = 0;
                            
                            if(accident_get_new_comments($complete_jobs[$key]['id']) > 0)
                            {
                                //$comm = ' <a href="/reps/assignments/view/?id='.$complete_jobs[$key]['id'].'#comments">['.count($complete_jobs[$key]['comments']).']</a>';
                                $comm = ' <a href="/reps/assignments/view/?id='.$complete_jobs[$key]['id'].'#comments"><div class="comments-icon" style="margin-bottom: -3px;">&nbsp</div></a>';
                            }else{
                                $comm = '';
                            }
                            
                            echo '
                        <tr>
                            <td>'.$complete_jobs[$key]['client_file_id'].$comm.'</td>
                            <!--<td>'.$attachment_link.'</td>-->
                            <td>'.$complete_jobs[$key]['claimant_a_owner_name'].'</td>
                            <td>'.date('m/d/Y',strtotime($complete_jobs[$key]['date_of_loss'])).'</td>
                            <td>'.$complete_jobs[$key]['id'].'</td>
                            <td>'.date('m/d/Y',strtotime($complete_jobs[$key]['ticket']['created_on'])).'</td>
                            <td>'.date('m/d/Y',strtotime($complete_jobs[$key]['ticket']['completed_on'])).'</td>
                            <td>'.$complete_jobs[$key]['job_type'].'</td>
                            <td>'.$complete_jobs[$key]['last_name'].', '.$complete_jobs[$key]['first_name'].'</td>
                            <td>
                                <a href="/reps/assignments/view/?id='.$complete_jobs[$key]['id'].'">View</a>
                            </td>
                        </tr>
                            ';
                            /*
                            echo '<tr>';
                            echo '<td>'.date('m/d/Y',strtotime($complete_jobs[$key]['ticket']['created_on'])).'</td>';
                            echo '<td>'.$complete_jobs[$key]['id'].'</td>';
                            echo '<td>'.$complete_jobs[$key]['client_file_id'].'</td>';
                            echo '<td style="text-align:center;vertical-align:middle;">'.$attachment_link.'</td>';
                            echo '<td>'.$complete_jobs[$key]['last_name'].', '.$complete_jobs[$key]['first_name'].'</td>';
                            echo '<td>'.$complete_jobs[$key]['job_type'].'</td>';
                            echo '<td>'.date('m/d/Y',strtotime($complete_jobs[$key]['date_of_loss'])).'</td>';
                            //echo '<td>'; echo $job_state; echo'</td>';
                            echo '<td><a href="/reps/assignments/view/?id='.$complete_jobs[$key]['id'].'">View</a> | <a href="/reps/assignments/edit/?id='.$complete_jobs[$key]['id'].'">Edit</a></td>';
                            echo '</tr>';*/
                        }
                    echo '
                    </tbody>
                </table>
                </div>
            </div> 
            '; 
            }else{
                $jobs=accident_get_jobs($_SESSION['agent_user_id']);
                
                // $open_jobs = array();
                // $pending_jobs = array();
                // $complete_jobs = array();
                
                // foreach($jobs as &$a_job){
                //     switch(accident_translate_job_state($a_job['ticket_id'])){
                //         case 'Open':
                //             $open_jobs[] = $a_job;
                //             break;
                //         case 'Pending':
                //             $pending_jobs[] = $a_job;
                //             break;
                //         case 'Complete':
                //             $complete_jobs[] = $a_job;
                //             break;
                //     }
                // }
                // if(count($pending_jobs) > 0){
                // echo '
                //     <div id="pending">
                // <table class="get_jobs_table">
                //     <thead>
                //         <tr>
                //             <th class="header">File #</th>
                //             <th class="{sorter:false}">&nbsp;</th>
                //             <th class="header">Insured</th>
                //             <th class="header">Date of Loss</th>
                //             <th class="header">AR#</th>
                //             <th class="header">Submitted</th>
                //             <th class="header">&nbsp</th>
                //             <th class="header">Loss Type</th>
                //             <th class="header">Rep Name</th>
                //             <th class="{sorter:false}">Action</th>
                //         </tr>
                //     </thead>
                //     <tbody>';
                //         foreach($pending_jobs as $key => $value){
                //             //$job_state = accident_translate_job_state($pending_jobs[$key]['ticket_id']);
                            
                //             if(count($pending_jobs[$key]['files']) > 0){
                //                 $attachment_link = '<a href="/reps/assignments/view/?id='.$pending_jobs[$key]['id'].'"><img src="'.get_bloginfo('stylesheet_directory').'/images/paperclip.png" /></a>';
                //             } else {
                //                 $attachment_link = '&nbsp;';
                //             }
                            
                //             if(empty($pending_jobs[$key]['last_name'])){
                //                 $pending_jobs[$key]['last_name']='~';
                //             }
                //             if(empty($pending_jobs[$key]['first_name'])){
                //                 $pending_jobs[$key]['first_name']='~';
                //             }
                            
                //             if(accident_get_new_comments($pending_jobs[$key]['id']) > 0)
                //             {
                //                 //$comm = ' <a href="/reps/assignments/view/?id='.$pending_jobs[$key]['id'].'#comments"><div class="comments-icon">['.count($pending_jobs[$key]['comments']).']</div></a>';
                //                 $comm = ' <a href="/reps/assignments/view/?id='.$pending_jobs[$key]['id'].'#comments"><div class="comments-icon" style="margin-bottom: -3px;">&nbsp</div></a>';
                //             }else{
                //                 $comm = '';
                //             }
                            
                //             echo '
                //         <tr>
                //             <td>'.$pending_jobs[$key]['client_file_id'].'</td>
                //             <td>'.$comm.'</td>
                //             <td>'.$pending_jobs[$key]['claimant_a_owner_name'].'</td>
                //             <td>'.date('m/d/Y',strtotime($pending_jobs[$key]['date_of_loss'])).'</td>
                //             <td>'.$pending_jobs[$key]['id'].'</td>
                //             <td>'.date('m/d/Y',strtotime($pending_jobs[$key]['ticket']['created_on'])).'</td>
                //             <td></td>
                //             <td>'.$pending_jobs[$key]['job_type'].'</td>
                //             <td>'.$pending_jobs[$key]['last_name'].', '.$pending_jobs[$key]['first_name'].'</td>
                //             <td>
                //                 <a href="/reps/assignments/view/?id='.$pending_jobs[$key]['id'].'">View</a> | <a href="/reps/assignments/edit/?id='.$pending_jobs[$key]['id'].'">Edit</a>
                //             </td>
                //         </tr>
                //             ';
                //             /*echo '<tr>';
                //             echo '<td>'.date('m/d/Y',strtotime($pending_jobs[$key]['ticket']['created_on'])).'</td>';
                //             echo '<td>'.$pending_jobs[$key]['id'].'</td>';
                //             echo '<td>'.$pending_jobs[$key]['client_file_id'].'</td>';
                //             echo '<td style="text-align:center;vertical-align:middle;">'.$attachment_link.'</td>';
                //             echo '<td>'.$pending_jobs[$key]['last_name'].', '.$pending_jobs[$key]['first_name'].'</td>';
                //             echo '<td>'.$pending_jobs[$key]['job_type'].'</td>';
                //             echo '<td>'.date('m/d/Y',strtotime($pending_jobs[$key]['date_of_loss'])).'</td>';
                //             //echo '<td>'; echo $job_state; echo'</td>';
                //             echo '<td><a href="/reps/assignments/view/?id='.$pending_jobs[$key]['id'].'">View</a> | <a href="/reps/assignments/edit/?id='.$pending_jobs[$key]['id'].'">Edit</a></td>';
                //             echo '</tr>';*/
                //         }
                //     echo '
                //     </tbody>
                // </table></div>';
                // }
                // echo '
                //     <div id="open">
                // <table class="get_jobs_table">
                //     <thead>
                //         <tr>
                //             <th class="header">File #</th>
                //             <!--<th class="{sorter:false}">&nbsp;</th>-->
                //             <th class="header">Insured</th>
                //             <th class="header">Date of Loss</th>
                //             <th class="header">AR#</th>
                //             <th class="header">Submitted</th>
                //             <th class="header">&nbsp</th>
                //             <th class="header">Loss Type</th>
                //             <th class="header">Rep Name</th>
                //             <th class="{sorter:false}">Action</th>
                //         </tr>
                //     </thead>
                //     <tbody>';
                //         foreach($open_jobs as $key => $value){
                //             //$job_state = accident_translate_job_state($open_jobs[$key]['ticket_id']);
                            
                //             if(count($open_jobs[$key]['files']) > 0){
                //                 $attachment_link = '<a href="/reps/assignments/view/?id='.$open_jobs[$key]['id'].'"><img src="'.get_bloginfo('stylesheet_directory').'/images/paperclip.png" /></a>';
                //             } else {
                //                 $attachment_link = '&nbsp;';
                //             }
                            
                //             if(empty($open_jobs[$key]['last_name'])){
                //                 $open_jobs[$key]['last_name']='~';
                //             }
                //             if(empty($open_jobs[$key]['first_name'])){
                //                 $open_jobs[$key]['first_name']='~';
                //             }
                            
                //             if(accident_get_new_comments($open_jobs[$key]['id']) > 0)
                //             {
                //                 //$comm = ' <a href="/reps/assignments/view/?id='.$open_jobs[$key]['id'].'#comments">['.count($open_jobs[$key]['comments']).']</a>';
                //                 $comm = ' <a href="/reps/assignments/view/?id='.$open_jobs[$key]['id'].'#comments"><div class="comments-icon" style="margin-bottom: -3px;">&nbsp</div></a>';
                //             }else{
                //                 $comm = '';
                //             }
                            
                //             echo '
                //         <tr>
                //             <td>'.$open_jobs[$key]['client_file_id'].$comm.'</td>
                //             <!--<td>'.$attachment_link.'</td>-->
                //             <td>'.$open_jobs[$key]['claimant_a_owner_name'].'</td>
                //             <td>'.date('m/d/Y',strtotime($open_jobs[$key]['date_of_loss'])).'</td>
                //             <td>'.$open_jobs[$key]['id'].'</td>
                //             <td>'.date('m/d/Y',strtotime($open_jobs[$key]['ticket']['created_on'])).'</td>
                //             <td></td>
                //             <td>'.$open_jobs[$key]['job_type'].'</td>
                //             <td>'.$open_jobs[$key]['last_name'].', '.$open_jobs[$key]['first_name'].'</td>
                //             <td>
                //                 <a href="/reps/assignments/view/?id='.$open_jobs[$key]['id'].'">View</a> | <a href="/reps/assignments/edit/?id='.$open_jobs[$key]['id'].'">Edit</a>
                //             </td>
                //         </tr>
                //             ';
                //             /*echo '<tr>';
                //             echo '<td>'.date('m/d/Y',strtotime($open_jobs[$key]['ticket']['created_on'])).'</td>';
                //             echo '<td>'.$open_jobs[$key]['id'].'</td>';
                //             echo '<td>'.$open_jobs[$key]['client_file_id'].'</td>';
                //             echo '<td style="text-align:center;vertical-align:middle;">'.$attachment_link.'</td>';
                //             echo '<td>'.$open_jobs[$key]['last_name'].', '.$open_jobs[$key]['first_name'].'</td>';
                //             echo '<td>'.$open_jobs[$key]['job_type'].'</td>';
                //             echo '<td>'.date('m/d/Y',strtotime($open_jobs[$key]['date_of_loss'])).'</td>';
                //             //echo '<td>'; echo $job_state; echo'</td>';
                //             echo '<td><a href="/reps/assignments/view/?id='.$open_jobs[$key]['id'].'">View</a> | <a href="/reps/assignments/edit/?id='.$open_jobs[$key]['id'].'">Edit</a></td>';
                //             echo '</tr>';*/
                //         }
                //     echo '
                //     </tbody>
                // </table>
                // </div>
                // <div id="complete">
                // <table class="get_jobs_table">
                //     <thead>
                //         <tr>
                //             <th class="header">File #</th>
                //             <!--<th class="{sorter:false}">&nbsp;</th>-->
                //             <th class="header">Insured</th>
                //             <th class="header">Date of Loss</th>
                //             <th class="header">AR#</th>
                //             <th class="header">Submitted</th>
                //             <th class="header">Completed</th>
                //             <th class="header">Loss Type</th>
                //             <th class="header">Rep Name</th>
                //             <th class="{sorter:false}">Action</th>
                //         </tr>
                //     </thead>
                //     <tbody>';
                //         foreach($complete_jobs as $key => $value){
                //             //$job_state = accident_translate_job_state($complete_jobs[$key]['ticket_id']);
                            
                //             if(count($complete_jobs[$key]['files']) > 0){
                //                 $attachment_link = '<a href="/reps/assignments/view/?id='.$complete_jobs[$key]['id'].'"><img src="'.get_bloginfo('stylesheet_directory').'/images/paperclip.png" /></a>';
                //             } else {
                //                 $attachment_link = '&nbsp;';
                //             }
                            
                //             if(empty($complete_jobs[$key]['last_name'])){
                //                 $complete_jobs[$key]['last_name']='~';
                //             }
                //             if(empty($complete_jobs[$key]['first_name'])){
                //                 $complete_jobs[$key]['first_name']='~';
                //             }
                            
                //             $comm = 0;
                            
                //             if(accident_get_new_comments($complete_jobs[$key]['id']) > 0)
                //             {
                //                 //$comm = ' <a href="/reps/assignments/view/?id='.$complete_jobs[$key]['id'].'#comments">['.count($complete_jobs[$key]['comments']).']</a>';
                //                 $comm = ' <a href="/reps/assignments/view/?id='.$complete_jobs[$key]['id'].'#comments"><div class="comments-icon" style="margin-bottom: -3px;">&nbsp</div></a>';
                //             }else{
                //                 $comm = '';
                //             }
                            
                //             echo '
                //         <tr>
                //             <td>'.$complete_jobs[$key]['client_file_id'].$comm.'</td>
                //             <!--<td>'.$attachment_link.'</td>-->
                //             <td>'.$complete_jobs[$key]['claimant_a_owner_name'].'</td>
                //             <td>'.date('m/d/Y',strtotime($complete_jobs[$key]['date_of_loss'])).'</td>
                //             <td>'.$complete_jobs[$key]['id'].'</td>
                //             <td>'.date('m/d/Y',strtotime($complete_jobs[$key]['ticket']['created_on'])).'</td>
                //             <td>'.date('m/d/Y',strtotime($complete_jobs[$key]['ticket']['completed_on'])).'</td>
                //             <td>'.$complete_jobs[$key]['job_type'].'</td>
                //             <td>'.$complete_jobs[$key]['last_name'].', '.$complete_jobs[$key]['first_name'].'</td>
                //             <td>
                //                 <a href="/reps/assignments/view/?id='.$complete_jobs[$key]['id'].'">View</a> | <a href="/reps/assignments/edit/?id='.$complete_jobs[$key]['id'].'">Edit</a>
                //             </td>
                //         </tr>
                //             ';
                //             /*
                //             echo '<tr>';
                //             echo '<td>'.date('m/d/Y',strtotime($complete_jobs[$key]['ticket']['created_on'])).'</td>';
                //             echo '<td>'.$complete_jobs[$key]['id'].'</td>';
                //             echo '<td>'.$complete_jobs[$key]['client_file_id'].'</td>';
                //             echo '<td style="text-align:center;vertical-align:middle;">'.$attachment_link.'</td>';
                //             echo '<td>'.$complete_jobs[$key]['last_name'].', '.$complete_jobs[$key]['first_name'].'</td>';
                //             echo '<td>'.$complete_jobs[$key]['job_type'].'</td>';
                //             echo '<td>'.date('m/d/Y',strtotime($complete_jobs[$key]['date_of_loss'])).'</td>';
                //             //echo '<td>'; echo $job_state; echo'</td>';
                //             echo '<td><a href="/reps/assignments/view/?id='.$complete_jobs[$key]['id'].'">View</a> | <a href="/reps/assignments/edit/?id='.$complete_jobs[$key]['id'].'">Edit</a></td>';
                //             echo '</tr>';*/
                //         }
                //     echo '
                //     </tbody>
                // </table>';

                $open_jobs = array();
                $pending_jobs = array();
                $complete_jobs = array();
                
                foreach($jobs as &$a_job){
                    switch(accident_translate_job_state($a_job['ticket_id'])){
                        case 'Open':
                            $open_jobs[] = $a_job;
                            break;
                        case 'Pending':
                            $pending_jobs[] = $a_job;
                            break;
                        case 'Complete':
                            $complete_jobs[] = $a_job;
                            break;
                    }
                }
                
                if(count($pending_jobs) > 0){
                    echo '
                        <div id="tabs">
                            <ul>
                                <li><a href="#open">OPEN ['.count($open_jobs).']</a></li>
                                <li><a href="#pending">PENDING ['.count($pending_jobs).']</a></li>
                                <li><a href="#complete">COMPLETE ['.count($complete_jobs).']</a></li>
                            </ul>      
                    ';
                }else{
                    echo'
                        <div id="tabs">
                            <ul>
                                <li><a href="#open">OPEN ['.count($open_jobs).']</a></li>
                                <li><a href="#complete">COMPLETE ['.count($complete_jobs).']</a></li>
                            </ul>
                    ';
                }               
                
                if(count($pending_jobs) > 0){
                echo '
                    <div id="pending">
                <table class="get_jobs_table">
                    <thead>
                        <tr>
                            <th class="header">File #</th>
                            <th class="{sorter:false}">&nbsp;</th>
                            <th class="header">Insured</th>
                            <th class="header" style="width:75px">Date of Loss</th>
                            <th class="header">AR#</th>
                            <th class="header">Submitted</th>
                            <th class="header">&nbsp</th>
                            <th class="header">Loss Type</th>
                            <th class="header">Rep Name</th>
                            <th class="{sorter:false}" style="width:75px">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach($pending_jobs as $key => $value){
                            //$job_state = accident_translate_job_state($pending_jobs[$key]['ticket_id']);
                            
                            if(count($pending_jobs[$key]['files']) > 0){
                                $attachment_link = '<a href="/reps/assignments/view/?id='.$pending_jobs[$key]['id'].'"><img src="'.get_bloginfo('stylesheet_directory').'/images/paperclip.png" /></a>';
                            } else {
                                $attachment_link = '&nbsp;';
                            }
                            
                            if(empty($pending_jobs[$key]['last_name'])){
                                $pending_jobs[$key]['last_name']='~';
                            }
                            if(empty($pending_jobs[$key]['first_name'])){
                                $pending_jobs[$key]['first_name']='~';
                            }
                            
                            if(accident_get_new_comments($pending_jobs[$key]['id']) > 0)
                            {
                                //$comm = ' <a href="/reps/assignments/view/?id='.$pending_jobs[$key]['id'].'#comments"><div class="comments-icon">['.count($pending_jobs[$key]['comments']).']</div></a>';
                                $comm = ' <a href="/reps/assignments/view/?id='.$pending_jobs[$key]['id'].'#comments"><div class="comments-icon" style="margin-bottom: -3px;">&nbsp</div></a>';
                                //$comm = accident_get_new_comments($pending_jobs[$key]['id']);
                            }else{
                                //$comm = accident_get_new_comments($pending_jobs[$key]['id']);
                                $comm = '';
                            }
                            
                            echo '
                        <tr>
                            <td>'.$pending_jobs[$key]['client_file_id'].'</td>
                            <td>'.$comm.'</td>
                            <td>'.$pending_jobs[$key]['claimant_a_owner_name'].'</td>
                            <td>'.date('m/d/Y',strtotime($pending_jobs[$key]['date_of_loss'])).'</td>
                            <td>'.$pending_jobs[$key]['id'].'</td>
                            <td>'.date('m/d/Y',strtotime($pending_jobs[$key]['ticket']['created_on'])).'</td>
                            <td></td>
                            <td>'.$pending_jobs[$key]['job_type'].'</td>
                            <td>'.$pending_jobs[$key]['last_name'].', '.$pending_jobs[$key]['first_name'].'</td>
                            <td>
                                <a href="/reps/assignments/view/?id='.$pending_jobs[$key]['id'].'">View</a> | <a href="/reps/assignments/edit/?id='.$pending_jobs[$key]['id'].'">Edit</a>
                            </td>
                        </tr>
                            ';
                            /*echo '<tr>';
                            echo '<td>'.date('m/d/Y',strtotime($pending_jobs[$key]['ticket']['created_on'])).'</td>';
                            echo '<td>'.$pending_jobs[$key]['id'].'</td>';
                            echo '<td>'.$pending_jobs[$key]['client_file_id'].'</td>';
                            echo '<td style="text-align:center;vertical-align:middle;">'.$attachment_link.'</td>';
                            echo '<td>'.$pending_jobs[$key]['last_name'].', '.$pending_jobs[$key]['first_name'].'</td>';
                            echo '<td>'.$pending_jobs[$key]['job_type'].'</td>';
                            echo '<td>'.date('m/d/Y',strtotime($pending_jobs[$key]['date_of_loss'])).'</td>';
                            //echo '<td>'; echo $job_state; echo'</td>';
                            echo '<td><a href="/reps/assignments/view/?id='.$pending_jobs[$key]['id'].'">View</a> | <a href="/reps/assignments/edit/?id='.$pending_jobs[$key]['id'].'">Edit</a></td>';
                            echo '</tr>';*/
                        }
                    echo '
                    </tbody>
                </table></div>';
                }
                echo '
                    <div id="open">
                <table class="get_jobs_table">
                    <thead>
                        <tr>
                            <th class="header">File #</th>
                            <!--<th class="{sorter:false}">&nbsp;</th>-->
                            <th class="header">Insured</th>
                            <th class="header" style="width:75px">Date of Loss</th>
                            <th class="header">AR#</th>
                            <th class="header">Submitted</th>
                            <th class="header">&nbsp</th>
                            <th class="header">Loss Type</th>
                            <th class="header">Rep Name</th>
                            <th class="{sorter:false}" style="width:75px">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach($open_jobs as $key => $value){
                            //$job_state = accident_translate_job_state($open_jobs[$key]['ticket_id']);
                            
                            if(count($open_jobs[$key]['files']) > 0){
                                $attachment_link = '<a href="/reps/assignments/view/?id='.$open_jobs[$key]['id'].'"><img src="'.get_bloginfo('stylesheet_directory').'/images/paperclip.png" /></a>';
                            } else {
                                $attachment_link = '&nbsp;';
                            }
                            
                            if(empty($open_jobs[$key]['last_name'])){
                                $open_jobs[$key]['last_name']='~';
                            }
                            if(empty($open_jobs[$key]['first_name'])){
                                $open_jobs[$key]['first_name']='~';
                            }
                            
                            if(accident_get_new_comments($open_jobs[$key]['id']) > 0)
                            {
                                //$comm = ' <a href="/reps/assignments/view/?id='.$open_jobs[$key]['id'].'#comments">['.count($open_jobs[$key]['comments']).']</a>';
                                $comm = ' <a href="/reps/assignments/view/?id='.$open_jobs[$key]['id'].'#comments"><div class="comments-icon" style="margin-bottom: -3px;">&nbsp</div></a>';
                            }else{
                                $comm = '';
                            }
                            
                            echo '
                        <tr>
                            <td>'.$open_jobs[$key]['client_file_id'].$comm.'</td>
                            <!--<td>'.$attachment_link.'</td>-->
                            <td>'.$open_jobs[$key]['claimant_a_owner_name'].'</td>
                            <td>'.date('m/d/Y',strtotime($open_jobs[$key]['date_of_loss'])).'</td>
                            <td>'.$open_jobs[$key]['id'].'</td>
                            <td>'.date('m/d/Y',strtotime($open_jobs[$key]['ticket']['created_on'])).'</td>
                            <td></td>
                            <td>'.$open_jobs[$key]['job_type'].'</td>
                            <td>'.$open_jobs[$key]['last_name'].', '.$open_jobs[$key]['first_name'].'</td>
                            <td>
                                <a href="/reps/assignments/view/?id='.$open_jobs[$key]['id'].'">View</a> | <a href="/reps/assignments/edit/?id='.$open_jobs[$key]['id'].'">Edit</a>
                            </td>
                        </tr>
                            ';
                            /*echo '<tr>';
                            echo '<td>'.date('m/d/Y',strtotime($open_jobs[$key]['ticket']['created_on'])).'</td>';
                            echo '<td>'.$open_jobs[$key]['id'].'</td>';
                            echo '<td>'.$open_jobs[$key]['client_file_id'].'</td>';
                            echo '<td style="text-align:center;vertical-align:middle;">'.$attachment_link.'</td>';
                            echo '<td>'.$open_jobs[$key]['last_name'].', '.$open_jobs[$key]['first_name'].'</td>';
                            echo '<td>'.$open_jobs[$key]['job_type'].'</td>';
                            echo '<td>'.date('m/d/Y',strtotime($open_jobs[$key]['date_of_loss'])).'</td>';
                            //echo '<td>'; echo $job_state; echo'</td>';
                            echo '<td><a href="/reps/assignments/view/?id='.$open_jobs[$key]['id'].'">View</a> | <a href="/reps/assignments/edit/?id='.$open_jobs[$key]['id'].'">Edit</a></td>';
                            echo '</tr>';*/
                        }
                    echo '
                    </tbody>
                </table>
                </div>
                <div id="complete">
                <table class="get_jobs_table">
                    <thead>
                        <tr>
                            <th class="header">File #</th>
                            <!--<th class="{sorter:false}">&nbsp;</th>-->
                            <th class="header">Insured</th>
                            <th class="header" style="width:75px">Date of Loss</th>
                            <th class="header">AR#</th>
                            <th class="header">Submitted</th>
                            <th class="header">Completed</th>
                            <th class="header">Loss Type</th>
                            <th class="header" style="width:75px">Rep Name</th>
                            <th class="{sorter:false}">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach($complete_jobs as $key => $value){
                            //$job_state = accident_translate_job_state($complete_jobs[$key]['ticket_id']);
                            
                            if(count($complete_jobs[$key]['files']) > 0){
                                $attachment_link = '<a href="/reps/assignments/view/?id='.$complete_jobs[$key]['id'].'"><img src="'.get_bloginfo('stylesheet_directory').'/images/paperclip.png" /></a>';
                            } else {
                                $attachment_link = '&nbsp;';
                            }
                            
                            if(empty($complete_jobs[$key]['last_name'])){
                                $complete_jobs[$key]['last_name']='~';
                            }
                            if(empty($complete_jobs[$key]['first_name'])){
                                $complete_jobs[$key]['first_name']='~';
                            }
                            
                            $comm = 0;
                            
                            if(accident_get_new_comments($complete_jobs[$key]['id']) > 0)
                            {
                                //$comm = ' <a href="/reps/assignments/view/?id='.$complete_jobs[$key]['id'].'#comments">['.count($complete_jobs[$key]['comments']).']</a>';
                                $comm = ' <a href="/reps/assignments/view/?id='.$complete_jobs[$key]['id'].'#comments"><div class="comments-icon" style="margin-bottom: -3px;">&nbsp</div></a>';
                            }else{
                                $comm = '';
                            }
                            
                            echo '
                        <tr>
                            <td>'.$complete_jobs[$key]['client_file_id'].$comm.'</td>
                            <!--<td>'.$attachment_link.'</td>-->
                            <td>'.$complete_jobs[$key]['claimant_a_owner_name'].'</td>
                            <td>'.date('m/d/Y',strtotime($complete_jobs[$key]['date_of_loss'])).'</td>
                            <td>'.$complete_jobs[$key]['id'].'</td>
                            <td>'.date('m/d/Y',strtotime($complete_jobs[$key]['ticket']['created_on'])).'</td>
                            <td>'.date('m/d/Y',strtotime($complete_jobs[$key]['ticket']['completed_on'])).'</td>
                            <td>'.$complete_jobs[$key]['job_type'].'</td>
                            <td>'.$complete_jobs[$key]['last_name'].', '.$complete_jobs[$key]['first_name'].'</td>
                            <td>
                                <a href="/reps/assignments/view/?id='.$complete_jobs[$key]['id'].'">View</a>
                            </td>
                        </tr>
                            ';
                            /*
                            echo '<tr>';
                            echo '<td>'.date('m/d/Y',strtotime($complete_jobs[$key]['ticket']['created_on'])).'</td>';
                            echo '<td>'.$complete_jobs[$key]['id'].'</td>';
                            echo '<td>'.$complete_jobs[$key]['client_file_id'].'</td>';
                            echo '<td style="text-align:center;vertical-align:middle;">'.$attachment_link.'</td>';
                            echo '<td>'.$complete_jobs[$key]['last_name'].', '.$complete_jobs[$key]['first_name'].'</td>';
                            echo '<td>'.$complete_jobs[$key]['job_type'].'</td>';
                            echo '<td>'.date('m/d/Y',strtotime($complete_jobs[$key]['date_of_loss'])).'</td>';
                            //echo '<td>'; echo $job_state; echo'</td>';
                            echo '<td><a href="/reps/assignments/view/?id='.$complete_jobs[$key]['id'].'">View</a> | <a href="/reps/assignments/edit/?id='.$complete_jobs[$key]['id'].'">Edit</a></td>';
                            echo '</tr>';*/
                        }
                    echo '
                    </tbody>
                </table>
                </div>
            </div> 
            '; 
                
            }
            break; 
    }
    echo '</div>';
}

?>
