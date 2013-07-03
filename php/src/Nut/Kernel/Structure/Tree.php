<?php

namespace Nut\Kernel\Structure;


class Tree
{

    /**
     * Tree data (represented as nested arrays)
     * @var array
     */
    private $tree = array();


    /**
     * Set
     * @param \Nut\Kernel\Structure\Tree $tree Tree
     */
    public function setTree (\Nut\Kernel\Structure\Tree $tree)
    {
        $this->tree = $tree;
    }


    /**
     * Get
     * @return array
     */
    public function getTree ()
    {
        return $this->tree;
    }

}
