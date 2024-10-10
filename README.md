# Mill

WordPress Theme

=== Mill ===

- Contributors: tadashi1105
- Donate link: <https://ko-fi.com/tadashi1105>
- Tags: white, custom-background, custom-header
- Requires at least: 4.1
- Tested up to: 4.2.2
- Stable tag: 1.0.0
- License: GNU General Public License v2.0
- License URI: <http://www.gnu.org/licenses/gpl-2.0.html>

== Description ==

WordPress Theme

== Installation ==

= Installation using "Add New Theme" =

1. From your Admin UI (Dashboard), go to Appearance => Themes. Click the "Add New" button.
2. Search for theme, or click the "Upload" button, and then select the theme you want to install.
3. Click the "Install Now" button.

= Manual installation =

1. Upload the "Mill" folder to the "/wp-content/themes/" directory.

= Activiation and Use =

1. Activate the Theme through the "Themes" menu in WordPress.

== The following third-party resources ==

- Bootstrap

  - License: MIT
  - Source : <http://getbootstrap.com/>

- Font Awesome

  - License: MIT
  - Source : <https://fortawesome.github.io/Font-Awesome/>

== Theme features ==

= page templates =

- Full Width

= Widget areas =

- Sidebar
- Main bottom
- Footer

= Navigation =

- Main navigation ( in header )
- drawer navigation ( in header )

= Using child theme =

This is a example of customizing functions.php in child theme.

```php
// in functions.php
function mill_child_theme_setup() {

  class Mill extends Mill_Base_Configuration {

    // Override constructer
    public function **construct() {
      parent::**construct();

      // Add filter
      add_filter( 'foo', array( $this, 'your_filter' ) );
    }

    // load style.css of mill
    // If you use bottstrap of mill, this method is unnecessary.
    public function wp_enqueue_scripts() {
      wp_enqueue_style(
        get_template(),
        get_template_directory_uri() . '/style.min.css',
        null
      );

      parent::wp_enqueue_scripts();
    }

    public function your_filter( $bar ) {
      return $bar;
    }

    // Override parent method
    public function parent_method() {
      // Your code!
    }
  }
}
add_action( 'after_setup_theme', 'mill_child_theme_setup' );

// It is all right outside the class!
function your_filter( $bar ) {
  return $bar;
}
add_filter( 'foo', 'your_filter' );
```

== Changelog ==

= 1.0.0 =

- Initial Release
