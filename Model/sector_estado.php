<?php 

class Sector_Estado
{
	private $pdo;

	public $cod_sector;
	public $sector_estado;
	public $estado_sector;

	public function __CONSTRUCT()
	{
		try {
			$this->pdo = Conexion::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Listar_caracteristica(){
		try {
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM meta_sector_estado WHERE estado_sector = 1;");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getting($cod_sector){
		try {
			$stm = $this->pdo->prepare("SELECT * FROM meta_sector_estado WHERE cod_sector = ?;");
			$stm->execute(array($cod_sector));

			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Eliminar($cod_sector){
		try {
			$stm = $this->pdo->prepare("CALL eliminar_sector(?);");
			$stm->execute(array($cod_sector));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Actualizar($data){
		try {
			$sql = "UPDATE meta_sector_estado SET 
			cod_sector = ?,
			sector_estado = ? 
			WHERE cod_sector = ?";

			$this->pdo->prepare($sql)
			->execute(
				array(
					$data->cod_sector,
					$data->sector_estado,
					$data->cod_sector
			));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Registrar($data){
		try {
			$sql = "INSERT INTO `meta_sector_estado`(cod_sector, sector_estado) VALUES (?, ?);";

			$this->pdo->prepare($sql)->execute(array(
					$data->cod_sector,
					$data->sector_estado
				));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}
?>