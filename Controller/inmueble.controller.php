<?php

/*  ┌────┬─────────────────────────────────────────────────────────────────────────────────┬────┐  */
/*  |****|   NOTA: En los modelos. Dentro de las funciones, si sólo traerá un registro,    |****|  */
/*  |****|   evitemos utilizar fetchAll, pues nos puede traer errores                      |****|  */
/*  └────┴─────────────────────────────────────────────────────────────────────────────────┴────┘  */

/* Importando todos los recursos que hay en Modelo. */
require_once 'Model/inmueble.php';
require_once 'Model/contribuyente.php';
require_once 'Model/servicio_alcaldia.php';

class InmuebleController{
    
    private $model;
    private $modelContri;
    private $modelServi;
    private $modelServicioContri;
    
    public function __CONSTRUCT(){
        $this->model = new Inmueble();
        $this->modelContri = new Contribuyente();
        $this->modelServi = new Servicio_Alcaldia();
        $this->modelServicioContri = new Servicios_Contribuyente();
    }
    
    /*
    Función para mostrar las vistas de index del inmueble, su cabecera y su pie de página.
    */
    public function Index_inmueble(){
        require_once 'View/inmuebles/header.php';
        require_once 'View/inmuebles/inmueble.php';
        require_once 'View/inmuebles/footer.php';
    }
    
    /*
    Función para mostrar las vistas de index del inmueble (versión para modificar, formulario), su cabecera
    y su pie de página
    */
    public function Crud(){
        $inmueble = new Inmueble();
        $contri = new Contribuyente();
        
        if( isset($_REQUEST['id_inmueble'])){
            $inmueble = $this->model->getting($_REQUEST['id_inmueble']);
        }
        if(isset($_REQUEST['correlativo'])){
            $contri = $this->modelContri->obtenerCorrelativo3($_REQUEST['correlativo']);
        }
        require_once 'View/inmuebles/header.php';
        require_once 'View/inmuebles/inmueble-editar.php';
        require_once 'View/inmuebles/footer.php';
    }

    /*
    Función que Registra o Modifica los datos.
    */
    
