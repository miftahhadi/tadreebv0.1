<?php
// Ambil semua kelas
$listKelas = listAll($db, 'kelas');

// Set variabel url
$url = 'index.php?' . explode('?', $_SERVER['REQUEST_URI'])[1];
// Kalau ada index submit, hapus
$url = strpos($url, '&submit') ? explode('&submit', $url)[0] : $url;

// Master template untuk halaman monitor
$pageTemplate = 'monitor.html.php';

// breadcrumb array
$monitorNav = [];

// Halaman awal, set judul default
// Judul halaman
$title = 'Hasil Tugas';
$pageTitle = $title;

////////////////////////////
// Cek link untuk breadcrumb
if (isset($_GET['kelas'])) {

  // Ambil data kelas
  $kelas = findById($db, 'kelas', 'kelas_id', $_GET['kelas'])->fetch(PDO::FETCH_ASSOC);

  // Masukkan ke array $monitorNav
  $monitorNav[0] = [
    'item' => 'Hasil Tugas',
    'link' => 'index.php?page=monitor'
  ];

  // Judul halaman
  $title = $kelas['kelas_nama'];
  $pageTitle = 'Hasil Tugas > ' . $title;

}

if (isset($_GET['pelajaran'])) {

  // Ambil daftar pelajaran
  $pelajaran = findById($db, 'pelajaran', 'pelajaran_id', $_GET['pelajaran'])->fetch(PDO::FETCH_ASSOC);

  // Masukkan ke $monitorNav
  $monitorNav[1] = [
    'item' => $kelas['kelas_nama'],
    'link' => explode('&pelajaran', $url)[0]
  ];

  // Judul halaman
  $title = $pelajaran['pelajaran_nama'];
  $pageTitle = 'Hasil Tugas > ' . $kelas['kelas_nama'] . ' > ' . $pelajaran['pelajaran_nama'];

}

if (isset($_GET['kuis'])) {

  // Ambil data kuis
  $kuis = findById($db, 'kuis', 'kuis_id', $_GET['kuis'])->fetch(PDO::FETCH_ASSOC);

  // Masukkan ke $monitorNav
  $monitorNav[2] = [
    'item' => $pelajaran['pelajaran_nama'],
    'link' => explode('&kuis', $url)[0]
  ];

  // Judul halaman
  $title = $kuis['kuis_nama'];
  $pageTitle = 'Hasil Tugas > ' . $kelas['kelas_nama'] . ' > ' . $pelajaran['pelajaran_nama'] . ' > ' . $kuis['kuis_nama'];

}

if (isset($_GET['user'])) {

  // Ambil data peserta
  $peserta = findById($db, 'users', 'user_id', $_GET['user'])->fetch(PDO::FETCH_ASSOC);

  // Masukkan nama kuis ke breadcrumb
  $monitorNav[3] = [
    'item' => $kuis['kuis_nama'],
    'link' => explode('&user', $url)[0]
  ];

}
////////////////////////////

