<?php

Breadcrumbs::for('home', function($trail) {
   $trail->push('home', route('home'));
});

/*
|--------------------------------------------------------------------------
| Membership
|--------------------------------------------------------------------------
|
*/
Breadcrumbs::for('membership', function($trail) {
    $trail->push(__('global.membership'));
});

// Church crud pages.
Breadcrumbs::for('church', function($trail) {
    $trail->parent('membership');
    $trail->push(__('global.church'), route('membership.church.index'));
});

Breadcrumbs::for('createChurch', function($trail) {
   $trail->parent('church');
   $trail->push(__('global.create_church'), route('membership.church.create'));
});

Breadcrumbs::for('showChurch', function($trail, $church) {
    $trail->parent('membership');
    $trail->push($church->name);
});

// Cell crud pages.
Breadcrumbs::for('cell', function($trail) {
    $trail->parent('membership');
    $trail->push(__('global.cell'), route('membership.cell.index'));
});

Breadcrumbs::for('createCell', function($trail) {
    $trail->parent('cell');
    $trail->push(__('global.create_cell'), route('membership.cell.create'));
});

Breadcrumbs::for('showCell', function($trail, $church, $cell) {
    $trail->parent('membership');
    $trail->push($church->name);
    $trail->push($cell->name);
});

// Member crud pages.
Breadcrumbs::for('member', function($trail) {
    $trail->parent('membership');
    $trail->push(__('global.member'), route('membership.member.index'));
});

Breadcrumbs::for('createMember', function($trail) {
    $trail->parent('member');
    $trail->push(__('global.create_member'), route('membership.member.create'));
});

Breadcrumbs::for('showMember', function($trail, $church, $cell, $member) {
    $trail->parent('membership');
    $trail->push($church->name);
    $trail->push($cell->name);
    $trail->push($member->code);
});

/*
|--------------------------------------------------------------------------
| Finance system
|--------------------------------------------------------------------------
|
*/
Breadcrumbs::for('finance', function($trail) {
    $trail->push(__('global.finance'));
});

Breadcrumbs::for('serviceRound', function($trail) {
    $trail->parent('finance');
    $trail->push(__('global.service_round'), route('finance.service-round.index'));
});

Breadcrumbs::for('createServiceRound', function($trail) {
    $trail->parent('finance');
    $trail->push(__('global.create_service_round'), route('finance.service-round.create'));
});

Breadcrumbs::for('showServiceRound', function($trail, $serviceRound) {
    $trail->parent('serviceRound');
    $trail->push(defaultDateFormat($serviceRound->date));
});

Breadcrumbs::for('manageOfferingForm', function($trail) {
    $trail->parent('finance');
    $trail->push(__('global.manage_offering'));
});
