<?php
//define the locator
define('LOCATOR', '..');
// Load the config file first as it contains default config and starts session
// The files are in parent directory
require_once __DIR__ . '/../includes/config.inc.php';

// Connect to the database
include LOCATOR . '/connect.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

// Load the templatefunctions
include __DIR__ . '/../includes/TemplateFunctions.php';

// Load the navigation menu array
include __DIR__ . '/../includes/NavArray.php';

// Mode navigasi dan check privilege user
$area = 'admin';

// Cek user punya akses ke halaman admin atau tidak
checkUser($area, 'admin');

// Load the router
include __DIR__ . '/router.php';

// Output buffering
ob_start();

include __DIR__ .'/../templates/' . $pageTemplate;

$output = ob_get_clean();

// load the template
include __DIR__ . '/../templates/layout.html.php';

?>
