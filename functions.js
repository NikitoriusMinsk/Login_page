$(document).ready(function(){
    $("#submit_btn_r").click(function(){
        var login = $("#login").val();
        var password = $("#password").val();
        var confirm = $("#confirm").val();
        var email = $("#email").val();
        var name = $("#name").val();

        $.ajax({
            url:'register.php',
            type:'POST',
            data:`login=${login}&password=${password}&confirm=${confirm}&email=${email}&name=${name}`,
            success:function(response){
                if(response==1) alert("Регистрация успешна!");
                if(response==0) alert("Пользователь существует!");
                if(response==-1) alert("Пароли не совпадают!");
                if(response==-2) alert("Логин не соответствует правилу!");
                if(response==-3) alert("Пароль не соответствует правилу!");
                if(response==-4) alert("Email не соответствует правилу!");
                if(response==-5) alert("Имя не соответствует правилу!");
            }
        });
        
    });
    $("#submit_btn").click(function(){
        var login = $("#login_").val();
        var password = $("#password_").val();

        $.ajax({
            url:'login.php',
            type:'POST',
            data:`login_=${login}&password_=${password}`,
            success:function(response){
                if(response==1){
                    alert("Добро пожаловать!");
                    document.cookie = `user=${login}`;
                }
                if(response==0) alert("Неверный логин/пароль!");
            }
        });
    });
    $(function(){
        if(document.cookie!="user="){
            $("#forms").hide();
            $("#username").text(`Здравствуйте, ${document.cookie.split('=')[1]}`);
        }else{
            $("#user").hide();
        }
    });
    $("#logout").click(function(){
        document.cookie = "user="
    });
});