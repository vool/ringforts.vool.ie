<div id="sidebar" class="sidebar collapsed">
	<!-- Nav tabs -->
	<div class="sidebar-tabs">
		<ul role="tablist">
			<li>
				<a href="#home" role="tab"><i class="fa fa-bars"></i></a>
			</li>
			<li>
				<a href="#profile" role="tab"><i class="far fa-circle"></i></a>
			</li>
			<li>
				<a href="https://github.com/vool/?" role="tab" target="_blank"><i class="fab fa-github"></i></a>
			</li>
			<li>
				<a href="https://twitter.com/voolist" role="tab" target="_blank"><i class="fab fa-twitter"></i></a>
			</li>
		</ul>

		<ul role="tablist">
			<li>
				<a href="{{ route('admin.dashboard') }}" role="tab"><i class="fa fa-tachometer-alt"></i></a>
			</li>

			@guest
			<li>
				<a href="{{route('frontend.auth.login')}}" role="tab"><i class="fas fa-sign-in"></i></a>
			</li>
			@else

			<li>
				<a href="{{ route('frontend.user.account') }}" role="tab"><i class="fas fa-cog"></i></a>
			</li>
			<li>
				<a href="{{ route('frontend.auth.logout') }}" role="tab"><i class="fas fa-lock"></i></a>
			</li>

			@endguest
		</ul>
	</div>

	<!-- Tab panes -->
	<div class="sidebar-content">
		<div class="sidebar-pane" id="home">
			<h1 class="sidebar-header"> Well Spotted ! <span class="sidebar-close"><i class="fa fa-caret-left"></i></span></h1>

            <div class="text-uppercase mb-1 mt-4">
                <small><b>Confirmed</b></small>
            </div>
            <div class="progress progress-xs">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{$stats['confirmed_pc']}}%" aria-valuenow="{{$stats['confirmed_pc']}}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-muted">{{$stats['confirmed']}}/{{$stats['total']}}</small>
            
            <div class="text-uppercase mb-1 mt-2">
                <small><b>Rejected</b></small>
            </div>
            <div class="progress progress-xs">
                <div class="progress-bar bg-danger" role="progressbar" style="width: {{$stats['rejected_pc']}}%" aria-valuenow="{{$stats['rejected_pc']}}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-muted">{{$stats['rejected']}}/{{$stats['total']}}</small>
            
            <div class="text-uppercase mb-1 mt-2">
                <small><b>Pending</b></small>
            </div>
            <div class="progress progress-xs">
                <div class="progress-bar bg-warning" role="progressbar" style="width: {{$stats['pending_pc']}}%" aria-valuenow="{{$stats['pending_pc']}}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-muted">{{$stats['pending']}}/{{$stats['total']}}</small>

		</div>

		<div class="sidebar-pane" id="profile">
			<h1 class="sidebar-header">Ringfort<span class="sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
			<div class="well">
			    
			    <!-- Nav tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="gmap-tab" data-toggle="tab" href="#gmap" role="tab" aria-controls="gmap" aria-selected="true">Google</a>
					</li>
                   <li class="nav-item">
                        <a class="nav-link" id="mbmap-tab" data-toggle="tab" href="#mbmap" role="tab" aria-controls="mbmap" aria-selected="false">Mapbox</a>
                    </li>
					<li class="nav-item">
						<a class="nav-link" id="bmap-tab" data-toggle="tab" href="#bmap" role="tab" aria-controls="bmap" aria-selected="false">Bing</a>
					</li>
                   <li class="nav-item">
                        <a class="nav-link" id="ymap-tab" data-toggle="tab" href="#ymap" role="tab" aria-controls="ymap" aria-selected="false">Yandex</a>
                    </li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane active" id="gmap" role="tabpanel" aria-labelledby="gmap-tab">
						<img src="" id="googlelocMap"></>
					</div>
                    <div class="tab-pane" id="mbmap" role="tabpanel" aria-labelledby="mbmap-tab">
                        <img src="" id="mapboxlocMap"></>
                    </div>
                    <div class="tab-pane" id="bmap" role="tabpanel" aria-labelledby="bmap-tab">
                        <img src="" id="binglocMap"></>
                    </div>
					<div class="tab-pane" id="ymap" role="tabpanel" aria-labelledby="ymap-tab">
						<img src="" id="yandexlocMap"></>
					</div>
				</div>


			    
			    <h2>entity_id: <span id="entity_id"></span></h2>
			    <div>classcode: <span id="classcode" ></span></div>
			    <div>classdesc: <span id="classdesc"></span></div>
			    <div>smrs: <span id="smrs"></span></div>
			    <div>townland: <span id="tland_names" ></span></div>
			    <div id="lat"></div>
			    <div id="long"></div>
			    <div id="latlng"></div>
			    <a href="" id="link" target="_blank">Link</a>
			    
			    <div id="status"></div>
			</div>
		</div>

<!--
		<div class="sidebar-pane" id="messages">
			<h1 class="sidebar-header">Messages<span class="sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
		</div>

		<div class="sidebar-pane" id="settings">
			<h1 class="sidebar-header">Settings<span class="sidebar-close"><i class="fa fa-twitter"></i></span></h1>
		</div>-->

	</div>
</div>