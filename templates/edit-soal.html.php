<form action="" method="post">
  <div class="page-header">
    <h3 class="page-title"><?=$page['title']?> Soal</h3>
    <div class="ml-auto">
      <input type="submit" class="btn btn-success" name="<?=$page['submit']?>" value="Simpan">
      <a href="index.php?page=soal" class="btn btn-secondary">Batal</a>
    </div>
  </div>
  <!-- Soal -->
  <div class="card">
    <div class="card-header">
      Redaksi Soal
    </div>
    <div class="card-body">
      <label for="teksSoal" class="form-label">Tuliskan soal</label>
      <textarea class="form-control editor" id="teksSoal" name="soal[soal_redaksi]" rows="8"><?=(isset($_GET['id'])) ? $soal['soal_redaksi'] : '' ?></textarea>
    </div>
  </div>
  <!-- Jawaban -->
  <div class="card">
    <div class="card-header">
      Pilihan Jawaban
    </div>
    <div class="card-body" id="cardSoal">
      <?php
      if ($_GET['action'] == 'tambah'):
        for ($i=0; $i < 4; $i++):?>
      <div class="row" id="opsi_<?=$i?>">
        <div class="col-md-9">
          <label for="teksPil" class="form-label">Pilihan <?=$i+1?></label>
          <textarea class="form-control" id="teksPil_<?=$i?>" name="pilihan[<?=$i?>][teks]" rows='8'></textarea>
        </div>
        <div class='col-md-3'>
          <br>
          <div class='form-group'>
            <label for="nilaiBenar_<?=$i?>" class="form-label">Nilai jika benar</label>
            <input type="number" class="form-control" id="nilaiBenar_<?=$i?>" name="pilihan[<?=$i?>][nilai_benar]" value="0">
          </div>
          <div class="form-group">
            <label for="nilaiSalah_<?=$i?>" class="form-label">Nilai jika salah</label>
            <input type="number" class="form-control" id="nilaiSalah_<?=$i?>" name="pilihan[<?=$i?>][nilai_salah]" value="0">
          </div>
        </div>
      </div>
      <hr>
    <?php endfor;
    endif;

    // Kalau mode edit
    if ($_GET['action'] == 'edit'):

      $i = 0;

      foreach ($jawabans as $jawaban):
        // Set nilai
        $nilaiBenar = 0;
        $nilaiSalah = 0;

        if ($jawaban['nilai'] < 0 ) {
          $nilaiSalah = $jawaban['nilai'];
        }
        if ($jawaban['nilai'] > 0) {
          $nilaiBenar = $jawaban['nilai'];
        }
    ?>
    <div class="row" id="opsi_<?=$i?>">
      <div class="col-md-9">
        <label for="teksPil" class="form-label">Pilihan <?=$i+1?></label>
        <textarea class="form-control" id="teksPil_<?=$i?>" name="updatePilihan[<?=$i?>][teks]" rows='8'><?=$jawaban['teks_jawaban']?></textarea>
        <input type="hidden" name="updatePilihan[<?=$i?>][jawaban_id]" value="<?=$jawaban['jawaban_id']?>">
      </div>
      <div class='col-md-3'>
        <br>
        <div class='form-group'>
          <label for="nilaiBenar_<?=$i?>" class="form-label">Nilai jika benar</label>
          <input type="number" class="form-control" id="nilaiBenar_<?=$i?>" name="updatePilihan[<?=$i?>][nilai_benar]" value="<?=$nilaiBenar?>">
        </div>
        <div class="form-group">
          <label for="nilaiSalah_<?=$i?>" class="form-label">Nilai jika salah</label>
          <input type="number" class="form-control" id="nilaiSalah_<?=$i?>" name="updatePilihan[<?=$i?>][nilai_salah]" value="<?=$nilaiSalah?>">
        </div>
        <button type="button" class="btn btn-danger ml-2" data-toggle="modal" data-target="#hapusData" data-id=<?=$jawaban['jawaban_id']?>><span class="mr-2"><i class="fe fe-trash-2"></i></span>Hapus</button>
      </div>
    </div>
    <hr>
  <?php
      $i++;
    endforeach;
  endif; ?>
    </div>
  </div>
</form>
<div class="row">
  <div class="col-md-6">
    <button id="tambah_pilihan" class="btn btn-primary">Tambah Pilihan</button>
  </div>
</div>

<?php if ($_GET['action'] == 'edit'): ?>
<!-- Modal -->
<div class="modal fade" id="hapusData" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">Apakah Anda yakin?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <form action="delete.php" method="post">
          <input type="hidden" name="id" id="dataID">
          <input type="hidden" name="table" value="jawaban">
          <input type="hidden" name="primaryKey" value="jawaban_id">
          <input type="hidden" name="page" value="soal&action=edit&id=<?=$_GET['id']?>">
          <input type="submit" class="btn btn-danger" value="Hapus">
        </form>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- Add new option -->
<script>
$(document).ready(function() {
let $idPilihan = <?=$i?>;

$(document).on('click', '#tambah_pilihan', function() {
  $urutan = $idPilihan + 1;

  $formJawaban = "<div class='row'>\n";
  $formJawaban += "<div class='col-md-9'>\n";
  $formJawaban += "<label for='teksPil" + $idPilihan +"' class='form-label'>Pilihan " + $urutan + "</label>\n";
  $formJawaban += "<textarea class='form-control editor' id='teksPil" + $idPilihan + "' name='pilihan[" + $idPilihan + "][teks]' rows='8'></textarea>\n";
  $formJawaban += "</div>\n";
  $formJawaban += "<div class='col-md-3'>\n";
  $formJawaban += "<br>\n";

  $formJawaban += "<div class='form-group'>\n";
  $formJawaban += "<label for='nilaiBenar_" + $idPilihan + "' class='form-label'>Nilai jika benar</label>\n";
  $formJawaban += "<input type='number' class='form-control' id='nilaiBenar_" + $idPilihan + "' name='pilihan[" + $idPilihan + "][nilai_benar]' value='0'>\n";
  $formJawaban += "</div>\n";
  $formJawaban += "<div class='form-group'>\n";
  $formJawaban += "<label for='nilaiSalah_" + $idPilihan + "' class='form-label'>Nilai jika salah</label>\n";
  $formJawaban += "<input type='number' class='form-control' id='nilaiSalah_" + $idPilihan + "' name='pilihan[" + $idPilihan + "][nilai_salah]' value='0'>\n";
  $formJawaban += "</div>\n";
  $formJawaban += "</div>\n";
  $formJawaban += "</div>\n";
  $formJawaban += "<hr>\n";

  $('#cardSoal').append($formJawaban);
  $idPilihan = $idPilihan + 1;

  CKEDITOR.replaceAll();

  });

});
</script>

<!-- Call the CKEditor -->
<script>
  CKEDITOR.replaceAll();
</script>

<!-- Modal - Konfirm hapusData -->
<script>
  $('#hapusData').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget) // Button that triggered the modal
  let id = button.data('id') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  let modal = $(this)
  modal.find('.modal-footer #dataID').val(id)
  })
</script>
