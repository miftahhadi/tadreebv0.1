<div class="row d-flex justify-content-center">
  <!-- Content-->
  <div class="col-md-9">
    <div class="card">
      <div class="card-body">
	      <h2 class="mt-0 mb-4"><?=$pelajaran['pelajaran_nama']?></h2>
        <p><?=$pelajaran['pelajaran_deksripsi'] ?? ''?></p>
		    <hr>
        <div class="list-group">
          <?php
          foreach ($sections as $section):
            if ($section['tampil'] == 1 ):
          ?>
          <a <?=($section['buka'] == 1 || empty($section['buka'])) ? 'href="./index.php?page=pelajaran&lesson=' . $kodePelajaran . '&kelas=' . $kelas . '&section=' . $section['section_id'] . '"' : '' ?> class='list-group-item list-group-item-action text-blue-darker'><?=$section['section_nama']?></a>
          <?php
            endif;
          endforeach;
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
