<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="<?= config('theme.theme_color') ?>">
        @include('utils.preload')
        <?php wp_head(); ?>
        @include('utils.styles')
    </head>

    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <?php do_action('get_header'); ?>

        <a class="u-hiddenVisually" href="#main">{{ __('Přeskočit na obsah', 'ttm') }}</a>

        @include('sections.header')

        <main id="main" {{ $mainAttrs ?? '' }}>
            @yield('content')
        </main>

        @include('sections.footer')

        <?php do_action('get_footer'); ?>
        <?php wp_footer(); ?>
        @include('utils.scripts')
        @include('utils.icons')
    </body>
</html>
