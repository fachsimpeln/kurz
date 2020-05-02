<?php

     /**
      * GoogleReCaptcha Validator
      */
     class GoogleReCaptcha
     {

          private $recaptcha_secret;
          private $recaptcha_public;

          function __construct($recaptcha_secret, $recaptcha_public)
          {
               $this->recaptcha_secret = $recaptcha_secret;
               $this->recaptcha_public = $recaptcha_public;
          }

          public function ValidateRequest($g_recaptcha_response)
          {
               if (!isset($g_recaptcha_response) || empty($g_recaptcha_response)) {
                    return false;
               }

               // Verify the reCAPTCHA response
               $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $this->recaptcha_secret . '&response=' . $g_recaptcha_response);

               // Decode json data
               $responseData = json_decode($verifyResponse);

               if(!$responseData->success) {
                    return false;
               }

               return true;
          }

          public function CaptchaCode()
          {
               return '<div class="g-recaptcha" data-sitekey="' . $this->recaptcha_public . '"></div>';
          }
     }


?>
