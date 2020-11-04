$(document).ready(function(){
$('#CrearUsuarios').submit(function(e){
    e.preventDefault();
    let username = $('#Username').val();
    let Password1 = $('#Password').val();
    let Password2 = $('#Password2').val();
    let userType = $('#UserType').val();
    const data = {
        "Username" : username,
        "Pass1"    : Password1,
        "Pass2"    : Password2,
        "usrType"  : userType
    }
    $.post("Backend/registro.php", data, function(response){
        if(confirm(response)){
            $('#Username').val('');
            $('#Password').val('');
            $('#Password2').val('');
            $('#UserType').val('');
            $('#staticBackdrop').modal('toggle');
        }
       
    })
    document.getElementById('CrearUsuarios').reset()
});

});