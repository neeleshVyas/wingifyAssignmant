<?php

namespace Controller;

use Controller\BaseController;
use App\Factory;

class AuthController extends BaseController
{
      public function authenticateUser()
      {
            $username = $this->getRequest()->getPOST('username');
            $password = $this->getRequest()->getPOST('password');

            $response = Factory::getAuthManager()->authenticate( $username, $password );
            return $this->responseOK($response);
      }
}


 ?>
