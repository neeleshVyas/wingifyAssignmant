<?php

namespace DBC;

use Configurator\ConfigFactory;
use PDO;
use Model;

class ObjectMap
{
    protected $connection;
    protected $sql;
    protected $where;

    public function __construct( $connection )
    {
        $this->clearSQL();
        $this->connection = $connection;
    }

    protected function find()
    {
        $this->sql = "SELECT * FROM ".$this->table;
        return $this;
    }

    protected function where( $key, $value )
    {
        $this->sql .= (empty($this->where) ? " WHERE " : " AND ")."$key = :$key";
        $this->where[$key] = $value;
        return $this;
    }

    protected function get()
    {
        return $this->prepared()->fetch();
    }

    protected function all()
    {
        return $this->prepared()->fetchAll();
    }

    private function clearSQL()
    {
        $this->sql = null;
        $this->where = array();
    }

    private function prepared()
    {
        $prepared = $this->connection->prepare( $this->sql );
        $this->bindParams( $prepared );
        $prepared->execute();
        $this->clearSQL();
        $prepared->setFetchMode(PDO::FETCH_CLASS, $this->getModel());
        return $prepared;
    }

    private function bindParams( $prepared )
    {
        foreach( $this->where as $key => $value ){
            $prepared->bindValue(":$key", $value );
        }
    }

    public function save( $model )
    {
        if( $model->getPrimary() === null ){
            $result = $this->createNew($model);
            if( $result ){
                $model->setPrimary( $result );
            }
        } else {
            $result = $this->update($model);
        }
        return $result ? $model : false;
    }

    private function createNew( $model )
    {
        $columns = implode(",",$model->getColumns());
        $bindings = $model->getBindings();
        $bindingKeys = implode(",",array_keys($bindings));


        $sql = "insert into ".$this->table." ($columns) values ($bindingKeys)";
        $prepared = $this->connection->prepare($sql);
        foreach($bindings as $key => $value){
            $prepared->bindValue($key,$value);
        }
        $prepared->execute();
        return $this->connection->lastInsertId();
    }

    public function delete()
    {
        $this->sql = "delete from ".$this->table." ".$this->sql;
        return $this->prepared()->rowCount() > 0;
    }

    private function update( $model )
    {
        $primary = $model->getPrimaryKey();
        $bindings = $model->getBindings();

        $sql = "update ".$this->table." set ". $this->updateQuery($bindings) ." where $primary = :$primary";
        $prepared = $this->connection->prepare($sql);
        foreach($bindings as $key => $value){
            $prepared->bindValue($key,$value);
        }
        $prepared->bindValue($primary,$model->getPrimary());
        $prepared->execute();
        return $prepared->rowCount();
    }

    private function updateQuery( $bindings )
    {
        $keys = array_keys($bindings);
        $sql = array();
        foreach($keys as $key){
            $sql[] = substr($key,1)." = $key";
        }
        return implode(", ",$sql);
    }

    private function getModel()
    {
        $className = get_class($this);
        $onlyClass = substr($className,strrpos($className,'\\')+1);
        $modelName = str_replace('Map','Model',$onlyClass);
        return "Model\\$modelName";
    }
}

 ?>
