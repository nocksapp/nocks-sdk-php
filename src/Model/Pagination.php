<?php


namespace Nocks\SDK\Model;

/**
 * Class Pagination
 *
 * @method integer getTotal()
 * @method integer getCount()
 * @method integer getPerPage()
 * @method integer getCurrentPage()
 * @method integer getTotalPages()
 * @method string[] getLinks()
 *
 * @package Nocks\SDK\Model
 */
class Pagination extends Model {

	/**
	 * Check if there is a next page
	 *
	 * @return bool
	 */
	public function hasNext() {
		return isset($this->links) && isset($this->links['next']);
	}

	/**
	 * Check if there is a previous page
	 *
	 * @return bool
	 */
	public function hasPrevious() {
		return isset($this->links) && isset($this->links['previous']);
	}
}