@extends('../master')

@section('content')
 <!-- page content -->
 <div class="right_col min-vh-100">
    <div>
        <h4 class="my-3">ကုန်ပစ္စည်းများ</h4>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <button class="btn btn-sm btn-dark">ကုန်ပစ္စည်းအသစ်ထည့်ရန်</button>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <input class="form-control" placeholder="ကုန်ပစ္စည်းများရှာရန်">
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>ဓာတ်ပုံ</th>
                                            <th>အမည်</th>
                                            <th>အကြောင်းအရာများ</th>
                                            <th>ပြင်ဆင်ရန်</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>System Architect</td>
                                            <td>Test</td>
                                            <td>Test</td>
                                            <td>Test</td>
                                        </tr>
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