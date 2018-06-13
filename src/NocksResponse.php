<?php


namespace Nocks\SDK;


class NocksResponse {

	private $data;
	private $pagination;

	public function __construct(array $data, $pagination = null) {
		$this->data = $data;
		$this->pagination = $pagination;
	}

	/**
	 * @return array
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * @return bool
	 */
	public function hasPagination() {
		return !is_null($this->pagination);
	}

	/**
	 * @return null
	 */
	public function getPagination() {
		return $this->pagination;
	}
}