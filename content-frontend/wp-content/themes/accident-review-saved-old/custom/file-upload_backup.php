<?

session_id($_POST['session_id']);
session_start();

$log = fopen($_SERVER['DOCUMENT_ROOT'].'/upload-log.log','a');
fwrite($log,'--------------------------------------------------------------------'."\n");
$dbh = mysql_connect('localhost','accident_dev','accident_dev',true) or fwrite($log,'Could not connect to mysql -> '.mysql_error());
mysql_select_db('accident_dev',$dbh) or fwrite($log,'Could not select DB');
fwrite($log,'Past Setup DB'."\n".'SUPER GLOBALS: '.print_r($_FILES,true)."\n".print_r($_POST,true)."\n");
fwrite($log,'Session: '.print_r($_SESSION,true));

if(isset($_POST['delete_action'])){
    fwrite($log,'Deleting an Uploaded File');
    $del_s = 'DELETE FROM acx_attachments WHERE name=\''.$_POST['name'].'\' AND parent_id=\''.$_POST['job_id'].'\'';
    $del_q = mysql_query($del_s,$dbh);
} else {
    if (!empty($_FILES)) {
    	$tempPath = $_FILES['Filedata']['tmp_name'];
        $tempSize = $_FILES['Filedata']['size'];
        $tempType = $_FILES['Filedata']['type'];
        $tempName = $_FILES['Filedata']['name'];
        
        $hashName = sha1($tempName.microtime());
        
        $targetPath = dirname($_SERVER['DOCUMENT_ROOT']).'/content-backend/upload/'.$hashName;
        
        fwrite($log,"\n".'File Information: '."\n".'Temp Path: '.$tempPath."\n".'Size: '.$tempSize."\n".'Mime: '.$tempType."\n".'Name: '.$tempName."\n".'Hash: '.$hashName."\n".'Final: '.$targetPath."\n");
        
        $parent_id = $_POST['job_id'];
        
        $ticket_find_s = 'SELECT ticket_id FROM job WHERE id=\''.$_POST['job_id'].'\'';
        $ticket_find_q = mysql_query($ticket_find_s,$dbh);
        if($ticket_find_q  !== false && count($ticket_find_q) > 0){
            $ticket_row = mysql_fetch_assoc($ticket_find_q);
            $parent_id = $ticket_row['ticket_id'];
        }
       
        
        if(move_uploaded_file($tempPath,$targetPath) !== false){
            $ins_s = '
            INSERT INTO acx_attachments 
                (`parent_id`,`parent_type`,`name`,`mime_type`,`size`,`location`,
                `attachment_type`,`created_on`,`created_by_id`,`created_by_name`,
                `created_by_email`) 
            VALUES 
                (\''.$parent_id.'\',\'ticket\',\''.$tempName.'\',\''.$tempType.'\',\''.$tempSize.'\',\''.$hashName.'\',
                \'attachment\',\''.date('Y-m-d H:i:s').'\',\''.$_SESSION['agent_user_id'].'\',\''.$_SESSION['agent_user_name'].'\',
                \''.$_SESSION['agent_user_data']['email'].'\')';
           //echo '<p>'.$ins_s.'</p>';
            $ins_q = mysql_query($ins_s,$dbh);
            if($ins_q === false) {
                
            }
            echo mysql_insert_id($dbh).':/files/'.$hashName;
           
        } else {
            echo 0;
        }
    }
}

fwrite($log,'--------------------------------------------------------------------'."\n");
fclose($log);

?>