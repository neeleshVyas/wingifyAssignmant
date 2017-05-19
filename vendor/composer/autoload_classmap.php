<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'App\\App' => $baseDir . '/bootstrap/app.php',
    'App\\Factory' => $baseDir . '/bootstrap/factory.php',
    'Authenticator\\Authenticate' => $baseDir . '/libs/Authenticator/Authenticate.php',
    'Cache\\CacheManager' => $baseDir . '/libs/Cache/CacheManager.php',
    'Configurator\\ConfigManager' => $baseDir . '/libs/Configurator/ConfigManager.php',
    'Controller\\AuthController' => $baseDir . '/controller/AuthController.php',
    'Controller\\BaseController' => $baseDir . '/controller/BaseController.php',
    'Controller\\CartController' => $baseDir . '/controller/CartController.php',
    'Controller\\DefaultController' => $baseDir . '/controller/DefaultController.php',
    'Controller\\ProductController' => $baseDir . '/controller/ProductController.php',
    'DBC\\CartMap' => $baseDir . '/databases/CartMap.php',
    'DBC\\DatabaseFactory' => $baseDir . '/databases/DatabaseFactory.php',
    'DBC\\ItemMap' => $baseDir . '/databases/ItemMap.php',
    'DBC\\ObjectMap' => $baseDir . '/databases/ObjectMap.php',
    'DBC\\UserMap' => $baseDir . '/databases/UserMap.php',
    'Model\\BaseModel' => $baseDir . '/models/BaseModel.php',
    'Model\\CartModel' => $baseDir . '/models/CartModel.php',
    'Model\\ItemModel' => $baseDir . '/models/ItemModel.php',
    'Model\\UserModel' => $baseDir . '/models/UserModel.php',
    'Router\\Request' => $baseDir . '/libs/Router/Request.php',
    'Router\\RouteManager' => $baseDir . '/libs/Router/RouteManager.php',
    'Session\\SessionManager' => $baseDir . '/libs/Session/SessionManager.php',
);
