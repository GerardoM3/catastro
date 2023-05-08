
<?php
	
	if(!isset($_REQUEST['c']) || $_REQUEST['c'] == "Contribuyente"){
		require_once 'Model/conexion.php';
		$controller = 'contribuyente';

		//terminar de modificar

		// Con esta sección hacemos el Controlador del Frontend
		if(!isset($_REQUEST['c']))
		{
		    require_once "Controller/$controller.controller.php";
		    $controller = ucwords($controller) . 'Controller';
		    $controller = new $controller;
		    $controller->Index_contribuyente();    
		}
		else
		{
		    // buscamos el controlador que queremos cargar
		    $controller = strtolower($_REQUEST['c']);
		    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index_contribuyente';
		    
		    // Instanciamos el controlador
		    require_once "Controller/$controller.controller.php";
		    $controller = ucwords($controller) . 'Controller';
		    $controller = new $controller;
		    
		    // Función para llamar las acciones a ejecutar
		    call_user_func( array( $controller, $accion ) );
		}
	}else if(!isset($_REQUEST['c']) || $_REQUEST['c'] == "Inmueble"){
		require_once 'Model/conexion.php';
		$controller = 'inmueble';

		// Con esta sección hacemos el Controlador del Frontend
		if(!isset($_REQUEST['c']))
		{
		    require_once "Controller/$controller.controller.php";
		    $controller = ucwords($controller) . 'Controller';
		    $controller = new $controller;
		    $controller->Index_inmueble();    
		}
		else
		{
		    // buscamos el controlador que queremos cargar
		    $controller = strtolower($_REQUEST['c']);
		    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index_inmueble';
		    
		    // Instanciamos el controlador
		    require_once "Controller/$controller.controller.php";
		    $controller = ucwords($controller) . 'Controller';
		    $controller = new $controller;
		    
		    // Función para llamar las acciones a ejecutar
		    call_user_func( array( $controller, $accion ) );
		}
	}else if(!isset($_REQUEST['c']) || $_REQUEST['c'] == "Servicio"){
		require_once 'Model/conexion.php';
		$controller = 'servicio';

		if (!isset($_REQUEST['c'])) {
			require_once "Controller/$controller.controller.php";
			$controller = ucwords($controller) . 'Controller';
			$controller = new $controller;
			$controller->Index_Servicios();
		} else {
			$controller = strtolower($_REQUEST['c']);
			$accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index_Servicios';

			require_once "Controller/$controller.controller.php";
			$controller = ucwords($controller) . 'Controller';
			$controller = new $controller;

			call_user_func(array($controller, $accion));
		}
	}else if (!isset($_REQUEST['c']) || $_REQUEST['c'] == "Sector") {
		require_once 'Model/conexion.php';
		$controller = 'sector';

		if(!isset($_REQUEST['c'])){
			require_once "Controller/$controller.controller.php";
			$controller = ucwords($controller) . 'Controller';
			$controller = new $controller;
			$controller->Index_Sectores();
		}else{
			$controller = strtolower($_REQUEST['c']);
			$accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index_Sectores';

			require_once "Controller/$controller.controller.php";
			$controller = ucwords($controller) . 'Controller';
			$controller = new $controller;

			call_user_func(array($controller, $accion));
		}
	}