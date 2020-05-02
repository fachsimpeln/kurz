# kurz
> Open-Source URL-Shortener

An URL Shortener shortens a __long URL__, such as a link to a DropBox file, to a much __shorter__ one.
This URL Shortener can be installed on any web server with PHP.
The project is currently only available in *german*, a translation to english is scheduled.

[![CodeFactor](https://www.codefactor.io/repository/github/fachsimpeln/kurz/badge)](https://www.codefactor.io/repository/github/fachsimpeln/kurz) [![License](https://img.shields.io/github/license/fachsimpeln/kurz?color=%23097ABB)](https://github.com/fachsimpeln/kurz/blob/master/LICENSE) [![first-timers-only](https://img.shields.io/badge/first--timers--only-friendly-blue.svg)](https://www.firsttimersonly.com/)

## Installation
1. To install, simply clone the repo and save the files in your web directory.
2. Then edit the config to your liking.
3. That's it!

### Requirements
- Apache2 Webserver
- __.htaccess files enabled__
- __mod_rewrite__ apache module enabled
- __PHP7__ installed

## Config
The configuration is pretty easy. Open the file `config/config.php` and edit it.
```php
<?php

     // ReCaptcha settings
     $recaptcha_secret = "<YOUR_RECAPTCHA_SECRET>";
     $recaptcha_public = "<YOUR_RECAPTCHA_SITE_KEY>";

     // Dashboard creds
     $admin_user = "admin";
     $admin_password = "<PLEASE_CHANGE>";

     // Path for data (optional)
     $base_path = __DIR__ . "/../_data/";

?>
```

## Live Demo
A live version of the project can be found at http://azeo.eu/s

## Have fun!
