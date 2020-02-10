<?php
// Ambil daftar kelas dari database
$kelass = findById($db, 'kelas INNER JOIN kelas_peserta USING (kelas_id)', 'user_id', $_SESSION['user_id'])->fetchAll();

// Set the page title
$pageTitle = 'Halaman Depan';
