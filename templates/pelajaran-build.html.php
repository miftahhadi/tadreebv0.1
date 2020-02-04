<div class="row">
  <div class="col-md-8">
    <h2><?=$pelajaran['pelajaran_nama']?></h2>
    <div class="card">
      <div class="card-header">
        <span class="card-title">Deskripsi</span>
      </div>
      <div class="card-body">
        <?=$pelajaran['pelajaran_deskripsi']?>
      </div>
    </div>
    <div class="card">
      <div class="card-header">Konten Pelajaran</div>
      <div class="card-body">
        <?php if (empty($sections)): ?>
          Belum ada konten pada pelajaran ini
        <?php else: ?>
        <ul class="list-group">
        <?php foreach ($sections as $section): ?>
          <li class="card-header list-group-item" id="heading_" data-toggle="collapse" data-target="#section_<?=$section['section_id']?>" aria-expanded="true" aria-controls="collapse1">
          <?=$section['section_nama']?>
          </li>
          <div id="section_<?=$section['section_id']?>" class="collapse">
            <div class="card card-body">
              <ul class="list-group list-group-transparent mb-0">
          <?php
          // Ambil semua file materi pada section ini
          $files = findById($db, 'upload INNER JOIN section_upload USING (upload_id)', 'section_id', $section['section_id'])->fetchAll();

          if (!empty($files)):
            foreach ($files as $file):
          ?>
                <li class="list-group-item list-group-item-action d-flex align-items-center active">
                  <span class="mr-3">
                    <i class="fe fe-inbox"></i>
                  </span>
                  <div>
                    <span class="m-0"><?=$file['upload_nama']?></span>
                  </div>
                </li>
          <?php
            endforeach;
          endif;

          // Ambil semua kuis pada section ini
          $kuiss = findById($db, 'kuis INNER JOIN section_kuis USING (kuis_id)', 'section_id', $section['section_id'])->fetchAll();

          if (!empty($kuiss)):
            foreach ($kuiss as $kuis):
          ?>
                <li class="list-group-item list-group-item-action d-flex align-items-center active">
                  <span class="mr-3">
                    <i class="fe fe-check-circle"></i>
                  </span>
                  <div>
                    <span class="m-0"><?=$kuis['kuis_nama']?></span>
                  </div>
                </li>
          <?php
            endforeach;
          endif;

          // Kalau belum ada konten file atau kuis
          if (empty($files) && empty($kuiss)) {
            echo 'Belum ada konten pada section ini';
          }
          ?>
                <div class="ml-auto">
                  <a href="index.php?page=pelajaran&action=editsection&id=<?=$_GET['id']?>&sectionId=<?=$section['section_id']?><?=(isset($_GET['kelasId'])) ? '&kelasId=' . $_GET['kelasId'] : ''?>" class="btn btn-primary btn-sm">Edit</a>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteSection_<?php //echo $section['section_id']; ?>">Hapus</button>
                </div>
              </ul>
            </div>
          </div>
        <?php endforeach; ?>
        <?php
        //}
        ?>
        </ul>
        <?php endif; ?>

      </div>
      <div class="card-footer">
        <a href="index.php?page=section&action=tambah&pelajaranId=<?=$pelajaran['pelajaran_id']?>" class="btn btn-primary btn-xs">Tambah Section</a>
      </div>
    </div>
  </div>
</div>
