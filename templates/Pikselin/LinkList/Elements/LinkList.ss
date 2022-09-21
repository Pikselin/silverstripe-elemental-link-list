<% if $Title && $ShowTitle %><h2 class="element__title">$Title</h2><% end_if %>

<% loop LinkList %>
    <% if LinkURL %>
        <a class="hyperlink" href="{$LinkURL}"{$TargetAttr}{$ClassAttr}>
            <svg class="icon svg-icon svg-icon-arrow-forward">
                <use xlink:href="$resourceURL('pikselin/silverstripe-elemental-link-list:client/images/sprite.icons.svg')#arrow-forward"></use>
            </svg>
            <span>{$Title}</span>
        </a>
    <% end_if %>
<% end_loop %>
