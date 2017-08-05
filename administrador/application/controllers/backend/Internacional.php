<?php
class Internacional extends CI_Controller{

  public function __construct(){
    parent::__construct();
    // modelos
    $this->load->model('internacional_model');
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
    $data['menu_internacional'] = true;
  	$data['titulo'] = 'Internacional';
  	$data['fuentes'] = $this->internacional_model->get_all('',array('estado'=>1),'','','campos','');
    $this->load->view('backend/internacional/internacional_list_view',$data);  
  }

  public function gestiones_json(){
    $id = $this->input->post('id');
    $indicador = $this->internacional_model->get($id);
    $this->indicador_model->set_table_name($indicador->tabla);
    $data['gestiones'] = $this->indicador_model->get_all('anio', array(), '', '', 'anio ASC', '', 'anio');
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($data,JSON_NUMERIC_CHECK);
    exit(); 
  }

  public function table_json(){
    $id = $this->input->post('id');
    $gestion = $this->input->post('gestion');
    $tabla=array();
    $indicador = $this->internacional_model->get($id);
    $this->indicador_model->set_table_name($indicador->tabla);
    $array_clasificacion = $this->indicador_model->get_all('clasificacion', array('anio'=>$gestion), '', '', 'nro ASC', '', 'clasificacion');
    foreach ($array_clasificacion as $val_clasificacion) {
      $tabla[]=array(
        'nombre_fila'=>$val_clasificacion->clasificacion,
        'paises'=> $this->indicador_model->get_all('id, pais, monto',array('anio'=>$gestion,'clasificacion'=>$val_clasificacion->clasificacion), '', '', 'pais ASC', '', 'pais'),
      );
    };
    $data['tabla'] = $tabla;
    header('Content-type: application/json; charset=utf-8');
    // echo json_encode($data,JSON_NUMERIC_CHECK);
    echo json_encode($data);
    exit();
  }


  /**
   * Autor: Hugo Montes
   * Descripcion: Descarga del documento excel para edicion
   */
  public function download_excel(){
    $id = $this->input->get('id');
    $gestion = $this->input->get('gestion');
    // Recuperando datos de la BD
    $indicador = $this->internacional_model->get($id);
    $this->indicador_model->set_table_name($indicador->tabla);
    $array_clasificacion = $this->indicador_model->get_all('clasificacion', array('anio'=>$gestion), '', '', 'nro ASC', '', 'clasificacion');
    $tabla_datos=array();
    foreach ($array_clasificacion as $val_clasificacion) {
      $tabla_datos[]=array(
        'nombre_fila'=>$val_clasificacion->clasificacion,
        'paises'=> $this->indicador_model->get_all('id, pais, monto',array('anio'=>$gestion,'clasificacion'=>$val_clasificacion->clasificacion), '', '', 'pais ASC', '', 'pais'),
      );
    };
    
    // Preparando datos
    //$nombre_archivo='internacional';

    // Generando documento excel
    $this->load->library('excel');
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->SetCellValue('A1', $indicador->campos);

    // Ajuntando ancho de la columna A y B
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    //$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    
    // Formato para el titulo en A1 y B1
    $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray(array(
      'font'  => array(
        'bold'  => true,
        'size'  => 14,
      ),
    ));
    
    // encabezado de tabla
    $ini_fil=2;
    $count_fil=$ini_fil;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $count_fil, 'Clasificacion');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $count_fil, 'Descripcion');
    $count_col=1;
    for($i=0;$i<=count($tabla_datos[0]['paises']);$i++) {
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($count_col, $count_fil, $tabla_datos[0]['paises'][$i]->pais);
      $count_col++;
    }
    $objPHPExcel->getActiveSheet()->getStyle('A'.$count_fil.':'.PHPExcel_Cell::stringFromColumnIndex($count_col-2).$count_fil)->applyFromArray(array(
      'font'  => array(
        'color' => array('rgb' => 'ffffff'),
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '366092')
      ),
    ));
    
    // Valores de la tabla
    $count_fil++;
    foreach ($tabla_datos as $t) {
      $count_col=0;
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($count_col, $count_fil, $t['nombre_fila']);
      $count_col++;
      foreach($t['paises'] as $pais) {
        if(isset($pais->monto)){
          $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($count_col, $count_fil, $pais->monto);
        }else{
          $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($count_col, $count_fil, '');
        }
        $count_col++;      
      }
      $count_fil++;
    }

    // Pintando columna de codigos
    /*
    $objPHPExcel->getActiveSheet()->getStyle('A'.$ini_fil.':A'.($count_fil-1))->applyFromArray(array(
      'font'  => array(
        'color' => array('rgb' => 'ffffff'),
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '366092')
      ),
    ));
    */

    // Retornando documento excel
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition: attachment; filename=$indicador->archivo");
    ob_clean();
    $objWriter->save('php://output');    
  }

    public function upload_excel(){
/*
    $config['upload_path'] = './resources/uploads/';
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
*/
    redirect('backend/internacional');
  }
}