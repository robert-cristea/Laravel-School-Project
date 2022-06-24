@extends('backend.layout_activation')

@section('content')
<ul class="nav nav-tabs nav-tab-3" id="custom-content-below-tab" role="tablist">
    <li class="nav-item nav-item-5 text-center">
        <a class="nav-link nav-link-3 active" id="custom-content-below-general-tab" data-toggle="pill" href="#custom-content-below-general" role="tab" aria-controls="custom-content-below-general" aria-selected="true">Activation</a>
    </li>
</ul>
<div class="content-wrapper tab-content" id="custom-content-below-tabContent">
    <section class="content tab-pane fade show active" id="custom-content-below-general" role="tabpanel" aria-labelledby="custom-content-below-general-tab">
      <form action="{{ route('sendActiveCode') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="container-fluid">
            <h4 class="pt-pb">General Status</h4>
            <h5 class="pt-pb" style="font-weight: bold">Single email</h5>
            <input class="form-control" name="single_email" type="text" placeholder="email..."><br/>

            <h5 class="pt-pb" style="font-weight: bold">Bulk emails</h5>
            {{-- <input type="file" accept=".csv" name="csv_file" id="csv_file" class="btn btn-red btn-block">Upload emails list(csv file)...</input> --}}
            <div class="custom-file" style="margin-top: 15px;" lang="es">
                <input type="file" class="custom-file-input video_upload" accept=".csv" name="csv_file" id="csv_file">
                <label class="custom-file-label" for="exampleInputFile">
                    Upload emails list(csv file)
                </label>
            </div>
            <h5 class="pt-pb" style="font-weight: bold">Selector sponsor</h5>
            <div class="card card-primary">
            
                <div class="card-body">
                    
                <div class="form-group">
                    <select name="sponsor" id="sponsor" class="form-control select2" style="width: 100%;">
                        @foreach ($corporate_clients as $corporate_client)
                            <option value="{{ $corporate_client->corporate_client_id }}">{{ $corporate_client->corporate_name }}</option>
                        @endforeach
                        
                        
                    </select>
                </div>
                </div>
            <!-- /.card -->
            </div>
            <span>
                The validity date applies only when the sponsor is vieva.
                If the sponsor is a corporate client, the program validity dates is specified in the corporate
                client administration panel.
                That way we can extend or cancel the program over all corporate user at once.

            </span>

            <h5 class="pt-pb" style="font-weight: bold">Program starting date</h5>
            <input class="form-control" id="start_date" type="mm/dd/YYYY" name="date1"  value="">

            <h5 class="pt-pb" style="font-weight: bold">Program expiration date</h5>
            <input class="form-control" id="expire_date" type="mm/dd/YYYY" name="date2" value=""><br/>

            <li class="list-group-item">
                <label class="checkbox">
                    <input type="checkbox" />
                    <span class="default-p">Indefinite plan</span>
                </label>
                
            </li>
            <br/>
            
            <button type="submit" class="btn btn-success btn-block">Send activation code</button>
            <div class="space-h3"> </div>
        </div>
        </form>
    </section>
</div>
@endsection


@section('javascript')
<script type="text/javascript">
    $(function () {
        // main product upload
        $( "#csv_file1" ).change(function(e) {
           var file = document.querySelector('#csv_file').files[0];
            var reader = new FileReader();
            reader.readAsText(file);
            reader.onload = function(event) {

                //get the file.
                var csv = event.target.result;

                //split and get the rows in an array
                var rows = csv.split('\n');

                //move line by line
                for (var i = 1; i < rows.length; i++) { 
                //split by separator (,) and get the columns
                cols = rows[i].split(',');

                //move column by column
                for (var j = 0; j < cols.length; j++) {
                    /*the value of the current column. 
                    Do whatever you want with the value*/ 
                    var value = cols[j];
                   
                }
                }
            }
           
        });
       
    });
</script>
@endsection