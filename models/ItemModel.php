<?php

namespace Model;

use Model\BaseModel;

class ItemModel extends BaseModel
{
    protected $keys = array('itemName','price');
    protected $validate = array('itemName' => '[a-zA-Z0-9 ]+', 'price' => '[0-9]+');
    protected $primary = 'itemId';
}

?>
