<?php
// Kalau ada ID section, simpan
if (isset($_GET['sectionId'])) {

  $sectionID = $_GET['sectionId'];

}

// Kalau sudah ada upload-an file, proses dulu
if (isset($_POST['upload'])) {

  if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    // get details of the uploaded file
	  $fileTitle = $_POST['judul'];
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    // sanitize file-name
    // $newFileName = $fileName . '.' . $fileExtension;

    // check if file has one of the following extensions
  	if ($_POST['objek'] == "audio") {
  		$allowedfileExtensions = array('mp3', 'ogg', 'wav');
  	}
  	if ($_POST['objek'] == "dokumen") {
  		$allowedfileExtensions = array('doc', 'docx', 'pdf', 'odt');
  	}

    if (in_array($fileExtension, $allowedfileExtensions)) {
      // directory in which the uploaded file will be moved
      if ($_POST['objek'] == "dokumen") {
        $uploadFileDir = '/docs/';
      }

      if ($_POST['objek'] == "audio") {
        $uploadFileDir = '/audio/';
      }

    	$url = $uploadFileDir . $fileName;
  	  $dest_path = UPLOAD_FOLDER . $url;

      if (move_uploaded_file($fileTmpPath, $dest_path)) {

        $data = [
  				'upload_judul' => $fileTitle,
  				'upload_nama' => $fileName,
  				'upload_tipe' => $fileType,
  				'upload_ukuran' => $fileSize,
  				'upload_url' => $url,
          'upload_tanggal' => new DateTime
        ];

        $upload = insert($db, 'upload', $data);

    		if ($upload->rowCount() > 0 && isset($sectionID)) {
    			$uploadID = $db->lastInsertId();

          $dataSection = [
            'section_id' => $sectionID,
            'upload_id' => $uploadID
          ];

          $assignSection = insert($db, 'section_upload', $dataSection);

    		} // IF ada ID section

        if ($upload->rowCount() > 0) { // Kalau berhasil, balik ke halaman sebelumnya
          $_SESSION['status'] = 'sukses';
          $_SESSION['msg'] = 'File berhasil diupload';
          header('Location: ' . $_POST['backUrl']);
        }

      }  else  { // Kalau gagal memindahkan file ke folder upload

        $error = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';

      } // ELSE gagal mindahin ke folder

    } else { // Kalau format file tidak diizinkan

      $error = 'Upload gagal. Tipe file yang diizinkan: ' . implode(',', $allowedfileExtensions);

    }

  } else { // Kalau ada error

    $error = 'There is some error in the file upload. Please check the following error.<br>';
    $error .= 'Error:' . $_FILES['file']['error'];

  }

} // IF isset upload

// Cek objek
if (!isset($_GET['objek'])) {
  exit();
}

if (isset($_GET['objek'])) {
  $objek = $_GET['objek'];
}

// Set url balik
if (isset($_GET['pelajaranId']) && isset($_GET['sectionId'])) {

  $backUrl = 'index.php?page=pelajaran&action=editsection&id=' . $_GET['pelajaranId'] . '&sectionId=' . $_GET['sectionId'];

} else {

  $backUrl = 'index.php?page=upload&objek=' . $objek;

}

// Set judul halaman
define('PAGE_TITLE', 'Upload ' . ucfirst($objek));

$pageTemplate = 'upload.html.php';
