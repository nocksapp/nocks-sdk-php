<?php


namespace Nocks\SDK;


use Nocks\SDK\Exception\ScopeConfigurationException;
use Nocks\SDK\Http\CurlRequest;
use Nocks\SDK\Model\OauthToken;
use Nocks\SDK\Scope\OauthScope;

class NocksOauth {

	private $scope;
	private $requestHandler;
	private $responseHandler;

	private $requestOptions = [];

	public function __construct($platform, $clientId = null, $clientSecret = null, array $scopes = null, $redirectUri = null) {
		$this->scope = new OauthScope($platform, $clientId, $clientSecret, $scopes, $redirectUri);
		$this->requestHandler = new CurlRequest();
		$this->responseHandler = new NocksResponseHandler();

		$this->requestOptions = [
			'headers' => $this->scope->getHeaders(),
			'baseUrl' => $this->scope->getBaseUrl(),
		];
	}

	/**
	 * @param array $requiredProperties
	 *
	 * @throws ScopeConfigurationException
	 */
	private function checkRequiredConfig(array $requiredProperties) {
		foreach ($requiredProperties as $requiredProperty) {
			if (!$this->scope->has($requiredProperty)) {
				throw new ScopeConfigurationException($requiredProperties);
			}
		}
	}

	/**
	 * @param $data
	 *
	 * @return OauthToken
	 */
	public static function tokenResponseFormatter($data) {
		return new OauthToken($data);
	}

	/**
	 * Build the oauth uri
	 *
	 * @param string $state
	 *
	 * @return string
	 * @throws ScopeConfigurationException
	 */
	public function getOauthUri($state = '') {
		$this->checkRequiredConfig(['clientId', 'redirectUri', 'scopes']);

		return $this->scope->getBaseUrl() . 'authorize?client_id=' . $this->scope->getClientId() .
		       '&redirect_uri=' . $this->scope->getRedirectUri() . '&response_type=code&scope=' .
		       implode(' ', $this->scope->getScopes()) . '&state=' . $state;
	}

	/**
	 * Request token
	 *
	 * @param $code
	 *
	 * @return OauthToken
	 * @throws Exception\BadRequestException
	 * @throws Exception\ForbiddenException
	 * @throws Exception\GoneException
	 * @throws Exception\InternalServerError
	 * @throws Exception\MethodNotAllowedException
	 * @throws Exception\NotAcceptable
	 * @throws Exception\NotFoundException
	 * @throws Exception\ServiceUnavailable
	 * @throws Exception\TooManyRequests
	 * @throws Exception\UnauthorizedException
	 * @throws ScopeConfigurationException
	 */
	public function requestToken($code) {
		$this->checkRequiredConfig(['clientId', 'clientSecret', 'redirectUri']);

		$response = $this->requestHandler->call(array_merge($this->requestOptions, [
			'method' => 'POST',
			'url' => 'token',
			'data' => [
				'client_id' => $this->scope->getClientId(),
				'client_secret' => $this->scope->getClientSecret(),
				'grant_type' => 'authorization_code',
				'redirect_uri' => $this->scope->getRedirectUri(),
				'code' => $code,
			],
		]));

		return $this->responseHandler->handle($response, [$this, 'tokenResponseFormatter']);
	}

	/**
	 * Refresh token
	 *
	 * @param $refreshToken
	 *
	 * @return OauthToken
	 * @throws Exception\BadRequestException
	 * @throws Exception\ForbiddenException
	 * @throws Exception\GoneException
	 * @throws Exception\InternalServerError
	 * @throws Exception\MethodNotAllowedException
	 * @throws Exception\NotAcceptable
	 * @throws Exception\NotFoundException
	 * @throws Exception\ServiceUnavailable
	 * @throws Exception\TooManyRequests
	 * @throws Exception\UnauthorizedException
	 * @throws ScopeConfigurationException
	 */
	public function refreshToken($refreshToken) {
		$this->checkRequiredConfig(['clientId', 'clientSecret']);

		$response = $this->requestHandler->call(array_merge($this->requestOptions, [
			'method' => 'POST',
			'url' => 'token',
			'data' => [
				'client_id' => $this->scope->getClientId(),
				'client_secret' => $this->scope->getClientSecret(),
				'grant_type' => 'refresh_token',
				'refresh_token' => $refreshToken,
			],
		]));

		return $this->responseHandler->handle($response, [$this, 'tokenResponseFormatter']);
	}

	/**
	 * Password grant token
	 *
	 * @param $username
	 * @param $password
	 *
	 * @return OauthToken
	 * @throws Exception\BadRequestException
	 * @throws Exception\ForbiddenException
	 * @throws Exception\GoneException
	 * @throws Exception\InternalServerError
	 * @throws Exception\MethodNotAllowedException
	 * @throws Exception\NotAcceptable
	 * @throws Exception\NotFoundException
	 * @throws Exception\ServiceUnavailable
	 * @throws Exception\TooManyRequests
	 * @throws Exception\UnauthorizedException
	 * @throws ScopeConfigurationException
	 */
	public function passwordGrantToken($username, $password) {
		$this->checkRequiredConfig(['clientId', 'clientSecret', 'scopes']);

		$response = $this->requestHandler->call(array_merge($this->requestOptions, [
			'method' => 'POST',
			'url' => 'token',
			'data' => [
				'client_id' => $this->scope->getClientId(),
				'client_secret' => $this->scope->getClientSecret(),
				'grant_type' => 'password',
				'username' => $username,
				'password' => $password,
				'scope' => implode(' ', $this->scope->getScopes()),
			],
		]));

		return $this->responseHandler->handle($response, [$this, 'tokenResponseFormatter']);
	}

	/**
	 * Get the available scopes
	 *
	 * @return array
	 * @throws Exception\BadRequestException
	 * @throws Exception\ForbiddenException
	 * @throws Exception\GoneException
	 * @throws Exception\InternalServerError
	 * @throws Exception\MethodNotAllowedException
	 * @throws Exception\NotAcceptable
	 * @throws Exception\NotFoundException
	 * @throws Exception\ServiceUnavailable
	 * @throws Exception\TooManyRequests
	 * @throws Exception\UnauthorizedException
	 */
	public function scopes() {
		$response = $this->requestHandler->call(array_merge($this->requestOptions, [
			'url' => 'scopes',
		]));

		return $this->responseHandler->handle($response);
	}

	/**
	 * Get the granted tokens for an accessToken
	 *
	 * @param $accessToken
	 *
	 * @return NocksResponse
	 * @throws Exception\BadRequestException
	 * @throws Exception\ForbiddenException
	 * @throws Exception\GoneException
	 * @throws Exception\InternalServerError
	 * @throws Exception\MethodNotAllowedException
	 * @throws Exception\NotAcceptable
	 * @throws Exception\NotFoundException
	 * @throws Exception\ServiceUnavailable
	 * @throws Exception\TooManyRequests
	 * @throws Exception\UnauthorizedException
	 */
	public function tokenScopes($accessToken) {
		$response = $this->requestHandler->call(array_merge($this->requestOptions, [
			'url' => 'token-scopes',
			'headers' => array_merge( $this->scope->getHeaders(), [
				'Authorization' => 'Bearer ' . $accessToken,
			])
		]));

		return $this->responseHandler->handle($response);
	}
}