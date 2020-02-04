<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Kapan waktu submitnya?
  $waktuSubmit = date('Y-m-d H:i:s');

  // buat prepared statement
  $query = 'INSERT INTO submit_kuis (user_id, kuis_id, section_id, kelas_id, attempt, soal_id, jawaban_id) VALUES (:user_id, :kuis_id, :section_id, :kelas_id, :attempt, :soal_id, :jawaban_id)';
  $stmt = $db->prepare($query);

  foreach ($_POST['soal'] as $soal) {

  	// Kalau tidak ada jawaban
  	if (!isset($soal['jawaban']) || empty($soal['jawaban'])) {

  		$data = [
  					"user_id" => $_SESSION['user_id'],
  					"kuis_id" => $_POST['kuis_id'],
  					"section_id" => $_POST['section_id'],
  					"kelas_id" => $_POST['kelas_id'],
  					"attempt" => $_POST['attempt'],
  					"soal_id" => $soal['soal_id'],
  					"jawaban_id" => 0,
  				];

  		$stmt->execute($data);

    } else { // Kalau ada jawaban

  		foreach ($soal['jawaban'] as $jawaban) {

  			$data = [
          "user_id" => $_SESSION['user_id'],
          "kuis_id" => $_POST['kuis_id'],
          "section_id" => $_POST['section_id'],
          "kelas_id" => $_POST['kelas_id'],
          "attempt" => $_POST['attempt'],
          "soal_id" => $soal['soal_id'],
          "jawaban_id" => $jawaban,
        ];

  			$stmt->execute($data);
  		}
  	}
  }

  // Update informasi kuis peserta
  $queryUpdate = 'UPDATE kuis_peserta SET waktu_submit = :waktu_submit WHERE user_id = :user_id AND kuis_id = :kuis_id';

  // Update
  $update = runQuery($db, $queryUpdate, ['waktu_submit' => $waktuSubmit, 'user_id' => $_SESSION['user_id'], 'kuis_id' => $_POST['kuis_id']])->rowCount();

  // Set pesan konfirmasi
  if ($stmt->rowCount() > 0) {

    $submit = [
      'status' => 'sukses',
      'msg' => 'Anda sudah mengerjakan kuis, jawaban Anda berhasil dikirim ke sistem'
    ];

  } else {


    $submit = [
      'status' => 'gagal',
      'msg' => 'Terjadi kesalahan. Silakan hubungi admin.'
    ];
  }

} else {

  $submit = [
    'status' => 'gagal',
    'msg' => 'Terjadi kesalahan. Tidak ada data yang dikirimkan'
  ];

}

// Ambil kode pelajaran untuk link kembali
$pelajaran = findById($db, 'pelajaran INNER JOIN section USING (pelajaran_id)', 'section_id', $_POST['section_id'])->fetch(PDO::FETCH_ASSOC);

// define the title
define('PAGE_TITLE', 'Submit Kuis');

// Set page template
$pageTemplate = 'kuis-submit.html.php';
