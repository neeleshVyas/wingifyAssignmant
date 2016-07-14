<?php

namespace Authenticator;

use Model\UserModel;
use App\Factory;

class Authenticate
{
      private $sessionManager;
      private $userDB;
      private $cacheManager;

      public function __construct( $cacheManager, $sessionManager, $databaseFactory )
      {
            $this->cacheManager = $cacheManager;
            $this->sessionManager = $sessionManager;
            $this->userDB = $databaseFactory->getUserMap();
      }

      public function authenticate( $username, $password )
      {
            if( !$this->isUserLoggedIn() ){
                  return $this->doLogin( $username, $password );
            }
            return array('status' => true, 'message' => 'Already LoggedIn');
      }

      public function doLogin( $username, $password )
      {
            $status = false;
            $message = null;

            $user = $this->getUserByCredentials( $username, $password );
            if( $user instanceof UserModel ){
                  $this->setUserSession($user);
                  $status = true;
                  $message = 'Logged In Successfully';
            }
            else {
                  $message = 'Invalid Credentials';
            }
            return array('status' => $status, 'message' => $message);
      }

      private function setUserSession( $user )
      {
            $this->sessionManager->set( '_user', $user->getUserId() );
      }

      private function getUserByCredentials( $username, $password )
      {
            return $this->userDB->getUserByCredentials( $username, $password );
      }

      public function isUserLoggedIn()
      {
            $userId = $this->sessionManager->get('_user');
            $user = $this->userDB->getUserById( $userId );
            $this->cacheManager->set('user', $user);
            return ($user instanceof UserModel);
      }


}


 ?>
