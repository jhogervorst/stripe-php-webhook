<?php

/*
 * Stripe PHP Webhook
 * Respond to Stripe webhooks like jQuery events --- simple and elegant.
 *
 * Copyright (C) 2014 Jonathan Hogervorst. All rights reserved.
 * This code is licensed under MIT license. See LICENSE for details.
 */

class StripeWebhook
{
	protected static $instance = null;
	private $handlers = [];
	
	protected function __construct() {}
	protected function __clone() {}
	
	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		
		return self::$instance;
	}
	
	private function addHandler(StripeWebhook_Handler $handler) {
		$this->handlers[] = $handler;
		return true;
	}
	
	public static function on($events, $handler) {
		$handler = new StripeWebhook_Handler($events, false, $handler);
		return self::getInstance()->addHandler($handler);
	}
	
	public static function onSecure($events, $handler) {
		$handler = new StripeWebhook_Handler($events, true, $handler);
		return self::getInstance()->addHandler($handler);
	}
	
	public static function trigger($event) {
		if (!is_object($event)) {
			return false;
		}
		
		$handlers = [];
		$retrieveSecureEvent = false;
		
		$eventType = strtolower($event->type);
		
		foreach (self::getInstance()->handlers as $handler) {
			$handlerEventTypes = $handler->events;
			
			if (!is_array($handlerEventTypes)) {
				$handlerEventTypes = explode(' ', $handlerEventTypes);
			}
			
			$handlerEventTypes = array_map('trim', $handlerEventTypes);
			$handlerEventTypes = array_map('strtolower', $handlerEventTypes);
			
			if (in_array($eventType, $handlerEventTypes)) {
				$handlers[] = $handler;
				
				if (!$retrieveSecureEvent && $handler->secure) {
					$retrieveSecureEvent = true;
				}
			}
		}
		
		if ($retrieveSecureEvent) {
			$event = Stripe_Event::retrieve($event->id);
		}
		
		foreach ($handlers as $handler) {
			$handlerClosure = $handler->handler;
			$handlerClosure($event->data->object, $event);
		}
		
		return true;
	}
}