<?php

namespace Nut\Kernel;

use \Nut\Kernel\Configuration;

/**
 * Container
 */
class Container
{
    static private $container;

    private $aliases   = array();
    private $instances = array();


    /**
     * Constructor
     */
    private function __construct ()
    {
        // Load classmap?
        $Configuration = new Configuration();
        $this->aliases = $Configuration->get('dependencies');
    }


    /**
     * Get method to retreive the container singleton
     *
     * @return \Nut\Kernel\Container
     */
    static public function get ()
    {
        if (!isset(self::$container)) {
            self::$container = new self();
        }

        return self::$container;
    }


    /**
     * Get a nut kernel singleton from the container
     *
     * @param string $nut Alias of the nut
     *
     * @return \Nut\Kernel
     */
    public function getNut ($nut)
    {
        if (array_key_exists($nut, $this->instances)) {
            return $this->instances[$nut];
        }

        if (!array_key_exists($nut, $this->aliases)) {
            throw new \Nut\Kernel\Exception('Unknown nutkernel: ' . $nut);
        }

        $this->instances[$nut] = new $this->aliases[$nut];
        return $this->instances[$nut];
    }


}
