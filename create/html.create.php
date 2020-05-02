<!DOCTYPE html>
<html lang="de" dir="ltr" data-theme="<?=$theme;?>">
     <head>
          <meta charset="utf-8">
          <title>kurZ - Erstelle deinen Link</title>
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

               #url-text, #custom {
                    width: 292px;
                    padding: 5px 4px 5px 6px;
                          /* t   r   b   l */
                    margin-bottom: 10px;
               }

               #custom {
                    margin-bottom: 25px;
               }

               #url-text, #custom {
               	-webkit-border-radius: 2px;
               	-moz-border-radius: 2px;
               	border-radius: 2px;
               	border: 1px solid #cfcfcf;
                    color: #333333;
               }
               #url-text:focus, #custom:focus {
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
          <link rel="icon" type="image/png" href="<?=$page;?>create/favicon.png" sizes="512x512">
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
                         "href": "<?=$page;?>cookie"
                    }
               })});
          </script>
     </head>
     <body>
          <div class="mittig">
               <h1 style="font-size:2.3em; margin: 0px; padding: 0px; text-align: center; font-weight: bold; letter-spacing: 0.05em;">kurZ</h1>
               <h2 style="font-size:1.2em; margin: 0px; padding: 0px; text-align: center;">Kürze deinen Link</h2>
               <br />
               <form action="" method="post" onsubmit="return submitForm()">
                    <input id="url-text" type="text" name="url" autocomplete="off" pattern="^https?:\/\/[^\s$.?#].[^\s]*$" placeholder="http(s)://">
                    <br />
                    <input id="custom" type="text" oninput="customurlF()" name="custom" autocomplete="off" placeholder="Eigene ID (automatisch generiert wenn leer)">
                    <br />
                    <?php echo $grc->CaptchaCode(); ?>
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
               var customurl = document.getElementById('custom');


               function submitForm() {
                    if (customurl.style.borderColor == "#E23636" || customurl.style.borderColor == "rgb(226, 54, 54)") {
                         alert('Diese Custom-URL ist nicht verfügbar!');
                         return false;
                    }
                    return true;
               }
               function customurlF() {
                    let xhr = new XMLHttpRequest();
                    xhr.open("GET", '<?=$page;?>create/exists.php?cname=' + encodeURIComponent(customurl.value));
                    xhr.responseType = 'json';

                    xhr.send();

                    // the response is {"message": "Hello, world!"}
                    xhr.onload = function() {
                         let responseObj = xhr.response;
                         if(responseObj.taken == 1) {
                              customurl.style.borderColor = "#E23636";
                         } else {
                              customurl.style.borderColor = getComputedStyle(document.documentElement).getPropertyValue('--color-headings');
                         }
                    };
               }


          </script>

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
