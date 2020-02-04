<div class="row d-flex justify-content-center">
  <!-- Content-->
  <div class="col-md-9">
    <?php
    if (isset($_SESSION['msg'])):
      echo alert($_SESSION['status'], $_SESSION['msg'],1);
      unset($_SESSION['msg']);
      unset($_SESSION['status']);
    endif; ?>
    <form class="card" action="" method="post">
      <div class="card-header">
        <h3 class="card-title">Edit Profil</h3>
        <a href="./index.php?page=ubah-password" class="btn btn-primary ml-auto">Ubah Password</a>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-label">Nama<span class="form-required">*</span></label>
              <input type="text" class="form-control" name="user[nama]" value="<?=$user['nama']?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" name="user[username]" value="<?=$user['username']?>" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="form-label">Jenis Kelamin<span class="form-required">*</span></label>
              <select name="user[jenis_kelamin]" id="jenis_kelamin" class="form-control custom-select">
                <?php foreach ($genders as $gender): ?>
                <option value="<?=$gender?>" <?=isset($user) && $user['jenis_kelamin'] == $gender ? 'selected' : ''?>><?=$gender?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="form-label">Tanggal Lahir</label>
              <input type="date" class="form-control" name="user[tanggal_lahir]" placeholder="Masukkan tanggal lahir" value="<?=$user['tanggal_lahir'] ?? ''?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="form-label">Angkatan</label>
              <input type="text" class="form-control" value="<?=$user['angkatan_nama']?>" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="form-label">Kelas</label>
              <input type="text" class="form-control" value="<?=$kelas['kelas_nama']?>" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="form-label">Domisili</label>
              <input type="text" class="form-control" name="user[domisili]" value="<?=$user['domisili']?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="form-label">Pekerjaan</label>
              <input type="text" class="form-control" name="user[pekerjaan]" value="<?=$user['pekerjaan']?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="user[email]" value="<?=$user['email']?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="form-label">Nomor WhatsApp<span class="form-required">*</span></label>
              <input type="text" class="form-control" name="user[nomor]" value="<?=$user['nomor']?>">
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer text-right">
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="." class="btn btn-secondary">Kembali</a>
      </div>
    </form>
  </div>
</div>
