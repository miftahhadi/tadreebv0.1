    <div class="card">
      <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap">
          <thead>
            <tr>
              <th class="w-1">#</th>
              <th>Judul Pelajaran</th>
              <th>Kategori</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Set $i untuk penomoran
            $i = 1;
            foreach ($listPelajaran as $pelajaran): ?>
            <tr>
              <td><?=$i?></td>
              <td><a href="<?=$url?>&pelajaran=<?=$pelajaran['pelajaran_id']?>"><?=$pelajaran['pelajaran_nama']?></a></td>
              <td><?=$pelajaran['kategori_nama']?></td>
            </tr>
            <?php
            $i++;
            endforeach; ?>
    	    </tbody>
        </table>
      </div>
    </div>
