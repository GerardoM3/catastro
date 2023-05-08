<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Contribuyente</title>
	<style type="text/css">
	</style>
    
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
    <link rel="stylesheet" href="assets/css/vista_general.style.css">
    <link rel="stylesheet" href="assets/css/style.css"/>
    <link rel="stylesheet" href="assets/css/contribuyente.style.css">
    <link rel="stylesheet" href="assets/css/general.style.css">
    
    <link rel="stylesheet" href="assets/css/servicio.nuevo-registro.main.style.css">

    <script language="javascript" src="assets/js/jquery-3.1.1.min.js"></script>
    
    <script language="javascript" src="assets/js/funciones.js"></script>
    
    <script language="javascript">
        $(document).ready(function(){
            $("#select-departamento").change(function(){

                $("#select-departamento option:selected").each(function () {
                    cod_departamento = $(this).val();
                    $.post("includes/getMunicipio.php", {cod_departamento: cod_departamento}, function(data){
                        $("#select-muni").html(data);
                    });
                });
            })

            
        });
    </script>

    <style type="text/css">
        a[data-desc]{
            position: relative;
            cursor: help;
        }

        a[data-desc]:hover::after,
        a[data-desc]:focus::after{
            content: attr(data-desc);
            position: absolute;
            left: 0;
            top: 30px;
            color: black;
            padding: 10px;
            min-width: 200px;
            border: 1px #aaaaaa solid;
            border-radius: 10px;
            background: lightblue;
            z-index: 1;
        }
</style>

</head>
    <body>
        <div class="container-main">
            <div class="container-nav">
                <a href="index.php?c=Contribuyente" class="option-block">
                    CONTRIBUYENTE
                </a>
        
                <a href="index.php?c=Inmueble" class="option-block">
                    INMUEBLES
                </a>
                <a href="index.php?c=Servicio" class="option-block">
                    SERVICIOS DE ALCALDIA
                </a>
                <a href="index.php?c=Sector" class="option-block">
                    SECTORES / TIPOS / ESTADOS
                </a>
            </div>

            <div>
                <a href="index.php?c=Contribuyente&a=newContribuyente" class="option-block">
                    Nuevo registro de contribuyente
                </a>
            </div>
        </div>
        
    <div class="container">