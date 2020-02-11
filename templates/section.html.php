<div class="row d-flex justify-content-center">
<!-- Content-->
  <div class="col-md-9">
    <nav aria-label="breadcrumb"> <ol class="breadcrumb"> <li class="breadcrumb-item"><a href=".">Halaman Depan</a></li><li class="breadcrumb-item"><a href="pelajaran.php?id=1&kelas=1"><?=$pelajaran['pelajaran_nama']?></a></li></ol></nav>
    <div class="card">
      <div class="card-body">
        <h2 class="mt-0 mb-4"><?=htmlspecialchars($section['section_nama'])?></h2>
        <p><?=htmlspecialchars($section['section_deskripsi'])?></p>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Konten Pelajaran</h3>
          </div>
          <div class="card-body">
            <div class="list-group list-group-transparent mb-0">
              <!-- File Dokumen dan Audio -->
              <?php foreach ($files as $file): ?>
                <?php if ($file['tampil'] == 1): ?>
              <div class="list-group-item list-group-item-action d-flex align-items-center active">
                <div class="d-flex align-items-center">
                  <span class="stamp stamp-md bg-blue mr-3">
                    <i class="fe fe-<?=(strpos($file['upload_tipe'], 'pdf') !== false || strpos($file['upload_tipe'], 'word') !== false) ? 'file-text': (strpos($file['upload_tipe'], 'audio') !== false ? 'play' : '') ?>"></i>
                  </span>
                  <div>
                    <h4 class="m-0"><a <?=($file['buka'] == 1) ? 'href="' . UPLOAD_FOLDER . $file['upload_url'] . '"' : '' ?>><?=$file['upload_judul']?></a></h4>
                    <small class="text-muted">Ukuran: <?=round($file['upload_ukuran']/1000000,2)?> MB</small>
                  </div>
                </div>
              </div>
              <?php endif; ?>
              <?php endforeach; ?>
              <!-- Kuis -->
              <?php
              foreach ($kuiss as $kuis):
                // Jika ada kuis, cek apakah peserta sudah mengerjakan atau belum
                $kuisPeserta->execute([
                  'user_id' => $_SESSION['user_id'],
                  'kuis_id' => $kuis['kuis_id'],
                  'section_id' => $_GET['section'],
                  'kelas_id' =>$_GET['kelas']
                ]);
                $kuis['done'] = $kuisPeserta->fetch(PDO::FETCH_ASSOC)['waktu_submit'];

                // Tampilkan daftar kuis
                if ($kuis['tampil'] == 1):
              ?>
              <div class="list-group-item list-group-item-action d-flex align-items-center active">
                <span class="stamp stamp-md bg-blue mr-3">
                  <i class="fa fa-flash"></i>
                </span>
                <div>
                  <h4 class="m-0">
                    <a <?=($kuis['buka']) ? 'href="./index.php?page=pelajaran&lesson=' . $kodePelajaran . '&kelas=' . $_GET['kelas'] . '&section=' . $_GET['section'] . '&kuis=' . $kuis['kuis_id'] . '"' : ''?>><?=$kuis['kuis_nama']?></a>
                  </h4>
                  <!-- Sudah dikerjakan? -->
                  <div class="tag tag-<?=!is_null($kuis['done']) ? 'azure' : 'dark'?>">
                    <?=!is_null($kuis['done']) ? 'Sudah dikerjakan' : 'Belum dikerjakan'?>
                    <span class="tag-addon <?=!is_null($kuis['done']) ? '' : 'tag-warning'?>"><i class="fa fa-<?=!is_null($kuis['done']) ? 'check-circle' : 'warning'?>"></i></span>
                  </div>
                  <!-- Lihat hasil kalau sudah dikerjakan -->
                  <?php if (!is_null($kuis['done'])): ?>
                    <div class="tag tag-dark"><a href="index.php?page=pelajaran&lesson=<?=$kodePelajaran?>&kelas=<?=$_GET['kelas']?>&section=<?=$_GET['section']?>&hasil=<?=$kuis['kuis_id']?>" class="text-white">Lihat Hasil</a> <span class="tag-addon tag-success"><i class="fa fa-bar-chart"></i></span></div>
                  <?php endif; ?>
                </div>
                <span class="ml-auto">
                  <i class='fa fa-<?=($kuis['buka'] == 1) ? 'unlock': 'lock'?>'></i>
                </span>
              </div>
              <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
