<?php 

/*  ┌────┬─────────────────────────────────────────────────────────────────────────────────┬────┐  */
/*  |****|   NOTA: En los modelos. Dentro de las funciones, si sólo traerá un registro,    |****|  */
/*  |****|   evitemos utilizar fetchAll, pues nos puede traer errores                      |****|  */
/*  └────┴─────────────────────────────────────────────────────────────────────────────────┴────┘  */

require_once 'Model/sector_estado.php';

class SectorController{
	
	private $model;

	function __CONSTRUCT()
	{
		$this->model = new Sector_Estado();
	}

	public function Index_Sectores(){
		require_once 'View/sectores_estados/header.php';
		require_once 'View/sectores_estados/sector_estado.php';
		require_once 'View/sectores_estados/footer.php';
	}

	public function Crud_Sector(){
		$alm_crud = new Sector_Estado();

		if(isset($_REQUEST['cod_sector'])){
			$alm_crud = $this->model->getting($_REQUEST['cod_sector']);
		}

		require_once 'View/sectores_estados/header.php';
		require_once 'View/sectores_estados/sector_estado_editar.php';
		require_once 'View/sectores_estados/footer.php';
	}

	public function Guardar_Sector(){
		$alm = new Sector_Estado();
		$alm->cod_sector = $_REQUEST['cod_sector'];
		$alm->sector_estado = $_REQUEST['sector_estado'];

		/*$alm->cod_sector != null
		? $this->model->Actualizar($alm) 
		: $this->model->Registrar($alm);*/
		$this->model->Registrar($alm);

		header('Location: index.php?c=Sector');
	}

	public function Actualizar_Sector(){
		$alm = new Sector_Estado;
		$alm->cod_sector = $_REQUEST['cod_sector'];
		$alm->sector_estado = $_REQUEST['sector_estado'];

		$this->model->Actualizar($alm);

		header('Location: index.php?c=Sector');
	}

	public function Eliminar(){
		$this->model->Eliminar($_REQUEST['cod_sector']);
		header('Location: index.php?c=Sector');
	}
}
?>