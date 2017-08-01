<?php

namespace Fluidads\ApiBundle;

use Fluidads\ApiBundle\ApiConnection;

/**
* 
*/
class Assets
{
	
	const PLURAL_PATH = "assets";

	const SINGULAR_PATH = "asset";


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
	 * Get a list of the accounts assets
	 *
	 * @return array|false
	 */
	public function getAssets()
	{
		$assets = $this->connection->sendRequest(self::PLURAL_PATH, 'GET', array(), array(), $this->token);

		return $assets;
	}


	/**
	 * Get a list of a specific accounts assets
	 *
	 * @param integer $accountId
	 *
	 * @return array|false
	 */
	public function getAccountAssets($accountId)
	{
		$assets = $this->connection->sendRequest(self::PLURAL_PATH.'/account/'.$accountId, 'GET', array(), array(), $this->token);

		return $assets;
	}


	/**
	 * Get a single asset by its id
	 *
	 * @param integer $assetId
	 *
	 * @return array|false
	 */
	public function getAsset($assetId)
	{
		$asset = $this->connection->sendRequest(self::SINGULAR_PATH.'/'.$assetId, 'GET', array(), array(), $this->token);

		return $asset;
	}


	/**
	 * Get a single asset for a specific account
	 *
	 * @param integer $assetId
	 * @param integer $accountId
	 *
	 * @return array|false
	 */
	public function getAccountAsset($assetId, $accountId)
	{
		$asset = $this->connection->sendRequest(self::SINGULAR_PATH.'/'.$assetId.'/account/'.$accountId, 'GET', array(), array(), $this->token);

		return $asset;
	}


	/**
	 * Create a new asset
	 *
	 * @param array $data
	 *
	 * @return array|false
	 */
	public function createAsset($data)
	{
		$asset = $this->connection->sendRequest(self::SINGULAR_PATH, 'POST', array(), $data, $this->token);

		return $asset;
	}


	/**
	 * Create an asset for a specific account
	 *
	 * @param integer $accountId
	 * @param array $data
	 *
	 * @return array|false
	 */
	public function createAccountAsset($accountId, $data)
	{
		$asset = $this->connection->sendRequest(self::SINGULAR_PATH.'/account/'.$accountId, 'POST', array(), $data, $this->token);

		return $asset;
	}


	/**
	 * Update an asset
	 *
	 * @param integer $assetId
	 * @param array $data
	 *
	 * @return array|false
	 */
	public function updateAsset($assetId, $data)
	{
		$asset = $this->connection->sendRequest(self::SINGULAR_PATH.'/'.$assetId, 'PUT', array(), $data, $this->token);

		return $asset;
	}


	/**
	 * Update an asset for a specific account
	 *
	 * @param integer $assetId
	 * @param integer $accountId
	 * @param array $data
	 *
	 * @return array|false
	 */
	public function updateAccountAsset($assetId, $accountId, $data)
	{
		$asset = $this->connection->sendRequest(self::SINGULAR_PATH.'/'.$assetId.'/account'.$accountId, 'PUT', array(), $data, $this->token);

		return $asset;
	}


	/**
	 * Delete an asset
	 *
	 * @param integer $assetId
	 *
	 * @return array|false
	 */
	public function deleteAsset($assetId)
	{
		$asset = $this->connection->sendRequest(self::SINGULAR_PATH.'/'.$assetId, 'DELETE', array(), array(), $this->token);

		return $asset;
	}


	/**
	 * Delete an asset for a specific account
	 *
	 * @param integer $assetId
	 * @param integer $accountId
	 *
	 * @return array|false
	 */
	public function deleteAccountAsset($assetId, $accountId)
	{
		$asset = $this->connection->sendRequest(self::SINGULAR_PATH.'/'.$assetId.'/account/'.$accountId, 'DELETE', array(), array(), $this->token);

		return $asset;
	}


}