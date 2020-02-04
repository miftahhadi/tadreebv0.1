<div class="row d-flex justify-content-center">
  <div class="col-md-12">
    <h1>Ahlan! Selamat Datang di <?=SITE_NAME?></h1>
    <div class="alert alert-primary alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"></button>
        Anda masuk sebagai <b><?=$_SESSION['nama']?></b>. <a href="./index.php?page=profil" class="btn btn-primary btn-sm btn-square">Edit profil</a>
    </div>
    <?php
    foreach ($kelass as $kelas):
      $pelajarans = findById($db, 'pelajaran INNER JOIN kelas_pelajaran USING  (pelajaran_id)', 'kelas_id', $kelas['kelas_id'])->fetchAll();
    ?>
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"><?=htmlspecialchars($kelas['kelas_nama'])?></h4>
      </div>
    </div>
    <div class='row row-cards row-deck'>
      <?php foreach ($pelajarans as $pelajaran): ?>
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"><?=htmlspecialchars($pelajaran['pelajaran_nama'])?></h4>
          </div>
          <div class="card-body">
            <p class="card-text"><?=htmlspecialchars($pelajaran['pelajaran_deskripsi'])?></p>
            <a href="./index.php?page=pelajaran&lesson=<?=$pelajaran['pelajaran_kode']?>&kelas=<?=$kelas['kelas_id']?>" class="btn btn-primary">Masuk</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
  </div>
</div>
