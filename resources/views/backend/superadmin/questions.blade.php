@extends('backend.layout_question')

@section('content')
  <ul class="nav nav-tabs nav-tab-3" id="custom-content-below-tab" role="tablist">
    <li class="nav-item nav-item-5 text-center">
      <a class="nav-link nav-link-3 active" id="below-questions-tab" data-toggle="pill" href="#below-questions" role="tab"
        aria-controls="below-questions" aria-selected="true">Questions</a>
    </li>
    <li class="nav-item nav-item-5 text-center">
      <a class="nav-link nav-link-3" id="below-choices-tab" data-toggle="pill" href="#below-choices" role="tab"
        aria-controls="below-choices" aria-selected="false">Choices</a>
    </li>
  </ul>
  <div class="content-wrapper tab-content" id="custom-content-below-tabContent">

    @include('backend.superadmin.questions.questions')
    @include('backend.superadmin.questions.choices')

  </div>
@endsection
