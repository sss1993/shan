@extends('shop.layout.index')
@section('content')
<section id="content">
    <div class="container">
        <div class="card" id="profile-main">
                <div class="container">
                    <div class="pmb-block">
                    <div class="pmbb-header">
                        <h2><i class="zmdi zmdi-account m-r-5"></i>菜品详情</h2>
                    </div>
                    <div class="pmbb-body p-l-30">
                        <div class="pmbb-view">
                            <dl class="dl-horizontal">
                                <dt>预览图</dt>
                                <dd><img style="width: 200px;border: 1px solid lightgray" src="{{ $foodDetail->f_pic }}" alt="sorry"></dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>菜品名称</dt>
                                <dd>{{ $foodDetail->f_name }}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>菜品单价</dt>
                                <dd>{{ $foodDetail->f_price }}￥</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>菜品类别</dt>
                                <dd>{{ $tname->tname }}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>菜品简介</dt>
                                <dd>{{ $foodDetail->f_content }}</dd>
                            </dl>
                        </div>
<!--       <div class="card">
                        <div class="card-header">
                            <h2>Simple File Input <small>The file input plugin allows you to create a visually appealing file or image input widgets</small></h2>
                        </div>
                        
                        <div class="card-body card-padding">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="f-500 c-black m-b-20">Basic Example</p>
                                    
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-primary btn-file m-r-10 waves-effect">
                                            <span class="fileinput-new">Select file</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="...">
                                        </span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput">×</a>
                                    </div>
                                </div>
                            </div>
                            
                            <br>
                            <br>
                            
                            <p class="f-500 c-black m-b-20">Image Preview</p>
                            
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                <div>
                                    <span class="btn btn-info btn-file waves-effect">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="...">
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists waves-effect" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                            
                            <br>
                            <br>
                            <p><em>Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead.</em></p>
                        </div>
                    </div>
            </section> -->
            </div>
        </div>
    </div>
@endsection