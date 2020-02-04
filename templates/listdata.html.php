<div class="page-header">
  <h3 class="page-title"><?=$pageData[$page]['title']?></h3>
  <div class="page-options d-flex">
    <a href="index.php?page=<?=$page?>&action=tambah" class="btn btn-square btn-secondary ml-auto"><i class="fa fa-plus-square"></i> Tambah Baru</a>
    <?php if ($page == 'user'): ?>
    <div class="ml-2">
    <a href="index.php?page=<?=$page?>&action=importcsv" class="btn btn-square btn-secondary ml-auto"><i class="fa fa-upload"></i> Import dari CSV</a>
    </div>
    <?php endif; ?>
  </div>
</div>

<?php
if (isset($_SESSION['msg'])): // Tampilkan pesan jika ada
  echo alert($_SESSION['status'], $_SESSION['msg'], 1);
endif; ?>

<?php if ($page == 'user'): ?>
<div class="alert bg-blue-lightest">
  <span>Filter:</span>
  <select id="angkatan" class="form-control custom-select w-auto">
    <option value="asc">Angkatan</option>
    <option value="desc">Oldest</option>
  </select>
  <select id="kelas" class="form-control custom-select w-auto">
    <option value="asc">Kelas</option>
    <option value="desc">Oldest</option>
  </select>
  <select id="jenisKelamin" class="form-control custom-select w-auto">
    <option value="asc">Jenis Kelamin</option>
    <option value="desc">Oldest</option>
  </select>
</div>
<?php endif; ?>
<div class="card">
  <div class="card-body">
    <table class="table table-hover">
    <thead>
      <tr>
        <th width="5%">#</th>
        <?php foreach ($pageData[$page]['tableHeader'] as $header): ?>
        <th><?php echo $header ?></th>
        <?php endforeach; ?>
        <th width="14%" class="ml-auto"></th>
      </tr>
    </thead>
    <tbody>
  <?php
    $i = 1 + $calcPage;
    while ($data = $listData->fetch(PDO::FETCH_ASSOC)):
  ?>
      <tr>
        <td><?=$i?></td>
        <?php foreach ($dataColumns as $column): ?>
        <td><?=$data[$column]?></td>
        <?php endforeach; ?>
        <td>
          <?php if ($page == 'pelajaran' || $page == 'kuis' || $page == 'kelas'): ?>
          <a href="index.php?page=<?=$page?>&action=build&id=<?=$data[$pageData[$page]['primaryKey']]?>" class="btn bg-blue-lightest btn-xs" data-toggle="tooltip" title="Susun <?=ucfirst($page)?>"><i class="fe fe-package"></i></a>
          <?php endif; ?>
          <a href="index.php?page=<?=$page?>&action=edit&id=<?=$data[$pageData[$page]['primaryKey']]?>" class="btn bg-blue-lightest btn-xs" data-toggle="tooltip" title="Edit <?=ucfirst($page)?>"><i class="fe fe-edit"></i></a>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-id="<?=$data[$pageData[$page]['primaryKey']]?>" data-target="#hapusData"><i class="fe fe-trash-2" data-toggle="tooltip" title="Hapus <?=ucfirst($page)?>"></i></button>
        </td>
      </tr>
  <?php
      $i++;
    endwhile;
  ?>
    </tbody>
    </table>
  </div>
</div>

<?php if (ceil($totalRows / $resultOnPage) > 0): ?>
<!-- Pagination -->
<div>
  <ul class="pagination justify-content-center">

    <?php if ($paged > 1): ?>
    <li class="page-item page-prev">
      <a class="page-link" href="index.php?page=<?=$page?>&paged=<?=$paged-1?>" tabindex="-1">
        <i class="fe fe-chevron-left"></i>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="index.php?page=<?=$page?>">1</a></li>
    <?php endif; ?>

    <?php if ($paged > 2): ?>
    <li class="page-item"><span class="page-link">...</span></li>
    <?php endif; ?>

    <?php if ($paged-2 > 2): ?>
    <li class="page-item"><a class="page-link" href="index.php?page=<?=$page?>&paged=<?=$paged-2?>"><?=$paged-2?></a></li>
    <?php endif; ?>

    <?php if ($paged-1 > 2): ?>
    <li class="page-item"><a class="page-link" href="index.php?page=<?=$page?>&paged=<?=$paged-1?>"><?=$paged-1?></a></li>
    <?php endif; ?>

    <li class="page-item active"><a class="page-link" href="index.php?page=<?=$page?>&paged=<?=$paged?>"><?=$paged?></a></li>

    <?php if ($paged+1 < ceil($totalRows / $resultOnPage)+1): ?>
    <li class="page-item"><a class="page-link" href="index.php?page=<?=$page?>&paged=<?=$paged+1?>"><?=$paged+1?></a></li>
    <?php endif; ?>

    <?php if ($paged+2 < ceil($totalRows / $resultOnPage)+1): ?>
    <li class="page-item"><a class="page-link" href="index.php?page=<?=$page?>&paged=<?=$paged+2?>"><?=$paged+2?></a></li>
    <?php endif; ?>

    <?php if ($paged < ceil($totalRows / $resultOnPage)-2): ?>
    <li class="page-item"><span class="page-link">...</span></li>
    <li class="page-item"><a class="page-link" href="index.php?page=<?=$page?>&paged=<?=ceil($totalRows / $resultOnPage)?>"><?=ceil($totalRows / $resultOnPage)?></a></li>
    <?php endif; ?>

    <?php if ($paged < ceil($totalRows / $resultOnPage)): ?>
    <li class="page-item page-next">
      <a class="page-link" href="index.php?page=<?=$page?>&paged=<?=$paged+1?>">
        <i class="fe fe-chevron-right"></i>
      </a>
    </li>
    <?php endif; ?>

  </ul>
</div>
<?php endif; ?>

<!-- Modal -->
<div class="modal fade" id="hapusData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        Anda yakin ingin menghapus item ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <form action="delete.php" method="post">
          <input type="hidden" name="id" id="dataID">
          <input type="hidden" name="table" value="<?=$pageData[$page]['insertTable']?>">
          <input type="hidden" name="primaryKey" value="<?=$pageData[$page]['primaryKey']?>">
          <input type="hidden" name="page" value="<?=$page?>">
          <input type="submit" class="btn btn-danger" value="Hapus">
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $('#hapusData').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget) // Button that triggered the modal
  let id = button.data('id') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  let modal = $(this)
  modal.find('.modal-footer #dataID').val(id)
  })
</script>
