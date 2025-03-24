<?php
session_start();

$id = session_id();

require_once('models\connection.php');
require_once('libraries\auth.php');
require_once('libraries\cleaners.php');

set_include_path(dirname(__FILE__) . '/../');

$route = explode("?", $_SERVER["REQUEST_URI"])[0];
$method = strtolower($_SERVER["REQUEST_METHOD"]);

switch($route) {
  case "/":
    header('Location: /etusivu.php');
    break;

  case "/etusivu.php":
    require "views/etusivu.php";
    break;

  case "/kategoriasivu.php":
    require "views/kategoriasivu.php";
    break;

  case "/yhteystietosivu.php":
    require "views/yhteystietosivu.php";
    break;

  case "/omat_tiedot.php":
    if (isLoggedIn()) {
      require "views/omat_tiedot.php";
    } else {
      header('Location: /etusivu.php');
    }
    break;

  case "/reseptin_luoimissivu.php":
    if (isLoggedIn()) {
      require "views/reseptin_luoimissivu.php";
    } else {
      header('Location: /etusivu.php');
    }
    break;
  
  default:
    echo "404";
}

?>