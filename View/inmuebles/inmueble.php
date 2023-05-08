<h1 class="page-header">Inmuebles</h1>

<?php 
$i = 1;
?>


<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=Inmueble&a=Crud">Agregar Inmueble</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID Inmueble</th>
            <th>ID del propietario</th>
            <th>Nombre completo del contribuyente propietario</th>
            <th>Dirección completa del inmueble</th>
            <th>Características del inmueble</th>
            <th>Dimensiones del inmueble (Norte->Este->Oeste->Sur)</th>
            <th><!--Botón de editar--></th>
            <th><!--Botón de eliminar--></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar_inmueble() as $r): ?>
        <tr>
            <td><?php echo $r->id_inmueble; ?></td>
            <td><?php echo $r->id_contribuyente; ?></td>
            <td><?php echo $r->nombre_contribuyente; ?></td>
            <td>
                <?php 
                if($r->zona_inmueble != null){
                    echo $r->direccion_inmueble . ", Zona: " . $r->zona_inmueble . " (". $r->cod_zona.")";
                }else{
                    echo $r->direccion_inmueble;
                }
                ?>
            </td>
            <td><?php echo $r->sector_estado; ?></td>
            <td><?php echo $r->norte_longitud.", ".$r->este_longitud.", ".$r->oeste_longitud.", ".$r->sur_longitud; ?></td>
            <td>
                    <a class="btn btn-warning" href="?c=Inmueble&a=Crud&id_inmueble=<?php echo $r->id_inmueble; ?>"><i class="glyphicon glyphicon-edit"> Editar</i></a>
                </td>
                <td>
                    <a class="btn btn-danger" id="eliminar-dato-content-main-<?php echo $i; ?>" href="#"><i class="glyphicon glyphicon-remove"> Eliminar</i></a>
                    <?php
                    include 'includes/modal.inmueble.php';
                    ?>
                </td>
            </tr>
    <?php $i++; endforeach; ?>

    <!--href="?c=Inmueble&a=Eliminar&id_inmueble=<?php //echo $r->id_inmueble;?>"-->

    </tbody>
</table> 
