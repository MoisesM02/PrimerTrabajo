$(function() {
    
$('#buscadorProductos').on('input', function(){
    let parametro = document.getElementById("buscadorProductos").value;
    
    $.post("Backend/search-products.php", {parametro},function(response){
    try{
    let res = JSON.parse(response);
    let nombres = [];
    res[0].forEach(producto => {
        nombres.push([producto.nombre, producto.id])
    });

    var objInput = document.getElementById('buscadorProductos');
    var strInput = objInput.value;

    var objSuggestionsDiv = document.getElementById("sugerencias");
    if(strInput.length > 0){
        objSuggestionsDiv.innerHTML = "";
        var objList = document.createElement("ul")

        for(var i = 0; i < nombres.length; i++){
            var word = nombres[i][0];
            var objListEntity = document.createElement("option");
            objListEntity.setAttribute("onclick", `complete('${word}', 'buscadorProductos', 'sugerencias', ${nombres[i][1]} );`);
            objListEntity.innerHTML = word;
            objList.appendChild(objListEntity);
        }
        objSuggestionsDiv.appendChild(objList);
    }else{
        objSuggestionsDiv.innerHTML = "";
    }
    }catch(error){
        alert(error.name + " " +error.message);
    }

});
})    
$('#buscar').on('click', function(){

    let id = $('#idProducto').val();
    if(id != null || id !== undefined || !id){
        $.post("Backend/select-single-product.php", {id}, function(response){
            try{
                let res = JSON.parse(response);
                let template = $('#listaProductos').html()
                if(template == undefined || template == "" || template == null || template.includes('<th>') !== true ){
                    template += `
                    <tr>
                    <th>Borrar</th>
                    <th>Nombre del producto</th>
                    <th>Costo</th>
                    <th>Cantidad</th>
                    <th>Descuento</th>
                    <th>Total</th>
                    </tr>
                    <tr id="remove${res[0].id}"> 
                    <td><a data-id="${res[0].id}" class="borrar" href="javascript:void(0)">Borrar</a></td>
                    <td><strong>${res[0].nombre}</strong>  Cantidad en inventario: <strong>${res[0].cantidad}</strong></td>
                    <td><input data-id = "${res[0].id}" data-producto="${res[0].nombre}" class="campo form-control" id="precioCompra${res[0].id}" type="text" value="${res[0].precioCompra}"/></td>
                    <td><input data-id = "${res[0].id}" data-producto="${res[0].nombre}" class="campo form-control" id="cantidad${res[0].id}" type="text" value="${res[0].cantidad}"/></td>
                    <td><input data-id = "${res[0].id}" data-producto="${res[0].nombre}" class="campo form-control" id="descuento${res[0].id}" type="text" value="0"/> </td>
                    <td><span id="total${res[0].id}">${res[0].precioCompra * res[0].cantidad}</span></td>
                    </tr>
                    `;
                    let nuevoTotalFactura = (res[0].cantidad*res[0].precioCompra)
                    $('#totalFactura').text(nuevoTotalFactura);
                }else{
                    template += `
                    
                    <tr id="remove${res[0].id}"> 
                    <td><a data-id="${res[0].id}" class="borrar" href="javascript:void(0)">Borrar</a></td>
                    <td><strong>${res[0].nombre}</strong> Cantidad en inventario: <strong>${res[0].cantidad}</strong></td>
                    <td><input data-id = "${res[0].id}" data-producto="${res[0].nombre}" class="campo form-control" id="precioCompra${res[0].id}" type="text" value="${res[0].precioCompra}"/></td>
                    <td><input data-id = "${res[0].id}" data-producto="${res[0].nombre}" class="campo form-control" id="cantidad${res[0].id}" type="text" value="${res[0].cantidad}"/></td>
                    <td><input data-id = "${res[0].id}" data-producto="${res[0].nombre}" class="campo form-control" id="descuento${res[0].id}" type="text" value="0"/> </td>
                    <td><span id="total${res[0].id}">${res[0].precioCompra * res[0].cantidad}</span></td>
                    </tr>
                    `;
                    let totalFactura = $('#totalFactura').text();
                    let nuevoTotalFactura = parseFloat(totalFactura) + (res[0].cantidad*res[0].precioCompra)
                    $('#totalFactura').text(nuevoTotalFactura);
                }
                $('#idProducto').val("");
                $('#buscadorProductos').val("");
                $('#listaProductos').html(template);
                
               
                
            }catch(error){
                alert(response);
            }
        });
    }
})
//Eliminar productos de la tabla
$(document).on('click', '.borrar',function(e){
    e.preventDefault();
    let id = $(this).attr("data-id");
    let precioTotalProductos = $(`#total${id}`).text();
    let precioTotalFactura = $('#totalFactura').text();
    let nuevoPrecioFactura = precioTotalFactura-precioTotalProductos;
    $('#totalFactura').text(nuevoPrecioFactura);
    $(`#remove${id}`).remove();
})



//Cambiar valores de cada producto y el total de la factura
$(document).on('change', '.campo', function(){

    let id = $(this).attr('data-id');
    let campo = $(this).attr('id');
    if(campo.includes('precioCompra')){
        let precio = $(this).val();
        let descuento = $(`#descuento${id}`).val();
        let cantidad = $(`#cantidad${id}`).val();
        let antiguoTotal = $(`#total${id}`).text();
        let nuevoPrecioProducto = precio*cantidad - (precio*cantidad*(descuento/100))
        let precioTotal = $('#totalFactura').text();
        let nuevoPrecioTotal = ((parseFloat(precioTotal)-antiguoTotal)+nuevoPrecioProducto);
        console.log(nuevoPrecioTotal);
        $(this).attr('value', precio);
        $(`#cantidad${id}`).attr('value',cantidad);
        $(`#descuento${id}`).attr('value',descuento);
        $(`#total${id}`).text(nuevoPrecioProducto);
        $('#totalFactura').text(nuevoPrecioTotal);
        
    }else if(campo.includes('cantidad')){
        let cantidad = $(this).val();
        let precio = $(`#precioCompra${id}`).val();
        let descuento = $(`#descuento${id}`).val();
        let antiguoTotal = $(`#total${id}`).text();
        let nuevoPrecioProducto = precio*cantidad - (precio*cantidad*(descuento/100))
        let precioTotal = $('#totalFactura').text();
        let nuevoPrecioTotal = ((parseFloat(precioTotal)-antiguoTotal)+nuevoPrecioProducto);
        console.log(nuevoPrecioTotal);
        $(this).attr('value', cantidad);
        $(`#precioCompra${id}`).attr('value',precio);
        $(`#descuento${id}`).attr('value',descuento);
        $(`#total${id}`).text(nuevoPrecioProducto);
        $('#totalFactura').text(nuevoPrecioTotal);
    }else if(campo.includes("descuento")){
        let descuento = $(this).val();
        let precio = $(`#precioCompra${id}`).val();
        let cantidad = $(`#cantidad${id}`).val();
        let antiguoTotal = $(`#total${id}`).text();
        let nuevoPrecioProducto = precio*cantidad - (precio*cantidad*(descuento/100))
        let precioTotal = $('#totalFactura').text();
        let nuevoPrecioTotal = ((parseFloat(precioTotal)-antiguoTotal)+nuevoPrecioProducto);
        console.log(nuevoPrecioTotal);
        $(this).attr('value', descuento);
        $(`#precioCompra${id}`).attr('value',precio);
        $(`#cantidad${id}`).attr('value',cantidad);
        $(`#total${id}`).text(nuevoPrecioProducto);
        $('#totalFactura').text(nuevoPrecioTotal);
    }
})
$('#enviarFactura').on('click', function(){
    let a = $('tr').find("input.campo");
    let aArray = Object.keys(a).map((key =>[Number(key), a[key]]));
    console.log(aArray);
    let i = 1;
    let array =[];
    let j = 0
    aArray.forEach(input =>{
        
        if(!isNaN(input[0])){
            if(i<=3){
            if(typeof(array[j]) == 'undefined'){
                array.push([]);
                array[j].push([$(`#${input[1].id}`).attr("data-producto"),$(`#${input[1].id}`).val(),$(`#${input[1].id}`).attr("data-id"), $('#username').val()]);
                if(i==3){
                    j=0;
                    i = 1;
                }else{i++}
            }else{
                array[j].push([$(`#${input[1].id}`).attr("data-producto"),$(`#${input[1].id}`).val(),$(`#${input[1].id}`).attr("data-id"), $('#username').val() ]);
               
                if(i==3){
                    j++
                    i = 1;
                }else{i++}  
        }
         
    }else{
       j++
       if(j == 2){
           j=0;
       }
    }
        }
    })
  $.post("Backend/addToKardex.php",{array}, function(response){
      alert(response);
  })
})
});