// ARCHIVO JS ESTADISTICO

var url_ajax;
var tabla, desagregacion, medicion, cobertura, indicador, titulo, departamental, indicador2, descripcion, i, ini, fin;

$(document).ready(function(){
  $('.resultados').hide();
  $('#btn-excel').hide();
    //indicador=$('.select-grupo').val();
    //departamental=$('.select-cobertura').val();
    //indicador2=$('.select-indicador').val();
});

$(document).on({
  ajaxStart: function() {  $("body").addClass("loading");    },
  ajaxStop: function() {  $("body").removeClass("loading"); }    
});

$('#actividad').on('change',function(){
  url_ajax=$('#form-estadistico').attr('action');
  var id=$(this).val();
  console.log("PROCESO 1");
  console.log("Actividad Economica");
  console.log("Tabla: actividad_economica");
  console.log("ID: "+id);
  console.log("===========================");
  $.ajax({
    url: url_ajax,
    data: { proceso : 'buscaGrupo', id : id },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('#grupo').html(data);
      $('#grupo').append('<option value="0" selected="selected" style="display: none;">Seleccione un grupo...</option>');
      $('#grupo').attr('disabled',false);
    },
  });
  $('#btn-excel').hide();
  desactivarComboBox(['desagregacion','medicion','cobertura','indicador','descripcion','ini','fin']);
  $('#btn-enviar').attr('disabled',true);
});

/*
$('.select-grupo').on('change',function(){
  //url_ajax=$('#form-estadistico').attr('action');
  indicador=$(this).val();
  titulo=$('.select-grupo option:selected').text();
  console.log('PROCESO 2');
  console.log('Grupo: '+titulo);
  console.log('Tabla indicador: '+indicador);  
  $.ajax({
    url: url_ajax,
    data: { proceso : 1, indicador : indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.select-indicador').html(data);
      $('.select-indicador').append('<option value="0" selected="selected" style="display: none;">Seleccione el indicador...</option>');
      $('.select-indicador').attr('disabled',false);
    },
  });
  $('#btn-excel').hide();
  $('.select-cobertura').html('<option value="0" selected="selected" style="display: none;">Seleccione la cobertura...</option>');
  $('.select-cobertura').attr('disabled',true);
  $('.select-descripcion').html('<option value="0" selected="selected" style="display: none;">Seleccione una descripcion...</option>');
  $('.select-descripcion').attr('disabled',true);
  $('.select-ini').html('<option value="0" selected="selected" style="display: none;">Periodo inicial...</option>');
  $('.select-ini').attr('disabled',true);
  $('.select-fin').html('<option value="0" selected="selected" style="display: none;">Periodo final...</option>');
  $('.select-fin').attr('disabled',true);
  $('#btn-enviar').attr('disabled',true);
});
*/

$('#grupo').on('change',function(){
  tabla=$(this).val();
  titulo=$('.select-grupo option:selected').text();
  console.log('PROCESO 2');
  console.log('Grupo: '+titulo);
  console.log('Tabla: '+tabla);
  console.log("===========================");
  $.ajax({
    url: url_ajax,
    data: { proceso : 'buscaDesagregacion', tabla : tabla },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('#desagregacion').html(data);
      $('#desagregacion').append('<option value="0" selected="selected" style="display: none;">Seleccione desagregacion...</option>');
      $('#desagregacion').attr('disabled',false);      
    },
  });
  $('#btn-excel').hide();
  desactivarComboBox(['medicion','cobertura','indicador','descripcion','ini','fin']);
  $('#btn-enviar').attr('disabled',true);
});

$('#desagregacion').on('change',function(){
  desagregacion=$(this).val();
  console.log('PROCESO 3');
  console.log('Desagreacion: '+desagregacion);
  console.log("===========================");
  $.ajax({
    url: url_ajax,
    data: { proceso : 'buscaMedicion', tabla : tabla, desagregacion : desagregacion },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('#medicion').html(data);
      $('#medicion').append('<option value="0" selected="selected" style="display: none;">Seleccione medicion...</option>');
      $('#medicion').attr('disabled',false);
    },
  });
  $('#btn-excel').hide();
  desactivarComboBox(['cobertura','indicador','descripcion','ini','fin']);
  $('#btn-enviar').attr('disabled',true);
});

