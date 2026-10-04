=== Frontiers Simple Iframe Buster ===
Contributors: vizkr, Frontiers
Tags: iframe, x-frame-options, security, clickjacking, autoptimize
Requires at least: 5.9
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 2.0.0
License: GPLv2
License URI: http://gnu.org

Provides a robust method of preventing malicious site framing by delivering X-Frame-Options headers and enqueuing an optimized client-side JavaScript iframe blocker fallback.

== Description ==

**Frontiers Simple Iframe Buster** is a lightweight, zero-configuration security utility built to prevent unauthorized third-party websites from framing your WordPress content. By disabling external framing, this plugin mitigates malicious clickjacking and UI redress attacks.

The plugin operates on two distinct defense layers:
1. **Server-Side Headers:** It programmatically hooks into the WordPress environment to transmit an `X-Frame-Options: SAMEORIGIN` HTTP response header. This is ideal for sites hosted in restricted environments that lack direct access to server configuration binaries, `.htaccess` files, or the Apache `mod_headers` module.
2. **Client-Side Fallback:** It automatically enqueues a highly optimized, non-blocking JavaScript frame-breaker script. If a browser attempts to render the site within an unauthorized `<iframe` container, the script triggers a top-level location replace to break out of the framed environment.

= Key Optimizations in v2.0.0 =
* **Autoptimize Compatibility:** Scripts are structured to safely bypass structural mini-bundlers and script aggregations, ensuring your clickjacking defense remains active even when advanced caching plugins are deployed.
* **Modern Environments:** Extensively tested on modern WordPress core instances up to version 7.1 and fully optimized for runtime environments powered by PHP 8.5.

== Installation ==

= Automated Installation =
1. Go to your WordPress Admin Dashboard, navigate to **Plugins**, and click **Add New**.
2. Search for `Frontiers Simple Iframe Buster`.
3. Click **Install Now**, then click **Activate**.

= Manual Installation =
1. Download the plugin archive `.zip` file.
2. Extract the contents and upload the entire `simple-iframe-buster` folder to your server's `/wp-content/plugins/` directory.
3. Activate the plugin through the **Plugins** menu in the WordPress dashboard.

== Frequently Asked Questions ==

= Can this plugin be used with Eventbrite? =
Yes. This plugin is fully compatible with Eventbrite checkout workflows. It ensures that standard external transactional hooks and processing integrations continue to operate smoothly without dropping frames or interrupting customer transactions.

= Does this require Apache or Nginx configuration updates? =
No. The plugin sets the `X-Frame-Options` headers programmatically via internal PHP runtime hooks. It is purpose-built for shared hosting environments or configurations where you cannot modify the underlying web server configuration directly.

= Will this break legitimate embeds like YouTube or Vimeo? =
No. This plugin prevents *other* sites from embedding *your* site contents inside an iframe. It does not block your own site from rendering embedded content from external third parties.

== Screenshots ==


== Changelog ==

= 2.0.0 =
* Confirmed WordPress 7.1 compatibility.
* Confirmed PHP 8.5 compatibility.
* Critical security updates to frame-busting logic.
* Added explicit structural compatibility for Autoptimize setups.
* Resolved asset execution issues affecting Eventbrite checkout widgets.

= 1.0.0 =
* Initial public development release.
