<?php
     function sprint($string = '') {
          if ($string == '') {
               return '';
          }
          return strip_tags(htmlentities($string, ENT_QUOTES));
     }

     function san($string = '') {
          if ($string == '') {
               return '';
          }
          return strip_tags(htmlentities($string, ENT_QUOTES));
     }
?>