$('#medicion').on('change',function(){
  medicion=$(this).val();
  console.log('PROCESO 4');
  console.log('Medicion: '+medicion);
  console.log("===========================");
  $.ajax({
    url: url_ajax,
    data: { proceso : 'buscaCobertura', tabla : tabla, desagregacion : desagregacion, medicion : medicion },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('#cobertura').html(data);
      $('#cobertura').append('<option value="0" selected="selected" style="display: none;">Seleccione cobertura...</option>');
      $('#cobertura').attr('disabled',false);
    },
  });
  $('#btn-excel').hide();
  desactivarComboBox(['indicador','descripcion','ini','fin']);
  $('#btn-enviar').attr('disabled',true);
});

$('#cobertura').on('change',function(){
  cobertura=$(this).val();
  console.log('PROCESO 5');
  console.log('Cobertura: '+cobertura);
  console.log("===========================");
  $.ajax({
    url: url_ajax,
    data: { proceso : 'buscaIndicador', tabla : tabla, desagregacion : desagregacion, medicion : medicion, cobertura : cobertura },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('#indicador').html(data);
      $('#indicador').append('<option value="0" selected="selected" style="display: none;">Seleccione indicador...</option>');
      $('#indicador').attr('disabled',false);
    },
  });
  $('#btn-excel').hide();
  desactivarComboBox(['descripcion','ini','fin']);
  $('#btn-enviar').attr('disabled',true);
});

$('#indicador').on('change',function(){
  indicador=$(this).val();
  console.log('PROCESO 5');
  console.log('Indicador: '+indicador);
  console.log("===========================");
  $('#btn-excel').show();
});
// HASTA AQUI LOS METODOS FUERON MEJORADOS **********************************

$('.select-cobertura').on('change',function(){
  departamental=$(this).val();
  console.log('PROCESO 3');
  // console.log('Indicador: '+indicador);
  console.log('Cobertura: '+departamental);
  $.ajax({
    url: url_ajax,
    data: { proceso : 3, indicador : indicador, departamental: departamental, indicador2:indicador2},
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      /*
      $('.select-indicador').html(data);
      $('.select-indicador').append('<option value="0" selected="selected" style="display: none;">Seleccione el indicador...</option>');
      */
      $('.select-descripcion').html(data);
      $('.select-descripcion').append('<option value="0" selected="selected" style="display: none;">Seleccione una descripcion...</option>');
      $('.select-descripcion').attr('disabled',false);
    },
  });
  // $('.select-indicador').attr('disabled',false);
  $('.select-descripcion').html('<option value="0" selected="selected" style="display: none;">Seleccione una descripcion...</option>');
  $('.select-descripcion').attr('disabled',true);
  $('.select-ini').html('<option value="0" selected="selected" style="display: none;">Periodo inicial...</option>');
  $('.select-ini').attr('disabled',true);
  $('.select-fin').html('<option value="0" selected="selected" style="display: none;">Periodo final...</option>');
  $('.select-fin').attr('disabled',true);
  $('#btn-enviar').attr('disabled',true);
});

$('.select-indicador').on('change',function(){
  indicador2=$(this).val();
  console.log('PROCESO 2');
  console.log('Titulo Indicador 2: '+indicador2); 
  $.ajax({
    url: url_ajax,
    data: { proceso : 2, indicador:indicador, indicador2:indicador2 },
    type : 'POST',
    dataType : 'json',
    success : function(data) {
      $('#btn-excel').attr('href',data.ruta_xlsx);
      var out='';
      for(i=0;i<data.cobertura.length;i++) {
        out+='<option value="'+data.cobertura[i]+'">'+data.cobertura[i]+'</option>';
      }
      $('.select-cobertura').html(out);
      $('.select-cobertura').append('<option value="0" selected="selected" style="display: none;">Seleccione la cobertura...</option>');
      $('.select-cobertura').attr('disabled',false); 
    },
  });
  /*
  $('.select-descripcion').attr('disabled',false);
  */
  $('#btn-excel').show();
  $('.select-descripcion').html('<option value="0" selected="selected" style="display: none;">Seleccione una descripcion...</option>');
  $('.select-descripcion').attr('disabled',true);
  $('.select-ini').html('<option value="0" selected="selected" style="display: none;">Periodo inicial...</option>');
  $('.select-ini').attr('disabled',true);
  $('.select-fin').html('<option value="0" selected="selected" style="display: none;">Periodo final...</option>');
  $('.select-fin').attr('disabled',true);
  $('#btn-enviar').attr('disabled',true);
});





