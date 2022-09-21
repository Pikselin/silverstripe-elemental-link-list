<?php

namespace Pikselin\LinkList\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\View\Requirements;

/**
 * Adds css requirement directive
 */
class LinkListControllerExtension extends Extension
{
    public function onAfterInit() {
        Requirements::css('pikselin/silverstripe-elemental-link-list:client/css/link-list.css');
    }
}
