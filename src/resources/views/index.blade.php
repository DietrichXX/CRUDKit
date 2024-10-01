{{--@extends('layouts.admin')--}}

@section('content')
{{--    @include('partials.page-title', [--}}
{{--        'pageTitle' => __('models'),--}}
{{--        'btnText' => __('add'),--}}
{{--        'icon' => 'arrow-right',--}}
{{--        'route' => route('models.create')   заменить на настощий роут--}}
{{--    ])--}}

    <div class="d-flex flex-column gap-3">
        <div class="card">
            <div class="card-body">
                <div class="filter-section">
                    {{ Form::open(['method' => 'GET']) }}
                    <div class="row">

                        <div class="col-12 col-md-6 col-lg-4 mb-3 d-flex flex-wrap align-items-end">
                            <button class="btn btn-success me-2 mb-2 mb-md-0" type="submit">@lang('filter')</button>
                            <a href="{{ //route('model.index') }}" class="btn btn-type mb-2 mb-md-0" type="button">
                                @lang('reset')
                            </a>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive table-height mb-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
{{--        <div class="pagination">--}}
{{--            {{ $model->links() }}--}}
{{--        </div>--}}
    </div>
@endsection
