<div class="card">
  <div class="table-responsive">
    <table class="table card-table table-vcenter text-nowrap">
      <thead>
        <tr>
          <th class="w-1">#</th>
          <th>Kelas</th>
          <th>Angkatan</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Set $i untuk penomoran
        $i = 1;
        foreach ($listKelas as $kelas): ?>
        <tr>
          <td><?=$i?></td>
          <td><a href="<?=$url?>&kelas=<?=$kelas['kelas_id']?>"><?=$kelas['kelas_nama']?></a></td>
          <td><?=$kelas['angkatan_nama']?></td>
        </tr>
        <?php
        $i++;
        endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
