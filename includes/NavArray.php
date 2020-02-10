<?php
// The navigation list
$navArray = [
  'admin' => [
    [
      'title' => 'Dashboard',
      'link' => 'index.php',
      'icon' => 'home'
    ],
    [
      'title' => 'Pelajaran',
      'link' => 'javascript:void(0)',
      'icon' => 'server',
      'submenu' => [
        [
          'subTitle' => 'Tambah Pelajaran',
          'subLink' => 'index.php?page=pelajaran&action=tambah'
        ],
        [
          'subTitle' => 'Daftar Pelajaran',
          'subLink' => 'index.php?page=pelajaran'
        ],
        [
          'subTitle' => 'Kategori Pelajaran',
          'subLink' => 'index.php?page=kategori'
        ]
      ]
    ],
    [
      'title' => 'Kuis dan Soal',
      'link' => 'javascript:void(0)',
      'icon' => 'briefcase',
      'submenu' => [
        [
          'subTitle' => 'Tambah Kuis',
          'subLink' => 'index.php?page=kuis&action=tambah'
        ],
        [
          'subTitle' => 'Daftar Kuis',
          'subLink' => 'index.php?page=kuis'
        ],
        [
          'subTitle' => 'Bank Soal',
          'subLink' => 'index.php?page=soal'
        ]
      ]
    ],
    [
      'title' => 'User & Peserta',
      'link' => 'javascript:void(0)',
      'icon' => 'server',
      'submenu' => [
        [
          'subTitle' => 'Daftar User',
          'subLink' => 'index.php?page=user'
        ],
        [
          'subTitle' => 'Angkatan',
          'subLink' => 'index.php?page=angkatan'
        ],
        [
          'subTitle' => 'Kelas',
          'subLink' => 'index.php?page=kelas'
        ]
      ]
    ],
    [
      'title' => 'Hasil Tugas',
      'link' => 'index.php?page=monitor',
      'icon' => 'monitor'
    ]
  ],
  'front' => [
    [
      'title' => 'Pelajaran',
      'link' => '.',
      'icon' => 'home'
    ],
    [
      'title' => 'Tentang ' . SITE_NAME,
      'link' => '#',
      'icon' => 'help-circle'
    ],
  ]
];
