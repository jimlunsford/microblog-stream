# Microblog Stream

Microblog Stream is a lightweight WordPress theme that turns your site into a simple, fast microblog style timeline. Posts are displayed as compact cards in a single column, optimized for reading short updates, reflections, and links that feel more like social updates than traditional blog articles.

This repo contains the source for the Microblog Stream theme.

- **Current version:** 1.0.7  
- **Requires at least:** WordPress 6.0  
- **Tested up to:** WordPress 6.6  
- **Requires PHP:** 7.4+

---

## Features

- Microblog style front page that reads like a social timeline  
- Inline composer on the home page for posting without leaving the stream  
- Optional media attachment on the composer for images, video, audio, and documents  
- Simple “Load more” button that fetches older posts without a full page reload  
- Clean, one column layout that keeps focus on your words  
- Minimal options and no page builder dependencies  
- Basic accessibility features like a skip link and screen reader text helper  
- Translation ready with a text domain of `microblog-stream`

---

## What is new

- New in 1.0.7:
  - Resized `screenshot.png` to reduce file size for WordPress.org theme checks and faster loading
  - No functional code changes from 1.0.6
- New in 1.0.6:
  - Inline composer can attach images, video, audio, and common document types to new posts
  - Simple preview panel for attached media, including thumbnails for images and a Remove button before posting
  - Auto generated admin titles now use a numeric timestamp format with seconds when the title is left blank
  - Plain text URLs in post content are automatically converted into clickable links
- New in 1.0.5:
  - Replies count pill on each post
  - Simple like button for posts, with local storage and an AJAX endpoint
  - Optional Primary menu in the header with a compact hamburger style toggle
  - Dedicated `page.php` template for static pages like About and Contact
  - Back to top helper chip under the Load more section for long timelines

---

## How it works

### Front page timeline

When Microblog Stream is the active theme, your main blog page (usually the front page) becomes a continuous vertical timeline of posts.

Each post is rendered as a compact card that includes:

- Author avatar  
- Auto generated title (if you leave the title blank when publishing)  
- Post content  
- Optional media attachment  
- Meta row with date, time, replies count, and likes

Titleless posts get an automatic title based on date and time, for example:

> `11-29-2025 1:09:15 pm`

This keeps the WordPress admin list usable while letting you write micro posts without thinking about titles.

### Inline composer

At the top of the timeline, logged in users who can publish posts see an inline composer:

- A textarea to write a short update or reflection  
- An optional file input for a single attachment (image, video, audio, or document)  
- A Post button that publishes immediately

Submissions are handled by a dedicated action that:

1. Creates a standard `post` with empty title  
2. Saves the content you wrote in the composer  
3. Processes the optional file upload and saves its attachment ID to post meta for display in the stream

### Media attachments

When you attach a file in the composer:

- Images are displayed as inline media with rounded corners  
- Video and audio files rely on the browser’s default player  
- Common document types (for example PDF) are displayed as a small chip with the file name

This keeps the timeline visually simple while still allowing richer posts when you need them.

### Load more

At the bottom of the timeline, you will see a **Load more** button when there are older posts available. Clicking it will:

- Fetch the next page of posts in the background  
- Insert the new posts above the Load more block  
- Keep the Load more control at the bottom of the stream  
- Update or disable the button when there are no more posts

### Likes and replies

Versions 1.0.5 and later add a small set of social style details:

- A replies pill that shows the number of comments for each post  
- A like button with a local storage flag so each visitor can like a post once in their browser  
- A simple AJAX endpoint that increments a like counter stored in post meta

These features are intentionally minimal and do not try to replace full social platforms. They are there to give a sense of interaction on a personal site.

---

## Templates

The theme ships with a focused set of template files:

- `index.php` for the main timeline and older posts  
- `single.php` for viewing an individual post  
- `page.php` for static pages like About or Contact  
- `archive.php` for category and date archives  
- `comments.php` as a dedicated comments template  
- `content-micro.php` to render each post card in the timeline

There are no sidebar templates or widget areas. The layout is intentionally a single column to keep attention on the posts.

---

## Scripts

All interactivity is handled by a small JavaScript file:

- `microblog.js`

It powers:

- Clickable post cards that link to the single post view  
- The Load more button  
- The like button and its AJAX request  
- The small responsive header navigation toggle

There are no external JavaScript dependencies.

---

## Development

If you want to make changes to the theme locally:

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