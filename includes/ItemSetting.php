<?php
function itemSetting($db,$listFiles,$settingTable = 'section_setting',$itemKey = 'section_id') {
  // Set file array, gabungkan info file dan pengaturannya di array ini
  $files = [];

  // Set tanggal hari ini dan cocokkan dengan pengaturan kalau ada pengaturan
  $today = new DateTime();
  $today = $today->format('Y-m-d H:i:s');

  // Ambil pengaturan tiap file
  // Siapkan query ke database
  $query = 'SELECT * FROM ' . $settingTable;

  if ($settingTable = 'section_setting') {
    $query .= ' WHERE ' . $itemKey . ' = :' . $itemKey;
  } else {
    $query .= ' WHERE ' . $itemKey . ' = :' . $itemKey . ' AND section_id = :section_id';
  }

  $query .= ' AND kelas_id = :kelas_id';

  // Set prepared statement
  $stmt = $db->prepare($query);

  foreach ($listFiles as $file) {

    // Set data array untuk eksekusi
    if ($settingTable = 'section_setting') {
      $data = [
        $itemKey => $file[$itemKey],
        'kelas_id' => $_GET['kelas']
      ];
    } else {
      $data = [
        $itemKey => $file[$itemKey],
        'section_id' => $_GET['section'],
        'kelas_id' => $_GET['kelas']
      ];
    }
    
    // Eksekusi
    $stmt->execute($data);
    $fileSetting = $stmt->fetch(PDO::FETCH_ASSOC);

    // Kalau tidak ada setting, beri settingan default
    if (empty($fileSetting)) {

      $file['tampil'] = 1;
      $file['buka'] = 1;

    } else { // Kalau setting ada, cek status item

      // Ambil settingan file dan tambahkan ke array $file
      $file['tampil'] = $fileSetting['tampil'];
      $file['buka'] = $fileSetting['buka'];

      // Cek apakah ada tanggal buka otomatis, sesuaikan
      if (!is_null($fileSetting['buka_auto']) && $today > $fileSetting['buka_auto']) {
        $file['buka'] = 1;
      }

      // Cek apa ada tanggal batas buka akses, kalau sudah lewat dari tanggal hari ini, tutup akses
      if (!is_null($fileSetting['batas_buka']) && $today > $fileSetting['batas_buka']) {
        $file['buka'] = 0;
      }

    }

    // Tambahkan info file ke array $files;
    array_push($files, $file);

  }

  return $files;

}
