<?php

     $theme = "dark";
     if (isset($_COOKIE['theme'])) {
          if ($_COOKIE['theme'] == "light") {
               $theme = "light";
          }
     }
     setcookie("theme", $theme);

?>
