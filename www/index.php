<?php
/**
 * Nut Framework
 *
 * @author jonnu <code@jonnu.eu>
 * @link   http://www.github.com/jonnu/nut
 * 
 *
 *     )" .
 *    /    \      (\-./
 *   /     |    _/ o. \
 *  |      | .-"      y)-
 *  |      |/       _/ \
 *  \     /j   _".\(@)
 *   \   ( |    `.''  )
 *    \  _`-     |   /
 *      "  `-._  <_ (
 *             `-.,),)
 *
 */

use \Nut\Shell;
use \Nut\Kernel\Request;

require_once __DIR__ . '/../php/src/Nut.php';

$nutShell = new Shell();
$request  = Request::negotiate();
$response = $nutShell->handle($request);

$response->output();
