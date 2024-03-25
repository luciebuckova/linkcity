<!-- Header Section -->
<header class="Header" v-bind:class="{ 'is-opened': opened }" v-effect="handleOpenedHeader(opened)" data-header>
    <div class="HeaderInner u-frame u-flex u-flexJustifyBetween u-flexAlignItemsCenter">
        <a class="HeaderLogo" href="{{ home_url('/') }}">
            <img src="@asset('logo.svg')" height="40" alt="{!! $siteName !!}">
        </a>
        <div class="HeaderButtons u-flex u-flexAlignItemsCenter">
            <button class="HeaderBurger" type="button" aria-label="{{ __('MENU', 'ttm') }}"
                    @click.prevent="opened = !opened" v-bind:class="{ 'is-opened': opened }">
                <span class="HeaderBurger-top"></span>
                <span class="HeaderBurger-middle"></span>
                <span class="HeaderBurger-bottom"></span>
                <span class="HeaderBurger-label">{{ __('MENU', 'ttm') }}</span>
            </button>
            <span>CZE</span>            
        </div>
    </div>
</header>
