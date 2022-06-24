@extends('backend.layout_quiz')

@section('content')
  <ul class="nav nav-tabs nav-tab-3" id="custom-content-below-tab" role="tablist">
    <li class="nav-item nav-item-5 text-center">
      <a class="nav-link nav-link-3 active" id="below-questions-tab" data-toggle="pill" href="#below-quizes" role="tab"
        aria-controls="below-questions" aria-selected="true">Quizes</a>
    </li>
    <li class="nav-item nav-item-5 text-center">
      <a class="nav-link nav-link-3" id="below-choices-tab" data-toggle="pill" href="#below-lessons" role="tab"
        aria-controls="below-choices" aria-selected="false">Lessons</a>
    </li>
  </ul>
  <div class="content-wrapper tab-content" id="custom-content-below-tabContent">

    @include('backend.superadmin.quizes.quizes')
    @include('backend.superadmin.quizes.lessons')

  </div>
@endsection