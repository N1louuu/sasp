<?php
session_start();

$id = session_id();

require_once('models\connection.php');
require_once('libraries\auth.php');

set_include_path(dirname(__FILE__) . '/../');

$route = explode("?", $_SERVER["REQUEST_URI"])[0];
$method = strtolower($_SERVER["REQUEST_METHOD"]);

switch($route) {
    case "/":
      header('Location: /etusivu.php');
    break;

    default:
      echo "404";
}

?>