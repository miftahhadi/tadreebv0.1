<?php
// Ambil data kuis
$kuis = findById($db, 'kuis', 'kuis_id', $_GET['hasil'])->fetch(PDO::FETCH_ASSOC);

// Ambil info settingan kuis
$kuis['buka_hasil'] = runQuery($db, 'SELECT buka_hasil FROM kuis_setting WHERE kuis_id = :kuis_id AND section_id = :section_id AND kelas_id = :kelas_id', ['kuis_id' => $_GET['hasil'], 'section_id' => $_GET['section'], 'kelas_id' => $_GET['kelas']])->fetchColumn();

// Ambil semua soal
$daftarSoal = runQuery($db, 'SELECT soal_id, soal_redaksi FROM soal WHERE soal_id IN (SELECT soal_id FROM kuis_soal WHERE kuis_id = :kuis_id)', ['kuis_id' => $_GET['hasil']])->fetchAll();

// Siapkan statement untuk ambil semua pilihan jawaban di soal dengan id tertentu
$stmtPilihan = $db->prepare('SELECT * FROM jawaban WHERE soal_id = :soal_id');

// Siapkan statement untuk ambil jawaban yang diinput peserta
$stmtJawaban = $db->prepare('SELECT jawaban_id FROM submit_kuis WHERE user_id = :user_id AND kuis_id = :kuis_id AND section_id = :section_id AND kelas_id = :kelas_id AND soal_id = :soal_id');

// Array data untuk dieksekusi ke query jawaban
$data = [
  'user_id' => $_SESSION['user_id'],
  'kuis_id' => $_GET['hasil'],
  'section_id' => $_GET['section'],
  'kelas_id' => $_GET['kelas'],
];

define('PAGE_TITLE', 'Hasil - ' . $kuis['kuis_nama']);

$pageTemplate = 'hasil.html.php';
