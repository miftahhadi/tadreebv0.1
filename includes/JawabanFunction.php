<?php
function setJawaban($pilihan, $idSoal, $idJawaban = '') {
  // Set variabel benar dan nilai
  $nilai = 0;
  $benar = 0;
  if ($pilihan['nilai_benar'] > 0) {

    $nilai = $pilihan['nilai_benar'];
    $benar = 1;

  }

  if ($pilihan['nilai_salah'] < 0) {

    $nilai = $pilihan['nilai_salah'];
    $benar = 0;

  }

  $jawaban = [
    'teks' => $pilihan['teks'],
    'benar' => $benar,
    'nilai' => $nilai,
    'IDsoal' => $idSoal
  ];

  if (!empty($idJawaban)) {
    $jawaban['IDjawaban'] = $idJawaban;
  }

  return $jawaban;
}
