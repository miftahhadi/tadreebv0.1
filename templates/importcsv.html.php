<div class="row">
  <div class="col-md-8">
    <h3>Import dari CSV</h3>
    <?=(isset($error)) ? alert('gagal', $error): ''?>
    <div class="card">
      <div class="card-body">
        <p><b>Perhatian:</b> File harus memiliki format CSV dan memiliki kolom berturut-turut sebagai berikut:</p>
        <p>Nama, Username, Password, Jenis Kelamin, Tanggal Lahir, Domisili, Pekerjaan, Email, Nomor WhatsApp</p>
        <hr>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label class="form-label" for="file" >Pilih File</label>
            <input type="file" id="file" name="file" accept="csv">
          </div>
          <div class="form-group">
            <label for="angkatan" class="form-label">Tambahkan ke angkatan</label>
            <select name="angkatan" id="angkatan" class="form-control custom-select">
              <?php foreach ($listAngkatan as $angkatan): ?>
              <option value="<?=$angkatan['angkatan_id']?>"><?=$angkatan['angkatan_nama']?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <input type="submit" class="btn btn-primary" name="import" value="Import">
        </form>
      </div>
    </div>
  </div>
</div>
