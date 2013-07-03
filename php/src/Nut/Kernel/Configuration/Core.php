<?php

namespace Nut\Kernel\Configuration;

/**
 * Core
 */
class Core implements \Nut\Kernel\Configuration\SourceInterface
{


    /**
     * 
     * @return array
     */
    public function load ()
    {
        return array(
            'dependencies' => $this->getDependencies(),
            'default' => array(
                'test' => 1,
                'bootstrap' => true
            )
        );
    }


    /**
     * Get core dependencies which the framework will fail without
     *
     * @return array
     */
    private function getDependencies ()
    {
        return array(
            'Configuration' => '\Nut\Kernel\Configuration'
        );
    }


}