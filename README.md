##Memcache Provider For L4

in /app/config/app.php add following:
```php
'providers' => array(
    //..
    'Yaro\ExtendedCacheProvider\MemcacheServiceProvider',
    //..
),

'aliases' => array(
    //..
    'Cache' => 'Yaro\ExtendedCacheProvider\Facades\Cache',
    //..
),
```

in /app/config/cache.php add following:
```php
'driver' => 'memcache',
//..
'memcache' => array(
	'host'   => '127.0.0.1', 
	'port'   => 11211, 
	'weight' => 64,
),
```
