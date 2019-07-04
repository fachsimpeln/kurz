<?php

     $token = $_GET['token'];
     if ($token !== '<token>') {
          header('HTTP/1.0 404 Not Found');
          die();
     }

     $files_temp = getDirContents("./_data/");
     $files = array();
     foreach ($files_temp as $key => $value) {
          $re = '/^.+\/_data\//m';
          $value = preg_replace($re, "", $value);

          if ($value == '.htaccess') {
               continue;
          }
          if ($value == "") {
               continue;
          }

          $re = '/^.+\.php/m';
          preg_match_all($re, $value, $matches, PREG_SET_ORDER, 0);

          if (count($matches) > 0) {
               $files[] = './_data/' . $value;
          }
     }

     //var_dump($files);

     $json = array();
     foreach ($files as $key => $value) {
          $file = file_get_contents($value);
          $file = str_replace("<?php/*", "", $file);
          $json_file = json_decode($file, true);

          $id = $json_file['id'];

          $json[$id]['url'] = $json_file['url'];
          $json[$id]['time'] = $json_file['time'];
     }




     function getDirContents($dir, &$results = array()){
          $files = scandir($dir);

          foreach($files as $key => $value) {
               $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
               if(!is_dir($path)) {
                    $results[] = $path;
               } else if($value != "." && $value != "..") {
                    getDirContents($path, $results);
                    $results[] = $path;
               }
          }
          return $results;
     }

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
     //var_dump($json);

?>

<!DOCTYPE html>
<html lang="de" dir="ltr">
     <head>
          <meta charset="utf-8">
          <title>kurZ - Adminpanel</title>
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="icon" type="image/png" href="http://<URL>/create/favicon.png" sizes="512x512">
          <!-- FONTS -->
          <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
          <style type="text/css">
               * {
                    margin: 0px;
                    padding: 0px;
                    font-family: 'Poppins', sans-serif;
                    overflow-wrap: break-word;
               }

               body {
                    background: #333333;
               }

               .storagebox {
                    font-size: 18px;

                    border-radius: 10px;
                    background-color: #434343;
                    display: block;
                    margin: 10px;
                    margin-top: 30px;

                    overflow: hidden;

                    max-height: 15%;

                    color: #B5B5B5;


               }

               .storagebox .button {
                    font-size: 24px;
                    color: white;

                    padding: 35px;
               }

               .storagebox .button:hover {
                    color: #3b3e3c;
                    cursor: pointer;
               }

               .storagebox .button-remove {
                    margin: 0px;
                    float: right;
                    background: #3694FF;

                    border-top-right-radius: 10px;
               }

               .storagebox .content {
                    padding: 1%;
               }

               th {
                    background-color: #0077FF;
                    color: white;
               }

               .t-key {
                    border-top-left-radius: 10px;
               }

               .t-value {
                    border-top-right-radius: 10px;
               }

               table {
                    border-collapse: collapse;
                    width: 100%;
               }

               th, td {
                    text-align: left;
                    padding: 8px;
               }

               tr:nth-child(even){background-color: #f2f2f2}

          </style>
          <script type="text/javascript">
               function remove(count) {
                    document.getElementById('iframe-edit').setAttribute('src', 'del.php?token=<DEL_TOKEN>&id=' + count);
                    window.setTimeout(frameLoaded, 1000);
               }
               function frameLoaded() {
                    location.reload();
               }
          </script>
     </head>
     <body>
          <h1 style="margin-left: 15px; margin-top: 10px; color: #3694FF;">kurZ - Adminpanel</h1>
          <?php
               foreach ($json as $box => $value) {
                    $box = Base32Decode($box);
                    $storagebox = '<div class="storagebox">
                         <span onclick="remove(\'' . Base32Encode($box) . '\');" class="button button-remove">✖</span>

                         <div class="content">
                              <span style="font-size: 20px;" class="box-title"><b>' . $box . '</b> - <i>' . $value['time'] . '</i></span>
                              <br />
                              <br />
                              <span class="box-content">
                                   <span>URL:</span><br />
                                   <span><b>' . base64_decode($value['url']) . '</b></span>
                                   <br />

                                   <span>CODE:</span><br />
                                   <span><b>' . Base32Encode($box) . '</b></span>
                                   <br />

                         ';
                    $storagebox .= '
                              </span>
                         </div>
                    </div>';
                    echo $storagebox;
               }
          ?>
          <iframe id="iframe-edit" style="display: none;" src="" width="0px" height="0px"></iframe>
     </body>
</html>
