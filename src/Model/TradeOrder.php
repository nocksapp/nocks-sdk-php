<?php


namespace Nocks\SDK\Model;

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
 *
 * @method void setAmount(string $amount)
 * @method void setSide(string $side)
 * @method void setRate(string $rate)
 * @method void setStop(string $stop)
 * @method void setStopRate(string $stopRate)
 * @method void setLabel(string $label)
 *
 * @package Nocks\SDK\Model
 */
class TradeOrder extends Model {

	/**
	 * @param $tradeMarket
	 */
	public function setTradeMarket($tradeMarket) {
		$this->{'trade-market'} = $tradeMarket;
	}
}