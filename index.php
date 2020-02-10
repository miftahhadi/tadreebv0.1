<?php
// define the locator
define('LOCATOR', '.');

// Load the config file first as it contains default config and starts session
// The files are in parent directory
require_once __DIR__ . '/includes/config.inc.php';

// Connect to the database
include LOCATOR . '/connect.php';
include __DIR__ . '/includes/DatabaseFunctions.php';

// Load template functions
include __DIR__ . '/includes/TemplateFunctions.php';

// Load the navigation menu array
include __DIR__ . '/includes/NavArray.php';

// Set the url
//$route = rtrim(ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/tadreeb/'),'/');
$page = $_GET['page'] ?? 'index';

// Variable $area untuk menu navigasi dan cek privileged user
$area = 'front';

// Cek user sudah login atau belum
checkUser($area, $page);

if ($page == 'login') {

  include __DIR__ . '/login.php';
  exit();

} elseif ($page == 'pelajaran') {

  include __DIR__ . '/controllers/pelajaran.php';

} elseif ($page == 'logout') {

  include __DIR__ . '/logout.php';
  exit();

} elseif ($page == 'forbidden') {

  include __DIR__ . '/forbidden.php';
  exit();

} elseif ($page == 'profil') {

  include __DIR__ . '/controllers/profil.php';

} elseif ($page == 'ubah-password') {

  include __DIR__ . '/controllers/ubah-password.php';

} elseif ($page == 'kuis-submit') {

  include __DIR__ . '/controllers/kuis-submit.php';

} elseif ($page == 'index') {

  include __DIR__  . '/controllers/home.php';

  $pageTemplate = 'home.html.php';

}

// Set judul halaman
define('PAGE_TITLE' , $pageTitle);

// Load halaman
ob_start();

include __DIR__ . '/templates/' . $pageTemplate;

$output = ob_get_clean();

// load the template
include __DIR__ . '/templates/layout.html.php';

 ?>
