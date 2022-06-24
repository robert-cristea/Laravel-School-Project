<section class="content tab-pane fade show active" id="below-questions" role="tabpanel"
  aria-labelledby="custom-content-below-series-tab">
  <div class="container-fluid">
    <h4 class="pt-pb">Questions list</h4>
    <div class="card card-primary">

      <div class="card-body">

        <table class="table table-bordered">
          <tbody>
            <tr>
              <td class="add-font">Add question</td>
              <td class="right-addbtn" data-toggle="modal" data-target="#modal-question-add">
                <span>
                  <i class="fa fa-plus"></i>
                </span>
              </td>
            </tr>
            @foreach ($questions as $question)
              <tr>
                <td style="width:90%">{{ $question->question }}</td>
                <td class="right-editbtn" data-toggle="modal"
                  data-target="#modal-questions-edit-{{ $question->question_id }}">
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

<!-- question add modal -->
<div class="modal fade" id="modal-question-add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Question</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ route('question_list.store') }}" method="POST">
          @csrf
          <div class="box-body">
            <div class="form-group">
              <div><label>Question</label></div>
              <input type="text" class="form-control" name="question" required>
            </div>
            <div class="form-group">
              <div><label>Language</label></div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="language" value="1" checked />
                <label class="form-check-label">English</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="language" value="0" />
                <label class="form-check-label">French</label>
              </div>
            </div>
            <div class="form-group">
              <div><label>Active</label></div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="is_active" value="1" checked />
                <label class="form-check-label">Yes</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="is_active" value="0" />
                <label class="form-check-label">No</label>
              </div>
            </div>
            <div class="form-group">
              <div><label>Lesson</label></div>
              <select class="form-control select2" name="tool" style="width: 100%;">
                @foreach ($lessons as $lesson)
                  <option value="{{ $lesson->lessons_id }}">
                    {{ $lesson->title_english }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success shadow-btn btn-block">Create new question</button>
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

<!-- questions edit modal -->
@foreach ($questions as $question)
  <div class="modal fade" id="modal-questions-edit-{{ $question->question_id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Question</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('question_list.update', $question->question_id) }}" method="post">
            @csrf
            @method('put')
            <div class="box-body">
              <div class="form-group">
                <div><label>Question</label></div>
                <input type="text" class="form-control" value="{{ $question->question }}" name="question" required>
              </div>
              <div class="form-group">
                <div><label>Language</label></div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="language" value="1"
                    {{ $question->language == '1' ? 'checked' : '' }} />
                  <label class="form-check-label">English</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="language" value="0"
                    {{ $question->language == '0' ? 'checked' : '' }} />
                  <label class="form-check-label">French</label>
                </div>
              </div>
              <div class="form-group">
                <div><label>Active</label></div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="is_active" value="1"
                    {{ $question->is_active == '1' ? 'checked' : '' }} />
                  <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="is_active" value="0"
                    {{ $question->is_active == '0' ? 'checked' : '' }} />
                  <label class="form-check-label">No</label>
                </div>
              </div>
              <div class="form-group">
                <div><label>Lesson</label></div>
                <select class="form-control select2" name="lesson_id" style="width: 100%;">
                  @foreach ($lessons as $lesson)
                    <option value="{{ $lesson->lesson_id }}"
                      {{ $lesson->lesson_id == $question->lesson_id ? 'selected' : '' }}>
                      {{ $lesson->title_english }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success shadow-btn btn-block">Edit question</button>
              </div>
            </div>
            <!-- /.box-body -->
          </form>
          <form action="{{ route('question_list.destroy', $question->question_id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-red shadow-btn btn-block actionDelete">Remove question</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endforeach
