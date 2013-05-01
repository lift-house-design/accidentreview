<?
/**
 * Main Information Request Form
 *
 */
wp_enqueue_script('javascript', get_bloginfo('stylesheet_directory').'/js/accident-review.js');

global $wpdb;
$wpdb->show_errors();

$main_project_id = 3;

$required_values = array(
    'date_of_loss' => 'Please specify the Date of Loss',
    'loss_description' => 'Please describe the loss',
    'services_requested' => 'Please describe the services requested',
    'job_type'           => 'Please select a service type.',
    'agree_terms'        => 'You must agree to the Terms of Service'   
);

$continue = false;
$error = false;
$errors = array();

if($_POST){
    foreach($required_values as $var_name=>$message){
        if(!isset($_POST[''.$var_name]) || $_POST[''.$var_name] == ''){
            $error = true;
            $errors[] = $message;
        }
    }
    
    if(!$error){
       
        $status = accident_process_agent_request_form((isset($_GET['id']))?$_GET['id'] : 0);        
        if($status !== false){
            if(isset($_GET['id']) && $_GET['id'] != 0 && $_GET['id'] != '') {$the_id = $_GET['id'];}
            else if(isset($_POST['job_id']) && $_POST['job_id'] != 0 && $_POST['job_id'] != '') {$the_id = $_POST['job_id'];}            
            if(isset($_SESSION['job_id']) && $_SESSION['job_id'] != 0 && $_SESSION['job_id'] != '') {$the_id = $_SESSION['job_id'];}
            ?>
            <h5>Job Submitted Successfully!</h5>
            <a class="button" style="margin-left:00px; margin-top:16px;" href="/reps/assignments/view/?id=<? echo $the_id; ?>">View Assignment »</a>
            <a class="button" style="margin-left:00px; margin-top:16px;" href="/reps/assignments/edit/?id=<? echo $the_id; ?>">Edit Assignment »</a>
            <a class="button" style="margin-left:00px; margin-top:16px;" href="/reps/assignments">All Assignments »</a>
            <?
            $continue = true;
        }
        
    } else {
        ?>
        <div class="error-message">
            <?
            foreach($errors as $a_message):
            ?>
            <p><?=$a_message?></p>
            <?
            endforeach;
            ?>
        </div>
        <?   
    }
}

if($continue){
    /**
     * Display success message, take user to new screen, do something!
     */
     
     
     
    return;
} else {
    $job_id = 0;
    if(isset($_GET['id'])) $job_id = $_GET['id'];
    else if (isset($_POST['job_id'])) $job_id = $_POST['job_id'];

    echo accident_main_form($job_id);
}
?>