// Set halaman dan logic
if (isset($_GET['user'])) {

  // Panggil controller hasil.php
  include __DIR__ . '/../../controllers/hasil.php';

} elseif (isset($_GET['kuis'])) { // Kalau kuis yang ingin dilihat hasilnya sudah dipilih

  // Ambil semua peserta di kelas ini
  $peserta = findById($db, 'users INNER JOIN kelas_peserta USING (user_id)', 'kelas_id', $_GET['kelas'])->fetchAll();

  // Ambil semua peserta yang sudah mengerjakan kuis ini
  $pesertaSubmit = runQuery($db, 'SELECT user_id FROM kuis_peserta WHERE kuis_id = :kuis_id AND section_id = :section_id AND kelas_id = :kelas_id', ['kuis_id' => $_GET['kuis'], 'section_id' => $_GET['section'], 'kelas_id' => $_GET['kelas']])->fetchAll(PDO::FETCH_COLUMN);

  // Halaman tampilan peserta yang sudah submit
  if (isset($_GET['submit']) && $_GET['submit'] == 'true') {

    // Ambil data peserta
    $pesertaSubmit = runQuery($db, 'SELECT * FROM kuis_peserta INNER JOIN users USING (user_id) WHERE kuis_id = :kuis_id AND section_id = :section_id AND kelas_id = :kelas_id', ['kuis_id' => $_GET['kuis'], 'section_id' => $_GET['section'], 'kelas_id' => $_GET['kelas']])->fetchAll();

    // Ambil semua jawaban peserta dengan ID x
    $jawabanPeserta = $db->prepare('SELECT nilai FROM submit_kuis INNER JOIN jawaban USING (jawaban_id) WHERE kuis_id = :kuis_id AND section_id = :section_id AND kelas_id = :kelas_id AND user_id = :user_id');

    // Untuk tiap user, hitung nilai kuisnya
    $nilai = [];
    foreach ($pesertaSubmit as $done) {
      // Eksekusi query
      $jawabanPeserta->execute(['kuis_id' => $_GET['kuis'], 'section_id' => $_GET['section'], 'kelas_id' => $_GET['kelas'], 'user_id' => $done['user_id']]);

      $jawaban = array_sum($jawabanPeserta->fetchAll(PDO::FETCH_COLUMN));

      // Buat array user_id => nilai total
      $nilaiPeserta = [ $done['user_id'] => $jawaban];

      // Masukkan array $nilaiPeserta ke array $nilai
      array_push($nilai, $nilaiPeserta);

    }

  }

  // Set template halaman monitor
  $monitorPage = '/monitor-users.html.php';

} elseif (isset($_GET['kelas']) && isset($_GET['pelajaran'])) {

  // Ambil nama kelas
  $kelas = runQuery($db, 'SELECT kelas_nama FROM kelas WHERE kelas_id = :kelas_id', ['kelas_id' => $_GET['kelas']])->fetchColumn();

  // Cek pelajaran ini terdaftar di kelas ini atau tidak
  $pelajaran = findById($db, 'pelajaran INNER JOIN kelas_pelajaran USING (pelajaran_id)', 'pelajaran_id', $_GET['pelajaran'])->fetch(PDO::FETCH_ASSOC);

  // Set template halaman monitor
  $monitorPage = '/monitor-pelajaran.html.php';

  // Kalau pelajaran tidak terdaftar, munculkan error
  if (empty($pelajaran)) {
    $error = 'Pelajaran ini tidak terdaftar di kelas ini';
  }

  // Kalau tidak ada error, ambil semua kuis di tiap section dalam pelajaran ini
  if (!isset($error)) {

    // Ambil semua section
    $listSection = findById($db, 'section', 'pelajaran_id', $_GET['pelajaran'])->fetchAll();

    // Ambil kuis di bawah section
    $stmtKuis = $db->prepare('SELECT * FROM kuis INNER JOIN section_kuis USING (kuis_id) INNER JOIN section USING (section_id) WHERE section_id IN (SELECT section_id FROM section WHERE pelajaran_id = :pelajaran_id AND section_id = :section_id)');

  }

} elseif (isset($_GET['kelas'])) {

  // Ambil semua pelajaran yang terdaftar di kelas ini
  $listPelajaran = findById($db, 'pelajaran INNER JOIN kelas_pelajaran USING (pelajaran_id) INNER JOIN kategori USING (kategori_id)', 'kelas_id', $_GET['kelas'], 'ORDER BY pelajaran_id DESC')->fetchAll();

  // Set template halaman monitor
  $monitorPage = '/monitor-kelas.html.php';

} else {

  // Ambil semua kelas
  $listKelas = listAll($db, 'kelas INNER JOIN angkatan USING (angkatan_id)', 'ORDER BY kelas_id DESC')->fetchAll();

  // Set template halaman monitor
  $monitorPage = '/monitor-pilih-kelas.html.php';

}

// Set judul halaman
define('PAGE_TITLE', $pageTitle);
