<?php
/* 	*
	* Title: config.inc.php
	* Created by: Miftah Hadi S
	* Contact: miftahhadi@gmail.com
	* Last modified: 12-04-2019
	*
	* Configuration file does the following things:
	* - Has site settings in one location.
	* - Stores URLs and URIs as constants.
	* - Starts the session.
	* - Sets how errors will be handled.
	* - Defines a redirection function.
	*
*/

// ********************************** //
// ************ SETTINGS ************ //

// Are we live?
// False for development mode
// $live = false;

// Errors are emailed here:
$contact_email = 'miftahhadi@gmail.com';

// ************ SETTINGS ************ //
// ********************************** //

// ********************************** //
// ************ CONSTANTS *********** //

// Determine location of files and the URL of the site:
define('BASE_URI', '/home/vagrant/Code/Project/public');
define('BASE_URL', '/tadreeb');
//define('MYSQL', BASE_URI . '/connect.php');
define('SITE_NAME', 'Tadreeb');
define('UPLOAD_FOLDER', LOCATOR . '/upload');
// ************ CONSTANTS *********** //
// ********************************** //

// ********************************* //
// ************ SESSIONS *********** //

// Start the session:
session_start();

// ************ SESSIONS *********** //
// ********************************* //

// ****************************************** //
// ************ ERROR MANAGEMENT ************ //

// Function for handling errors.
// Takes five arguments: error number, error message (string), name of the file where the error occurred (string)
// line number where the error occurred, and the variables that existed at the time (array).
// Returns true.
function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars){
	// Need these two
	global $live, $contact_email;

	// Build the error message:
	$message = "Ugh, ada error, Bung! Periksa script '$e_file' on line $e_line:\n$e_message\n";

	// Add the backtrace:
	$message .="<pre>" . print_r(debug_backtrace(),1) . "</pre>\n";

	// Or just append $e_vars to the message:
	//	$message .= "<pre>" . print_r ($e_vars, 1) . "</pre>\n";

	if (!$live) { // Show the error in the browser.

		echo '<div class="error">' . nl2br($message) . '</div>';

	} else { // Development (print the error).

		// Log the error message:
		error_log($message,3,'./error.txt');

		// Only print an error message in the browser, if the error isn't a notice:
		if ($e_number != E_NOTICE) {
			echo '<div class="error">A system error occured. We apologize for the inconvenience.</div>';
		}
	} // End of $live If-Else

	return true; // So that PHP doesn't try to handle the error too

} // End of my_error_handler function

set_error_handler('my_error_handler');

// Redirect invalid user
function checkUser($area, $route) {

	// Jika session expired, tapi cookie masih ada, ambil data dari cookie
	if (!isset($_SESSION['user_id']) && isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
		$_SESSION['user_id'] = $_COOKIE['user_id'];
		$_SESSION['username'] = $_COOKIE['username'];
		$_SESSION['password'] = $_COOKIE['password'];
		$_SESSION['nama'] = $_COOKIE['nama'];
		$_SESSION['role'] = $_COOKIE['role'];
	}

	// Kalau session belum expired, cek apakah user boleh masuk area
	if (isset($_SESSION['user_id'])) {

		if ($_SESSION['role'] != 'Administrator' && $area == 'admin') {

			header('Location: ' . LOCATOR . '/index.php?page=forbidden');

		}

	} elseif (!isset($_SESSION['user_id']) && $route !='login') { // User belum login, bawa ke halaman login

		header('Location: ' . LOCATOR . '/index.php?page=login');

	}

}
