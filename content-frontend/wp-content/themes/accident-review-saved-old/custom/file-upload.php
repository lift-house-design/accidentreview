<?

session_start();

$log = fopen($_SERVER['DOCUMENT_ROOT'].'/upload-log.log','a');
fwrite($log,'--------------------------------------------------------------------'."\n");
$dbh = mysql_connect('localhost','accidentreview','D4gGH#2$nMV',true) or fwrite($log,'Could not connect to mysql -> '.mysql_error());
mysql_select_db('accidentreviewdb',$dbh) or fwrite($log,'Could not select DB');
fwrite($log,'Past Setup DB'."\n".'SUPER GLOBALS: '.print_r($_FILES,true)."\n".print_r($_POST,true)."\n");
fwrite($log,'Session: '.print_r($_SESSION,true));

if(isset($_POST['delete_action'])){
    fwrite($log,'Deleting an Uploaded File');
    $del_s = 'DELETE FROM acx_attachments WHERE name=\''.$_POST['name'].'\' AND parent_id=\''.$_POST['job_id'].'\'';
    $del_q = mysql_query($del_s,$dbh);
} else {

    $output['talkback'] = array();
            
    $year = date('Y');
    $month = date('m');

    $output['talkback']['name'] = $name = $_REQUEST['name'];
    $output['talkback']['basename'] = $basename = substr($name,0,strrpos($name,'.'));
    $output['talkback']['extension'] = $extension = substr($name,strrpos($name,'.')+1);
    //$output['talkback']['slug'] = $post_slug = create_unique_slug($basename);
    
    $hashName = sha1($name.microtime());

    $output['talkback']['target'] = $target = dirname($_SERVER['DOCUMENT_ROOT']).'/content-backend/upload/'.$hashName;

    $out = fopen($target,'w');
    
    if ($out) {
    	$in = fopen("php://input", "rb");

        if ($in) {
                while ($buff = fread($in, 4096))
                        fwrite($out, $buff);
        } 

        fclose($in);
        fclose($out);

        $actual_file_path = $target; //$_SERVER['DOCUMENT_ROOT'].'/content-backend/upload/'.$year.'/'.$month.'/'.$post_slug.'.'.$extension;
        $guid_path = str_replace($_SERVER['DOCUMENT_ROOT'],'',$actual_file_path);
        //$file_resource = finfo_open(FILEINFO_MIME,'/usr/share/misc/magic');
        /*
         * test, deprecated
         * $mime_type = mime_content_type($actual_file_path);
         */
        $file_resource = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($file_resource,$actual_file_path);
        
        $tempName = $name;
        $tempSize = filesize($actual_file_path);
        $tempType = filetype($actual_file_path);
        
        
        fwrite($log,"\n".'File Information: '."\n".'Temp Path: '.$tempPath."\n".'Size: '.$tempSize."\n".'Mime: '.$tempType."\n".'Name: '.$tempName."\n".'Hash: '.$hashName."\n".'Final: '.$actual_file_path."\n");
        
        $parent_id = $_SESSION['job_id'];
        
        $ticket_find_s = 'SELECT ticket_id FROM job WHERE id=\''.$parent_id.'\'';
        $ticket_find_q = mysql_query($ticket_find_s,$dbh);
        if($ticket_find_q  !== false && count($ticket_find_q) > 0){
            $ticket_row = mysql_fetch_assoc($ticket_find_q);
            $parent_id = $ticket_row['ticket_id'];
        }
        
        if(file_exists($actual_file_path) !== false){
            $ins_s = '
            INSERT INTO acx_attachments 
                (`parent_id`,`parent_type`,`name`,`mime_type`,`size`,`location`,
                `attachment_type`,`created_on`,`created_by_id`,`created_by_name`,
                `created_by_email`) 
            VALUES 
                (\''.$parent_id.'\',\'ticket\',\''.$tempName.'\',\''.$mime_type.'\',\''.$tempSize.'\',\''.$hashName.'\',
                \'attachment\',\''.date('Y-m-d H:i:s').'\',\''.$_SESSION['agent_user_id'].'\',\''.$_SESSION['agent_user_name'].'\',
                \''.$_SESSION['agent_user_data']['email'].'\')';
           //echo '<p>'.$ins_s.'</p>';
            $ins_q = mysql_query($ins_s,$dbh);
            if($ins_q !== false) {
                $sel_s = 'SELECT id FROM acx_attachments WHERE location=\''.$hashName.'\';';
                fwrite($log,'attempting query: '.$sel_s."\n");
                $sel_q = mysql_query($sel_s,$dbh);
                if($sel_q !== false && count($sel_q) >= 0 ){
                    $found_id = mysql_fetch_assoc($sel_q);
                    $file_id = implode(',',$found_id);
                    array_push($_SESSION['files_list'], $file_id);
                    $filelist = implode(',',$_SESSION['files_list']);
                    fwrite($log,'File list: '.$filelist."\n");
                }else{
                    fwrite($log,'query fails.'."\n");
                }
                
               
                
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
