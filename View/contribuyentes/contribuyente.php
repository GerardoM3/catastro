<h1 class="page-header">Contribuyentes</h1>

<?php 


$i = 1;

$agregar = 'Haz click para agregar un nuevo ';
$edit_help = utf8_encode('Haz click aquí para editar los datos de ');
$delete_help = utf8_encode('Haz click aquí para eliminar');


//data-desc="

//"
//data-desc="

//"
//data-desc="
//"
 ?>

<?php //echo utf8_decode($edit_help) . $r->nombre_contribuyente . ' ' . $r->apellido_contribuyente; ?>
<?php //echo utf8_decode($delete_help); ?>
<?php //echo $agregar .  'contribuyente';?>

<div class="well well-sm" style="display:flex;justify-content: center;align-items: center;">
    <form style="width:60%;">
        <h6>Buscar por número de contribuyente, nombre o DUI</h6>
        <input type="search" name="buscarContribuyente" class="searchContri" id="searchContri" placeholder="Buscar">
    </form>
    <div>
        <a class="btn btn-primary" href="?c=Contribuyente&a=Crud">Agregar Contribuyente</a>
    </div>
</div>

<script type="text/javascript">
    var searchContri = document.getElementById('searchContri');
    searchContri.addEventListener('blur', (e)=>{
        e.target.value = '';
    });
    $('#searchContri').keyup(function(e){
        $.ajax({
            url: 'includes/getVar.php?var=' + e.target.value,
            success: function(data){
                $('#content-table').html(data);
            }
        })
    });
</script>

<?php //echo "<script>"; ?>
<?php //echo "buscarContri = document.getElementById('searchContri');"; ?>
<?php //echo "buscaRadioNombre = document.getElementById('nom_contri');"; ?>
<?php //echo "buscaRadioDUI = document.getElementById('dui_contri');"; ?>
<?php //echo "buscarContri.addEventListener('keyup', (e)=>{"; ?>
<?php //echo "console.log(e.textContent)"; ?>
<?php //echo "/*if(buscaRadioNombre.checked){";  ?>
<?php //$valorCampo = "e.target.value"; ?>
<?php //$condition = "AND nombre_contribuyente LIKE `%" . $valorCampo . "%`"; ?>
<?php //echo "}else if(buscaRadioDUI.checked){*/";  ?>
<?php //echo "}});"; ?>
<?php //echo "</script>"; ?>

<table class="table table-bordered table-dark">
    <thead class="thead-dark">
        <tr>
            <th>Número contribuyente</th>
            <th>Nombre completo del contribuyente</th>
            <th>Dirección completa del contribuyente</th>
            <th>DUI</th>
            <th>Teléfono contribuyente</th>
            <th><!--Botón de Vista de Contribuyente--></th>
            <th><!--Botón de editar--></th>
            <th><!--Botón de eliminar--></th>
        </tr>
    </thead>
    <tbody id="content-table">
    <?php foreach($this->model->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->id_contribuyente."-".$r->correlativo; ?></td>
            <td><?php echo $r->nombre_contribuyente. " " .$r->apellido_contribuyente; ?></td>
            <td><?php echo $r->direccion_contribuyente; ?></td>
            <td><?php echo $r->dui_contribuyente; ?></td>
            <td><?php echo $r->telefono_contribuyente; ?></td>
            <td>
                    <a class="btn btn-info" href="?c=Contribuyente&a=View&id_contribuyente=<?php echo $r->id_contribuyente; ?>&correlativo=<?php echo $r->correlativo; ?>"><i class="glyphicon glyphicon-eye-open"> Vista general</i></a>
            </td>
            <td>
                <a class="btn btn-warning" href="?c=Contribuyente&a=Crud&id_contribuyente=<?php echo $r->id_contribuyente; ?>&correlativo=<?php echo $r->correlativo;?>"><i class="glyphicon glyphicon-edit"> Editar</i></a>
            </td>
            <td>
                <a class="btn btn-danger" id="eliminar-dato-content-main-<?php echo $i; ?>" href="#"><i class="glyphicon glyphicon-remove"> Eliminar</i></a>
                <?php
                include 'includes/modal.contribuyente.php';
                ?>
            </td>
        </tr>
        
    <?php $i++; endforeach;?>
    <!--<a href="?c=Contribuyente&a=Eliminar&id_contribuyente=<?php //echo $r->id_contribuyente; ?>&correlativo=<?php //echo $r->correlativo;?>"></a>-->

    </tbody>
</table> 
