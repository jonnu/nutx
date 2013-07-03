<?php

namespace Nut\Kernel;


class Configuration extends \Nut\Kernel
{

    protected $sources = array();
    protected $data = array();

    public function __construct ()
    {
        $this->addSource(new \Nut\Kernel\Configuration\Core());
        $this->addSource(new \Nut\Kernel\Configuration\Yaml());
        parent::__construct();
    }



    public function test ()
    {
        return memory_get_usage();
    }


    public function get ($section, $key = null, $default = null)
    {
        $this->load($section);

        if (array_key_exists($section, $this->data)) {
            return $this->data[$section];
        }

        return $default;
    }


    private function load ($section)
    {
        foreach ($this->sources as $source) {
            $this->data = array_merge_recursive($this->data, $source->load());
        }
    }


    public function addSource (\Nut\Kernel\Configuration\SourceInterface $Source)
    {
        $this->sources[] = $Source;
    }


}
