# Pikselin Link List elemental

An elemental block with a list of links.

Features:
- can add different types of links: internal, external, internal file, email and phone number
- links are easily sortable via the admin interface
- includes CSS that can be easily overridden
- includes an extension for the controller that does the requirements call for the CSS.

NOTE: Does not include external link icons as it should just use the site's mechanism for external links.

## Installation
This module only works with SilverStripe 4.x.

`composer require pikselin/silverstripe-elemental-link-list`

Run `dev/build` afterwards.

## Requirements
These can be found in the composer.json file.

## Templates
You can override the default template by copying `templates/Pikselin/LinkList/Elements/LinkList.ss` to your own theme.

## CSS
Base styles can be found in:
`client/css/link-list.css`

## Notes
This module already activates the CSS files in the PageController via the `LinkListControllerExtension.php` extension.
