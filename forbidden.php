<?php
define('PAGE_TITLE', 'Area Terbatas');

include __DIR__ . '/templates/layouts/head.html.php';
?>
<body class="">
    <div class="page">
      <div class="page-content">
        <div class="container text-center">
          <div class="display-1 text-muted mb-5"><i class="fe fe-x-circle"></i> Area Terbatas</div>
          <h1 class="h2 mb-3">Anda tidak memiliki akses ke halaman yang dituju</h1>
          <a class="btn btn-primary" href="javascript:history.back()">
            <i class="fe fe-arrow-left mr-2"></i>Kembali
          </a>
          <a class="btn btn-secondary" href="/logout">
            <i class="fe fe-log-out mr-2"></i>Log Out
          </a>
        </div>
      </div>
    </div>
  </body>
</html>
