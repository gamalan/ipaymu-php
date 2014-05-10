<?php
/**
 * User: gamalan
 * Date: 5/10/14
 * Time: 5:30 AM
 */


spl_autoload_register(function($class)
{
    $file = __DIR__.'/../src/'.strtr($class, '\\', '/').'.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
});