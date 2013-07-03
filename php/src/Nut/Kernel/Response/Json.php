<?php

namespace Nut\Kernel\Response;

/**
 * Response
 */
class Json extends \Nut\Kernel\Response
{
    protected $contentType = 'application/json';


    public function getData ()
    {
        return json_encode($this->data);
    }

}
