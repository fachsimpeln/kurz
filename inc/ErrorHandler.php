<?php


     /**
      * ErrorHandler
      * Creates the error pages
      */
     class ErrorHandler
     {
          private $type = 'error';
          private $title;
          private $header;
          private $message;


          function __construct($type = 'error')
          {
               $this->type = $type;
          }

          public function SetTitle($text)
          {
               $this->title = $text;
          }

          public function SetHeader($text)
          {
               $this->header = $text;
          }

          public function SetMessage($text)
          {
               $this->message = $text;
          }

          public function RenderPage()
          {
               global $page;
               print '<!DOCTYPE html>
               <html lang="de" dir="ltr">
                    <head>
                         <meta charset="utf-8">
                         <title>' .  $this->title. '</title>
                         <meta name="viewport" content="width=device-width, initial-scale=1.0">
                         <link rel="icon" type="image/png" href="' . $page . 'create/favicon.png" sizes="512x512">

                         <style type="text/css">

                              .button,.title-box-content a{color:#fff}body{font:600 18px/1.5 -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;margin:0;padding:0;background:#fff}.title-box{padding:100px 0;transform:skew(0deg,-8deg) translateY(-10%)}.title-box-content{padding:15px 20px;transform:skew(0deg,8deg);color:#fff}.title-box-content h1{margin:0;padding:200px 0 0;font-size:60px}.title-box-content h3{font-weight:700}.title-box-content p{margin:0;padding:0;line-height:1.5em;width:80%}.info{background:#3f51b5}.error{background:red}.info a{background-color:#03a9f4}.info a:hover{background-color:#1f96cc}.error a{background:#c50000}.error a:hover{background:#da3c3c}.button{border:none;text-decoration:none;display:inline-block;font-size:16px;padding:20px;border-radius:4px}h3{overflow-wrap:break-word}

                         </style>

                         <script type="text/javascript">
                              const copyToClipboard = str => {
                                   const el = document.createElement(\'textarea\');  // Create a <textarea> element
                                   el.value = str;                                 // Set its value to the string that you want copied
                                   el.setAttribute(\'readonly\', \'\');                // Make it readonly to be tamper-proof
                                   el.style.position = \'absolute\';
                                   el.style.left = \'-9999px\';                      // Move outside the screen to make it invisible
                                   document.body.appendChild(el);                  // Append the <textarea> element to the HTML document
                                   const selected =
                                   document.getSelection().rangeCount > 0        // Check if there is any content selected previously
                                   ? document.getSelection().getRangeAt(0)     // Store selection if found
                                   : false;                                    // Mark as false to know no selection existed before
                                   el.select();                                    // Select the <textarea> content
                                   document.execCommand(\'copy\');                   // Copy - only works as a result of a user action (e.g. click events)
                                   alert("URL wurde kopiert!");
                                   document.body.removeChild(el);                  // Remove the <textarea> element
                                   if (selected) {                                 // If a selection existed before copying
                                        document.getSelection().removeAllRanges();    // Unselect everything on the HTML document
                                        document.getSelection().addRange(selected);   // Restore the original selection
                                   }
                              };
                         </script>

                    </head>
                    <body>
                         <section class="title-box ' .  $this->type. '">
                              <div class="title-box-content">
                                   <h1>' .  $this->header . '</h1>';
                    if ($this->type == 'error') {
                                             print '<p>
                                                       Probleme? Diese Seite wird immer angezeigt, wenn ein Problem aufgetreten ist. Weiter unten siehst du den Fehler (oder Fehlercode), der dir weiterhelfen kann.
                                                  </p>
                                                  <p>
                                                       Wenn du das Problem nicht selbst lösen kannst, kontaktiere uns bitte per Mail an <a style="background: none;" href="mailto://info@fachsimpeln.eu">info@fachsimpeln.eu</a>.
                                                  </p>';
                    }
                         print '
                                   <br />
                                   <h3>' .  $this->message. '</h3>
                                   <br />
                                   <span><a class="button ' .  $this->type . '" href="' . $page . 'create/">Zurück zur vorherigen Seite</a></span>
                              </div>
                         </section>
                    </body>
               </html>';

               die();
          }
     }
?>
