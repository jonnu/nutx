<?php

namespace Nut\Kernel;

/**
 * Response
 */
class Response extends \Nut\Kernel
{
    public $data = '';
    public $headers = array();

    public function sendHeaders ()
    {
        if (isset($this->contentType)) {
            $this->headers[] = 'Content-Type: ' . $this->contentType;
        }

        foreach ($this->headers as $header) {
            header($header);
        }
    }


    public function getData ()
    {
        return $this->data;
    }


    public function output ()
    {
        $this->sendHeaders();
        echo $this->getData();
        flush();
    }

}
