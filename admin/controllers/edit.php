<?php
// Set data array
include __DIR__ . '/../../includes/PageData.php';

// Kalau ada kiriman data lewat $_POST, eksekusi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Set array data yang akan diinput ke database
  $input = $_POST['data'];

  // Kalau buat pelajaran baru, set tanggal pelajaran dibuat
  if ($page == 'pelajaran') {
    $input['tanggal_dibuat'] =  new DateTime;
  }

  if ($page == 'section') {
    $input['pelajaran_id'] = $_GET['pelajaranId'];
  }

  if (isset($_POST['simpanBaru'])) {

    $insert = insert($db, $pageData[$page]['insertTable'], $input);

  } elseif (isset($_POST['simpanEdit'])) {

    $insert = update($db, $pageData[$page]['insertTable'], $input, $pageData[$page]['primaryKey'], $_POST['id']);

  }

  if ($page == 'section') {

    $location = 'index.php?page=pelajaran&action=build&id=' . $_GET['pelajaranId'];

  } else {
    $location = 'index.php?page=' . $page;
  }

  if ($insert->rowCount() == 1) {
    header('Location: ' . $location);
    exit();
  }

}

// Set judul halaman
$title = 'Tambah ' . ucfirst($page);

// Set tombol submit
$submit = 'simpanBaru';

// Kalau page == pelajaran atau kelas, ambil data kategori/angkatannya
if ($page == 'pelajaran' || $page == 'kelas') {
  $dataParent = $pageData[$page]['parent'] . '_id';

  // Ambil semua data kategori/kelas
  $parent = listAll($db, $pageData[$page]['parent'])->fetchAll();

  // Set index array untuk parent
  $parentID = $pageData[$page]['parent'] . '_id';
  $parentName = $pageData[$page]['parent'] . '_nama';
}

// Kalau dalam mode edit, ambil dulu entry data dari database
if ($_GET['action'] == 'edit') {

  // Judul halaman
  $title = 'Edit ' . ucfirst($page);

  // Set tombol submit
  $submit = 'simpanEdit';

  $data = findById($db, $pageData[$page]['insertTable'], $pageData[$page]['primaryKey'], $_GET['id'])->fetch();

  $dataName = $pageData[$page]['insertTable']. '_nama';
  $dataDesc = $pageData[$page]['insertTable']. '_deskripsi';

  if ($page == 'pelajaran') {
    $dataKode = $pageData[$page]['insertTable'] . '_kode';
  }

} // IF action=edit

define('PAGE_TITLE', $title);

$pageTemplate = 'edit.html.php';
