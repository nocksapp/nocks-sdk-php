<?php


namespace Nocks\SDK;


use Nocks\SDK\Http\CurlRequest;
use Nocks\SDK\Resource\PaymentAddress;
use Nocks\SDK\Resource\Balance;
use Nocks\SDK\Resource\Bill;
use Nocks\SDK\Resource\Deposit;
use Nocks\SDK\Resource\FundingSource;
use Nocks\SDK\Resource\Merchant;
use Nocks\SDK\Resource\MerchantClearing;
use Nocks\SDK\Resource\MerchantInvoice;
use Nocks\SDK\Resource\MerchantProfile;
use Nocks\SDK\Resource\ResourceHelper;
use Nocks\SDK\Resource\Setting;
use Nocks\SDK\Resource\TradeMarket;
use Nocks\SDK\Resource\TradeOrder;
use Nocks\SDK\Resource\Transaction;
use Nocks\SDK\Resource\TransactionPayment;
use Nocks\SDK\Resource\User;
use Nocks\SDK\Resource\Withdrawal;
use Nocks\SDK\Scope\ApiScope;
use Nocks\SDK\Transformer\PaymentAddressValidationTransformer;
use Nocks\SDK\Transformer\BalanceTransferTransformer;
use Nocks\SDK\Transformer\BalanceTransformer;
use Nocks\SDK\Transformer\BillTransformer;
use Nocks\SDK\Transformer\DepositTransformer;
use Nocks\SDK\Transformer\FundingSourceTransformer;
use Nocks\SDK\Transformer\MerchantClearingTransformer;
use Nocks\SDK\Transformer\MerchantInvoiceTransformer;
use Nocks\SDK\Transformer\MerchantProfileTransformer;
use Nocks\SDK\Transformer\MerchantProfileTurnoverTransformer;
use Nocks\SDK\Transformer\MerchantTransformer;
use Nocks\SDK\Transformer\PaymentRefundTransformer;
use Nocks\SDK\Transformer\PaymentTransformer;
use Nocks\SDK\Transformer\SettingTransformer;
use Nocks\SDK\Transformer\TradeMarketBookTransformer;
use Nocks\SDK\Transformer\TradeMarketCandleTransformer;
use Nocks\SDK\Transformer\TradeMarketDistributionTransformer;
use Nocks\SDK\Transformer\TradeMarketHistoryTransformer;
use Nocks\SDK\Transformer\TradeMarketQuoteTransformer;
use Nocks\SDK\Transformer\TradeMarketTransformer;
use Nocks\SDK\Transformer\TradeOrderTransformer;
use Nocks\SDK\Transformer\TransactionQuoteTransformer;
use Nocks\SDK\Transformer\TransactionStatisticTransformer;
use Nocks\SDK\Transformer\TransactionTransformer;
use Nocks\SDK\Transformer\UserTransformer;
use Nocks\SDK\Transformer\WithdrawalTransformer;

class NocksApi {

	private $scope;
	private $requestHandler;

	public $user;
	public $tradeMarket;
	public $transaction;
	public $transactionPayment;
	public $fundingSource;
	public $deposit;
	public $withdrawal;
	public $merchant;
	public $merchantProfile;
	public $merchantClearing;
	public $merchantInvoice;
	public $balance;
	public $tradeOrder;
	public $bill;
	public $setting;
	public $paymentAddress;

	public function __construct($platform, $accessToken = null) {
		$this->scope = new ApiScope($platform, $accessToken);
		$this->requestHandler = new CurlRequest();

		// Setup resources
		$this->user = new User(
			new ResourceHelper($this->scope, $this->requestHandler, new UserTransformer(), 'user')
		);

		$this->tradeMarket = new TradeMarket(
			new ResourceHelper($this->scope, $this->requestHandler, new TradeMarketTransformer(),'trade-market'),
			new TradeMarketBookTransformer(),
			new TradeMarketHistoryTransformer(),
			new TradeMarketDistributionTransformer(),
			new TradeMarketCandleTransformer(),
			new TradeMarketQuoteTransformer()
		);

		$this->transaction = new Transaction(
			new ResourceHelper($this->scope, $this->requestHandler, new TransactionTransformer(), 'transaction'),
			new TransactionQuoteTransformer(),
			new TransactionStatisticTransformer()
		);

		$this->transactionPayment = new TransactionPayment(
			new ResourceHelper($this->scope, $this->requestHandler, new PaymentTransformer(), 'payment'),
			new PaymentRefundTransformer()
		);

		$this->fundingSource = new FundingSource(
			new ResourceHelper($this->scope, $this->requestHandler, new FundingSourceTransformer(), 'funding-source'),
			new PaymentTransformer()
		);

		$this->deposit = new Deposit(
			new ResourceHelper($this->scope, $this->requestHandler, new DepositTransformer(), 'deposit')
		);

		$this->withdrawal = new Withdrawal(
			new ResourceHelper($this->scope, $this->requestHandler, new WithdrawalTransformer(), 'withdrawal')
		);

		$this->merchant = new Merchant(
			new ResourceHelper($this->scope, $this->requestHandler, new MerchantTransformer(), 'merchant')
		);

		$this->merchantProfile = new MerchantProfile(
			new ResourceHelper($this->scope, $this->requestHandler, new MerchantProfileTransformer(), 'merchant-profile'),
			new MerchantProfileTurnoverTransformer()
		);

		$this->merchantClearing = new MerchantClearing(
			new ResourceHelper($this->scope, $this->requestHandler, new MerchantClearingTransformer(), 'merchant-clearing')
		);

		$this->merchantInvoice = new MerchantInvoice(
			new ResourceHelper($this->scope, $this->requestHandler, new MerchantInvoiceTransformer(), 'merchant-invoice')
		);

		$this->balance = new Balance(
			new ResourceHelper($this->scope, $this->requestHandler, new BalanceTransformer(), 'balance'),
			new BalanceTransferTransformer()
		);

		$this->tradeOrder = new TradeOrder(
			new ResourceHelper($this->scope, $this->requestHandler, new TradeOrderTransformer(), 'trade-order')
		);

		$this->bill = new Bill(
			new ResourceHelper($this->scope, $this->requestHandler, new BillTransformer(), 'bill')
		);

		$this->setting = new Setting(
			new ResourceHelper($this->scope, $this->requestHandler, new SettingTransformer(), 'settings')
		);

		$this->paymentAddress = new PaymentAddress(
			new ResourceHelper($this->scope, $this->requestHandler, new PaymentAddressValidationTransformer(), 'address')
		);
	}
}
