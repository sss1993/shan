<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>商家登录</title>
  <link rel="stylesheet" href="/shoplogin/style.css">
  <script src="/shoplogin/jquery-3.2.1.js"></script>
  <script src="/layer/layer.js"></script>
</head>
<body style="background-color:orange;">
  <div class="login-page">
  <div class="form">
    <form class="register-form">

    </form>
    <form class="login-form">
      <input name="uname" type="text" placeholder="输入用户名"/>
      <input name="passwd" type="password" placeholder="输入密码"/>
      <button class="message" type="button" style="color: white">登陆</button>
    </form>
  </div>
</div>
</body>
<script>

  $("body").keydown(function() {
      if (event.keyCode == "13") {//keyCode=13是回车键
        $('button.message').click();
      }
  });

  $('button.message').click(function(){
    var uname = $("input[name='uname']").val();
    var passwd = $("input[name='passwd']").val();

    $.ajax({
      type:'get',
      url:'{{ url("shop/dologin") }}',
      data:{ 'uname':uname, 'passwd':passwd },
      success:function(data){
        console.log(data);
        if(data.error) {
          $(".message").after("<span class='error' style='color:red;'>"+data.error+"</span>");
          // 如果span长度大于1则删除第一个span
          if($(".error").length > 1) {
            $('.error:last').remove();
          }
        } else {
          console.log(data);
          // 显示商铺选择界面
          if(data.length > 0){
            $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
            for (var i = 0; i < data.length; i++) {
              var sid = data[i]['id'];
              var url = '/shop/login/'+sid+'/shopinfo/';
              var sname = data[i]['s_name'];
              var shopinfo = '<a href='+url+' class="shopinfo">'+sname+'</a>';
              $('form.register-form').append(shopinfo);
            }
            
          }
        }

        
      }
    });
  });
</script>
</html>