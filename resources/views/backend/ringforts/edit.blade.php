@extends('backend.layouts.app')

@section('title', __('labels.backend.ringforts.management') . ' | ' . __('labels.backend.ringforts.edit'))

@section('breadcrumb-links')
    @include('backend.ringforts.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($ringfort, 'PATCH', route('admin.auth.user.update', $ringfort->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.ringforts.management')
                        <small class="text-muted">@lang('labels.backend.ringforts.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.ringforts.org_lat'))->class('col-md-2 form-control-label')->for('org_lat') }}

                        <div class="col-md-10">
                            {{ html()->text('org_lat')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.ringforts.org_lat'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->disabled() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.ringforts.new_long'))->class('col-md-2 form-control-label')->for('org_long') }}

                        <div class="col-md-10">
                            {{ html()->text('org_long')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.ringforts.org_long'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->disabled() }}
                        </div><!--col-->
                    </div><!--form-group-->
                    
                    <hr>
                    
                    <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.ringforts.new_lat'))->class('col-md-2 form-control-label')->for('new_lat') }}

                        <div class="col-md-10">
                            {{ html()->text('new_lat')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.ringforts.new_lat'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.ringforts.new_long'))->class('col-md-2 form-control-label')->for('new_long') }}

                        <div class="col-md-10">
                            {{ html()->text('new_long')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.ringforts.new_long'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->


                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.ringforts.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
