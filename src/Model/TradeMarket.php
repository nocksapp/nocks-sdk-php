<?php


namespace Nocks\SDK\Model;

/**
 * Class TradeMarket
 *
 * @method string getCode()
 * @method Currency getLast()
 * @method Currency getVolume()
 * @method Currency getLow()
 * @method Currency getHigh()
 * @method Currency getBuy()
 * @method Currency getSell()
 * @method Currency getResource()
 *
 * @package Nocks\SDK\Model
 */
class TradeMarket extends Model {

	/**
	 * @return bool
	 */
	public function isActive() {
		return (bool) $this->is_active;
	}
}