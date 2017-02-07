// ARCHIVO JS ESTADISTICO-COMPARATIVA

$(document).on({
  ajaxStart: function() {  $("body").addClass("loading");    },
  ajaxStop: function() {  $("body").removeClass("loading"); }    
});

$(document).ready(function(){
  $('.resultados').hide();
  $('.col-izq #btn-excel').hide();
  $('.col-der #btn-excel').hide();
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


// BEGIN:COLUMNA_IZQUIERDA
var izq_url_ajax;
var izq_indicador, izq_titulo, izq_departamental, izq_indicador2, izq_descripcion, i, izq_ini, izq_fin;
var izq_tabla;

$('.col-izq .select-principal').on('change',function(){
  izq_url_ajax=$('.col-izq #form-estadistico').attr('action');
  izq_tabla=$(this).val();
  $.ajax({
    url: izq_url_ajax,
    data: { proceso : 0, tabla : izq_tabla },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-izq .select-actividad').html(data);
      $('.col-izq .select-actividad').append('<option value="0" selected="selected" style="display: none;">Seleccione una actividad...</option>');
      $('.col-izq .select-actividad').attr('disabled',false);
    },
  });
  $('.col-izq .select-indicador').html('<option value="0" selected="selected" style="display: none;">Seleccione el indicador...</option>');
  $('.col-izq .select-indicador').attr('disabled',true);
  $('.col-izq #btn-excel').hide();
  $('.col-izq .select-cobertura').html('<option value="0" selected="selected" style="display: none;">Seleccione la cobertura...</option>');
  $('.col-izq .select-cobertura').attr('disabled',true);
  $('.col-izq .select-descripcion').html('<option value="0" selected="selected" style="display: none;">Seleccione una descripcion...</option>');
  $('.col-izq .select-descripcion').attr('disabled',true);
  $('.col-izq .select-ini').html('<option value="0" selected="selected" style="display: none;">Periodo inicial...</option>');
  $('.col-izq .select-ini').attr('disabled',true);
  $('.col-izq .select-fin').html('<option value="0" selected="selected" style="display: none;">Periodo final...</option>');
  $('.col-izq .select-fin').attr('disabled',true);
  $('.col-izq .btn-enviar').attr('disabled',true);
});

$('.col-izq .select-actividad').on('change',function(){
  izq_url_ajax=$('.col-izq #form-estadistico').attr('action');
  izq_indicador=$(this).val();
  izq_titulo=$('.col-izq .select-actividad option:selected').text();
  console.log('PROCESO 1');
  console.log('Actividad Economica: '+izq_titulo);
  console.log('Tabla indicador: '+izq_indicador);  
  $.ajax({
    url: izq_url_ajax,
    data: { proceso : 1, tabla : izq_tabla, indicador : izq_indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-izq .select-indicador').html(data);
      $('.col-izq .select-indicador').append('<option value="0" selected="selected" style="display: none;">Seleccione el indicador...</option>');
      $('.col-izq .select-indicador').attr('disabled',false);
    },
  });
  $('.col-izq #btn-excel').hide();
  $('.col-izq .select-cobertura').html('<option value="0" selected="selected" style="display: none;">Seleccione la cobertura...</option>');
  $('.col-izq .select-cobertura').attr('disabled',true);
  $('.col-izq .select-descripcion').html('<option value="0" selected="selected" style="display: none;">Seleccione una descripcion...</option>');
  $('.col-izq .select-descripcion').attr('disabled',true);
  $('.col-izq .select-ini').html('<option value="0" selected="selected" style="display: none;">Periodo inicial...</option>');
  $('.col-izq .select-ini').attr('disabled',true);
  $('.col-izq .select-fin').html('<option value="0" selected="selected" style="display: none;">Periodo final...</option>');
  $('.col-izq .select-fin').attr('disabled',true);
  $('.col-izq .btn-enviar').attr('disabled',true);
});

$('.col-izq .select-indicador').on('change',function(){
  izq_indicador2=$(this).val();
  console.log('PROCESO 2');
  console.log('Titulo Indicador 2: '+izq_indicador2); 
  $.ajax({
    url: izq_url_ajax,
    data: { proceso : 2, tabla : izq_tabla, indicador:izq_indicador, indicador2:izq_indicador2 },
    type : 'POST',
    dataType : 'json',
    success : function(data) {
      $('.col-izq #btn-excel').attr('href',data.ruta_xlsx);
      var out='';
      for(i=0;i<data.cobertura.length;i++) {
        out+='<option value="'+data.cobertura[i]+'">'+data.cobertura[i]+'</option>';
      }
      $('.col-izq .select-cobertura').html(out);
      $('.col-izq .select-cobertura').append('<option value="0" selected="selected" style="display: none;">Seleccione la cobertura...</option>');
      $('.col-izq .select-cobertura').attr('disabled',false); 
    },
  });
  $('.col-izq #btn-excel').show();
  $('.col-izq .select-descripcion').html('<option value="0" selected="selected" style="display: none;">Seleccione una descripcion...</option>');
  $('.col-izq .select-descripcion').attr('disabled',true);
  $('.col-izq .select-ini').html('<option value="0" selected="selected" style="display: none;">Periodo inicial...</option>');
  $('.col-izq .select-ini').attr('disabled',true);
  $('.col-izq .select-fin').html('<option value="0" selected="selected" style="display: none;">Periodo final...</option>');
  $('.col-izq .select-fin').attr('disabled',true);
  $('.col-izq .btn-enviar').attr('disabled',true);
});


$('.col-izq .select-cobertura').on('change',function(){
  izq_departamental=$(this).val();
  console.log('PROCESO 3');
  console.log('Cobertura: '+izq_departamental);
  $.ajax({
    url: izq_url_ajax,
    data: { proceso : 3, tabla : izq_tabla, indicador : izq_indicador, departamental : izq_departamental, indicador2 : izq_indicador2},
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      /*
      $('.select-indicador').html(data);
      $('.select-indicador').append('<option value="0" selected="selected" style="display: none;">Seleccione el indicador...</option>');
      */
      $('.col-izq .select-descripcion').html(data);
      $('.col-izq .select-descripcion').append('<option value="0" selected="selected" style="display: none;">Seleccione una descripcion...</option>');
      $('.col-izq .select-descripcion').attr('disabled',false);
    },
  });
  // $('.select-indicador').attr('disabled',false);
  $('.col-izq .select-descripcion').html('<option value="0" selected="selected" style="display: none;">Seleccione una descripcion...</option>');
  $('.col-izq .select-descripcion').attr('disabled',true);
  $('.col-izq .select-ini').html('<option value="0" selected="selected" style="display: none;">Periodo inicial...</option>');
  $('.col-izq .select-ini').attr('disabled',true);
  $('.col-izq .select-fin').html('<option value="0" selected="selected" style="display: none;">Periodo final...</option>');
  $('.col-izq .select-fin').attr('disabled',true);
  $('.col-izq .btn-enviar').attr('disabled',true);
});


