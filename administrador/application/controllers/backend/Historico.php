<?php
class Historico extends CI_Controller{

  public function __construct(){
    parent::__construct();
    // modelos
    $this->load->model('historico_model');
    $this->load->model('actividad_economica_model');
    $this->load->model('indicador_model');
    // $this->load->model('usuario_model');
    // $this->load->model('perfil_model');
    //$this->load->model('navegacion_model');
  }

  public function index(){
    if($this->session->flashdata('mensaje')){
      $data['mensaje'] = $this->session->flashdata('mensaje');
    }elseif ($this->session->flashdata('error')){ 
      $data['error'] = $this->session->flashdata('error');
    }
    $data['menu_historico'] = true;
  	$data['titulo'] = 'Historicos';
  	$data['actividades'] = $this->actividad_economica_model->get_all('id, descripcion',array(),'','','descripcion','');
    $this->load->view('backend/historico/historico_list_view',$data);  
  }

  public function grupos_json(){
    $id = $this->input->post('id');
    $data['grupos'] = $this->historico_model->get_all('id_InHist, campos, tabla, ruta',array('id_actividad_economica'=>$id),'','','campos','');
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($data,JSON_NUMERIC_CHECK);
    exit(); 
  }

  public function mediciones_json(){
    $tabla = $this->input->post('tabla');
    $this->indicador_model->set_table_name($tabla);
    $data['mediciones'] = $this->indicador_model->get_all('medicion_indicador',array(),'','','medicion_indicador','medicion_indicador');
    $data['indicador'] = $this->historico_model->get_indicador_by_tabla($tabla);
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($data,JSON_NUMERIC_CHECK);
    exit(); 
  }    

  public function indicadores_json(){
    $tabla = $this->input->post('tabla');
    $medicion = $this->input->post('medicion');
    $this->indicador_model->set_table_name($tabla);
    $data['indicadores'] = $this->indicador_model->get_all('B',array('medicion_indicador'=>$medicion),'','','B','B');
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($data,JSON_NUMERIC_CHECK);
    exit(); 
  }

  public function table_json(){
    $tabla = $this->input->post('tabla');
    $medicion = $this->input->post('medicion');
    $indicador = $this->input->post('indicador');
    $this->indicador_model->set_table_name($tabla);
    $tabla = $this->indicador_model->execute_sql("SELECT * FROM $tabla WHERE medicion_indicador='$medicion' AND B='$indicador'");

/*
    $tabla = 'cnacionales';
    $medicion = 'Constantes';
    $indicador = 'BENI: PRODUCTO INTERNO BRUTO, SEGÚN ACTIVIDAD ECONÓMICA';

    $this->indicador_model->set_table_name($tabla);
    $tabla = $this->indicador_model->execute_sql("SELECT * FROM $tabla WHERE medicion_indicador='$medicion' AND B='$indicador'");
*/

    $tabla_final=array();
    foreach ($tabla as $t) {
      $tabla_final[]=array(
        'id' => $t['id'],
        'desagregacion' => $t['desagregacion'],
        'medicion' => $t['medicion_indicador'],
        'unidad_medida' => $t['D'],
        'cobertura' => $t['C'],
        'descripcion' => $t['DESCRIPCION'],
        // 'archivo' => $t['A'],
        'valores' => $this->cargar_datos($t),
      );
    }

//    print_r($tabla_final);
    
    $data['gestiones']=$this->get_head_table($tabla);
    $data['tabla'] = $tabla_final;
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($data,JSON_NUMERIC_CHECK);
    exit();
  }

