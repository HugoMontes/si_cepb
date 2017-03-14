var url_ajax;
var tabla, desagregacion, medicion, cobertura, indicador, descripcion, id_indicador, titulo, i, ini, fin;

$(document).ready(function(){
  $('.resultados').hide();
  $('#btn-excel').hide();
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
  console.log('PROCESO 6');
  console.log('Indicador: '+indicador);
  console.log("===========================");
  $.ajax({
    url: url_ajax,
    data: { proceso : 'buscaDescripcion', tabla : tabla, desagregacion : desagregacion, medicion : medicion, cobertura : cobertura, indicador : indicador },
    type : 'POST',
    dataType : 'json',
    success : function(data) {
      $('#btn-excel').show();
      $('#btn-excel').attr('href',data.ruta_xlsx);
      var out='';
      for(i=0;i<data.indicador.length;i++) {
        out+='<option value="'+data.indicador[i].id+'">'+data.indicador[i].descripcion+'</option>';
      }
      $('#descripcion').html(out);
      $('#descripcion').append('<option value="0" selected="selected" style="display: none;">Seleccione descripcion...</option>');
      $('#descripcion').attr('disabled',false);      
    },
  });
  desactivarComboBox(['ini','fin']);
  $('#btn-enviar').attr('disabled',true);
});

$('#descripcion').on('change',function(){
  id_indicador=$(this).val();
  console.log('PROCESO 6');
  console.log('ID INDICADOR: '+id_indicador);
  console.log("===========================");
  $.ajax({
    url: url_ajax,
    data: { proceso : 'buscaPeriodicidad', tabla : tabla, id : id_indicador },
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

  ini=$('#ini').val();
  fin=$('#fin').val();
  console.log('PROCESO 7');
  console.log('inicio: '+ini);
  console.log('fin: '+fin);
  $.ajax({
    url: url_ajax,
    data: { proceso:'imprimirResultados', tabla : tabla, id : id_indicador, ini:ini, fin:fin},
    type : 'POST',
    dataType : 'json',
    success : function(data) {
      $('.resultados').show();
      $('.cuadro-title').text(data.titulo.text);
      $('.cuadro-subtitle').text(data.subtitulo.text);
      $('.columna-2').text(data.tituloy.text);
      var out='';
      for(i=0;i<data.serie[0].data.length;i++) {
        out+='<tr>';
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

// HASTA AQUI LOS METODOS FUERON MEJORADOS **********************************
$(document).on('click','.btn-descargar',function(event){
  event.preventDefault();
  var url_pdf=$(this).attr('href');
  url_pdf+='&tabla='+tabla+'&ini='+ini+'&fin='+fin+'&id='+id_indicador;
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

// BEGIN: FUNCION DESACTIVAR COMBOBOX
function desactivarComboBox(controles){
  for(i=0;i<controles.length;i++){
    $('#'+controles[i]).html('<option value="0" selected="selected" style="display: none;">Seleccione '+controles[i]+'...</option>');
    $('#'+controles[i]).attr('disabled',true);
  }
}
// END: FUNCION DESACTIVAR COMBOBOX

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