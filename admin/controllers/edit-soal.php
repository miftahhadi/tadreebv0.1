<?php
// Import fungsi jawaban
include __DIR__ . '/../../includes/JawabanFunction.php';

// Jika ada kiriman soal, simpan ke database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Set url balik
  if (isset($_GET['kuisId'])) {
    $backUrl = 'index.php?page=kuis&action=build&id=' . $_GET['kuisId'];
  } else {
    $backUrl = 'index.php?page=soal';
  }

  // Kalau baru dari mode edit
  if (isset($_POST['simpanEdit'])) {

    $idSoal = $_GET['id'];

    $soal = update($db, 'soal', $_POST['soal'], 'soal_id', $idSoal);

  } elseif (isset($_POST['simpanBaru'])) {

    // Simpan soal dan ambil ID soal
    $_POST['soal']['soal_tanggal'] = new DateTime;
    $soal = insert($db, 'soal', $_POST['soal']);

    // Ambil ID soal
    $idSoal = $db->lastInsertId();

    // Kalau dari edit kuis, tambahkan ke kuis
    if (isset($_GET['kuisId'])) {
      insert($db, 'kuis_soal', ['kuis_id' => $_GET['kuisId'], 'soal_id' => $idSoal]);
    }

  }

  // Hitung jumlah pilihan benar
  $benarArray = [];

  // Buat prepared statement
  if (isset($_POST['simpanBaru']) || (isset($_POST['simpanEdit']) && isset($_POST['pilihan']))) {

    $query = "INSERT INTO `jawaban` (teks_jawaban, benar, nilai, soal_id) VALUES (:teks, :benar, :nilai, :IDsoal)";

    $pilihanJawaban = $db->prepare($query);

    // Siapkan dulu data jawaban
    $opsiJawaban = [];
    foreach ($_POST['pilihan'] as $pilihan) {

      if (!empty($pilihan['teks'])) {

        $jawaban = setJawaban($pilihan, $idSoal);

        array_push($opsiJawaban, $jawaban);

        // Kalau pilihan ini benar, masukkan ke array
        if ($jawaban['benar'] == 1) {
          array_push($benarArray, "1");
        }

      } // if (!empty($pilihan['teks']))

    } // FOREACH

    // Eksekusi
    foreach ($opsiJawaban as $opsi) {

      $result = $pilihanJawaban->execute($opsi);

    }

  } // simpanBaru atau tambah pilihan

  if (isset($_POST['simpanEdit']) && isset($_POST['updatePilihan'])) {

    $query = "UPDATE `jawaban` SET `teks_jawaban` = :teks, `benar` = :benar, `nilai` = :nilai WHERE `jawaban_id` = :IDjawaban && `soal_id` = :IDsoal";

    $pilihanJawaban = $db->prepare($query);

    // Siapkan dulu data jawaban
    $opsiJawaban = [];

    if (isset($_POST['updatePilihan'])) {
      foreach ($_POST['updatePilihan'] as $pilihan) {

        if (!empty($pilihan['teks'])) {

          $jawaban = setJawaban($pilihan, $idSoal, $pilihan['jawaban_id']);

          array_push($opsiJawaban, $jawaban);

          // Kalau pilihan ini benar, masukkan ke array
          if ($jawaban['benar'] == 1) {
            array_push($benarArray, "1");
          }

        } // if (!empty($pilihan['teks']))

      } // FOREACH
    }


    // Eksekusi
    foreach ($opsiJawaban as $opsi) {

      $result = $pilihanJawaban->execute($opsi);

    }

  } // simpanEdit

  if (isset($_POST['simpanBaru'])) {

    $tipeSoal = [];

    if (count($benarArray) > 1) {

      $tipeSoal['soal_tipe'] = '2';

    } elseif (count($benarArray) == 1) {

      $tipeSoal['soal_tipe'] = '1';

    }

    if (!empty($benarArray)) {

      $tipeSoal = update($db, 'soal', $tipeSoal, 'soal_id', $idSoal);

    }

  }

  // Redirect
  if ($result === true ) {

    // Set pesan berhasil dan arahkan ke $backUrl
    $_SESSION['status'] = 'sukses';
    $_SESSION['msg'] = 'Soal berhasil disimpan';
    header('Location: ' . $backUrl);

  }

} // IF SERVER_METHOD = POST

// Set identitas halaman
$page = [];

// Mode edit
if ($_GET['action'] == 'edit') {

  // Harus ada id soal, kalau tidak ada, munculkan error
  if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo 'Pilih soal dahulu';
    exit();
  }

  // Ambil data soal dari database
  $soal = findById($db, 'soal', 'soal_id', $_GET['id'])->fetch(PDO::FETCH_ASSOC);

  // Ambil daftar jawaban
  $jawabans = findById($db, 'jawaban', 'soal_id', $_GET['id'])->fetchAll();

  // Set judul  dan submit button
  $page['title'] = 'Edit ';
  $page['submit'] = 'simpanEdit';

} else {

  // Set judul
  $page['title'] = 'Tambah ';
  $page['submit'] = 'simpanBaru';

}

// Set judul halaman
define('PAGE_TITLE', $page['title'] . 'Soal');

$pageTemplate = 'edit-soal.html.php';
