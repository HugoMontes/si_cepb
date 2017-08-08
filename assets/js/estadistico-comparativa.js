$(document).on({
  ajaxStart: function() {  $("body").addClass("loading");    },
  ajaxStop: function() {  $("body").removeClass("loading"); }    
});

$(document).ready(function(){
  $('.resultados').hide();
  $('.col-izq .btn-excel').hide();
  $('.col-der .btn-excel').hide();
});

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
$('.col-izq #sliders input').on('input change', function() {
  char_rotatorio.options.chart.options3d[this.id] = this.value;
  showValues();
  char_rotatorio.redraw(false);
});
$('.col-der #sliders input').on('input change', function() {
  char_rotatorio.options.chart.options3d[this.id] = this.value;
  showValues();
  char_rotatorio.redraw(false);
});
// END:CONFIGURACION INICIAL GRAFICA


// BEGIN: FUNCION DESACTIVAR COMBOBOX
function desactivarComboBox(columna,controles){
  for(i=0;i<controles.length;i++){
    $('.'+columna+' .'+controles[i]).html('<option value="0" selected="selected" style="display: none;">Seleccione '+controles[i]+'...</option>');
    $('.'+columna+' .'+controles[i]).attr('disabled',true);
  }
}
// END: FUNCION DESACTIVAR COMBOBOX


// BEGIN:COLUMNA_IZQUIERDA
/*
var izq_url_ajax;
var izq_tabla;
var izq_indicador, izq_titulo, izq_departamental, izq_indicador2, izq_descripcion, i, izq_ini, izq_fin;
*/
var izq_url_ajax;
var izq_tabla, izq_tabla_indicador, izq_desagregacion, izq_medicion, izq_cobertura, izq_indicador, izq_descripcion, izq_id_indicador, izq_titulo, i, izq_ini, izq_fin;

$('.col-izq .indicador-inicial').on('change',function(){
  izq_url_ajax=$('.col-izq #form-estadistico').attr('action');
  izq_tabla_indicador=$(this).val();
  $.ajax({
    url: izq_url_ajax,
    data: { proceso : 'buscaActividadEconomica', tabla_indicador : izq_tabla_indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-izq .actividad').html(data);
      $('.col-izq .actividad').append('<option value="0" selected="selected" style="display: none;">Seleccione actividad...</option>');
      $('.col-izq .actividad').attr('disabled',false);
    },
  });
  $('.col-izq .btn-excel').hide();
  $('.col-izq .btn-enviar').attr('disabled',true);
  desactivarComboBox('col-izq', ['grupo','desagregacion','medicion','cobertura','indicador','descripcion','ini','fin']); 
});

$('.col-izq .actividad').on('change',function(){
  izq_url_ajax=$('#form-estadistico').attr('action');
  var id=$(this).val();
  $.ajax({
    url: izq_url_ajax,
    data: { proceso : 'buscaGrupo', id : id, tabla_indicador : izq_tabla_indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-izq .grupo').html(data);
      $('.col-izq .grupo').append('<option value="0" selected="selected" style="display: none;">Seleccione un grupo...</option>');
      $('.col-izq .grupo').attr('disabled',false);
    },
  });
  $('.col-izq .btn-excel').hide();
  $('.col-izq .btn-enviar').attr('disabled',true);
  desactivarComboBox('col-izq', ['desagregacion','medicion','cobertura','indicador','descripcion','ini','fin']);  
});

$('.col-izq .grupo').on('change',function(){
  izq_tabla=$(this).val();
  izq_titulo=$('.col-izq .select-grupo option:selected').text();
  $.ajax({
    url: izq_url_ajax,
    data: { proceso : 'buscaDesagregacion', tabla : izq_tabla, tabla_indicador : izq_tabla_indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-izq .desagregacion').html(data);
      $('.col-izq .desagregacion').append('<option value="0" selected="selected" style="display: none;">Seleccione desagregacion...</option>');
      $('.col-izq .desagregacion').attr('disabled',false);      
    },
  });
  $('.col-izq .btn-excel').hide();
  $('.col-izq .btn-enviar').attr('disabled',true);
  desactivarComboBox('col-izq', ['medicion','cobertura','indicador','descripcion','ini','fin']);
});

