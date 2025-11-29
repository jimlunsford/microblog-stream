=== Microblog Stream ===
Contributors: jimlunsford
Requires at least: 6.0
Tested up to: 6.6
Requires PHP: 7.4
Stable tag: 1.0.7
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
* Inline composer for logged in authors on the main posts page
* "Load more" style pagination that pulls older posts into the same stream
* Accessible color contrast and keyboard focus styles
* Skip link and screen reader utilities
* Clean typography using Noto Sans (with system font fallbacks)
* Responsive layout that works on phones, tablets, and desktops
* No custom post types, blocks, page builders, or bundled plugins
* New in 1.0.7:
  * Resized `screenshot.png` to reduce file size for WordPress.org theme checks and faster loading
  * No functional code changes from 1.0.6
* New in 1.0.6:
  * Inline composer can attach images, video, audio, and common document types to new posts
  * Simple media preview with thumbnail support for images and a Remove button before posting
  * Auto generated admin titles now use a numeric date and time format that includes seconds
  * Plain text URLs in post content are automatically converted to clickable links
* New in 1.0.5:
  * Replies count pill on each post card
  * Simple like button with local storage and a small AJAX handler
  * Optional Primary menu with a compact hamburger toggle in the header
  * Dedicated `page.php` for static pages like About and Contact
  * Back to top chip under the Load more section for long timelines

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

= How do likes work in 1.0.5 and later? =

Each post can display a small like pill. When clicked, the count updates immediately and the liked state is stored in the browser using `localStorage` so a visitor cannot repeatedly increment their own count. A small AJAX call updates the stored count on the server.

If you do not want likes at all, you can remove the like pill markup from the template. The JavaScript will then have nothing to attach to.

== Screenshots ==

1. The Microblog Stream front page showing the header card and timeline of posts.

== Changelog ==

= 1.0.7 =

* Resized `screenshot.png` to a smaller file size for faster loading and to satisfy WordPress.org theme checks
* No functional code changes from 1.0.6

= 1.0.6 =

* Added optional media upload support in the inline composer for images, video, audio, and common document types
* Added a small media preview area under the composer with thumbnails for images and a Remove control before publishing
* Updated auto generated titles for titleless posts to use a numeric date and time format that includes seconds
* Updated content handling so plain text URLs in post content are automatically converted into clickable links
* Removed the helper hint text under the composer to keep the posting area cleaner

= 1.0.5 =

* Added replies count pill for each post card
* Added like button support with optimistic UI, local storage, and an AJAX handler
* Added `page.php` template for static pages like About and Contact
* Added optional Primary menu with a hamburger style toggle in the header
* Updated Load more logic so new posts are inserted above the button, keeping the control at the bottom of the stream
* Added Back to top chip under the Load more section
* Minor accessibility and visual polish

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

= 1.0.7 =

This release only resizes `screenshot.png` to reduce file size for theme previews and WordPress.org theme checks. There are no functional changes compared to 1.0.6. You can safely upgrade without impacting your content or layout.

= 1.0.6 =

This release adds media uploads to the inline composer, a simple attachment preview, and automatic link detection in post content. There are no breaking changes. Update and test on a staging site if you have customized templates.

= 1.0.5 =

This release adds likes, replies pills, optional navigation, and small layout improvements. There are no breaking changes. Update and test on a staging site if you have customized templates.

= 1.0.4 =

This release adds official theme tags and a languages directory so the theme is ready for the WordPress.org theme directory. There are no breaking changes.

== Resources ==

Microblog Stream uses the following external resources:

* Noto Sans (Google Fonts)  
  Copyright 2012–2024 Google LLC  
  Licensed under the SIL Open Font License, Version 1.1  
  https://fonts.google.com/specimen/Noto+Sans

All other code in this theme is released under the GNU General Public License v2 or later.