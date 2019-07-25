<?php

namespace core;

class Request
{
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';
    
    private $get;
	private $post;
	private $server;
	private $cookie;
	private $files;
	private $session;

    public function __construct($get, $post, $server, $cookie, $files, $session)
	{
		$this->get = $get;
		$this->post = $post;
		$this->server = $server;
		$this->cookie = $cookie;
		$this->files = $files;
		$this->session = $session;
    }
    
    public function getArray($array, $key)
    {
        if (isset($array[$key])) {
            return $array[$key];
        }
        elseif (!$key) {
			return $array;
		}
        else {
            return null;
        }
    }
    public function is_post()
    {
        return $this->server['REQUEST_METHOD'] == self::METHOD_POST;
    }
    public function get($key = null)
    {   
        return $this->getArray($this->get, $key);
    }
    public function post($key = null)
    {
        return $this->getArray($this->post, $key); 
    }
    public function server($key = null)
    {
        return $this->getArray($this->server, $key);
    }
    public function cookie($key = null)
    {
        return $this->getArray($this->cookie, $key);
    }
    public function files($key = null)
    {
        return $this->getArray($this->files, $key);
    }
    public function session($key = null)
    {
        return $this->getArray($this->session, $key);
    }

}