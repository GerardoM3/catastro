<h1 class="page-header">Servicios</h1>

<?php 
$i=1;
?>

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=Servicio&a=Crud_Servicio">Agregar Servicio</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID SERVICIO</th>
            <th>SERVICIO</th>
            <th>SERVICIO (ABREVIADO)</th>
            <th>UNIDAD DE MEDIDA</th>
            <th>TARIFA ACTUAL</th>
            <th>TARIFA ANTERIOR</th>
            <th>PERIODO DE VIGENCIA DE LA TARIFA</th>
            <th>TIPO CONCEPTO</th>
            <th>TIPO COBRO</th>
            <th><!--Botón de editar--></th>
            <th><!--Botón de eliminar--></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar_servicios() as $r): ?>
        <tr>
            <td><?php echo $r->id_servicio_alcaldia; ?></td>
            <td><?php echo $r->descripcion_servicio; ?></td>
            <td><?php echo $r->descripcion_servicio_abreviado; ?></td>
            <td><?php echo $r->unidad_medida; ?></td>
            <td><?php echo $r->tarifa_actual; ?></td>
            <td><?php echo $r->tarifa_anterior; ?></td>
            <td><?php echo $r->periodo_vigencia_tarifa; ?></td>
            <td><?php echo $r->tipo_concepto; ?></td>
            <td><?php echo $r->tipo_cobro; ?></td>
            <td>
                <a class="btn btn-warning" href="?c=Servicio&a=Crud_Servicio&cod1=<?php echo $r->cod1; ?>&cod2=<?php echo $r->cod2; ?>&cod3=<?php echo $r->cod3; ?>&cod4=<?php echo $r->cod4; ?>"><i class="glyphicon glyphicon-edit"> Editar</i></a>
            </td>
            <td>
                <a class="btn btn-danger" id="eliminar-dato-content-main-<?php echo $i; ?>" href="#"><i class="glyphicon glyphicon-remove"> Eliminar</i></a>
                <?php
                include 'includes/modal.servicio.php';
                ?>
            </td>
        </tr>
    <?php $i++; endforeach; ?>
    <!--<a href="?c=Servicio&a=Eliminar&cod1=<?php //echo $r->cod1; ?>&cod2=<?php //echo $r->cod2; ?>&cod3=<?php //echo $r->cod3; ?>&cod4=<?php //echo $r->cod4; ?>">-->
    </tbody>
</table> 
