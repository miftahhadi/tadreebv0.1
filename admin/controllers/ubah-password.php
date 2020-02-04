<?php
// Ambil data user
$user = findById($db, 'users', 'user_id', $_GET['id'])->fetch(PDO::FETCH_ASSOC);

// Set link balik
$backLink = 'index.php?page=user&action=edit&id=' . $_GET['id'];

// Kalau sudah ubah password, eksekusi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Array error
  $error = [];

  // Cek ada yang kosong tidak
  if (empty($_POST['user']['password1']) || empty($_POST['user']['password2'])) {

    $error['kosong'] = 'Tidak boleh ada bagian yang kosong';

  }

  // Cek password cocok atau tidak
  if (!empty($_POST['user']['password1']) && !empty($_POST['user']['password2']) && ($_POST['user']['password1'] !== $_POST['user']['password2'])) {

    $error['takcocok'] = 'Password yang Anda masukkan tidak cocok';

  }

  // Tidak ada error, update ke database
  if (empty($error)) {

    $updatePwd = update($db, 'users', ['password' => password_hash($_POST['user']['password1'], PASSWORD_DEFAULT)], 'user_id', $_GET['id']);

    if ($updatePwd->rowCount() > 0) {

      $_SESSION['status'] = 'sukses';
      $_SESSION['msg'] = 'Password user berhasil diubah';

      header('Location: ' . $backLink);

    } else {
      $error['gagal'] = 'Gagal menyimpan ke database';
    }

  }

}

// Set judul halaman
define('PAGE_TITLE', 'Ubah Password - ' . $user['nama']);

// Set template
$pageTemplate = 'ubah-password.html.php';
