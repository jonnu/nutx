<?php

namespace Nut\Kernel\Routing;

class Endpoint extends \Nut\Kernel
{

    public function __call ($method, $parameters)
    {
        $Response = new \Nut\Kernel\Response\Html();
        $Response->data = '<html><body><h1>404</h1></body></html>';
        //$Response->setHttpCode(404);
        return $Response;
    }


}
