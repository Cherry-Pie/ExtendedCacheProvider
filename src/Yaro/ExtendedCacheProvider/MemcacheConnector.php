<?php 

namespace Yaro\ExtendedCacheProvider;

use Memcache;

class MemcacheConnector {

	/**
	 * Create a new Memcache connection.
	 *
	 * @param array  $server
	 * @return \Memcache
	 */
	public function connect(array $server)
	{
		$memcache = $this->getMemcache();

		$memcache->addServer($server['host'], $server['port'], $server['weight']);

		if (!$memcache->connect($server['host'], $server['port'])) {
			throw new \RuntimeException("Could not establish Memcache connection.");
		}

		return $memcache;
	} // end connect

	/**
	 * Get a new Memcache instance.
	 *
	 * @return \Memcache
	 */
	protected function getMemcache()
	{
		return new Memcache();
	} // end getMemcache

}
