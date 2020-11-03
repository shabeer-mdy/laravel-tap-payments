<?php

namespace Tap\TapPayment\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class TapPayment
 *
 * @package Tap\TapPayment\Facade
 *
 * @method static \Tap\TapPayment\Services\Charge createCharge()
 * @method static \Tap\TapPayment\Resources\Invoice findCharge()
 */
class TapPayment extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'tap-payment';
	}
}
