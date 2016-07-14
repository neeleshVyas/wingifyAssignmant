<?php

namespace Cache;

class CacheManager
{
    private static $class;
    private $cacheMap;

    private function __construct(){
        $this->cacheMap = array();
    }

    public static function getInstance(){

        if(self::$class == null){
            self::$class = new CacheManager();
        }

        return self::$class;
    }

    public function set( $key, $value )
    {
        $this->cacheMap[$key] = $value;
    }

    public function get( $key )
    {
        return isset($this->cacheMap[$key]) ? $this->cacheMap[$key] : null;
    }

}
 ?>
