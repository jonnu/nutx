<?php

namespace Nut\Kernel\Configuration;

class Yaml implements \Nut\Kernel\Configuration\SourceInterface
{


    public function load ()
    {
        $files = $this->locateFiles();

        $data = array();
        foreach ($files as $file) {
            $data = array_merge($data, yaml_parse_file($file));
        }

        return $data;
    }


    private function locateFiles ()
    {
        return array(
            realpath(__DIR__ . '/../../../../conf/settings.yml')
        );
    }


}
