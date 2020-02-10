<div class="card">
  <div class="table-responsive">
    <table class="table card-table table-vcenter text-nowrap">
      <thead>
        <tr>
          <th class="w-1">#</th>
          <th>Nama</th>
          <th>Username</th>
          <th>Email</th>
          <th>Nomor WhatsApp</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        foreach ($peserta as $siswa):
          if (!in_array($siswa['user_id'], $pesertaSubmit)):
        ?>
        <tr>
          <td><?=$i?></td>
          <td><?=$siswa['nama']?></td>
          <td><?=$siswa['username']?></td>
          <td><?=$siswa['email']?></td>
          <td><?=$siswa['nomor']?></td>
        </tr>
        <?php
            $i++;
          endif;
        endforeach; ?>
        </tbody>
    </table>
  </div>
</div>
