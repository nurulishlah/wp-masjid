# WP Masjid Theme

A WordPress theme designed for mosques and Islamic organizations, featuring prayer times, infaq reporting, event management, and more.

> **Note:** This is a fork of the original [WP Masjid theme](https://wpmasjid.com) by Ciuss Creative.

## Features

- 🕌 **Prayer Times Widget** - Display daily prayer schedules
- 💰 **Infaq/Donation Reports** - Track and display financial contributions
- 📅 **Event Management** - Friday prayer schedules and announcements
- 🎨 **Multiple Modes** - Masjid and Khalifah layout options
- 📱 **Responsive Design** - Mobile-friendly layouts

## Improvements in This Fork

### Security
- Proper output escaping (`esc_html`, `esc_attr`, `esc_url`, `esc_js`) throughout all widgets
- Fixed potential XSS vulnerabilities in widget outputs

### Accessibility
- Added skip links to all header templates
- ARIA labels on navigation and interactive elements
- Fixed viewport meta tag for better mobile accessibility
- Keyboard navigation support with focus styles

### Performance
- Transient caching for infaq totals calculation (1-hour cache)
- Proper script enqueuing using `wp_add_inline_script()` instead of inline scripts
- Fixed cache-busting to use theme version

### WordPress Standards
- Replaced deprecated `showposts` with `posts_per_page`
- Fixed `wp_reset_query()` to `wp_reset_postdata()`
- Added `wp_body_open()` hook support

## Requirements

- WordPress 5.8 or higher
- PHP 7.4 or higher

## Installation

1. Download the theme zip file
2. Go to **Appearance > Themes** in WordPress admin
3. Click **Add New** > **Upload Theme**
4. Select the zip file and install
5. Activate the theme

## Credits

- Original theme: [WP Masjid](https://wpmasjid.com) by Ciuss Creative
- Fork maintained by: [Nurul Ishlah](https://github.com/nurulishlah)

## License

This theme is licensed under the GPL v2 or later, same as the original WP Masjid theme.
