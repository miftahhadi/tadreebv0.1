<div class="row d-flex justify-content-center">
  <div class="col-md-9">
    <form action="./index.php?page=kuis-submit" method="post" id="kuis">
      <h3 class="text-center"><?=$kuis['kuis_nama']?></h3>
      <div class="row">
        <?php
        $i = 1;
        foreach ($soalan as $soal):
          // Ambil daftar jawaban
          $stmtPilihan->execute(['soal_id' => $soal['soal_id']]);
          $jawabans = $stmtPilihan->fetchAll()
        ?>
        <div class="card">
          <div class="card-header">
            Soal <?=$i?>
          </div>
          <div class="card-body">
            <?=$soal['soal_redaksi']?>
            <input type="hidden" name="soal[<?=$soal['soal_id']?>][soal_id]" value="<?=$soal['soal_id']?>">
              <div class="form-group">
                <div class="custom-controls-stacked">
                  <?php foreach ($jawabans as $jawaban): ?>
                  <label class="custom-control custom-<?=$soal['soal_tipe'] == 'Pilihan Ganda' ? 'radio' : 'checkbox'?>">
                    <input type="<?=$soal['soal_tipe'] == 'Pilihan Ganda' ? 'radio' : 'checkbox'?>" class="custom-control-input" name="soal[<?=$soal['soal_id']?>][jawaban][]" value="<?=$jawaban['jawaban_id']?>">
                    <div class="custom-control-label"><?=$jawaban['teks_jawaban']?></div>
                  </label>
                <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
          <?php
          $i++;
          endforeach;
          ?>
          <input type="hidden" name="kuis_id" value="<?=$_GET['kuis']?>">
          <input type="hidden" name="kelas_id" value="<?=$_GET['kelas']?>">
          <input type="hidden" name="section_id" value="<?=$_GET['section']?>">
          <input type="hidden" name="attempt" value="1">
          <input type="submit" class="btn btn-info btn-xs" name="kirim" value="Selesai">
      </div>
    </form>
  </div>
</div>

<!-- END MAIN CONTENT -->
