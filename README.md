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

---

## You can fork the theme and:

- Change the accent color

- Adjust background colors for the body and cards

- Swap the font stack

- Tweak spacing and border radius

The clickable card behavior lives in microblog.js. It:

- Makes .micro-post cards clickable on home, blog, and archive views.

- Uses a data-permalink attribute on each card.

- Ignores clicks on links and form controls inside the card so those still behave normally.

---

## Footer credits

By default, the footer contains a credit line that mentions:

- Microblog Stream theme by Jim Lunsford

- Help from ChatGPT

- Powered by Phoenix 2:33 LLC

If you fork this theme for your own use, you can edit footer.php to change or remove the credits.

---

## Screenshots

The theme includes a screenshot.png that shows:

- The header card with site title, tagline, and live microblog status

- A vertical stack of micro posts rendered as cards

You can replace screenshot.png with your own preview, as long as it is named screenshot.png and placed in the theme root.

---

## Roadmap

Planned ideas:

- Optional “Load more” style pagination for a continuous stream feel

- Customizer or theme JSON options for color presets

- More refined comment styling for long conversations

- Light mode option

Suggestions and pull requests are welcome.

---

## Contributing

If you want to:

- Report a bug

- Suggest a feature

- Improve the design or code

Feel free to open an issue or submit a pull request on GitHub.

Please keep changes consistent with the theme goals:

- Lightweight

- Microblog focused

- No heavy frameworks

- Simple to install and use

---

## License

Microblog Stream is released under the GNU General Public License v2 or later.

You are free to use, modify, and share this theme, as long as any derivative work is also released under the GPL.
