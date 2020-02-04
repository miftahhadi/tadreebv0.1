<?php

// Kalau sudah submit, proses dulu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Validasi form terlebih dulu
  // Set array error
  $error = [];

  if (empty($_POST['user']['nama'])) {
    $error['nama'] = 'Nama tidak boleh kosong';
  }

  if (empty($_POST['user']['nomor'])) {
    $error['nomor'] = 'Nomor tidak boleh kosong';
  }

  // Kalau tanggal lahir kosong jadikan NULL
  if (empty($_POST['user']['tanggal_lahir'])) {
    $_POST['user']['tanggal_lahir'] = NULL;
  }

  // Tidak ada error, tulis ke database
  if (empty($error)) {
    $simpanUser = update($db, 'users', $_POST['user'], 'user_id', $_SESSION['user_id']);

    if ($simpanUser->rowCount() > 0 ) {
      $_SESSION['msg'] = 'Perubahan berhasil disimpan';
      $_SESSION['status'] = 'sukses';
    }

  }

}

// Ambil data user dari database
$user = findById($db, 'users INNER JOIN angkatan USING (angkatan_id)', 'user_id', $_SESSION['user_id'])->fetch(PDO::FETCH_ASSOC);
$kelas = findById($db, 'users INNER JOIN kelas_peserta USING (user_id) INNER JOIN kelas USING (kelas_id)', 'user_id', $_SESSION['user_id'])->fetch(PDO::FETCH_ASSOC);
// Array jenis kelamin
$genders = ['Laki-laki', 'Perempuan'];


// Set the page title
define('PAGE_TITLE', 'Profil - ' . $user['nama']);

// Set the template
$pageTemplate = 'profil.html.php';
