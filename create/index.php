<?php
     /*
          502  URL ERROR
     */

     require 'xss.php';

     $theme = "dark";
     //var_dump($_COOKIE);
     if ($_COOKIE['theme'] == "light") {
          $theme = "light";
          setcookie("theme", "light");
     } else {
          setcookie("theme", "dark");
     }

     if (isset($_POST['url'])) {

          // Validate reCAPTCHA box
          if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
               // Google reCAPTCHA API secret key
               $secretKey = '<reCAPTCHA API>';

               // Verify the reCAPTCHA response
               $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']);

               // Decode json data
               $responseData = json_decode($verifyResponse);

               if(!($responseData->success)) {
                    $error_type_hhIns6Us = 'error';
                    $error_title_uG4Fd1 = 'kurZ - Fehlercode 0101';
                    $error_header_uG4Fd1 = 'Fehler!';
                    $error_msg_Olsf1 = '[Fehlercode 0101] <b style="font-weight: bold;">DU BIST EIN ROBOTER! (oder hast diese Seite neugeladen)</b><br />Bitte überprüfe deine Eingaben und versuche es erneut!';
                    include 'fehler.php';
                    die();
               }
          } else {
               $error_type_hhIns6Us = 'error';
               $error_title_uG4Fd1 = 'kurZ - Fehlercode 603';
               $error_header_uG4Fd1 = 'Fehler!';
               $error_msg_Olsf1 = '[Fehlercode 603] Bitte klicke auf die reCAPTCHA-Verifikations-Box, sodass wir wissen, dass du kein Roboter bist. Bitte überprüfe deine Eingaben und versuche es erneut!';
               include 'fehler.php';
               die();
          }

          $url = $_POST['url'];

          if (!filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED)) {
               $error_type_hhIns6Us = 'error';
               $error_title_uG4Fd1 = 'kurZ - Fehlercode 502';
               $error_header_uG4Fd1 = 'Fehler!';
               $error_msg_Olsf1 = '[Fehlercode 502] Die angegebene URL <i>(' . sprint($url) . ')</i> ist nicht valid! Bitte überprüfe deine Eingaben und versuche es erneut!';
               include 'fehler.php';
               die();
          }

          $code = '_data';
          while ($code == '_data' || $code == 'create' || $code == 'cookie' || Base32Decode($code) != $temp_code) {
               $len = 0;
               $code = mt_rand(10, 1000);

               $path_ar = str_split(Base32Encode($code));
               $path = "";
               foreach ($path_ar as $key => $value) {
                    $path .= $value . '/';
               }
               $path = rtrim($path, '/') . ".php";



               while (file_exists($path)) {
                    $code = mt_rand(10, 1000 + $len);

                    $path_ar = str_split($code);
                    $path = "";
                    foreach ($path_ar as $key => $value) {
                         $path .= $value . '/';
                    }
                    $path = rtrim($path, '/') . ".php";

                    $len += 1;
               }
               $temp_code = $code;
               $code = Base32Encode($code);
          }

          //$path = '9/o/g.php';

          date_default_timezone_set("Europe/Berlin");
          $file = array();
          $file['id'] = $code;
          $file['url'] = base64_encode($url);
          $file['time'] = time();

          $path_w = substr($path, 0, -5);;

          if (!file_exists("../_data/" . $path_w)) {
              mkdir("../_data/" . $path_w, 0777, true);
          }

          file_put_contents("../_data/" . $path, "<?php/*" . json_encode($file));



          $error_type_hhIns6Us = 'info';
          $error_title_uG4Fd1 = 'kurZ - URL';
          $error_header_uG4Fd1 = 'URL erstellt';
          $error_msg_Olsf1 = 'Ihre gekürzte URL lautet <label style="background-color: #3f51b5; cursor: pointer; text-decoration: underline;" onclick="copyToClipboard(\'http://<URL>/' .  $code . '\')">http://<URL>/' .  $code . '</label> <br /> Sie verlinkt auf <i>(' . sprint($url) . ')</i>.';
          include 'fehler.php';
          die();
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


?>

