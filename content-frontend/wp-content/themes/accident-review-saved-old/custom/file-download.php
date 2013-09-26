<?

/** The name of the database for WordPress */
define('DB_NAME', 'accidentreviewdb');

/** MySQL database username */
define('DB_USER', 'accidentreview');

/** MySQL database password */
define('DB_PASSWORD', 'D4gGH#2$nMV');

/** MySQL hostname */
define('DB_HOST', 'localhost');

$dbh = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD,true);
mysql_select_db(DB_NAME,$dbh);

$file_id = $_GET['id'];

$file_location = dirname($_SERVER['DOCUMENT_ROOT']).'/content-backend/upload/'.$file_id;

// die($file_location);

$find_s = 'SELECT * FROM acx_attachments WHERE location=\''.$file_id.'\'';
$find_q = mysql_query($find_s,$dbh);


if($find_q && mysql_num_rows($find_q) > 0){
    $file_row = mysql_fetch_assoc($find_q);
    header('Content-Type: '.$file_row['mime_type']);
    header('Content-Length: '.filesize($file_location).";\n");
    header('Content-Disposition:attachment;filename="'.$file_row['name'].'"');
    readfile($file_location);
}


exit;


?>