<?php


namespace Nocks\SDK\Scope;


use Nocks\SDK\Constant\Platform;

class ApiScope implements ApiScopeInterface {

	private $platform;
	private $accessToken;

	public function __construct($platform, $accessToken = null) {
		$this->platform = $platform;
		$this->accessToken = $accessToken;
	}

	public function setPlatform($platform) {
		$this->platform = $platform;
	}

	public function getPlatform() {
		return $this->platform;
	}

	public function setAccessToken($accessToken) {
		$this->accessToken = $accessToken;
	}

	public function getAccessToken() {
		return $this->accessToken;
	}

	public function getBaseUrl() {
		if ($this->platform === Platform::PRODUCTION) {
			return 'https://api.nocks.com/api/v2/';
		}

		return 'https://sandbox.nocks.com/api/v2/';
	}

	public function getHeaders($addAccessTokenIfAvailable = true) {
		return array_merge(
			[
				'Accept' => 'application/json',
				'Content-Type' => 'application/json',
			],
			$this->accessToken && $addAccessTokenIfAvailable ? ['Authorization' => 'Bearer ' . $this->getAccessToken()] : []
		);
	}

	/**
	 * Check if an accessToken is set in the scope
	 *
	 * @return bool
	 */
	public function hasAccessToken() {
		return !is_null($this->accessToken) && is_string($this->accessToken);
	}
}