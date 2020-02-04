<?php

if (isset($submit)) {
  if ($submit['status'] == 'sukses') {
    $submit['color'] = 'primary';
    $submit['icon'] = 'check-circle';
    $submit['title'] = 'Berhasil!';
  } elseif ($submit['status'] == 'gagal') {
    $submit['color'] = 'danger';
    $submit['icon'] = 'alert-circle';
    $submit['title'] = 'Gagal!';  }
}

?>
<div class="text-center">
  <div class="alert alert-icon alert-<?=$submit['color']?>" role="alert">
    <h4><i class="fe fe-<?=$submit['icon']?> mr-2" aria-hidden="true"></i><?=$submit['title']?></h4>
    <?=$submit['msg']?>
  </div>

  <a href="./index.php?page=pelajaran&lesson=<?=$pelajaran['pelajaran_kode']?>&kelas=<?=$_POST['kelas_id']?>&section=<?=$_POST['section_id']?>" class="btn btn-primary">Kembali ke Pelajaran</a>
</div>
