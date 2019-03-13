<?php

Breadcrumbs::for('admin.ringforts.index', function ($trail) {
    $trail->push(__('strings.backend.ringforts.title'), route('admin.ringforts.index'));
});

Breadcrumbs::for('admin.ringforts.confirmed', function ($trail) {
    $trail->push(__('strings.backend.ringforts.confirmed'), route('admin.ringforts.confirmed'));
});

Breadcrumbs::for('admin.ringforts.rejected', function ($trail) {
    $trail->push(__('strings.backend.ringforts.rejected'), route('admin.ringforts.rejected'));
});

Breadcrumbs::for('admin.ringforts.pending', function ($trail) {
    $trail->push(__('strings.backend.ringforts.pending'), route('admin.ringforts.pending'));
});

Breadcrumbs::for('admin.ringfort.show', function ($trail, $id) {
    $trail->push(__('strings.backend.ringforts.show'), route('admin.ringfort.show', $id));
});

Breadcrumbs::for('admin.ringfort.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.ringforts.edit'), route('admin.ringfort.edit', $id));
});
