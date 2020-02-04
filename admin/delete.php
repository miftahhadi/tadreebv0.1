<?php
include __DIR__ . '/../connect.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

$delete = delete($db, $_POST['table'], $_POST['primaryKey'], $_POST['id']);

if ($delete == 1) {

  header('Location: index.php?page=' . $_POST['page']);

}

 ?>
