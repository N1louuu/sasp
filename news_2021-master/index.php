<?php
session_start();

$id = session_id();

echo "session: ".$id;

require_once('models\connection.php');
require_once('libraries\auth.php');

set_include_path(dirname(__FILE__) . '/../');

$route = explode("?", $_SERVER["REQUEST_URI"])[0];
$method = strtolower($_SERVER["REQUEST_METHOD"]);

switch($route) {
    case "/":
      header('Location: /etusivu.php');
    break;

    case "/etusivu.php":
      if (isLoggedIn()) {
        require "views/arvostelu.php";
      } else {
        require "views/etusivu.php";
      }
    break;

    case "/kirjaudu.php":
      require "views/kirjaudu.php";
    break;

    case "/rekisteroidy.php":
      require "views/rekisteroidy.php";
    break;

    case "/arvostelu.php":
      if (isLoggedIn()) {
        require "views/arvostelu.php";
      } else {
        header('Location: /etusivu.php');
      }
    break;

    case "/uusiArvostelu.php":
      if (isLoggedIn()) {
        require "views/uusiArvostelu.php";
      } else {
        header('Location: /etusivu.php');
      }
    break;

    default:
      echo "404";
}

?>