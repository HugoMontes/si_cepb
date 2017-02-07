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