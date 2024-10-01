<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row gy-3 mb-4">
                <div class="col-lg-6">
                    <div class="d-flex flex-column gap-3">
                        <div>
{{--                            <label class="form-label fw-bold">@lang('name')</label>--}}
{{--                            {{ Form::text('name', isset($model) ? $model->name : null,--}}
{{--                                ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'placeholder' => __('Enter_name')]) }}--}}
{{--                            @if ($errors->has('name'))--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{ $errors->first('name') }}--}}
{{--                                </div>--}}
{{--                            @endif--}}
                        </div>
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-success me-2">@lang('save')</button>
        </div>
    </div>
</div>

