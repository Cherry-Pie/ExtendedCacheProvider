<?php

namespace Yaro\ExtendedCacheProvider;

use Illuminate\Cache\CacheManager;
use Illuminate\Support\Manager;


class ExtendedCacheManager extends  \Illuminate\Cache\CacheManager{

    protected function createMemcacheDriver()
    {
        $server = $this->app['config']['cache.memcache'];

        $memcache = $this->app['memcache.connector']->connect($server);

        return $this->repository(new MemcacheStore($memcache, $this->getPrefix()));
    } // end createMemcacheDriver

}