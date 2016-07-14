<?php

return array(
    # authentication
    'POST:/login'    => array('AuthController', 'authenticateUser', false),

    # error
    'ERROR' => array('DefaultController', 'showError', false),

    # cart API
    'GET:/cart/items'       => array('CartController', 'showDetails', true),
    'POST:/cart/item'       => array('CartController', 'addItem', true),
    'DELETE:/cart/item/{id}'  => array('CartController', 'removeItem', true),
    'DELETE:/cart/items'    => array('CartController', 'clearCart', true),
    'POST:/cart/item/{id}'   => array('CartController', 'editItem', true), # not using PUT, not so much required

    # item API
    'GET:/item'             => array('ProductController', 'searchItems', true),
    'GET:/item/{id}'        => array('ProductController', 'getItemById', true),
    'POST:/item'            => array('ProductController', 'createNewItem', true),
    'POST:/item/{id}'        => array('ProductController', 'updateItem', true), # yes not using PUT
    'DELETE:/item/{id}'     => array('ProductController', 'deleteItem', true),

    );

 ?>
