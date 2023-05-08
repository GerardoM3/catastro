<?php

/*  ┌────┬─────────────────────────────────────────────────────────────────────────────────┬────┐  */
/*  |****|   NOTA: En los modelos. Dentro de las funciones, si sólo traerá un registro,    |****|  */
/*  |****|   evitemos utilizar fetchAll, pues nos puede traer errores                      |****|  */
/*  └────┴─────────────────────────────────────────────────────────────────────────────────┴────┘  */

require_once 'Model/servicio_alcaldia.php';

class ServicioController{

	private $model;
	
	function __CONSTRUCT()
	{
		$this->model = new Servicio_Alcaldia();
	}

	public function Index_Servicios(){
		require_once 'View/servicios_alcaldia/header.php';
		require_once 'View/servicios_alcaldia/servicio_alcaldia.php';
		require_once 'View/servicios_alcaldia/footer.php';
	}

	public function Crud_Servicio(){
		$alm = new Servicio_Alcaldia();

		if (isset($_REQUEST['cod1'], $_REQUEST['cod2'], $_REQUEST['cod3'], $_REQUEST['cod4'])) {
			$alm = $this->model->getting($_REQUEST['cod1'], $_REQUEST['cod2'], $_REQUEST['cod3'], $_REQUEST['cod4']);
		}

		require_once 'View/servicios_alcaldia/header.php';
		require_once 'View/servicios_alcaldia/servicio_alcaldia_editar.php';
		require_once 'View/servicios_alcaldia/footer.php';
	}

	public function Guardar_Servicio(){
		$alm = new Servicio_Alcaldia();

		$alm->id_servicio_alcaldia = $_REQUEST['id_servicio_alcaldia'];
		$alm->cod1 = $_REQUEST['cod1'];
		$alm->cod2 = $_REQUEST['cod2'];
		$alm->cod3 = $_REQUEST['cod3'];
		$alm->cod4 = $_REQUEST['cod4'];
		$alm->descripcion_servicio = $_REQUEST['descripcion_servicio'];
		$alm->descripcion_servicio_abreviado = $_REQUEST['descripcion_servicio_abreviado'];
		$alm->unidad_medida = $_REQUEST['unidad_medida'];
		$alm->tarifa_actual = $_REQUEST['tarifa_actual'];
		$alm->tarifa_anterior = $_REQUEST['tarifa_anterior'];
		$alm->periodo_vigencia_tarifa = $_REQUEST['periodo_vigencia_tarifa'];
		$alm->tipo_concepto = $_REQUEST['tipo_concepto'];
		$alm->tipo_cobro = $_REQUEST['tipo_cobro'];

		//$alm->cod1 > 0 AND $alm->cod2 > 0 AND $alm->cod3 > 0 AND $alm->cod4 > 0 ? $this->model->Actualizar($alm) : $this->model->Registrar($alm);

		if($alm->id_servicio_alcaldia > 0){
			$this->model->Actualizar($alm);
		}else{
			$this->model->Registrar($alm);
		}

		header('Location: index.php?c=Servicio');

	}

	public function Eliminar(){
		$this->model->Eliminar($_REQUEST['cod1'], $_REQUEST['cod2'], $_REQUEST['cod3'], $_REQUEST['cod4']);
		header('Location: index.php?c=Servicio');
	}
}
?>