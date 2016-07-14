<?php

namespace Router;

class Request
{
    private $get;
    private $post;
    private $method;
    private $requestUri;
    private $path;
    private $params;
    private $statusCode;

    public function __construct()
    {
        $statusCode = 200;
        $this->parseRoute();

        $this->setGetParameters();
        $this->setPostParameters();
    }

    public function getAllPOST()
    {
        return $this->post;
    }

    public function getPOST( $key )
    {
        return isset($this->post[$key]) ? $this->post[$key] : null;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function parseRoute()
    {
        $this->requestUri = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];

        $parsedUrl = parse_url($this->requestUri);
        $this->path = $parsedUrl['path'];

        $this->setParams();
    }

    private function setParams()
    {
        preg_match('/(\/)([0-9]+)/', $this->path, $params);
        if( count($params) > 2 ){
            $this->params = $params[2];
        }
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setGetParameters()
    {
        $this->get = $_GET;
    }

    public function setPostParameters()
    {
        $this->post = $_POST;
    }

    public function getRoute()
    {
        $path = preg_replace('/(\/)[0-9]+/','/{id}', $this->path);
        return $this->method.":".$path;
    }
}


 ?>
