var URL = "./index.php/user/";
$(document).ready(function(){
    $("#login").click(function(){
        var username = $("#email").val().trim();
        var password = $("#password").val();
        if(username.length == 0 || password.length == 0){
            alert("用户名密码都不能为空");
        }else{
            $.ajax({
                type: "post",
                url: URL + "do_login",
                data:{
                    username : username,
                    password : password
                },
                dataType:"json",
                success:
                function(res){
                    if(res.status == 0){
                        alert(res.msg);
                    }else{
                        alert("ok")
                        window.location.href = "";
                    }
                }
            });
        }
    });
});