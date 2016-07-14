<?php

namespace Configurator;

class ConfigManager
{
    private static $class;
    private static $config;
    private function __construct(){
        $this->config = array();
    }

    public static function getInstance(){

        if(self::$class == null){
            self::$class = new ConfigManager();
        }

        return self::$class;
    }

    public function load( $dir )
    {
        $handle = opendir($dir);
        while (false !== ($entry = readdir($handle))) {
             if ($entry != "." && $entry != "..") {
                $arrayIndex = substr($entry,0,strpos($entry,'.php'));
                $this->config[$arrayIndex] = (include "$dir/$entry");
             }
        }
        closedir($handle);
        return $this->config;
    }

    public function all(){
        return $this->config;
    }

    public function get( $configName ){
        if( array_key_exists($configName, $this->config) ){
            return $this->config[$configName];
        }
        return false;
    }

}
 ?>
