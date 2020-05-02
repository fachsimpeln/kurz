<?php

     require __DIR__ . '/../../config/config.php';

     session_name('kurz');
     session_start();


     // Get page link
     $page = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
     $page = explode('/dashboard/login', $page)[0] . '/';


     if (isset($_POST['submit'])) {

          if (!hash_equals($admin_user, $_POST['user'])) {
               header('Location: ./?error');
               die();
          }
          if (!hash_equals($admin_password, $_POST['password'])) {
               header('Location: ./?error');
               die();
          }

          $_SESSION['kurz_loggedin'] = true;
          header('Location: ../');
          die();

     }


?>

<!DOCTYPE html>
<html lang="de" dir="ltr">
     <head>
          <meta charset="utf-8">
          <title>kurZ - Adminpanel</title>
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="icon" type="image/png" href="<?=$page?>/create/favicon.png" sizes="512x512">
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

               .center {
                    position: absolute;
                    left: 50%;
                    top: 50%;
                    transform: translate(-50%, -50%);
                    width: 350px;

                    <?php
                         if (isset($_GET['error'])) {
                              print 'height: 370px;';
                         } else {
                              print 'height: 320px;';
                         }
                    ?>

                    box-sizing: border-box;

                    background-color: #434343;

                    text-align: center;

                    color: white;

                    border-radius: 8px;
               }

               h1 {
                    padding: 20px;
               }

               input {
                    padding: 5px;
                    width: 70%;
                    border: none;
                    outline: none;
                    margin-bottom: 10px;
               }

               label {
                    margin-top: 10px;
               }

               input[type="submit"] {
                    padding: 5px;
                    width: calc(70% + 5px * 2);
                    border: none;
                    outline: none;
                    margin-bottom: 10px;
                    cursor: pointer;

                    color: white;
                    background-color: #3694FF;
                    font-size: 18px;

                    margin-top: 20px;

                    transition: all 0.5s ease-in;
               }

               input[type="submit"]:hover {
                    background-color: #2f7cd4;
               }

               .error {
                    position: relative;
                    text-align: center;
                    padding: 5px;
                    background-color: #ba1313;
                    color: white;

                    width: 90%;

                    margin: auto;
                    margin-top: 20px;

                    border-radius: 4px;
               }
          </style>
     </head>
     <body>
          <div class="center">
                    <h1 style="color: #3694FF;">kurZ - Adminpanel</h1>

                    <form action="" method="post">
                         <label for="user">Nutzername:</label><br>
                         <input id="user" type="text" name="user" value="">
                         <br>
                         <label for="password">Passwort:</label><br>
                         <input id="password" type="password" name="password" value="">
                         <br>
                         <input type="submit" name="submit" value="Anmelden">

                         <?php
                              if (isset($_GET['error'])) {
                                   print '<div class="error">
                                             <span>Falscher Nutzername oder Passwort!</span>
                                        </div>';
                              }
                         ?>

                    </form>
          </div>

     </body>
</html>
