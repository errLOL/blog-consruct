<?php

namespace c;
use core\Request;
use core\Exception\ErrorNotFoundException;

abstract class BasicController
{
    protected $title;
    protected $content;
    protected $is_admin;
    protected $is_auth;
    protected $request;

    public function __construct(Request $request = null) {
        $this->title = 'Главная';
        $this->content = '';
        $this->is_admin = true;//$this->is_admin();
        $this->is_auth = true;//$this->is_auth();
        $this->request = $request;
    }

    public function __call($name, $params)
    {
        throw new ErrorNotFoundException();
    }

    public function errHundler($message, $code = '503')
    {
        $this->title = $code;
        $this->content = $this->build('v_'. $code, [
            'message' => $message
        ]);
    }
    
    public function build(string $filename, array $vars = []) {
        extract($vars);
        ob_start();
        $fname = sprintf('view/%s.php', $filename);
        include $fname;
        return ob_get_clean();
    }

    public function render() {
        echo $this->build('v_main', [
            'is_admin' => $this->is_admin,
            'is_auth' => $this->is_auth,
            'title' => $this->title,
            'content' => $this->content
        ]);
    }

    public function redirect($url = '')
    {
       header('Location:' . ROOT . $url);
       exit();
    }
   
    protected function is_auth() {
        $is_auth = false;
        if($this->request->session('is_auth')) {
            $is_auth = true;
        }
        return $is_auth;
    }

    protected function is_admin() {
        $admin = false;
        if($this->request->session('is_admin')) {
            $admin = true;
        }
        return $admin;
    }
}