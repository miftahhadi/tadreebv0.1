<?php
// Kalau sudah submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Set variable error
  $error = '';

  // Cek username dan password tidak kosong
  if (empty($_POST['username']) || empty($_POST['password'])) {
    $error = 'Username/password tidak boleh kosong';
  }
  // Ambil data dari database sesuai username
  if (!empty($_POST['username'])) {
    $user = find($db, 'users', 'username', $_POST['username'])->fetch(PDO::FETCH_ASSOC);

    // Kalau tidak ada, user tidak terdaftar
    if (empty($user)) {

      $error = 'Username/password salah atau tidak terdaftar';

    } elseif (!empty($user) && password_verify($_POST['password'], $user['password'])) { // Bandingkan password yang dimasukkan dengan yang ada di database, pakai password_verify dari PHP

      // Sukses, set session
      session_regenerate_id();
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['password'] = $user['password'];
      $_SESSION['nama'] = $user['nama'];
      $_SESSION['role'] = $user['role'];
      setcookie('user_id', $user['user_id'], time() + (60 * 60 * 24));    // expires in 1 day
    	setcookie('username', $user['username'], time() + (60 * 60 * 24));  // expires in 1 day
      setcookie('password', $user['password'], time() + (60 * 60 * 24));  // expires in 1 day
    	setcookie('nama', $user['nama'], time() + (60 * 60 * 24));
    	setcookie('role', $user['role'], time() + (60 * 60 * 24));

      // Kalau admin, arahkan ke halaman admin
      if ($user['role'] == 'Administrator') {
        $url = LOCATOR . '/admin/';
      } else {
        $url = LOCATOR;
      }

      header('Location: ' . $url);

    } else { // Kalau password salah

      $error = 'Username/password salah atau tidak terdaftar';

    }

  } // IF !empty($_POST['username'])

} // IF REQUEST_METHOD = POST

define('PAGE_TITLE', 'Halaman Login');

include __DIR__ . '/templates/login.html.php';
