@extends('layouts.app')

@section('content')
    <div class="u-frame">
        <h1>404</h1>
        <p>
            {{ __('Něco se pokazilo. Tato stránka neexistuje.', 'ttm') }}<br>
            {{ __('Zkuste to prosím znovu.', 'ttm') }}
        </p>
        <x-button href="{{ home_url('/') }}">{{ __('Zpět na hlavní stranu', 'ttm') }}</x-button>
    </div>
@endsection