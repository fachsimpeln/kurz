<?php
     $token = $_GET['token'];
     $code = $_GET['id'];
     if ($token !== '<DEL_TOKEN>') {
          header('HTTP/1.0 404 Not Found');
          die();
     }

     $path_ar = str_split($code);
     $path = "";
     foreach ($path_ar as $key => $value) {
          $path .= $value . '/';
     }
     $path = rtrim($path, '/') . ".php";

     unlink("./_data/" . $path);

?>
