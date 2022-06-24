@extends('backend.layout_analytics')

@section('content')
<ul class="nav nav-tabs nav-tab-3" id="custom-content-below-tab" role="tablist">
    <li class="nav-item nav-item-3 text-center">
        <a class="nav-link nav-link-3 active" id="custom-content-below-general-tab" data-toggle="pill" href="#custom-content-below-general" role="tab" aria-controls="custom-content-below-general" aria-selected="true">General</a>
    </li>
    <li class="nav-item nav-item-3 text-center">
        <a class="nav-link nav-link-3" id="custom-content-below-client-tab" data-toggle="pill" href="#custom-content-below-client" role="tab" aria-controls="custom-content-below-client" aria-selected="false">Per Client</a>
    </li>
    <li class="nav-item nav-item-3 text-center">
        <a class="nav-link nav-link-3" id="custom-content-below-user-tab" data-toggle="pill" href="#custom-content-below-user" role="tab" aria-controls="custom-content-below-user" aria-selected="false">Per User</a>
    </li>
</ul>
<div class="content-wrapper tab-content" id="custom-content-below-tabContent">
    
    @include('backend.superadmin.analytics.general')
    @include('backend.superadmin.analytics.perclient')
    @include('backend.superadmin.analytics.peruser')
  
</div>
@endsection