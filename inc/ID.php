<?php

     /**
      * ID
      * Creates and validates the IDs and local file paths for the shortend URL
      */
     class ID
     {

          private $base_path;

          public $ID;
          public $PATH;

          public function __construct($base_path)
          {
               $this->base_path = $base_path . '/';
          }

          public function CustomID($custom_id)
          {
               if ($custom_id === null || $custom_id === '' || $custom_id === 0) {
                    return 'error';
               }

               if (!$this->ValidateCode($custom_id)) {
                    return 'error';
               }

               $path = $this->GetPath($custom_id);

               if (file_exists($path)) {
                    return 'exists';
               }

               $this->ID = $custom_id;
               $this->PATH = $path;
          }

          public function GenerateID()
          {
               // Set length extension to 0 for the start
               $length = 0;
               do {
                    // Generate random number
                    $code = mt_rand(10, 1000 + $len);

                    $path = $this->GetPath(Functions::Base32Encode($code));

                    // Set tempcode to code
                    $temp_code = $code;
                    // Set code to the Base32 value of the code
                    $code = Functions::Base32Encode($code);

                    // If there is a next round, add 10 for the random number generator
                    $len += 10;

               } while (file_exists($path) || Functions::Base32Decode($code) !== $temp_code || !$this->ValidateCode($code));

               $this->ID = $code;
               $this->PATH = $path;
          }

          public function GetPath($ID)
          {
               // Split the code in array
               $path_array = str_split($ID);

               // Set base path
               $path = $this->base_path;

               // Combine code array to one path string
               foreach ($path_array as $key => $value) {
                    $path .= $value . '/';
               }
               // Remove trailing / and add .json
               $path = rtrim($path, '/') . ".json";

               return $path;
          }

          private function ValidateCode($code)
          {
               if (strlen($code) < 3) {
                    return false;
               }

               $blacklist = array("/", "index.php", "index", "php", "php2", "php3", "php4", "php5", "php6", "php7", "phps", "pht", "phtml", "pgif", "shtml", "htaccess", "phar", "inc");

               $files = array("_data", "create", "cookie", "config", "admin", "css", "inc", "dashboard");

               $blacklist = array_merge($blacklist, $files);


               foreach ($blacklist as $key => $value) {
                    if(strpos($code, $value) !== false) {
                         return false;
                    }
               }
               return true;
          }
     }



?>