$('.select-descripcion').on('change',function(){
  descripcion=$(this).val();
  console.log('PROCESO 4');
  console.log('Indicador: '+indicador);
  console.log('Departamental: '+departamental);
  console.log('Indicador2: '+indicador2);
  console.log('Descripcion: '+descripcion); 
  $.ajax({
    url: url_ajax,
    data: { proceso : 4, indicador:indicador, departamental:departamental, indicador2:indicador2, descripcion:descripcion },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.select-ini').html(data);
      $('.select-fin').html(data);
      $('.select-fin option:last').attr("selected", "selected");
      // console.log(data);
    },
  });
  $('.select-ini').attr('disabled',false);
  $('.select-fin').attr('disabled',false);
  $('#btn-enviar').attr('disabled',false);
});

$(document).on('click','#btn-enviar',function(event){
  event.preventDefault();
  $('.resultados').show();
  ini=$('#ini').val();
  fin=$('#fin').val();
  console.log('PROCESO 5');
  console.log('inicio: '+ini);
  console.log('fin: '+fin);
  $.ajax({
    url: url_ajax,
    data: { proceso:5, indicador:indicador, ini:ini, fin:fin, departamental:departamental, indicador2:indicador2, descripcion:descripcion },
    type : 'POST',
    // dataType : 'html',
    dataType : 'json',
    success : function(data) {
      //console.log(data.serie[0].data.length);
      //console.log(data.serie[0].data[20][1]);
      var out='';
      for(i=0;i<data.serie[0].data.length;i++) {
        out+='<tr>';
        //out+="<td>"+data.serie[0].data[i][0]+"</td>";
        out+="<td>"+data.categorias[0].categories[i]+"</td>";
        out+="<td>"+data.serie[0].data[i]+"</td>";
        out+='</tr>';
      }
      $('#cuadro-1').find('tbody').html(out);

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
      options_barras.series=data.serie;
      char_barras=Highcharts.chart('container-grafico-barras',options_barras);
      char_barras.update({
        title: data.titulo,
        subtitle: data.subtitulo,
        xAxis: data.categorias,
        yAxis: {
          title: data.tituloy,
        },
      });
      options_torta.series=data.serie_torta;
      char_torta=Highcharts.chart('container-grafico-torta',options_torta);
      char_torta.update({
        title: data.titulo,
      });
      options_rotatorio.series=data.serie;
      char_rotatorio=Highcharts.chart('container-grafico-rotatorio',options_rotatorio);
      char_rotatorio.update({
        title: data.titulo,
        subtitle: data.subtitulo,
        xAxis: data.categorias,
        yAxis: {
          title: data.tituloy,
        },
      });
      options_area.series=data.serie;
      char_area=Highcharts.chart('container-grafico-area',options_area);
      char_area.update({
        title: data.titulo,
        xAxis: data.categorias,
        yAxis: {
          title: data.tituloy,
        },
      });

    },
  });
});

$(document).on('click','.btn-descargar',function(event){
  event.preventDefault();
  var url_pdf=$(this).attr('href');
  url_pdf+='&indicador='+indicador+'&ini='+ini+'&fin='+fin+'&departamental='+departamental+'&indicador2='+indicador2+'&descripcion='+descripcion;
  //alert(url_pdf);
  $(location).attr('href', url_pdf);
});

