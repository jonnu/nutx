<?php

namespace TestApp2\Forum\Endpoint;

class Dashboard extends \Nut\Kernel\Routing\Endpoint {


    /**
     * Forum Index
     *
     * @Endpoint /forum
     *
     * @return string
     */
    public function index ()
    {
        $string = 'this is the index of the forum, bitch';
        return $string;
    }


}