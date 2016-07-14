<?php

namespace DBC;

class CartMap extends ObjectMap
{
    protected $table = 'cart';
    protected $primary = 'cartId';

    public function getCartItemsByUserId( $userId )
    {
        return $this->find()->where('userId',$userId)->all();
    }
}

 ?>
