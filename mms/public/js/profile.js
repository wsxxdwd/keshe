var URL = "./index.php/user/";
$(document).ready(function(){
    $(".nav_cell").click(function(){
       var tab_name = $(this).data().target;
       $(".nav_cell").removeClass('active');
       $(this).addClass('active');
       $(".tab").removeClass('show');
       $("#" + tab_name).addClass('show');
    });
});
/*$.ajax({
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
            //window.location.href = "";
        }
    }
});*/