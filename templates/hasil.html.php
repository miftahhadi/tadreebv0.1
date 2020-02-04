<?php
// Set variabel i untuk jadi urutan soal
$i = 1;
?>
<h2>Hasil Tugas - <?=$kuis['kuis_nama']?></h2>
<div class="row">
	<div class="col-md-8">
    <?php
    $nilai = [];
    foreach ($daftarSoal as $soal):

      // Ambil semua pilihan jawaban
      $stmtPilihan->execute(['soal_id' => $soal['soal_id']]);
      $pilihans = $stmtPilihan->fetchAll();

      // Ambil semua jawaban peserta
      $data['soal_id'] = $soal['soal_id'];
      $stmtJawaban->execute($data);
      $soal['jawaban_peserta'] = $stmtJawaban->fetchAll();

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

					// Default properties untuk tampilan jawaban
					$alert = "alert-secondary";
					$teks = "";
					$icon = "fa fa-puzzle-piece";

          // Tandai mana jawaban peserta
					if (in_array($pilihan['jawaban_id'], $soal['jawaban_peserta'])) {
            $alert = "alert-primary";
            $teks = "Jawaban Anda:";
            $icon = "fa fa-tags";
          }

          // Set tampilan jika hasil sudah dibuka
          if ($kuis['buka_hasil'] == 1) {
            foreach ($soal['jawaban_peserta'] as $jwbPeserta) {

              if (in_array($pilihan['jawaban_id'], $jwbPeserta) && $pilihan['benar'] == 1) {
                $alert = "alert-primary";
                $teks = "Jawaban Anda:";
                $icon = "fa fa-check-circle";
                array_push($nilai, $pilihan['nilai']);
              } else if (in_array($pilihan['jawaban_id'], $jwbPeserta) && $pilihan['benar'] == 0)  {
                $alert = "alert-danger";
                $teks = "Jawaban Anda:";
                $icon = "fa fa-times-circle";
                array_push($nilai, $pilihan['nilai']);
              } else if (!in_array($pilihan['jawaban_id'], $jwbPeserta) && $pilihan['benar'] == 1)  {
                $alert = "alert-success";
                $teks = "Jawaban Benar:";
                $icon = "fa fa-check-circle";
              } else if (!in_array($pilihan['jawaban_id'], $jwbPeserta)) {
                $alert = "alert-secondary";
                $teks = "";
                $icon = "fa fa-puzzle-piece";
              }

            }
          }
        ?>
        <div class="alert <?=$alert?>">
          <?=!empty($teks) ? '<h6>' . $teks . '</h6>': ''?>
          <i class="<?=$icon?> mr-2" aria-hidden="true"></i> <?=$pilihan['teks_jawaban']?>
          <div class="ml-auto"><b>Nilai: <?=$pilihan['nilai']?></b></div>
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
	  <div class="card-body">
		  <h3 class="text-center">Nilai Anda:</h3>
			<h1 class="text-center"><?=array_sum($nilai)?></h1>
		</div>
	</div>
</div>
</div>
