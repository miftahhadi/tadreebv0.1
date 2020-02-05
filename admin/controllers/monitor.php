<?php
// Ambil semua kelas
$listKelas = listAll($db, 'kelas');

if (isset($_GET['kelas'])) {

  // Ambil semua pelajaran yang terdaftar di kelas ini
  $listPelajaran = findById($db, 'pelajaran INNER JOIN kelas_pelajaran USING (pelajaran_id)', 'kelas_id', $_GET['kelas'])->fetchAll();

} elseif (isset($_GET['kelas']) && isset($_GET['pelajaran'])) {

  // Cek pelajaran ini terdaftar di kelas ini atau tidak


  // Ambil semua kuis yang terdaftar tiap pelajaran
  $listKuis = runQuery($db, 'SELECT * FROM kuis INNER JOIN section_kuis USING (kuis_id) WHERE section_id IN (SELECT section_id FROM section WHERE pelajaran_id = :pelajaran_id)', ['pelajaran_id' => $_GET['pelajaran']])->fetchAll();

  $pageTemplate = 'monitor.html.php';

}



// Ambil semua peserta yang terdaftar di kelas

// Ambil siapa saja yang sudah mengerjakan kuis dari table kuis_peserta
// Hitung yang sudah mengerjakan dan yang belum

// Hitung nilai peserta

// Tampilkan jawaban tiap individu

if (isset($_GET['pelajaran'])) {
  $pageTemplate = 'monitor-users.html.php';
} 
