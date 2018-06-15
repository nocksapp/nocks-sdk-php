<?php


namespace Nocks\SDK\Resource;


class Setting {

	private $resourceHelper;

	public function __construct(ResourceHelper $resourceHelper) {
		$this->resourceHelper = $resourceHelper;
	}


	/**
	 * Get the Nocks settings
	 *
	 * @return \Nocks\SDK\Model\Setting
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
	public function get() {
		$response = $this->resourceHelper->getRequestHandler()->call($this->resourceHelper->requestOptions);

		return $this->resourceHelper->getResponseHandler()->handle($response, function($data) {
			return $this->resourceHelper->getTransformer()->transform($data);
		});
	}

}