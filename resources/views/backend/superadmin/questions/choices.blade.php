<section class="content tab-pane fade show" id="below-choices" role="tabpanel"
  aria-labelledby="custom-content-below-series-tab">
  <div class="container-fluid">
    <h4 class="pt-pb">Choices list</h4>
    <div class="card card-primary">

      <div class="card-body">

        <table class="table table-bordered">
          <tbody>
            <tr>
              <td class="add-font">Add choices</td>
              <td class="right-addbtn" data-toggle="modal" data-target="#modal-choice-add">
                <span>
                  <i class="fa fa-plus"></i>
                </span>
              </td>
            </tr>
            @foreach ($choices as $choice)
              <tr>
                <td style="width:90%">{{ $choice->choice }}</td>
                <td class="right-editbtn" data-toggle="modal"
                  data-target="#modal-choices-edit-{{ $choice->choice_id }}">
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



<!-- choice add modal -->
<div class="modal fade" id="modal-choice-add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add choice</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ route('choice.store') }}" method="POST">
          @csrf
          <div class="box-body">
            <div class="form-group">
              <div><label>choice</label></div>
              <input type="text" class="form-control" name="choice" required>
            </div>
            <div class="form-group">
              <div><label>Is right choice?</label></div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="is_right_choice" value="1" checked />
                <label class="form-check-label">Yes</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="is_active" value="0" />
                <label class="form-check-label">No</label>
              </div>
            </div>
            <div class="form-group">
              <div><label>Question</label></div>
              <select class="form-control select2" name="question_id" style="width: 100%;">
                @foreach ($questions as $question)
                  <option value="{{ $question->question_id }}">
                    {{ $question->question }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success shadow-btn btn-block">Create new choice</button>
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

<!-- choices edit modal -->
@foreach ($choices as $choice)
  <div class="modal fade" id="modal-choices-edit-{{ $choice->choice_id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit choice</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('choice.update', $choice->choice_id) }}" method="post">
            @csrf
            @method('put')
            <div class="box-body">
              <div class="form-group">
                <div><label>choice</label></div>
                <input type="text" class="form-control" value="{{ $choice->choice }}" name="choice" required>
              </div>
              <div class="form-group">
                <div><label>Is right choice?</label></div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="is_right_choice" value="1"
                    {{ $choice->is_right_choice == '1' ? 'checked' : '' }} />
                  <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="is_right_choice" value="0"
                    {{ $choice->is_right_choice == '0' ? 'checked' : '' }} />
                  <label class="form-check-label">No</label>
                </div>
              </div>
              <div class="form-group">
                <div><label>Question</label></div>
                <select class="form-control select2" name="question_id" style="width: 100%;">
                  @foreach ($questions as $question)
                    <option value="{{ $question->question_id }}"
                      {{ $question->question_id == $choice->question_id ? 'selected' : '' }}>
                      {{ $question->question }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success shadow-btn btn-block">Edit choice</button>
              </div>
            </div>
            <!-- /.box-body -->
          </form>
          <form action="{{ route('choice.destroy', $choice->choice_id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-red shadow-btn btn-block actionDelete">Remove choice</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endforeach
