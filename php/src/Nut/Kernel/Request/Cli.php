<?php

namespace Nut\Kernel\Request;

class Cli extends \Nut\Kernel\Request
{

    private $args;

    public function __construct ()
    {
        $this->args = array();
    }


}
