<?php


namespace Nocks\SDK\Model;

/**
 * Class Balance
 *
 * @method string getUuid()
 * @method Currency getAvailable()
 * @method Currency getReserved()
 * @method Currency getTotal()
 * @method string getDepositTransactionReference()
 * @method string getType()
 * @method string getResource()
 * @method Currency[] getDepositLimitMonth()
 * @method Currency getDepositMax()
 * @method BalanceCurrency getCurrency()
 * @method User|Merchant getBalanceable()
 *
 * @method void setType(string $type)
 * @method void setCurrency(string $currency)
 * @method void setMerchant(string $merchant)
 *
 * @package Nocks\SDK\Models
 */
class Balance extends Model {

}