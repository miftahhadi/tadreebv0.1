  <form action="" method="post">
    <div class="card">
      <div class="card-header">
        <span class="card-title">Pengaturan</span>
      </div>
      <div class="card-body">
        <div class="form-group">
          <div class="form-label">Tampilkan <?=($_GET['setting']) ?? 'section'?>?</div>
          <div class="custom-controls-stacked">
            <label class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" name="setting[tampil]" value="1" <?=(isset($setting) && $setting['tampil'] == '1') ? ' checked' : ''?>>
              <span class="custom-control-label">Tampilkan</span>
            </label>
            <label class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" name="setting[tampil]" value="0" <?=(isset($setting) && $setting['tampil'] == '0') ? ' checked' : ''?>>
              <span class="custom-control-label">Sembunyikan</span>
            </label>
          </div>
        </div>
        <div class="form-group">
          <div class="form-label">Buka akses</div>
          <div class="custom-controls-stacked">
            <label class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" name="setting[buka]" value="1" <?=(isset($setting) && $setting['buka'] == '1') ? ' checked' : ''?>>
              <span class="custom-control-label">Buka</span>
            </label>
            <label class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" name="setting[buka]" value="0" <?=(isset($setting) && $setting['buka'] == '0') ? ' checked' : ''?>>
              <span class="custom-control-label">Tutup</span>
            </label>
          </div>
        </div>
        <?php if (isset($_GET['setting']) && $_GET['setting'] == 'kuis'): ?>
        <div class="form-group">
  			  <div class="form-label">Buka Hasil</div>
  				<div class="custom-controls-stacked">
  					<label class="custom-control custom-radio custom-control-inline">
  					  <input type="radio" class="custom-control-input" name="setting[buka_hasil]" value="1" <?=(isset($setting['buka_hasil']) && $setting['buka_hasil'] == '1') ? ' checked' : ''?>>
  					  <span class="custom-control-label">Buka</span>
  					</label>
  					<label class="custom-control custom-radio custom-control-inline">
  					  <input type="radio" class="custom-control-input" name="setting[buka_hasil]" value="0" <?=(isset($setting['buka_hasil']) && $setting['buka_hasil'] == '0') ? ' checked' : ''?>>
  					  <span class="custom-control-label">Tutup</span>
  					</label>
  				 </div>
  			</div>
        <?php endif; ?>
        <div class="form-group">
          <label class="form-label">Buka Otomatis</label>
          <div class="row">
            <div class="col-md-6">
              <input type="date" class="form-control" name="setting[buka_auto][tanggal]" value="<?=$bukaAuto[0] ?? ''?>">
            </div>
            <div class="col-md-6">
              <input type="time" class="form-control" name="setting[buka_auto][waktu]" value="<?=$bukaAuto[1] ?? '00:00'?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Batas buka</label>
          <div class="row">
            <div class="col-md-6">
              <input type="date" class="form-control" name="setting[batas_buka][tanggal]" value="<?=$batasBuka[0] ?? ''?>">
            </div>
            <div class="col-md-6">
              <input type="time" class="form-control" name="setting[batas_buka][waktu]" value="<?=$batasBuka[1] ?? '00:00'?>">
            </div>
          </div>
        </div>
        <?php if (isset($_GET['setting']) && $_GET['setting'] == 'kuis'): ?>
        <div class="form-group">
  				<label class="form-label">Durasi (menit)</label>
  				<input type="number" class="form-control" name="setting[durasi]" value="<?=$setting['durasi'] ?? '0'?>">
  			  <small>Masukkan nol untuk tidak ada durasi waktu</small>
  			</div>
  			<div class="form-group">
  				<label class="form-label">Kesempatan mencoba</label>
  				<input type="number" class="form-control" name="setting[attempt]" value="<?=$setting['attempt'] ?? '0'?>">
  				<small>Masukkan nol untuk tidak membatasi kesempatan mengerjakan</small>
  			</div>
        <?php endif; ?>
        <input type="hidden" name="page" value="<?=$_GET['setting'] ?? 'section'?>">
        <?php if (isset($_GET['setting'])): ?>
        <input type="hidden" name="setting[<?=$IDname?>]" value="<?=$IDvalue?>">
        <?php endif; ?>
        <input type="hidden" name="setting[kelas_id]" value="<?=$_GET['kelasId']?>">
        <input type="hidden" name="setting[section_id]" value="<?=$_GET['sectionId']?>">
      </div>
      <div class="card-footer">
        <input type="submit" class="btn btn-success" name="updateSetting" value="Simpan Pengaturan">
      </div>
    </div>
  </form>
