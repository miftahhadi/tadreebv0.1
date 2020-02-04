<?php
function saveSetting($db) {

  // Set nilai tampil dan buka akses
  $_POST['setting']['tampil'] = ($_POST['setting']['tampil']) ?? 0;
  $_POST['setting']['buka'] = ($_POST['setting']['buka']) ?? 0;

  // Set buka auto dan batas buka
  if (!empty($_POST['setting']['buka_auto']['tanggal'])) {
    $_POST['setting']['buka_auto'] = $_POST['setting']['buka_auto']['tanggal'] . ' ' . $_POST['setting']['buka_auto']['waktu'];
  } else {
    $_POST['setting']['buka_auto'] = null;
  }

  if (!empty($_POST['setting']['batas_buka']['tanggal'])) {
    $_POST['setting']['batas_buka'] = $_POST['setting']['batas_buka']['tanggal'] . ' ' . $_POST['setting']['batas_buka']['waktu'];
  } else {
    $_POST['setting']['batas_buka'] = null;
  }

  // Untuk kuis, ada variable tambahan yang harus dicek
  if ($_POST['page'] == 'kuis') {
    $_POST['setting']['buka_hasil'] = $_POST['setting']['buka_hasil'] ?? 0;
  }

  // Set variabel untuk query
  $settingArgs = [
    'section_id' => $_POST['setting']['section_id'],
    'kelas_id' => $_POST['setting']['kelas_id']
  ];

  if ($_POST['page'] == 'konten') {

    $settingTable = 'upload_setting';
    $settingWhere = ' AND upload_id = :upload_id';
    $settingCols = '';
    $settingArgs['upload_id'] = $_POST['setting']['upload_id'];

  } elseif ($_POST['page'] == 'kuis') {

    $settingTable = 'kuis_setting';
    $settingWhere = ' AND kuis_id = :kuis_id';
    $settingCols = ', durasi = :durasi, attempt = :attempt, buka_hasil = :buka_hasil';
    $settingArgs['kuis_id'] = $_POST['setting']['kuis_id'];

  } else {

    $settingTable = 'section_setting';
    $settingWhere = '';
    $settingCols = '';

  }

  $cekSetting = 'SELECT * FROM ' . $settingTable . ' WHERE section_id = :section_id AND kelas_id = :kelas_id' . $settingWhere;

  // Cek sudah ada pengaturan atau belum
  $setting = runQuery($db, $cekSetting, $settingArgs)->fetch();

  if (!empty($setting)) {

    $query = 'UPDATE ' . $settingTable . ' SET tampil = :tampil, buka = :buka, buka_auto = :buka_auto, batas_buka = :batas_buka' . $settingCols . ' WHERE section_id = :section_id AND kelas_id = :kelas_id' . $settingWhere;

    $settingBaru = runQuery($db, $query, $_POST['setting'])->rowCount();

  } else {

    $settingBaru = insert($db, $settingTable, $_POST['setting'])->rowCount();

  }

  if ($settingBaru > 0) {

    // Pesan konfirmasi
    $saveSetting['status'] = 'sukses';
    $saveSetting['message'] = 'Pengaturan berhasil disimpan';

  } else { //  Ada error

    // Pesan error
    $saveSetting['status'] = 'gagal';
    $saveSetting['message'] = 'Terjadi kesalahan. Tidak bisa menyimpan ke database';

  }

  return $saveSetting;

} // function