$('.col-izq .select-descripcion').on('change',function(){
  izq_descripcion=$(this).val();
  console.log('PROCESO 4');
  console.log('Indicador: '+izq_indicador);
  console.log('Departamental: '+izq_departamental);
  console.log('Indicador2: '+izq_indicador2);
  console.log('Descripcion: '+izq_descripcion); 
  $.ajax({
    url: izq_url_ajax,
    data: { proceso : 4, tabla : izq_tabla, indicador:izq_indicador, departamental:izq_departamental, indicador2:izq_indicador2, descripcion:izq_descripcion },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-izq .select-ini').html(data);
      $('.col-izq .select-fin').html(data);
      $('.col-izq .select-fin option:last').attr("selected", "selected");
      // console.log(data);
    },
  });
  $('.col-izq .select-ini').attr('disabled',false);
  $('.col-izq .select-fin').attr('disabled',false);
  $('.col-izq .btn-enviar').attr('disabled',false);
});

$(document).on('click','.col-izq .btn-enviar',function(event){
  event.preventDefault();
  $('.col-izq .resultados').show();
  izq_ini=$('.col-izq #ini').val();
  izq_fin=$('.col-izq #fin').val();
  console.log('PROCESO 5');
  console.log('inicio: '+izq_ini);
  console.log('fin: '+izq_fin);
  $.ajax({
    url: izq_url_ajax,
    data: { proceso:5, tabla : izq_tabla, indicador:izq_indicador, ini:izq_ini, fin:izq_fin, departamental:izq_departamental, indicador2:izq_indicador2, descripcion:izq_descripcion },
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
  url_pdf+='&indicador='+izq_indicador+'&ini='+izq_ini+'&fin='+izq_fin+'&departamental='+izq_departamental+'&indicador2='+izq_indicador2+'&descripcion='+izq_descripcion;
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
// END:COLUMNA_IZQUIERDA

// ===================================================================================

// BEGIN:COLUMNA_DERECHA
var der_url_ajax;
var der_indicador, der_titulo, der_departamental, der_indicador2, der_descripcion, i, der_ini, der_fin;
var der_tabla;

$('.col-der .select-principal').on('change',function(){
  der_url_ajax=$('.col-der #form-estadistico').attr('action');
  der_tabla=$(this).val();
  $.ajax({
    url: der_url_ajax,
    data: { proceso : 0, tabla : der_tabla },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-der .select-actividad').html(data);
      $('.col-der .select-actividad').append('<option value="0" selected="selected" style="display: none;">Seleccione una actividad...</option>');
      $('.col-der .select-actividad').attr('disabled',false);
    },
  });
  $('.col-der .select-indicador').html('<option value="0" selected="selected" style="display: none;">Seleccione el indicador...</option>');
  $('.col-der .select-indicador').attr('disabled',true);
  $('.col-der #btn-excel').hide();
  $('.col-der .select-cobertura').html('<option value="0" selected="selected" style="display: none;">Seleccione la cobertura...</option>');
  $('.col-der .select-cobertura').attr('disabled',true);
  $('.col-der .select-descripcion').html('<option value="0" selected="selected" style="display: none;">Seleccione una descripcion...</option>');
  $('.col-der .select-descripcion').attr('disabled',true);
  $('.col-der .select-ini').html('<option value="0" selected="selected" style="display: none;">Periodo inicial...</option>');
  $('.col-der .select-ini').attr('disabled',true);
  $('.col-der .select-fin').html('<option value="0" selected="selected" style="display: none;">Periodo final...</option>');
  $('.col-der .select-fin').attr('disabled',true);
  $('.col-der .btn-enviar').attr('disabled',true);
});

$('.col-der .select-actividad').on('change',function(){
  der_url_ajax=$('.col-der #form-estadistico').attr('action');
  der_indicador=$(this).val();
  der_titulo=$('.col-der .select-actividad option:selected').text();
  console.log('PROCESO 1');
  console.log('Actividad Economica: '+der_titulo);
  console.log('Tabla indicador: '+der_indicador);  
  $.ajax({
    url: der_url_ajax,
    data: { proceso : 1, tabla : der_tabla, indicador : der_indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-der .select-indicador').html(data);
      $('.col-der .select-indicador').append('<option value="0" selected="selected" style="display: none;">Seleccione el indicador...</option>');
      $('.col-der .select-indicador').attr('disabled',false);
    },
  });
  $('.col-der #btn-excel').hide();
  $('.col-der .select-cobertura').html('<option value="0" selected="selected" style="display: none;">Seleccione la cobertura...</option>');
  $('.col-der .select-cobertura').attr('disabled',true);
  $('.col-der .select-descripcion').html('<option value="0" selected="selected" style="display: none;">Seleccione una descripcion...</option>');
  $('.col-der .select-descripcion').attr('disabled',true);
  $('.col-der .select-ini').html('<option value="0" selected="selected" style="display: none;">Periodo inicial...</option>');
  $('.col-der .select-ini').attr('disabled',true);
  $('.col-der .select-fin').html('<option value="0" selected="selected" style="display: none;">Periodo final...</option>');
  $('.col-der .select-fin').attr('disabled',true);
  $('.col-der .btn-enviar').attr('disabled',true);
});

$('.col-der .select-indicador').on('change',function(){
  der_indicador2=$(this).val();
  console.log('PROCESO 2');
  console.log('Titulo Indicador 2: '+der_indicador2); 
  $.ajax({
    url: der_url_ajax,
    data: { proceso : 2, tabla : der_tabla, indicador:der_indicador, indicador2:der_indicador2 },
    type : 'POST',
    dataType : 'json',
    success : function(data) {
      $('.col-der #btn-excel').attr('href',data.ruta_xlsx);
      var out='';
      for(i=0;i<data.cobertura.length;i++) {
        out+='<option value="'+data.cobertura[i]+'">'+data.cobertura[i]+'</option>';
      }
      $('.col-der .select-cobertura').html(out);
      $('.col-der .select-cobertura').append('<option value="0" selected="selected" style="display: none;">Seleccione la cobertura...</option>');
      $('.col-der .select-cobertura').attr('disabled',false); 
    },
  });
  $('.col-der #btn-excel').show();
  $('.col-der .select-descripcion').html('<option value="0" selected="selected" style="display: none;">Seleccione una descripcion...</option>');
  $('.col-der .select-descripcion').attr('disabled',true);
  $('.col-der .select-ini').html('<option value="0" selected="selected" style="display: none;">Periodo inicial...</option>');
  $('.col-der .select-ini').attr('disabled',true);
  $('.col-der .select-fin').html('<option value="0" selected="selected" style="display: none;">Periodo final...</option>');
  $('.col-der .select-fin').attr('disabled',true);
  $('.col-der .btn-enviar').attr('disabled',true);
});


$('.col-der .select-cobertura').on('change',function(){
  der_departamental=$(this).val();
  console.log('PROCESO 3');
  console.log('Cobertura: '+der_departamental);
  $.ajax({
    url: der_url_ajax,
    data: { proceso : 3, tabla : der_tabla, indicador : der_indicador, departamental: der_departamental, indicador2:der_indicador2},
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      /*
      $('.select-indicador').html(data);
      $('.select-indicador').append('<option value="0" selected="selected" style="display: none;">Seleccione el indicador...</option>');
      */
      $('.col-der .select-descripcion').html(data);
      $('.col-der .select-descripcion').append('<option value="0" selected="selected" style="display: none;">Seleccione una descripcion...</option>');
      $('.col-der .select-descripcion').attr('disabled',false);
    },
  });
  // $('.select-indicador').attr('disabled',false);
  $('.col-der .select-descripcion').html('<option value="0" selected="selected" style="display: none;">Seleccione una descripcion...</option>');
  $('.col-der .select-descripcion').attr('disabled',true);
  $('.col-der .select-ini').html('<option value="0" selected="selected" style="display: none;">Periodo inicial...</option>');
  $('.col-der .select-ini').attr('disabled',true);
  $('.col-der .select-fin').html('<option value="0" selected="selected" style="display: none;">Periodo final...</option>');
  $('.col-der .select-fin').attr('disabled',true);
  $('.col-der .btn-enviar').attr('disabled',true);
});


$('.col-der .select-descripcion').on('change',function(){
  der_descripcion=$(this).val();
  console.log('PROCESO 4');
  console.log('Indicador: '+der_indicador);
  console.log('Departamental: '+der_departamental);
  console.log('Indicador2: '+der_indicador2);
  console.log('Descripcion: '+der_descripcion); 
  $.ajax({
    url: der_url_ajax,
    data: { proceso : 4, tabla : der_tabla, indicador:der_indicador, departamental:der_departamental, indicador2:der_indicador2, descripcion:der_descripcion },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
      $('.col-der .select-ini').html(data);
      $('.col-der .select-fin').html(data);
      $('.col-der .select-fin option:last').attr("selected", "selected");
      // console.log(data);
    },
  });
  $('.col-der .select-ini').attr('disabled',false);
  $('.col-der .select-fin').attr('disabled',false);
  $('.col-der .btn-enviar').attr('disabled',false);
});

$(document).on('click','.col-der .btn-enviar',function(event){
  event.preventDefault();
  $('.col-der .resultados').show();
  der_ini=$('.col-der #ini').val();
  der_fin=$('.col-der #fin').val();
  console.log('PROCESO 5');
  console.log('inicio: '+der_ini);
  console.log('fin: '+der_fin);
  $.ajax({
    url: der_url_ajax,
    data: { proceso:5, tabla : der_tabla, indicador:der_indicador, ini:der_ini, fin:der_fin, departamental:der_departamental, indicador2:der_indicador2, descripcion:der_descripcion },
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
  url_pdf+='&indicador='+der_indicador+'&ini='+der_ini+'&fin='+der_fin+'&departamental='+der_departamental+'&indicador2='+der_indicador2+'&descripcion='+der_descripcion;
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
// END:COLUMNA_IZQUIERDA