<!DOCTYPE html>
<html lang="de" dir="ltr" data-theme="<?=$theme;?>">
     <head>
          <meta charset="utf-8">
          <title>kurZ - Erstelle deinen Link</title>
          <!-- ev4Bmx9C3DDunwp2w -->
          <style>
               * {
                    font-family: BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
               }

               html {
                    --bg: #FCFCFC;
                    --bg-panel: #EBEBEB;
                    --color-headings: #0077FF;
                    --color-text: #333333;
               }

               html[data-theme='dark'] {
                    --bg: #333333;
                    --bg-panel: #434343;
                    --color-headings: #3694FF;
                    --color-text: #B5B5B5;
               }

               body {
                    background-color: var(--bg);
                    color: var(--color-text);
               }

               h1 {
                    color: var(--color-headings);
               }

               h2 {
                    color: var(--color-text);
               }

               #url-text {
                    width: 292px;
                    padding: 5px 4px 5px 6px;
                          /* t   r   b   l */
                    margin-bottom: 25px;
               }

               #url-text {
               	-webkit-border-radius: 2px;
               	-moz-border-radius: 2px;
               	border-radius: 2px;
               	border: 1px solid #cfcfcf;
                    color: #333333;
               }
               #url-text:focus {
               	outline:0;
               	border:1px solid var(--color-headings);
               	-webkit-box-shadow: 0 0 5px 4px rgba(36,184,194, 0.10);
               	-moz-box-shadow: 0 0 5px 4px rgba(36,184,194, 0.10);
               	box-shadow: 0 0 5px 4px rgba(36,184,194, 0.10);
               }

               .mittig {
                    position: absolute;
               	left: 50%;
               	top: 50%;
               	transform: translate(-50%, -50%);
               	width: 330px;
               	height: 405px;
               	box-sizing: border-box;
                    border-radius: 8px;
                    background-color: var(--bg-panel);
                    color: white;
                    padding: 15px;
               }

               input[type=button], input[type=submit], input[type=reset] {
                    background-color: var(--color-headings);
                    border: none;
                    color: white;
                    padding: 16px 32px;
                    text-decoration: none;
                    cursor: pointer;
                    border-radius: 6px;
                    margin-top: 0px;
               }

               input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover {
                    background-color: #2196f3;
               }

               input[type=checkbox] {
                    height: 0;
                    width: 0;
                    visibility: hidden;
               }

               label {
                    cursor: pointer;
                    text-indent: -9999px;
                    width: 52px;
                    height: 27px;
                    background: grey;
                    float: right;
                    border-radius: 100px;
                    position: relative;
               }

               label:after {
                    content: '';
                    position: absolute;
                    top: 3px;
                    left: 3px;
                    width: 20px;
                    height: 20px;
                    background: #fff;
                    border-radius: 90px;
                    transition: 0.3s;
               }

               input:checked + label {
                    background: var(--color-headings);
               }

               input:checked + label:after {
                    left: calc(100% - 5px);
                    transform: translateX(-100%);
               }

               label:active:after {
                    width: 45px;
               }

               .toggle-container {
                    margin-top: 7px;
               }

               html.transition,
               html.transition *,
               html.transition *:before,
               html.transition *:after {
                    transition: all 750ms !important;
                    transition-delay: 0 !important;
               }

               #sw {
                    color: var(--color-text);
               }
          </style>
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="icon" type="image/png" href="http://<URL>/create/favicon.png" sizes="512x512">
          <script src="https://www.google.com/recaptcha/api.js" async defer></script>

          <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
          <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
          <script>
               window.addEventListener("load", function(){
                    window.cookieconsent.initialise({
                         "palette": {
                              "popup": {
                                   "background": "#0077ff",
                                   "text": "#fcfcfc"
                         },
                         "button": {
                              "background": "#fcfcfc",
                              "text": "#333333"
                         }
                    },
                    "theme": "classic",
                    "content": {
                         "message": "Diese Website verwendet Cookies, um dir die beste Erfahrung zu bieten!",
                         "dismiss": "Verstanden!",
                         "href": "http://azeo.eu/s/cookie"
                    }
               })});
          </script>
     </head>
     <body>
          <div class="mittig">
               <h1 style="font-size:2.3em; margin: 0px; padding: 0px; text-align: center; font-weight: bold; letter-spacing: 0.05em;">kurZ</h1>
               <h2 style="font-size:1.2em; margin: 0px; padding: 0px; text-align: center;">Kürze deinen Link</h2>
               <br />
               <form action="" method="post">
                    <input id="url-text" type="text" name="url" autocomplete="off" pattern="^https?:\/\/[^\s$.?#].[^\s]*$" placeholder="http(s)://">
                    <br />
                    <div class="g-recaptcha" data-sitekey="<reCAPTCHA SITEKEY>"></div>
                    <br />
                    <input style="width: 100%; font-size: 17px;" type="submit" name="submit" value="kürZen">
               </form>
               <div class="toggle-container">
                    <span id="sw">Dunkel/Hell</span><input type="checkbox" id="switch" <?php if ($theme == 'light') {
                         echo 'checked';
                    } ?> name="theme" /><label for="switch">Dunkel/Hell</label>
               </div>
          </div>

          <script type="text/javascript">
               var checkbox = document.querySelector('input[name=theme]');

               checkbox.addEventListener('change', function() {
                    if(this.checked) {
                         trans()
                         document.cookie = "theme=light";
                         document.documentElement.setAttribute('data-theme', 'light')
                    } else {
                         trans()
                         document.cookie = "theme=dark";
                         document.documentElement.setAttribute('data-theme', 'dark')
                    }
               })

               let trans = () => {
                    document.documentElement.classList.add('transition');
                    window.setTimeout(() => {
                         document.documentElement.classList.remove('transition')
                    }, 1000)
               }
          </script>
     </body>
</html>
