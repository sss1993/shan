@extends('shop.layout.index')
@section('content')
<section id="content">
<div class="container">
    <div class="block-header">
        <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">菜品类别列表</font></font></h2>
    </div>
    <div class="card">
        <div class="card-header">
            <br>
            <div class="row">
            <form action="{{ url('shop/foodcate') }}">
                <div class="col-sm-2">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                    <div class="fg-line">
                        <input type="text" class="form-control" name='tname'>
                        <label class="fg-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">类别名称</font></font></label>
                    </div>
                </div>
                </div>
                <div class="col-sm-1">
                    <select name="pagenum" id="" class="form-control">
                        <option {{ $page==5 ? 'selected' : '' }}>5</option>
                        <option {{ $page==10 ? 'selected' : '' }}>10</option>
                        <option {{ $page==20 ? 'selected' : '' }}>20</option>
                    </select>                    
                </div>
                <div class="col-sm-1">
                <button class="btn btn-default btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-search"></i></button>
                </div>
            </form>
            </div>
            <br>
            <a href="javascript:void(0)" onclick="doAdd()"><button class="btn btn-warning btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-close" style="transform:rotate(45deg);"></i></button></a>
            <br>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><h4>id</h4></font></font>
                        </th>
                        <th style="text-align: center;">
                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><h4>类别名称</h4></font></font>
                        </th>
                        <th style="text-align: center;">
                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><h4>修改 &nbsp; / &nbsp;删除</h4></font></font>
                        </th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($data as $v)
                    <tr>
                        <td>
                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $v->id }}</font></font>
                        </td>
                        <td style="text-align: center;">
                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;" class="tname">{{ $v->tname or 'unknown' }}</font></font>
                        </td>
                        <td style="text-align: center;">
                            <font style="vertical-align: inherit;"><a href='javascript:void(0)' onclick="doEdit({{ $v->id }},this)" class="bgm-orange btn btn-icon command-edit waves-effect waves-circle"><i class="zmdi zmdi-edit"></i></a>
                        </font>&nbsp;&nbsp;&nbsp;&nbsp;
                        <font style="vertical-align: inherit;"><a href='javascript:void(0)' onclick="doDel({{ $v->id }},this)" class="bgm-red btn btn-icon command-edit waves-effect waves-circle">
                            <i class="zmdi zmdi-delete"></i></a></font>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <nav>

    {!! $data->appends($tname)->render() !!}
</nav>

        </div>
    </div>



        <script type="text/javascript">
            

            // delete one data
            function doDel(id,_this)
            {
                layer.confirm('你确定要删除吗', {
                    btn: ['确定','取消'] //按钮
                    }, function(){
                        $.post('{{ url("shop/foodcate") }}/'+id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
                            if(data == 1){
                                 layer.msg('删除成功', {icon: 1,time: 1000});
                                  $(_this).parents("tr").remove();
                            }else{
                                 layer.msg('删除失败', {icon: 1,time: 1000});
                            }
                        });
                        //20s后自动关闭
                });
            }

             // add one data
             function doAdd()
             {
                layer.config({extend: 'extend/layer.ext.js'});
                layer.prompt({
                  formType: 0,
                  title: '输入要添加的类别名称'
                }, function(value, index, elem){
                    $.post('{{ url("shop/foodcate") }}',{'_token':'{{csrf_token()}}','ftype':value},function(data){
                        if(data == 1){
                             layer.msg('添加成功', {icon: 1,time: 1000});
                        }else{
                             layer.msg('添加失败', {icon: 1,time: 1000});
                        }
                    });
                });   
             }

             // edit one data
             function doEdit(id,_this)
             {
                layer.config({extend: 'extend/layer.ext.js'});
                layer.prompt({
                  formType: 0,
                  title: '输入要修改的类别名称'
                }, function(value, index, elem){
                    $.post('{{ url("shop/foodcate") }}/'+id,{'_token':'{{csrf_token()}}','_method':'put','ftype':value},function(data){
                        if(data == 1){
                             layer.msg('修改成功', {icon: 1,time: 1000});
                             $(_this).parents('td').prev('td').text(value);
                        }else{
                             layer.msg('修改失败', {icon: 1,time: 1000});
                        }
                    });
                });   
             }

            /*
             * Notifications
             */
            function notify(from, align, icon, type, animIn, animOut){
                $.growl({
                    icon: icon,
                    title: ' Bootstrap Growl ',
                    message: 'Turning standard Bootstrap alerts into awesome notifications',
                    url: ''
                },{
                        element: 'body',
                        type: type,
                        allow_dismiss: true,
                        placement: {
                                from: from,
                                align: align
                        },
                        offset: {
                            x: 20,
                            y: 85
                        },
                        spacing: 10,
                        z_index: 1031,
                        delay: 2500,
                        timer: 1000,
                        url_target: '_blank',
                        mouse_over: false,
                        animate: {
                                enter: animIn,
                                exit: animOut
                        },
                        icon_type: 'class',
                        template: '<div data-growl="container" class="alert" role="alert">' +
                                        '<button type="button" class="close" data-growl="dismiss">' +
                                            '<span aria-hidden="true">&times;</span>' +
                                            '<span class="sr-only">Close</span>' +
                                        '</button>' +
                                        '<span data-growl="icon"></span>' +
                                        '<span data-growl="title"></span>' +
                                        '<span data-growl="message"></span>' +
                                        '<a href="#" data-growl="url"></a>' +
                                    '</div>'
                });
            };
            
            $('.notifications > div > .btn').click(function(e){
                e.preventDefault();
                var nFrom = $(this).attr('data-from');
                var nAlign = $(this).attr('data-align');
                var nIcons = $(this).attr('data-icon');
                var nType = $(this).attr('data-type');
                var nAnimIn = $(this).attr('data-animation-in');
                var nAnimOut = $(this).attr('data-animation-out');
                
                notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut);
            });


            /*
             * Dialogs
             */

            //Basic
            $('#sa-basic').click(function(){
                swal("Here's a message!");
            });

            //A title with a text under
            $('#sa-title').click(function(){
                swal("Here's a message!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis")
            });

            //Success Message
            $('#sa-success').click(function(){
                swal("Good job!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis", "success")
            });

            //Warning Message
            $('#sa-warning').click(function(){
                swal({   
                    title: "Are you sure?",   
                    text: "You will not be able to recover this imaginary file!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    closeOnConfirm: false 
                }, function(){   
                    swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
                });
            });
            
            //Parameter
            $('#sa-params').click(function(){
                swal({   
                    title: "Are you sure?",   
                    text: "You will not be able to recover this imaginary file!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    cancelButtonText: "No, cancel plx!",   
                    closeOnConfirm: false,   
                    closeOnCancel: false 
                }, function(isConfirm){   
                    if (isConfirm) {     
                        swal("Deleted!", "Your imaginary file has been deleted.", "success");   
                    } else {     
                        swal("Cancelled", "Your imaginary file is safe :)", "error");   
                    } 
                });
            });

            //Custom Image
            $('#sa-image').click(function(){
                swal({   
                    title: "Sweet!",   
                    text: "Here's a custom image.",   
                    imageUrl: "img/thumbs-up.png" 
                });
            });

            //Auto Close Timer
            $('#sa-close').click(function(){
                 swal({   
                    title: "Auto close alert!",   
                    text: "I will close in 2 seconds.",   
                    timer: 2000,   
                    showConfirmButton: false 
                });
            });

        </script>
@endsection