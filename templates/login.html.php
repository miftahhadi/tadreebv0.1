<?php
include 'layouts/head.html.php';
?>
<body>
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                <img src="./assets/images/logo.svg" class="h-6" alt="">
              </div>
              <?php if (!empty($error)): ?>
                <?=alert('gagal', $error)?>
              <?php endif; ?>
              <form class="card" action="" method="post">
                <div class="card-body p-6">
                  <div class="card-title">Login ke <?=SITE_NAME?></div>
                  <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Masukkan username Anda">
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      Password
                    </label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
