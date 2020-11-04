$(document).ready(function(){
let startDate = moment().startOf('day'); 
let endDate = moment();
cargarRegistros(1,10,"Todos",startDate.format('YYYY-MM-D HH:mm:ss'),endDate.format('YYYY-MM-D HH:mm:ss'));
$('#reportrange span').html(startDate.format('D MMMM YYYY') + ' - ' + endDate.format('D MMMM YYYY'));


cargarSelect()
$('#disponibles').on('change', function(){
    cargarSelect();
})
// Llenar Select
function cargarSelect(){
    
    let disponibles = $('#disponibles').prop('checked');
    disponibles = (disponibles === false) ? false : true;
    let direccion = (disponibles) ? 'Backend/select-empleadas-disponibles.php' : 'Backend/select-all-empleadas.php';
    console.log(direccion);
    const data = (disponibles) ? {'now' : moment().format('YYYY-MM-D HH:mm:ss')} :{};
    $.post(direccion, data, function(response){
        try{
            let res = JSON.parse(response);
            let template = "<option value='Todos'>Todas</option>";
            res.forEach(empleada => {
                template += `
                <option value = "${empleada.nombreEmpleada}">${empleada.nombreEmpleada} </option>
                `;
            })
            $('#Empleada').html(template)   
        }catch(e){
            alert(response)
        }
    })
} 


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
    template = `<center><table id='tablaDeDatos' style='cursor:pointer' class ='table table-striped table-bordered'>
    <thead class='thead-dark'>
    <tr>
    <th>Empleada</th>
    <th>Servicio prestado</th>
    <th>Tipo</th>
    <th>Usuario</th>
    <th>Precio de servicio</th>
    <th>Ganancia de empleada</th>
    <th>Ganancia de casa</th>
    <th>Descuentos a empleada</th>
    <th>Pago total a empleada</th>
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
        <td>$${entrada.gananciaCasa}</td>
        <td>$${entrada.descuentosEmpleada}</td>
        <td>$${entrada.totalEmpleada}</td>
        <td>${entrada.fechaInicio}</td>
        <td>${entrada.fechaFinal}</td>
        <td>${entrada.habitacion}</td>
        <td>${entrada.tiempo}</td>
        </tr>
        `;
    });
    if(res[1].nombreEmpleada != "Todos"){
        template += ` <tr>
        <td>Total de ganancia</td>
        <td></td>
        <td></td>
        <td></td>
        <td>$${totalServicios}</td>
        <td>$${sumaEmpleada}</td>
        <td>$${sumaCasa}</td>
        <td>$${descuentosEmpleada}</td>
        <td>$${totalEmpleada}</td>
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
    
    var records_per_page = $('#numOfRecords').val();
    load_data(page, records_per_page)
})
$('#records_numbers').on('change', function(){
 let val =  $('#records_numbers').val()
 $('#numOfRecords').val(val);
 let pgnumber = 1
 load_data(pgnumber, val);
})

// Datepicker
    $('#reportrange span').daterangepicker(
        {
           startDate: moment().subtract(29, 'days'),
           endDate: moment(),
           
           showDropdowns: true,
           showWeekNumbers: true,
           timePicker: true,
           timePickerIncrement: 1,
           timePicker24Hour: true,
           
           opens: 'left',
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
     $('#reportrange span').html(moment().subtract(0, 'days').format('D MMMM YYYY') + ' - ' + moment().format('D MMMM YYYY'));
 
     $('#saveButton').click(function(){

        let inicio = startDate.format('YYYY-MM-D HH:mm:ss')
        let final =  endDate.format('YYYY-MM-D HH:mm:ss')
        let empleada = $("#Empleada").val(); 
        let numerodeEntradas = $('#numOfRecords').val();
        let pages = $('#pageNumber').val();
         //console.log(startDate.format('YYYY-MM-D hh:mm:ss') + ' - ' + endDate.format('YYYY-MM-D hh:mm:ss')); //Así se obtienen los datos
         cargarRegistros(pages, numerodeEntradas, empleada, inicio, final)


     });
 
  });
// })