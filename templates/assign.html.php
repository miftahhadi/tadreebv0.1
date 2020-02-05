<div class="col-md-8">
  <div class="page-header">
    <h3 class="page-title">Tambahkan <?=ucfirst($objeks[$objek]['jenis'])?></h3>
    <?php if ($_GET['assign'] != 'kuis'): ?>
    <a href="<?=$tambahHref?>" class="btn btn-primary ml-auto"><i class="fa fa-plus-square"></i> <?=$objeks[$objek]['tambahBtn']?></a>
    <?php endif; ?>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <form action="" method="post">
      <div class="card">
        <div class="card-body">
          <table class="table card-table table-vcenter table-hover">
            <tr>
              <th class="w-1"></th>
              <?php foreach ($objeks[$objek]['header'] as $header): ?>
              <th><?=$header?></th>
              <?php endforeach; ?>
            </tr>
            <?php foreach ($daftarItem as $item): ?>
            <tr>
              <td>
                <label class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="ID[]" value="<?=$item[$itemId]?>">
                  <div class="custom-control-label"></div>
                </label>
              </td>
              <?php foreach ($objeks[$objek]['kolom'] as $kolom): ?>
              <td><?=$item[$kolom]?></td>
              <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
      <input type="hidden" name="item" value="<?=$objeks[$objek]['child']?>">
      <input type="hidden" name="parent" value="<?=$objeks[$objek]['parent']?>">
      <input type="hidden" name="parentId" value="<?=$parentId ?? ''?>">
      <input type="hidden" name="insertTable" value="<?=$objeks[$objek]['insertTable']?>">
      <input type="hidden" name="backUrl" value="<?=$backUrl?>">
      <input type="submit" class="btn btn-success" value="Tambahkan <?=ucfirst($objeks[$objek]['jenis'])?>">
      <a href="index.php?page=<?=$_GET['page']?>&action=<?=$_GET['action']?>&id=<?=$_GET['id']?><?=(isset($_GET['sectionId'])) ? '&sectionId=' . $_GET['sectionId'] : ''?><?=($_GET['assign'] == 'pelajaran') ? '&list=pelajaran' : ''?>" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

<?php if (ceil($totalRows / $resultOnPage) > 0): ?>
<!-- Pagination -->
<div>
  <ul class="pagination justify-content-center">
    <?php if ($paged > 1): ?>
    <li class="page-item page-prev">
      <a class="page-link" href="index.php?page=<?=$page?>&action=build&id=<?=$_GET['id']?>&assign=<?=$_GET['assign']?>&paged=<?=$paged-1?>" tabindex="-1">
        <i class="fe fe-chevron-left"></i>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="index.php?page=<?=$page?>&action=build&id=<?=$_GET['id']?>&assign=<?=$_GET['assign']?>">1</a></li>
    <?php endif; ?>

    <?php if ($paged > 2): ?>
    <li class="page-item"><span class="page-link">...</span></li>
    <?php endif; ?>

    <?php if ($paged-2 > 2): ?>
    <li class="page-item"><a class="page-link" href="index.php?page=<?=$page?>&action=build&id=<?=$_GET['id']?>&assign=<?=$_GET['assign']?>&paged=<?=$paged-2?>"><?=$paged-2?></a></li>
    <?php endif; ?>

    <?php if ($paged-1 > 2): ?>
    <li class="page-item"><a class="page-link" href="index.php?page=<?=$page?>&action=build&id=<?=$_GET['id']?>&assign=<?=$_GET['assign']?>&paged=<?=$paged-1?>"><?=$paged-1?></a></li>
    <?php endif; ?>

    <li class="page-item active"><a class="page-link" href="index.php?page=<?=$page?>&action=build&id=<?=$_GET['id']?>&assign=<?=$_GET['assign']?>&paged=<?=$paged?>"><?=$paged?></a></li>

    <?php if ($paged+1 < ceil($totalRows / $resultOnPage)+1): ?>
    <li class="page-item"><a class="page-link" href="index.php?page=<?=$page?>&action=build&id=<?=$_GET['id']?>&assign=<?=$_GET['assign']?>&paged=<?=$paged+1?>"><?=$paged+1?></a></li>
    <?php endif; ?>

    <?php if ($paged+2 < ceil($totalRows / $resultOnPage)+1): ?>
    <li class="page-item"><a class="page-link" href="index.php?page=<?=$page?>&action=build&id=<?=$_GET['id']?>&assign=<?=$_GET['assign']?>&paged=<?=$paged+2?>"><?=$paged+2?></a></li>
    <?php endif; ?>

    <?php if ($paged < ceil($totalRows / $resultOnPage)-2): ?>
    <li class="page-item"><span class="page-link">...</span></li>
    <li class="page-item"><a class="page-link" href="index.php?page=<?=$page?>&action=build&id=<?=$_GET['id']?>&assign=<?=$_GET['assign']?>&paged=<?=ceil($totalRows / $resultOnPage)?>"><?=ceil($totalRows / $resultOnPage)?></a></li>
    <?php endif; ?>

    <?php if ($paged < ceil($totalRows / $resultOnPage)): ?>
    <li class="page-item page-next">
      <a class="page-link" href="index.php?page=<?=$page?>&action=build&id=<?=$_GET['id']?>&assign=<?=$_GET['assign']?>&paged=<?=$paged+1?>">
        <i class="fe fe-chevron-right"></i>
      </a>
    </li>
    <?php endif; ?>
  </ul>
</div>
<?php endif; ?>
