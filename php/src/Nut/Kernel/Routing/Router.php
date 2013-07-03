<?php

namespace Nut\Kernel\Routing;

/**
 * Default Request Router
 */
class Router extends \Nut\Kernel implements \Nut\Kernel\Routing\RoutingInterface
{


    public function resolve (\Nut\Kernel\Request $Request)
    {
        // take a request and find a route!
        $parts = preg_split('~/~', $_SERVER['REQUEST_URI'], -1, \PREG_SPLIT_NO_EMPTY);

        $controller_dir   = 'Controller';
        $application_name = 'TestApp';
        $method_name      = 'index';

        if (count($parts) === 0) {
            return $application_name . '\\' . $controller_dir . '\\Index';
        }

        $controller_name  = ucfirst($parts[0]);

        if (!class_exists($application_name . '\\' . $controller_dir . '\\' . $controller_name)) {
            // maybe its a folder.
            if (is_dir('../php/src/' . $application_name . \DIRECTORY_SEPARATOR . $controller_dir . \DIRECTORY_SEPARATOR . $controller_name)) {
                $controller_name = $application_name . '\\' . $controller_dir . '\\' . $controller_name . '\\Index';
            }
        }

        return $controller_name;
    }


}


/*
/news
    - could be /News/Index - index()
    - could be /News - index()

/news/view/some-article
    - could be /News/View/SomeArticle - index()
    - could be /News/View some_article()
    - could be /News view($1=some-article)
*/
