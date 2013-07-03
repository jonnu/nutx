<?php

namespace TestApp\Controller\News;

use Nut\Kernel\Response;
use Nut\Kernel\Routing\Controller;

/**
 * Index
 */
class Index extends Controller
{

    protected $Configuration = self::DEPENDENCY;
    protected $Request = self::DEPENDENCY;


    public function index ()
    {
        $Response       = new Response\Json();
        $Response->data = array('type' => $_SERVER['REQUEST_METHOD']);

        return $Response;
    }


    public function test ($x = null)
    {
        echo 'test';
        var_dump($x);
    }


    /**
     * Endpoint for displaying an article?
     *
     * @param string $slug Information
     *
     * @Verb GET
     * @Path /news/view/:slug
     * @View test.html
     *
     * @return array
     */
    public function displayArticle ($slug)
    {
        return array();
    }


}
