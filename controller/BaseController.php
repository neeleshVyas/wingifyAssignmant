<?php

namespace Controller;
use App\Factory;

class BaseController
{
      private $request;

      public function __construct()
      {
      }

      public function setRequest($request)
      {
            $this->request = $request;
      }

      public function getRequest()
      {
            return $this->request;
      }

      public function getCurrentUser()
      {
            return Factory::getCacheManager()->get('user');
      }

      public function responseOK($array){
            $this->setStatusHeaders(200);
            $this->renderJSON($array);
      }

      public function response(){
            $statusCode = $this->request->getStatusCode();
            $statusMsg = $this->getStatusMessages($statusCode);
            $this->setStatusHeaders($statusCode);
            $this->renderJSON(array('msg' => $statusMsg));
      }

      public function responseForbidden($array){
            $this->setStatusHeaders(403);
            $this->renderJSON($array);
      }

      private function renderJSON($array){
            header('Content-Type:application/json');
            echo json_encode( $array );
      }

      private function getStatusMessages($status){
            switch($status)
            {
                  case 500: return "Internal Server Error";
                  case 403: return  "Access Denied";
                  default: return "Page Not Found";
            }
      }

      private function setStatusHeaders( $status ){
            switch($status)
            {
                  case 200: header("HTTP/1.1 200 OK"); break;
                  case 403: header("HTTP/1.1 403 Forbidden"); break;
                  default: header("HTTP/1.1 404 Not Found");  break;
            }
      }
}


 ?>
