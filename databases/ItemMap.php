<?php

namespace DBC;

class ItemMap extends ObjectMap
{
    protected $table = 'items';

    public function getAllItems()
    {
        return $this->find()->all();
    }

    public function getItemById( $itemId )
    {
        return $this->find()->where('itemId',$itemId)->get();
    }

    public function deleteItemById( $itemId )
    {
        return $this->where('itemId', $itemId)->delete();
    }

}

 ?>
