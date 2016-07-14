<?php

namespace App;

use Router\RouteManager;
use Configurator\ConfigManager;
use Authenticator\Authenticate;
use Session\SessionManager;
use DBC\DatabaseFactory;
use Cache\CacheManager;

class Factory
{
    public static function getCacheManager()
    {
        return CacheManager::getInstance();
    }

    public static function getConfigManager()
    {
        return ConfigManager::getInstance();
    }

    public static function getRouteManager()
    {
        $configManager = self::getConfigManager();
        return RouteManager::getInstance($configManager);
    }

    public static function getAuthManager()
    {
        $cacheManager = self::getCacheManager();
        $sessionManager = self::getSessionManager();
        $databaseFactory = self::getDatabaseFactory();
        return new Authenticate($cacheManager, $sessionManager, $databaseFactory);
    }

    public static function getSessionManager()
    {
        $configManager = self::getConfigManager();
        return SessionManager::getInstance($configManager);
    }

    public static function getDatabaseFactory()
    {
        $configManager = self::getConfigManager();
        return DatabaseFactory::getInstance($configManager);
    }

}



 ?>
