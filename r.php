<?php

     date_default_timezone_set("Europe/Berlin");

     // Include classes
     require __DIR__ . '/inc/ID.php';
     require __DIR__ . '/inc/Entry.php';
     require __DIR__ . '/inc/Functions.php';
     require __DIR__ . '/inc/ErrorHandler.php';

     // Load config
     require __DIR__ . '/config/config.php';


     if (!isset($_GET['url'])) {
          header("HTTP/1.0 404 Not Found");
          die();
     }

     $code = $_GET['url'];
     $code = explode('/', $code, 3)[2];

     if ($code === "index.php" || $code === "index") {
          header("Location: create/");
          die();
     }

     $id = new ID($base_path);
     $path = $id->GetPath($code);

     $entry = new Entry($path);
     $file = $entry->Read();

     if ($file === false) {
          $e = new ErrorHandler();
          $e->SetTitle("kurZ - Fehlercode 404");
          $e->SetHeader("Fehler!");
          $e->SetMessage('[Fehlercode 404] Den angegebenen Code <i>(' . Functions::sprint($code) . ')</i> gibt es nicht! Bitte überprüfe deine Eingaben und versuche es erneut!');
          $e->RenderPage();
     }




     if ($file['url'] == null || $file['url'] == "") {
          $e = new ErrorHandler();
          $e->SetTitle("kurZ - Fehlercode 404");
          $e->SetHeader("Fehler!");
          $e->SetMessage('[Fehlercode 404] Den angegebenen Code <i>(' . Functions::sprint($code) . ')</i> gibt es nicht! Bitte überprüfe deine Eingaben und versuche es erneut!');
          $e->RenderPage();
     }

     header("Location: " . base64_decode($file['url']));
     die();
?>
