<?php


require_once('models\connection.php');

set_include_path(dirname(__FILE__) . '/../');

$route = explode("?", $_SERVER["REQUEST_URI"])[0];
$method = strtolower($_SERVER["REQUEST_METHOD"]);

switch($route) {
    case "/":
      require "views/etusivu.php";
    break;

    case "/kirjaudu.php":
      require "views/kirjaudu.php";
    break;

    case "/rekisteroidy.php":
      require "views/rekisteroidy.php";
    break;

    default:
      echo "404";
}
?>