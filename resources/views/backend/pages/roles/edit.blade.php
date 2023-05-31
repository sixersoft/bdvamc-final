@extends('backend.layouts.master')

@section('title')
    Dashboard
@endsection

@push('after-css')
@endpush

@push('after-script')
    @include('backend.pages.roles.partials.scripts')
@endpush

@section('pageheader')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Role Permissions</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Role Permissions</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.create') }}">Create Role</a></li>
                <li class="breadcrumb-item active">Edit Role</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Edit Role</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('roles.update', $role->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="name">Role Name</label>
                                <input type="text" class="form-control" id="name" value="{{ $role->name }}"
                                    name="name" placeholder="Enter a Role Name">
                            </div>

                            <div class="form-group">
                                <label for="name">Permissions</label>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1"
                                        {{ App\Models\User::roleHasPermissions($role, $all_permissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="checkPermissionAll">All</label>
                                </div>
                                <hr>
                                @php $i = 1; @endphp
                                @foreach ($permission_groups as $group)
                                    <div class="row">
                                        @php
                                            $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                                            $j = 1;
                                        @endphp

                                        <div class="col-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    id="{{ $i }}Management" value="{{ $group->name }}"
                                                    onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)"
                                                    {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="checkPermission">{{ $group->name }}</label>
                                            </div>
                                        </div>

                                        <div class="col-9 role-{{ $i }}-management-checkbox">

                                            @foreach ($permissions as $permission)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input"
                                                        onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})"
                                                        name="permissions[]"
                                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                        id="checkPermission{{ $permission->id }}"
                                                        value="{{ $permission->name }}">
                                                    <label class="form-check-label"
                                                        for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                                @php  $j++; @endphp
                                            @endforeach
                                            <br>
                                        </div>

                                    </div>
                                    @php  $i++; @endphp
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Role</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection
