$(function(){
    let url;
    let tipo;
    function cargarSelects(tipos){       
    $.post('Backend/crear-editar-selects.php', {tipos}, function(response){
        console.log(tipos);
        try{ 
            res = JSON.parse(response);
            let template = "";
            res.forEach(registro => {
                template += `
                    <option value="${registro.id}">${registro.nombre} </option>
                `;
            });
            $('#selectNombre').html(template);
            cargarEstado();
       }catch(error){
           alert(response);
       }
    })
    }



    $(document).on('click', '.crear', function(){
        tipo = $(this).attr('data-type');
        url = "Backend/crear.php";
        $('#nombre1').text(`Nombre de ${tipo}`)
        $('#Nombre').attr('placeholder', `Nombre de ${tipo}`)
        $('#formularioCrear').modal('show');
    })

    $('#crear').on('click', function(){
        let nombre = $('#Nombre').val();
        const data = {
            nombre,
            tipo
        }
        $.post(url, data, function(res){
            alert(res)
        })
    })

    //editar
    $(document).on('click', '.editar', function(){
        tipo = $(this).attr('data-type');
        let template="";
        if(tipo == "Empleada"){
            template = `
                <option value="Disponible">Disponible</option>
                <option value="No disponible">No disponible</option>
            `;
        }else{
            template = `
                <option value ="Disponible">Disponible</option>
                <option value ="Mantenimiento">Mantenimiento</option>
                <option value ="Limpiando">Limpiando</option>
            `;;
        }
        $('#selectEstado').html(template);
        url = "Backend/editar.php";
        $('#Nombre2').text(`Nombre de ${tipo}`)
        cargarSelects(tipo);
        
        $('#formularioEditar').modal('show');
    });

    function cargarEstado(){
        let id = $('#selectNombre').val();
            const data = {
                id,
                tipo
            }
            $.post("Backend/obtener-estado.php",data , function(response){
                try{
                    let res = JSON.parse(response);
                    let template = `<strong>${res.estado}</strong>`;
                    $('#estadoActual').html(template);
                }catch(error){
                    alert(response);
                }
            })
    }
    $('#selectNombre').on('change', function(){
        cargarEstado();
    });
    $('#editar').on('click', function(){
        let id = $('#selectNombre').val();
        let estado = $('#selectEstado').val();
        const data = {
            id,
            estado,
            tipo
        };
        if(confirm('¿Está seguro que desea editarlo?')){
            $.post("Backend/actualizar-estado.php", data, function(response){
                alert(response);
            })
        }else{
            return false;
        }
    })
})