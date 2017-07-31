<?php

namespace Fluidads\ApiBundle;

/**
* Main Fluidads connection class
* Takes care of authentication and token management
*/
class FluidadsApiConnection
{
	
	const FA_API_PATH = "http://local.fluidads.lcl/api/";


	/**
	 * Make the initial connection (authentication)
	 *
	 * @param string $email
	 * @param string $password
	 *
	 * @return string $sessionToken
	 */
	public function authorise($email, $password)
	{
		$postData = array(
			'email' => $email,
			'password' => $password
		);

		$sessionToken = $this->send('auth', "POST", null, $postData);

		return $sessionToken;
	}


	/**
	 * Check for a valid token
	 *
	 * @param string $sessionToken
	 *
	 * @return boolean
	 */
	public function hasValidToken($sessionToken)
	{
		$isTokenValid = $this->send('auth/checkToken', 'GET', array(), array(), $sessionToken);

		return $isTokenValid;
	}


	/**
	 * Refresh a valid, but expired token
	 *
	 * @param string $sessionToken
	 *
	 * @return string|null
	 */
	public function refreshToken($sessionToken)
	{
		$newToken = $this->send('api/auth/token/refresh', 'GET', array(), array(), $sessionToken);

		return $newToken;
	}

	
	/**
	 * We need to do some session/token checking before sending a request out
	 *
	 * @param sting $url
	 * @param string $method
	 * @param array $getVars
	 * @param array $postVars
	 * @param string $sessionToken
	 *
	 * @return boolean
	 */
	public function sendRequest($url, $method, $getVars = array(), $postVars = array(), $sessionToken = null)
	{
		$canSend = false;

		// do we have a token
		if($sessionToken && $sessionToken !== null) {

			// is it valid
			if($this->hasValidToken($sessionToken)) {
				$canSend = true;
			} else {
				// try to refresh the token
				$newSession = $this->refreshToken($sessionToken);

				if($newSession) {
					$canSend = true;
				}
			}
		}

		if($canSend) {
			$this->send($url, $method, $getVars, $postVars, $sessionToken);
		} else {
			// we need to (re)authorise the user
			return false;
		}

	}


	/**
	 * Checks complete - send the actual request
	 *
	 * @param sting $url
	 * @param string $method
	 * @param array $getVars
	 * @param array $postVars
	 * @param string $sessionToken
	 *
	 * @return string $response
	 */
	private function send($url, $method, $getVars = array(), $postVars = array(), $sessionToken = null)
	{
		$headers = "";
		if($sessionToken) {
			
			$headers = "Authorization: Bearer ".$sessionToken;

		}

		// set any data we are sending
		$data = isset($getVars) ? json_encode($getVars) : json_encode($postVars);

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => self::FA_API_PATH.$url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_CUSTOMREQUEST => strtoupper($method),
		  CURLOPT_POSTFIELDS => $data,
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: application/json",
		    $headers
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}
	}


}