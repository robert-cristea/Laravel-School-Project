<section class="content tab-pane fade show active" id="custom-content-below-series" role="tabpanel"
  aria-labelledby="custom-content-below-series-tab">
  <div class="container-fluid">
    <h4 class="pt-pb">Series list</h4>
    <div class="card card-primary">

      <div class="card-body">

        <table class="table table-bordered">
          <tbody>
            <tr>
              <td class="add-font">Add series</td>
              <td class="right-addbtn" data-toggle="modal" data-target="#modal-series-add">
                <span>
                  <i class="fa fa-plus"></i>
                </span>
              </td>
            </tr>
            @foreach ($series as $serie)
              <tr>
                <td style="width:90%">{{ $serie->title_english }}</td>
                <td class="right-editbtn" data-toggle="modal" data-target="#modal-series-edit-{{ $serie->serie_id }}">
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

    <h4 class="pt-pb">Series display</h4>
    <h5 class="pt-pb" style="font-weight: bold">Series display</h5>

    <form action="{{ route('seriesDisplay') }}" method="post" enctype="multipart/form-data">
      @csrf
      @foreach ($series as $serie)

        <div class="card card-primary">
          <div class="card-body">
            <div class="form-group">
              <span class="padding-r20">#</span>
              <!-- <input type="hidden" name="serie-id" value="{{ $serie->serie_id }}"/> -->
              <select name="{{ $serie->serie_id }}" class="form-control w-90 select2">

                @foreach ($series as $option)
                  <option value="{{ $option->display_order }}"
                    {{ $serie->display_order == $option->display_order ? 'selected' : '' }}>{{ $option->title_english }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <!-- /.card -->
        </div>
      @endforeach
      <button type="submit" class="btn btn-default shadow-btn btn-block">Save display modifications</button>
    </form>
    <div class="space-h3"></div>
  </div>

</section>

<!-- series add modal -->
<div class="modal fade" id="modal-series-add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add series</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ route('addSeries') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="box-body">
            <label for="session date">Series picture</label>
            <div class="col-md-12 center" id="thumb">
              <img src="{{ asset('/images/default.png') }}" alt="User" width="65%" height="175"
                class="img-rounded avatarUser" />
            </div>
            <!-- <div class="form-group">
                        <input type="file" class="form-control btn btn-red" accept="image/*" name="thumbnail" id="thumbnail">
                    </div> -->
            <div class="custom-file" id="customFile" style="margin-top: 15px;" lang="es">
              <input type="file" class="custom-file-input" name="thumbnail" id="thumbnail" aria-describedby="fileHelp">
              <label class="custom-file-label" for="exampleInputFile">
                Select image...
              </label>
            </div>
            <div class="form-group">
              <div><label>Title</label></div>
              <span for="english">English</span>
              <input type="text" name="series_title_en" class="form-control" required>
              <span for="french">French</span>
              <input type="text" name="series_title_fr" class="form-control" required>
            </div>
            <div class="form-group">
              <div><label for="description">Description</label></div>
              <span>English</span>
              <textarea name="series_description_en" class="form-control" required></textarea>
              <span>French</span>
              <textarea name="series_description_fr" class="form-control" required></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success shadow-btn btn-block">Create new series</button>
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



<!-- series edit modal -->
@foreach ($series as $serie)
  <div class="modal fade" id="modal-series-edit-{{ $serie->serie_id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit series</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('editSeries', $serie->serie_id) }}" id="{{ $serie->serie_id }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="box-body">
              <label for="session date">Series picture</label>
              <div class="col-md-12 center thumb1">
                <img src="/uploads/{{ $serie->picture }}" alt="User" width="60%" height="175"
                  class="img-rounded avatarUser" />
              </div>
              <!-- <div class="form-group">
                        <input type="file" value="{{ $serie->picture }}" class="form-control btn btn-red thumbnail1" accept="image/*" name="thumbnail1">
                    </div> -->
              <div class="custom-file" id="customFile" style="margin-top: 15px;" lang="es">
                <input type="file" value="{{ $serie->picture }}" class="custom-file-input thumbnail1" accept="image/*"
                  name="thumbnail1">
                <label class="custom-file-label" for="exampleInputFile">
                  Select image...
                </label>
              </div>
              <div class="form-group">
                <div><label>Title</label></div>
                <span for="english">English</span>
                <input type="text" name="series_title_en" class="form-control" value="{{ $serie->title_english }}">
                <span for="french">French</span>
                <input type="text" name="series_title_fr" class="form-control" value="{{ $serie->title_frensh }}">
              </div>
              <div class="form-group">
                <div><label for="description">Description</label></div>
                <span for="english">English</span>
                <textarea name="series_description_en" class="form-control">{{ $serie->description_english }}
                </textarea>
                <span for="english">French</span>
                <textarea name="series_description_fr" class="form-control">{{ $serie->description_frensh }}</textarea>
              </div>
              <div class="form-group">
                <button type="submit" id="{{ $serie->serie_id }}" class="btn btn-success shadow-btn btn-block">Save
                  changes</button>

              </div>
            </div>
            <!-- /.box-body -->
          </form>
          <form action="{{ route('serieDestroy', $serie->serie_id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-red shadow btn-block actionDelete" type="submit">Remove series</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endforeach

@section('javascript')
  <script type="text/javascript">
    $(function() {
      // main product upload
      $("#thumbnail").change(function(e) {
        var file = e.target.files[0];
        var reader = new FileReader();
        var img_src = "";
        var img_cont = "";
        reader.addEventListener("load", function() {
          img_cont = reader.result;

          img_src = "<img id='main_p' src=" + img_cont +
            " alt='product' width='60%' height='175' class='img-rounded avatarUser'  />";


          $('#thumb').empty();
          $("#thumb").append(img_src);

        }, false);
        if (file) {
          reader.readAsDataURL(file);
        }

      });
      // main end
      $(".thumbnail1").change(function(e) {
        console.log("afdfd");
        var file = e.target.files[0];
        var reader = new FileReader();
        var img_src = "";
        var img_cont = "";
        reader.addEventListener("load", function() {
          img_cont = reader.result;

          img_src = "<img id='main_p' src=" + img_cont +
            " alt='product' width='65%' height='175' class='img-rounded avatarUser'  />";


          $('.thumb1').empty();
          $(".thumb1").append(img_src);

        }, false);
        if (file) {
          reader.readAsDataURL(file);
        }

      });
      // Preview in adding lesson
      $('.video_upload').on('change', function() {
        if (isVideo($(this).val())) {
          $('#thumb2').attr('src', URL.createObjectURL(this.files[0]));
          // $('.video-prev').show();
        }
      });
      // Preview in editing lesson
      $('.video_upload1').on('change', function() {
        console.log("dddd");
        if (isVideo($(this).val())) {
          $('.thumb3').attr('src', URL.createObjectURL(this.files[0]));
          // $('.video-prev').show();
        }
      });

    });

    function isVideo(filename) {
      var ext = getExtension(filename);
      switch (ext.toLowerCase()) {
        case 'm4v':
        case 'avi':
        case 'mp4':
        case 'mov':
        case 'mpg':
        case 'mpeg':
          // etc
          return true;
      }
      return false;
    }

    function getExtension(filename) {
      var parts = filename.split('.');
      return parts[parts.length - 1];
    }

  </script>
@endsection
