<?php

namespace Controller;

use Controller\BaseController;
use App\Factory;
use Model\ItemModel;

class ProductController extends BaseController
{
      private $itemDB;

      public function __construct()
      {
            parent::__construct();
            $this->itemDB = Factory::getDatabaseFactory()->getItemMap();
      }

      public function searchItems()
      {
            $result = $this->itemDB->getAllItems();
            $this->responseOK(array('items' => $result));
      }

      public function getItemById( $itemId = 0 )
      {
            $result = $this->itemDB->getItemById( $itemId );
            return $this->responseOK(array('item' => $result));
      }

      public function createNewItem()
      {
            $itemModel = new ItemModel();
            $itemModel->input( $this->getRequest()->getAllPOST() );
            $error = $itemModel->validate();
            if( $error ) return $this->responseOK(array('error' => $error));
            $response = $this->itemDB->save( $itemModel );
            return $this->responseOK(array('item' => $response));
      }

      public function updateItem( $itemId )
      {
            $itemModel = $this->itemDB->getItemById( $itemId );
            $itemModel->input( $this->getRequest()->getAllPOST() );
            $error = $itemModel->validate();
            if( $error ) return $this->responseOK(array('error' => $error));
            $response = $this->itemDB->save( $itemModel );
            $this->responseOK(array('item' => $response));
      }

      public function deleteItem( $itemId )
      {
            $response = $this->itemDB->deleteItemById( $itemId );
            $this->responseOK(array('status' => $response));
      }
}


 ?>
