<?php
class Contribuyente
//modificar..
{
	private $pdo;
    
    public $correlativo;
    public $id_contribuyente;
    public $n_contribuyente;
    public $nombre_contribuyente;
    public $apellido_contribuyente;
    public $direccion_contribuyente;
    public $dui_contribuyente;
    public $telefono_contribuyente;
    public $estado_contribuyente;
    public $id_inmueble;
	public $zona_comunidad_inmueble;
	public $direccion_inmueble;
	public $cod_sector;
	public $sector_estado;
	public $id_dimension;
	public $norte_longitud;
	public $este_longitud;
	public $oeste_longitud;
	public $sur_longitud;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Conexion::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	/*public function Listar() {try {$result = array(); $stm = $this->pdo->prepare("SELECT CONCAT(contribuyente.id_contribuyente, '-', contribuyente.correlativo) AS n_contribuyente, CONCAT(contribuyente.nombre_contribuyente, ' ', contribuyente.apellido_contribuyente) AS nombre_contribuyente, CONCAT(contribuyente.comunidad_contribuyente, ' ', contribuyente.direccion_contribuyente) AS direccion_contribuyente, meta_municipio.municipio, meta_departamento.departamento, contribuyente.dui_contribuyente, contribuyente.telefono_contribuyente FROM contribuyente INNER JOIN meta_municipio ON meta_municipio.cod_municipio = contribuyente.cod_municipio INNER JOIN meta_departamento ON meta_departamento.cod_departamento = contribuyente.cod_departamento WHERE contribuyente.estado_contribuyente = 1;"); $stm->execute(); return $stm->fetchAll(PDO::FETCH_OBJ); } catch(Exception $e) {die($e->getMessage()); } }*/
	public function ListarInmuebleContri($correlativo){
		try {
			$stm = $this->pdo->prepare("SELECT * FROM inmueble NATURAL JOIN contribuyente NATURAL JOIN meta_zona_inmueble NATURAL JOIN meta_sector_estado NATURAL JOIN meta_dimension_inmueble WHERE correlativo = ? AND estado_inmueble = 1;");
			$stm->execute(array($correlativo));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

    public function Listar()
    {
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM contribuyente WHERE estado_contribuyente = 1;");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

	public function Listar2($condicion)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM contribuyente WHERE estado_contribuyente = 1 ? ;");
			$stm->execute(array($condicion));

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function getting($id_contribuyente, $correlativo)
	{
		try 
		{
			$stm = $this->pdo->prepare("SELECT * FROM contribuyente WHERE id_contribuyente = ? AND correlativo = ?");
			          

			$stm->execute(array($id_contribuyente, $correlativo));

			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function listarZona(){
        try{
            $stm = $this->pdo->prepare("SELECT * FROM meta_zona_inmueble;");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function listarSector(){
        try{
            $stm = $this->pdo->prepare("SELECT * FROM meta_sector_estado;");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function listar_Zona($id_inmueble){
        try{
            $stm = $this->pdo->prepare("SELECT * FROM inmueble NATURAL JOIN meta_zona_inmueble WHERE id_inmueble = ?;");
            $stm->execute(array($id_inmueble));
            return $stm->fetch(PDO::FETCH_OBJ);
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

	public function Eliminar($id_contribuyente, $correlativo)
	{
		try 
		{
			/*$stm = $this->pdo->prepare("DELETE FROM contribuyente WHERE idpersona = ?");*/
			$stm = $this->pdo->prepare("CALL eliminar_contribuyente(?, ?);");

			$stm->execute(array($id_contribuyente, $correlativo));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE contribuyente SET 
						nombre_contribuyente = ?, 
						apellido_contribuyente = ?,
                        direccion_contribuyente        = ?,
						dui_contribuyente            = ?,
						telefono_contribuyente = ?
				    WHERE id_contribuyente = ? AND correlativo = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->nombre_contribuyente, 
                        $data->apellido_contribuyente,
                        $data->direccion_contribuyente,
                        $data->dui_contribuyente,
                        $data->telefono_contribuyente,
                        $data->id_contribuyente,
                        $data->correlativo
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar($data)
	{
		try 
		{
		$sql = "INSERT INTO `contribuyente` (nombre_contribuyente, apellido_contribuyente,  direccion_contribuyente, dui_contribuyente, telefono_contribuyente) 
		        VALUES (?, ?, ?, ?, ?);";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->nombre_contribuyente, 
                    $data->apellido_contribuyente,
                    $data->direccion_contribuyente,
                    $data->dui_contribuyente,
                    $data->telefono_contribuyente                   
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

    public function actualizarDimension($data){
        try {
            $sql = "UPDATE meta_dimension_inmueble SET norte_longitud = ?, este_longitud = ?, oeste_longitud = ?, sur_longitud = ? WHERE id_dimension = ?;";
            $this->pdo->prepare($sql)->execute(array($data->norte_longitud, $data->este_longitud, $data->oeste_longitud, $data->sur_longitud, $data->id_dimension));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    

    public function actualizarInmueble($data)
    {
        try 
        {
            $sql3 = "UPDATE inmueble SET direccion_inmueble = ? WHERE id_inmueble = ?";
            $this->pdo->prepare($sql3)->execute(array($data->direccion_inmueble, $data->id_inmueble));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    /*Sección de registro de inmueble*/

    

    public function Registrar_dimension($data)
    {
        try {
            /*  CREAR UNA FUNCIÓN PARA INSERTAR LAS DIMENSIONES DEL INMUEBLE  */
            $this->pdo->beginTransaction();

            /*
            Instrucción SQL, llamando un procedimiento almacenado para insertar dimensión del inmueble
            */
            $sql = "CALL insertar_dimension(?, ?, ?, ?);";

            $this->pdo->prepare($sql)->execute(
                array(
                    $data->norte_longitud,
                    $data->este_longitud,
                    $data->oeste_longitud,
                    $data->sur_longitud
                )
            );
            $res1 = $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            die($e->getMessage());
        }
    }

    public function obtener_IDDimension()
    {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT id_dimension FROM meta_dimension_inmueble ORDER BY id_dimension DESC LIMIT 1;");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar_inmueble($data)
    {
        try 
        {

            /*  CREAR UNA FUNCIÓN PARA INSERTAR UN INMUEBLE, MANDANDO A LLAMAR LOS ID'S DE LA DIMENSION Y CARACTERÍSTICA DEL MISMO  */
            $this->pdo->beginTransaction();

            $sql = "INSERT INTO `inmueble` (cod_zona, direccion_inmueble, correlativo,cod_sector, id_dimension) VALUES ( ?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)->execute(
                    array(
                       
                        $data->cod_zona,
                        $data->direccion_inmueble,
                        $data->correlativo,
                        $data->cod_sector,
                        $data->id_dimension
                    )
                );

            $res1 = $this->pdo->commit();
        } catch (Exception $e) 
        {
            $this->pdo->rollback();
            die($e->getMessage());
        }
    }

    public function obtenerCorrelativo($correlativo){
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT correlativo FROM contribuyente WHERE correlativo = ?;");
            $stm->execute(array($correlativo));

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerCorrelativo2(){
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT correlativo FROM contribuyente ORDER BY correlativo DESC Limit 1;");
            $stm->execute(array());

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerCorrelativo3($correlativo){
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM contribuyente WHERE correlativo = ?;");
            $stm->execute(array($correlativo));

            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*public function Listar()
    {
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM inmueble 
			INNER JOIN meta_caracteristica_inmueble ON inmueble.id_caracteristica = meta_caracteristica_inmueble.id_caracteristica 
			INNER JOIN meta_dimension_inmueble ON inmueble.id_dimension = meta_dimension_inmueble.id_dimension 
			INNER JOIN contribuyente ON inmueble.correlativo = contribuyente.correlativo WHERE estado_inmueble = 1;");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }*/
}
require_once 'Model/inmueble.php';

class Servicios_Contribuyente extends Contribuyente
{
    public $id_servicio_contribuyente;
    public $id_servicio_alcaldia;
    public $norte_servicio;
    public $este_servicio;
    public $oeste_servicio;
    public $sur_servicio;
    public $total_pago_servicio;

    /*Variables del objeto  */
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
    public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Conexion::StartUp();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}

        
	}

    public function registrarServicioContribuyente($dataContri, $dataInmueble, $dataServicios, $north, $east, $west, $south, $total){
        try {
            $stm = $this->pdo->prepare("INSERT INTO servicio_contribuyente
            (correlativo, id_inmueble, id_servicio_alcaldia, norte_servicio, este_servicio, oeste_servicio, sur_servicio, total_pago_servicio) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
            $stm->execute(array(
                $dataContri,
                $dataInmueble,
                $dataServicios,
                $north,
                $east,
                $west,
                $south,
                $total
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerServicioContribuyente($id_inmueble)
	{
		try 
		{
			$stm = $this->pdo->prepare("SELECT * FROM servicio_contribuyente NATURAL JOIN contribuyente NATURAL JOIN inmueble NATURAL JOIN meta_dimension_inmueble NATURAL JOIN meta_zona_inmueble NATURAL JOIN meta_sector_estado NATURAL JOIN meta_servicios_alcaldia WHERE id_inmueble = ? AND estado_servicio_contribuyente = 1;");
			          

			$stm->execute(array($id_inmueble));

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

    public function eliminarServicio($id_servicio_contribuyente){
        try {
            $stm = $this->pdo->prepare("CALL eliminar_servicio_contribuyente(?)");
            $stm->execute(array($id_servicio_contribuyente));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}

?>