<?php
// Ambil nama kuis
$kuis = findById($db, 'kuis', 'kuis_id', $_GET['id'])->fetch();

// Ambil soal-soal
$soall = findById($db, 'soal INNER JOIN kuis_soal USING (soal_id) INNER JOIN kuis USING (kuis_id)', 'kuis_id', $_GET['id'], 'ORDER BY soal_id ASC')->fetchAll();

$pageTemplate = 'kuis-build.html.php';

if (isset($_GET['assign'])) {

  // Set variabel yang dibutuhkan untuk halaman assign
  $placeholder = 'IDkuis';
  $backUrl = 'page=kuis&action=build&id=' . $_GET['id'];
  $parentId = $_GET['id'];

  // Panggil halaman assign
  include __DIR__ . '/assign.php';

  $pageTemplate = 'assign.html.php';

}

// Set judul halaman
define('PAGE_TITLE', 'Buat Kuis');
