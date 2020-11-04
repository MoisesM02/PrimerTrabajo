$(document).ready(function(){

    let showPassword = $('#ShowPassword');
    let PasswordVisibility = $('#Password');
    showPassword.on('change', function(){
        if(showPassword.prop('checked')){
            PasswordVisibility.attr('type', 'Text');
        }
        else{
            PasswordVisibility.attr('type', 'Password');
        }
    })


    $('#LoginForm').submit(function(e){
        e.preventDefault()
        let username = $('#Username').val()
        let password = $('#Password').val();;
        if (username != "" || username != null){
            if(password != "" || password != null){
                const data = {
                    'usuario': username,
                    'contra' : password
                };
                $.post("Backend/login.php", data, function(response){
                    try{
                        let resp = JSON.parse(response);
                        window.location.replace("index.php");
                    }catch(e){
                        alert(response)
                    }
                })
            }
        }
    })

});