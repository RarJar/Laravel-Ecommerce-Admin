@extends('../master')

@section('content')
    <!-- page content -->
    <div class="right_col min-vh-100">
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>အမျိုးအစားအားပြင်ဆင်ရန်</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link"></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form action="{{route('category@updateCategory')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="col-form-label">ဓာတ်ပုံ</label> <br>
                                    <img src="{{asset('categoryImage/' . $data->image)}}" id="picture" style="width: 120px"> <br><br>
                                    <input type="file" class="form-control" name="categoryImage" onchange="preview(event)">
                                    @error('categoryImage')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">အမည်</label>
                                    <input type="text" class="form-control" name="categoryName" value="{{$data->name}}">
                                    @error('categoryName')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                </div>

                                <input type="hidden" name="categoryToken" value="{{$data->token}}">
                                <input type="hidden" name="categoryID" value="{{$data->id}}">

                            </div>
                            <div class="modal-footer">
                                <a href="{{route('category@categoryListPage')}}" class="btn btn-sm btn-danger">မလုပ်တော့ပါ</a>
                                <button type="submit" class="btn btn-sm btn-success">သိမ်းမည်</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsContent')
    <script>
        // Live Preview Image
    function preview(event){
        var input = event.target.files[0];
        var reader = new FileReader();
        reader.readAsDataURL(input);
        reader.onload = () =>{
            var picture = document.getElementById('picture');
            picture.src = reader.result;
        }
    }
    </script>
@endsection