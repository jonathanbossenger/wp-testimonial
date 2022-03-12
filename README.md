# Adding block support

## Build setup

### Initialise package.json

`npm init`

<pre>
jonathan@jonathan-Desktop:~/development/websites/wordpress/wp-content/plugins/wp-testimonial$ npm init
This utility will walk you through creating a package.json file.
It only covers the most common items, and tries to guess sensible defaults.

See `npm help init` for definitive documentation on these fields
and exactly what they do.

Use `npm install <pkg>` afterwards to install a package and
save it as a dependency in the package.json file.

Press ^C at any time to quit.
package name: (wp-testimonial)
version: (1.0.0)
description: WordPress Testimonial
entry point: (index.js)
test command:
git repository: (https://github.com/jonathanbossenger/wp-testimonial.git)
keywords:
author: Jonathan Bossenger
license: (ISC) GPL-2.0-only
About to write to /home/jonathan/development/websites/wordpress/wp-content/plugins/wp-testimonial/package.json:

{
"name": "wp-testimonial",
"version": "1.0.0",
"description": "WordPress Testimonial ",
"main": "index.js",
"scripts": {
"test": "echo \"Error: no test specified\" && exit 1"
},
"repository": {
"type": "git",
"url": "git+https://github.com/jonathanbossenger/wp-testimonial.git"
},
"author": "Jonathan Bossenger",
"license": "GPL-2.0-only",
"bugs": {
"url": "https://github.com/jonathanbossenger/wp-testimonial/issues"
},
"homepage": "https://github.com/jonathanbossenger/wp-testimonial#readme"
}


Is this OK? (yes) y
</pre>

### Install @wordpress/scripts

https://developer.wordpress.org/block-editor/reference-guides/packages/packages-scripts/

`npm install @wordpress/scripts --save-dev`

### Copy the scripts' section either from the bootstrapped code or the help doc

~~~json
"scripts": {
	"build": "wp-scripts build",
	"check-engines": "wp-scripts check-engines",
	"check-licenses": "wp-scripts check-licenses",
	"format": "wp-scripts format",
	"lint:css": "wp-scripts lint-style",
	"lint:js": "wp-scripts lint-js",
	"lint:md:docs": "wp-scripts lint-md-docs",
	"lint:md:js": "wp-scripts lint-md-js",
	"lint:pkg-json": "wp-scripts lint-pkg-json",
	"packages-update": "wp-scripts packages-update",
	"plugin-zip": "wp-scripts plugin-zip",
	"start": "wp-scripts start",
	"test:e2e": "wp-scripts test-e2e",
	"test:unit": "wp-scripts test-unit-js"
}
~~~

### Update the main attribute in the package.json

"main": "build/index.js",

## Plugin setup

### Set up the block registration

~~~php
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function wpt_testimonial_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'wpt_testimonial_block_init' );
~~~

### Create (or copy) the src directory

/src
/src/block.json
/src/edit.js
/src/editor.scss
/src/index.js
/src/save/js
/src/style.scss

### Create (or edit) the block.json file

~~~json
{
	"$schema": "https://schemas.wp.org/trunk/block.json",
	"apiVersion": 2,
	"name": "jonathan-bossenger/wp-testimonial",
	"version": "1.0.0",
	"title": "WP Testimonial",
	"category": "widgets",
	"icon": "status",
	"description": "Render a testimonial anywhere on your site.",
	"supports": {
		"html": false
	},
	"textdomain": "wp-testimonial",
	"editorScript": "file:./index.js",
	"editorStyle": "file:./index.css",
	"style": "file:./style-index.css"
}
~~~

### Create (or edit) the rest of the block related files

index.js - ensure that the registerBlockType function uses the same name as the block.json file
edit.js - wrapper div, className instead of class
edit.scss - wp-block-jonathan-bossenger-wp-testimonial class, based on name
save.js - useBlockProps.save()
save.scss

### Add the attributes

https://developer.wordpress.org/block-editor/reference-guides/block-api/block-attributes/

~~~json
  "attributes": {
    "client": {
      "type": "string",
      "default": "Client Name"
    },
    "testimonial": {
      "type": "string",
      "default": "Client Testimonial"
    }
  },
~~~

### Pass the attributes to the edit and save functions

### Add the Inspector Controls to control the attributes

https://github.com/WordPress/gutenberg/blob/HEAD/packages/block-editor/src/components/inspector-controls/README.md

https://developer.wordpress.org/block-editor/how-to-guides/block-tutorial/block-controls-toolbar-and-sidebar/

https://developer.wordpress.org/block-editor/reference-guides/components/panel/

npm install @wordpress/icons --save

