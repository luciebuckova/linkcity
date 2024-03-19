<section class="PageHeader @isset($style) PageHeader--{{ $style }} @endisset @isset($overlaps) PageHeader--overlaps @endisset">
    <div class="PageHeader-frame @if(!isset($size)) u-frame @else u-frame--{{ $size }} @endif">
        <div class="PageHeader-inner">
            @include('partials.breadcrumbs')
            <h1 class="PageHeader-title">{!! $title !!}</h1>
            @isset($content) <div class="PageHeader-content">{!! $content !!}</div> @endisset
            @yield('PageHeader-content')
        </div>
    </div>
</section>