<?php
// Fungsi untuk menampilkan alert di halaman, memerlukan dua argumen
// Argumen pertama: $status, nilainya berupa string 'sukses', 'gagal', atau 'awas'
// Argumen kedua: $message, pesan yang ingin ditampilkan
// Argumen opsional: $dismissible, jika ingin alert bisa ditutup
function alert($status, $message, $dismissible = 0) {

  // Set warna dan icon untuk masing-masing status
  $konten = [
    'sukses' => [
      'color' => 'primary', // Untuk alert, kita lebih suka warna biru wkwkwk. Warna hijaunya kurang pas
      'icon' => 'check-circle'
    ],
    'gagal' => [
      'color' => 'danger',
      'icon' => 'x-circle'
    ],
    'awas' => [
      'color' => 'warning',
      'icon' => 'alert-triangle'
    ]
  ];

  $alert = '<div class="alert alert-icon alert-' . $konten[$status]['color'];

  if ($dismissible == 1) {
    $alert .= ' alert-dismissible';
  }

  $alert .= '" role="alert">';

  if ($dismissible == 1) {
    $alert .= '<button type="button" class="close" data-dismiss="alert"></button>';
  }

  $alert .='<i class="fe fe-' . $konten[$status]['icon'] . ' mr-2" aria-hidden="true"></i>';
  $alert .= $message;
  $alert .= '</div>';

  return $alert;

}
