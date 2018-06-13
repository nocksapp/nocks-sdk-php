<?php


namespace Nocks\SDK\Scope;


interface ApiScopeInterface {

	public function getPlatform();

	public function getAccessToken();

	public function getBaseUrl();

	public function getHeaders($addAccessTokenIfAvailable = true);

	public function hasAccessToken();

}