$('.col-izq .desagregacion').on('change',function(){
  izq_desagregacion=$(this).val();
  $.ajax({
    url: izq_url_ajax,
    data: { proceso : 'buscaMedicion', tabla : izq_tabla, desagregacion : izq_desagregacion, tabla_indicador : izq_tabla_indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-izq .medicion').html(data);
      $('.col-izq .medicion').append('<option value="0" selected="selected" style="display: none;">Seleccione medicion...</option>');
      $('.col-izq .medicion').attr('disabled',false);
    },
  });
  $('.col-izq .btn-excel').hide();
  $('.col-izq .btn-enviar').attr('disabled',true);
  desactivarComboBox('col-izq', ['cobertura','indicador','descripcion','ini','fin']);
});

$('.col-izq .medicion').on('change',function(){
  izq_medicion=$(this).val();
  $.ajax({
    url: izq_url_ajax,
    data: { proceso : 'buscaCobertura', tabla : izq_tabla, desagregacion : izq_desagregacion, medicion : izq_medicion, tabla_indicador : izq_tabla_indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-izq .cobertura').html(data);
      $('.col-izq .cobertura').append('<option value="0" selected="selected" style="display: none;">Seleccione cobertura...</option>');
      $('.col-izq .cobertura').attr('disabled',false);
    },
  });
  $('.col-izq .btn-excel').hide();
  $('.col-izq .btn-enviar').attr('disabled',true);
  desactivarComboBox('col-izq', ['indicador','descripcion','ini','fin']);
});

$('.col-izq .cobertura').on('change',function(){
  izq_cobertura=$(this).val();
  $.ajax({
    url: izq_url_ajax,
    data: { proceso : 'buscaIndicador', tabla : izq_tabla, desagregacion : izq_desagregacion, medicion : izq_medicion, cobertura : izq_cobertura, tabla_indicador : izq_tabla_indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-izq .indicador').html(data);
      $('.col-izq .indicador').append('<option value="0" selected="selected" style="display: none;">Seleccione indicador...</option>');
      $('.col-izq .indicador').attr('disabled',false);
    },
  });
  $('.col-izq .btn-excel').hide();
  $('.col-izq .btn-enviar').attr('disabled',true);
  desactivarComboBox('col-izq', ['descripcion','ini','fin']);
});

$('.col-izq .indicador').on('change',function(){
  izq_indicador=$(this).val();
  $.ajax({
    url: izq_url_ajax,
    data: { proceso : 'buscaDescripcion', tabla : izq_tabla, desagregacion : izq_desagregacion, medicion : izq_medicion, cobertura : izq_cobertura, indicador : izq_indicador, tabla_indicador : izq_tabla_indicador },
    type : 'POST',
    dataType : 'json',
    success : function(data) {
      $('.col-izq .btn-excel').show();
      $('.col-izq .btn-excel').attr('href',data.ruta_xlsx);
      var out='';
      for(i=0;i<data.indicador.length;i++) {
        out+='<option value="'+data.indicador[i].id+'">'+data.indicador[i].descripcion+'</option>';
      }
      $('.col-izq .descripcion').html(out);
      $('.col-izq .descripcion').append('<option value="0" selected="selected" style="display: none;">Seleccione descripcion...</option>');
      $('.col-izq .descripcion').attr('disabled',false);      
    },
  });
  $('.col-izq .btn-enviar').attr('disabled',true);
  desactivarComboBox('col-izq', ['ini','fin']);  
});

