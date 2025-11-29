# Microblog Stream

Microblog Stream is a lightweight WordPress theme that turns your site into a simple, fast microblog timeline. Posts are displayed in a clean vertical stream with avatars, timestamps, and subtle cards that feel more like social updates than traditional blog articles.

This repo contains the source for the Microblog Stream theme.

- **Current version:** 1.0.5  
- **Requires at least:** WordPress 6.0  
- **Tested up to:** WordPress 6.6  
- **Requires PHP:** 7.4+

---

## Features

- Microblog style front page that reads like a social timeline
- Compact post cards with:
  - Author avatar
  - Author name
  - "Time ago" style timestamp
  - Post content
- Titleless posting workflow  
  If you leave the title blank, the theme auto generates a title from the post date and time for admin use.
- Inline front page composer for logged in authors
- "Load more" AJAX pagination that keeps you on the same page
- Single post layout that still looks like part of the stream
- Accessible color contrast and keyboard focus styles
- Skip link and screen reader utilities
- Translation ready with a `languages` directory and text domain loaded
- Clean typography using Noto Sans with system font fallbacks
- Responsive layout that works on phones, tablets, and desktops
- No custom post types, blocks, page builders, or bundled plugins
- New in 1.0.5:
  - Replies count pill on each post
  - Simple like button for posts, with local storage and an AJAX endpoint
  - Optional primary menu in the header, revealed with a compact hamburger chip
  - Dedicated `page.php` template for static pages
  - Back to top chip under the Load more section for long timelines

---

## Requirements

- WordPress 6.0 or higher  
- PHP 7.4 or higher

The theme is a classic theme and does not require any plugins to function.

---

## Installation

To install manually from this repository:

1. Download this repository as a ZIP:
   - `Code` → `Download ZIP`
2. Extract the ZIP and rename the folder to `microblog-stream` if needed.
3. Upload the folder to your WordPress install:
   - `wp-content/themes/microblog-stream`
4. In your WordPress admin:
   - Go to **Appearance → Themes**
   - Activate **Microblog Stream**

---

## Usage

### Front page timeline

After activation, your front page will show a continuous timeline of your latest posts. Each post appears as a compact card with avatar, author, timestamp, and content.

If you want the timeline on a different page, you can set **Settings → Reading** and choose whether the front page shows your latest posts or a static page.

### Inline composer

On the main posts page, logged in users who can publish posts will see an inline composer:

- Type your update into the textarea
- Click **Post**
- The theme sends the content through a simple handler that publishes a new standard post

If you leave the title blank, the theme will auto generate a title based on date and time. This keeps the editor clean while still giving the post a unique title for the admin area.

### Load more

At the bottom of the timeline, you will see a **Load more** button when there are older posts available. Clicking it will:

- Fetch the next page of posts in the background
- Insert the new posts above the Load more block
- Keep the Load more control at the bottom of the stream
- Update or disable the button when there are no more posts

### Likes and replies

Version 1.0.5 adds a small set of social style details:

- A replies pill that shows the current comment count for each post
- A like pill that:
  - Updates the count in place when clicked
  - Marks the button as liked and stores that state in `localStorage` on a per post basis
  - Sends a lightweight AJAX request so counts stay in sync for visitors

If you do not want likes, you can remove the like markup from the template. The JavaScript is defensive and will silently do nothing if there are no like buttons in the markup.

---

## Accessibility and internationalization

Microblog Stream includes:

- A skip link that lets keyboard and screen reader users jump straight to the main content  
- Underlined links inside post content and comments so links are clearly visible  
- Visible focus states for links and interactive elements  
- A dedicated `comments.php` template to avoid the deprecated core fallback

All front facing text strings in PHP and JavaScript use the `microblog-stream` text domain so they can be translated. A `languages` directory is included for translation files.

---

## Development

To work on the theme locally:

1. Clone this repository into your themes directory:

   ```bash
   cd wp-content/themes
   git clone https://github.com/jimlunsford/microblog-stream.git
2. Activate the theme in your local WordPress install.
3. Make your changes to the PHP, CSS, or JavaScript files.
4. Use standard WordPress coding practices and keep the layout focused on speed and simplicity.

---

## License

Microblog Stream is released under the GNU General Public License v2 or later. See LICENSE.txt for full details.