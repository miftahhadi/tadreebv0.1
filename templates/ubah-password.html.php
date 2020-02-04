<div class="row d-flex justify-content-center">
  <!-- Content-->
  <div class="col-md-6">
    <?php
    if (!empty($error)){
      foreach ($error as $key => $value) {
        echo alert('gagal', $value);
      }
    }
    ?>
    <?php if ($area == 'admin'): ?>
    <h4>Ubah Password:</h4>
    <h3><?=$user['username']?> (<?=$user['nama']?>)</h3>
    <?php endif; ?>
    <form class="card" action="" method="post">
      <div class="card-header">
        <h3 class="card-title">Ubah Password</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <?php if ($area == 'front'): ?>
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-label">Masukkan password lama</label>
              <input type="password" class="form-control" name="user[password_lama]">
            </div>
          </div>
          <?php endif; ?>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">Password baru</label>
              <input type="password" class="form-control" name="user[password1]">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">Ulangi password baru</label>
              <input type="password" class="form-control" name="user[password2]">
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer text-right">
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="<?=$backLink?>" class="btn btn-secondary">Kembali</a>
      </div>
    </form>
  </div>
</div>
