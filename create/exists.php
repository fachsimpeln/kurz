<?php

     require __DIR__ . '/../config/config.php';

     $cname = $_GET['cname'];
     $path = $base_path . '/';
     foreach (str_split($cname) as $key => $value) {
          $path .= $value . '/';
     }
     $path = rtrim($path, '/') . ".json";

     $result = array();
     if (file_exists($path)) {
          $result['taken'] = 1;
     } else {
          $result['taken'] = 0;
     }
     die(json_encode($result));
?>
