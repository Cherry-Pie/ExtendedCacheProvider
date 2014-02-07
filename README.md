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
