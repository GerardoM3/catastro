<h1 class="page-header">
    <?php echo $alm_crud->cod_sector != null  ? $alm_crud->sector_estado : 'Nuevo Registro'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=Sector">Sectores</a></li>
  <li class="active"><?php echo $alm_crud->cod_sector != null  ? $alm_crud->sector_estado : 'Nuevo Registro'; ?></li>
</ol>

<form action="?c=Sector&a=<?php echo $alm_crud->cod_sector!= null?'Actualizar_Sector':'Guardar_Sector';?>" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label>CODIGO SECTOR</label>
        <input id="cod_sector" type="text" name="cod_sector" value="<?php echo $alm_crud->cod_sector; ?>" class="form-control" placeholder="Ingrese un código de sector" pattern="[A-Z|0-9]([A-Z|0-9])" title="El código del sector debe ser de 2 dígitos. Una letra en mayúscula (A-Z) y un número (0-9) o viceversa. O ambos dígitos letras en mayúsculas ó ambos números." required <?php echo $alm_crud->cod_sector!= null?'readonly':'';?>/>
    </div>
    
    
    <div class="form-group">
        <label>SECTOR</label>
        <input id="sector_estado" type="text" name="sector_estado" value="<?php echo $alm_crud->sector_estado; ?>" class="form-control" placeholder="Ingrese sector" required/>
    </div>
    
    <hr />
    
    <div class="text-right">
        <button class="btn btn-success"><?php echo $alm_crud->cod_sector != null  ? "Actualizar registro" : 'Agregar Registro'; ?></button>
    </div>
</form>


<script>
    $(document).ready(function(){
        $("#frm-alumno").submit(function(){
            return $(this).validate();
        });
    })
</script>


