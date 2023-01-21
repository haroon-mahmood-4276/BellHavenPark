<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard.index'));
});

// Roles Breadcrumbs
Breadcrumbs::for('roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Roles', route('roles.index'));
});

Breadcrumbs::for('roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('roles.index');
    $trail->push('Create Role', route('roles.create'));
});

Breadcrumbs::for('roles.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('roles.index');
    $trail->push('Edit Role');
});

// Permisisons Breadcrumbs
Breadcrumbs::for('permissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Permissions', route('permissions.index'));
});

Breadcrumbs::for('permissions.create', function (BreadcrumbTrail $trail) {
    $trail->parent('permissions.index');
    $trail->push('Create Permission', route('permissions.create'));
});

Breadcrumbs::for('permissions.edit', function (BreadcrumbTrail $trail, $permission_id) {
    $trail->parent('permissions.index');
    $trail->push('Edit Permission',  route('permissions.edit', ['id' => $permission_id]));
});

// Payment Methods Breadcrumbs
Breadcrumbs::for('payment-methods.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Payment Methods', route('payment-methods.index'));
});

Breadcrumbs::for('payment-methods.create', function (BreadcrumbTrail $trail) {
    $trail->parent('payment-methods.index');
    $trail->push('Create Payment Method', route('payment-methods.create'));
});

Breadcrumbs::for('payment-methods.edit', function (BreadcrumbTrail $trail, $payment_method_id) {
    $trail->parent('payment-methods.index');
    $trail->push('Edit Payment Method',  route('payment-methods.edit', ['id' => $payment_method_id]));
});

// International Id Breadcrumbs
Breadcrumbs::for('international-ids.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('International Id', route('international-ids.index'));
});

Breadcrumbs::for('international-ids.create', function (BreadcrumbTrail $trail) {
    $trail->parent('international-ids.index');
    $trail->push('Create International Id', route('international-ids.create'));
});

Breadcrumbs::for('international-ids.edit', function (BreadcrumbTrail $trail, $international_id) {
    $trail->parent('international-ids.index');
    $trail->push('Edit International Id',  route('international-ids.edit', ['id' => $international_id]));
});

// Cabin Types Breadcrumbs
Breadcrumbs::for('cabin-types.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Cabin Types', route('cabin-types.index'));
});

Breadcrumbs::for('cabin-types.create', function (BreadcrumbTrail $trail) {
    $trail->parent('cabin-types.index');
    $trail->push('Create Cabin Types', route('cabin-types.create'));
});

Breadcrumbs::for('cabin-types.edit', function (BreadcrumbTrail $trail, $cabin_type_id) {
    $trail->parent('cabin-types.index');
    $trail->push('Edit Cabin Types',  route('cabin-types.edit', ['id' => $cabin_type_id]));
});

// Cabin Breadcrumbs
Breadcrumbs::for('cabins.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Cabins', route('cabins.index'));
});

Breadcrumbs::for('cabins.create', function (BreadcrumbTrail $trail) {
    $trail->parent('cabins.index');
    $trail->push('Create Cabin', route('cabins.create'));
});

Breadcrumbs::for('cabins.edit', function (BreadcrumbTrail $trail, $cabin_id) {
    $trail->parent('cabins.index');
    $trail->push('Edit Cabin',  route('cabins.edit', ['id' => $cabin_id]));
});
