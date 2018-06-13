<?php


namespace Nocks\SDK\Resource;


use Nocks\SDK\Model;

class User {

	private $resourceHelper;

	public function __construct(ResourceHelper $resourceHelper) {
		$this->resourceHelper = $resourceHelper;
	}

	/**
	 * Create a User
	 *
	 * @param Model\User $user
	 *
	 * @return Model\User
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
	public function create(Model\User $user) {
		return $this->resourceHelper->create($user);
	}

	/**
	 * Find the authenticated user
	 *
	 * @return Model\User
	 * @throws \Nocks\SDK\Exception\BadRequestException
	 * @throws \Nocks\SDK\Exception\ForbiddenException
	 * @throws \Nocks\SDK\Exception\GoneException
	 * @throws \Nocks\SDK\Exception\InternalServerError
	 * @throws \Nocks\SDK\Exception\MethodNotAllowedException
	 * @throws \Nocks\SDK\Exception\NotAcceptable
	 * @throws \Nocks\SDK\Exception\NotFoundException
	 * @throws \Nocks\SDK\Exception\ScopeConfigurationException
	 * @throws \Nocks\SDK\Exception\ServiceUnavailable
	 * @throws \Nocks\SDK\Exception\TooManyRequests
	 * @throws \Nocks\SDK\Exception\UnauthorizedException
	 */
	public function findAuthenticated() {
		$this->resourceHelper->checkAuthenticated();

		return $this->resourceHelper->find()->getData()[0];
	}

	/**
	 * Update a User
	 *
	 * @param Model\User $user
	 * @param string $twoFactorCode
	 *
	 * @return Model\User
	 * @throws \Nocks\SDK\Exception\BadRequestException
	 * @throws \Nocks\SDK\Exception\ForbiddenException
	 * @throws \Nocks\SDK\Exception\GoneException
	 * @throws \Nocks\SDK\Exception\InternalServerError
	 * @throws \Nocks\SDK\Exception\MethodNotAllowedException
	 * @throws \Nocks\SDK\Exception\NotAcceptable
	 * @throws \Nocks\SDK\Exception\NotFoundException
	 * @throws \Nocks\SDK\Exception\ScopeConfigurationException
	 * @throws \Nocks\SDK\Exception\ServiceUnavailable
	 * @throws \Nocks\SDK\Exception\TooManyRequests
	 * @throws \Nocks\SDK\Exception\UnauthorizedException
	 * @throws \Nocks\SDK\Exception\ValidationException
	 */
	public function update(Model\User $user, $twoFactorCode) {
		$this->resourceHelper->checkAuthenticated();
		$this->resourceHelper->validateUpdate($user);

		$response = $this->resourceHelper->getRequestHandler()->call(array_merge($this->resourceHelper->requestOptions, [
			'method' => 'PUT',
			'url' => '/' . $user->getId(),
			'headers' => array_merge($this->resourceHelper->getScope()->getHeaders(), [
				'X-Nocks-2FA' => $twoFactorCode,
			]),
			'data' => $this->resourceHelper->getTransformer()->reverseTransform($user),
		]));

		return $this->resourceHelper->getResponseHandler()->handle($response, function($data) {
			return $this->resourceHelper->getTransformer()->transform($data);
		});
	}

	/**
	 * Delete a User
	 *
	 * @param $uuid
	 * @param $twoFactorCode
	 *
	 * @return void
	 * @throws \Nocks\SDK\Exception\BadRequestException
	 * @throws \Nocks\SDK\Exception\ForbiddenException
	 * @throws \Nocks\SDK\Exception\GoneException
	 * @throws \Nocks\SDK\Exception\InternalServerError
	 * @throws \Nocks\SDK\Exception\MethodNotAllowedException
	 * @throws \Nocks\SDK\Exception\NotAcceptable
	 * @throws \Nocks\SDK\Exception\NotFoundException
	 * @throws \Nocks\SDK\Exception\ScopeConfigurationException
	 * @throws \Nocks\SDK\Exception\ServiceUnavailable
	 * @throws \Nocks\SDK\Exception\TooManyRequests
	 * @throws \Nocks\SDK\Exception\UnauthorizedException
	 */
	public function delete($uuid, $twoFactorCode) {
		$this->resourceHelper->checkAuthenticated();

		$response = $this->resourceHelper->getRequestHandler()->call(array_merge($this->resourceHelper->requestOptions, [
			'method' => 'DELETE',
			'url' => '/' . $uuid,
			'headers' => array_merge($this->resourceHelper->getScope()->getHeaders(), [
				'X-Nocks-2FA' => $twoFactorCode,
			]),
		]));

		$this->resourceHelper->getResponseHandler()->handle($response);
	}
}