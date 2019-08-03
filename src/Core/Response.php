<?php

namespace Phpblog\Core;

class Response
{
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';
    
    private $get;
	private $post;
	private $cookie;
	private $files;
	private $session;

    public function __construct($get, $post, $cookie, $files, $session)
	{
		$this->get = $get;
		$this->post = $post;
		$this->cookie = $cookie;
		$this->files = $files;
		$this->session = $session;
    }
    
    
    public function withGet($key, $value)
    {   
        return $this->get[$key] = $value;
    }
    public function withPost($key, $value)
    {
        return $this->post[$key] = $value;
    }
    public function withCookie($name, $value, $time = 24*31*24)
    {
        $time = time()+60*60*$time;
        setcookie($name, $value, $time);
    }
    public function withFiles($key = null)
    {
        return $this->setArray($this->files, $key);
    }
    public function withSession($key, $value)
    {
        return $this->session['$key'] = '$value';
    }

}