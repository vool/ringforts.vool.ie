@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.view'))

@section('breadcrumb-links')
@include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-sm-5">
				<h4 class="card-title mb-0"> @lang('labels.backend.access.users.management') <small class="text-muted">@lang('labels.backend.access.users.view')</small></h4>
			</div><!--col-->
		</div><!--row-->

		<div class="row mt-4 mb-4">
			<div class="col">
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> @lang('labels.backend.access.users.tabs.titles.overview')</a>
					</li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
						<div class="row">

							<div class="col-4">
								<div id="map"></div>
    								{{ html()->modelForm($ringfort, 'PATCH', route('admin.ringfort.update', $ringfort->id))->open() }}
    								<div class="row">
    									<div class="col-4">
    										{{ html()->hidden('lat')
    										->required() }}
    									</div>
    									<div class="col-4">
    										{{ html()->hidden('long')
    										->required() }}
    									</div>
    									<div class="col-4">
    									    
    									    {{ html()->button('Reject')->class('btn btn-danger') }}
    									    {{ html()->button('Approve')->class('btn btn-success') }}
    										{{ form_submit('Update Location')->class('btn btn-primary') }}
    									</div>
    								</div>
								</div>

							</div>
							<div class="col-8">
								<div class="table-responsive">
									<table class="table table-hover">
										<tr>
											<th>@lang('labels.backend.access.users.tabs.content.overview.name')</th>
											<td>{{ $ringfort->entity_id }}</td>
										</tr>

										<tr>
											<th>@lang('labels.backend.access.users.tabs.content.overview.email')</th>
											<td>{{ $ringfort->classcode }}</td>
										</tr>

										<tr>
											<th>@lang('labels.backend.access.users.tabs.content.overview.email')</th>
											<td>{{ $ringfort->classdesc }}</td>
										</tr>

										<tr>
											<th>@lang('labels.backend.access.users.tabs.content.overview.status')</th>
											<td>{!! $ringfort->status_label !!}</td>
										</tr>

									</table>
								</div>
							</div>
						</div><!--table-responsive-->

					</div><!--tab-->
				</div><!--tab-content-->
			</div><!--col-->
		</div><!--row-->
	</div><!--card-body-->

	<div class="card-footer">
		<div class="row">
			<div class="col">
				<small class="float-right text-muted"> <strong>@lang('labels.backend.access.users.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($ringfort->created_at) }} ({{ $ringfort->created_at->diffForHumans() }}), <strong>@lang('labels.backend.access.users.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($ringfort->updated_at) }} ({{ $ringfort->updated_at->diffForHumans() }})
					@if($ringfort->trashed()) <strong>@lang('labels.backend.access.users.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($ringfort->deleted_at) }} ({{ $ringfort->deleted_at->diffForHumans() }})
					@endif </small>
			</div><!--col-->
		</div><!--row-->
	</div><!--card-footer-->
</div><!--card-->
@endsection

@push('after-scripts')
<script>
	    var sat = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
	attribution : 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
	});
	var osm = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
	attribution : '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
	});

	var baseMaps = {
	"Map" : osm,
	"Satelite" : sat
	};

	var map = L.map('map', {
	center : [{{$ringfort->lat}}, {{$ringfort->long}}],
	zoom : 17,
	layers : [sat]
	});

	var marker = L.marker([{{$ringfort->lat}}, {{$ringfort->long}}], {
	draggable: 'true'
	});

	marker.on('dragend', function(event) {
	var position = marker.getLatLng();
	$("#lat").val(position.lat);
	$("#long").val(position.lng).keyup();
	});

	marker.addTo(map);</script>
@endpush

@push('after-styles')
<style>
    #map {
        height: 500px;
    }
</style>
@endpush
