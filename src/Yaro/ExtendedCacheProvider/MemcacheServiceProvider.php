<?php 

namespace Yaro\ExtendedCacheProvider;

use Illuminate\Support\ServiceProvider;

class MemcacheServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['extentedcache'] = $this->app->share(function($app)
        {
            return new ExtendedCacheManager($app);
        });

        $this->app['memcache.connector'] = $this->app->share(function()
        {
            return new MemcacheConnector;
        });
	} // end register

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('memcache.connector');
	} // end provides

}