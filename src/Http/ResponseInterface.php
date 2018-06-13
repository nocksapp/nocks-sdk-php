<?php


namespace Nocks\SDK\Http;


interface ResponseInterface {

	public function getStatusCode();

	public function getBody();

	public function isSuccessful();

}