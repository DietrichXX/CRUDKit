{{--@extends('layouts.admin')--}}

@section('content')
{{--    @include('partials.page-title', [--}}
{{--         'pageTitle' => __('models'),--}}
{{--         'btnText' =>  __('back'),--}}
{{--         'icon' => 'arrow-left',--}}
{{--         'route' => route('models.index') заменить на настощий роут--}}
{{--     ])--}}

{{--    {{ Form::open(['route' => ['models.store']]) }}--}}
    @include('form') {{-- указать правильный путь к файлу form --}}
{{--    {{ Form::close() }}--}}
@endsection