$('.col-izq .descripcion').on('change',function(){
  izq_id_indicador=$(this).val();
  $.ajax({
    url: izq_url_ajax,
    data: { proceso : 'buscaPeriodicidad', tabla : izq_tabla, id : izq_id_indicador, tabla_indicador : izq_tabla_indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-izq .ini').html(data);
      $('.col-izq .fin').html(data);
      $('.col-izq .fin option:last').attr("selected", "selected");
      // console.log(data);
    },
  });
  $('.col-izq .ini').attr('disabled',false);
  $('.col-izq .fin').attr('disabled',false);
  $('.col-izq .btn-enviar').attr('disabled',false);
});
//*****************************************************************************
$(document).on('click','.col-izq .btn-enviar',function(event){
  event.preventDefault();
  izq_ini=$('.col-izq .ini').val();
  izq_fin=$('.col-izq .fin').val();
  $.ajax({
    url: izq_url_ajax,
    data: { proceso:'imprimirResultados', tabla : izq_tabla, id : izq_id_indicador, ini:izq_ini, fin:izq_fin, tabla_indicador : izq_tabla_indicador },
    type : 'POST',
    dataType : 'json',
    success : function(data) {
      $('.col-izq .resultados').show();
      $('.col-izq .cuadro-title').text(data.titulo.text);
      $('.col-izq .cuadro-subtitle').text(data.subtitulo.text);
      $('.col-izq .columna-2').text(data.tituloy.text);
      var out='';
      for(i=0;i<data.serie[0].data.length;i++) {
        out+='<tr>';
        out+="<td>"+data.categorias[0].categories[i]+"</td>";
        out+="<td>"+data.serie[0].data[i]+"</td>";
        out+='</tr>';
      }
      $('.col-izq #cuadro-1').find('tbody').html(out);


      options_lineal.series=data.serie;
      char_lineal=Highcharts.chart('izq-container-grafico-lineal',options_lineal);
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
      char_barras=Highcharts.chart('izq-container-grafico-barras',options_barras);
      char_barras.update({
        title: data.titulo,
        subtitle: data.subtitulo,
        xAxis: data.categorias,
        yAxis: {
          title: data.tituloy,
        },
      });

      options_torta.series=data.serie_torta;
      char_torta=Highcharts.chart('izq-container-grafico-torta',options_torta);
      char_torta.update({
        title: data.titulo,
      });

      options_rotatorio.series=data.serie;
      char_rotatorio=Highcharts.chart('izq-container-grafico-rotatorio',options_rotatorio);
      char_rotatorio.update({
        title: data.titulo,
        subtitle: data.subtitulo,
        xAxis: data.categorias,
        yAxis: {
          title: data.tituloy,
        },
      });

      options_area.series=data.serie;
      char_area=Highcharts.chart('izq-container-grafico-area',options_area);
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

$(document).on('click','.col-izq .btn-descargar',function(event){
  event.preventDefault();
  var url_pdf=$(this).attr('href');
  url_pdf+='&tabla='+izq_tabla+'&ini='+izq_ini+'&fin='+izq_fin+'&id='+izq_id_indicador;
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
// END:COLUMNA_IZQUIERDA

// ===================================================================================

// BEGIN:COLUMNA_DERECHA
var der_url_ajax;
var der_tabla, der_tabla_indicador, der_desagregacion, der_medicion, der_cobertura, der_indicador, der_descripcion, der_id_indicador, der_titulo, i, der_ini, der_fin;

$('.col-der .indicador-inicial').on('change',function(){
  der_url_ajax=$('.col-der #form-estadistico').attr('action');
  der_tabla_indicador=$(this).val();
  $.ajax({
    url: der_url_ajax,
    data: { proceso : 'buscaActividadEconomica', tabla_indicador : der_tabla_indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-der .actividad').html(data);
      $('.col-der .actividad').append('<option value="0" selected="selected" style="display: none;">Seleccione actividad...</option>');
      $('.col-der .actividad').attr('disabled',false);
    },
  });
  $('.col-der .btn-excel').hide();
  $('.col-der .btn-enviar').attr('disabled',true);
  desactivarComboBox('col-der', ['grupo','desagregacion','medicion','cobertura','indicador','descripcion','ini','fin']); 
});

$('.col-der .actividad').on('change',function(){
  der_url_ajax=$('#form-estadistico').attr('action');
  var id=$(this).val();
  $.ajax({
    url: der_url_ajax,
    data: { proceso : 'buscaGrupo', id : id, tabla_indicador : der_tabla_indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-der .grupo').html(data);
      $('.col-der .grupo').append('<option value="0" selected="selected" style="display: none;">Seleccione un grupo...</option>');
      $('.col-der .grupo').attr('disabled',false);
    },
  });
  $('.col-der .btn-excel').hide();
  $('.col-der .btn-enviar').attr('disabled',true);
  desactivarComboBox('col-der', ['desagregacion','medicion','cobertura','indicador','descripcion','ini','fin']);  
});

$('.col-der .grupo').on('change',function(){
  der_tabla=$(this).val();
  der_titulo=$('.col-der .select-grupo option:selected').text();
  $.ajax({
    url: der_url_ajax,
    data: { proceso : 'buscaDesagregacion', tabla : der_tabla, tabla_indicador : der_tabla_indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-der .desagregacion').html(data);
      $('.col-der .desagregacion').append('<option value="0" selected="selected" style="display: none;">Seleccione desagregacion...</option>');
      $('.col-der .desagregacion').attr('disabled',false);      
    },
  });
  $('.col-der .btn-excel').hide();
  $('.col-der .btn-enviar').attr('disabled',true);
  desactivarComboBox('col-der', ['medicion','cobertura','indicador','descripcion','ini','fin']);
});

$('.col-der .desagregacion').on('change',function(){
  der_desagregacion=$(this).val();
  $.ajax({
    url: der_url_ajax,
    data: { proceso : 'buscaMedicion', tabla : der_tabla, desagregacion : der_desagregacion, tabla_indicador : der_tabla_indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-der .medicion').html(data);
      $('.col-der .medicion').append('<option value="0" selected="selected" style="display: none;">Seleccione medicion...</option>');
      $('.col-der .medicion').attr('disabled',false);
    },
  });
  $('.col-der .btn-excel').hide();
  $('.col-der .btn-enviar').attr('disabled',true);
  desactivarComboBox('col-der', ['cobertura','indicador','descripcion','ini','fin']);
});

$('.col-der .medicion').on('change',function(){
  der_medicion=$(this).val();
  $.ajax({
    url: der_url_ajax,
    data: { proceso : 'buscaCobertura', tabla : der_tabla, desagregacion : der_desagregacion, medicion : der_medicion, tabla_indicador : der_tabla_indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-der .cobertura').html(data);
      $('.col-der .cobertura').append('<option value="0" selected="selected" style="display: none;">Seleccione cobertura...</option>');
      $('.col-der .cobertura').attr('disabled',false);
    },
  });
  $('.col-der .btn-excel').hide();
  $('.col-der .btn-enviar').attr('disabled',true);
  desactivarComboBox('col-der', ['indicador','descripcion','ini','fin']);
});

$('.col-der .cobertura').on('change',function(){
  der_cobertura=$(this).val();
  $.ajax({
    url: der_url_ajax,
    data: { proceso : 'buscaIndicador', tabla : der_tabla, desagregacion : der_desagregacion, medicion : der_medicion, cobertura : der_cobertura, tabla_indicador : der_tabla_indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-der .indicador').html(data);
      $('.col-der .indicador').append('<option value="0" selected="selected" style="display: none;">Seleccione indicador...</option>');
      $('.col-der .indicador').attr('disabled',false);
    },
  });
  $('.col-der .btn-excel').hide();
  $('.col-der .btn-enviar').attr('disabled',true);
  desactivarComboBox('col-der', ['descripcion','ini','fin']);
});

$('.col-der .indicador').on('change',function(){
  der_indicador=$(this).val();
  $.ajax({
    url: der_url_ajax,
    data: { proceso : 'buscaDescripcion', tabla : der_tabla, desagregacion : der_desagregacion, medicion : der_medicion, cobertura : der_cobertura, indicador : der_indicador, tabla_indicador : der_tabla_indicador },
    type : 'POST',
    dataType : 'json',
    success : function(data) {
      $('.col-der .btn-excel').show();
      $('.col-der .btn-excel').attr('href',data.ruta_xlsx);
      var out='';
      for(i=0;i<data.indicador.length;i++) {
        out+='<option value="'+data.indicador[i].id+'">'+data.indicador[i].descripcion+'</option>';
      }
      $('.col-der .descripcion').html(out);
      $('.col-der .descripcion').append('<option value="0" selected="selected" style="display: none;">Seleccione descripcion...</option>');
      $('.col-der .descripcion').attr('disabled',false);      
    },
  });
  $('.col-der .btn-enviar').attr('disabled',true);
  desactivarComboBox('col-der', ['ini','fin']);  
});

$('.col-der .descripcion').on('change',function(){
  der_id_indicador=$(this).val();
  $.ajax({
    url: der_url_ajax,
    data: { proceso : 'buscaPeriodicidad', tabla : der_tabla, id : der_id_indicador, tabla_indicador : der_tabla_indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-der .ini').html(data);
      $('.col-der .fin').html(data);
      $('.col-der .fin option:last').attr("selected", "selected");
      // console.log(data);
    },
  });
  $('.col-der .ini').attr('disabled',false);
  $('.col-der .fin').attr('disabled',false);
  $('.col-der .btn-enviar').attr('disabled',false);
});
//*****************************************************************************
$(document).on('click','.col-der .btn-enviar',function(event){
  event.preventDefault();
  der_ini=$('.col-der .ini').val();
  der_fin=$('.col-der .fin').val();
  $.ajax({
    url: der_url_ajax,
    data: { proceso:'imprimirResultados', tabla : der_tabla, id : der_id_indicador, ini:der_ini, fin:der_fin, tabla_indicador : der_tabla_indicador },
    type : 'POST',
    dataType : 'json',
    success : function(data) {
      $('.col-der .resultados').show();
      $('.col-der .cuadro-title').text(data.titulo.text);
      $('.col-der .cuadro-subtitle').text(data.subtitulo.text);
      $('.col-der .columna-2').text(data.tituloy.text);
      var out='';
      for(i=0;i<data.serie[0].data.length;i++) {
        out+='<tr>';
        out+="<td>"+data.categorias[0].categories[i]+"</td>";
        out+="<td>"+data.serie[0].data[i]+"</td>";
        out+='</tr>';
      }
      $('.col-der #cuadro-1').find('tbody').html(out);


      options_lineal.series=data.serie;
      char_lineal=Highcharts.chart('der-container-grafico-lineal',options_lineal);
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
      char_barras=Highcharts.chart('der-container-grafico-barras',options_barras);
      char_barras.update({
        title: data.titulo,
        subtitle: data.subtitulo,
        xAxis: data.categorias,
        yAxis: {
          title: data.tituloy,
        },
      });

      options_torta.series=data.serie_torta;
      char_torta=Highcharts.chart('der-container-grafico-torta',options_torta);
      char_torta.update({
        title: data.titulo,
      });

      options_rotatorio.series=data.serie;
      char_rotatorio=Highcharts.chart('der-container-grafico-rotatorio',options_rotatorio);
      char_rotatorio.update({
        title: data.titulo,
        subtitle: data.subtitulo,
        xAxis: data.categorias,
        yAxis: {
          title: data.tituloy,
        },
      });

      options_area.series=data.serie;
      char_area=Highcharts.chart('der-container-grafico-area',options_area);
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

$(document).on('click','.col-der .btn-descargar',function(event){
  event.preventDefault();
  var url_pdf=$(this).attr('href');
  url_pdf+='&tabla='+der_tabla+'&ini='+der_ini+'&fin='+der_fin+'&id='+der_id_indicador;
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
// END:COLUMNA_IZQUIERDA