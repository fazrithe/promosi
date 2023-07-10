@extends('layouts.app')

@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<div class="container">
    <div class="card">
        <div class="card-body" style="background-color: white">
    <form action="{{ route('store.slide') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

        <table class="table table-bordered" id="dynamicTable">
            <tr>
                <th>Slide</th>
                <th>
                    <div class="row">
                        <div class="col-2">
                          <label>Timer</label>
                        </div>
                        <div class="col-4">
                          <input type="number" name="timer" class="form-control" placeholder="Time" required>
                        </div>
                        <div class="col-2">
                            <label>/Detik</label>
                        </div>
                      </div>
                </th>
            </tr>
            <tr>
                <td>
                    <div class="control-group after-add-more" style="background-color: white">
                        <div class="form-group mt-2">
                            <label>File</label>
                            <input type="file" name="video_file[]" class="form-control" accept="video/mp4,image/png, image/gif, image/jpeg">
                        </div>
                        <div class="form-group mt-2">
                            <label>Logo Perusahaan</label>
                            <input type="file" name="company_logo_file[]" class="form-control" accept="image/png, image/gif, image/jpeg">
                        </div>
                        <div class="form-group mt-2">
                            <label>Logo Promo</label>
                            <input type="file" name="company_promo_file[]" class="form-control" accept="image/png, image/gif, image/jpeg">
                        </div>
                        <div class="form-group mt-2">
                            <label>Keterangan</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                    </div>
                </td>
                <td class="mt-2"><div class="mt-2"><button type="button" name="add" id="add" class="btn btn-success">Add More</button></div></td>
            </tr>
        </table>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
    </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">

    var i = 0;

    $("#add").click(function(){

        ++i;

        $("#dynamicTable").append('<tr>'
            +'<td><hr>'
                +'<div class="control-group after-add-more" style="background-color: white">'
                        +'<div class="form-group mt-2">'
                            +'<label>File</label>'
                            +'<input type="file" name="video_file[]" class="form-control" accept="video/mp4,video/x-m4v,video/*">'
                        +'</div>'
                        +'<div class="form-group mt-2">'
                            +'<label>Logo Perusahaan</label>'
                            +'<input type="file" name="company_logo_file[]" class="form-control" accept="image/png, image/gif, image/jpeg">'
                        +'</div>'
                        +'<div class="form-group mt-2">'
                            +'<label>Logo Promo</label>'
                            +'<input type="file" name="company_promo_file[]" class="form-control" accept="image/png, image/gif, image/jpeg">'
                        +'</div>'
                        +'<div class="form-group mt-2">'
                            +'<label>Keterangan</label>'
                            +'<textarea name="description" class="form-control"></textarea>'
                        +'</div>'
                    +'</div>'
            +'</td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    });

    $(document).on('click', '.remove-tr', function(){
         $(this).parents('tr').remove();
    });

</script>
@endsection
