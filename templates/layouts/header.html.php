<body class="">
  <div class="page">
    <div class="page-main">
      <div class="header py-4">
        <div class="container">
          <div class="d-flex">
            <a class="header-brand" href=".">
              <img src="<?=LOCATOR?>/assets/images/logo.svg" class="header-brand-img" alt="tabler logo">
            </a>
            <div class="d-flex order-lg-2 ml-auto">
              <div class="dropdown">
                <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                  <span class="avatar avatar-azure fa fa-user-o"></span>
                  <span class="ml-2 d-none d-lg-block">
                    <span class="text-default"><?=$_SESSION['nama']?></span>
                    <small class="text-muted d-block mt-1"><?=$_SESSION['role']?></small>
                  </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                  <?php if ($area == 'admin'): ?>
                  <a class="dropdown-item" href="../">
                    <i class="dropdown-icon fe fe-layers"></i> Halaman Belajar
                  </a>
                  <?php endif; ?>
                  <?php if ($_SESSION['role'] == 'Administrator'): ?>
                  <a class="dropdown-item" href="<?=LOCATOR?>/admin/">
                    <i class="dropdown-icon fe fe-settings"></i> Halaman Admin
                  </a>
                  <?php endif; ?>
                  <a class="dropdown-item" href="<?=LOCATOR?>/index.php?page=profil">
                    <i class="dropdown-icon fe fe-user"></i> Profil
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?=LOCATOR?>/index.php?page=logout">
                    <i class="dropdown-icon fe fe-log-out"></i> Sign out
                  </a>
                </div>
              </div>
            </div>
            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
              <span class="header-toggler-icon"></span>
            </a>
          </div>
        </div>
      </div>
