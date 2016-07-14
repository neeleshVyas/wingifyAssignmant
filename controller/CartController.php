<?php

namespace Controller;

use Controller\BaseController;
use App\Factory;

class CartController extends BaseController
{
      public function showDetails()
      {
            $userId = $this->getCurrentUser()->getUserId();
            $cartMap = Factory::getDatabaseFactory()->getCartMap();
            $response = $cartMap->getCartItemsByUserId( $userId );
            return $this->responseOK($response);
      }
}


 ?>
