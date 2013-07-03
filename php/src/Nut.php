<?php

/**
 * Framework bootstrap
 */

require __DIR__ . '/Nut/Kernel/AutoLoader.php';

error_reporting(-1);

set_include_path(get_include_path() . ':' . realpath(__DIR__));
spl_autoload_register(array('Nut\Kernel\AutoLoader', 'loadClass'));
