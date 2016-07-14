<?php

namespace Model;


class BaseModel
{
    protected $dirtyBits = array();
    private $bindings = array();

    public function getColumns()
    {
        return $this->keys;
    }

    public function getBindings()
    {
        return $this->bindings;
    }

    public function validate()
    {
          foreach( $this->validate as $key => $validation )
          {
              if(!property_exists($this, $key) || preg_match('/^'.$validation.'$/', $this->$key)===0){
                  return "$key field is invalid";
              }
          }
          return false;
      }

      public function getPrimaryKey()
      {
          return property_exists($this,'primary') ? $this->primary : 'id';
      }

      public function getPrimary()
      {
          return property_exists($this,$this->primary) ? $this->{$this->primary} : null;
      }

      public function setPrimary( $value )
      {
          $this->{$this->primary} = $value;
      }

      public function input( $input )
      {
          foreach( $this->keys as $key ){
              $this->dirtyBits[$key] = 0;
              if(isset($input[$key])){
                  $this->bindings[":$key"] = $this->$key = $input[$key];
                  $this->dirtyBits[$key] |= 1;
              }
          }
      }
}


 ?>
