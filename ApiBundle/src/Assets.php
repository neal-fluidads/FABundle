<?php

namespace Fluidads\ApiBundle;

use Fluidads\ApiBundle\ApiConnection;

/**
* 
*/
class Assets
{
	
	const ASSETS_PATH = "assets";

	const ASSET_PATH = "asset";


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
		$assets = $this->connection->sendRequest(self::ASSETS_PATH, 'GET', array(), array(), $this->token);

		if($assets) return $assets;

		return false;
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
		$assets = $this->connection->sendRequest(self::ASSETS_PATH.'/account/'.$accountId, 'GET', array(), array(), $this->token);

		if($assets) return $assets;

		return false;
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
		$asset = $this->connection->sendRequest(self::ASSET_PATH.'/'.$assetId, 'GET', array(), array(), $this->token);

		if($asset) return $asset;

		return false;
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
		$asset = $this->connection->sendRequest(self::ASSET_PATH.'/'.$assetId.'/account/'.$accountId, 'GET', array(), array(), $this->token);

		if($asset) return $asset;

		return false;
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
		$asset = $this->connection->sendRequest(self::ASSET_PATH, 'POST', array(), $data, $this->token);

		if($asset) return $asset;

		return false;
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
		$asset = $this->connection->sendRequest(self::ASSET_PATH.'/account/'.$accountId, 'POST', array(), $data, $this->token);

		if($asset) return $asset;

		return false;
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
		$asset = $this->connection->sendRequest(self::ASSET_PATH.'/'.$assetId, 'PUT', array(), $data, $this->token);

		if($asset) return $asset;

		return false;
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
		$asset = $this->connection->sendRequest(self::ASSET_PATH.'/'.$assetId.'/account'.$accountId, 'PUT', array(), $data, $this->token);

		if($asset) return $asset;

		return false;
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
		$asset = $this->connection->sendRequest(self::ASSET_PATH.'/'.$assetId, 'DELETE', array(), array(), $this->token);

		if($asset) return $asset;

		return false;
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
		$asset = $this->connection->sendRequest(self::ASSET_PATH.'/'.$assetId.'/account/'.$accountId, 'DELETE', array(), array(), $this->token);

		if($asset) return $asset;

		return false;
	}


}