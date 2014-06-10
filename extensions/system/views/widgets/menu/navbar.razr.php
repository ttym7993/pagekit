@if (root.depth == 0)
<ul class="uk-navbar-nav@(options.classes ? ' '~options.classes : '')">
@endif

@foreach (root.children as item)

    @set (header = item.url == '!header', divider = item.url == '!divider')

    <li class="@((item.attribute('parent') ? ' uk-parent')~(item.attribute('active') ? ' uk-active')~(header ? ' uk-nav-header')~(divider ? ' uk-nav-divider')|trim)" @(root.depth == 0 && item.hasChildren ? ' data-uk-dropdown')>

        @if (header)
        @item
        @elseif (!divider)
        <a href="@url.route(item.url)">@item</a>
        @endif

        @if (item.hasChildren && (item.attribute('active') || widget.get('mode', 'all') == 'all' || !root.depth == 0))
            <div class="uk-dropdown uk-dropdown-navbar">
                <ul class="uk-nav uk-nav-navbar">
                    @include('view://system/widgets/menu/nav.razr.php', ['root' => item])
                </ul>
            </div>
        @endif
    </li>

@endforeach

@if (root.depth == 0)
</ul>
@endif