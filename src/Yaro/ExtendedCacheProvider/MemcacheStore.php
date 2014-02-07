<?php 

namespace Yaro\ExtendedCacheProvider;

use Memcache;

class MemcacheStore implements \Illuminate\Cache\StoreInterface {

	/**
	 * The Memcache instance.
	 *
	 * @var \Memcache
	 */
	protected $memcache;

	/**
	 * A string that should be prepended to keys.
	 *
	 * @var string
	 */
	protected $prefix;

	/**
	 * Create a new Memcache store.
	 *
	 * @param  \Memcache  $memcache
	 * @param  string     $prefix
	 * @return void
	 */
	public function __construct(Memcache $memcache, $prefix = '')
	{
		$this->memcache = $memcache;
		$this->prefix   = strlen($prefix) > 0 ? $prefix.':' : '';
	} // end __construct

	/**
	 * Retrieve an item from the cache by key.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function get($key)
	{
		$value = $this->memcache->get($this->prefix.$key);

		return $value;
	} // end get

	/**
	 * Store an item in the cache for a given number of minutes.
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @param  int     $minutes
	 * @return void
	 */
	public function put($key, $value, $minutes)
	{
		$this->memcache->set($this->prefix.$key, $value, 0, $minutes * 60);
	} // end put

	/**
	 * Increment the value of an item in the cache.
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @return void
	 */
	public function increment($key, $value = 1)
	{
		return $this->memcache->increment($this->prefix.$key, $value);
	} // end increment

	/**
	 * Increment the value of an item in the cache.
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @return void
	 */
	public function decrement($key, $value = 1)
	{
		return $this->memcache->decrement($this->prefix.$key, $value);
	} // end decrement

	/**
	 * Store an item in the cache indefinitely.
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @return void
	 */
	public function forever($key, $value)
	{
		return $this->put($key, $value, 0);
	} // end forever

	/**
	 * Remove an item from the cache.
	 *
	 * @param  string  $key
	 * @return void
	 */
	public function forget($key)
	{
		$this->memcache->delete($this->prefix.$key);
	} // end forget

	/**
	 * Remove all items from the cache.
	 *
	 * @return void
	 */
	public function flush()
	{
		$this->memcache->flush();
	} // end flush

	/**
	 * Begin executing a new section operation.
	 *
	 * @param  string  $name
	 * @return \Illuminate\Cache\Section
	 */
	public function section($name)
	{
		return new Section($this, $name);
	} // end section

	/**
	 * Get the underlying Memcache connection.
	 *
	 * @return \Memcache
	 */
	public function getMemcache()
	{
		return $this->memcache;
	} // end getMemcache

	/**
	 * Get the cache key prefix.
	 *
	 * @return string
	 */
	public function getPrefix()
	{
		return $this->prefix;
	} // end getPrefix

}
