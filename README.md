# Frontiers Simple iFrame Buster

[![WordPress Compatibility](https://shields.io)](https://wordpress.org)
[![License](https://shields.io)](LICENSE)

A lightweight, efficient WordPress plugin designed to prevent unauthorized third-party websites from framing your content. By implementing a reliable client-side **Frame Buster** (Framebreaker) mechanism alongside native security headers, this utility effectively mitigates [Clickjacking and UI redress attacks](https://wikipedia.org "Framekiller - Wikipedia").

## 🚀 Features

* **Lightweight Footprint:** Zero impact on site performance or initial page load metrics.
* **Instant Prevention:** Immediately forces the browser window to navigate to the top-level frame if an unauthorized embed attempt is detected.
* **WordPress Native:** Designed specifically to integrate seamlessly with standard WordPress architectures without conflicting with core hooks.
* **Autoptimize Automation:** Automatically injects script and style exclusions directly into Autoptimize configuration filters.
* **Defense in Depth:** Serves as a critical client-side fallback layer alongside server-side `X-Frame-Options` directives.

## 🛠️ Installation

### 📥 Direct WordPress Install (Recommended)
To prevent your installation from failing due to default branch name folder suffixes, always use the clean tagged release zip asset:

👉 **[Download frontiers-simple-iframe-buster.zip](https://github.com)**

1. Click the link above to download the clean version asset.
2. Navigate to your WordPress Admin Dashboard > **Plugins** > **Add New**.
3. Click **Upload Plugin**, choose the downloaded `v2.0.0.zip` file, and click **Install Now**.
4. Click **Activate**.

### Via Manual Server Extraction (FTP / SSH)
If you are deploying directly via a server terminal pipeline, target the destination folder directory explicitly:

```bash
# Clone the repository directly into the clean plugin slug path
git clone https://github.com frontiers-simple-iframe-buster
```

1. Confirm that the codebase resides precisely within `/wp-content/plugins/frontiers-simple-iframe-buster/`.
2. Navigate to **Plugins** in your WordPress dashboard and click **Activate**.

## 📖 How it Works

The plugin enqueues a non-obtrusive, rendering-optimal JavaScript snippet across your site header. If the page is trapped inside an external `<iframe` or `<frame>` tag, the script breaks out of the sandboxed container:

```javascript
if (top !== self) {
    top.location.replace(self.location.href);
}
```

This guarantees that visitors attempting to view your site through a masked or malicious frame are instantly redirected to the legitimate, un-framed URL.

## ⚙️ Configuration

This plugin is designed to work **out of the box** with zero configuration required. Once activated, the iframe protection applies site-wide.

### Developer Integrations
The plugin automatically handles compatibility hooks for page builders and advanced caching layers:
* **Whitelisted Environments:** Native support for the WordPress Customizer dashboard, standard admin frames, and active live previews for both **Elementor** and **Divi**.
* **Autoptimize Compatibility:** Programmatically filters core optimization scripts to prevent `frontiers-iframe-buster.js` and associated structural inline CSS from being aggregated or broken during optimization passes.

## 🤝 Contributing

Contributions are welcome! If you encounter issues, want to request features, or submit pull requests:
1. Fork the repository.
2. Create a feature branch (`git checkout -b feature/AmazingFeature`).
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`).
4. Push to the branch (`git push origin feature/AmazingFeature`).
5. Open a **Pull Request**.

## 📄 License

Distributed under the GPLv2 License. See `LICENSE` for more information.


=== Frontiers Simple Iframe Buster ===
Contributors: vizkr, Frontiers
Tags: iframe, x-frame-options, security, clickjacking, autoptimize
Requires at least: 5.9
Tested up to: 7.1
Requires PHP: 8.1
Stable tag: 2.0.0
License: GPLv2
License URI: http://gnu.org

Provides a robust method of preventing malicious site framing by delivering optimized client-side protection.

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

== 🚀 Features == 

* **Lightweight Footprint:** Zero impact on site performance or initial page load metrics.
* **Instant Prevention:** Immediately forces the browser window to navigate to the top-level frame if an unauthorized embed attempt is detected.
* **WordPress Native:** Designed specifically to integrate seamlessly with standard WordPress architectures without conflicting with core hooks.
* **Defense in Depth:** Serves as a critical client-side fallback layer alongside server-side `X-Frame-Options` or `Content-Security-Policy` directives.

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
