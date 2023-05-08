<?php

/*  ┌────┬─────────────────────────────────────────────────────────────────────────────────┬────┐  */
/*  |****|   NOTA: En los modelos. Dentro de las funciones, si sólo traerá un registro,    |****|  */
/*  |****|   evitemos utilizar fetchAll, pues nos puede traer errores                      |****|  */
/*  └────┴─────────────────────────────────────────────────────────────────────────────────┴────┘  */

require_once 'Model/contribuyente.php';
require_once 'Model/servicio_alcaldia.php';
require_once 'Model/inmueble.php';

class ContribuyenteController{
    
    private $model;
    private $modelServicioContri;
    private $modelServicio;
    private $modelInmueble;
    
    public function __CONSTRUCT(){
        $this->model = new Contribuyente();
        $this->modelServicioContri = new Servicios_Contribuyente();
        $this->modelServicio = new Servicio_Alcaldia();
        $this->modelInmueble = new Inmueble();
    }

    public function View(){
        $alm = new Contribuyente();

        if(isset($_REQUEST['id_contribuyente'], $_REQUEST['correlativo'])){
            $alm = $this->model->getting($_REQUEST['id_contribuyente'], $_REQUEST['correlativo']);
        }
        require_once 'View/contribuyentes/header.php';
        require_once 'View/contribuyentes/view-contri.php';
        require_once 'View/contribuyentes/footer.php';
    }

    public function Servicios_aplicados(){
        $inmueble = new Inmueble();
        $contri = new Contribuyente();
        $servi = new Servicio_Alcaldia();
        $servi_contri = new Servicios_Contribuyente();

        if(isset($_REQUEST['id_inmueble'])){
            $inmueble = $this->modelInmueble->getting($_REQUEST['id_inmueble']);
        }
        if(isset($_REQUEST['correlativo'])){
            $contri = $this->model->obtenerCorrelativo3($_REQUEST['correlativo']);
        }
        require_once 'View/contribuyentes/header.php';
        require_once 'View/contribuyentes/servicios_contribuyente.php';
        require_once 'View/contribuyentes/footer.php';
    }

    public function newContribuyente(){
        require_once 'View/contribuyentes/header.php';
        require_once 'View/contribuyentes/newContribuyente.php';
        require_once 'View/contribuyentes/footer.php';
    }
    
    public function Index_contribuyente(){
        require_once 'View/contribuyentes/header.php';
        require_once 'View/contribuyentes/contribuyente.php';
        require_once 'View/contribuyentes/footer.php';
    }
    
    public function Crud(){
        $alm = new Contribuyente();
        
        if(isset($_REQUEST['id_contribuyente'], $_REQUEST['correlativo'])){
            $alm = $this->model->getting($_REQUEST['id_contribuyente'], $_REQUEST['correlativo']);
        }
        
        require_once 'View/contribuyentes/header.php';
        require_once 'View/contribuyentes/contribuyente-editar.php';
        require_once 'View/contribuyentes/footer.php';
    }

