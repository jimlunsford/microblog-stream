=== Microblog Stream ===
Contributors: jimlunsford
Requires at least: 6.0
Tested up to: 6.6
Requires PHP: 7.4
Stable tag: 1.0.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, one-column, front-page-post-form, translation-ready

Microblog Stream is a lightweight WordPress theme that turns your site into a simple, fast microblog timeline. Posts are displayed in a clean vertical stream with avatars, timestamps, and subtle cards that look and feel like social updates, not traditional blog articles.

== Description ==

Microblog Stream is built for posting quick thoughts, short reflections, and real time updates without worrying about elaborate layouts or long form content. It keeps the WordPress post model, but trims the visual noise so your words stay front and center.

The front page is a continuous timeline of posts styled as compact cards. Each entry shows the author avatar, author name, published time (in a “time ago” format), and the post content. Single post views still feel like part of the stream instead of switching to a very different layout.

The theme is intentionally minimal in options. It does not introduce custom post types, page builders, or complex settings pages. You install it, activate it, and start posting.

Key features:

* Microblog style front page that reads like a social timeline
* Titleless posting workflow, with admin titles automatically generated from date and time
* X / Twitter inspired layout with avatar, author, and timestamp above each post
* Single post view that keeps the same card based stream look
* Accessible color contrast and keyboard focus styles
* Skip link and screen reader utilities
* Clean typography using Noto Sans (with system font fallbacks)
* Responsive layout that works on phones, tablets, and desktops
* No custom post types, blocks, page builders, or bundled plugins

The goal is to provide a focused writing experience for people who want to post small, frequent updates on their own domain instead of relying only on social platforms.

== Installation ==

1. Download the theme ZIP file.
2. In your WordPress admin, go to Appearance → Themes → Add New.
3. Click “Upload Theme,” choose the ZIP file, and click “Install Now.”
4. When the upload finishes, click “Activate.”
5. Visit your site front page and start publishing posts. They will appear in the microblog style timeline automatically.

For development from source:

1. Clone or download the repository from GitHub.
2. Place the `microblog-stream` folder into `wp-content/themes/`.
3. In WordPress admin, activate **Microblog Stream** under Appearance → Themes.

== Frequently Asked Questions ==

= Does this theme require any plugins? =

No. Microblog Stream is a classic theme that works with a standard WordPress install. It does not require any third party plugins.

= Can I use normal blog posts with titles? =

Yes. The theme does not prevent you from adding titles. The auto generated titles exist mainly to keep the editor clean for short posts. If you enter a title, WordPress will use it like any other theme.

= Does it support the block editor (Gutenberg)? =

Yes. Posts are created with the normal WordPress editor. On the front end, Microblog Stream focuses on the output and layout instead of adding custom editing interfaces.

= Can I customize the footer credit? =

By default the footer shows a small credit line. If you are using the theme for your own site only, you may edit `footer.php` to change or remove the credit, as long as you follow the GPL license.

== Screenshots ==

1. The Microblog Stream front page showing the header card and timeline of posts.

== Changelog ==

= 1.0.4 =

* Added theme tags to the stylesheet header for the WordPress.org theme directory
* Added a `languages` directory and marked the theme as translation ready
* Synced documentation and metadata for the 1.0.4 release

= 1.0.3 =

* Added a dedicated `comments.php` template to replace the deprecated core fallback
* Added skip link and screen reader utility classes for basic accessibility support
* Underlined links in post content and comments and improved keyboard focus states
* Localized JavaScript strings for the “Load more” button
* Localized the “time ago” timestamp string
* Updated theme headers for WordPress.org theme requirements

= 1.0.2 =

* Improved internationalization for front facing strings
* Hardened the quick post handler security
* Added `wp_body_open()` support for better compatibility with plugins and accessibility tools
* Small footer safety tweak

= 1.0.1 =

* Added inline composer for logged in authors on the front page
* Added “Load more” AJAX pagination for the stream
* Simplified default footer credit to “Created by Jim Lunsford.”
* Minor visual tweaks to header and post layout

= 1.0.0 =

* Initial release of Microblog Stream
* Microblog style timeline layout for posts
* Automatic title generation for titleless posts
* Basic single post template matching the stream look

== Upgrade Notice ==

= 1.0.4 =

This release adds official theme tags and a languages directory so the theme is ready for the WordPress.org theme directory. There are no breaking changes.

== Resources ==

Microblog Stream uses the following external resources:

* Noto Sans (Google Fonts)  
  Copyright 2012–2024 Google LLC  
  Licensed under the SIL Open Font License, Version 1.1  
  https://fonts.google.com/specimen/Noto+Sans

All other code in this theme is released under the GNU General Public License v2 or later.