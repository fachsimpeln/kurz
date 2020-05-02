<?php

     session_name('kurz');
     session_start();

     if (!$_SESSION['kurz_loggedin']) {
          header('Location: ./login');
          die();
     }

     if (!hash_equals($_SESSION['csrf'], $_GET['csrf'])) {
          die('Invalid CSRF-Token. Please try again');
     }

     require __DIR__ . '/../config/config.php';
     require __DIR__ . '/../inc/ID.php';

     $code = $_GET['id'];

     if (strlen($code) < 2) {
          die('Invalid ID');
     }

     $id = new ID($base_path);
     $path = $id->GetPath($code);

     unlink($path);

?>
