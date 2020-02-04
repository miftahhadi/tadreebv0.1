<?php
// Kalau sudah memilih file
if (isset($_POST['import'])) {

  // Kalau file ada, proses
  if ((isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK)) {

    // Set nama file dari nama temporarynya
    $fileName = $_FILES['file']['tmp_name'];

    // Kalau filenya gak rusak, proses
    if ($_FILES['file']['size'] > 0) {

      // Baca filenya
      $file = fopen($fileName, 'r');

      // Set prepared statement
      $query = 'INSERT INTO users (nama, username, angkatan_id, password, role, jenis_kelamin, tanggal_lahir, domisili, pekerjaan, email, nomor, tanggal_bergabung) VALUES (:nama, :username, :angkatan_id, :password, :role, :jenis_kelamin, :tanggal_lahir, :domisili, :pekerjaan, :email, :nomor, :tanggal_bergabung)';
      $stmt = $db->prepare($query);

      // Baca tiap baris file csv, hash password, dan eksekusi query
      fgetcsv($file);
      while (($kolom = fgetcsv($file, 'r')) !== FALSE) {

        // Hash data password
        $password = password_hash($kolom[2], PASSWORD_DEFAULT);

        // Set tanggal bergabung sebagai tanggal sekarang
        $bergabung = new DateTime;

        // Set angkatan
        if ($_POST['angkatan']) {
          $angkatan = $_POST['angkatan'];
        } else {
          $angkatan = '';
        }

        // Set array untuk eksekusi query
        $data = [
          'nama' => $kolom[0],
          'username' => $kolom[1],
          'angkatan_id' => $angkatan,
          'password' => $password,
          'role' => 1,
          'jenis_kelamin' => $kolom[3],
          'tanggal_lahir' => $kolom[4],
          'domisili' => $kolom[5],
          'pekerjaan' => $kolom[6],
          'email' => $kolom[7],
          'nomor' => $kolom[8],
          'tanggal_bergabung' => $bergabung->format('Y-m-d')
        ];

        // Eksekusi ke database
        $result = $stmt->execute($data);

      }
      if (($kolom = fgetcsv($file, 'r')) === FALSE) { // File tidak bisa dibaca
        $error = 'Terjadi kesalahan: File tidak bisa dibaca';
      }

      // Berhasil, kembali ke daftar user
      if ($result > 0) {

        header('Location: index.php?page=user');

      } else { // Tidak bisa menyimpan ke database

        $error = 'Tidak bisa menyimpan ke database. Mohon periksa file yang Anda upload dan sesuaikan dengan format';

      }

    } else { // Ukuran file nol, file rusak

      $error = 'Mohon periksa kembali ukuran file';

    }

  } else { // Tidak ada file yang diupload

    $error = 'Tidak ada file yang diupload';

  }

} // IF isset $_POST

// Ambil daftar angkatan
$listAngkatan = listAll($db, 'angkatan')->fetchAll();

// Set judul halaman
define('PAGE_TITLE', 'Import dari CSV');

$pageTemplate = 'importcsv.html.php';
