<?php

/*
 * Stripe PHP Webhook
 * Respond to Stripe webhooks like jQuery events --- simple and elegant.
 *
 * Copyright (C) 2014 Jonathan Hogervorst. All rights reserved.
 * This code is licensed under MIT license. See LICENSE for details.
 */

// Load Stripe and Stripe Webhook
require_once 'path/to/stripe-php/lib/Stripe.php';
require_once 'lib/StripeWebhook.php';

// Configure Stripe with your API key
Stripe::setApiKey('d8e8fca2dc0f896fd7cb4cb0031ba249');

// Load event handlers
require_once 'handlers.php';

// Or load event handlers from multiple files in one folder
foreach (glob('handlers/*.php') as $file) {
	require_once $file;
}

// Get the Stripe event
$body = file_get_contents('php://input');
$event = json_decode($body);

// Execute the appropriate handlers for the event
S::trigger($event);