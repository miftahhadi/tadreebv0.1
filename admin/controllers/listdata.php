<?php
// Set data array
include __DIR__ . '/../../includes/PageData.php';

// Set judul halaman
define('PAGE_TITLE', $pageData[$page]['title']);


///////// PAGINATION /////////
// Get the total number of rows in our database
$calcRows = 'SELECT COUNT(*) FROM ' . $pageData[$page]['table'];
$totalRows = runQuery($db, $calcRows)->fetch()[0];

// Check if the number of page is specified and check if it's a number, if not, return a default value
$paged = isset($_GET['paged']) && is_numeric($_GET['paged']) ? intval($_GET['paged']) : 1;

// Number of results shown on each page
$resultOnPage = 50;

// Calculate the page to get the result we need from the table
$calcPage = ($paged - 1) * $resultOnPage;

// Get the record from the database
$query = 'SELECT * FROM ' . $pageData[$page]['table'] . ' ORDER BY ' . $pageData[$page]['primaryKey'] . ' DESC LIMIT :offset, :number';
$listData = runQuery($db, $query, ['offset' => $calcPage, 'number' => $resultOnPage]);
/////// END PAGINATION ///////

// Set kolom data yang ada di database
$dataColumns = $pageData[$page]['columns'];

$pageTemplate = 'listdata.html.php';
