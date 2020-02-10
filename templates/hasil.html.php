<?php
// Set variabel i untuk jadi urutan soal
$i = 1;
?>
<?php if ($area == 'admin'): ?>
	<?php if (!empty($monitorNav)): ?>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<?php foreach ($monitorNav as $nav): ?>
				<li class="breadcrumb-item"><a href="<?=$nav['link']?>"><?=$nav['item']?></a></li>
				<?php endforeach; ?>
			</ol>
		</nav>
	<?php endif; ?>
<?php endif; ?>

<h2>Hasil Tugas - <?=$kuis['kuis_nama']?></h2>

<div class="row">
	<div class="col-md-8">
		<?php if ($area=='admin'): ?>
		<div class="alert alert-primary">
			Nama Peserta: <b><?=$peserta['nama']?> (<?=$peserta['username']?>)</b>
		</div>
		<?php endif; ?>
		<?php if ($kuis['buka_hasil'] != 1): ?>
		<div class="alert alert-icon alert-danger" role="alert">
			<i class="fe fe-alert-circle mr-2" aria-hidden="true"></i> Kunci jawaban belum dibuka.
		</div>
		<?php
		endif;

		// Array untuk nilai total peserta
    $nilai = [];
		// Array untuk nilai total kuis
		$nilaiKuis = [];

    foreach ($daftarSoal as $soal):

      // Ambil semua pilihan jawaban
      $stmtPilihan->execute(['soal_id' => $soal['soal_id']]);
      $pilihans = $stmtPilihan->fetchAll(PDO::FETCH_ASSOC);

      // Ambil semua jawaban peserta
      $data['soal_id'] = $soal['soal_id'];
      $stmtJawaban->execute($data);
      $soal['jawaban_peserta'] = $stmtJawaban->fetchAll(PDO::FETCH_COLUMN);
    ?>
	  <div class="card">
      <div class="card-header">
        Soal <?=$i?>
      </div>
		  <div class="card-body">
  		  <?=$soal['soal_redaksi']?>
      </div>
      <div class="card-footer list-group list-group-transparent mb-0">
        <?php
        foreach ($pilihans as $pilihan):

					// Kalau pilihan jawaban benar, masukkan ke array nilaiKuis
					if ($pilihan['benar'] == 1) {
						array_push($nilaiKuis, $pilihan['nilai']);
					}

					// Default properties untuk tampilan jawaban
					$alert = 'alert-secondary';
					$teks = '';
					$icon = 'fa fa-puzzle-piece';

          // Tandai mana jawaban peserta
					if (in_array($pilihan['jawaban_id'], $soal['jawaban_peserta'])) {
            $alert = "alert-primary";
            $teks = ($area == 'front') ? "Jawaban Anda:" : "Jawaban Peserta";
            $icon = "fa fa-tags";
          }

          // Set tampilan jika hasil sudah dibuka
          if ($kuis['buka_hasil'] == 1) {

            if (in_array($pilihan['jawaban_id'], $soal['jawaban_peserta']) && $pilihan['benar'] == 1) {

              $alert = "alert-primary";
              $teks = ($area == 'front') ? "Jawaban Anda:" : "Jawaban Peserta";
              $icon = "fa fa-check-circle";
              array_push($nilai, $pilihan['nilai']);

            } else if (in_array($pilihan['jawaban_id'], $soal['jawaban_peserta']) && $pilihan['benar'] == 0)  {

              $alert = "alert-danger";
              $teks = ($area == 'front') ? "Jawaban Anda:" : "Jawaban Peserta";
              $icon = "fa fa-times-circle";

							// Tambah nilai peserta ke array nilai peserta
              array_push($nilai, $pilihan['nilai']);

            } else if (!in_array($pilihan['jawaban_id'], $soal['jawaban_peserta']) && $pilihan['benar'] == 1)  {

              $alert = "alert-success";
              $teks = "Jawaban Benar:";
              $icon = "fa fa-check-circle";

            } else if (!in_array($pilihan['jawaban_id'], $soal['jawaban_peserta'])) {

              $alert = "alert-secondary";
              $teks = "";
              $icon = "fa fa-puzzle-piece";

            }
          }
        ?>
        <div class="alert <?=$alert?>">
          <?=!empty($teks) ? '<h6>' . $teks . '</h6>': ''?>
          <i class="<?=$icon?> mr-2" aria-hidden="true"></i> <?=$pilihan['teks_jawaban']?>
					<?php if ($kuis['buka_hasil'] == 1): ?>
					<div class="ml-auto"><b>Nilai: <?=$pilihan['nilai']?></b></div>
					<?php endif; ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php
    $i++;
    endforeach;
    ?>
  </div>
<div class="col-md-4">
  <div class="card">
	  <div class="card-body text-center">
		  <h3>Nilai <?=($area == 'admin') ? 'Peserta' : 'Admin'?>:</h3>
			<h1><?=$kuis['buka_hasil'] == 1 ? array_sum($nilai) : '-'?></h1>
			<p>Nilai Total Tugas = <b><?=$kuis['buka_hasil'] == 1 ? array_sum($nilaiKuis) : '-'?></b></p>
		</div>
	</div>
</div>
</div>
