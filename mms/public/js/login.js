$(document).ready(function(){
    $("#login").click(function(){
        var username = $("#email").val().trim();
        var password = $("#password").val();
        if(username.length == 0 || password.length == 0){
            alert("用户名密码都不能为空");
        }
    });
});