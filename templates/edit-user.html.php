<h3><?=$title?></h3>
<div class="row">
  <div class="col-md-8">
    <?php
    // Ada error, tampilkan
    echo (!empty($error) ? alert('gagal', 'Terdapat kesalahan pengisian data. Mohon diperbaiki') : '');

    // Ada pesan Session, tampilkan
    if (isset($_SESSION['msg'])) {

      echo alert($_SESSION['status'], $_SESSION['msg'], 1);

      // Hapus pesan session
      unset($_SESSION['msg']);
      unset($_SESSION['status']);

    }
    ?>
    <form action="" method="post">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <!-- Nama -->
            <div class="col-md-8">
              <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="user[nama]" placeholder="Masukkan nama" value="<?=($user['nama']) ?? ''?>">
              </div>
            </div>
            <!-- Username -->
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" class="form-control <?=(isset($error['username'])) ? 'is-invalid' : ''?>" name="user[username]" placeholder="Masukkan username" value="<?=($user['username']) ?? ''?>">
                <?php if (isset($error['username'])): ?>
                <div class="invalid-feedback"><?=$error['username']?></div>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-4">
              <!-- Password -->
              <div class="form-group">
                <label class="form-label">Password</label>
                <?php if ($_GET['action'] == 'tambah'): ?>
                <input type="password" class="form-control <?=(isset($error['password'])) ? 'is-invalid' : ''?>" name="user[password]" placeholder="Masukkan password">
                  <?php if (isset($error['password'])): ?>
                  <div class="invalid-feedback"><?=$error['password']?></div>
                  <?php endif; ?>
                <?php else: ?>
                <a href="index.php?page=user&action=ubah-password&id=<?=$_GET['id']?>" class="btn btn-secondary">Ganti password</a>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-4">
              <!-- Role -->
              <div class="form-group">
                <label class="form-label">Role</label>
                <select name="user[role]" id="role" class="form-control custom-select">
                  <?php foreach ($roles as $role): ?>
                  <option value="<?=$role?>" <?=isset($user) && $user['role'] == $role ? 'selected' : ''?>><?=$role?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <!-- Angkatan -->
              <div class="form-group">
                <label class="form-label">Angkatan</label>
                <select name="user[angkatan_id]" id="angkatan" class="form-control custom-select">
                  <?php foreach ($listAngkatan as $angkatan): ?>
                  <option value="<?=$angkatan['angkatan_id']?>" <?=isset($user) && $user['angkatan_id'] == $angkatan['angkatan_id'] ? 'selected' : ''?>><?=$angkatan['angkatan_nama']?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <!-- Jenis Kelamin -->
              <div class="form-group">
                <label class="form-label">Jenis Kelamin</label>
                <select name="user[jenis_kelamin]" id="jenis_kelamin" class="form-control custom-select">
                  <?php foreach ($genders as $gender): ?>
                  <option value="<?=$gender?>" <?=isset($user) && $user['jenis_kelamin'] == $gender ? 'selected' : ''?>><?=$gender?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <!-- Tanggal Lahir -->
              <div class="form-group">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" name="user[tanggal_lahir]" placeholder="Masukkan tanggal lahir" value="<?=$user['tanggal_lahir'] ?? ''?>">
              </div>
            </div>
            <div class="col-md-4">
              <!-- Email -->
              <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="user[email]" placeholder="Masukkan email" value="<?=$user['email'] ?? ''?>">
              </div>
            </div>
            <div class="col-md-4">
              <!-- Nomor handphone -->
              <div class="form-group">
                <label class="form-label">Nomor WhatsApp</label>
                <input type="text" class="form-control <?=(isset($error['nomor'])) ? 'is-invalid' : ''?>" name="user[nomor]" placeholder="Masukkan nomor WhatsApp" value="<?=$user['nomor'] ?? ''?>">
                <?php if (isset($error['nomor'])): ?>
                <div class="invalid-feedback"><?=$error['nomor']?></div>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-4">
              <!-- Domisili -->
              <div class="form-group">
                <label class="form-label">Domisili</label>
                <input type="text" class="form-control" name="user[domisili]" placeholder="Masukkan domisili" value="<?=$user['domisili'] ?? ''?>">
              </div>
            </div>
            <div class="col-md-4">
              <!-- Pekerjaan -->
              <div class="form-group">
                <label class="form-label">Pekerjaan</label>
                <input type="text" class="form-control" name="user[pekerjaan]" placeholder="Tuliskan pekerjaan" value="<?=$user['pekerjaan'] ?? ''?>">
              </div>
            </div>
          </div>
        </div>
      </div> <!-- card -->
      <input type="submit" class="btn btn-success" name="<?=$button?>" value="Simpan">
      <a href="index.php?page=user" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>
