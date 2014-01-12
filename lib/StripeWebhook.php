<?php

/*
 * Stripe PHP Webhook
 * Respond to Stripe webhooks like jQuery events --- simple and elegant.
 *
 * Copyright (C) 2014 Jonathan Hogervorst. All rights reserved.
 * This code is licensed under MIT license. See LICENSE for details.
 */

require_once dirname(__FILE__) . '/StripeWebhook/StripeWebhook.php';
require_once dirname(__FILE__) . '/StripeWebhook/Handler.php';

class_alias('StripeWebhook', 'S', false);