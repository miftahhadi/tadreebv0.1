<?php
// Array objek, sesuaikan dengan page
if ($page == 'pelajaran') {
  $objeks = [
    'audio' => [
      'jenis' => 'audio',
      'icon' => 'play',
      'header' => ['Judul Audio', 'Ukuran'],
      'table' => 'upload',
      'where' => 'upload_id NOT IN (SELECT upload_id FROM section_upload WHERE section_id = :IDsection)',
      'and' => "AND upload_tipe LIKE 'audio%'",
      'primaryKey' => 'upload_id',
      'kolom' => ['upload_judul', 'upload_ukuran'],
      'tambahBtn' => 'Upload Baru',
      'insertTable' => 'section_upload',
      'parent' => 'section',
      'child' => 'upload'
      ],
    'dokumen' => [
      'jenis' => 'dokumen',
      'icon' => 'file-text',
      'header' => ['Judul Audio','Ukuran'],
      'table' => 'upload',
      'where' => 'upload_id NOT IN (SELECT upload_id FROM section_upload WHERE section_id = :IDsection)',
      'and'=> "AND (upload_tipe LIKE '%pdf%' OR upload_tipe LIKE '%doc%')",
      'primaryKey' => 'upload_id',
      'kolom' => ['upload_judul', 'upload_ukuran'],
      'tambahBtn' => 'Upload Baru',
      'insertTable' => 'section_upload',
      'parent' => 'section',
      'child' => 'upload'
      ],
    'kuis' => [
      'jenis' => 'kuis',
      'icon' => 'cloud-lightning',
      'header' => ['Judul Kuis', 'Kategori'],
      'table' => 'kuis INNER JOIN kategori USING (kategori_id)',
      'where' => 'kuis_id NOT IN (SELECT kuis_id FROM section_kuis WHERE section_id = :IDsection)',
      'and' => '',
      'primaryKey' => 'kuis_id',
      'kolom' => ['kuis_nama', 'kategori_nama'],
      'tambahBtn' => 'Kuis Baru',
      'insertTable' => 'section_kuis',
      'parent' => 'section',
      'child' => 'kuis'
    ]
  ];

} elseif ($page == 'kelas') {

  $objeks = [
    'pelajaran' => [
      'jenis' => 'pelajaran',
      'icon' => '',
      'header' => ['Judul Pelajaran', 'Kategori'],
      'table' => 'pelajaran INNER JOIN kategori USING (kategori_id)',
      'where' => 'pelajaran_id NOT IN (SELECT pelajaran_id FROM kelas_pelajaran WHERE kelas_id = :IDkelas)',
      'and' => '',
      'primaryKey' => 'pelajaran_id',
      'kolom' => ['pelajaran_nama', 'kategori_nama'],
      'tambahBtn' => 'Pelajaran Baru',
      'insertTable' => 'kelas_pelajaran',
      'parent' => 'kelas',
      'child' => 'pelajaran'
    ],
    'user' => [
      'jenis' => 'peserta',
      'icon' => '',
      'header' => ['Nama', 'Username', 'Angkatan', 'Jenis Kelamin'],
      'table' => 'users INNER JOIN angkatan USING (angkatan_id)',
      'where' => 'user_id NOT IN (SELECT user_id FROM kelas_peserta WHERE kelas_id = :IDkelas)',
      'and' => '',
      'primaryKey' => 'user_id',
      'kolom' => ['nama', 'username', 'angkatan_nama', 'jenis_kelamin'],
      'tambahBtn' => 'Peserta Baru',
      'insertTable' => 'kelas_peserta',
      'parent' => 'kelas',
      'child' => 'user'
    ]
  ];

} elseif ($page == 'kuis') {

  $objeks = [
    'soal' => [
      'jenis' => 'soal',
      'icon' => '',
      'header' => ['Soal', 'Tipe', 'Tanggal Dibuat'],
      'table' => 'soal',
      'where' => 'soal_id NOT IN (SELECT soal_id FROM kuis_soal WHERE kuis_id = :IDkuis)',
      'and' => '',
      'primaryKey' => 'soal_id',
      'kolom' => ['soal_redaksi', 'soal_tipe', 'soal_tanggal'],
      'tambahBtn' => 'Soal Baru',
      'insertTable' => 'kuis_soal',
      'parent' => 'kuis',
      'child' => 'soal'
    ]
  ];
}
