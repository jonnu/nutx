<?php

namespace Nut;

/**
 * Shell
 */
class Shell extends \Nut\Kernel
{

    /**
     * Configuration
     * @var \Nut\Kernel\Configuration
     */
    protected $Configuration = self::DEPENDENCY;


    /**
     * Router
     * @var \Nut\Kernel\Routing\Router
     */
    protected $Router = self::DEPENDENCY;




    /**
     * Handle an application request
     *
     * @param \Nut\Kernel\Request $Request Application request
     *
     * @return \Nut\Kernel\Response
     */
    public function handle (\Nut\Kernel\Request $Request)
    {
        //list($Controller, $Method) = array_values($this->Router->resolve($Request));
        //echo $Controller . "\n";
        //echo sprintf('%0.3fkb', memory_get_usage() / 1024);

        //$string   = call_user_func_array(array(new $Controller, $Method), array());
        $string   = 'Test';
        $Response = new \Nut\Kernel\Response\Raw;
        $Response->data = $string;

        return $Response;
    }


    /**
     * Handle an application request
     *
     * @param \Nut\Kernel\Request $Request Application request
     *
     * @return \Nut\Kernel\Response
     */
    public function handle2 (\Nut\Kernel\Request $Request)
    {
        // find out the resource we are requesting
        // 1. $Request->getEndpointRequested.
        //
        // then, dispatch the request to the controller that handles that endpoint
        // 2. $this->Router->resolveController()
        //
        // when we have that, sent the request into the controller's endpoint, e.g.
        // 3. $Response = $Controller->displayData(arg1, arg2, arg3, arg4)
        //
        // controller will always create and return a \Nut\Kernel\Response object, of a child type (e.g. Raw, Html, Json, Image).
        // 4. return $Response
        //
        // Response object knows how to stream itself back to the user? what if we get an image and the request was cli? good Q...

        $method     = 'index';
        $controller = $this->Router->resolve($Request);

        if (class_exists($controller)) {
            $object = new $controller();
            $data   = call_user_func_array(array($object, $method), array());
        } else {
            $data = '';
        }

        if ($data instanceof \Nut\Kernel\Response) {
            return $data;
        }

        switch (gettype($data)) {
            case 'NULL':
                $Response = new \Nut\Kernel\Response\Raw();
                $Response->data = ob_get_clean();
                break;
            case 'string':
                $Response = new \Nut\Kernel\Response\Raw();
                $Response->data = $data;
                break;
            default:
                die('???');
        }

        return $Response;
    }


}
