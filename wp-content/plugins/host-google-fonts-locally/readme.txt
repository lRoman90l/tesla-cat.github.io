=== Host Google Fonts Locally ===
Contributors: DannyCooper, googlefonts
Tags: google, fonts, google fonts, gdpr, local google fonts
Donate link: https://fontsplugin.com/#pricing
Requires at least: 4.0
Requires PHP: 5.2
Tested up to: 5.2
License: GPLv2 or later
Stable tag: trunk

Load fonts from your own server instead of Google's. GDPR-friendly.

== Description ==

No configuration required, simply activate the plugin and it just works 🙂

> This is an addon for the [Google Fonts for WordPress](https://wordpress.org/plugins/olympus-google-fonts/) plugin. It will only rewrite fonts loaded by that plugin.

Hosting Google Fonts locally removes the need for your website to make requests to Google's servers. This can be useful when optimizing performance and also for complying to GDPR requirements.

### How it Works

* Downloads the font files to your /wp-content/uploads folder.
* Replaces the Google references with your own local domain.
* Remove the Google Fonts 'prefetch' resource hints.

### Further Reading

For more information on using Google Fonts in Wordpress, check out the following:

* [Documentation](https://fontsplugin.com/docs/)
* [How to Use Google Fonts in WordPress](https://fontsplugin.com/wordpress-google-fonts/)

= Bugs =
If you find an issue with this plugin, let us know [here](https://wordpress.org/support/plugin/host-google-fonts-locally/)!

= Contributions =
Anyone is welcome to contribute to the 'Google Fonts for WordPress' plugin.

There are various ways you can contribute:

1. Translate the Host Google Fonts Locally plugin into [different languages](https://translate.wordpress.org/projects/wp-plugins/host-google-fonts-locally/)
2. Provide feedback and suggestions on [enhancements](https://wordpress.org/support/plugin/host-google-fonts-locally)


== Installation ==
Upload 'Host Google Fonts Locally', activate it, and you're done!

== Frequently Asked Questions ==

= Will this plugin rewrite fonts loaded by my theme and/or other plugins? =

Currently, this plugin only rewrites fonts loaded by the [Google Fonts for WordPress](https://wordpress.org/plugins/olympus-google-fonts/) plugin. We may expand to other themes/plugins in future.

== Screenshots ==

1. Boost Performance by Hosting Google Fonts Locally

== Changelog ==

= 1.0.2 =

* Fix textdomain loading

= 1.0.1 =

* Add class_exists() check.

= 1.0.0 =

* Initial release of Host Google Fonts Locally.
