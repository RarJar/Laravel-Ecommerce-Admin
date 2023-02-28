@extends('../master')

@section('content')
 <!-- page content -->
 <div class="right_col min-vh-100">
    <div class="categoryCount">
        <h4 class="my-3">အမျိုးအစားများ ( {{count($categories)}}-ခု )</h4>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#createCategory">အမျိုးအစားအသစ်ထည့်ရန်</button>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <input class="form-control searchData" placeholder="အမျိုးအစားများရှာရန်">
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-circle-check text-light me-2"></i>
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ဓာတ်ပုံ</th>
                                            <th>အမည်</th>
                                            <th>ပြင်ဆင်ရန်</th>
                                        </tr>
                                    </thead>

                                    <tbody class="categoriesList">
                                        @foreach ($categories as $category)
                                        <tr>
                                            <td class="align-middle">
                                                <img src="{{asset('categoryImage/' . $category->image)}}" style="width: 100px">
                                            </td>
                                            <td class="align-middle">{{$category->name}}</td>
                                            <td class="align-middle">
                                                <a href="{{route('category@updateCategoryPage',$category->token)}}" class="btn btn-success btn-sm m-2" style="width: 123px">ပြင်ရန်</a>

                                                <a href="{{route('category@deleteCategory',$category->token)}}" class="btn btn-danger btn-sm m-2" style="width: 123px">ဖျက်ရန်</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Start Create Dialog -->
    <div class="modal fade" id="createCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{route('category@addNewCategory')}}" method="post" class="modal-dialog" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">အမျိုးအစားအသစ်ထည့်ရန်</h3>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="col-form-label">ဓာတ်ပုံ</label> <br>
                    <img src="{{asset('assets/images/default_categoryImage.webp')}}" id="picture" style="width: 100px"> <br><br>
                    <input type="file" class="form-control" name="categoryImage" onchange="preview(event)">
                    @error('categoryImage')
                        <p class="text-danger mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="col-form-label">အမည်</label>
                    <input type="text" class="form-control" name="categoryName" value="{{old('categoryName')}}">
                    @error('categoryName')
                        <p class="text-danger mt-1">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">ပယ်ဖျက်မည်</button>
                <button type="submit" class="btn btn-sm btn-success">ထည့်မည်</button>
            </div>
            </div>
        </form>
    </div>
    <!--End Create Dialog -->
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
            console.log(reader.result);
            var picture = document.getElementById('picture');
            picture.src = reader.result;
        }
    }

    // Live Search
    $(document).ready(function(){
        $('.searchData').on('keyup',function(){
            var $data = $(this).val();
            $.ajax({
                url : '/searchCategory',
                type : 'GET',
                data : {
                    'searchData' : $data
                },
                dataType: 'json',
                success: function(response){
                    $list = '';
                    $listCount = '';

                    $listCount = `
                        <h4 class="my-3">အမျိုးအစားများ ( ${response.searchValues.length} - ခု )</h4>
                    `
                    
                    $('.categoryCount').html($listCount);

                        for($i=0 ; $i < response.searchValues.length; $i++){
                            $list += `
                                        <tr>
                                            <td class="align-middle">
                                                <img src="{{asset('categoryImage/${response.searchValues[$i].image}')}}" style="width: 100px">
                                            </td>
                                            <td class="align-middle">${response.searchValues[$i].name}</td>
                                            <td class="align-middle">
                                                <a href="/updateCategoryPage/${response.searchValues[$i].token}" class="btn btn-success btn-sm m-2" style="width: 123px">ပြင်ရန်</a>

                                                <a href="/deleteCategory/${response.searchValues[$i].token}" class="btn btn-danger btn-sm m-2" style="width: 123px">ဖျက်ရန်</a>
                                            </td>
                                        </tr>
                            `;
                        }

                    $('.categoriesList').html($list);
                }
            })
        });
    });
</script>
@endsection