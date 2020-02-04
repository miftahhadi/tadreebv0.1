<?php
// Data
$listData = [
  'pelajaran' => [
    'table' =>'kelas INNER JOIN kelas_pelajaran USING (kelas_id) INNER JOIN pelajaran USING (pelajaran_id)',
    'tableHeader' => ['Pelajaran', 'Deskripsi'],
    'kolom' => ['pelajaran_nama', 'pelajaran_deskripsi'],
    'link' => 'pelajaran',
    'id' => 'pelajaran_id'
  ],
  'peserta' => [
    'table' =>'kelas INNER JOIN kelas_peserta USING (kelas_id) INNER JOIN users USING (user_id)',
    'tableHeader' => ['Nama', 'Username', 'Email'],
    'kolom' => ['nama', 'username', 'email'],
    'link' => 'user',
    'id' => 'user_id'
  ]
];


define('PAGE_TITLE', 'Kelas');

$kelasId = $_GET['id'];

// Ambil data kelas
$kelas = findById($db, 'kelas', 'kelas_id', $kelasId)->fetch(PDO::FETCH_ASSOC);

// Kalau tidak ada list, arahkan ke list peserta
if (isset($_GET['list'])) {
  $list = $_GET['list'];
} else {
  $list = 'peserta';
}

$dataAll = findById($db, $listData[$list]['table'], 'kelas_id', $kelasId)->fetchAll();

$pageTemplate = 'kelas-build.html.php';

// Kalau mode assign untuk tambah pelajaran atau peserta, jalankan template lain
if (isset($_GET['assign'])) {

  // Panggil array data objek
  include __DIR__ . '/../../includes/AssignObject.php';

  // Set variable yang dibutuhkan untuk halaman assign
  $placeholder = 'IDkelas';
  $objek = $_GET['assign'];
  $backUrl = 'page=kelas&action=build&id=' . $kelasId . '&list=' . $objeks[$objek]['jenis'];
  $parentId = $_GET['id'];

  // Panggil halaman assign
  include __DIR__ . '/assign.php';

}
