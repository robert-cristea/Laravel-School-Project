<section class="content tab-pane fade" id="custom-content-below-quotes" role="tabpanel" aria-labelledby="custom-content-below-quotes-tab">
    <div class="container-fluid">
        <h4 class="pt-pb">Quote status</h4>
        <div class="card card-primary">
        
            <div class="card-body">
                
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width:40%">English quotes</td>
                            <td>{{ $quotes_en }}</td>
                        </tr>
                        <tr>
                            <td style="width:40%">French quotes</td>
                            <td>{{ $quotes_fr }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <!-- /.card -->
        </div>

        <h4 class="pt-pb">Quotes list</h4>
        <div class="card card-primary">
        
            <div class="card-body">
                
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="add-font">Add quote</td>
                            <td class="right-addbtn" data-toggle="modal" data-target="#modal-quotes-add">
                                <span>
                                    <i class="fa fa-plus"></i>
                                </span>
                            </td>
                        </tr>
                        @foreach($quotes as $quote)
                        <tr>
                            <td style="width:90%">
                                <li class="item-none">{{ $quote->content }}</li>
                                <li class="item-none"><strong>{{ $quote->Author }}</strong></li>
                            </td>
                            <td class="right-editbtn" data-toggle="modal" data-target="#modal-quotes-edit-{{ $quote->quote_id }}">
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
<!-- quote add modal -->
<div class="modal fade" id="modal-quotes-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add quote</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('addQuote') }}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="description">Quote</label>
                        <textarea name="add_quote" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" name="add_author" class="form-control" required>
                        <!-- <select class="form-control select2" name="add_author" style="width: 100%;">
                            <option>Select author</option>
                            @foreach($coaches as $coach)
                            <option value="{{ $coach->first_name }}">{{ $coach->first_name }}</option>
                            @endforeach
                        </select> -->
                    </div>
                    <div class="form-group">
                        <div><label>Title</label></div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="customRadio1" name="quoteradio" value="1" checked>
                          <label for="customRadio1" class="custom-control-label">English</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="customRadio2" name="quoteradio" value='0'>
                          <label for="customRadio2" class="custom-control-label">French</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div><label>Associated lesson</label></div>
                        <select class="form-control select2" name="associated_le" style="width: 100%;">
                            
                            @foreach($lessons as $lesson)
                            <option value="{{ $lesson->lesson_id }}">{{ $lesson->title_english }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success shadow-btn btn-block">Create new quote</button>
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



<!-- quotes edit modal -->
@foreach($quotes as $quote)
<div class="modal fade" id="modal-quotes-edit-{{ $quote->quote_id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit quote</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('editQuote', $quote->quote_id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="quote">Quote</label>
                        <textarea name="edit_quote" class="form-control">{{ $quote->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input name="edit_author" type="text" class="form-control" value="{{ $quote->Author }}" required>
                        <!-- <select class="form-control select2" name="edit_author" style="width: 100%;">
                            @foreach($coaches as $coach)
                            <option value="{{ $coach->first_name }}" {{ ($quote->Author == $coach->first_name)? 'selected':"" }}>{{ $coach->first_name }}</option>
                            @endforeach
                        </select> -->
                    </div>
                    <div class="form-group">
                        <div><label>Title</label></div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="editradio" value="1" {{ $quote->language=="1"?"checked":""}} />
                          <label class="form-check-label">English</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="editradio" value="0" {{ ($quote->language=="0") ? "checked" : ""}} />
                          <label class="form-check-label">French</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div><label>Associated lesson</label></div>
                        <select class="form-control select2" name="quote_le" style="width: 100%;">
                            @foreach($lessons as $lesson)
                            <option value="{{ $lesson->lesson_id }}" {{ ($lesson->lesson_id == $quote->video_id) ? 'selected' : '' }}>{{ $lesson->title_english }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success shadow-btn btn-block">Save changes</button>
                        
                    </div>
                </div>
                <!-- /.box-body -->
                </form>
                <form action="{{ route('deleteQuote', $quote->quote_id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-red shadow-btn btn-block actionDelete">Remove quotes</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endforeach
