<?php
// Ambil data section dari database
$section = findById($db, 'section', 'section_id', $_GET['section'])->fetch(PDO::FETCH_ASSOC);

// Ambil file sesuai section ini
$listFiles = findById($db, 'upload INNER JOIN section_upload USING (upload_id)', 'section_id', $_GET['section'])->fetchAll();

// Cek pengaturan tiap item
$files = itemSetting($db, $listFiles,'upload_setting', 'upload_id');

// Ambil kuis pada section ini
$listKuis = findById($db, 'kuis INNER JOIN section_kuis USING (kuis_id)', 'section_id', $_GET['section'])->fetchAll();

// Cek pengaturan tiap kuis
$kuiss = itemSetting($db, $listKuis, 'kuis_setting', 'kuis_id');

// Jika ada kuis, cek apakah peserta sudah mengerjakan atau belum
// Siapkan statement dulu
$kuisPeserta = $db->prepare('SELECT * FROM kuis_peserta WHERE user_id = :user_id AND kuis_id = :kuis_id AND section_id = :section_id AND kelas_id = :kelas_id');

// Set judul halaman
define('PAGE_TITLE', $section['section_nama'] . ' - ' . $pelajaran['pelajaran_nama']);
