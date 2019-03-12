<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('menus.backend.ringforts.status')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.ringforts.index') }}">@lang('menus.backend.ringforts.all')</a>
                <a class="dropdown-item" href="{{ route('admin.ringforts.rejected') }}">@lang('menus.backend.ringforts.rejected')</a>
                <a class="dropdown-item" href="{{ route('admin.ringforts.confirmed') }}">@lang('menus.backend.ringforts.confirmed')</a>
                <a class="dropdown-item" href="{{ route('admin.ringforts.pending') }}">@lang('menus.backend.ringforts.pending')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
