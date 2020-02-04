<h4></h4>
<h2><?php // echo $pageTitle; ?></h2>
<div class="row">
  <div class="col-md-8">
    <h3><?=$kuis['kuis_nama']?></h3>
    <div class="card">
      <div class="card-header">
        Deskripsi
      </div>
      <div class="card-body">
        <?=$kuis['kuis_deskripsi']?>
      </div>
    </div>
    <hr>
    <?php
    $i = 1;
    foreach ($soall as $soal):
      $jawabann = findById($db, 'jawaban', 'soal_id', $soal['soal_id'])->fetchAll();
     ?>
    <div class="card">
      <div class="card-header"><b>Soal <?=$i?></b></div>
      <div class="card-body">
        <?=$soal['soal_redaksi']?>
        <ul class="list-group list-group-transparent mb-0">
          <?php foreach ($jawabann as $jawaban): ?>
            <?php
            if ($jawaban['benar'] == 1) {
              $color = 'info';
              $icon = 'check-circle';
            } else {
              $color = 'danger';
              $icon = 'times-circle';
            }
             ?>
          <li class="list-group-item list-group-item-action d-flex">
            <span class="text-<?=$color?> mr-3"><i class="fa fa-<?=$icon?> text-<?=$color?>"></i></span> <?=$jawaban['teks_jawaban']?>
            <span class="ml-auto">Nilai: <?=$jawaban['nilai']?></span>
          </li>
          <?php endforeach; ?>
        </ul>
        <div class="text-right">
          <a href="index.php?page=soal&action=edit&id=<?=$soal['soal_id']?>" class="btn btn-primary"><span class="mr-2"><i class="fe fe-cloud-lightning"></i></span>Edit</a>
          <button type="button" class="btn btn-danger ml-2" data-toggle="modal" data-target="#hapusData" data-id="<?=$soal['soal_id']?>" data-kuis=<?=$_GET['id']?>><span class='mr-2'><i class='fa fa-unlink'></i></span>Buang</button>
        </div>
      </div>
    </div>
  <?php
  $i++;
  endforeach; ?>
    <a href="index.php?page=kuis&action=build&id=<?=$_GET['id']?>&assign=soal" class="btn btn-info btn-xs">Tambah Soal dari Database</a>
    <a href="index.php?page=soal&action=tambah&kuisId=<?=$_GET['id']?>" class="btn btn-info btn-xs">Buat Soal Baru</a>
    <a href="index.php?page=kuis" class="btn btn-secondary">Kembali</a>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="hapusData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        Anda yakin ingin menghapus item ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <form action="delete.php" method="post">
          <input type="hidden" name="id" id="dataID">
          <input type="hidden" name="table" value="soal">
          <input type="hidden" name="primaryKey" value="soal_id">
          <input type="hidden" name="page" id="kuisID">
          <input type="submit" class="btn btn-danger" value="Hapus">
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $('#hapusData').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget) // Button that triggered the modal
  let id = button.data('id') // Extract info from data-* attributes
  let kuisId = button.data('kuis')
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  let modal = $(this)
  modal.find('.modal-footer #dataID').val(id)
  modal.find('.modal-footer #kuisID').val('kuis&action=build&id=' + kuisId)
  })
</script>
