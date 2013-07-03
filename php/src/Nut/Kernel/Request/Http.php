<?php

namespace Nut\Kernel\Request;

class Http extends \Nut\Kernel\Request
{

    private $verb;

    public function __construct ()
    {
        $this->verb = $_SERVER['REQUEST_METHOD'];
    }


    public function getVerb ()
    {
        return $this->verb;
    }


}
