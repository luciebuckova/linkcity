<header class="Header" v-bind:class="{ 'is-opened': opened }" v-effect="handleOpenedHeader(opened)" data-header>
    <div class="HeaderInner u-frame">
        <a class="HeaderLogo" href="{{ home_url('/') }}">
            <img src="@asset('logo.svg')" width="152" height="48" alt="{!! $siteName !!}">
        </a>

        @if (has_nav_menu('primary'))
            <nav class="HeaderNavigation" aria-label="{{ wp_get_nav_menu_name('primary') }}">
                {!! wp_nav_menu(['theme_location' => 'primary', 'menu_class' => 'Navigation', 'echo' => false]) !!}
            </nav>

            <button class="HeaderBurger" type="button" aria-label="{{ __('MENU', 'ttm') }}"
                    @click.prevent="opened = !opened" v-bind:class="{ 'is-opened': opened }">
                <span class="HeaderBurger-inner"></span>
                <span class="HeaderBurger-label">{{ __('MENU', 'ttm') }}</span>
            </button>
        @endif
    </div>
</header>
