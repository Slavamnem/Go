<?php

$request = $argv;
//echo "response";
print_r($request);

if($request[1]) {
    $file = fopen($request[1], "r+");
    $data = fread($file, 1000);
    echo $data;
}
else{
    $handle = opendir('app');
    while (false !== ($file = readdir($handle))) {
        echo "$file\n";
    }
}

//$res = fgets(STDIN);
//echo $res;
