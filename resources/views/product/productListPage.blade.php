@extends('../master')

@section('content')
 <!-- page content -->
 <div class="right_col min-vh-100">
    <div class="productCount">
        <h4 class="my-3">ကုန်ပစ္စည်းများ ( {{count($products)}}-ခု )</h4>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <a href="{{route('product@addNewProductPage')}}" class="btn btn-sm btn-dark">ကုန်ပစ္စည်းအသစ်ထည့်ရန်</a>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <input class="form-control searchData" placeholder="ကုန်ပစ္စည်းများရှာရန်">
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
                                            <th class="align-middle">အမည်</th>
                                            <th class="align-middle">စျေးနှုန်း</th>
                                            <th class="align-middle">အုပ်စုအမျိုးအစား</th>
                                            <th class="align-middle">ရရှိနိုင်သော</th>
                                            <th class="align-middle">ပြင်ဆင်ရန်</th>
                                        </tr>
                                    </thead>

                                    <tbody class="productList">
                                        @foreach ($products as $product)
                                        <tr>
                                            <td class="align-middle">{{$product->name}}</td>
                                            <td class="align-middle">
                                                <del>{{$product->original_price}}</del>
                                                <p>{{$product->discount_price}}</p>
                                            </td>
                                            <td class="align-middle">{{$product->categoryName}}</td>
                                            <td class="align-middle">{{$product->availability}}</td>
                                            <td class="align-middle">
                                                <a href="{{route('product@updateProductPage',$product->product_token)}}" class="btn btn-success btn-sm m-2" style="width: 123px">ပြင်ရန်</a>

                                                <a href="{{route('product@deleteProduct',$product->product_token)}}" class="btn btn-danger btn-sm m-2" style="width: 123px">ဖျက်ရန်</a>
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
</div>
@endsection

@section('jsContent')
    <script>
        $('.searchData').on('keyup',function(){
            var $data = $(this).val();
            $.ajax({
                url : '/searchProduct',
                type : 'GET',
                data : {
                    'searchData' : $data
                },
                dataType: 'json',
                success: function(response){
                    $list = '';
                    $listCount = '';

                    $listCount = `
                        <h4 class="my-3">ကုန်ပစ္စည်းများ ( ${response.searchValues.length} - ခု )</h4>
                    `
                    
                    $('.productCount').html($listCount);

                        for($i=0 ; $i < response.searchValues.length; $i++){
                            $list += `
                                        <tr>
                                            <td class="align-middle">${response.searchValues[$i].name}</td>
                                            <td class="align-middle">
                                                <del>${response.searchValues[$i].original_price}</del>
                                                <p>${response.searchValues[$i].discount_price}</p>
                                            </td>
                                            <td class="align-middle">${response.searchValues[$i].categoryName}</td>
                                            <td class="align-middle">${response.searchValues[$i].availability}</td>
                                            <td class="align-middle">
                                                <a href="/updateProductPage/${response.searchValues[$i].product_token}" class="btn btn-success btn-sm m-2" style="width: 123px">ပြင်ရန်</a>

                                                <a href="/deleteProduct/${response.searchValues[$i].product_token}" class="btn btn-danger btn-sm m-2" style="width: 123px">ဖျက်ရန်</a>
                                            </td>
                                        </tr>
                            `;
                        }

                    $('.productList').html($list);
                }
            })
        });        
    </script>
@endsection
