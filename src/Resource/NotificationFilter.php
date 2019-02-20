<?php


namespace Nocks\SDK\Resource;


use Nocks\SDK\Generated\NotificationFilterResponse;
use Nocks\SDK\Model;

class NotificationFilter {

	private $resourceHelper;

	public function __construct(ResourceHelper $resourceHelper) {
		$this->resourceHelper = $resourceHelper;
	}

	/**
	 * Create a notification filter
	 *
	 * @param Model\NotificationFilter $notificationFilter
	 *
	 * @return Model\NotificationFilter
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
	public function create(Model\NotificationFilter $notificationFilter) {
		$this->resourceHelper->checkAuthenticated();

		return $this->resourceHelper->create($notificationFilter);
	}

	/**
	 * Find all the notification filters
	 *
	 * @param array $queryParameters
	 *
	 * @return NotificationFilterResponse
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
	public function find(array $queryParameters = []) {
		$this->resourceHelper->checkAuthenticated();

		return $this->resourceHelper->find($queryParameters);
	}

	/**
	 * Find a single notification filter
	 *
	 * @param $uuid
	 *
	 * @return \Nocks\SDK\Model\NotificationFilter
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
	 * @throws \Nocks\SDK\Exception\ScopeConfigurationException
	 */
	public function findOne($uuid) {
		$this->resourceHelper->checkAuthenticated();

		return $this->resourceHelper->findOne($uuid);
	}

	/**
	 * Update a notification filter
	 *
	 * @param Model\NotificationFilter $notificationFilter
	 *
	 * @return Model\NotificationFilter
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
	public function update(Model\NotificationFilter $notificationFilter) {
		$this->resourceHelper->checkAuthenticated();

		return $this->resourceHelper->update($notificationFilter);
	}

	/**
	 * Delete a notification filter
	 *
	 * @param $uuid
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
	public function delete($uuid) {
		$this->resourceHelper->checkAuthenticated();

		$this->resourceHelper->delete($uuid);
	}
}
