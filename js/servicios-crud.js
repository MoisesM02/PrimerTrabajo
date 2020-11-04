$(document).ready(function(){
    let edit = false
    let search = false
    crearTabla(1,10);

    $('#gananciaCasa').attr('disabled', 'disabled'); 
    $('#gananciaEmpleado').attr('disabled', 'disabled'); 

    
    $('#precioServicio').on('change', function(){
        let = precio = $('#precioServicio').val();
        let = porcentajeCasa = $('#porcentajeCasa').val();
        let = porcentajeEmpleado = $('#porcentajeEmpleado').val();

        let gananciaCasa = precio*(porcentajeCasa/100);
        let gananciaEmpleado = precio*(porcentajeEmpleado/100);
        $('#gananciaCasa').val(gananciaCasa);
        $('#gananciaEmpleado').val(gananciaEmpleado);
    });
    $('#porcentajeCasa').on('change', function(){
        let = precio = $('#precioServicio').val();
        let = porcentajeCasa = $('#porcentajeCasa').val();
        $('#porcentajeEmpleado').val(100-porcentajeCasa)
        let = porcentajeEmpleado = $('#porcentajeEmpleado').val();

        let gananciaCasa = precio*(porcentajeCasa/100);
        let gananciaEmpleado = precio*(porcentajeEmpleado/100);
        $('#gananciaCasa').val(gananciaCasa);
        $('#gananciaEmpleado').val(gananciaEmpleado);
    })
    $('#porcentajeEmpleado').on('change', function(){
        let = precio = $('#precioServicio').val();
        let = porcentajeEmpleado = $('#porcentajeEmpleado').val();
        $('#porcentajeCasa').val(100-porcentajeEmpleado)
        let = porcentajeCasa = $('#porcentajeCasa').val();

        let gananciaCasa = precio*(porcentajeCasa/100);
        let gananciaEmpleado = precio*(porcentajeEmpleado/100);
        $('#gananciaCasa').val(gananciaCasa);
        $('#gananciaEmpleado').val(gananciaEmpleado);
    })

    function crearTabla(page, records_per_page){
        
        const data = {
            'pageNumber': page,
            'records'   : records_per_page
        }
        $.post("Backend/read-services.php", data, function(response){
            let res = JSON.parse(response)
            let servicios = (res[0])
            let template = "";
            template = `<center><table id='tablaDeDatos' style='cursor:pointer' class ='table table-striped table-bordered'>
            <thead class='thead-dark'>
            <tr>
            <th>Editar</th>
            <th>Id</th>
            <th>Nombre de servicio</th>
            <th>Tipo de servicio</th>
            <th>Precio total por servicio</th>
            <th>Porcentaje de empleado</th>
            <th>Porcentaje de la casa</th>
            <th>Ganancia de empleado</th>
            <th>Ganancia de la casa</th>
            <th>Duración</th>
            <th>Borrar</th>
            </tr>
            </thead>
            <tbody>`;
            servicios.forEach(servicio=> {
                template += `
                <tr>
                <td ><a class='editar' id='${servicio.id}'> Editar </a></td>
                <td>${servicio.id}</td>
                <td>${servicio.nombre}</td>
                <td>${servicio.tipo}</td>
                <td>$${servicio.precioTotal}</td>
                <td>${servicio.porcentajeEmpleado} %</td>
                <td>${servicio.porcentajeCasa} %</td>
                <td>$${servicio.gananciaEmpleado}</td>
                <td>$${servicio.gananciaCasa}</td>
                <td>${servicio.tiempo}</td>
                <td ><a class='borrar' data-id='${servicio.id}'> Borrar </a></td>
                </tr>
                `
            });
            template += `
            </tbody> </table></center>`;
            let pagination = "";
            pagination = `
            <center>
            <nav aria-label='Page navigation example'>
            <ul class ='pagination'> 
            `;
            let numofPages = res[1].numPaginas;
            for(let i = 1; i<=numofPages; i++){
                pagination += `<li class='page-item pagination-link' data-page='${i}'> <a class='page-link pagination-link' data-page='${i}'  href='javascript:void(0)'> ${i} </a> </li>`
            }
            pagination += `
            </ul>
            </nav>
            </center> 
            `;
            $('#paginationData').html(template);
            $('#pages').html(pagination);
        })
    };
    $('#cerrarModal').click(function(){
        $("#crearActualizarServicios").trigger('reset');
    })

    $(document).on('click', '.pagination-link', function(){
        var page = $(this).attr('data-page');
        $('#PageNumber').val(page)
        
        var records_per_page = $('#numOfRecords').val();
        crearTabla(page, records_per_page)
    })
    $('#records_numbers').on('change', function(){
     let val =  $('#records_numbers').val()
     $('#numOfRecords').val(val);
     let pgnumber = 1
     crearTabla(pgnumber, val);
    })
    $(document).on('click', '.borrar', function(e){
        e.preventDefault();
        if(confirm("¿Está seguro que desea borrar este producto?")){
        let id = $(this).attr('data-id');
        $.post("Backend/delete-services.php", {id}, function(response){
         console.log(response);
         let numerodeEntradas = $('#numOfRecords').val();
         let pages = $('#pageNumber').val()
         crearTabla(pages,numerodeEntradas)
        })
     }
    })
    $(document).on('click', '.editar', function(e){
        edit = true
        e.preventDefault();
        let id = $(this).attr('id');
         if(edit === true){
        $.post("Backend/select-single-service.php", {id}, function(response){
         let producto = JSON.parse(response)   
         $('#idServicio').val(producto[0].id)
         $('#nombreServicio').val(producto[0].nombre)
         $('#tipo').val(producto[0].tipo)
         $('#duracion').val(producto[0].tiempo)
         $('#precioServicio').val(producto[0].precioTotal)
         $('#porcentajeEmpleado').val(producto[0].porcentajeEmpleado)
         $('#porcentajeCasa').val(producto[0].porcentajeCasa)
         $('#gananciaCasa').val(producto[0].gananciaCasa)
         $('#gananciaEmpleado').val(producto[0].gananciaEmpleado)
        //  $('#stock').html(`<strong>${producto[0].cantidad}</strong>`)
         $('#formulario').modal("show")
 
        })}else{
            return false
        }
    });
    $('#editarProducto').click(function(e){
         e.preventDefault();
         let id = $('#idServicio').val();
         let nombre = $('#nombreServicio').val();
         let tipo = $('#tipo').val();
         let duracion = $('#duracion').val();
         let precioServicio = $('#precioServicio').val();
         let porcentajeEmpleado = $('#porcentajeEmpleado').val();
         let porcentajeCasa = $('#porcentajeCasa').val();
         let gananciaCasa = $('#gananciaCasa').val();
         let gananciaEmpleado = $('#gananciaEmpleado').val();
          
        const data = {
            id,
            nombre,
            tipo,
            duracion,
            precioServicio,
            porcentajeEmpleado,
            porcentajeCasa,
            gananciaCasa,
            gananciaEmpleado
        };
        if(edit === true){
        $.post("Backend/edit-service.php", data, function(response){
            alert(response);
            let numerodeEntradas = $('#numOfRecords').val();
            let pages = $('#pageNumber').val()
            crearTabla(pages,numerodeEntradas)
            $("#crearActualizarServicios").trigger('reset');
            edit = false
        })}
 
 
    });

    $('#showModal').click(function(e){
        e.preventDefault();
        edit = false;
        $('#formulario').modal("show")
    });
    $('#crearProducto').click(function(e){
         e.preventDefault()
         let nombre = $('#nombreServicio').val();
         let tipo = $('#tipo').val();
         let duracion = $('#duracion').val();
         let precioServicio = $('#precioServicio').val();
         let porcentajeEmpleado = $('#porcentajeEmpleado').val();
         let porcentajeCasa = $('#porcentajeCasa').val();
         let gananciaCasa = $('#gananciaCasa').val();
         let gananciaEmpleado = $('#gananciaEmpleado').val();
          
        const data = {
            nombre,
            tipo,
            duracion,
            precioServicio,
            porcentajeEmpleado,
            porcentajeCasa,
            gananciaCasa,
            gananciaEmpleado
        };
        if(edit === false){
        $.post("Backend/create-services.php", data, function(response){
            alert(response);
            let numerodeEntradas = $('#numOfRecords').val();
            let pages = $('#pageNumber').val();
            crearTabla(pages,numerodeEntradas)
            $("#crearActualizarServicios").trigger('reset');
        })}else{
            return false
        }
    })




    

})