<?php

namespace Phpblog\Controller;

class Err404Controller extends BasicController
{
    public function indexAction()
    {
        $this->title = '404';
        $this->content = $this->build('v_404', []); 
    }
}