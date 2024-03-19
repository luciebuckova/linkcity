<div class="PageContent-wrapper PageContent-wrapper--narrow">
    <div class="PageContent @if(!isset($size)) u-frame @else u-frame--{{ $size }} @endif">
        @php( the_content() )
        @yield('content-after')
    </div>
</div>