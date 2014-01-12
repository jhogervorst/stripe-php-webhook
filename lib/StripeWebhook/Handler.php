<?php

/*
 * Stripe PHP Webhook
 * Respond to Stripe webhooks like jQuery events --- simple and elegant.
 *
 * Copyright (C) 2014 Jonathan Hogervorst. All rights reserved.
 * This code is licensed under MIT license. See LICENSE for details.
 */

class StripeWebhook_Handler
{
	public $events;
	public $secure;
	public $handler;
	
	public function __construct($events, $secure, $handler) {
		$this->events = $events;
		$this->secure = $secure;
		$this->handler = $handler;
	}
}