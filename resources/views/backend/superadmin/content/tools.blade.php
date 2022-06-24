<section class="content tab-pane fade" id="custom-content-below-tools" role="tabpanel" aria-labelledby="custom-content-below-tools-tab">
    <div class="container-fluid">
        <h4 class="pt-pb">Tools list</h4>
        <div class="card card-primary">
        
            <div class="card-body">
                
                <table class="table table-bordered">
                    <tbody>
                        @foreach($tools as $tool)
                        <tr>
                            @if($tool->name_english)
                            <td style="width:90%">{{ $tool->name_english }}</td>
                            @else
                            <td style="width:90%">{{ $tool->name_frensh }}</td>
                            @endif
                            <td class="right-editbtn" data-toggle="modal" data-target="#modal-breathing-edit-{{ $tool->tools_id }}">
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

@foreach($tools as $tool)
<!-- breathing edit modal -->
<div class="modal fade" id="modal-breathing-edit-{{ $tool->tools_id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Breathing exercises</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('editTool', $tool->tools_id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <div><label for="author">Tool name</label></div>
                        <span>English</span>
                        <input type="text" name="tool_title_en" value="{{ $tool->name_english }}" class="form-control">
                        <span>French</span>
                        <input type="text" name="tool_title_fr" value="{{ $tool->name_frensh }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <div><label for="tool description">Tool Description</label></div>
                        <span>English</span>
                        <textarea name="tool_description_en" class="form-control">{{ $tool->description_english }}</textarea>
                        <span>French</span>
                        <textarea name="tool_description_fr" class="form-control">{{ $tool->description_frensh }}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success shadow-btn btn-block">Save changes</button>
                        <!-- <button type="submit" class="btn btn-red shadow-btn btn-block">Remove quotes</button> -->
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
@endforeach