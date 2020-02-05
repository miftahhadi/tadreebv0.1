<?php
if (isset($_GET['page'])) {

  $page = $_GET['page'];

  if ($page == 'upload') { // Page upload punya controller sendiri

      include __DIR__ . '/controllers/upload.php';

  } else if (isset($_GET['action']) && ($_GET['action'] == 'tambah' || $_GET['action'] == 'edit' )) {

    // Halaman edit/tambah soal dan peserta punya controller sendiri
    if ($page == 'soal' || $page == 'user') {

      include __DIR__ . '/controllers/edit-' . $page . '.php';

    } else {

      include __DIR__ . '/controllers/edit.php';

    }

  } elseif ($page == 'user' && isset($_GET['action']) && $_GET['action'] == 'ubah-password') {

    include __DIR__ . '/controllers/ubah-password.php';

  } elseif (($page == 'pelajaran' || $page == 'kuis' || $page == 'kelas') && (isset($_GET['action']) && $_GET['action'] == 'build')) {

    include __DIR__ . '/controllers/' . $page . '-build.php';

  } elseif ($page == 'pelajaran' && (isset($_GET['action']) && $_GET['action'] == 'editsection')) {

    include __DIR__ . '/controllers/edit-section.php';

  } elseif ($page == 'user' && (isset($_GET['action']) && $_GET['action'] == 'importcsv')) {

    include __DIR__ . '/controllers/importcsv.php';

  } elseif ($page == 'monitor') {

    include __DIR__ . '/controllers/monitor.php';

  } else { // Kalau gak ada action, list data

    include __DIR__ . '/controllers/listdata.php';

  } // ELSE

} // IF (isset($_GET['page']))

else {

  include __DIR__ . '/controllers/admin-home.php';

}
