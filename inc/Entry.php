<?php

     /**
      * Entry
      * Creates the entries on the file system and updates them.
      * Entry assumes the data it is given is valid
      */
     class Entry
     {

          private $path;

          private $time;
          private $id;
          private $url;
          private $custom = false;

          function __construct($path)
          {
               $this->path = $path;
          }

          public function Create()
          {
               // Create file array
               $file = array();
               $file['id'] = base64_encode($this->id);
               $file['url'] = base64_encode($this->url);
               $file['time'] = time();
               $file['custom'] = $this->custom;
               $file['visits'] = 0;

               // Create directory
               $path_parts = pathinfo($this->path);
               mkdir($path_parts['dirname'], 0777, true);

               file_put_contents($this->path, json_encode($file, JSON_PRETTY_PRINT));

               return true;
          }

          public function Read()
          {
               // Create file array
               $file = array();

               if (!file_exists($this->path)) {
                    return false;
               }
               $file = file_get_contents($this->path);
               $file = json_decode($file, true);

               // Add visitor count
               $file['visits'] += 1;
               file_put_contents($this->path, json_encode($file, JSON_PRETTY_PRINT));

               return $file;
          }

          public function SetID($text)
          {
               $this->id = $text;
          }

          public function SetURL($text)
          {
               $this->url = $text;
          }

          public function SetCustom($bool)
          {
               $this->custom = $bool;
          }


     }


?>
