<?php
include __DIR__ . '/../../includes/SaveSetting.php';

// Kalau ada update pengaturan, proses terlebih dulu
if (isset($_POST['updateSetting'])) {
  $settingBaru = saveSetting($db);

  $status = $settingBaru['status'];
  $message = $settingBaru['message'];

  if (isset($_GET['setting'])) {
    $_SESSION['status'] = $status;
    $_SESSION['msg'] = $message;
    header('Location: index.php?page=pelajaran&action=editsection&id=' . $_GET['id'] . '&sectionId=' . $_GET['sectionId'] . '&kelasId=' . $_GET['kelasId']);
  }

}

if (isset($_GET['kelasId'])) {

  $settingArgs = [
    'section_id' => $_GET['sectionId'],
    'kelas_id' => $_GET['kelasId']
  ];

  if (isset($_GET['setting']) && $_GET['setting'] == 'konten') {

    $settingTable = 'upload_setting';
    $settingWhere = ' AND upload_id = :upload_id';
    $settingArgs['upload_id'] = $_GET['kontenId'];

  } elseif (isset($_GET['setting']) && $_GET['setting'] == 'kuis') {

    $settingTable = 'kuis_setting';
    $settingWhere = ' AND kuis_id = :kuis_id';
    $settingArgs['kuis_id'] = $_GET['kuisId'];

  } else {

    $settingTable = 'section_setting';
    $settingWhere = '';

  }

  // Ambil setting untuk section dari database
  $query = 'SELECT * FROM ' . $settingTable . ' WHERE section_id = :section_id AND kelas_id = :kelas_id' . $settingWhere;
  $setting = runQuery($db, $query, $settingArgs)->fetch(PDO::FETCH_ASSOC);

  // Kalau ada setting, sesuaikan format tanggal dan waktu dulu
  // Buka auto
  $bukaAuto = !empty($setting) && $setting['buka_auto'] != NULL ? explode(" ",$setting['buka_auto']) : '';

  // Batas buka
  $batasBuka = !empty($setting) && explode(" ",$setting['batas_buka']) ? explode(" ",$setting['batas_buka']) : '';

}

// Ambil array objek untuk section
include __DIR__ .'/../../includes/AssignObject.php';

// Ambil nama dan deskripsi section
$section = findById($db, 'section', 'section_id', $_GET['sectionId'])->fetch(PDO::FETCH_ASSOC);
$pelajaran = findById($db, 'pelajaran', 'pelajaran_id', $_GET['id'])->fetch(PDO::FETCH_ASSOC);

// Ambil file dan kuis berdasarkan section
$files = findById($db, 'upload INNER JOIN section_upload USING (upload_id)', 'section_id', $_GET['sectionId'])->fetchAll();
$kuiss = findById($db, 'kuis INNER JOIN section_kuis USING (kuis_id)', 'section_id', $_GET['sectionId'])->fetchAll();

// Mode assign objek
if (isset($_GET['assign'])) {

  // Set variabel yang dibutuhkan untuk halaman assign
  $placeholder = 'IDsection';
  $backUrl = 'page=pelajaran&action=editsection&id=' . $_GET['id'] . '&sectionId=' . $_GET['sectionId'];
  $parentId = $_GET['sectionId'];

  // Panggil halaman assign
  include __DIR__ . '/assign.php';

  // Atur tampilan ukuran file
  if ($_GET['assign'] != 'kuis' ) {

    $i=0;
    foreach ($daftarItem as $item) {
      $item['upload_ukuran'] = (round($item['upload_ukuran']/1000000, 2)) . ' MB';
      $daftarItem[$i]['upload_ukuran'] = $item['upload_ukuran'];
      $i++;
    }

  }

} elseif (isset($_GET['setting'])) {

  $title = 'Setting ' . ucfirst($_GET['setting']);

  // Tentukan name dan value untuk hidden input di template
  if ($_GET['setting'] == 'konten') {
    $IDname = 'upload_id';
    $IDvalue = $_GET['kontenId'];
  } elseif ($_GET['setting'] == 'kuis') {
    $IDname = 'kuis_id';
    $IDvalue = $_GET['kuisId'];
  }

  $pageTemplate = 'setting-konten.html.php';

} else {

  if (isset($_GET['kelasId'])) {

    // Ambil pengaturan dari database kalau ada
    $setting = runQuery($db, 'SELECT * FROM section_setting WHERE section_id = :section_id AND kelas_id = :kelas_id', ['section_id' => $_GET['sectionId'], 'kelas_id' => $_GET['kelasId']])->fetch(PDO::FETCH_ASSOC);


  }


  $title = $section['section_nama'] . ' - ' . $pelajaran['pelajaran_nama'];

  $pageTemplate = 'edit-section.html.php';

}

// Set judul halaman
define('PAGE_TITLE', $title);
