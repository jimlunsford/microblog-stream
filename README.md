# Microblog Stream

Microblog Stream is a lightweight WordPress theme that turns your site into a fast, scrollable microblog stream. Posts look and feel like social updates, not traditional blog articles.

The theme is built for posting quick thoughts, short reflections, and real time updates without worrying about titles or heavy layouts.

> Status: Early release. Expect small changes as the theme evolves.

---

## Features

- Microblog style front page that reads like a social timeline  
- Titleless posting workflow, admin titles are auto generated from date and time  
- X / Twitter inspired layout with avatar, author, and timestamp above each post  
- Single post view that still feels like part of the stream  
- Clickable cards on home and archive views  
- Simple tag styling for optional hashtags  
- Focus on content and replies rather than widgets and sidebars  
- Clean dark theme with an orange accent, easy to customize with CSS variables  

---

## Requirements

- WordPress 6.0 or higher  
- PHP 7.4 or higher  

The theme should work with a standard WordPress install with pretty permalinks enabled.

---

## Installation

### From source

1. Clone or download this repository.
2. Copy the `microblog-stream` folder into `wp-content/themes/` on your WordPress site.
3. In the WordPress admin, go to **Appearance → Themes**.
4. Activate **Microblog Stream**.

### From a zip

1. Download a release zip from the GitHub Releases page (when available).
2. In the WordPress admin, go to **Appearance → Themes → Add New → Upload Theme**.
3. Upload the zip, install, and activate.

---

## How posting works

Microblog Stream is designed to feel like a social stream.

- Create a new **Post** like normal.
- Type your update in the main content editor.
- Leave the title field empty.
- When you publish, the theme auto generates an internal title from the post date and time.  
  - Example in the admin list: `Nov 15, 2025 3:27 pm`.

On the front end:

- The content is treated as the post.
- Above the content you see `Author · Date Time`.
- Tags (optional) appear as small hashtag chips at the bottom of the card.
- Clicking the card opens the single post view where people can reply through comments.

---

## Layout overview

- **Front page**  
  The home page shows a reverse chronological stream of posts using the microblog card layout. Each card is clickable and acts like an entry in a social feed.

- **Single post**  
  The single post template uses the same card style so it feels like a focused version of the stream, not a separate blog layout. Comments appear under the card as replies.

- **Archives**  
  Category, tag, and date archives reuse the same stream layout.

There are no sidebars by default. The focus stays on the stream.

---

## Customization

Most of the theme styling is controlled by CSS variables in `style.css`:

```css
:root {
  --bg-body: #05070a;
  --bg-card: #101827;
  --accent: #f97316;
  --text-main: #e5e7eb;
  --text-muted: #9ca3af;
  --radius-lg: 14px;
  --gap-lg: 1.75rem;
  --font-sans: "Noto Sans", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}
