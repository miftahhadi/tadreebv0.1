<?php
// Kalau sudah submit, proses dulu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Validasi form terlebih dulu
  // Set array error
  $error = [];

  if (empty($_POST['user']['nama'])) {
    $error['nama'] = 'Nama tidak boleh kosong';
  }

  if (empty($_POST['user']['username'])) {
    $error['username'] = 'Username tidak boleh kosong';
  }

  if ($_GET['action'] == 'tambah' && empty($_POST['user']['password'])) {
    $error['password'] = 'Belum ada password';
  }

  if (empty($_POST['user']['nomor']) && $_POST['user']['role'] != 'Administrator') {
    $error['nomor'] = 'Nomor WhatsApp tidak boleh kosong';
  }

  // Kalau tanggal lahir kosong jadikan NULL
  if (empty($_POST['user']['tanggal_lahir'])) {
    $_POST['user']['tanggal_lahir'] = NULL;
  }

  // Cek username di database
  if ($_GET['action'] == 'tambah' && !empty($_POST['user']['username'])) {
    $query = 'SELECT * FROM users WHERE username = :username';
    $cekUsername = runQuery($db, $query, ['username' => $_POST['user']['username']])->rowCount();

    if ($cekUsername == 1) {
      $error['username'] = 'Username sudah terdaftar';
    }
  }

  if (empty($error)) {
    if (isset($_POST['simpanBaru'])) {

      // Set tanggal bergabung
      $_POST['user']['tanggal_bergabung'] = new DateTime;

      // Hash password
      $_POST['user']['password'] = password_hash($_POST['user']['password'], PASSWORD_DEFAULT);

      // Simpan ke database
      $simpanUser = insert($db, 'users', $_POST['user']);
    }

    if (isset($_POST['simpanEdit'])) {

      // Simpan update ke database
      $simpanUser = update($db, 'users', $_POST['user'], 'user_id', $_GET['id']);
    }

    // Kalau berhasil, redirect ke daftar user
    if ($simpanUser->rowCount() > 0) {

      // Set message
      $_SESSION['status'] = 'sukses';
      $_SESSION['msg'] = 'User berhasil disimpan';
      header('Location: index.php?page=user');

    }

  }

}

// Set nama button submit
if ($_GET['action'] == 'tambah') {
  $button = 'simpanBaru';
} elseif ($_GET['action'] == 'edit') {
  $button = 'simpanEdit';
}

// Set beberapa array
$roles = ['Peserta', 'Administrator'];
$genders = ['Laki-laki', 'Perempuan'];

// Ambil data angkatan
$listAngkatan = listAll($db, 'angkatan')->fetchAll();

// Mode edit user
if (($_GET['action'] == 'edit') && isset($_GET['id'])) {
  // Ambil data user
  $user = findById($db, 'users', 'user_id', $_GET['id'])->fetch(PDO::FETCH_ASSOC);

  // Set judul halaman
  $title = 'Edit Peserta';

} elseif (($_GET['action'] == 'tambah') && isset($_POST['simpanBaru'])) {

  $user = $_POST['user'];

}

// Set judul halaman
$title = 'Tambah User Baru';

define('PAGE_TITLE', $title);

$pageTemplate = 'edit-user.html.php';
