<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Pagination;

class PaginationTransformer {

	/**
	 * Transform pagination
	 *
	 * @param $data
	 *
	 * @return Pagination
	 */
	public static function transform($data) {
		return new Pagination($data);
	}

	/**
	 * Reverse transform pagination
	 *
	 * @param $pagination
	 *
	 * @return array
	 */
	public static function reverseTransform(Pagination $pagination) {
		return $pagination->getData();
	}
}