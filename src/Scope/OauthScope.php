<?php


namespace Nocks\SDK\Scope;


use Nocks\SDK\Constant\Platform;

class OauthScope implements OauthScopeInterface {

	private $platform;
	private $clientId;
	private $clientSecret;
	private $scopes;
	private $redirectUri;

	public function __construct($platform, $clientId = null, $clientSecret = null, array $scopes = null, $redirectUri = null) {
		$this->platform = $platform;
		$this->clientId = $clientId;
		$this->clientSecret = $clientSecret;
		$this->scopes = $scopes;
		$this->redirectUri = $redirectUri;
	}

	/**
	 * @param mixed $platform
	 *
	 * @return OauthScope
	 */
	public function setPlatform($platform) {
		$this->platform = $platform;

		return $this;
	}

	/**
	 * Get platform
	 *
	 * @return mixed
	 */
	public function getPlatform() {
		return $this->platform;
	}

	/**
	 * @param mixed $clientId
	 *
	 * @return OauthScope
	 */
	public function setClientId($clientId) {
		$this->clientId = $clientId;

		return $this;
	}

	/**
	 * Get clientId
	 *
	 * @return mixed
	 */
	public function getClientId() {
		return $this->clientId;
	}

	/**
	 * @param mixed $clientSecret
	 *
	 * @return OauthScope
	 */
	public function setClientSecret($clientSecret) {
		$this->clientSecret = $clientSecret;

		return $this;
	}

	/**
	 * Get clientSecret
	 *
	 * @return mixed
	 */
	public function getClientSecret() {
		return $this->clientSecret;
	}

	/**
	 * @param array $scopes
	 *
	 * @return OauthScope
	 */
	public function setScopes(array $scopes) {
		$this->scopes = $scopes;

		return $this;
	}

	/**
	 * Get scopes
	 *
	 * @return array
	 */
	public function getScopes() {
		return $this->scopes;
	}

	/**
	 * @param mixed $redirectUri
	 *
	 * @return OauthScope
	 */
	public function setRedirectUri($redirectUri) {
		$this->redirectUri = $redirectUri;

		return $this;
	}

	/**
	 * Get redirectUri
	 *
	 * @return mixed
	 */
	public function getRedirectUri() {
		return $this->redirectUri;
	}

	/**
	 * Get the default headers for a request
	 *
	 * @return array
	 */
	public function getHeaders() {
		return [
			'Accept' => 'application/json',
			'Content-Type' => 'application/json',
		];
	}

	/**
	 * Get the base url
	 */
	public function getBaseUrl() {
		if ($this->platform === Platform::PRODUCTION) {
			return 'https://www.nocks.com/oauth/';
		}

		return 'https://sandbox.nocks.com/oauth/';
	}

	/***
	 * Check if a config property is set
	 *
	 * @param $configProperty
	 *
	 * @return bool
	 */
	public function has($configProperty) {
		return isset($this->{$configProperty}) && $this->{$configProperty} !== null;
	}
}