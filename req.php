<?php

     require './create/xss.php';

     if (!isset($_GET['url'])) {
          header("HTTP/1.0 404 Not Found");
          die();
     }
     $code = substr($_GET['url'], 3);
     $code = str_replace("/", "", $code);

     if ($code === "index.php") {
          header("Location: create/");
          die();
     }

     $ocode = $code;
     try {
          $path_ar = str_split($code);
          $path = "./_data/";
          foreach ($path_ar as $key => $value) {
               $path .= $value . '/';
          }
          $path = rtrim($path, '/') . ".php";

          $file = file_get_contents($path);
          $file = str_replace("<?php/*", "", $file);
          $file = json_decode($file, true);
     } catch (\Exception $e) {
          $error_type_hhIns6Us = 'error';
          $error_title_uG4Fd1 = 'kurZ - Fehlercode 404';
          $error_header_uG4Fd1 = 'Fehler!';
          $error_msg_Olsf1 = '[Fehlercode 404] Den angegebenen Code <i>(' . sprint($ocode) . ')</i> gibt es nicht! Bitte überprüfe deine Eingaben und versuche es erneut!';
          //print 'error1';
          include './create/fehler.php';
          die();
     }



     if ($file['url'] == null || $file['url'] == "") {
          $error_type_hhIns6Us = 'error';
          $error_title_uG4Fd1 = 'kurZ - Fehlercode 404';
          $error_header_uG4Fd1 = 'Fehler!';
          $error_msg_Olsf1 = '[Fehlercode 404] Den angegebenen Code <i>(' . sprint($ocode) . ')</i> gibt es nicht! Bitte überprüfe deine Eingaben und versuche es erneut!';
          //print 'error2';
          include './create/fehler.php';
          die();
     }

     header("Location: " . base64_decode($file['url']));
     die();

     function Base32Encode($number)
     {
          $number = base_convert($number, 10, 32);
          return $number;
     }

     function Base32Decode($number)
     {
          $number = base_convert($number, 32, 10);
          return $number;
     }

?>
