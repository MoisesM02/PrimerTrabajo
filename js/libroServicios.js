$(document).ready(function(){
moment.locale('es');
let startDate = moment().startOf('day'); 
let endDate = moment();
let initialDate =moment(); 
let finalDate = moment(); 
cargarRegistros(1,10,"Todos",startDate.format('YYYY-MM-D HH:mm:ss'),endDate.format('YYYY-MM-D HH:mm:ss'));
$('#reportrange span').html(startDate.format('D MMMM YYYY') + ' - ' + endDate.format('D MMMM YYYY'));


cargarSelect();
cargarSelectServicios();
cargarHabitaciones();
$('#disponibles').on('change', function(){
    cargarSelect();
})
$('#habitacionesDisponibles').on('change', function(){
    cargarHabitaciones();
})

function cargarHabitaciones(){
    let habitacionesDisponibles = $('#habitacionesDisponibles').prop('checked');
    console.log(habitacionesDisponibles)
    const data = (habitacionesDisponibles) ? {'now' : moment().format('YYYY-MM-D HH:mm:ss')} : {};
    $.post("Backend/select-habitaciones-disponibles.php", data, function(response){
        try {
            let habitaciones = JSON.parse(response);
            let template = ""
            habitaciones.forEach(habitacion =>{
                template += `<option value ="${habitacion.habitacion}">${habitacion.habitacion}</option>`;
            })
            $('#habitacion').html(template);
        } catch (error) {
            alert(response);
        }
    })
}


// Llenar Select Empleadas
function cargarSelect(){
    
    let disponibles = $('#disponibles').prop('checked');
    disponibles = (disponibles === false) ? false : true;
    let direccion = (disponibles) ? 'Backend/select-empleadas-disponibles.php' : 'Backend/select-all-empleadas.php';
    console.log(direccion);
    const data = (disponibles) ? {'now' : moment().format('YYYY-MM-D HH:mm:ss')} :{};
    $.post(direccion, data, function(response){
        try{
            let res = JSON.parse(response);
            let template;
            if(direccion == 'Backend/select-all-empleadas.php'){
            template = "<option value='Todos'>Todas</option>";
            }
            
            res.forEach(empleada => {
                template += `
                <option value = "${empleada.nombreEmpleada}">${empleada.nombreEmpleada} </option>
                `;
            })
            $('.Empleadas').html(template)   
        }catch(e){
            alert(response)
        }
    })
} 

function cargarSelectServicios(){
    $.get("Backend/select-servicios.php",function(response){
        try{
        let servicios = JSON.parse(response);
        let template = `<option></option>`;
        servicios.forEach(servicio =>{
            template += `<option data-name="${servicio.nombreServicio}" value="${servicio.id}">${servicio.nombreServicio}</option>`
        })
        $('#servicioPrestado').html(template);
    }catch(e){
        alert(response);
    }
    })
}

$('#servicioPrestado').on('change', function(e){
    e.preventDefault();
    let id = $('#servicioPrestado').val();
    $.post("Backend/fill-services-form.php", {id}, function(response){
        try{
            let servicio = JSON.parse(response);
            console.log(servicio[0].id);
            $('#duracion').val(servicio[0].tiempo);
            $('#tipoServicio').val(servicio[0].tipo);
            $('#precioServicio').val(servicio[0].precioTotal);
            $('#gananciaCasa').val(servicio[0].gananciaCasa);
            $('#gananciaEmpleado').val(servicio[0].gananciaEmpleado);

        }catch(e){
            console.log(response + e.getMessage());
        }
    })
})
//Agregar al registro





//Cargar Tabla
function cargarRegistros(pageNumber, records, empleada, fechaInicio, fechaFinal){
    let direccion = "Backend/read-services-book.php";
const data = {
    pageNumber,
    records,
    empleada,
    fechaInicio,
    fechaFinal
};

$.post(direccion,data, function(response){
  
    try{
    let res = JSON.parse(response)
    let entradas = (res[0])
    let template = "";
    template = `<center><table id='tablaDeDatos' style='cursor:pointer' class ='table table-striped '>
    <thead class='thead-dark'>
    <tr>
    <th>Empleada</th>
    <th>Servicio prestado</th>
    <th>Tipo</th>
    <th>Usuario</th>
    <th>Precio de servicio</th>
    <th>Ganancia de empleada</th>
    <th>Descuentos por Limpieza</th>
    <th>Pago total a empleada</th>
    <th>Ganancia de casa</th>
    <th>Fecha y hora de inicio</th>
    <th>Fecha y hora de culminación</th>
    <th>Habitación</th>
    <th>Duración de servicio</th>
    </tr>
    </thead>
    <tbody>`;
    let sumaEmpleada = 0;
    let sumaCasa = 0;
    let descuentosEmpleada = 0;
    let totalEmpleada = 0;
    let totalServicios = 0;
    entradas.forEach(entrada => {
        sumaEmpleada = sumaEmpleada + parseInt(entrada.gananciaEmpleada);
        descuentosEmpleada = descuentosEmpleada + parseInt(entrada.descuentosEmpleada)
        sumaCasa = sumaCasa + parseInt(entrada.gananciaCasa);
        totalEmpleada += parseInt(entrada.totalEmpleada);
        totalServicios += parseInt(entrada.precioFinal);
        template += `
        <tr>
        <td>${entrada.nombre}</td>
        <td>${entrada.servicioPrestado}</td>
        <td>${entrada.tipo}</td>
        <td>${entrada.usuario}</td>
        <td>$${entrada.precioFinal}</td>
        <td>$${entrada.gananciaEmpleada}</td>
        <td>$${entrada.descuentosEmpleada}</td>
        <td>$${entrada.totalEmpleada}</td>
        <td>$${entrada.gananciaCasa}</td>
        <td>${entrada.fechaInicio}</td>
        <td>${entrada.fechaFinal}</td>
        <td>${entrada.habitacion}</td>
        <td>${entrada.tiempo}</td>
        </tr>
        `;
    });
    if(res[1].nombreEmpleada != "Todos"){
        template += ` <tr class ="table-primary">
        <td>Total de ganancia</td>
        <td></td>
        <td></td>
        <td></td>
        <td>$${totalServicios}</td>
        <td>$${sumaEmpleada}</td>
        <td>$${descuentosEmpleada}</td>
        <td>$${totalEmpleada}</td>
        <td>$${sumaCasa}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>`;
    }
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
}catch(e){
    $('#paginationData').html(response);
}
})
}

//Selección de página y entradas por página
$(document).on('click', '.pagination-link', function(){
    var page = $(this).attr('data-page');
    $('#PageNumber').val(page)
    var empleada = $('#Empleada').val()
    var records_per_page = $('#numOfRecords').val();
    cargarRegistros(page, records_per_page,empleada ,startDate.format('YYYY-MM-D HH:mm:ss'), endDate.format('YYYY-MM-D HH:mm:ss'))
})
$('#records_numbers').on('change', function(){
 let val =  $('#records_numbers').val()
 var empleada = $('#Empleada').val()
 $('#numOfRecords').val(val);
 let pgnumber = 1
 cargarRegistros(pgnumber, records_per_page,empleada ,startDate.format('YYYY-MM-D HH:mm:ss'), endDate.format('YYYY-MM-D HH:mm:ss'));
})

//Mostrar Modal para crear una entrada




// Datepicker
    $('#reportrange span').daterangepicker(
        {
           startDate: moment().startOf('day'),
           endDate: moment(),
           
           showDropdowns: true,
           showWeekNumbers: true,
           timePicker: true,
           timePickerIncrement: 1,
           timePicker24Hour: true,
           
           opens: 'center',
           buttonClasses: ['btn btn-default'],
           applyClass: 'btn-small btn-primary',
           cancelClass: 'btn-small',
           dateFormat: 'DD-MMMM-YYYY:',
           timeFormat:  "hh:mm:ss",
           separator: ' Hasta ',
           locale: {
               applyLabel: 'Confirmar',
               fromLabel: 'Desde',
               toLabel: 'Hasta',
               customRangeLabel: 'Rango específico',
               daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi','Sa'],
               monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
               firstDay: 1
           }
        },
        function(start, end) {
         $('#reportrange span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
         startDate = start;
          endDate = end;    
 
        }
     );
     //Set the initial state of the picker label
     $('#reportrange span').html(moment().format('LL') + ' - ' + moment().format('D MMMM YYYY'));
 
     $('#saveButton').click(function(){

        let inicio = startDate.format('YYYY-MM-D HH:mm:ss')
        let final =  endDate.format('YYYY-MM-D HH:mm:ss')
        let empleada = $("#Empleada").val(); 
        let numerodeEntradas = $('#numOfRecords').val();
        let pages = $('#pageNumber').val();
        cargarRegistros(pages, numerodeEntradas, empleada, inicio, final)
     });



//Formulario para añadir
        $('#addService').click(function(e){
            e.preventDefault();
                let duracion =$('#duracion').val()
                let tipo = $('#tipoServicio').val()
                let username = $('#username').val()
                let habitacion = $('#habitacion').val()
                let descuentos = $('#descuentos').val()
                let nombreServicio = $('#servicioPrestado').find(':selected').attr('data-name')
                let nombreEmpleada = $('#nombreEmpleada').val()
                let precioServicio = $('#precioServicio').val()
                let gananciaCasa = $('#gananciaCasa').val()
                let gananciaEmpleado = $('#gananciaEmpleado').val()
                let fechaInicio = initialDate.format('YYYY-MM-D HH:mm:ss');
                let fechaFinal = finalDate.format('YYYY-MM-D HH:mm:ss');
                const data ={
                    duracion,
                    tipo,
                    username,
                    habitacion,
                    descuentos,
                    nombreServicio,
                    nombreEmpleada,
                    precioServicio,
                    gananciaCasa,
                    gananciaEmpleado,
                    fechaInicio,
                    fechaFinal
                };
                $.post("Backend/create-services-book.php", data, function(response){
                    alert(response)
                    cargarSelect();
                    $('#addToRegisterBook').trigger('reset');
                    $('#habitacionesDisponibles').prop('checked', false).change();
                    cargarHabitaciones();
                    
                    
                })
            })
    


// Deshabilitar los textbox
        $('#duracion').attr('disabled', 'disabled'); 
        $('#tipoServicio').attr('disabled', 'disabled'); 
        $('#precioServicio').attr('disabled', 'disabled'); 
        $('#gananciaCasa').attr('disabled', 'disabled'); 
        $('#gananciaEmpleado').attr('disabled', 'disabled'); 




        $('#showModal').click(function(e){
            e.preventDefault();
            edit = false;
            console.log()
            $('#formulario').modal("show")
        });


     $('#dateRange span').daterangepicker(
        {
           startDate: moment(),
           endDate: moment(),
           
           showDropdowns: true,
           showWeekNumbers: true,
           timePicker: true,
           timePickerIncrement: 1,
           timePicker24Hour: true,
           
           opens: 'center',
           buttonClasses: ['btn btn-default'],
           applyClass: 'btn-small btn-primary',
           cancelClass: 'btn-small',
           dateFormat: 'DD-MMMM-YYYY:',
           timeFormat:  "hh:mm:ss",
           separator: ' Hasta ',
           minDate: moment().format('YYYY-MM-D HH:mm:ss'),
           locale: {
               applyLabel: 'Confirmar',
               cancelLabel: 'Cancelar',
               fromLabel: 'Desde',
               toLabel: 'Hasta',
               customRangeLabel: 'Rango específico',
               daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi','Sa'],
               monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
               firstDay: 1
           }
        },
        function(start, end) {
         $('#dateRange span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
        initialDate = start;
        finalDate = end;    
 
        }
     );
     //Set the initial state of the picker label
     $('#dateRange span').html(moment().subtract(0, 'days').format('D MMMM YYYY') + ' - ' + moment().format('D MMMM YYYY'));
 



 
  });
// })