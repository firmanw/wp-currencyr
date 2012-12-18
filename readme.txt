=== Currencyr ===
Author: Firman Wandayandi
Contributors: firmanw
Author URI: http://firmanw.com
Plugin URI: http://adivalabs.com/currencyr
Donate Link: http://adivalabs.com/donate
Tags: money, currency, conversion, ecommerce, shop, store
Requires at least: 3.4
Tested up to: 3.4
Stable tag: 1.0.1

A simple yet advanced, intuitive, easy-to-use and classy currency converter tooltip.

== Description ==

Instead of traditional "calculator" looks converter, Currencyr take the advance of "tooltip" and sit right at the amount to allow user convert it.

= Features =

* Various exchange rates providers - Yahoo!, Google, Open Exchange Rates, European Central Bank and FoxRates
* Support database cache driven for fast load
* WP Cron task scheduler enabled
* Shortcode quick conversion support
* Currency table and converter widget
* Inline converter using Currencyr for jQuery
* Auto-determinate local currency
* Support integration with various ecommerce plugins - WooCommerce, WP-eCommerce, Shopp and Easy Digital Downloads

Visit http://adivalabs.com/currencyr for futher details and demo.

= Shortcode =

To enable the shortcode simply use [currencyr] and use the following syntax:

`[currencyr amount=$amount <from=$code> to=$code<|$code>]`

* **amount** - The number that you wish to convert.
* **to** - The currency code. Use "|" as separator for multiple conversion.
* **from** (optional) - The currency code. If omitted the Base Currency from setting will be use.

Examples:
`[currencyr=99.99 to=gbp]`

`[currencyr=99.99 from=aud to=gbp]`

`[currencyr=99.99 to=gbp|eur|cad]`

= Function Call =

The conversion feature is available to call within templates or codes using either currencyr_exchange() or the_currencyr_exchange(). Both functions share the same arguments, the diferrent is the_currencyr_exchange() is only echoes the result automatically. You can call the functions as WordPress style or PHP with the following arguments:

* **amount** - The number that you wish to convert.
* **to** - The currency code.
* **from** (optional) - The currency code. If omitted the Base Currency from setting will be use.

`<?php echo currencyr_exchange( 'amount=99.99&to=cad'); ?>`

The code above is similar to:

`<?php echo currencyr_exchange( array( 'amount' => 99.99, 'to' => 'cad' ) ); ?>`

Also similar to:

`<?php echo currencyr_exchange( 99.99, 'cad' ); ?>

= Roadmap =

* Add exchange rates table page
* Add custom currency support

= Feedback =
If you have any feedback, any at all, tweet [@firmanw](http://twitter.com/firmanw), or head over to the [support forum](http://wordpress.org/support/plugin/currencyr) or [github repository](https://github.com/firmanw/wp-currencyr) and create a new issue.

== Installation ==

1. Upload the "currencyr" folder to the "/wp-content/plugins" directory
2. Activate the Currencyr through the "Plugins" menu in WordPress
3. Go to Currencyr menu to get started

== Screenshots ==

1. Converter tooltip sit right at the amount
2. The settings page

== Changelog ==

= 1.0.2 =

* Added functions to able to use conversion within templates/codes
* Added handler when conversion return no result

= 1.0.1 =

* Fixed settings page capability typo
* Fixed widget number format
* Fixed plugin URI

= 1.0 =

Initial release
