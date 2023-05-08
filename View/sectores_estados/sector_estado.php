<h1 class="page-header">Sectores</h1>

<?php $i = 1;?>


<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=Sector&a=Crud_Sector">Agregar Sector</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>CODIGO SECTOR</th>
            <th>SECTOR / TIPO / ESTADO</th>
            <th><!--Botón de editar--></th>
            <th><!--Botón de eliminar--></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar_caracteristica() as $r): ?>
        <tr>
            <td><?php echo $r->cod_sector; ?></td>
            <td><?php echo $r->sector_estado; ?></td>
            <td>
                <a class="btn btn-warning" href="?c=Sector&a=Crud_Sector&cod_sector=<?php echo $r->cod_sector; ?>"><i class="glyphicon glyphicon-edit"> Editar</i></a>
            </td>
            <td>
                <a class="btn btn-danger" id="eliminar-dato-content-main-<?php echo $i; ?>" href="#"><i class="glyphicon glyphicon-remove"> Eliminar</i></a>
                <?php
                include 'includes/modal.sector.php';
                ?>
            </td>
        </tr>
    <?php $i++; endforeach; ?>
    <!--<a href="?c=Sector&a=Eliminar&cod_sector=<?php //echo $r->cod_sector; ?>">-->
    </tbody>
</table> 