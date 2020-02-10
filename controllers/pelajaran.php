<?php
// Load itemSetting function
include __DIR__ . '/../includes/ItemSetting.php';

// Set kode pelajaran
$kodePelajaran = $_GET['lesson'];

// Ambil ID kelas
$kelas = $_GET['kelas'];

// Ambil data pelajaran dari database
$query = 'SELECT * FROM `pelajaran` WHERE `pelajaran_kode` = :pelajaran_kode';
$pelajaran = runQuery($db, $query, ['pelajaran_kode' => $kodePelajaran])->fetch(PDO::FETCH_ASSOC);

// Ambil semua section di pelajaran ini
$listSections = findById($db, 'section', 'pelajaran_id', $pelajaran['pelajaran_id'])->fetchAll();

// Cek pengaturan tiap section
$sections = itemSetting($db, $listSections);

// Buka kuis di pelajaran ini
if (isset($_GET['section']) && isset($_GET['kuis'])) {

  include __DIR__ . '/kuis.php';

} elseif (isset($_GET['section']) && isset($_GET['hasil'])) {

  include __DIR__ . '/hasil.php';

} elseif (isset($_GET['section'])) { // Tampilan halaman section

  include __DIR__ . '/section.php';

  // Set the template
  $pageTemplate = 'section.html.php';

} else {

  // Set the page title
  $pageTitle = $pelajaran['pelajaran_nama'];

  // Set the template
  $pageTemplate = 'pelajaran.html.php';

}