  public function download_excel(){
    $tabla = $this->input->get('tabla');
    $medicion = $this->input->get('medicion');
    $indicador = $this->input->get('indicador');
    $this->indicador_model->set_table_name($tabla);
    $tabla_datos = $this->indicador_model->execute_sql("SELECT * FROM $tabla WHERE medicion_indicador='$medicion' AND B='$indicador'");
    // Preparando datos
    $indicador=$tabla_datos[0]['B'];
    $desagregacion=$tabla_datos[0]['desagregacion'];
    $medicion=$tabla_datos[0]['medicion_indicador'];
    $unidad_medida=$tabla_datos[0]['D'];
    $cobertura=$tabla_datos[0]['C'];
    $nombre_archivo=$tabla_datos[0]['A'];
    // Generando documento excel
    $this->load->library('excel');
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->SetCellValue('B1', $indicador);
    $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Desagregacion:');
    $objPHPExcel->getActiveSheet()->SetCellValue('B2', $desagregacion);
    $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Medicion:');
    $objPHPExcel->getActiveSheet()->SetCellValue('B3', $medicion);
    $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Unidad de medida:');
    $objPHPExcel->getActiveSheet()->SetCellValue('B4', $unidad_medida);
    $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Cobertura:');
    $objPHPExcel->getActiveSheet()->SetCellValue('B5', $cobertura);
    // Ajuntando ancho de la columna A y B
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    // Formato para el titulo en A1 y B1
    $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray(array(
      'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'ffffff'),
        'size'  => 14,
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '366092')
      ),
    ));
    // formato de bloqueo celdas
    $this->bloquear_celdas($objPHPExcel,array('A2','A3','A4','A5'));
    // encabezado de tabla para los indicadores
    $ini_fil=7;
    $count_fil=$ini_fil;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $count_fil, 'Codigo');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $count_fil, 'Descripcion');
    $ini=$tabla_datos[0]['ini'];
    $fin=$tabla_datos[0]['fin'];    
    $head=array_keys((array)$tabla_datos[0]);
    $count_col=2;
    for($i=$ini;$i<=$fin;$i++) {
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($count_col, $count_fil, $head[$i]);
      $count_col++;
    }
    $objPHPExcel->getActiveSheet()->getStyle('A'.$count_fil.':'.PHPExcel_Cell::stringFromColumnIndex($count_col-1).$count_fil)->applyFromArray(array(
      'font'  => array(
        'color' => array('rgb' => 'ffffff'),
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '366092')
      ),
    ));
    // Valores del indicador
    $count_fil++;
    foreach ($tabla_datos as $t) {
      $count_col=0;
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($count_col, $count_fil, $t['id']);
      $count_col++;
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($count_col, $count_fil, $t['DESCRIPCION']);
      $count_col++;
      $tabla=array_values($t);
      for($j=$ini;$j<=$fin;$j++) {
        if(isset($tabla[$j])){
          $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($count_col, $count_fil, $tabla[$j]);
        }else{
          $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($count_col, $count_fil, '');
        }
        $count_col++;      
      }
      $count_fil++;
    }
    // Pintando columna de codigos
    $objPHPExcel->getActiveSheet()->getStyle('A'.$ini_fil.':A'.($count_fil-1))->applyFromArray(array(
      'font'  => array(
        'color' => array('rgb' => 'ffffff'),
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '366092')
      ),
    ));
    // Retornando documento excel
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition: attachment; filename=$nombre_archivo.xlsx");
    ob_clean();
    $objWriter->save('php://output');
  }

  public function upload_excel(){
    $config['upload_path'] = './resources/uploads/';
    // $config['allowed_types'] = 'csv';
    $config['allowed_types'] = 'xlsx|xls';
    $config['max_size'] = '5000';
    $config['file_name'] = 'upload_' . time();

    $this->load->library('upload', $config);

    if(!$this->upload->do_upload('archivo_excel')){
      $this->session->set_flashdata('error', $this->upload->display_errors());
      redirect('backend/historico');
    }else{
      $tabla = $this->input->post('txt_upload_tabla');
      $indicador = $this->input->post('txt_upload_indicador');
      // $usuario_sesion = get_user_session();
      // Abriendo archivo que se ha subido al servidor
      $file_info = $this->upload->data();
      $filepath = "./resources/uploads/" . $file_info['file_name'];
      $this->load->library('excel');
      // Identificando el tipo de archivo
      $inputFileType = PHPExcel_IOFactory::identify($filepath);
      $objReader = PHPExcel_IOFactory::createReader($inputFileType);
      $objPHPExcel  = $objReader->load($filepath);
      
      // Obteniendo datos del archivo
      $objPHPExcel->setActiveSheetIndex(0);
      $xls_indicador=$objPHPExcel->getActiveSheet()->getCell('B1')->getValue();
      if($xls_indicador==$indicador){
        // Recuperando encabezado de la tabla, contando columnas
        $head=array();
        $count_col=0;
        $count_fil=7;
        $cell=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($count_col, $count_fil)->getValue();
        while($cell!='' && $cell!=null){
          $count_col++;
          $head[]=$cell;
          $cell=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($count_col, $count_fil)->getValue();
        }
        $nro_col=count($head);
        // Guardar en la base de datos
        $this->indicador_model->set_table_name($tabla);
        $count_col=0;
        $count_fil=8;
        $cell=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($count_col, $count_fil)->getValue();
        while($cell!='' && $cell!=null){
          $data=array();
          $id = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $count_fil)->getValue();
          //$sql="UPDATE $tabla SET DESCRIPCION='".$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $count_fil)->getValue()."'";
          $data['DESCRIPCION'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $count_fil)->getValue();
          for($i=2;$i<$nro_col;$i++){
            $cell=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($i, $count_fil)->getValue();
            //$sql.=",`$head[$i]`='".$cell."'";
            $data["`".$head[$i]."`"]=isset($cell)?strval($cell):'';
          }
          //$sql.=" WHERE id=$id";
          //$this->indicador_model->execute_sql_no_return($sql);
          $this->indicador_model->update($data,$id);
          $count_fil++;
          $cell=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($count_col, $count_fil)->getValue();
        }
        // print_r($head);
        $this->session->set_flashdata('mensaje', '<strong>CORRECTO!</strong> Los datos fueron guardados correctamente para "<strong>'.$indicador.'</strong>".');
        redirect('backend/historico');
      }else{
        // Mensaje de error
        $this->session->set_flashdata('error', '<strong>ERROR!</strong> El archivo excel que desea subir no corresponde al indicador seleccionado. Se recomienda volver a descargar el archivo excel y volverlo a editar sin modificar las celdas de color azul.');
        redirect('backend/historico');
      }
    }

    $this->load->library('upload', $config);
  }

  private function bloquear_celdas($objPHPExcel,$celdas){
    $styleArray = array(
      'font'  => array(
        'color' => array('rgb' => 'ffffff'),
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '366092')
      ),
    );
    foreach ($celdas as $celda) {
      $objPHPExcel->getActiveSheet()->getStyle($celda)->applyFromArray($styleArray);
    }
  }

  private function get_head_table($tabla){
    $ini=$tabla[0]['ini'];
    $fin=$tabla[0]['fin'];
    $head=array_keys((array)$tabla[0]);
    $gestiones=array();
    for($i=$ini;$i<=$fin;$i++) {
      $gestiones[]=$head[$i];
    }
    return $gestiones;
  }

  private function cargar_datos($tabla){
    $datos=array();
    $ini=$tabla['ini'];
    $fin=$tabla['fin'];
    $tabla=array_values($tabla);
    for($i=$ini;$i<=$fin;$i++) {
      if(isset($tabla[$i])){
        $datos[]=$tabla[$i];  
      }else{
        $datos[]='';
      }      
    }
    return $datos;
  }

}
