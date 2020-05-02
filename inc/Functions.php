<?php

     /**
      * Functions
      * General functions
      */
     class Functions
     {

          public static function SanitizeURL($url)
          {
               $url = filter_var($url, FILTER_SANITIZE_URL);
               if (!filter_var($url, FILTER_VALIDATE_URL,
                         FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)
               ) {
                    return false;
               }
               return $url;
          }

          public static function Base32Encode($number)
          {
               $number = base_convert($number, 10, 32);
               return $number;
          }

          public static function Base32Decode($number)
          {
               $number = base_convert($number, 32, 10);
               return $number;
          }

          public static function sprint($string = '') {
               if ($string == '') {
                    return '';
               }
               return strip_tags(htmlentities($string, ENT_QUOTES));
          }

          public static function san($string = '') {
               return self::sprint($string);
          }


     }


?>