// validar el select de tiempos
function ShowSelected(){
  // Para obtener el valor
  var cod1 = document.getElementById("ini").value;
  var cod2 = document.getElementById("fin").value;
  if (cod2 <= cod1) {  
    //alert("Seleccion errónea \nPeriodo [año menor] al [año mayor]");
    // document.getElementById("ini").focus();
  }
}

// BEGIN: FUNCION DESACTIVAR CONTROLES
function desactivarComboBox(controles){
  for(i=0;i<controles.length;i++){
    //console.log(controles[i]);
    $('#'+controles[i]).html('<option value="0" selected="selected" style="display: none;">Seleccione '+controles[i]+'...</option>');
    $('#'+controles[i]).attr('disabled',true);
  }
}
// END: FUNCION DESACTIVAR CONTROLES

// BEGIN:CONFIGURACION INICIAL GRAFICA
var options_lineal;
var char_rotatorio;

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
  options_barras={
    chart: {
      type: 'bar'
    },
    title: {
      text: 'TITLE',
    },
    subtitle: {
      text: 'SUBTITLE'
    },
    xAxis: {
      categories: [],
      title: {
        text: null
      }
    },
    yAxis: {
      min: 0,
      title: {
        text: 'titulo2',
        align: 'high'
      },
      labels: {
        overflow: 'justify'
      }
    },
    tooltip: {
      valueSuffix: 'titulo2'
    },
    plotOptions: {
      bar: {
        dataLabels: {
          enabled: true
        }
      }
    },
    legend: {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'top',
      x: -40,
      y: 80,
      floating: true,
      borderWidth: 1,
      backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
      shadow: true
    },
    credits: {
      enabled: false
    },
    series: [{
      name: 'titulo3',
      data: [{}]
    }]
  };
  options_torta={
    chart: {
      type: 'pie',
      options3d: {
        enabled: true,
        alpha: 45,
        beta: 0
      }
    },
    title: {
      text: 'titulo-descripcion'
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        depth: 35,
        dataLabels: {
          enabled: true,
          format: '{point.name}'
        }
      }
    },
    series: [{
      type: 'pie',
      name: 'titulo3',
      data: [{}]
    }]
  };
  options_rotatorio={
    chart: {
      // renderTo: 'container-grafico-rotatorio',
      type: 'column',
      options3d: {
        enabled: true,
        alpha: 15,
        beta: 15,
        depth: 50,
        viewDistance: 25
      }
    },
    title: {
      text: 'titulo-descripcion'
    },
    subtitle: {
      text: 'departamental'
    },
    plotOptions: {
      column: {
        depth: 25
      }
    },
    series: [{}]
  };
  options_area={
    chart: {
      type: 'areaspline'
    },
    title: {
      text: 'descripcion'
    },
    legend: {
      layout: 'vertical',
      align: 'left',
      verticalAlign: 'top',
      x: 150,
      y: 100,
      floating: true,
      borderWidth: 1,
      backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
    xAxis: {
      categories: 'mnomserie',
        plotBands: [{ // visualize the weekend
          from: 4.5,
          to: 6.5,
          color: 'rgba(68, 170, 213, .2)'
        }]
    },
    yAxis: {
      title: {
        // text: 'titulo2'
      }
    },
    tooltip: {
      shared: true,
      // valueSuffix: 'titulo2'
    },
    credits: {
      enabled: false
    },
    plotOptions: {
      areaspline: {
        fillOpacity: 0.5
      }
    },
    series: [{
      name: 'titulo3',
      data: [{}]
    }]
  };

});

function showValues() {
  $('#alpha-value').html(char_rotatorio.options.chart.options3d.alpha);
  $('#beta-value').html(char_rotatorio.options.chart.options3d.beta);
  $('#depth-value').html(char_rotatorio.options.chart.options3d.depth);
}

// Activate the sliders
$('#sliders input').on('input change', function() {
  char_rotatorio.options.chart.options3d[this.id] = this.value;
  showValues();
  char_rotatorio.redraw(false);
});
// END:CONFIGURACION INICIAL GRAFICA