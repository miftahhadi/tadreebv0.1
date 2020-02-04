<?php
// Set judul halaman
define('PAGE_TITLE', 'Buat Pelajaran');

$pelajaranID = $_GET['id'];

// Ambil data pelajaran
$pelajaran = findById($db, 'pelajaran', 'pelajaran_id', $pelajaranID)->fetch();

// Ambil data section pada pelajaran ini
$sections = findById($db, 'section', 'pelajaran_id', $pelajaranID)->fetchAll();

$pageTemplate = 'pelajaran-build.html.php';
