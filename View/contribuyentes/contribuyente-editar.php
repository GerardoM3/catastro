<h1 class="page-header">
    <?php echo $alm->id_contribuyente != null && $alm->correlativo != null ? $alm->nombre_contribuyente.' '.$alm->apellido_contribuyente : 'Nuevo Registro'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=Contribuyente">Contribuyentes</a></li>
  <li class="active"><?php echo $alm->id_contribuyente !=null && $alm->correlativo != null ? $alm->nombre_contribuyente.' '.$alm->apellido_contribuyente : 'Nuevo Registro'; ?></li>
</ol>

<form action="?c=Contribuyente&a=Guardar" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_contribuyente" placeholder="ID Contribuyente" value="<?php echo $alm->id_contribuyente; ?>" />
    <input type="hidden" name="correlativo" placeholder="Correlativo" value="<?php echo $alm->correlativo; ?>" />
    
    <div class="form-group">
        <label>Nombres del contribuyente</label>
        <input type="text" name="nombre_contribuyente" value="<?php echo $alm->nombre_contribuyente; ?>" class="form-control" placeholder="Ingrese nombres del contribuyente" data-validacion-tipo="requerido|min:3" style="width: 40%;" maxlength="30" required title="Sólo letras mayúsculas y minúsculas."/>
    </div>
    
    <div class="form-group">
        <label>Apellidos del contribuyente</label>
        <input type="text" name="apellido_contribuyente" value="<?php echo $alm->apellido_contribuyente; ?>" class="form-control" placeholder="Ingrese apellidos del contribuyente" data-validacion-tipo="requerido|min:7" style="width: 40%;" maxlength="30" required title="Sólo letras mayúsculas y minúsculas."/>
    </div>    
    
    <div class="form-group">
        <label>DUI del contribuyente</label>
        <input type="text" name="dui_contribuyente" value="<?php echo $alm->dui_contribuyente; ?>" class="form-control" placeholder="Ingrese DUI del contribuyente" data-validacion-tipo="requerido|min:3" style="width:20%;" maxlength="10" required pattern="[0-9]{8}-[0-9]" title="Números con el formato siguiente: '12345678-9' (no olvide colocar el guión)."/>
    </div>

    <div class="form-group">
        <label>Dirección del contribuyente</label><h6 style="display: inline-block;position: relative;margin-left: 5px;">(según DUI)</h6>
        <input type="text" name="direccion_contribuyente" value="<?php echo $alm->direccion_contribuyente; ?>" class="form-control" placeholder="Ingrese su dirección" data-validacion-tipo="requerido|min:8" style="width:90% ;" maxlength="125" required/>
    </div>

    <div class="form-group">
        <label>Teléfono del contribuyente</label>
        <input type="text" name="telefono_contribuyente" value="<?php echo $alm->telefono_contribuyente; ?>" class="form-control" placeholder="Ingrese teléfono del contribuyente" data-validacion-tipo="requerido|min:3" maxlength="9" style="width:18%;" required pattern="[0-9]{4}-[0-9]{4}" title="Número con el siguiente formato: '1234-5678' (no olvide colocar el guión)."/>
    </div>
    
    
    <hr />
    
    <div class="text-right">
        <button class="btn btn-success"><?php echo $alm->id_contribuyente != null && $alm->correlativo != null ? 'Actualizar registro' : 'Agregar Registro'; ?></button>
    </div>
</form>



