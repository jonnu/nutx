<?php

namespace Nut\Kernel\Routing;

/**
 * Default Request Router
 */
class PlaygroundRouter extends \Nut\Kernel implements \Nut\Kernel\Routing\RoutingInterface
{


    private $endpoints = array();


    public function resolve (\Nut\Kernel\Request $Request)
    {
        // take a request and find a route
        $parts = preg_split('~/~', $_SERVER['REQUEST_URI'], -1, \PREG_SPLIT_NO_EMPTY);

        $uri = $_SERVER['REQUEST_URI'];
        echo 'Endpoint: ' . $_SERVER['REQUEST_URI'] . "\n";
        echo 'Verb: ' . $_SERVER['REQUEST_METHOD'] . "\n\n";

        // if endpoint-verb combo is in some routing map...
        if (false === ($this->endpoints = apc_fetch(__CLASS__ . __FUNCTION__))) {
            $this->rebuild();
            apc_store(__CLASS__ . __FUNCTION__, $this->endpoints, 60);
            echo 'rebuilt and stored';
        }

        if (array_key_exists($uri, $this->endpoints)) {
            return $this->endpoints[$uri];
        }

        return 'Not Found';
    }


    private function rebuild ()
    {
        //new RecursiveDirectoryIterator();
        $basepath = realpath(__DIR__ . '/../../..');
        $objects  = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($basepath . '/TestApp2',
                \FilesystemIterator::KEY_AS_PATHNAME | \FilesystemIterator::SKIP_DOTS | \RecursiveDirectoryIterator::FOLLOW_SYMLINKS)
        );

        foreach ($objects as $name => $object) {

            try {
                $class  = strtr(substr($name, strlen($basepath), -4), '/', '\\');
                $mirror = new \ReflectionClass($class);
                $methods = array_filter($mirror->getMethods(\ReflectionMethod::IS_PUBLIC), function ($method) {
                    return !$method->isConstructor() && !$method->isDestructor() && substr($method->name, 0, 2) !== '__';
                });
            }
            catch (\ReflectionException $Exception) {
                continue;
            }

            foreach ($methods as $method) {
                $comment = $this->cleanComment($method->getDocComment());
                $tokens  = $this->getTokensFromComment($comment);

                if (isset($tokens['endpoint'])) {
                    $this->endpoints[$tokens['endpoint']] = array('class' => $mirror->name, 'method' => $method->name);
                }
            }
        }

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
    private function cleanComment ($comment)
    {
        return preg_replace('/^([\s\t]*[\s\t\/\\\*]+)(.+)?$/m', '\\2', $comment);
    }


    private function getTokensFromComment ($comment)
    {
        $tokens = array();
        foreach (explode("\n", $comment) as $line) {

            $line = trim($line);
            if (substr($line, 0, 1) !== '@') {
                continue;
            }

            $tokens[strtolower(substr($line, 1, ($position = strpos($line, ' ')) - 1))] = substr($line, $position + 1);
        }

        return $tokens;
    }


}
