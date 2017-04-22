var id, i, j, tabla, medicion, indicador, out, url_ajax, url;

$('#actividad').on('change',function(){
  $('#pnl-editar-indicador').hide();
  url_ajax=$('#form-estadistico').attr('action')+'all/grupos';
  id=$(this).val();
  $.ajax({
    url: url_ajax,
    data: { id : id },
    type : 'POST',
    dataType : 'json',
    success : function(data) {
      var out='';
      for(i=0;i<data.grupos.length;i++){
        out+='<option value="'+data.grupos[i].tabla+'">'+data.grupos[i].campos+'</option>';
      }
      $('#grupo').html(out);
      $('#grupo').append('<option value="0" selected="selected" style="display: none;">Seleccione grupo...</option>');
      $('#grupo').attr('disabled',false);
    },
  });
  desactivarComboBox(['medicion','indicador']);
  /*
  $('#btn-excel').hide();
  desactivarComboBox(['desagregacion','medicion','cobertura','indicador','descripcion','ini','fin']);
  $('#btn-enviar').attr('disabled',true);
  */
});

$('#grupo').on('change',function(){
  $('#pnl-editar-indicador').hide();
  url_ajax=$('#form-estadistico').attr('action')+'all/mediciones';
  tabla=$(this).val();
  $.ajax({
    url: url_ajax,
    data: { tabla : tabla },
    type : 'POST',
    dataType : 'json',
    success : function(data) {      
      var out='';
      for(i=0;i<data.mediciones.length;i++){
        out+='<option value="'+data.mediciones[i].medicion_indicador+'">'+data.mediciones[i].medicion_indicador+'</option>';
      }
      $('#medicion').html(out);
      $('#medicion').append('<option value="0" selected="selected" style="display: none;">Seleccione medición...</option>');
      $('#medicion').attr('disabled',false);
      $('#txt_archivo').val(data.indicador.ruta);
    },
  });
  desactivarComboBox(['indicador']);
  /*
  $('#btn-excel').hide();
  desactivarComboBox(['desagregacion','medicion','cobertura','indicador','descripcion','ini','fin']);
  $('#btn-enviar').attr('disabled',true);
  */
});

$('#medicion').on('change',function(){
  $('#pnl-editar-indicador').hide();
  url_ajax=$('#form-estadistico').attr('action')+'all/indicadores';
  medicion=$(this).val();
  $.ajax({
    url: url_ajax,
    data: { tabla : tabla, medicion : medicion },
    type : 'POST',
    dataType : 'json',
    success : function(data) {
      var out='';
      for(i=0;i<data.indicadores.length;i++){
        out+='<option value="'+data.indicadores[i].B+'">'+data.indicadores[i].B+'</option>';
      }
      $('#indicador').html(out);
      $('#indicador').append('<option value="0" selected="selected" style="display: none;">Seleccione indicador...</option>');
      $('#indicador').attr('disabled',false);
    },
  });
  /*
  $('#btn-excel').hide();
  desactivarComboBox(['desagregacion','medicion','cobertura','indicador','descripcion','ini','fin']);
  $('#btn-enviar').attr('disabled',true);
  */
});

$('#indicador').on('change',function(){
  url_ajax=$('#form-estadistico').attr('action')+'all/data/table';
  indicador=$(this).val();
  $('#pnl-title').html(indicador);
  $('#upload_indicador').val(indicador);
  $('#txt_upload_indicador').val(indicador);
  $('#txt_upload_tabla').val(tabla);
  $.ajax({
    url: url_ajax,
    data: { tabla : tabla, medicion : medicion, indicador : indicador },
    type : 'POST',
    dataType : 'json',
    success : function(data) {
      // console.log(data);
      // VALORES DEL FORMULARIO
      // $('#txt_archivo').val($('#txt_archivo').val()+'/'+data.tabla[0].archivo);
      $('#txt_desagregacion').val(data.tabla[0].desagregacion);
      $('#txt_medicion').val(data.tabla[0].medicion);
      $('#txt_unidad_medida').val(data.tabla[0].unidad_medida);
      $('#txt_cobertura').val(data.tabla[0].cobertura);
      
      // VALORES DEL ENCABEZADO DE LA TABLA
      out='<th>Descripción</th>';
      for(i=0;i<data.gestiones.length;i++){
        out+='<th>'+data.gestiones[i]+'</th>';
      }
      $('#tbl-indicadores thead tr').html(out);

      /*
      console.log("==========================================");
      var ini=data.tabla[0].ini;
      var fin=data.tabla[0].fin;
      console.log(ini);
      console.log(fin);
      var head=Object.keys(data.tabla[0]);

      var cont=0;
      for(i=ini;i<=fin;i++){
        //gestiones[cont]=head[i];
        console.log(head[i]);
        cont++;
      }
      //console.log(gestiones);
*/

      // VALORES NUMERICOS DE LA TABLA
      out='';
      for(i=0;i<data.tabla.length;i++){
        out+='<tr id="'+data.tabla[i].id+'">';
        out+='<td>'+data.tabla[i].descripcion+'</td>';
        for(j=0;j<data.tabla[i].valores.length;j++){
          out+='<td>'+data.tabla[i].valores[j]+'</td>';
        }        
        out+="</tr>";
      }
      $('#tbl-indicadores tbody').html(out);
    },
  });
  $('#pnl-editar-indicador').show();
});

$('#btn-download-excel').click(function(event){
  event.preventDefault();
  url=$(this).attr('href');
  url+='?tabla='+tabla+'&medicion='+medicion+'&indicador='+indicador;
  /*
  $.ajax({
    url: url_ajax,
    data: { tabla : tabla, medicion : medicion, indicador : indicador },
    type : 'POST',
    dataType : 'html',
    success : function(data) {
    },
  });
  */
  window.location.href=url;
});

/*
$('#btn-guardar-cambios').click(function(){
  prompt('Esta seguro de guardar los cambios realizados?.\n Este paso reemplazara sin marcha atras los datos anteriores.');
});
*/

// BEGIN: FUNCION DESACTIVAR COMBOBOX
function desactivarComboBox(controles){
  for(i=0;i<controles.length;i++){
    $('#'+controles[i]).html('<option value="0" selected="selected" style="display: none;">Seleccione '+controles[i]+'...</option>');
    $('#'+controles[i]).attr('disabled',true);
  }
}
// END: FUNCION DESACTIVAR COMBOBOX