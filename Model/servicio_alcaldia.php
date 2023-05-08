<?php
class Servicio_Alcaldia
{
	
	private $pdo;

	public $id_servicio_alcaldia;
	public $cod1;
	public $cod2;
	public $cod3;
	public $cod4;
	public $descripcion_servicio;
	public $descripcion_servicio_abreviado;
	public $unidad_medida;
	public $tarifa_actual;
	public $tarifa_anterior;
	public $periodo_vigencia_tarifa;
	public $tipo_concepto;
	public $tipo_cobro;

	function __CONSTRUCT()
	{
		try {
			$this->pdo = Conexion::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Listar_servicios(){
		try {
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM meta_servicios_alcaldia WHERE estado_servicios = 1;");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function obtenerServicio($position){
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `meta_servicios_alcaldia` LIMIT $position, 1;");
			$stm->execute(array());

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getting($cod1, $cod2, $cod3, $cod4){
		try {
			$stm = $this->pdo->prepare("SELECT * FROM meta_servicios_alcaldia WHERE cod1 = ? AND cod2 = ? AND cod3 = ? AND cod4 = ?");
			$stm->execute(array($cod1, $cod2, $cod3, $cod4));

			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Eliminar($cod1, $cod2, $cod3, $cod4){
		try {
			$stm = $this->pdo->prepare("CALL eliminar_servicio_alcaldia(?,?,?,?)");
			$stm->execute(array($cod1, $cod2, $cod3, $cod4));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Actualizar($data){
		try {
			$sql = "UPDATE meta_servicios_alcaldia SET cod1=?, cod2=?, cod3=?, cod4=?, descripcion_servicio=?, descripcion_servicio_abreviado=?, unidad_medida=?, tarifa_actual=?, tarifa_anterior=?, periodo_vigencia_tarifa=?, tipo_concepto=?, tipo_cobro=? WHERE estado_servicios = 1 AND cod1 = ? AND cod2 = ? AND cod3 = ? AND cod4 = ?";

			$this->pdo->prepare($sql)->execute(
				array(
					$data->cod1, 
					$data->cod2,
					$data->cod3, 
					$data->cod4,
					$data->descripcion_servicio,
					$data->descripcion_servicio_abreviado,
					$data->unidad_medida,
					$data->tarifa_actual,
					$data->tarifa_anterior,
					$data->periodo_vigencia_tarifa,
					$data->tipo_concepto,
					$data->tipo_cobro
			));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Registrar($data){
		try {
			$sql = "INSERT INTO meta_servicios_alcaldia (cod1, cod2, cod3, cod4, descripcion_servicio, descripcion_servicio_abreviado, unidad_medida, tarifa_actual, tarifa_anterior, periodo_vigencia_tarifa, tipo_concepto, tipo_cobro) VALUES(?,?,?,?,?,?,?,?,?,?,?,?);";

			$this->pdo->prepare($sql)->execute(
				array(
					$data->cod1, 
					$data->cod2,
					$data->cod3, 
					$data->cod4,
					$data->descripcion_servicio,
					$data->descripcion_servicio_abreviado,
					$data->unidad_medida,
					$data->tarifa_actual,
					$data->tarifa_anterior,
					$data->periodo_vigencia_tarifa,
					$data->tipo_concepto,
					$data->tipo_cobro
			));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}
?>