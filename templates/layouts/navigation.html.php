      <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg order-lg-first">
              <!-- Start the list -->
              <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                <?php foreach ($navArray[$area] as $list):?>
                <li class="nav-item">
                  <a href="<?=$list['link']?>" class="nav-link" <?=(isset($list['submenu'])) ? ' data-toggle="dropdown"' : '' ?>>
                    <i class="fe fe-<?=$list['icon']?>"></i><?=$list['title']?>
                  </a>
                  <?php if (isset($list['submenu'])): ?>
                  <div class="dropdown-menu dropdown-menu-arrow">
                    <?php foreach ($list['submenu'] as $sub): ?>
                    <a href="<?=$sub['subLink']?>" class="dropdown-item "><?=htmlspecialchars($sub['subTitle'])?></a>
                    <?php endforeach; ?>
                  </div>
                  <?php endif; ?>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="my-3 my-md-5">
        <div class="container">
