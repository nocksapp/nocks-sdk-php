<?php


namespace Nocks\SDK\Model;

use DateTime;

/**
 * Class TradeOrder
 *
 * @method string getUuid()
 * @method Currency getAmount()
 * @method Currency getAmountFilled()
 * @method Currency getAmountCost()
 * @method Currency getAmountFee()
 * @method Currency getAmountFillable()
 * @method string getRate()
 * @method string getRateActual()
 * @method string getLabel()
 * @method string getSide()
 * @method string getType()
 * @method string getStatus()
 * @method string getStop()
 * @method string getStopHit()
 * @method string getStopRate()
 * @method Date getCreatedAt()
 * @method Date getUpdatedAt()
 * @method Date getCancelledAt()
 * @method Date getFilledAt()
 * @method string getTradeMarket()
 * @method string getResource()
 * @method boolean getPostOnly()
 * @method string getTimeInForce()
 * @method Date getExpireAt()
 *
 * @method void setAmount(string $amount)
 * @method void setSide(string $side)
 * @method void setRate(string $rate)
 * @method void setStop(string $stop)
 * @method void setStopRate(string $stopRate)
 * @method void setLabel(string $label)
 * @method void setPostOnly(boolean $postOnly)
 * @method void setTimeInForce(string $timeInForce)
 *
 * @package Nocks\SDK\Model
 */
class TradeOrder extends Model {

	public function __construct(array $data = []) {
		parent::__construct($data);

		// Make sure "expireAt" is casted to a "Date"
		if ($this->hasExpireAt()) {
			$this->setExpireAt($this->getExpireAt());
		}
	}

	/**
	 * @param string $tradeMarket
	 */
	public function setTradeMarket($tradeMarket) {
		$this->{'trade-market'} = $tradeMarket;
	}

	/**
	 * @param DateTime|Date $expireAt
	 */
	public function setExpireAt($expireAt) {
		if ($expireAt instanceof Date) {
			$this->expireAt = $expireAt;
		} else {
			$expireAtDate = new Date();
			$expireAtDate->setDateTime($expireAt);
			$this->expireAt = $expireAtDate;
		}
	}
}