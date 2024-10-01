{{--@extends('layouts.admin')--}}

@section('content')
{{--    @include('partials.page-title', [--}}
{{--         'pageTitle' => __('models'),--}}
{{--         'btnText' =>  __('back'),--}}
{{--         'icon' => 'arrow-left',--}}
{{--         'route' => route('models.index') заменить на настощий роут--}}
{{--     ])--}}

{{--    {{ Form::model($models, ['route' => ['models.update', $models], 'method' => 'put']) }}--}}
    @include('form') {{-- указать правильный путь к файлу form --}}
{{--    {{ Form::close() }}--}}
@endsection
