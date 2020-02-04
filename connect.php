<?php
/* 	*
	* Title: connect.php
	* Created by: Miftah Hadi S
	* Contact: miftahhadi@gmail.com
	* Last modified: 12-04-2019
	*
	* This script is for connecting to the database
	* We use PDO, uh yeah
  *
*/

// ********************************** //
// ************ VARIABLES ************ //
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'tadreeb';

// ************ VARIABLES ************ //
// ********************************** //

// Make PDO instance
try {
	$db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo "Uh, gagal nyambung ke database, Bung!\n";
	echo $e->getMessage();
}
