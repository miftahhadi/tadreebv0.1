<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="">Daftar Pelajaran</a></li>
    <li class="breadcrumb-item"><a href="#"><?=$pelajaran['pelajaran_nama']?></a></li>
  </ol>
</nav>
<h2><?=$section['section_nama']?></h2>
<div class="row">
  <div class="col-md-8">
    <?=(isset($message)) ? alert($status, $message,1) : (isset($_SESSION['msg'])) ? alert($_SESSION['status'], $_SESSION['msg'],1) : ''?>
    <div class="card">
      <div class="card-header">Deskripsi
      </div>
      <div class="card-body">
        <?=$section['section_deskripsi']?>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Konten Section</h3>
      </div>
      <div class="card-body">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">File Pelajaran</h3>
          </div>
          <!-- List file -->
          <div class="card-body">
            <div class="list-group list-group-transparent mb-0">
              <?php
              if (!empty($files)):
                foreach ($files as $file):
                  // Set icon
                  if (strpos($file['upload_tipe'], 'audio') !== false) {
                    $icon = "play";
                  }

                  if (strpos($file['upload_tipe'], 'pdf') !== false || strpos($file['upload_tipe'], 'word') !== false) {
                    $icon = "file-text";
                  }

                  $ukuran = round(($file['upload_ukuran'] / 1000000), 2);
        				  $url = '/../upload' . $file['upload_url'];

              ?>
              <div class="list-group-item list-group-item-action d-flex align-items-center active">
                <div class="d-flex align-items-center">
                  <span class="stamp stamp-md bg-blue mr-3">
                    <i class="fe fe-<?=$icon?>"></i>
                  </span>
                  <div>
                    <h4 class="m-0"><a href="<?=$url?>"><?=$file['upload_judul']?></a></h4>
                    <small class="text-muted">Ukuran: <?=$ukuran?> MB</small>
                  </div>
                </div>
                <span class="ml-auto">
                  <?php if (isset($_GET['kelasId'])): ?>
                  <a href="index.php?page=pelajaran&action=editsection&id=<?=$_GET['id']?>&sectionId=<?=$_GET['sectionId']?>&kelasId=<?=$_GET['kelasId']?>&setting=konten&kontenId=<?=$file['upload_id']?>" class="btn btn-sm text-primary"><i class="fe fe-settings"></i></a>
                  <?php else: ?>
                  <a href="#unlinkFile_" class="btn btn-sm text-danger" data-toggle="modal"><i class="fa fa-unlink"></i></a>
                  <?php endif; ?>
                </span>
              </div>
              <?php
                endforeach;
              else:
              ?>
              <p>Tidak ada file untuk section ini</p>
              <?php
              endif;
              ?>
            </div>
          </div>
        </div>
        <!-- List Kuis -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Kuis</h3>
          </div>
          <div class="card-body">
            <div class="list-group list-group-transparent mb-0">
              <?php
              if (!empty($kuiss)):
                foreach ($kuiss as $kuis):
              ?>
              <div class="list-group-item list-group-item-action d-flex align-items-center active">
                <div class="d-flex align-items-center">
                  <span class="stamp stamp-md bg-blue mr-3">
                    <i class="fe fe-cloud-lightning"></i>
                  </span>
                  <div>
                    <h4 class="m-0"><a href=""><?=$kuis['kuis_nama']?></a></h4>
                  </div>
                </div>
                <span class="ml-auto">
                  <?php if (isset($_GET['kelasId'])): ?>
                  <a href="index.php?page=pelajaran&action=editsection&id=<?=$_GET['id']?>&sectionId=<?=$_GET['sectionId']?>&kelasId=<?=$_GET['kelasId']?>&setting=kuis&kuisId=<?=$kuis['kuis_id']?>" class="btn btn-sm text-primary"><i class="fe fe-settings"></i></a>
                  <?php else: ?>
                  <a href="" class="btn btn-sm text-primary"><i class="fe fe-edit-3"></i></a>
                  <a href="" class="btn btn-sm text-danger" data-toggle="modal"><i class="fa fa-unlink"></i></a>
                  <?php endif; ?>
                </span>
              </div>
              <?php
                endforeach;
              else:
              ?>
              <p>Tidak ada kuis untuk section ini</p>
              <?php
              endif;
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="col-md-6">
          <h4>Tambah Objek</h4>
          <ul class="list-group list-group-transparent mb-0">
            <?php foreach ($objeks as $objek): ?>
              <li class="list-group-item list-group-item-action d-flex align-items-center active">
                <span class="mr-3">
                  <i class="fe fe-<?=$objek['icon']?>"></i>
                </span>
                <a href="index.php?page=pelajaran&action=editsection&id=<?=$_GET['id']?>&sectionId=<?=$_GET['sectionId']?>&assign=<?=$objek['jenis']?>"><?=ucfirst($objek['jenis'])?></a>
                <div>
                  <span class="m-0"></span>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
    <a href="index.php?page=pelajaran&action=build&id=<?=$_GET['id']?>" class="btn btn-secondary">Kembali</a>
  </div>
  <?php if (isset($_GET['kelasId'])): ?>
  <!-- Setting -->
  <div class="col-md-4">
  <?php include __DIR__ . '/setting-template.html.php'; ?>
  </div>
  <?php endif; ?>
</div>
