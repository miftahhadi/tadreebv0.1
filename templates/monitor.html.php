<div class="row d-flex justify-content-center">
  <div class="col-md-12">
    <?php if (!empty($monitorNav)): ?>
      <nav aria-label="breadcrumb">
  	  	<ol class="breadcrumb">
          <?php foreach ($monitorNav as $nav): ?>
          <li class="breadcrumb-item"><a href="<?=$nav['link']?>"><?=$nav['item']?></a></li>
          <?php endforeach; ?>
  	  	</ol>
  		</nav>
    <?php endif; ?>

    <h3><?=$title?></h3>

    <?php include __DIR__ . $monitorPage; ?>
  </div>
</div>
