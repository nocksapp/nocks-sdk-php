<?php


namespace Nocks\SDK\Scope;


interface OauthScopeInterface {

	public function getPlatform();

	public function getClientId();

	public function getClientSecret();

	public function getScopes();

	public function getRedirectUri();

	public function getBaseUrl();

	public function getHeaders();

	public function has($configProperty);

}