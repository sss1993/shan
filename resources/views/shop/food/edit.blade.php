@extends('shop.layout.index')
@section('content')
<section id="content">
                <div class="container">
                    <div class="block-header">
                        <h2>修改菜品</h2>
                        
                    
                    </div>
                
                    <div class="card">
                        
                        
                        <div class="card-body card-padding">
                            <p class="c-black f-500 m-b-5"><h4>修改菜品信息</h4></p>
                            
                            <br><br>

                            <form action='{{ url("shop/food/$h_food->id") }}' method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <input type="hidden" name='sid' value="1">  
                            <div class="row">
                                <div class="col-sm-8">                       
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                        <div class="fg-line">
                                                <input type="text" class="form-control" placeholder="请填写菜品名称" name="f_name" value="{{ $h_food->f_name }}">
                                        </div>
                                    </div><br>
                                    <div class="input-group" style="width: 200px">
                                        <span class="input-group-addon"><i class="zmdi zmdi-format-subject zmdi-hc-fw"></i></span>
                                        <div class="fg-line">
                                            <div class="select">
                                                <select class="form-control" name="tid">
                                                    <option value="">选择类别</option>>
                                                @foreach($hf_type as $v)
                                                    <option {{ $h_food->tid == $v->id ? 'selected' : ''}} value="{{ $v->id }}">{{ $v->tname }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                        <div class="fg-line">
                                                <input type="text" class="form-control" placeholder="请填写菜品单价" name="f_price" value="{{ $h_food->f_price }}">

                                        </div>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                        <div class="fg-line">
                                            <textarea class="form-control" rows="5" name="f_content" placeholder="请填写菜品简介">{{ $h_food->f_content }}</textarea>
                                            <!-- <textarea style="resize:none"  name="f_content"  cols="80" rows="5" placeholder="请填写菜品简介"></textarea> -->
                                        </div>
                                    </div><br
                                    <br>    
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                        <label class="radio radio-inline m-r-20">
                                            <input {{ $h_food->f_status==1 ? 'checked' : '' }} type="radio" name="f_status" value="1">
                                            <i class="input-helper"></i>  
                                            上架
                                        </label>
                                        <label class="radio radio-inline m-r-20">
                                            <input {{ $h_food->f_status==2 ? 'checked' : '' }} type="radio" name="f_status" value="2">
                                            <i class="input-helper"></i>  
                                            下架
                                        </label>
                                        
                                    </div>

                                    <br>

                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <div class="fg-line">
                                          <button class="btn bgm-orange waves-effect form-control" >提交</button>
                                        </div>
                                    </div><br>
                                    
                                </div>
                                <div class="col-sm-4">                       
                            
                                    <p class="f-500 c-black m-b-20">上传封面:</p>
                            
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                            <img src="{{ $h_food->f_pic or '/food_pic/default.png' }}">
                                        </div>
                                    <br><br>
                                    <div>
                                    <span class="btn btn-info btn-file waves-effect">
                                        <span class="fileinput-new"> 上 传 封 面 </span>
                                        <span class="fileinput-exists"> 修 改 封 面 </span>
                                        <input type="file" name="f_pic" value="{{ $h_food->f_pic }}">
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists waves-effect" data-dismiss="fileinput"> 删 除 封 面 </a>
                                    </div>
                                </div>
                            
                            <br>
                            <br>
                        </div>
                             


                            </div>
                            
                            <br><br>
                            
                            <br>
                            <br>
                            <br>
                        
                        <br>
                    </div>

                  </form>
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
@endsection