@extends('backend.layout_content')

@section('content')
  <ul class="nav nav-tabs nav-tab-3" id="custom-content-below-tab" role="tablist">
    <li class="nav-item nav-item-2 text-center">
      <a class="nav-link nav-link-3 active" id="custom-content-below-series-tab" data-toggle="pill"
        href="#custom-content-below-series" role="tab" aria-controls="custom-content-below-series"
        aria-selected="true">Series</a>
    </li>
    <li class="nav-item nav-item-2 text-center">
      <a class="nav-link nav-link-3" id="custom-content-below-lessions-tab" data-toggle="pill"
        href="#custom-content-below-lessions" role="tab" aria-controls="custom-content-below-lessions"
        aria-selected="false">Lessions</a>
    </li>
    <li class="nav-item nav-item-2 text-center">
      <a class="nav-link nav-link-3" id="custom-content-below-quotes-tab" data-toggle="pill"
        href="#custom-content-below-quotes" role="tab" aria-controls="custom-content-below-quotes"
        aria-selected="false">Quotes</a>
    </li>
    <li class="nav-item nav-item-2 text-center">
      <a class="nav-link nav-link-3" id="custom-content-below-tools-tab" data-toggle="pill"
        href="#custom-content-below-tools" role="tab" aria-controls="custom-content-below-tools"
        aria-selected="false">Tools</a>
    </li>
    <li class="nav-item nav-item-2 text-center">
      <a class="nav-link nav-link-3" id="custom-content-below-subtools-tab" data-toggle="pill"
        href="#custom-content-below-subtools" role="tab" aria-controls="custom-content-below-subtools"
        aria-selected="false">SubTools</a>
    </li>
  </ul>
  <div class="content-wrapper tab-content" id="custom-content-below-tabContent">

    @include('backend.superadmin.content.series')
    @include('backend.superadmin.content.lessons')
    @include('backend.superadmin.content.quotes')
    @include('backend.superadmin.content.tools')
    @include('backend.superadmin.content.subtools')

  </div>
@endsection
