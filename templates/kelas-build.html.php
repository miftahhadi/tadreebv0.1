<div class="page-header">
  <div>
    <h3 class="page-title"><?=$kelas['kelas_nama']?></h3>
  </div>
  <a href="index.php?page=kelas&action=build&id=<?=$kelasId?>&assign=<?=$listData[$list]['link']?>" class="btn btn-primary ml-auto"><i class="fa fa-plus-square"></i> Tambah <?=ucfirst($list)?></a>
</div>
<div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link <?php echo ($list == 'peserta') ? 'active' : ''; ?>" href="index.php?page=kelas&action=build&id=<?=$kelasId?>&list=peserta"><i class="fe fe-users"></i> Peserta</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo ($list == 'pelajaran') ? 'active' : ''; ?>" href="index.php?page=kelas&action=build&id=<?=$kelasId?>&list=pelajaran"><i class="fe fe-book-open"></i> Pelajaran</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <table class="table table-hover">
			<thead>
			  <tr>
				<th width="5%">#</th>
        <?php foreach ($listData[$list]['tableHeader'] as $header): ?>
        <th><?=$header?></th>
        <?php endforeach; ?>
				<th width="14%"></th>
			  </tr>
			</thead>
      <tbody>
        <?php
        $i = 1;
        foreach ($dataAll as $data): ?>
        <tr>
          <td><?=$i?></td>
          <?php foreach ($listData[$list]['kolom'] as $kolom): ?>
          <td><?=$data[$kolom]?></td>
          <?php endforeach; ?>
          <td>
            <?php if ($list == 'pelajaran'): ?>
            <a href="" class="btn bg-blue-lightest btn-xs" data-toggle="tooltip" title="Monitor Kuis"><i class="fa fa-desktop"></i></a>
            <?php endif; ?>
            <a href="index.php?page=<?=$listData[$list]['link']?>&action=<?=($list == 'peserta')? 'edit' : 'build'?>&id=<?=$data[$listData[$list]['id']]?>&kelasId=<?=$_GET['id']?>" class="btn bg-blue-lightest btn-xs" data-toggle="tooltip" title="Edit <?=ucfirst($list)?>"><i class="fa fa-edit"></i></a>
            <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" data-toggle="tooltip" title="Hapus"></i></button>
          </td>
        </tr>
        <?php
          $i++;
        endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
