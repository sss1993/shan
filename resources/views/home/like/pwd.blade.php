@extends('home.layout.userinfo')
@section('userinfo')
    <div class="main-content"> 
        <div class="content-header"> 
         <h2>修改密码</h2> 
        </div> 
        <div class="content-inner profile-changepwd"> 
         <form class="form-horizontal" method="post"  action="{{url('home/pwd/'.$id)}}"> 
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="_token" value="{{ csrf_token()}}">
          
           <div class="control-group clear-fix"> 
           
            
            <label class="control-label" for=""><span class="required">*</span>原密码</label> 
            <div class="controls"> 
             <input name="opassword" id="sf_guard_user_old_pwd" type="password"> 
             <p class="help-block">(请输入现在正在使用的密码)</p> 
            </div>
            <!--end input--> 
           </div>
           <!--end clearfix--> 
           <div class="control-group"> 
            <label class="control-label" for=""><span class="required">*</span>新密码</label> 
            <div class="controls"> 
             <input name="passwd" id="sf_guard_user_new_pwd" type="password"> 
             <p class="help-block">（请输入新密码）</p> 
            </div>
            <!--end input--> 
           </div>
           <!--end clearfix--> 
           <div class="control-group clear-fix"> 
            <label class="control-label" for=""><span class="required">*</span>重复新密码</label> 
            <div class="controls"> 
             <input name="rpassword" id="sf_guard_user_repeat_pwd" type="password"> 
             <p class="help-block">(请再输入一次新密码)</p> 
            </div>
            <!--end input--> 
           </div>
           <!--end clearfix--> 
           <div class="form-actions"> 
            <input type="submit" class="btn btn-yellow" value="提交更改">
           </div> 
       
         </form> 
           <script type="text/javascript">
                @if(session('error'))
                    layer.alert("{{ session('error') }}", {
                    icon: 2,
                })  
                @endif
                @if(session('success'))
                    layer.alert("{{ session('success') }}", {
                    icon: 1,
                })   
                @endif
   

          </script>

        </div> 
       </div>
@endsection
