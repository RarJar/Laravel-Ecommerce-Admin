@extends('../master')

@section('content')
    <!-- page content -->
    <div class="right_col min-vh-100">
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>ကုန်ပစ္စည်းအချက်အလက်များပြင်ဆင်ရန်</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link"></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form action="{{route('product@updateProduct')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="col-form-label">ဓာတ်ပုံ</label> <br>
                                    <input type="file" name="productUpdateImages[]" id="images" accept="image/png, image/jpeg, image/jpg, image/webp" multiple class="form-control">
                                    </input>
                                    <div id="image_preview" class="d-flex flex-wrap"></div>

                                    <div class="d-flex flex-wrap">
                                        @foreach ($images as $image)
                                        <div class="d-flex flex-column">
                                            <input type="image" src="{{asset('productImage/' . $image->image)}}" class="m-1" style="height: 150px">

                                            {{-- Get Hidden Data --}}
                                            <input type="hidden" name="productOriginalImages[]" value="{{asset('productImage/' . $image->image)}}">

                                            <a href="{{route('product@removeImage_in_updatePage',$image->image)}}" class="btn btn-sm btn-danger mt-1">ပယ်ဖျက်ရန်</a>
                                        </div>
                                        @endforeach
                                    </div>

                                    @error('productImages')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                                                                
                                <div class="mb-3">
                                    <label class="col-form-label">အမည်</label>
                                    <input type="text" class="form-control" name="productName" value="{{$products->name}}">
                                    @error('productName')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">မူရင်းစျေးနှုန်း</label>
                                    <input type="number" class="form-control" name="originalPrice" value="{{$products->original_price}}">
                                    @error('originalPrice')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">လျှော့စျေးနှုန်း</label>
                                    <input type="number" class="form-control" name="discountPrice" value="{{$products->discount_price}}">
                                    @error('discountPrice')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">အုပ်စုအမျိုးအစား</label>
                                    <select name="category" class="form-select">
                                        <option value="">ကုန်ပစ္စည်းအမျိုးအစားတစ်ခုရွေးချယ်ပါ</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" @if ($category->id == $products->category) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">ရရှိနိုင်သော</label>
                                    <select name="availability" class="form-select">
                                        <option value="in_stock" @if ($products->availability == 'in_stock') selected @endif>In Stock</option>
                                        <option class="text-danger" value="out_stock" @if ($products->availability == 'out_stock') selected @endif>Out of Stock</option>
                                    </select>
                                    @error('availability')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">ကုန်ပစ္စည်းအကြောင်း</label>
                                    <textarea name="description" class="form-control" id="" cols="20" rows="6">{{$products->description}}</textarea>
                                    @error('description')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Get Hidden Data --}}
                            <input type="hidden" name="productID" value="{{$products->id}}">
                            <input type="hidden" name="productToken" value="{{$products->product_token}}">

                            <div class="modal-footer">
                                <a href="{{route('product@productListPage')}}" class="btn btn-sm btn-danger">မလုပ်တော့ပါ</a>
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
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Jquery Validate -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $.validator.addMethod('maxSize', function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param)
            }, 'File size must be less than {0} KB');

            var fileArr = [];
            $("#images").change(function() {
                // check if fileArr length is greater than 0
                if (fileArr.length > 0) fileArr = [];

                $('#image_preview').html("");
                var total_file = document.getElementById("images").files;

                var i;
                if (!total_file.length) return;
                for (i = 0; i < total_file.length; i++) {
                    fileArr.push(total_file[i]);
                    $('#image_preview').append("<div class='m-2' id='img-div" + i + "'><img src='" + URL.createObjectURL(event.target.files[i]) + "' class='w-100  previewImages'><button id='action-icon' value='img-div" + i + "' class='btn btn-sm btn-danger mt-1 w-100' role='" + total_file[i].name + "'>ပယ်ဖျက်ရန်</button></div>");
                }
            });

            $('body').on('click', '#action-icon', function(evt) {
                var divName = this.value;
                var fileName = $(this).attr('role');
                var total_file = fileArr;

                for (var i = 0; i < fileArr.length; i++) {
                    if (fileArr[i].name === fileName) {
                        fileArr.splice(i, 1);
                    }
                }

                document.getElementById('images').files = FileListItem(fileArr);
                $(`#${divName}`).remove();
                evt.preventDefault();
            })
        })

        function FileListItem(file) {
            file = [].slice.call(Array.isArray(file) ? file : arguments)
            for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
            if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
            for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
            return b.files
        }
    </script>
@endsection