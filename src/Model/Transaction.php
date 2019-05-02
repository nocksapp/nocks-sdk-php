<?php


namespace Nocks\SDK\Model;

/**
 * Class Transaction
 *
 * @method string getUuid()
 * @method string getPaymentUrl()
 * @method string getStatus()
 * @method Currency getAmount()
 * @method Currency getSourceAmount()
 * @method Currency getTargetAmount()
 * @method Currency getReceivedAmount()
 * @method Currency getTipAmount()
 * @method string getTargetAddress()
 * @method string getRefundAddress()
 * @method string getName()
 * @method string getDescription()
 * @method string getRedirectUrl()
 * @method string getCallbackUrl()
 * @method array getMetadata()
 * @method string getLocale()
 * @method Date getExpireAt()
 * @method bool getExtendableExpiration()
 * @method string getMerchantProfile()
 * @method string getMerchantClearing()
 * @method string getMerchantReference()
 * @method Date getCreatedAt()
 * @method Date getUpdatedAt()
 * @method string getResource()
 * @method Payment[] getPayments()
 * @method StatusTransition[] getStatusTransitions()
 * @method PaymentMethod getPaymentMethod()
 * @method MerchantClearingDistribution getClearingDistribution()
 *
 * @method void setMerchantProfile(string $merchantProfile)
 * @method void setMerchantReference(string $merchantReference)
 * @method void setSourceCurrency(string $sourceCurrency)
 * @method void setTargetCurrency(string $targetCurrency)
 * @method void setTargetAddress(string $targetAddress)
 * @method void setRefundAddress(string $refundAddress)
 * @method void setAmount(Currency $amount)
 * @method void setName(string $name)
 * @method void setDescription(string $description)
 * @method void setTipAmount(Currency $tipAmount)
 * @method void setPaymentMethod(PaymentMethod $paymentMethod)
 * @method void setMetadata(array $metadata)
 * @method void setRedirectUrl(string $redirectUrl)
 * @method void setCallbackUrl(string $callbackUrl)
 * @method void setLocale(string $locale)
 * @method void setFeeType(string $feeType)
 *
 * @package Nocks\SDK\Model
 */
class Transaction extends Model {

}