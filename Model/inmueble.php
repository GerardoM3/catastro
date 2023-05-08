<?php

/*  ┌────┬─────────────────────────────────────────────────────────────────────────┬────┐  */
/*  |****|   NOTA: En este archivo contiene funciones que deben ser eliminadas.    |****|  */
/*  |****|   En los comentarios está especificados las líneas a eliminar.          |****|  */
/*  |****|                                                                         |****|  */
/*  |****|   Las funciones a eliminar sólo aplica para el MVC de inmueble.         |****|  */
/*  └────┴─────────────────────────────────────────────────────────────────────────┴────┘  */


/*
Clase Inmueble (Objeto) con sus variables (sus Atributos).
*/
class Inmueble
{
    private $pdo;
    
    public $id_inmueble;
    public $cod_zona;
    public $zona_inmueble;
    public $direccion_inmueble;
    public $cod_sector;
    public $sector_estado;
    public $id_dimension;
    public $norte_longitud;
    public $este_longitud;
    public $oeste_longitud;
    public $sur_longitud;
    public $correlativo;
    public $nombre_contribuyente;
    public $apellido_contribuyente;
    public $direccion_contribuyente;
    public $dui_contribuyente;
    public $telefono_contribuyente;

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

    /*
    LISTAR TODOS LOS DATOS DE LA TABLA INMUEBLE Y DATOS DE OTRAS TABLAS ASOCIADOS A INMUEBLE

    Función simple que contiene las siguientes instrucciones dentro de él:
    Declara una línea con una instrucción de consulta SQL, mostrando todos los datos de la tabla inmueble con todos los datos las tablas 
    siguientes: meta_catacteristica_inmueble, meta_dimension_inmueble y contribuyente. Todos estos datos donde el estado del 
    inmueble sea activa (igual a 1).
    Finalmente ejecuta la instrucción de consulta SQL.
    Listo
    */

    public function Listar_inmueble()
    {
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM inmueble

INNER JOIN meta_zona_inmueble ON inmueble.cod_zona = meta_zona_inmueble.cod_zona 
INNER JOIN meta_sector_estado ON inmueble.cod_sector = meta_sector_estado.cod_sector
INNER JOIN meta_dimension_inmueble ON inmueble.id_dimension = meta_dimension_inmueble.id_dimension 
INNER JOIN contribuyente ON inmueble.correlativo = contribuyente.correlativo WHERE estado_inmueble = 1;");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    /*
    GETTING (OBTENIENDO) DATOS DE LA TABLA INMUEBLES

    Función que recoge el id del inmueble como parametro para obtener los datos relacionados a ese identificador.
    La función lo que hace es declarar una línea con una intrucción de consulta SQL, mostrando todos los datos que hay en la tabla inmueble, 
    junto con todos los datos de las tablas meta_caracteristica_inmueble, meta_dimension y contribuyente.
    Todos estos datos donde el identificador del inmueble sea igual al valor del parámetro de la función, y todos los datos que su estado de 
    inmueble sea activo (igual a 1).
    Finalmente ejecuta la instrucción de consulta SQL.
    */

    public function getting($id_inmueble)
    {
        try 
        {
            $stm = $this->pdo->prepare("SELECT * FROM inmueble  NATURAL JOIN meta_zona_inmueble NATURAL JOIN meta_sector_estado NATURAL JOIN meta_dimension_inmueble NATURAL JOIN contribuyente WHERE estado_inmueble = 1 AND id_inmueble = ?;");
                      

            $stm->execute(array($id_inmueble));
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

    public function listar_Zona($id_inmueble){
        try{
            $stm = $this->pdo->prepare("SELECT * FROM inmueble NATURAL JOIN meta_zona_inmueble WHERE id_inmueble = ?;");
            $stm->execute(array($id_inmueble));
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

    public function listar_Sector($id_inmueble){
        try{
            $stm = $this->pdo->prepare("SELECT * FROM inmueble NATURAL JOIN meta_sector_estado WHERE id_inmueble = ?;");
            $stm->execute(array($id_inmueble));
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    /*
    ELIMINAR INMUEBLE

    Función que recoge el id del inmueble como parametro para obtener los datos relacionados a ese identificador.
    La función lo que hace es declarar una línea con una instrucción SQL, que manda a llamar un procedimiento almacenado programado previamente en MySQL,
    y luego ejecuta la instrucción.
    */

    public function Eliminar($id_inmueble)
    {
        try 
        {
            $stm = $this->pdo
                        ->prepare("CALL eliminar_inmueble(?);");                     

            $stm->execute(array($id_inmueble));
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
            $sql3 = "UPDATE inmueble SET cod_zona = ?, cod_sector = ?, direccion_inmueble = ? WHERE id_inmueble = ?";
            $this->pdo->prepare($sql3)->execute(array($data->cod_zona, $data->cod_sector, $data->direccion_inmueble, $data->id_inmueble));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    /*
    Las siguientes líneas a partir de aquí son funciones para insertar datos a la 
    tabla inmueble y todos los datos de su dimensión y característica asociada al inmueble.

    */


    /*  ┌────┬───────────────────────────────────────────────────────────┬────┐  */
    /*  |****|   Primero se registra las características y guarda ID.    |****|  */
    /*  └────┴───────────────────────────────────────────────────────────┴────┘  */

    /* FUNCIÓN DE REGISTRO DE CARACTERÍSTICA ELIMINADA */

    /*  ┌────┬───────────────────────────────────────────────────────┬────┐  */
    /*  |****|   Segundo se registra las dimensiones y guarda ID.    |****|  */
    /*  └────┴───────────────────────────────────────────────────────┴────┘  */

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

    /*  ┌────┬─────────────────────────────────────────────────────────────────────────────────────────────────────────────────────┬────┐  */
    /*  |****|   Obtener el identificador de la característica  recién creada para colocarlo en el nuevo registro del inmueble.    |****|  */
    /*  └────┴─────────────────────────────────────────────────────────────────────────────────────────────────────────────────────┴────┘  */


    /*  ┌────┬───────────────────────────────────────────────────────────────────────────────────────────────────────────────┬────┐  */
    /*  |****|   Obtener el identificador de la dimensión recién creada para colocarlo en el nuevo registro del inmueble.    |****|  */
    /*  └────┴───────────────────────────────────────────────────────────────────────────────────────────────────────────────┴────┘  */

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

    /*  ┌────┬─────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────┬────┐  */
    /*  |****|   Finalmente registrar el inmueble con los datos de las otras dos tablas (característica y dimensión) registrados anteriormente.    |****|  */
    /*  └────┴─────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────┴────┘  */

    public function Registrar_inmueble($data)
    {
        try 
        {

            /*  CREAR UNA FUNCIÓN PARA INSERTAR UN INMUEBLE, MANDANDO A LLAMAR LOS ID'S DE LA DIMENSION Y CARACTERÍSTICA DEL MISMO  */
            $this->pdo->beginTransaction();

            $sql = "INSERT INTO `inmueble` (cod_zona, direccion_inmueble, correlativo,cod_sector, id_dimension) VALUES (?, ?, ?, ?, ?)";

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

    public function obtener_IDInmueble()
    {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT id_inmueble FROM inmueble ORDER BY id_inmueble DESC LIMIT 1;");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>