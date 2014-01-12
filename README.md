# Stripe PHP Webhook

Respond to [Stripe](https://stripe.com) webhooks like jQuery events — simple and elegant.

## Examples

Event handlers can be added in jQuery style using `S::on()`:

```php
S::on('charge.succeeded', function($charge, $event) {
	/* … */
});
```

Use `S::onSecure()` if you'd like to have the event data retrieved from Stripe:

```php
S::onSecure('charge.succeeded', function($charge, $event) {
	/* Now $charge and $event are retrieved from Stripe */
});
```

One handler can respond to multiple event types (both methods are equivalent):

```php
S::on('charge.succeeded charge.failed', function($charge, $event) {
	/* … */
});

S::on(['charge.succeeded', 'charge.failed'], function($charge, $event) {
	/* … */
});
```

## Usage

1. Add (the code from) this repository to your project.
2. Adjust the path to [stripe-php](https://github.com/stripe/stripe-php) and your Stripe API key in [webhook.php](webhook.php).
3. Create some event handlers and make sure they get loaded by [webhook.php](webhook.php).
4. Make [webhook.php](webhook.php) publicly accessible and add it's URL to your [Stripe webhooks](https://manage.stripe.com/account/webhooks).

## Handler Closure Format

Handlers are implemented using [PHP closures](http://www.php.net/manual/en/functions.anonymous.php). When your handler is executed, it receives two arguments:

1. The object as defined by `$event->data->object`; and
2. The event itself.

For a handler `function ($object, $event)`, `$object === $event->data->object` by definition.

Handler closures are not required to expect two arguments; it's fine if your handler expects one argument, like `function ($object)`, or no argument at all, like `function ()`.

The return value of your handler closures is not considered currently. This might change in future versions.

## Compatibility

This code has been tested with [stripe-php v1.10.1](https://github.com/stripe/stripe-php/tree/v1.10.1) and PHP 5.5.7. In theory, it should work with PHP 5.4 and newer.

## License

This code is licensed under MIT license. See [LICENSE](LICENSE) for details.