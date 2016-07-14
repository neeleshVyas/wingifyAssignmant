<?php

namespace Router;

use App\Factory;
use Controller;
use Router\Request;

class RouteManager
{
    private static $class;
    private $request;
    private $routes;
    private $controller;
    private $function;
    private $needsAuth;

    private function __construct( $configManager ){
        $this->routes =$configManager->get('routes');
        $this->request = new Request();
        $this->loadRoute( $this->request->getRoute() );
    }

    private function loadRoute( $route )
    {
        list(
            $this->controller,
            $this->function,
            $this->needsAuth
        ) = $this->routes[array_key_exists($route, $this->routes)?$route:'ERROR'];
    }

    public static function getInstance($configManager){

        if(self::$class == null){
            self::$class = new RouteManager($configManager);
        }
        return self::$class;
    }

    public function route()
    {
        $route = $this->request->getRoute();
        $this->loadRoute( $route );
        $this->forwardTo( $route );
    }

    public function routeToError( $statusCode )
    {
        $this->request->setStatusCode($statusCode);
        $this->forwardTo('ERROR');
    }

    public function needsAuth()
    {
        return $this->needsAuth;
    }

    private function routeToController( $controller, $action )
    {
        try {

            $controller = "Controller\\$controller";
            $callable = new $controller();

            #setting up current request
            $callable->setRequest($this->request);
            $callable->$action($this->request->getParams());

        } catch (Exception $e) {
            $this->request->setStatusCode(500);
            $this->forwardTo('ERROR');
        }

        $this->windUp();
    }

    private function windUp()
    {
        # more stuff can be done like response listeners etc.
        exit();
    }

    private function forwardTo( $route )
    {
        $this->loadRoute( $route );
        $this->routeToController( $this->controller, $this->function );
    }
}

 ?>
