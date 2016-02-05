# SEO plugin for Craft

This plugin allows you to create a Group Field for General SEO Fields.


## Installation

To install emSEO, follow these steps:

1.  Upload the emseo/ folder to your craft/plugins/ folder.
2.  Go to Settings > Plugins from your Craft control panel and enable the emSEO plugin.
3.  Click on “emSEO” to go to the plugin’s settings page, and configure the plugin how you’d like.

## Usage

Your contact form template can look something like this:

```jinja
{{ craft.emseo.seo | raw }}
```
### 1.0.1

* fixed bug with seo description missing aded better descriptions

### 1.0.0

* Initial release
