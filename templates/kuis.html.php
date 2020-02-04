<div class="row d-flex justify-content-center">
  <div class="col-md-7">
    <div class="card">
      <div class="card-body">
        <div class="row align-items-center gutters-sm">
          <div class="col text-center">
            <div class="display-4 font-weight-bold"><?=$kuis['kuis_nama']?></div>
          </div>
        </div>
        <table class="card-table table table-center table-md mt-4">
          <tr>
            <td colspan="2" class="font-weight-bold">Informasi Tugas</td>
          </tr>
		      <tr>
            <td width="50%">Jumlah Soal</td>
            <td><?=$data->rowCount()?></td>
          </tr>
		      <tr>
            <td width="50%">Durasi</td>
            <td><?=($setting['durasi'] && $setting['durasi'] != '0') ? $setting['durasi'] . ' menit' : 'Soal tidak dibatasi waktu' ?></td>
          </tr>
		      <tr>
            <td width="50%">Tenggat Pengerjaan</td>
            <td><?=$batasBuka?></td>
          </tr>
          <?php if (isset($msg)): ?>
          <tr>
            <td colspan="2">
              <div class="alert alert-info" role="alert"><?=$msg?></div>
            </td>
          </tr>
          <?php endif; ?>
        </table>
      </div>
    </div>
  	<div class="text-center">
      <a href="./index.php?page=pelajaran&lesson=<?=$kodePelajaran?>&kelas=<?=$_GET['kelas']?>&section=<?=$_GET['section']?>"><button class="btn btn-secondary">Kembali</button></a>
      <?php if ($aksesKuis === true): ?>
      <a href="./index.php?page=pelajaran&lesson=<?=$kodePelajaran?>&kelas=<?=$_GET['kelas']?>&section=<?=$_GET['section']?>&kuis=<?=$_GET['kuis']?>&doing=true"><button class="btn btn-success">Mulai Kerjakan</button></a>
      <?php
      endif;
      if ($lihatHasil === true): ?>
      <a href="./index.php?page=pelajaran&lesson=<?=$kodePelajaran?>&kelas=<?=$_GET['kelas']?>&section=<?=$_GET['section']?>&hasil=<?=$_GET['kuis']?>" class="btn btn-info">Lihat Hasil</a>
      <?php endif; ?>
  	</div>
  </div>
</div>
