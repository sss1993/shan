$(document).ready(function(){if($("#exchange_form").length){var a=$("#exchange_form");$.validator.addMethod("mobile",function(c,b){return REG.MOBILE.test(c)},"请填写11位手机号");a.validate({rules:{"userDetail[name]":{required:true},"userDetail[address]":{required:true},"userDetail[phone]":{required:true}},messages:{"userDetail[name]":{required:"请填写收货人姓名"},"userDetail[address]":{required:"请填写详细的收货地址"},"userDetail[phone]":{required:"请填写联系电话"}},errorPlacement:function(b,c){b.insertAfter(c)},errorElement:"span",errorClass:"inline-error",submitHandler:function(b){b.submit()}})}});