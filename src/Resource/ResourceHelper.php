<?php


namespace Nocks\SDK\Resource;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Exception\ScopeConfigurationException;
use Nocks\SDK\Exception\ValidationException;
use Nocks\SDK\Http\RequestInterface;
use Nocks\SDK\NocksResponseHandler;
use Nocks\SDK\Scope\ApiScopeInterface;
use Nocks\SDK\Transformer\Transformer;

class ResourceHelper {

	private $scope;
	private $request;
	private $transformer;
	private $responseHandler;
	private $resourceName;

	public $requestOptions = [];

	public function __construct(ApiScopeInterface $scope, RequestInterface $request, Transformer $transformer, $resourceName) {
		$this->scope = $scope;
		$this->request = $request;
		$this->transformer = $transformer;
		$this->responseHandler = new NocksResponseHandler();
		$this->resourceName = $resourceName;

		$this->requestOptions = [
			'headers' => $this->scope->getHeaders(),
			'baseUrl' => $this->scope->getBaseUrl() . $this->getResourceName(),
		];
	}

	/**
	 * @return ApiScopeInterface
	 */
	public function getScope() {
		return $this->scope;
	}

	/**
	 * @return Transformer
	 */
	public function getTransformer() {
		return $this->transformer;
	}

	/**
	 * @return RequestInterface
	 */
	public function getRequestHandler() {
		return $this->request;
	}

	/**
	 * @return NocksResponseHandler
	 */
	public function getResponseHandler() {
		return $this->responseHandler;
	}

	/**
	 * Get the resource name, used in the url
	 *
	 * @return string
	 */
	public function getResourceName() {
		return $this->resourceName;
	}

	/**
	 * Check if the accessToken is set in the scope
	 *
	 * @throws ScopeConfigurationException
	 */
	public function checkAuthenticated() {
		if (!$this->scope->hasAccessToken()) {
			throw new ScopeConfigurationException(['accessToken']);
		}
	}

	/**
	 * Create request
	 *
	 * @param Model $model
	 *
	 * @return mixed
	 * @throws \Nocks\SDK\Exception\BadRequestException
	 * @throws \Nocks\SDK\Exception\ForbiddenException
	 * @throws \Nocks\SDK\Exception\GoneException
	 * @throws \Nocks\SDK\Exception\InternalServerError
	 * @throws \Nocks\SDK\Exception\MethodNotAllowedException
	 * @throws \Nocks\SDK\Exception\NotAcceptable
	 * @throws \Nocks\SDK\Exception\NotFoundException
	 * @throws \Nocks\SDK\Exception\ServiceUnavailable
	 * @throws \Nocks\SDK\Exception\TooManyRequests
	 * @throws \Nocks\SDK\Exception\UnauthorizedException
	 */
	public function create(Model $model) {
		$response = $this->request->call(array_merge($this->requestOptions, [
			'method' => 'POST',
			'data' => $this->transformer->reverseTransform($model),
		]));

		return $this->responseHandler->handle($response, function($data) {
			return $this->transformer->transform($data);
		});
	}

	/**
	 * Find request
	 *
	 * @param array $queryParameters
	 *
	 * @return mixed
	 * @throws \Nocks\SDK\Exception\BadRequestException
	 * @throws \Nocks\SDK\Exception\ForbiddenException
	 * @throws \Nocks\SDK\Exception\GoneException
	 * @throws \Nocks\SDK\Exception\InternalServerError
	 * @throws \Nocks\SDK\Exception\MethodNotAllowedException
	 * @throws \Nocks\SDK\Exception\NotAcceptable
	 * @throws \Nocks\SDK\Exception\NotFoundException
	 * @throws \Nocks\SDK\Exception\ServiceUnavailable
	 * @throws \Nocks\SDK\Exception\TooManyRequests
	 * @throws \Nocks\SDK\Exception\UnauthorizedException
	 */
	public function find(array $queryParameters = []) {
		$response = $this->request->call(array_merge($this->requestOptions, [
			'url' => '?' . http_build_query(array_merge(['page' => 1], $queryParameters)),
		]));

		return $this->responseHandler->handle($response, function($data) {
			return array_map(function($transaction) {
				return $this->transformer->transform($transaction);
			}, $data);
		});
	}

