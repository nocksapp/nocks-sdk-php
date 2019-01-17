<?php


namespace Nocks\SDK\Model;

/**
 * Class PaymentRefund
 *
 * @method string getUuid()
 * @method string getStatus()
 * @method string getType()
 * @method string getMethodType()
 * @method string getDescription()
 * @method Date getCreatedAt()
 * @method Date getUpdatedAt()
 * @method string getResource()
 * @method Currency getAmount()
 * @method Currency getAmountRefunded()
 * @method array getMetadata()
 * @method PaymentMethod getPaymentMethod()
 * @method array getPayable()
 *
 * @method void setRefundAddress(string $refundAddress)
 * @method void setDescription(string $description)
 * @method void setAmount(Currency $amount)
 *
 * @package Nocks\SDK\Model
 */
class PaymentRefund extends Model {

}
