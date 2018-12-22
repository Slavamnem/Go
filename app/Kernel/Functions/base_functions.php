<?php

if (!function_exists('dd')) {
    function dd()
    {
        echo "dd!";
    }
}
if (!function_exists('dump')) {
    function dump($data)
    {
        ?>
        <div style="background-color: black; color:white; width:100%;">
            <?php if(is_array($data) or is_object($data)): ?>
                <pre style="background-color: black; color:white;">
                     <?php print_r($data); ?>
                </pre>
            <?php else: ?>
                <?=$data;?>
            <?php endif; ?>
        </div>
        <?php
    }
}
if (!function_exists('getUrl')) {
    function getUrl()
    {
        return \App\Kernel\Classes\Url::buildUrl();
    }
}
if (!function_exists('getRoutes')) {
    function getRoutes($routesFile)
    {
        return require_once $routesFile;
    }
}