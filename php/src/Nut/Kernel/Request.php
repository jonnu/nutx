<?php

namespace Nut\Kernel;

use \Nut\Kernel\Request;

/**
 * Request
 */
class Request extends \Nut\Kernel
{
    protected $Test = self::DEPENDENCY;


    static public function negotiate ()
    {
        // either CLI or HTTP.
        if (false) {
            return new Request\Cli();
        }

        return new Request\Http();
    }


/*
    public function getHeader ($key, $default = null)
    {
        $key = strtr(strtoupper($key), '-', '_');
        if (!in_array($key, array('CONTENT_TYPE', 'CONTENT_LENGTH')) && false === strpos($key, 'HTTP_')) {
            $key = 'HTTP_' . $key;
        }

        if (isset($_SERVER[$key])) {
            return $_SERVER[$key];
        }

        return $default;
    }
*/


}
