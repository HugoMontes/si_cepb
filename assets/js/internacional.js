var url_ajax;
//var tabla, desagregacion, medicion, cobertura, indicador, descripcion, id_indicador, titulo, i, ini, fin;
var tabla, pais1, pais2;

$(document).ready(function(){
  $('.resultados').hide();
  $('#btn-excel').hide();
});

$(document).on({
  ajaxStart: function() {  $("body").addClass("loading");    },
  ajaxStop: function() {  $("body").removeClass("loading"); }    
});

$('#fuente').on('change',function(){
  url_ajax=$('#form-estadistico').attr('action');
  tabla=$(this).val();
  console.log("PROCESO 1");
  console.log("Fuente");
  console.log("Tabla:"+tabla);
  console.log("===========================");
  $.ajax({
    url: url_ajax,
    data: { proceso : 'buscaPaises', tabla : tabla },
    type : 'POST',
    dataType : 'json',
    success : function(data) {
      var out_paises='';
      for(i=0;i<data.paises.length;i++){
        out_paises+='<option value="'+data.paises[i]+'">'+data.paises[i]+'</option>';
      }
      $('#pais1').html(out_paises);
      $('#pais1').append('<option value="0" selected="selected" style="display: none;">Seleccione pais...</option>');
      $('#pais1').attr('disabled',false);
      $('#pais2').html(out_paises);
      $('#pais2').append('<option value="0" selected="selected" style="display: none;">Seleccione pais...</option>');
      $('#pais2').attr('disabled',false);
      $('#btn-excel').attr('href',data.ruta_xls);
    },
  });
  $('#btn-excel').show();
  desactivarComboBox(['descripcion','periodo']);
  $('#btn-enviar').attr('disabled',true);
});


$('#pais1').on('change',function(){
  if($('#pais2').val()!="0"){
    solicitarDescripcion(); 
  }
});

$('#pais2').on('change',function(){
  if($('#pais1').val()!="0"){
    solicitarDescripcion();
  }
});

function solicitarDescripcion(){
  $.ajax({
    url: url_ajax,
    data: { proceso : 'buscaDescripcion', tabla : tabla},
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      // console.log(data);
      $('#descripcion').html(data);
      $('#descripcion').append('<option value="0" selected="selected" style="display: none;">Seleccionar descripcion...</option>');
      $('#descripcion').attr('disabled',false);      
    },
  });
  desactivarComboBox(['periodo']);
  $('#btn-enviar').attr('disabled',true);
}

$('#descripcion').on('change',function(){
  id_indicador=$(this).val();
  console.log('Clasificacion: '+id_indicador);
  console.log("===========================");
  $.ajax({
    url: url_ajax,
    data: { proceso : 'buscaPeriodicidad', tabla : tabla},
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('#periodo').html(data);
      $('#periodo').attr('disabled',false);   
    },
  });
  $('#btn-enviar').attr('disabled',false);
});

$(document).on('click','#btn-enviar',function(event){
  event.preventDefault();
  descripcion=$('#descripcion').val();
  pais1=$('#pais1').val();
  pais2=$('#pais2').val();
  periodo=$("#periodo").val();
  console.log('Tabla: '+tabla);
  console.log('Pais1: '+pais1);
  console.log('Pais2: '+pais2);
  console.log('Descripcion: '+descripcion);
  console.log('Periodo: '+periodo);
  
  $.ajax({
    url: url_ajax,
    data: { proceso:'imprimirResultados', tabla:tabla, pais1:pais1, pais2:pais2, descripcion:descripcion, periodo:periodo},
    type : 'POST',
    dataType : 'json',
    success : function(data) {
      $('.resultados').show();
      $('.cuadro-title').html(data.title);
      $('.cuadro-subtitle').html('Periodo '+data.subtitle);
      $('.col-nombre-descripcion').html(data.descripcion);
      $('.col-head-pais1').html(data.pais1.nombre);
      $('.col-head-pais2').html(data.pais2.nombre);
      $('.col-monto-pais1').html(data.pais1.monto);
      $('.col-monto-pais2').html(data.pais2.monto);
    },
  });
  
});

// HASTA AQUI LOS METODOS FUERON MEJORADOS **********************************
$(document).on('click','.btn-descargar',function(event){
  event.preventDefault();
  var url_pdf=$(this).attr('href');
  url_pdf+='&tabla='+tabla+'&ini='+ini+'&fin='+fin+'&id='+id_indicador;
  $(location).attr('href', url_pdf);
});

// validar el select de tiempos
/*
function ShowSelected(){
  // Para obtener el valor
  var cod1 = document.getElementById("ini").value;
  var cod2 = document.getElementById("fin").value;
  if (cod2 <= cod1) {  
    //alert("Seleccion errónea \nPeriodo [año menor] al [año mayor]");
    // document.getElementById("ini").focus();
  }
}
*/

// BEGIN: FUNCION DESACTIVAR COMBOBOX
function desactivarComboBox(controles){
  for(i=0;i<controles.length;i++){
    $('#'+controles[i]).html('<option value="0" selected="selected" style="display: none;">Seleccione '+controles[i]+'...</option>');
    $('#'+controles[i]).attr('disabled',true);
  }
}
// END: FUNCION DESACTIVAR COMBOBOX
