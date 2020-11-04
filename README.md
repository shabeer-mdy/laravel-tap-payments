# About

Integration library with https://www.tap.company

## Installation

```
composer require "spacemudd/laravel-tap-payments"
```

## For older versions of Laravel (<5.5)

Update your `/config/app.php` with:

```
'providers' => [
    ...
	\Tap\TapPayment\TapPaymentServiceProvider::class
]
```

```
'aliases' => [
    ...
	'TapPayment' => \Tap\TapPayment\Facade\TapPayment::class
]
```

## Publishing

```
php artisan vendor:publish --provider="Tap\TapPayment\TapPaymentServiceProvider"
```


# Config

Update `/config/tap-payment.php` with your info.

Add the following to your .env file:

```
TAP_PAYMENT_API_KEY=your_api_key
```

## Current version Functions

* `TapPayment::createCharge()` - Creating an ApiInvoice
* `TapPayment::findCharge($id)` - Finding an ApiInvoice by ID

## Usage example

### Creating a charge

```php
use Tap\TapPayment\Facade\TapPayment;

public function pay()
{
	try {
		$payment = TapPayment::createCharge();
		$payment->setCustomerName("John Doe");
		$payment->setCustomerPhone("965", "123456789");
		$payment->setDescription("Some description");
		$payment->setAmount(123);
		$payment->setCurrency("KWD");
		$payment->setSource("src_kw.knet");
		$payment->setRedirectUrl("https://example.com");
		$payment->setPostUrl("https://example.com"); // if you are using post request to handle payment updates
		$payment->setMetaData(['package' => json_encode($package)]); // if you want to send metadata
		$invoice = $payment->pay();
	} catch( \Exception $exception ) {
		// your handling of request failure
	}
    
    $payment->isSuccess(); // check if TapPayment has successfully handled request.
}
```

### Getting an invoice

```php
public function check($id)
{
	try {
		 $invoice = TapPayment::findCharge($id);
	 } catch(\Exception $exception) {
		// your handling of request failure
	}

	$invoice->checkHash($request->header('Hashstring')); // check hashstring to make sure that request comes from Tap
	$invoice->isSuccess(); // check if invoice is paid
	$invoice->isInitiated(); // check if invoice is unpaid yet
}
```
