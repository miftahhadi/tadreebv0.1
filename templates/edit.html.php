<h3 class="page-title"><?php echo ucfirst($_GET['action']) . ' ' . ucfirst($page); ?></h3>
<div class="row">
  <div class="col-md-8">
    <form action="" method="post">
      <div class="card">
        <div class="card-body">
            <!-- Nama Entry -->
            <div class="form-group">
              <label for="nama_<?php echo $page; ?>" class="form-label">Nama <?php echo ucfirst($page); ?></label>
              <input type="text" id="nama_<?php echo $page; ?>" name="data[<?=$pageData[$page]['insertTable']?>_nama]" class="form-control" value="<?=(isset($_GET['id'])) ? $data[$dataName] : '' ?>">
            </div>
            <!-- Kalau page== pelajaran, tambah field kode pelajaran -->
            <?php if ($page == 'pelajaran'): ?>
              <div class="form-group">
                <label for="kode_<?php echo $page; ?>" class="form-label">Kode <?php echo ucfirst($page); ?></label>
                <input type="text" id="kode_<?php echo $page; ?>" name="data[<?=$pageData[$page]['insertTable']?>_kode]" class="form-control" value="<?=(isset($_GET['id'])) ? $data[$dataKode] : '' ?>">
              </div>
            <?php endif; ?>
            <!-- Kalau page == pelajaran atau kelas, tambah pilihan kategori/angkatan -->
            <?php if ($page == "pelajaran" || $page == "kelas"): ?>
            <div class="form-group">
              <label class="form-label" for="pilih-<?=$pageData[$page]['parent']?>"><?=ucfirst($pageData[$page]['parent'])?></label>
              <select name="data[<?=$pageData[$page]['parent']?>_id]" id="pilih-<?=$pageData[$page]['parent']?>" class="form-control custom-select">
                <?php foreach ($parent as $key): ?>
                <option value="<?=$key[$parentID]?>" <?php if (isset($data) && $key[$parentID] == $data[$dataParent]) { echo ' selected'; } ?>><?=$key[$parentName]?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <?php endif; ?>

            <!-- Deskripsi -->
            <div class="form-group">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <textarea id="deskripsi" name="data[<?=$pageData[$page]['insertTable']?>_deskripsi]" class="form-control"><?=(isset($_GET['id'])) ? $data[$dataDesc] : '' ?></textarea>
            </div>
        </div>
        <div class="card-footer text-right">
          <?php if (isset($_GET['id'])): ?>
          <input type="hidden" name="id" value="<?=$_GET['id']?>">
          <?php endif; ?>
          <input type="submit" class="btn btn-success" name="<?=$submit?>" value="Simpan">
          <a href="index.php?page=<?=$page?>" class="btn btn-secondary">Batal</a>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- END MAIN CONTENT -->
