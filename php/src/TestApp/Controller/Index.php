<?php

namespace TestApp\Controller;

class Index extends \Nut\Kernel\Routing\Controller
{


    public function index ()
    {
        $R = new \Nut\Kernel\Response\Html();
        $R->data = 'The Index Form';
        $R->data .= '
        <form method="post" action="/news" enctype="multipart/form-data">
            <input type="text" name="one" value="1">
            <input type="text" name="two" value="true">
            <input type="text" name="three" value="foobar">
            <input type="file" name="yummy">
            <button type="submit">GO</button>
        </form>
        ';
        return $R;
    }


}