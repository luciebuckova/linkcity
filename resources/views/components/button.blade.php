@php
    $element = $attributes->get('element', 'a');
    if ($element === 'a' && !$attributes->has('href')) {
        $element = 'button';
    }

    $defaultClasses = 'Button';

    $types = [
        'primary' => 'Button--primary',
        'alternative' => 'Button--alternative',
        'outline' => 'Button--outline',
    ];
@endphp

<{{ $element }} @foreach ($attributes->except(['class', 'variant', 'element']) as $key => $value) {{ $key }}="{{ $value }}" @endforeach
    class="{{ $defaultClasses }} {{ $types[$attributes->get('variant', 'primary')] }} Button--{{ $attributes->get('size') ?? 'regular' }} {{ $attributes->get('class') }}">
        {{ $slot }}
</{{ $element }}>