	/**
	 * Find one request
	 *
	 * @param $key
	 *
	 * @return mixed
	 * @throws \Nocks\SDK\Exception\BadRequestException
	 * @throws \Nocks\SDK\Exception\ForbiddenException
	 * @throws \Nocks\SDK\Exception\GoneException
	 * @throws \Nocks\SDK\Exception\InternalServerError
	 * @throws \Nocks\SDK\Exception\MethodNotAllowedException
	 * @throws \Nocks\SDK\Exception\NotAcceptable
	 * @throws \Nocks\SDK\Exception\NotFoundException
	 * @throws \Nocks\SDK\Exception\ServiceUnavailable
	 * @throws \Nocks\SDK\Exception\TooManyRequests
	 * @throws \Nocks\SDK\Exception\UnauthorizedException
	 */
	public function findOne($key) {
		$response = $this->request->call(array_merge($this->requestOptions, [
			'url' => '/' . $key,
		]));

		return $this->responseHandler->handle($response, function($data) {
			return $this->transformer->transform($data);
		});
	}

	/**
	 * @param Model $model
	 *
	 * @throws ValidationException
	 */
	public function validateUpdate(Model $model) {
		$id = $model->getId();

		if (!is_string($id) || empty($id)) {
			throw new ValidationException('To update the model needs to provide an identifier');
		}
	}

	/**
	 * Update request
	 *
	 * @param Model $model
	 *
	 * @return mixed
	 * @throws ValidationException
	 * @throws \Nocks\SDK\Exception\BadRequestException
	 * @throws \Nocks\SDK\Exception\ForbiddenException
	 * @throws \Nocks\SDK\Exception\GoneException
	 * @throws \Nocks\SDK\Exception\InternalServerError
	 * @throws \Nocks\SDK\Exception\MethodNotAllowedException
	 * @throws \Nocks\SDK\Exception\NotAcceptable
	 * @throws \Nocks\SDK\Exception\NotFoundException
	 * @throws \Nocks\SDK\Exception\ServiceUnavailable
	 * @throws \Nocks\SDK\Exception\TooManyRequests
	 * @throws \Nocks\SDK\Exception\UnauthorizedException
	 */
	public function update(Model $model) {
		$this->validateUpdate($model);

		$response = $this->request->call(array_merge($this->requestOptions, [
			'method' => 'PUT',
			'url' => '/' . $model->getId(),
			'data' => $this->transformer->reverseTransform($model),
		]));

		return $this->responseHandler->handle($response, function($data) {
			return $this->transformer->transform($data);
		});
	}

	/**
	 * Delete request
	 *
	 * @param string $key
	 *
	 * @return mixed
	 * @throws \Nocks\SDK\Exception\BadRequestException
	 * @throws \Nocks\SDK\Exception\ForbiddenException
	 * @throws \Nocks\SDK\Exception\GoneException
	 * @throws \Nocks\SDK\Exception\InternalServerError
	 * @throws \Nocks\SDK\Exception\MethodNotAllowedException
	 * @throws \Nocks\SDK\Exception\NotAcceptable
	 * @throws \Nocks\SDK\Exception\NotFoundException
	 * @throws \Nocks\SDK\Exception\ServiceUnavailable
	 * @throws \Nocks\SDK\Exception\TooManyRequests
	 * @throws \Nocks\SDK\Exception\UnauthorizedException
	 */
	public function delete($key) {
		$response = $this->request->call(array_merge($this->requestOptions, [
			'method' => 'DELETE',
			'url' => '/' . $key,
		]));

		return $this->responseHandler->handle($response);
	}
}