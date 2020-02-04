<?php
$pageData = [
  'pelajaran' => [
    'title' => 'Pelajaran',
    'table' => '`pelajaran` INNER JOIN kategori USING (`kategori_id`)',
    'columns' => ['pelajaran_nama', 'pelajaran_kode', 'kategori_nama'],
    'tableHeader' => ['Judul Pelajaran', 'Kode Pelajaran', 'Kategori'],
    'primaryKey' => 'pelajaran_id',
    'insertTable' => 'pelajaran',
    'parent' => 'kategori'
  ],

  'kategori'=> [
    'title' => 'Kategori Pelajaran',
    'table'=>  '`kategori`',
    'columns' => ['kategori_nama', 'kategori_deskripsi'],
    'tableHeader' => ['Judul Kategori', 'Deskripsi'],
    'primaryKey' => 'kategori_id',
    'insertTable' => 'kategori',
  ],

  'kuis' => [
    'title' => 'Kuis',
    'table' => '`kuis`',
    'columns' => ['kuis_nama', 'kuis_deskripsi'],
    'tableHeader' => ['Judul Kuis', 'Deskripsi'],
    'primaryKey' => 'kuis_id',
    'insertTable' => 'kuis'
  ],

  'soal' => [
    'title' => 'Bank Soal',
    'table' => '`soal`',
    'columns' => ['soal_redaksi', 'soal_tipe'],
    'tableHeader' => ['Soal', 'Tipe'],
    'primaryKey' => 'soal_id',
    'insertTable' => 'soal'
  ],

  'user' => [
    'title' => 'User dan Peserta',
    'table' => '`users` INNER JOIN angkatan USING (angkatan_id)',
    'columns' => ['nama', 'username', 'angkatan_nama', 'jenis_kelamin'],
    'tableHeader' => ['Nama', 'Username', 'Angkatan', 'Jenis Kelamin'],
    'primaryKey' => 'user_id',
    'insertTable' => 'users'
  ],

  'angkatan' => [
    'title' => 'Daftar Angkatan',
    'table' => '`angkatan`',
    'columns' => ['angkatan_nama', 'angkatan_deskripsi'],
    'tableHeader' => ['Nama Angkatan', 'Deskripsi'],
    'primaryKey' => 'angkatan_id',
    'insertTable' => 'angkatan'
  ],

  'kelas' => [
    'title' => 'Daftar Kelas',
    'table' => '`kelas` INNER JOIN `angkatan` USING (`angkatan_id`)',
    'columns' => ['kelas_nama', 'angkatan_nama', 'kelas_deskripsi'],
    'tableHeader' => ['Nama Kelas', 'Angkatan', 'Deskripsi'],
    'primaryKey' => 'kelas_id',
    'insertTable' => 'kelas',
    'parent' => 'angkatan',
  ],

  'section' => [
    'title' => '',
    'table' => 'section',
    'columns' => [],
    'tableHeader' => [],
    'primaryKey' => 'section_id',
    'insertTable' => 'section',
    'parent' => 'pelajaran',
  ]
];
