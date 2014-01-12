<?php

/*
 * Stripe PHP Webhook
 * Respond to Stripe webhooks like jQuery events --- simple and elegant.
 *
 * Copyright (C) 2014 Jonathan Hogervorst. All rights reserved.
 * This code is licensed under MIT license. See LICENSE for details.
 */

// This file contains some example handler. In your application, you can remove
// it and create your own handlers.

// This handler sends a "Thank you" message when a charge was successful.
S::on('charge.succeeded', function($charge) {
	$customer = Stripe_Customer::retrieve($charge->customer);
	mail($customer->email, 'Thanks you', 'Thanks for your payment! <3');
});

// This handler sends an angry message when a customer disputes a charge.
// (You should probably not use this in production.)
S::on('charge.dispute.created charge.dispute.updated', function($dispute) {
	$charge = Stripe_Charge::retrieve($dispute->charge);
	$customer = Stripe_Customer::retrieve($charge->customer);
	mail($customer->email, '#@%&@', 'WHY U DISPUTE?', $photo_of_dead_horse_head);
});