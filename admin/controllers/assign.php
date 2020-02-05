<?php
// Panggil array objek assign
include __DIR__ . '/../../includes/AssignObject.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Kalau gak ada item yang dipilih, balik langsung
  if (!isset($_POST['ID'])) {
    header('Location: index.php?' . $_POST['backUrl']);
    exit();
  }

  // Set kolom tabel
  $kolomParent = $_POST['parent'] . '_id';
  $kolomItem = $_POST['item'] . '_id';

  // Set placeholder
  $parentId = $_POST['parent'] . 'Id';
  $itemId = $_POST['item'] . 'Id';

  // Buat query
  $query = 'INSERT INTO ' . $_POST['insertTable'] . ' (' . $kolomParent . ', ' . $kolomItem . ') VALUES (:' . $parentId . ', :' . $itemId . ')';
  // Prepare the statement
  $assign = $db->prepare($query);

  // Untuk tiap item, eksekusi query
  foreach ($_POST['ID'] as $id) {

    $assign->execute([$parentId => $_POST['parentId'], $itemId => $id]);

  }

  // Kalau berhasil, kembali ke halaman sebelumnya
  if ($assign->rowCount() > 0) {
    header('Location: index.php?' . $_POST['backUrl'] );
  }
}

// Apa yang akan ditambah?
$objek = $_GET['assign'];

$title = 'Tambah ' . ucfirst($objek);

$pageTemplate = 'assign.html.php';

if ($_GET['assign'] == 'kuis') {
  $tambahHref = 'index.php?page=kuis&action=tambah';
} elseif ($_GET['assign'] == 'soal') {
  $tambahHref = 'index.php?page=kuis&action=build&id=' . $_GET['id'];
} elseif($_GET['assign'] == 'user') {
  $tambahHref = 'index.php?page=user&action=tambah';
} elseif($_GET['assign'] == 'pelajaran') {
  $tambahHref = 'index.php?page=pelajaran&action=tambah';
} else {
  $tambahHref = 'index.php?page=upload&objek=' . $objeks[$objek]['jenis'] . '&pelajaranId=' . $_GET['id'] . '&sectionId=' . $_GET['sectionId'];
}


//////////// PAGINATION ////////////
// Get the total number of rows
$calcRows = 'SELECT COUNT(*) FROM ' . $objeks[$objek]['table'] . ' WHERE ' . $objeks[$objek]['where'] . $objeks[$objek]['and'];

$totalRows = runQuery($db, $calcRows, [$placeholder => $_GET['id']])->fetch()[0];

// Check if the number of page is specified and check if it's a number, if not, return a default value
$paged = isset($_GET['paged']) && is_numeric($_GET['paged']) ? intval($_GET['paged']) : 1;

// Number of results shown on each page
$resultOnPage = 50;

// Calculate the page to get the result we need from the table
$calcPage = ($paged - 1) * $resultOnPage;

// Ambil semua item
$query = 'SELECT * FROM ' . $objeks[$objek]['table'] . ' WHERE ' . $objeks[$objek]['where'] . $objeks[$objek]['and'] . ' ORDER BY ' . $objeks[$objek]['primaryKey'] . ' DESC LIMIT :offset, :number';

$daftarItem = runQuery($db, $query, [$placeholder => $_GET['id'], 'offset' => $calcPage, 'number' => $resultOnPage])->fetchAll();
$itemId = $objeks[$objek]['primaryKey'];
//////////// PAGINATION ////////////
