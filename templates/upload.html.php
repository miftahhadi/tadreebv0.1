<div class="row">
  <div class="col-md-8">
    <h3>Upload <?=ucfirst($objek)?></h3>
    <?php
    if (isset($error)):
      echo alert('gagal', $error);
    endif;
    ?>
    <div class="card">
      <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
          <label for="judul" class="form-label">Nama File</label>
          <input type="text" class="form-control" id="judul" name="judul">
        </div>
        <div class="form-group">
          <label class="form-label" for="file" >Pilih File</label>
            <input type="file" id="file" name="file">
        </div>
        <input type="hidden" name="objek" value="<?=$objek?>">
        <input type="hidden" name="backUrl" value="<?=$backUrl?>">
        <input type="submit" class="btn btn-primary" name="upload" value="Upload">
        </form>
      </div>
    </div>
    <a href="<?=$backUrl?>" class="btn btn-secondary">Kembali</a>
  </div>
</div>