    /* 
    Función guardaRegistro que guarda los registros de la sección Contribuyente
    */
    public function guardaRegistro(){
        //Instaciamos los objetos a utilizar para guardar registro del contribuyente 
        $inmueble = new Inmueble();
        $contri = new Contribuyente();
        $servi = new Servicio_Alcaldia();

        /*
        DATOS DEL CONTRIBUYENTE A GUARDAR EN PRIMER LUGAR
        */

        //Obtenemos todos los datos de los campos del formulario en la sección CONTRIBUYENTE
        $contri->nombre_contribuyente = $_REQUEST['nombre_contribuyente'];
        $contri->apellido_contribuyente = $_REQUEST['apellido_contribuyente'];
        $contri->direccion_contribuyente = $_REQUEST['direccion_contribuyente'];
        $contri->dui_contribuyente = $_REQUEST['dui_contribuyente'];
        $contri->telefono_contribuyente = $_REQUEST['telefono_contribuyente'];

        //Aplicamos el registro del contribuyente, para poder usar el correlativo al agregar el inmueble.
        //Mandamos a llamar la función para registrar los datos del contribuyente.
        $this->model->Registrar($contri);

        /*
        DATOS DEL INMUEBLE A GUARDAR EN SEGUNDO LUGAR
        */

        //Obtenemos el correlativo del último contribuyente que ha sido registrado
        foreach ($this->model->obtenerCorrelativo2() as $r) {
            $inmueble->correlativo = $r->correlativo;
        }
        //Obtenemos todos los datos de los campos del formulario en la sección INMUEBLE
        $inmueble->cod_zona = $_REQUEST['cod_zona'];
        $inmueble->cod_sector = $_REQUEST['cod_sector'];
        $inmueble->direccion_inmueble = $_REQUEST['direccion_inmueble'];
        $inmueble->norte_longitud = $_REQUEST['norte_longitud'];
        $inmueble->este_longitud = $_REQUEST['este_longitud'];
        $inmueble->oeste_longitud = $_REQUEST['oeste_longitud'];
        $inmueble->sur_longitud = $_REQUEST['sur_longitud'];
        
        //Registramos primero las dimensiones del inmueble
        $this->modelInmueble->Registrar_dimension($inmueble);
        
        //Traemos el último registro de la dimensión del inmueble para ser utilizado para guardarlo en la tabla 'inmueble'
        foreach ($this->modelInmueble->obtener_IDDimension() as $rD) {
            $inmueble->id_dimension = $rD->id_dimension;
        }
        
        //Aplicamos el registro del inmueble
        $this->modelInmueble->Registrar_inmueble($inmueble);

        /*Con los datos de las tablas contribuyente e inmueble, se procede a obtener el último ID del contribuyente (correlativo) y 
        el último ID del inmueble para que sea almacenado en la tabla servicio_contribuyente*/

        //Obteniendo el identificador del último contribuyente
        foreach ($this->model->obtenerCorrelativo2() as $rC) {
            $contri->correlativo = $rC->correlativo;
        }

        //Obteniendo el identificador del último inmueble
        foreach ($this->modelInmueble->obtener_IDInmueble() as $rI) {
            $inmueble->id_inmueble = $rI->id_inmueble;
        }

        $temporal = [];
        for ($i=1; $i <= 31; $i++) { 
            //Comprobar que el Check principal esté activo
            if (isset($_REQUEST['chk_'.$i])) {
                //Si está activo
                //El siguiente foreach trae el valor del id_servicio_alcaldia según la posición del checkbox principal activado (dentro del parámetro de la función que trae el identificador del servicio se coloca el índice para ubicar el servicio)
                foreach ($this->modelServicio->obtenerServicio($i-1) as $rS) {
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


        header('Location: index.php?c=Contribuyente');
    }
    
    public function Guardar(){
        $alm = new Contribuyente();
        
        $alm->id_contribuyente = $_REQUEST['id_contribuyente'];
        $alm->correlativo = $_REQUEST['correlativo'];
        $alm->nombre_contribuyente = $_REQUEST['nombre_contribuyente'];
        $alm->apellido_contribuyente = $_REQUEST['apellido_contribuyente'];
        $alm->direccion_contribuyente = $_REQUEST['direccion_contribuyente'];
        $alm->dui_contribuyente = $_REQUEST['dui_contribuyente'];
        $alm->telefono_contribuyente = $_REQUEST['telefono_contribuyente'];

        // SI ID PERSONA ES MAYOR QUE CERO (0) INDICA QUE ES UNA ACTUALIZACIÓN DE ESA TUPLA EN LA TABLA PERSONA, SINO SIGNIFICA QUE ES UN NUEVO REGISTRO

        /*$alm->id_contribuyente > 0 && $alm->correlativo > 0
           ? $this->model->Actualizar($alm)
           : $this->model->Registrar($alm);*/

        

       //EL CÓDIGO ANTERIOR ES EQUIVALENTE A UTILIZAR CONDICIONALES IF, TAL COMO SE MUESTRA EN EL COMENTARIO A CONTINUACIÓN:

        if (($alm->id_contribuyente != null) && ($alm->correlativo != null)) {
            $this->model->Actualizar($alm);
        }else{
            $this->model->Registrar($alm);
        }
        
        
        header('Location: index.php?c=Contribuyente');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id_contribuyente'], $_REQUEST['correlativo']);
        header('Location: index.php?c=Contribuyente');
    }

    public function eliminarServicio(){
        $this->modelServicioContri->eliminarServicio($_REQUEST['id_servicio_contribuyente']);
        header('Location: index.php?c=Contribuyente');
    }
    
}