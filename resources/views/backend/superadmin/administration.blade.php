@extends('backend.layout_administration')

@section('content')
<ul class="nav nav-tabs nav-tab-3" id="custom-content-below-tab" role="tablist">
    <li class="nav-item nav-item-4 text-center">
        <a class="nav-link nav-link-3 active" id="custom-content-below-admins-tab" data-toggle="pill" href="#custom-content-below-admins" role="tab" aria-controls="custom-content-below-admins" aria-selected="true">Admins</a>
    </li>
    <li class="nav-item nav-item-4 text-center">
        <a class="nav-link nav-link-3" id="custom-content-below-client-tab" data-toggle="pill" href="#custom-content-below-client" role="tab" aria-controls="custom-content-below-client" aria-selected="false">Clients</a>
    </li>
    <li class="nav-item nav-item-4 text-center">
        <a class="nav-link nav-link-3" id="custom-content-below-teams-tab" data-toggle="pill" href="#custom-content-below-teams" role="tab" aria-controls="custom-content-below-teams" aria-selected="false">Teams</a>
    </li>
    <li class="nav-item nav-item-4 text-center">
        <a class="nav-link nav-link-3" id="custom-content-below-user-tab" data-toggle="pill" href="#custom-content-below-user" role="tab" aria-controls="custom-content-below-user" aria-selected="false">Users</a>
    </li>
</ul>
<div class="content-wrapper tab-content" id="custom-content-below-tabContent">
    
    @include('backend.superadmin.administration.admins')
    @include('backend.superadmin.administration.clients')
    @include('backend.superadmin.administration.teams')
    @include('backend.superadmin.administration.users')
    
    
</div>
@endsection