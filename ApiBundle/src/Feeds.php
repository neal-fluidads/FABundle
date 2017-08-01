<?php

namespace Fluidads\ApiBundle;

use Fluidads\ApiBundle\ApiConnection;

/**
* 
*/
class Feeds
{
	
	const PLURAL_PATH = "feeds";

	const SINGULAR_PATH = "feed";


	/**
	 * Api Connection
	 */
	private $connection;

	/**
	 * Session Token
	 */
	private $token;



	function __construct($token)
	{
		$this->connection = new ApiConnection;

		$this->token = $token;
	}


	/**
	 * Get a list of the accounts feeds
	 *
	 * @return array|false
	 */
	public function getFeeds()
	{
		$feeds = $this->connection->sendRequest(self::PLURAL_PATH, 'GET', array(), array(), $this->token);

		return $feeds;
	}


	/**
	 * Get a list of a specific accounts feeds
	 *
	 * @param integer $accountId
	 *
	 * @return array|false
	 */
	public function getAccountFeeds($accountId)
	{
		$feeds = $this->connection->sendRequest(self::PLURAL_PATH.'/account/'.$accountId, 'GET', array(), array(), $this->token);

		return $feeds;
	}


	/**
	 * Get a single feed by its id
	 *
	 * @param integer $feedId
	 *
	 * @return array|false
	 */
	public function getFeed($feedId)
	{
		$feed = $this->connection->sendRequest(self::SINGULAR_PATH.'/'.$feedId, 'GET', array(), array(), $this->token);

		return $feed;
	}


	/**
	 * Get a single feed for a specific account
	 *
	 * @param integer $feedId
	 * @param integer $accountId
	 *
	 * @return array|false
	 */
	public function getAccountFeed($feedId, $accountId)
	{
		$feed = $this->connection->sendRequest(self::SINGULAR_PATH.'/'.$feedId.'/account/'.$accountId, 'GET', array(), array(), $this->token);

		return $feed;
	}


	/**
	 * Create a new feed
	 *
	 * @param array $data
	 *
	 * @return array|false
	 */
	public function createFeed($data)
	{
		$feed = $this->connection->sendRequest(self::SINGULAR_PATH, 'POST', array(), $data, $this->token);

		return $feed;
	}


	/**
	 * Create an feed for a specific account
	 *
	 * @param integer $accountId
	 * @param array $data
	 *
	 * @return array|false
	 */
	public function createAccountFeed($accountId, $data)
	{
		$feed = $this->connection->sendRequest(self::SINGULAR_PATH.'/account/'.$accountId, 'POST', array(), $data, $this->token);

		return $feed;
	}


	/**
	 * Update an feed
	 *
	 * @param integer $feedId
	 * @param array $data
	 *
	 * @return array|false
	 */
	public function updateFeed($feedId, $data)
	{
		$feed = $this->connection->sendRequest(self::SINGULAR_PATH.'/'.$feedId, 'PUT', array(), $data, $this->token);

		return $feed;
	}


	/**
	 * Update an feed for a specific account
	 *
	 * @param integer $feedId
	 * @param integer $accountId
	 * @param array $data
	 *
	 * @return array|false
	 */
	public function updateAccountFeed($feedId, $accountId, $data)
	{
		$feed = $this->connection->sendRequest(self::SINGULAR_PATH.'/'.$feedId.'/account'.$accountId, 'PUT', array(), $data, $this->token);

		return $feed;
	}


	/**
	 * Delete a feed
	 *
	 * @param integer $feedId
	 *
	 * @return array|false
	 */
	public function deleteFeed($feedId)
	{
		$feed = $this->connection->sendRequest(self::SINGULAR_PATH.'/'.$feedId, 'DELETE', array(), array(), $this->token);

		return $feed;
	}


	/**
	 * Delete a feed for a specific account
	 *
	 * @param integer $feedId
	 * @param integer $accountId
	 *
	 * @return array|false
	 */
	public function deleteAccountFeed($feedId, $accountId)
	{
		$feed = $this->connection->sendRequest(self::SINGULAR_PATH.'/'.$feedId.'/account/'.$accountId, 'DELETE', array(), array(), $this->token);

		return $feed;
	}


}