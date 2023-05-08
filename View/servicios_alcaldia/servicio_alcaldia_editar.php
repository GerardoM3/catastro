<h1 class="page-header">
    <?php echo $alm->cod1 != null && $alm->cod2 != null && $alm->cod3 != null && $alm->cod4 != null  ? $alm->descripcion_servicio : 'Nuevo Registro'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=Servicio">Servicios</a></li>
  <li class="active"><?php echo $alm->cod1 != null && $alm->cod2 != null && $alm->cod3 != null && $alm->cod4 != null  ? $alm->descripcion_servicio : 'Nuevo Registro'; ?></li>
</ol>

<form action="?c=Servicio&a=Guardar_Servicio" method="post" enctype="multipart/form-data">
    <input type="text" name="id_servicio_alcaldia" value="<?php echo $alm->id_servicio_alcaldia;?>">

    <label>CÓDIGO</label>
    <div class="form-group">
        <label>COD1: </label><input type="text" name="cod1" value="<?php echo $alm->cod1; ?>" required pattern="[0-9]" title="El código 1 debe de ser un número de un dígito entre 0 y 9"/>
        <label>COD2: </label><input type="text" name="cod2" value="<?php echo $alm->cod2; ?>" required pattern="[0-9]{1,2}" title="El código 2 puede ser números de 2 dígitos entre 0 y 99"/>
        <label>COD3: </label><input type="text" name="cod3" value="<?php echo $alm->cod3; ?>" required pattern="[0-9]{1,2}" title="El código 3 puede ser números de 2 dígitos entre 0 y 99"/>
        <label>COD4: </label><input type="text" name="cod4" value="<?php echo $alm->cod4; ?>" required pattern="[0-9]{1,3}" title="El código 4 puede ser números de 3 dígitos entre 0 y 999"/>
    </div>
    
    
    <div class="form-group">
        <label>SERVICIO</label>
        <input type="text" name="descripcion_servicio" value="<?php echo $alm->descripcion_servicio; ?>" class="form-control" placeholder="Ingrese servicio" data-validacion-tipo="requerido|min:3" required/>
    </div>
    
    <div class="form-group">
        <label>SERVICIO (ABREVIADO)</label>
        <input type="text" name="descripcion_servicio_abreviado" value="<?php echo $alm->descripcion_servicio_abreviado; ?>" class="form-control" placeholder="Ingrese servicio (abreviado)" data-validacion-tipo="requerido|min:7" />
    </div>
    
    <div class="form-group">
        <label>UNIDAD DE MEDIDA</label>
        <input type="text" name="unidad_medida" value="<?php echo $alm->unidad_medida; ?>" class="form-control" placeholder="Ingrese unidad de medida" data-validacion-tipo="requerido|min:3" />
    </div>
    
    <div class="form-group">
        <label>TARIFA ACTUAL</label>
        <input type="text" name="tarifa_actual" value="<?php echo $alm->tarifa_actual; ?>" class="form-control" placeholder="Ingrese tarifa actual" data-validacion-tipo="requerido|min:8" required pattern="[0-9]{1,6}.?[0-9]{1,2}?" maxlength="9" title="Valores decimales entre 0.00 y 999,999.99 (sin coma)"/>
    </div>
    
    <div class="form-group">
        <label>TARIFA ANTERIOR</label>
        <input type="text" name="tarifa_anterior" value="<?php echo $alm->tarifa_anterior; ?>" class="form-control" placeholder="Ingrese tarifa anterior" data-validacion-tipo="requerido|min:3" required pattern="[0-9]{1,6}.?[0-9]{1,2}?" maxlength="9" title="Valores decimales entre 0.00 y 999,999.99 (sin coma)"/>
    </div>

    <div class="form-group">
        <label>PERIODO DE VIGENCIA DE LA TARIFA</label>
        <input type="text" name="periodo_vigencia_tarifa" value="<?php echo $alm->periodo_vigencia_tarifa; ?>" class="form-control" placeholder="Ingrese periodo de vigencia de la tarifa" data-validacion-tipo="requerido|min:3" required pattern="[0-9]{1,11}" title="Valores numéricos" maxlength="11"/>
    </div>

    <div class="form-group">
        <label>TIPO CONCEPTO</label>
        <input type="text" name="tipo_concepto" value="<?php echo $alm->tipo_concepto; ?>" class="form-control" placeholder="Ingrese el tipo de concepto" data-validacion-tipo="requerido|min:3" required pattern="F|M" title="Colocar una de estas dos letras en mayúscula: F ó M"/>
    </div>

    <div class="form-group">
        <label>TIPO COBRO</label>
        <input type="text" name="tipo_cobro" value="<?php echo $alm->tipo_cobro; ?>" class="form-control" placeholder="Ingrese el tipo de cobro" data-validacion-tipo="requerido|min:3" required pattern="V|A" title="Colocar una de estas dos letras en mayúscula: V ó A"/>
    </div>
    
    <hr />
    
    <div class="text-right">
        <button class="btn btn-success"><?php echo $alm->cod1 != null && $alm->cod2 != null && $alm->cod3 != null && $alm->cod4 != null  ? "Actualizar registro" : 'Agregar Registro'; ?></button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-alumno").submit(function(){
            return $(this).validate();
        });
    })
</script>
