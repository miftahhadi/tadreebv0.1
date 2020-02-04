<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Error array
  $error = [];

  // Cek tidak ada field yang kosong
  if (empty($_POST['user']['password_lama']) || empty($_POST['user']['password1']) || empty($_POST['user']['password2'])) {
    $error['kosong'] = 'Semua bagian harus diisi';
  }

  if ((!empty($_POST['user']['password1']) && !empty($_POST['user']['password2'])) && $_POST['user']['password1'] != $_POST['user']['password2']) {
    $error['takcocok'] = 'Password baru Anda tidak cocok';
  }

  // Password lama yang dimasukkan betul atau tidak
  if (!empty($_POST['user']['password_lama']) && !password_verify($_POST['user']['password_lama'],$_SESSION['password'])) {
    $error['password_salah'] = 'Password lama Anda salah.';
  }

  // Kalau tidak ada error, eksekusi
  if (empty($error)) {

    // Update database
    $ubahPwd = update($db, 'users', ['password' => password_hash($_POST['user']['password1'], PASSWORD_DEFAULT)], 'user_id', $_SESSION['user_id']);

    // Kalau berhasil, kembali ke halaman profil, simpan password baru ke variabel SESSION
    if ($ubahPwd->rowCount() > 0) {

      $_SESSION['password'] = (findById($db, 'users', 'user_id', $_SESSION['user_id'])->fetch(PDO::FETCH_ASSOC))['password'];

      $_SESSION['status'] = 'sukses';
      $_SESSION['msg'] = 'Password berhasil diubah';
      header('Location: ./index.php?page=profil');
    }

  }

}

$backLink = './index.php?page=profil';

// Set the page title
define('PAGE_TITLE', 'Ubah Password');

// Set the template
$pageTemplate = 'ubah-password.html.php';
