$(document).ready(function(){
    let edit = false
    let search = false
    function load_data(page, records_per_page){
        let direccion = (!search) ? 'Backend/read-products.php' : 'Backend/search-products.php'
        let parametro = $('#buscador').val()
        const data = (!search) ? {'pageNumber': page,'records': records_per_page} : {'pageNumber': page,'records': records_per_page, 'parametro' : parametro}
        
        $.post(direccion,data, function(response){
            let res = JSON.parse(response)
            let productos = (res[0])
            let template = "";
            template = `<center><table id='tablaDeDatos' style='cursor:pointer' class ='table table-striped table-bordered'>
            <thead class='thead-dark'>
            <tr>
            <th>Editar</th>
            <th>Id</th>
            <th>Nombre de Producto</th>
            <th>Código de producto</th>
            <th>Categoría</th>
            <th>Precio de compra</th>
            <th>Precio clientes</th>
            <th>Precio empleados</th>
            <th>En inventario</th>
            <th>Borrar</th>
            </tr>
            </thead>
            <tbody>`
            productos.forEach(producto => {
                template += `
                <tr>
                <td ><a class='editar' id='${producto.id}'> Editar </a></td>
                <td>${producto.id}</td>
                <td>${producto.nombre}</td>
                <td>${producto.codigo}</td>
                <td>${producto.categoria}</td>
                <td>${producto.precioCompra}</td>
                <td>${producto.precioCliente}</td>
                <td>${producto.precioEmpleado}</td>
                <td>${producto.cantidad}</td>
                <td ><a class='borrar' data-id='${producto.id}'> Borrar </a></td>
                </tr>
                `
            });
            template += `
            </tbody> </table></center>`
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
        
    }
    load_data(1, 10)

    $('#buscarProducto').click(function(e){
        e.preventDefault();
        search = true;
        let numerodeEntradas = $('#numOfRecords').val();
        let pages = $('#pageNumber').val();
        load_data(pages, numerodeEntradas);
    })
    $('#reiniciar').click(function(e){
        e.preventDefault();
        search = false;
        $('#buscador').val('');
        let numerodeEntradas = $('#numOfRecords').val();
        let pages = $('#pageNumber').val();
        load_data(pages, numerodeEntradas);
    })

   $(document).on('click', '.pagination-link', function(){
       var page = $(this).attr('data-page');
       $('#PageNumber').val(page)
       
       var records_per_page = $('#numOfRecords').val();
       load_data(page, records_per_page)
   })
   $('#records_numbers').on('change', function(){
    let val =  $('#records_numbers').val()
    $('#numOfRecords').val(val);
    let pgnumber = 1
    load_data(pgnumber, val);
   })
   $(document).on('click', '.borrar', function(e){
       e.preventDefault();
       if(confirm("¿Está seguro que desea borrar este producto?")){
       let id = $(this).attr('data-id');
       $.post("Backend/delete-products.php", {id}, function(response){
        console.log(response);
        let numerodeEntradas = $('#numOfRecords').val();
        let pages = $('#pageNumber').val()
        load_data(pages,numerodeEntradas)
       })
    }
   })
   $(document).on('click', '.editar', function(e){
       edit = true
       e.preventDefault();
       let id = $(this).attr('id');
        if(edit === true){
       $.post("Backend/select-single-product.php", {id}, function(response){
        let producto = JSON.parse(response)   
        $('#nombreProducto').val(producto[0].nombre)
        $('#Codigo').val(producto[0].codigo)
        $('#idProducto').val(producto[0].id)
        $('#precioEmpleado').val(producto[0].precioEmpleado)
        $('#precioCliente').val(producto[0].precioCliente)
        $('#gananciaEmpleado').val(producto[0].gananciaEmpleado)
        $('#gananciaCasa').val(producto[0].gananciaCasa)
        $('#precioCompra').val(producto[0].precioCompra)
        $('#categoriaProducto').val(producto[0].categoria)
        $('#stock').html(`<strong>${producto[0].cantidad}</strong>`)
        $('#formulario').modal("show")

       })}else{
           return false
       }
   });
   $('#editarProducto').click(function(e){
        e.preventDefault();
        let id = $('#idProducto').val();
        let nombre = $('#nombreProducto').val();
        let codigo = $('#Codigo').val();
        let precioEmpleado = $('#precioEmpleado').val();
        let precioCliente = $('#precioCliente').val();
        let gananciaEmpleado = $('#gananciaEmpleado').val();
        let gananciaCasa = $('#gananciaCasa').val();
        let categoria = $('#categoriaProducto').val();
        let precioCompra = $("#precioCompra").val();
        const data = {
           id,
           nombre,
           codigo,
           precioEmpleado,
           precioCliente,
           gananciaCasa,
           gananciaEmpleado,
           categoria,
           precioCompra
       }
       console.log(data);
       if(edit === true){
       $.post("Backend/edit-products.php", data, function(response){
           alert(response);
           console.log(data)
           let numerodeEntradas = $('#numOfRecords').val();
           let pages = $('#pageNumber').val()
           load_data(pages,numerodeEntradas)
           $("#crearActualizarProductos").trigger('reset');
           edit = false
       })}


   });
   $('#showModal').click(function(e){
       e.preventDefault();
       $('#formulario').modal("show")
   });
   $('#crearProducto').click(function(e){
        e.preventDefault()
        let nombre = $('#nombreProducto').val();
        let codigo = $('#Codigo').val();
        let gananciaEmpleado = $('#gananciaEmpleado').val();
        let gananciaCasa = $('#gananciaCasa').val();
        let precioEmpleado = $('#precioEmpleado').val();
        let precioCliente = $('#precioCliente').val();
        let categoria = $('#categoriaProducto').val();
        let precioCompra = $("#precioCompra").val();    
       const data = {
           nombre,
           codigo,
           precioEmpleado,
           precioCliente,
           gananciaCasa,
           gananciaEmpleado,
           categoria,
           precioCompra
       };
       console.log(data);
       if(edit === false){
       $.post("Backend/create-products.php", data, function(response){
           alert(response);
           console.log(data+ response);
           let numerodeEntradas = $('#numOfRecords').val();
           let pages = $('#pageNumber').val()
           load_data(pages,numerodeEntradas)
           $("#crearActualizarProductos").trigger('reset');
       })}else{
           return false
       }
   });

   $('#precioEmpleado').on('change', function(){
    $('#gananciaCasa').val("0");
    $('#gananciaEmpleado').val("0");
   })

   $('#gananciaCasa').on('change', function(){
    let = precio = Number(parseFloat($('#precioEmpleado').val()).toFixed(2));
    
    let = gananciaCasa = Number(parseFloat($('#gananciaCasa').val()).toFixed(2));
    if(precio >= gananciaCasa){
    $('#gananciaEmpleado').val(precio - gananciaCasa);

    }else{
        $('#gananciaCasa').val(0)
        $('#gananciaEmpleado').val(0)
        alert('No se puede tener una ganancia mayor al precio total del servicio');
       
    }
})
$('#gananciaEmpleado').on('change', function(){
    let = precio = Number(parseFloat($('#precioEmpleado').val()).toFixed(2));
    let = gananciaEmpleado = Number(parseFloat($('#gananciaEmpleado').val()).toFixed(2));
    if(precio >= gananciaEmpleado){
    $('#gananciaCasa').val(precio-gananciaEmpleado);
  
    }else{
        $('#gananciaEmpleado').val("0")
        $('#gananciaCasa').val("0")
        alert('No se puede tener una ganancia mayor al precio total del servicio');
    }
})
$('#cerrarModal').on('click', function(){
    $("#crearActualizarProductos").trigger('reset');
})

})