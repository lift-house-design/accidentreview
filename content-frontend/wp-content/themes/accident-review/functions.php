<?

if(!defined(ADMIN_ROLE)) define(ADMIN_ROLE,'1');
if(!defined(AGENT_ADMIN_ROLE)) define(AGENT_ADMIN_ROLE,'8');
if(!defined(AGENT_USER_ROLE)) define(AGENT_USER_ROLE,'9');
if(!defined(AGENT_GENERAL_ROLE)) define(AGENT_GENERAL_ROLE,'11');
if(!defined(AC_BACKEND_ADDRESS)) define(AC_BACKEND_ADDRESS,'http://backend.accidentreview.com/');

include('custom/shortcodes.php');
include('custom/ajax.php');
include('custom/vin-functions.php');
include('custom/agent-login-form.php');
include('custom/ac-user-functions.php');
include('custom/ac-email-functions.php');
include('custom/ac-job-functions.php');

?>
