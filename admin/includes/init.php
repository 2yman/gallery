<?php


defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', 'C:' . DS . 'xampp' . DS . 'htdocs' . DS . 'photo-gallery');
define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'includes');


require_once("config.php");
require_once("functions.php");
require_once("session.php");
require_once("database.php");
require_once("db_model.php");
require_once("user.php");
require_once("photo.php");
