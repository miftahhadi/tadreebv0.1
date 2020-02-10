    <div class="card">
      <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap">
          <thead>
            <tr>
              <th class="w-1">#</th>
              <th class="mw-30">Judul Section</th>
              <th>Judul Kuis</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1; // Penomoran
            foreach ($listSection as $section):
              // Ambil semua kuis di section ini
              $stmtKuis->execute(['pelajaran_id' => $_GET['pelajaran'], 'section_id' => $section['section_id']]);
            ?>
            <tr>
              <td class="align-baseline"><?=$i?></td>
              <td class="align-baseline"><?=$section['section_nama']?></td>
              <td>
                <ul class="list-group list-group-transparent mb-0">
                  <?php while ($kuis = $stmtKuis->fetch(PDO::FETCH_ASSOC)): ?>
                  <li class="list-group-item list-group-item-action d-flex align-items-center active">
                    <span class="mr-3">
                      <i class="fe fe-check-circle"></i>
                    </span>
                    <div>
                      <a href="<?=$url?>&section=<?=$section['section_id']?>&kuis=<?=$kuis['kuis_id']?>"><span class="m-0"><?=$kuis['kuis_nama']?></span></a>
                    </div>
                   </li>
                  <?php endwhile; ?>
                </ul>
              </td>
            </tr>
            <?php
            $i++;
            endforeach;
            ?>
    	     </tbody>
        </table>
      </div>
    </div>
