<?php

namespace Nut\Kernel;

/**
 * AutoLoader
 */
class AutoLoader
{

    static public function loadClass ($class)
    {
        $filename = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        $filename = ltrim($filename, DIRECTORY_SEPARATOR);
        return self::findPath($filename);
    }


    static public function findPath ($fileName)
    {
        if (false !== ($filePath = stream_resolve_include_path($fileName))) {
            include $filePath;
        }
    }


}
