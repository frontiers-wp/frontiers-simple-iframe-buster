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
* **Autoptimize Automation:** No manual setup required. The plugin automatically injects script exclusions directly into Autoptimize configuration filters. This ensures your critical frame-busting JavaScript skips optimization bundling, remaining completely functional and positionally correct at all times.
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

= Do I need to manually configure Autoptimize script exclusions? =
No. The plugin handles this natively by hooking into Autoptimize filters directly. The frame-busting logic is dynamically whitelisted and protected from script aggregation or minification errors without requiring any user intervention.

= Does this require Apache or Nginx configuration updates? =
No. The plugin sets the `X-Frame-Options` headers programmatically via internal PHP runtime hooks.

== Screenshots ==


== Changelog ==

= 2.0.0 =
* Confirmed WordPress 7.1 compatibility.
* Confirmed PHP 8.5 compatibility.
* Critical security updates to frame-busting logic.
* Automatically injects exclusions into Autoptimize configuration filters.
* Resolved asset execution issues affecting Eventbrite checkout widgets.

= 1.0.0 =
* Initial public development release.
