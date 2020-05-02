<?php

     date_default_timezone_set("Europe/Berlin");

     // Include static files
     require __DIR__ . '/../inc/static/theme.inc.php';

     // Include classes
     require __DIR__ . '/../inc/ID.php';
     require __DIR__ . '/../inc/Entry.php';
     require __DIR__ . '/../inc/GoogleReCaptcha.php';
     require __DIR__ . '/../inc/Functions.php';
     require __DIR__ . '/../inc/ErrorHandler.php';

     // Load config
     require __DIR__ . '/../config/config.php';

     // MAIN CODE

     // Get page link
     $page = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
     $page = explode('/create/', $page)[0] . '/';

     // Setup GoogleReCaptcha
     $grc = new GoogleReCaptcha($recaptcha_secret, $recaptcha_public);

     // Check that url is set
     if (!isset($_POST['url'])) {
          include(__DIR__ . '/html.create.php');
          die();
     }

     if (!isset($_POST['g-recaptcha-response'])) {
          $e = new ErrorHandler();
          $e->SetTitle("kurZ - Fehlercode 500");
          $e->SetHeader("Fehler!");
          $e->SetMessage('[Fehlercode 500] Bitte klicke auf die reCAPTCHA-Verifikations-Box, sodass wir wissen, dass du kein Roboter bist. Bitte überprüfe deine Eingaben und versuche es erneut!');
          $e->RenderPage();
     }

     // Verify ReCaptcha
     if (!$grc->ValidateRequest($_POST['g-recaptcha-response'])) {
          $e = new ErrorHandler();
          $e->SetTitle("kurZ - Fehlercode 0101");
          $e->SetHeader("Fehler!");
          $e->SetMessage('[Fehlercode 0101] <b style="font-weight: bold;">DU BIST EIN ROBOTER! (oder hast diese Seite neugeladen)</b><br />Bitte überprüfe deine Eingaben und versuche es erneut!');
          $e->RenderPage();
     }

     // Sanitize URL
     $url = $_POST['url'];
     $url = Functions::SanitizeURL($url);

     if ($url === false) {
          $e = new ErrorHandler();
          $e->SetTitle("kurZ - Fehlercode 200");
          $e->SetHeader("Fehler!");
          $e->SetMessage('[Fehlercode 200] Die angegebene URL <i>(' . Functions::sprint($url) . ')</i> ist ungültig! Bitte überprüfe deine Eingaben und versuche es erneut!');
          $e->RenderPage();
     }

     // Get ID
     $custom = false;
     $ID = new ID($base_path);

     if ($_POST['custom'] === '' || $_POST['custom'] === null) {
          $ID->GenerateID();
     } else {
          $custom_id = $_POST['custom'];
          $custom = true;
          $resp = $ID->CustomID($custom_id);

          if ($resp === 'error') {
               $e = new ErrorHandler();
               $e->SetTitle("kurZ - Fehlercode 300");
               $e->SetHeader("Fehler!");
               $e->SetMessage('[Fehlercode 300] Die gewünschte ID <i>(' . Functions::sprint($custom_id) . ')</i> kann nicht verwendet werden! Das Zeichen / darf nicht verwendet werden, ebenso muss die ID 3 Zeichen oder mehr sein. Bitte versuche es erneut mit einer anderen ID!');
               $e->RenderPage();
          } elseif ($resp === 'exists') {
               $e = new ErrorHandler();
               $e->SetTitle("kurZ - Fehlercode 400");
               $e->SetHeader("Fehler!");
               $e->SetMessage('[Fehlercode 400] Die von dir gewählte Wunschdomain <i>(' . Functions::sprint($custom_id) . ')</i> ist leider nicht mehr verfügbar! Bitte ändere deine Eingaben und versuche es erneut!');
               $e->RenderPage();
          }
     }

     // Create entry
     $entry = new Entry($ID->PATH);

     $entry->SetID($ID->ID);
     $entry->SetURL($url);
     $entry->SetCustom($custom);

     $entry->Create();

     $e = new ErrorHandler('info');
     $e->SetTitle("kurZ - URL");
     $e->SetHeader("URL erstellt");
     $e->SetMessage('Ihre gekürzte URL lautet <label style="background-color: #3f51b5; cursor: pointer; text-decoration: underline;" onclick="copyToClipboard(\'' . $page . Functions::sprint($ID->ID) . '\')">' . $page . Functions::sprint($ID->ID) . '</label> <br /> Sie verlinkt auf <i>(' . Functions::sprint($url) . ')</i>.');
     $e->RenderPage();

?>
