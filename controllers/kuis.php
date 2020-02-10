<?php
// Ambil data kuis
$kuis = findById($db, 'kuis ', 'kuis_id', $_GET['kuis'])->fetch(PDO::FETCH_ASSOC);

// Ambil settingan kuis kalau ada
$setting = runQuery($db, 'SELECT * FROM kuis_setting WHERE kuis_id = :kuis_id AND section_id = :section_id AND kelas_id = :kelas_id', ['kuis_id' => $_GET['kuis'], 'section_id' => $_GET['section'], 'kelas_id' => $_GET['kelas']])->fetch(PDO::FETCH_ASSOC);

// Berapa soal dalam kuis ini?
// Tidak pakai COUNT supaya bisa dipakai di mode doing
$querySoal = 'SELECT * FROM soal WHERE soal_id IN (SELECT soal_id FROM kuis_soal WHERE kuis_id = ?)';
$data = runQuery($db, $querySoal, [$_GET['kuis']]);

// Ada batas buka akses untuk kuis ini?
$batasBuka = (!empty($setting) && !is_null($setting['batas_buka'])) ? date('d M Y', strtotime($setting['batas_buka'])) : 'Tidak ada tenggat pengerjaan';

// Cek peserta, pernah ngerjain atau belum
$query = 'SELECT * FROM kuis_peserta WHERE user_id = :user_id AND kuis_id = :kuis_id AND section_id = :section_id AND kelas_id = :kelas_id';
$peserta = runQuery($db, $query,['user_id' => $_SESSION['user_id'], 'kuis_id' => $_GET['kuis'], 'section_id' => $_GET['section'], 'kelas_id' => $_GET['kelas']])->fetch(PDO::FETCH_ASSOC);

// Secara default, akses kuis dibuka
$aksesKuis = true;
$lihatHasil = false;

// Kalau udah pernah submit dan attemptnya udah habis, gak boleh ngerjain
if (!is_null($peserta['waktu_submit']) && (!is_null($peserta['attempt']) && $peserta['attempt'] >= $setting['attempt'])) {
  $msg = "Anda sudah mengerjakan tugas ini";
  $aksesKuis = false;
  $lihatHasil = true;
}

// Kalau sudah mulai ngerjain terus keluar, Anda sedang ngerjain tugas
if (is_null($peserta['waktu_submit']) && !is_null($peserta['waktu_mulai'])) {
  $msg = "Anda sedang mengerjakan tugas ini";
}

// Kuis ini memang ada dalam section ini atau tidak?
$findKuis = findById($db, 'kuis INNER JOIN section_kuis USING (kuis_id)', 'section_id', $_GET['section'])->fetch();

// Peserta ini boleh mengakses kuis ini atau tidak?
$aksesPeserta = runQuery($db, 'SELECT * FROM users INNER JOIN kelas_peserta USING (user_id) WHERE kelas_id = :kelas_id AND user_id = :user_id', ['user_id' => $_SESSION['user_id'], 'kelas_id' => $_GET['kelas']])->fetch();

if (empty($findKuis)) { // Kuis ini tidak terdaftar di section ini, munculkan 404

  define('PAGE_TITLE', 'Tidak Ditemukan');

  $pageTemplate = '404.html.php';

} elseif (empty($aksesPeserta)) { // Peserta tidak terdaftar, tutup akses

  header('Location: ./index.php?page=forbidden');
  exit();

} elseif (isset($_GET['doing'])) { // Mode ngerjain kuis
  // Set title page
  define('PAGE_TITLE', 'Mengerjakan Tugas - ' . $kuis['kuis_nama']);

  // Set template untuk ngerjain kuis
  $pageTemplate = 'kerjakan-kuis.html.php';

  // Ambil daftar soal
  $soalan = $data->fetchAll();

  // Buat prepared statement untuk ambil pilihan jawaban
  $query = 'SELECT * FROM jawaban WHERE soal_id = :soal_id';
  $stmtPilihan = $db->prepare($query);

} else { // Masih di halaman informasi kuis

  // Set title page
  $pageTitle = $kuis['kuis_nama'] . ' - ' . $pelajaran['pelajaran_nama'];

  $pageTemplate = 'kuis.html.php';

}

// Kalau peserta belum pernah kerjakan kuis, catat saat mulai ngerjain
if (isset($_GET['doing']) && empty($peserta)) {

  // Kapan pertama kali mulai mengerjakan?
  $mulai = date('Y-m-d H:i:s');

  $dataPeserta = [
    'user_id' => $_SESSION['user_id'],
    'kuis_id' => $_GET['kuis'],
    'section_id' => $_GET['section'],
    'kelas_id' => $_GET['kelas'],
    'waktu_mulai' => $mulai,
    'attempt' => '1'
  ];

  $submitPeserta = insert($db, 'kuis_peserta', $dataPeserta);

}
