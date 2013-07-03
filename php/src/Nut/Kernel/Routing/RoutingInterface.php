<?php

namespace Nut\Kernel\Routing;


/**
 * Routing interface
 */
interface RoutingInterface
{

    /**
     * Resolve
     *
     * @param \Nut\Kernel\Request $Request Request
     *
     * @return string
     */
    public function resolve (\Nut\Kernel\Request $Request);


}