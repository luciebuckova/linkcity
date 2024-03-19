<div class="AppBreadcrumbs">
    <div class="AppBreadcrumbs-frame @if(isset($frame) || isset($frameSize)) u-frame{{ $frameSize ?? '' }} @endif">
        @if ( function_exists('yoast_breadcrumb') )
            @php( yoast_breadcrumb() )
        @endif
    </div>
</div>