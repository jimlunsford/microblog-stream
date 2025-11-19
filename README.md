# Microblog Stream

Microblog Stream is a lightweight WordPress theme that turns your site into a fast, scrollable microblog timeline. Posts are presented as short updates, with emphasis on content, author, and time, instead of big headlines and heavy layouts.

The theme is built for posting quick thoughts, short reflections, and real time updates without worrying about titles or complex formatting.

> Status: Early release. Expect small changes as the theme evolves.

---

## Features

- Microblog style front page that reads like a social timeline  
- Titleless posting workflow, admin titles are auto generated from date and time  
- X / Twitter inspired layout with avatar, author, and timestamp above each post  
- Single post view that still feels like part of the stream  
- Simple archive pages that reuse the same micro post layout  
- Tag support for light organization and discovery  

### Inline composer

- Inline composer box on the front page for logged in authors  
- Quick post form sends content through `admin-post.php`  
- Uses standard WordPress post type, no custom tables or CPTs  
- Respects capabilities (only users who can publish posts will see it)  

### Load more pagination

- "Load more" style pagination for the main stream  
- Older posts are loaded via the default WordPress pagination system  
- JavaScript enhances the experience by loading additional posts without a full page reload  
- Fallback pagination still works when JavaScript is disabled  

### Design

- Clean, focused layout that keeps attention on the content  
- Responsive timeline that works on mobile, tablet, and desktop  
- Uses system fonts for performance and a native feel  
- Avatar, author, and timestamp at the top of each micro post  
- Simple tag styling for optional discovery  
- Small visual details like subtle borders, spacing, and hover states  

### Philosophy

Microblog Stream is intentionally simple:

- Microblog focused  
- No heavy frameworks  
- Minimal options  
- Simple to install and use  

If you want a bigger site with landing pages, complex navigation, and multiple layouts, you can pair this theme with a separate main site or use it on a subdomain for your personal stream.

---

## Requirements

- WordPress 6.0 or higher  
- PHP 7.4 or higher  
- A modern browser for the best experience  

---

## Installation

1. Download the theme files or clone the repository.  
2. Upload the `microblog-stream` folder to `wp-content/themes/`.  
3. In your WordPress dashboard, go to **Appearance → Themes**.  
4. Activate **Microblog Stream**.  
5. (Optional) Set your homepage to show your latest posts under **Settings → Reading**.  

Once activated, your front page will show posts in the microblog stream layout.

---

## Posting

You can post to the stream in two ways:

1. **Standard WordPress post editor**  
   - Go to **Posts → Add New**.  
   - Leave the title blank if you want to use the automatic date and time title.  
   - Write your update in the content editor.  
   - Publish as normal.  

2. **Inline composer (front page)**  
   - Log in to WordPress as a user who can publish posts.  
   - Visit the front page.  
   - Use the inline composer box at the top of the stream.  
   - Type your update and click **Post**.  
   - The theme handles the quick post and redirects you back to the stream.  

Inline composer is only shown on the main blog page for logged in users with permission to publish posts. It is not shown on archive views or for visitors who are not logged in.

---

## Customization

Microblog Stream is intentionally minimal. It does not add options pages or heavy Customizer panels.

To customize the look and feel:

- Use **Appearance → Editor** (or **Appearance → Customize** on classic setups) for basic site settings like site title and tagline.  
- Add custom CSS with the built in Customizer, or by creating a child theme if you want deeper control.  
- Adjust colors, spacing, and fonts by overriding the theme CSS in a child theme or using additional CSS.  

The theme uses semantic class names and a simple structure so you can target elements easily with your own styles.

---

## Development

Microblog Stream is a standard WordPress theme that follows common theme development practices.

- Uses `wp_head()`, `wp_footer()`, and `wp_body_open()` for compatibility  
- Enqueues scripts and styles the WordPress way  
- Uses template parts for the micro post layout  
- Sanitizes and escapes output where appropriate  

If you want to extend the theme, recommended approaches include:

- Creating a child theme for visual changes  
- Hooking into WordPress actions and filters for behavior changes  
- Extending templates via `get_template_part()` and custom partials  

Pull requests and suggestions are welcome in the GitHub repository.

---

## Changelog

### 1.0.2

- Internationalization improvements for front facing strings  
- Security hardening for the quick post handler  
- Added `wp_body_open()` support and a small footer safety tweak  

### 1.0.1

- Added inline composer for logged in authors on the front page  
- Added "Load more" AJAX pagination for the stream  
- Simplified default footer credit to "Created by Jim Lunsford."  
- Minor visual tweaks to header and post layout  

### 1.0.0

- Initial release  

---

## License

Microblog Stream is released under the GNU General Public License v2 or later.

You are free to use, modify, and share this theme, as long as any derivative work is also released under the GPL.
