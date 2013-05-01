<?php
  define('ROOT', dirname(dirname(__FILE__)).'/activecollab');//'/var/www/vhosts/accident-review/content-backend/activecollab');
  define('PUBLIC_FOLDER_NAME', 'public'); 
  define('DB_HOST', 'localhost'); 
  define('DB_USER', 'accidentreview'); 
  define('DB_PASS', 'D4gGH#2$nMV'); 
  define('DB_NAME', 'accidentreviewdb'); 
  define('DB_CAN_TRANSACT', true); 
  define('TABLE_PREFIX', 'acx_'); 
  define('ROOT_URL', 'http://'.$_SERVER['HTTP_HOST'].'/public');//'http://backend.accident-review.hollisint.com/public'); 
  define('PATH_INFO_THROUGH_QUERY_STRING', true); 
  define('FORCE_QUERY_STRING', true); 
  define('LOCALIZATION_ENABLED', true); 
  define('ADMIN_EMAIL', 'hosting@hollisinteractive.com'); 
  define('DEBUG', 1); 
  define('API_STATUS', 1); 
  define('PROTECT_SCHEDULED_TASKS', true); 
  define('DB_CHARSET', 'utf8'); 
  define('RESIZE_SMALLER_THAN', 4194304);

  require_once 'defaults.php';
  require_once 'license.php';
?>