    public function Guardar(){
        $inmueble = new Inmueble();
        $contri = new Contribuyente();
        $servi = new Servicio_Alcaldia();
        
        $inmueble->id_inmueble = $_REQUEST['id_inmueble'];
        $inmueble->correlativo = $_REQUEST['correlativo'];
        $inmueble->cod_zona = $_REQUEST['cod_zona'];
        $inmueble->cod_sector = $_REQUEST['cod_sector'];
        $inmueble->id_dimension = $_REQUEST['id_dimension'];
        $inmueble->zona_inmueble = $_REQUEST['zona_inmueble'];
        $inmueble->direccion_inmueble = $_REQUEST['direccion_inmueble'];
        $inmueble->sector_estado = $_REQUEST['sector_estado'];
        $inmueble->norte_longitud = $_REQUEST['norte_longitud'];
        $inmueble->este_longitud = $_REQUEST['este_longitud'];
        $inmueble->oeste_longitud = $_REQUEST['oeste_longitud'];
        $inmueble->sur_longitud = $_REQUEST['sur_longitud'];
        
        

        // SI ID PERSONA ES MAYOR QUE CERO (0) INDICA QUE ES UNA ACTUALIZACIÓN DE ESA TUPLA EN LA TABLA PERSONA, SINO SIGNIFICA QUE ES UN NUEVO REGISTRO

        /*$inmueble->id_inmueble > 0 
           ? $this->model->Actualizar($inmueble)
           : $this->model->Registrar($inmueble);*/

       //EL CÓDIGO ANTERIOR ES EQUIVALENTE A UTILIZAR CONDICIONALES IF, TAL COMO SE MUESTRA EN EL COMENTARIO A CONTINUACIÓN:

        if ($inmueble->id_inmueble > 0 ) {
            $this->model->actualizarDimension($inmueble);
            $this->model->actualizarInmueble($inmueble);
        }
        else{
           $this->model->Registrar_dimension($inmueble);
            foreach ($this->model->obtener_IDDimension() as $r2) {
                $inmueble->id_dimension = $r2->id_dimension;
            }
           $this->model->Registrar_inmueble($inmueble);
        }

        //Obteniendo el identificador del último contribuyente
        foreach ($this->modelContri->obtenerCorrelativo2() as $rC) {
            $contri->correlativo = $rC->correlativo;
        }

        //Obteniendo el identificador del último inmueble
        foreach ($this->model->obtener_IDInmueble() as $rI) {
            $inmueble->id_inmueble = $rI->id_inmueble;
        }

        $temporal = [];
        for ($i=1; $i <= 31; $i++) { 
            //Comprobar que el Check principal esté activo
            if (isset($_REQUEST['chk_'.$i])) {
                //Si está activo
                //El siguiente foreach trae el valor del id_servicio_alcaldia según la posición del checkbox principal activado (dentro del parámetro de la función que trae el identificador del servicio se coloca el índice para ubicar el servicio)
                foreach ($this->modelServi->obtenerServicio($i-1) as $rS) {
                    $servi->id_servicio_alcaldia = $rS->id_servicio_alcaldia;
                }

                //Ahora a comprobar si el check norte de esa fila está activo
                if(isset($_REQUEST['chk_norte'.$i])){
                    if(isset($_REQUEST['rg_norte_'.$i])){
                        $temporal["norte_".$i] = $_REQUEST['rg_norte_'.$i] ?? null;
                    }
                }else{
                    $temporal["norte_".$i] = null;
                }
                //Ahora a comprobar si el check este de esa fila está activo
                if(isset($_REQUEST['chk_este'.$i])){
                    if(isset($_REQUEST['rg_este_'.$i])){
                        $temporal['este_'.$i] = $_REQUEST['rg_este_'.$i] ?? null;
                    }
                }else{
                    $temporal['este_'.$i] = null;
                }
                //Ahora a comprobar si el check oeste de esa fila está activo
                if(isset($_REQUEST['chk_oeste'.$i])){
                    if(isset($_REQUEST['rg_oeste_'.$i])){
                        $temporal['oeste_'.$i] = $_REQUEST['rg_oeste_'.$i] ?? null;
                    }
                }else{
                    $temporal['oeste_'.$i] = null;
                }
                //Ahora a comprobar si el check sur de esa fila está activo
                if(isset($_REQUEST['chk_sur'.$i])){
                    if(isset($_REQUEST['rg_sur_'.$i])){
                        $temporal['sur_'.$i] = $_REQUEST['rg_sur_'.$i] ?? null;
                    }
                }else{
                    $temporal['sur_'.$i] = null;
                }

                if(isset($_REQUEST['total_celda_'.$i])){
                    $temporal['total_celda_'.$i] = $_REQUEST['total_celda_'.$i];
                }
                //Registra los datos en la tabla `servicio_contribuyente`, los datos de las 3 tablas: `contribuyente`, `inmueble`, y asocia los servicios aplicados al inmueble de la tabla `meta_servicio_alcaldia`.
                $this->modelServicioContri->registrarServicioContribuyente($contri->correlativo, $inmueble->id_inmueble, $servi->id_servicio_alcaldia, $temporal['norte_'.$i], $temporal['este_'.$i], $temporal['oeste_'.$i], $temporal['sur_'.$i], $temporal['total_celda_'.$i] );
            }

            /*unset($temporal['norte_'.$i]);
            unset($temporal['este_'.$i]);
            unset($temporal['oeste_'.$i]);
            unset($temporal['sur_'.$i]);*/
            unset($temporal);
        }
        
        header('Location:index.php?c=Inmueble');
    }
    
    /*
    Función para eliminar el registro según el identificador del inmueble
    */
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id_inmueble']);
        header('Location:index.php?c=Inmueble');
    }
}