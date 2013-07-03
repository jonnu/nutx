<?php

namespace Nut;

/**
 * Kernel
 */
abstract class Kernel
{

    /**
     * Array of class dependencies
     *
     * @var array
     */
    protected $dependencies = array();

    const DEPENDENCY = '#Nut';


    /**
     * Constructor
     */
    public function __construct ()
    {
        foreach (get_object_vars($this) as $key => $value) {

            // Ignore non-dependencies
            if ($value !== self::DEPENDENCY) {
                continue;
            }

            // Add dependency and unset to allow magic __get
            $this->dependencies[$key] = true;
            unset($this->$key);
        }
    }


    /**
     * Magic get method
     *
     * @param string $key Key of the dependency
     *
     * @return \Nut\Kernel
     */
    public function __get ($key)
    {
        if (array_key_exists($key, $this->dependencies) && $this->dependencies[$key]) {
            return ($this->$key = \Nut\Kernel\Container::get()->getNut($key));
        }

        die('Unknown dependency: ' . $key);
    }


}
