<div class="card">
  <div class="table-responsive">
    <table class="table card-table table-vcenter text-nowrap">
      <thead>
        <tr>
          <th class="w-1">#</th>
          <th>Nama</th>
          <th>Username</th>
          <th>Waktu Mulai</th>
          <th>Waktu Submit</th>
          <th>Durasi</th>
          <th>Nilai</th>
          <th width="5%"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        foreach ($pesertaSubmit as $user): ?>
        <tr>
          <td><?=$i?></td>
          <td><?=$user['nama']?></td>
          <td><?=$user['username']?></td>
          <td><?=$user['waktu_mulai']?></td>
          <td><?=$user['waktu_submit']?></td>
          <td><?=strtotime($user['waktu_submit']) - strtotime($user['waktu_mulai'])?> detik</td>
          <td>
            <?php
            foreach ($nilai as $skor) {
              echo ($skor[$user['user_id']]) ?? '';
            }
            ?>
          </td>
          <td><a href="<?=$url?>&user=<?=$user['user_id']?>" class="btn bg-blue-lightest btn-xs" data-toggle="tooltip" title="Lihat Jawaban"><i class="fe fe-eye"></i></a></td>
        </tr>
        <?php
        $i++;
        endforeach; ?>
        </tbody>
    </table>
  </div>
</div>
