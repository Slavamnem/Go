<?php
require __DIR__ . "/vendor/autoload.php";
use App\Kernel\Router;

const PARAMETRS = 5;
$params = [];
for($i = 1; $i <= PARAMETRS; $i++){
    if($_GET["par".$i]) $params[] = $_GET["par".$i];
}
$url = (count($params))? implode("/", $params) : "";

Router::sendRequest($url);

echo "<br>_____________________________________<br>";
