@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.ringforts.management'))


@section('breadcrumb-links')
    @include('backend.ringforts.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.ringforts.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
  
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.ringforts.table.entity_id')</th>
                            <th>@lang('labels.backend.ringforts.table.classcode')</th>
                            <th>@lang('labels.backend.ringforts.table.classdesc')</th>
                            <th>@lang('labels.backend.ringforts.table.smrs')</th>
                            <th>@lang('labels.backend.ringforts.table.tland_names')</th>
                            <th>org lat</th>
                            <th>org long</th>
                            <th>new lat</th>
                            <th>new long</th>
                            <th>status</th>
                            <th>link</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ringforts as $ringfort)
                            <tr>
                                <td>{{ $ringfort->entity_id }}</td>
                                <td>{{ $ringfort->classcode }}</td>
                                <td>{{ $ringfort->classdesc }}</td>
                                <td>{!! $ringfort->smrs !!}</td>
                                <td>{!! $ringfort->tland_names !!}</td>
                                <td>{!! $ringfort->org_lat !!}</td>
                                <td>{!! $ringfort->org_long !!}</td>
                                <td>{!! $ringfort->new_lat !!}</td>
                                <td>{!! $ringfort->new_long !!}</td>
                                <td>{!! $ringfort->status_label !!}</td>
                                <td><a href="{!! $ringfort->link !!}" target="_blank">link</a></td>
                                <td>{!! $ringfort->action_buttons !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $ringforts->total() !!} {{ trans_choice('labels.backend.ringforts.table.total', $ringforts->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $ringforts->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
