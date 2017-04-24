var url_ajax, id, gestion, out;

$('#fuente').on('change',function(){
  $('#pnl-editar-indicador').hide();
  url_ajax=$('#form-estadistico').attr('action')+'all/gestiones';
  id=$(this).val();
  $.ajax({
    url: url_ajax,
    data: { id : id },
    type : 'POST',
    dataType : 'json',
    success : function(data) {
      console.log(data);
      out='';
      for(i=0;i<data.gestiones.length;i++){
        out+='<option value="'+data.gestiones[i].anio+'">'+data.gestiones[i].anio+'</option>';
      }
      $('#periodo').html(out);
      $('#periodo').append('<option value="0" selected="selected" style="display: none;">Seleccione gestion...</option>');
      $('#periodo').attr('disabled',false);
    },
  });  
});

$('#periodo').on('change',function(){
  url_ajax=$('#form-estadistico').attr('action')+'all/data/table';
  gestion=$(this).val();
  $.ajax({
    url: url_ajax,
    data: { id : id, gestion : gestion },
    type : 'POST',
    dataType : 'json',
    success : function(data) {
      console.log(data);
      // ENCABEZADO DE LA TABLA
      out='<th>Clasificación</th>';
      for(i=0;i<data.tabla[0].paises.length;i++){
        out+='<th>'+data.tabla[0].paises[i].pais+'</th>';
      }
      $('#tbl-indicadores thead tr').html(out);
      // FILAS DE LA TABLA
      out='';
      for(i=0;i<data.tabla.length;i++){
        out+='<tr id="'+data.tabla[i].id+'">';
        out+='<td>'+data.tabla[i].nombre_fila+'</td>';
        for(j=0;j<data.tabla[i].paises.length;j++){
          out+='<td>'+data.tabla[i].paises[j].monto+'</td>';
        }        
        out+="</tr>";
      }
      $('#tbl-indicadores tbody').html(out);
      $('#pnl-editar-indicador').show();
    },
  }); 
});

$('#btn-download-excel').click(function(event){
  event.preventDefault();
  /*
  url=$(this).attr('href');
  url+='?tabla='+tabla+'&medicion='+medicion+'&indicador='+indicador;
  window.location.href=url;
  */
});