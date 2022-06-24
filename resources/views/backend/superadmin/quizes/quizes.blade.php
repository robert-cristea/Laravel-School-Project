<section class="content tab-pane fade show active" id="below-quizes" role="tabpanel"
  aria-labelledby="custom-content-below-series-tab">
  <div class="container-fluid">
    <h4 class="pt-pb">Quizes list</h4>
    <div class="card card-primary">

      <div class="card-body">

        <table class="table table-bordered">
          <tbody>
            <tr>
              <td class="add-font">Add quiz</td>
              <td class="right-addbtn" data-toggle="modal" data-target="#modal-quiz-add">
                <span>
                  <i class="fa fa-plus"></i>
                </span>
              </td>
            </tr>
            @foreach ($quizes as $quiz)
              <tr>
                <td style="width:90%">{{ $quiz->quiz_text }}</td>
                <td class="right-editbtn" data-toggle="modal"
                  data-target="#modal-quiz-edit" data-id="{{$quiz->id}}">
                  <span>
                    <i class="fa fa-edit"></i>
                  </span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card -->
    </div>
  </div>

</section>

<!-- quiz add modal -->
<div class="modal fade" id="modal-quiz-add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Quiz</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
  
          <form action="{{ route('quiz_list.store') }}" method="POST">
            @csrf
            <div class="box-body">
              <div class="form-group">
                <div><label>Quiz</label></div>
                <input type="text" class="form-control" name="quiz_text" required>
              </div>
              <div class="form-group">
                  <div><label>Active</label></div>
                  <div class="d-flex">
                      <div class="form-check-inline">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="is_active" value="1" checked>Yes
                          </label>
                      </div>
                      <div class="form-check-inline">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" value="0" name="is_active">No
                          </label>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                <div><label>Lesson</label></div>
                <select class="form-control select2" name="lesson_id" style="width: 100%;">
                  @foreach ($lessons as $lesson)
                    <option value="{{ $lesson->lesson_id }}">
                      {{ $lesson->title_english }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <div><label>Select Questions</label></div>
                <div class="d-inline-flex flex-wrap w-100 justify-content-between">
                    <div style="width:80%">
                        <select class="form-control" name="question_select" id="question_select" >
                            @foreach ($questions as $question)
                                <option value="{{ $question->question_id }}">
                                    {{ $question->question }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary" id="add_question_btn">Add</button>
                    </div>
                </div>
              </div>
              <div class="form-group">
                <div><label>Questions & Choices</label></div>
                <div id="question_pane" class="flex flex-column">

                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success shadow-btn btn-block">Save Quiz</button>
              </div>
            </div>
            <!-- /.box-body -->
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="modal-quiz-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Quiz</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="" method="post">
                    @csrf
                    @method('put')
                    <div class="box-body">
                        <div class="form-group">
                            <div><label>Quiz</label></div>
                            <input type="text" class="form-control" id="update_quiz_text" value="" name="quiz_text" required>
                        </div>
                        <div class="form-group">
                            <div><label>Active</label></div>
                            <div class="d-flex justify-content-start">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" id="update_is_active_yes" value="1" name="is_active">Yes
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" id="update_is_active_no" value="0" name="is_active">No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div><label>Lesson</label></div>
                            <select class="form-control select2" id="update_select_lesson" name="lesson_id" style="width: 100%;">
                                @foreach ($lessons as $lesson)
                                    <option value="{{ $lesson->lesson_id }}">
                                        {{ $lesson->title_english }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div><label>Select Questions</label></div>
                            <div class="d-inline-flex flex-wrap w-100 justify-content-between">
                                <div style="width:80%">
                                    <select class="form-control" name="question_select" id="update_question_select" >
                                        @foreach ($questions as $question)
                                            <option value="{{ $question->question_id }}">
                                                {{ $question->question }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary" id="update_add_question_btn">Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div><label>Questions & Choices</label></div>
                            <div id="update_question_pane" class="flex flex-column">

                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success shadow-btn btn-block">Edit Quiz</button>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </form>

                <form id="deleteForm" action="" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-red shadow-btn btn-block actionDelete">Remove Quiz</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@section('javascript')
<script>

    $("#add_question_btn").click(function () {
        var question_id = $("#question_select").val();
        $.ajax({
            url:"find_question/"+question_id,
            type:"POST",
            data:{"_token":"{{csrf_token()}}"},
            datatype:'json',
            success:function (result) {
                var question = result[0];
                if($('#li_'+ question['question_id'] +'').length!=0) {
                    return;
                }
                var code='<div class="card mb-3" style="background-color:#e2e6db" id="li_'+ question['question_id'] +'">' +
                    '<div class="card-header row position-relative">' +
                    '<div class="text-left text-maroon" style="padding-right:30px;width:100%">' +
                    '<p style="margin:0;font-size:18px;word-wrap: break-word;">' + question['question'] + '</p>' +
                    '</div>' +
                    '<a class="position-absolute" style="top:0;right:0;margin-top:12px;margin-right:20px;cursor:pointer;font-size:20px" onclick="removeQuestion(' + question['question_id'] + ','+"'add'"+')">&times</a>' +
                    '</div>' +
                    '<div class="card-body">';
                var choices = question['choices'];
                code += '<div class="row flex align-items-center" style="font-size:14px; font-weight:normal;border-top:solid gray 1px; border-bottom:solid gray 1px;">'+
                '<div class="col-9 text-center">Choice</div>' +
                '<div class="col-3 d-flex text-center"><span class="col-6">Yes</span><span class="col-6">No</span></div><hr/></div><div class="row">';
                for (let i=0;i<choices.length;i++){
                    var yes_checked, no_checked = "";
                    if(choices[i]['is_right_choice'] == 1) { yes_checked = "checked"; no_checked = "";}
                    else { yes_checked = ""; no_checked = "checked";}

                    code +='<div class="col-9">' + choices[i]['choice'] + '</div>' +
                        '<div class="col-3 d-flex align-items-center">' +
                        '<input type="radio" class="col-6" value="1" name="choice['+ choices[i]['choice_id']+']" ' + yes_checked + '/>' +
                        '<input type="radio" class="col-6" value="0" name="choice['+ choices[i]['choice_id']+']" ' + no_checked + '/>' +
                        '</div>';

                };

                code += '</div></div>' +
                '<input type="hidden" name="questionIds[]" value="'+ question['question_id'] +'" />' +
                '</div>';
                $("#question_pane").append(code);
            }
        });
    });
    $("#update_add_question_btn").click(function () {
        var question_id = $("#update_question_select").val();
        $.ajax({
            url:"find_question/"+question_id,
            type:"POST",
            data:{"_token":"{{csrf_token()}}"},
            datatype:'json',
            success:function (result) {
                var question = result[0];
                if($('#uli_'+ question['question_id'] +'').length!=0) {
                    return;
                }
                var code='<div class="card mb-3" style="background-color:#e2e6db" id="uli_'+ question['question_id'] +'">' +
                    '<div class="card-header row position-relative">' +
                    '<div class="text-left text-maroon" style="padding-right:30px;width:100%">' +
                    '<p style="margin:0;font-size:18px;word-wrap: break-word;">' + question['question'] + '</p>' +
                    '</div>' +
                    '<a class="position-absolute" style="top:0;right:0;margin-top:12px;margin-right:20px;cursor:pointer;font-size:20px" onclick="removeQuestion(' + question['question_id'] + ','+"'update'"+')">&times</a>' +
                    '</div>' +
                    '<div class="card-body">';
                var choices = question['choices'];
                code += '<div class="row flex align-items-center" style="font-size:14px; font-weight:normal;border-top:solid gray 1px; border-bottom:solid gray 1px;">'+
                    '<div class="col-9 text-center">Choice</div>' +
                    '<div class="col-3 d-flex text-center"><span class="col-6">Yes</span><span class="col-6">No</span></div><hr/></div><div class="row">';
                for (let i=0;i<choices.length;i++){
                    var yes_checked, no_checked = "";
                    if(choices[i]['is_right_choice'] == 1) { yes_checked = "checked"; no_checked = "";}
                    else { yes_checked = ""; no_checked = "checked";}

                    code +='<div class="col-9">' + choices[i]['choice'] + '</div>' +
                        '<div class="col-3 d-flex align-items-center">' +
                        '<input type="radio" class="col-6" value="1" name="choice['+ choices[i]['choice_id']+']" ' + yes_checked + '/>' +
                        '<input type="radio" class="col-6" value="0" name="choice['+ choices[i]['choice_id']+']" ' + no_checked + '/>' +
                        '</div>';
                };

                code += '</div></div>' +
                    '<input type="hidden" name="questionIds[]" value="'+ question['question_id'] +'" />' +
                    '</div>';
                $("#update_question_pane").append(code);
            }
        });
    });

    function removeQuestion(question_id,type) {
        switch (type) {
            case "add":
                $("#li_" + question_id).remove();
                break;
            case "update":
                $("#uli_" + question_id).remove();
                break;
            default:
                break;
        }
    }

    $(".right-editbtn").click(function() {
        var quiz_id = $(this).data('id');
        $("#update_question_pane").empty();
        $.ajax({
            url: "get_quiz/" + quiz_id,
            type: "POST",
            data: {"_token": "{{csrf_token()}}"},
            datatype: 'json',
            success: function (result) {
                var quiz = result;
                $("#update_quiz_text").val(quiz.quiz_text);
                if(quiz.is_active == 1){
                    $("#update_is_active_yes").attr('checked',true);
                }else{
                    $("#update_is_active_no").attr('checked',true);
                }
                $("#update_select_lesson").val(quiz.lesson_id);

                // form action setting
                var url = "{{ route('quiz_list.update',':id')}}";
                var urld = "{{ route('quiz_list.destroy', ':id')}}";
                url = url.replace(':id', quiz.id);
                urld = urld.replace(':id', quiz.id);
                $("#editForm").attr("action",url);
                $("#deleteForm").attr("action",urld);

                //question_list javascript code
                var code = "";

                for(let i=0;i<quiz.questions.length;i++){
                        var question = quiz.questions[i];
                    code += '<div class="card mb-3" style="background-color:#e2e6db" id="uli_'+ question['question_id'] +'">' +
                        '<div class="card-header row position-relative">' +
                        '<div class="text-left text-maroon" style="padding-right:30px;width:100%">' +
                        '<p style="margin:0;font-size:18px;word-wrap: break-word;">' + question['question'] + '</p>' +
                        '</div>' +
                        '<a class="position-absolute" style="top:0;right:0;margin-top:12px;margin-right:20px;cursor:pointer;font-size:20px" onclick="removeQuestion(' + question['question_id'] + ','+"'update'"+')">&times</a>' +
                        '</div>' +
                        '<div class="card-body">';
                    var choices = question['choices'];
                    code += '<div class="row flex align-items-center" style="font-size:14px; font-weight:normal;border-top:solid gray 1px; border-bottom:solid gray 1px;">'+
                        '<div class="col-9 text-center">Choice</div>' +
                        '<div class="col-3 d-flex text-center"><span class="col-6">Yes</span><span class="col-6">No</span></div><hr/></div><div class="row">';

                    for (let i=0;i<choices.length;i++){
                        var yes_checked, no_checked = "";
                        if(choices[i]['is_right_choice'] == 1) { yes_checked = "checked"; no_checked = "";}
                        else { yes_checked = ""; no_checked = "checked";}

                        code +='<div class="col-9">' + choices[i]['choice'] + '</div>' +
                            '<div class="col-3 d-flex align-items-center">' +
                            '<input type="radio" class="col-6" value="1" name="choice['+ choices[i]['choice_id']+']" ' + yes_checked + '/>' +
                            '<input type="radio" class="col-6" value="0" name="choice['+ choices[i]['choice_id']+']" ' + no_checked + '/>' +
                            '</div>';
                    };

                    code += '</div></div>' +
                        '<input type="hidden" name="questionIds[]" value="'+ question['question_id'] +'" />' +
                        '</div>';
                }
                $("#update_question_pane").append(code);
            }
        })
    });

</script>
@endsection