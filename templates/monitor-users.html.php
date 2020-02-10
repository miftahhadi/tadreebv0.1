    <div class="tag tag-primary">
      <a href="<?=strpos($url, '&submit') ? explode('&submit', $url)[0] : $url?>" class="text-white">Semua</a>
      <span class="tag-addon"><i class="fa fa-users"></i></span>
    </div>
    <div class="tag tag-primary">
      <a href="<?=$url?>&submit=true" class="text-white">Sudah Mengerjakan (<?=count($pesertaSubmit)?>)</a>
      <span class="tag-addon"><i class="fa fa-check-square-o"></i></span>
    </div>
    <div class="tag tag-primary">
      <a href="<?=$url?>&submit=false" class="text-white">Belum Mengerjakan (<?=count($peserta) - count($pesertaSubmit)?>)</a> <span class="tag-addon"><i class="fa fa-spinner"></i></span>
    </div>
    <?php
    if (isset($_GET['submit']) && $_GET['submit'] == 'true'):
      include __DIR__ . '/monitor-user-submit.html.php';
    elseif (isset($_GET['submit']) && $_GET['submit'] == 'false'):
      include __DIR__ . '/monitor-user-nonsubmit.html.php';
    else:
    ?>
    <div class="card">
      <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap">
          <thead>
            <tr>
              <th class="w-1">#</th>
              <th>Nama</th>
              <th>Username</th>
              <th width='30%'>Sudah Mengerjakan?</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($peserta as $siswa): ?>
    	  		<tr>
        		  <td><?=$i?></td>
        		  <td><?=$siswa['nama']?></td>
        		  <td><?=$siswa['username']?></td>
        		  <td>
                <span class='text-<?=in_array($siswa['user_id'], $pesertaSubmit) ? 'success' : 'danger'?>'>
                  <i class='fa fa-<?=in_array($siswa['user_id'], $pesertaSubmit) ? 'check' : 'times'?>-circle'></i>
                  <?=in_array($siswa['user_id'], $pesertaSubmit) ? 'Sudah' : 'Belum'?>
                </span>
              </td>
      		  </tr>
            <?php
            $i++;
            endforeach; ?>
    	      </tbody>
        </table>
      </div>
    </div>
    <?php endif; ?>
