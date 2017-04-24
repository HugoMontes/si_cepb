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
    // $data['grupos'] = $this->historico_model->get_all('id_InHist, campos, tabla, ruta',array('id_actividad_economica'=>$id),'','','campos','');
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
//    $tabla = $this->indicador_model->execute_sql("SELECT * FROM $indicador->tabla WHERE anio='$gestion'");

    $array_clasificacion = $this->indicador_model->get_all('clasificacion', array('anio'=>$gestion), '', '', 'nro ASC', '', 'clasificacion');
    //$array_paises = $this->indicador_model->get_all('pais', array(), '', '', '', '', 'pais');
    foreach ($array_clasificacion as $val_clasificacion) {
      // $valores=$this->indicador_model->execute_sql("SELECT * FROM $indicador->tabla WHERE anio='$gestion' AND clasificacion='$clasificacion'");
      /*
      $registro=array();
      foreach ($array_paises as $pais) {
        $registro[$pais]=$this->indicador_model->get_all('',array('anio'=>$gestion,'clasificacion'=>$clasificacion), '', '', '', '', 'pais');
      }
      */
      $tabla[]=array(
        'nombre_fila'=>$val_clasificacion->clasificacion,
        'paises'=> $this->indicador_model->get_all('id, pais, monto',array('anio'=>$gestion,'clasificacion'=>$val_clasificacion->clasificacion), '', '', 'pais ASC', '', 'pais'),
      );
      //$tabla['paises']=$this->indicador_model->get_all('pais, monto',array('anio'=>$gestion,'clasificacion'=>$val_clasificacion->clasificacion), '', '', '', '', 'pais');
      // $tabla['clasificacion']
    }

    /*
      $id = 1;
      $gestion = 2016;

      $this->indicador_model->set_table_name($tabla);
      $tabla = $this->indicador_model->execute_sql("SELECT * FROM $tabla WHERE medicion_indicador='$medicion' AND B='$indicador'");
    */

/*
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
*/
    //    print_r($tabla_final);
    
//    $data['gestiones']=$this->get_head_table($tabla);
    $data['tabla'] = $tabla;
    header('Content-type: application/json; charset=utf-8');
    // echo json_encode($data,JSON_NUMERIC_CHECK);
    echo json_encode($data);
    exit();
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