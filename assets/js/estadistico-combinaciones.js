var url_ajax;
var options_lineal;

$(document).on({
  ajaxStart: function() {  $("body").addClass("loading");    },
  ajaxStop: function() {  $("body").removeClass("loading"); }    
});

$(function () {
  options_lineal={
    title: {
        x: -20 //center
    },
    subtitle: {
        x: -20
    },
    xAxis: {
        categories: []
        // categories: [1988,1989,1990,1991,1992,1993,1994,1995,1996,1997,1998,1999,2000,2001,2002,2003,2004,2005,2006,2007,2008,2009,2010,2011,2012,2013,"2014(p)"]
    },
    yAxis: {
        title: {},
        plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
        }]
    },
    tooltip: {
        valueSuffix: ''
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle',
        borderWidth: 0
    },
    series: [{}]
    /*
    series: [{
      "name": "TOTAL COPARTICIPACION",
      "data": [0,0,0,0,0,0,72.06,166.66,211.37,240.85,278.87,256.68,289.41,276.26,298.27,329.94,425.88,463.99,573.85,700.13,904.5,851.16,992.01,1271.26,1588.32,1824.79,2080.34]
    }]
    */
  };
});

// BEGIN:VISTA_CONBINACIONES

var actividad1, indicador1, medicion;

$('#actividad1').on('change',function(){
  url_ajax=$('#form-combinaciones').attr('action');
  actividad1=$(this).val();
  console.log("ACTIVIDAD ECONOMICA 1");
  console.log("ACTIVIDAD:"+actividad1);
  console.log("===========================");
  $.ajax({
    url: url_ajax,
    data: { proceso : 'buscaIndicador', actividad : actividad1 },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      console.log(data);
      $('#indicador1').html(data);
      $('#indicador1').append('<option value="0" selected="selected" style="display: none;">Seleccione indicador...</option>');
      $('#indicador1').attr('disabled',false);
    },
  });
  desactivarComboBox(['medicion','ini','fin','actividad2','indicador2']);
  $('#btn-comparar').attr('disabled',true);
});

$('#indicador1').on('change',function(){
  indicador1=$(this).val();
  console.log("INDICADOR");
  console.log("indicador1:"+indicador1);
  console.log("===========================");
  $.ajax({
    url: url_ajax,
    data: { proceso : 'buscaMedicionIndicador', actividad : actividad1, indicador:indicador1 },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('#medicion').html(data);
      $('#medicion').append('<option value="0" selected="selected" style="display: none;">Seleccione indicador...</option>');
      $('#medicion').attr('disabled',false);  
    },
  });
  desactivarComboBox(['ini','fin','actividad2','indicador2']);
  $('#btn-comparar').attr('disabled',true);
});

$('#medicion').on('change',function(){
  medicion=$(this).val();
  $.ajax({
    url: url_ajax,
    data: { proceso : 'buscaPeriodicidadGeneral', medicion : medicion },
    type : 'POST',
    dataType : 'json',
    success : function(data) {
      console.log(data);
      var out='';
      for(i=0;i<data.periodos.length;i++){
        out+='<option  value="'+data.periodos[i].key+'">'+data.periodos[i].value+'</option>';
      }      
      $('#ini').html(out);
      $('#fin').html(out);
      $('#fin option:last').attr("selected", "selected");
      $('#ini').attr('disabled',false);
      $('#fin').attr('disabled',false);
      out='';
      for(i=0;i<data.actividades.length;i++){
        out+='<option  value="'+data.actividades[i].actividad+'">'+data.actividades[i].actividad+'</option>';
      }
      $('#actividad2').html(out);
      $('#actividad2').append('<option value="0" selected="selected" style="display: none;">Seleccione actividad...</option>');
      $('#actividad2').attr('disabled',false);
    },
  });
  desactivarComboBox(['indicador2']);
  $('#btn-comparar').attr('disabled',true);
});

$('#actividad2').on('change',function(){
  var actividad2=$(this).val();
  console.log("ACTIVIDAD ECONOMICA 2");
  console.log("ACTIVIDAD:"+actividad2);
  console.log("===========================");
  /*
  $.ajax({
    url: url_ajax,
    data: { proceso : 'buscaIndicador', actividad : actividad2 },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      console.log(data);
      $('#indicador2').html(data);
      $('#indicador2').append('<option value="0" selected="selected" style="display: none;">Seleccione indicador...</option>');
      $('#indicador2').attr('disabled',false);
    },
  });
  */
});



$('#indicador2').on('change',function(){

});

$('#btn-comparar').on('click',function(event){
  event.preventDefault();
  if($('input:checkbox:checked').length>=2){
    $('.box-alert').hide();
    url_ajax=$('#form-combinaciones').attr('action');
    var frm=$('#form-combinaciones').serialize();
    $.ajax({
      url: url_ajax,
      data: frm,
      type : 'POST',
      dataType : 'json',
      success : function(data) {
        $('.resultados-combinacion').show();
        // AGREGANDO NOMBRES DE COLUMNAS
        var out='<th>Gestión</th>';
        for(i=0;i<data.serie.length;i++){
          out+="<th>"+data.serie[i].name+"</th>";
        }
        $('#cuadro-1 thead tr').html(out);
        // AGREGANDO VALORES A LAS COLUMNAS
        var out='';
        for(i=0;i<data.categorias.categories.length;i++){
          out+='<tr>';
          out+="<td>"+data.categorias.categories[i]+"</td>";
          for (j=0;j<data.serie.length;j++){
            out+="<td>"+data.serie[j].data[i]+"</td>";  
          }
          out+='</tr>';
        }
        $('#cuadro-1 tbody').html(out);
        /*
        //================================================
        for(i=0;i<data.serie.length;i++) {
          // console.log(data.serie[i].data.length);
          console.log(data.serie[i].name);
          for(j=0;j<data.serie[i].data.length;j++){
            console.log(data.serie[i].data[j]);
          }
        }
        //================================================
        */
        options_lineal.series=data.serie;
        char_lineal=Highcharts.chart('container-grafico-lineal',options_lineal);
        char_lineal.update({
          title: data.titulo,
          subtitle: data.subtitulo,
          xAxis: data.categorias,
          yAxis: {
            title: data.tituloy,
            plotLines: [{
              value: 0,
              width: 1,
              color: '#808080'
            }]
          },
        });
        
      },
    });
  }else{
    $('.box-alert .callout').text('Seleccione mas de un indicador para realizar la comparación.');
    $('.box-alert').show();
    $('.resultados-combinacion').hide();
  }
  return false;
});
// END:VISTA_CONBINACIONES


/************************************************
* BEGIN : FUNCIONES
*************************************************/
function desactivarComboBox(controles){
  for(i=0;i<controles.length;i++){
    $('#'+controles[i]).html('<option value="0" selected="selected" style="display: none;">Seleccione '+controles[i]+'...</option>');
    $('#'+controles[i]).attr('disabled',true);
  }
}
/************************************************
* END   : FUNCIONES
*************************************************/
