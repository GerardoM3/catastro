<h1 class="page-header">
    <?php echo $inmueble->id_inmueble != null ? 'Inmueble de '.$inmueble->nombre_contribuyente : 'Nuevo Registro'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=Inmueble">Inmuebles</a></li>
  <li class="active"><?php echo $inmueble->id_inmueble != null ? 'Inmueble de '.$inmueble->nombre_contribuyente : 'Nuevo Registro'; ?></li>
</ol>

<form action="?c=Inmueble&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_inmueble" value="<?php echo $inmueble->id_inmueble; ?>" />
    <input type="hidden" name="cod_sector" value="<?php echo $inmueble->cod_sector; ?>" />
    <input type="hidden" name="id_dimension" value="<?php echo $inmueble->id_dimension; ?>">

    <!--
    <script>

        function habilitarZona(campoZona){
            var estadoActual = document.getElementById(campoZona)

            estadoActual.disabled = !estadoActual.disabled;
        }
    </script>

    <div class="form-group">
        <input type="checkbox" id="cb_zona" name="cb_zona" class="check_zona_input" onclick="habilitarZona('zona_input')"/><label for="cb_zona">¿Existe zonas en la comunidad?</label>
    </div>-->

    <div class="form-group">
        <label>Propietario</label><h6 style="display: inline-block;position: relative;margin-left: 5px;">(correlativo)</h6>
        <input type="text" name="correlativo" value="<?php echo $inmueble->correlativo??($contri->correlativo??null); ?>" class="form-control" placeholder="Ingrese número correlativo del propietario" data-validacion-tipo="requerido|min:3" style="width: 600px;" <?php echo $inmueble->correlativo != null ? 'readonly': ($contri->correlativo != null ? 'readonly': null);?> maxlength="4" required pattern="[0-9]{1,4}" title="Número entre el 1 al 9,999 (sin coma)"/>
    </div>

    <div class="inmueble-data" id="inmueble-data">
		<!--	Dirección del inmueble	-->
		<div class="form-group">
			<label>Dirección del inmueble</label>
			<input type="text" name="direccion_inmueble" placeholder="Ingrese la dirección del inmueble" class="form-control" style="width:90%;" value="<?php echo $inmueble->direccion_inmueble;?>" required>
		</div>

		<!--	Zona del inmueble	-->
		<div class="form-group" id="zona_comunidad_inmueble" style="width:49.5%; margin: 0; display: inline-block;">
			<label>Zona</label>
			<select name="cod_zona" id="cod_zona" style="display:block;" required>
				<?php foreach($this->model->listar_Zona($inmueble->id_inmueble) as $rZona): ?>
					<option value="<?php echo $inmueble->id_inmueble != null ? $rZona->cod_zona : 'Seleccione una zona';?>"><?php echo $inmueble->id_inmueble != null ? $rZona->zona_inmueble : 'Seleccione una zona';?></option>
				<?php endforeach; ?>
                <option value="">Seleccione una zona</option>
                <?php foreach($this->model->listarZona() as $rZona): ?>
                    <option value="<?php echo $rZona->cod_zona;?>"><?php echo $rZona->zona_inmueble;?></option>
                <?php endforeach; ?>
            </select>
		</div>

		<!--	Característica del inmueble	-->
		<div class="form-group" style="width:49.5%; margin: 0; display: inline-block;">
			<label>Característica del inmueble</label>
			<select name="cod_sector" id="selectCaracteristica" style="display:block;" required>
				<?php foreach($this->model->listar_Sector($inmueble->id_inmueble) as $rSector): ?>
                    <option value="<?php echo $inmueble->id_inmueble != null ? $rSector->cod_sector : 'Seleccione una zona';?>"><?php echo $inmueble->id_inmueble != null ? $rSector->sector_estado : 'Seleccione una zona';?></option>
                <?php endforeach; ?>
                <option value=""> Selecciona una característica</option>
                <?php foreach($this->model->listarSector() as $rSector): ?>
                    <option value="<?php echo $rSector->cod_sector;?>"><?php echo $rSector->sector_estado;?></option>
                <?php endforeach; ?>
            </select>
		</div>

		<div class="dimensiones form-group" id="dimensiones" style="padding-top: 1em; margin:0; width:100%;">
			<div class="label-dimensiones">
				<h4>Dimensiones del inmueble</h4>
			</div>
			<!--	Norte	-->
			<div class="form-group" style="width:20%; display: inline-block; margin-left: 1%; margin-right:1%;">
				<label for="norte_longitud">Norte <h6 style="display:inline-flex;">(metros)</h6></label>
				<div class="input-group">
					<input type="text" id="norte_longitud" name="norte_longitud" class="form-control" maxlength="11" style="z-index: 0;" value="<?php echo $inmueble->norte_longitud;?>" required pattern="[0-9]{1,11}" title="Números enteros (sin comas)">
					<span class="input-group-addon">m</span>
				</div>
			</div>

			<!--	Este	-->
			<div class="form-group" style="width:20%; display: inline-block; margin-left: 1%; margin-right:1%;">
				<label for="este_longitud">Este <h6 style="display:inline-flex;">(metros)</h6></label>
				<div class="input-group">
					<input type="text" id="este_longitud" name="este_longitud" class="form-control" maxlength="11" style="z-index: 0;" value="<?php echo $inmueble->este_longitud;?>" required pattern="[0-9]{1,11}" title="Números enteros (sin comas)">
					<span class="input-group-addon">m</span>
				</div>
			</div>

			<!--	Oeste	-->
			<div class="form-group" style="width:20%; display: inline-block; margin-left: 1%; margin-right:1%;">
				<label for="oeste_longitud">Oeste <h6 style="display:inline-flex;">(metros)</h6></label>
				<div class="input-group">
					<input type="text" id="oeste_longitud" name="oeste_longitud" class="form-control" maxlength="11" style="z-index: 0;" value="<?php echo $inmueble->oeste_longitud;?>" required pattern="[0-9]{1,11}" title="Números enteros (sin comas)">
					<span class="input-group-addon">m</span>
				</div>
			</div>

			<!--	Sur		-->
			<div class="form-group" style="width:20%; display: inline-block; margin-left: 1%; margin-right:1%;">
				<label for="sur_longitud">Sur <h6 style="display:inline-flex;">(metros)</h6></label>
				<div class="input-group">
					<input type="text" id="sur_longitud" name="sur_longitud" class="form-control" maxlength="11" style="z-index: 0;" value="<?php echo $inmueble->sur_longitud;?>" required pattern="[0-9]{1,11}" title="Números enteros (sin comas)">
					<span class="input-group-addon">m</span>
				</div>
			</div>
		</div>
	</div>
	<script>
		var north_long = document.getElementById("norte_longitud");
		var east_long = document.getElementById("este_longitud");
		var west_long = document.getElementById("oeste_longitud");
		var south_long = document.getElementById("sur_longitud");
	</script>
	<h2 class="page-header">
		Servicios aplicados al inmueble
	</h2>
	<div class="nota_servicio_inmueble">
		<span>
			<h4><b>Nota:</b> Para aplicar el servicio a una de sus dimensiones o a todas las dimensiones, para cada dimensión debe de seleccionar el rango de a cuántos metros 
			desea aplicar la tarifa de dicho servicio. Cuando pulse el botón "Aplicar", el rango se deshabilitará quedando fijo el valor que haya seleccionado. 
			Si desea cambiar el valor del rango, debe pulsar "No aplicar" para habilitar el rango.</h4>
		</span>
	</div>
	
	<div class="servicio-data form-group" id="servicio-data">

		<div class="search-section" id="search-section">

			<div class="service-list" id="service-list">
				<table class="table table-bordered table-service" style="display: table; text-align: center; justify-items: top;">
					<thead>
						<tr>
							<th style="padding: 2em;"><!--	Sección de selección	--></th>
							<th style="vertical-align:middle;">Servicios</th>
							<th style="vertical-align:middle;">Valor</th>
							<th style="vertical-align:middle;">Aplicar a</th>
							<th style="vertical-align:middle;">Total</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach($this->modelServi->Listar_servicios() as $result): ?>
						<tr>
							<td class="borde-inferior" rowspan="4" style="vertical-align: middle;">
								<center>
									<input type="checkbox" name="chk_<?php echo $i;?>" class="chequeo" id="chk_<?php echo $i;?>" style="transform: scale(3);">
								</center>
							</td>

							<td rowspan="4" style="vertical-align: middle;" class="active_chk borde-inferior" id="active_chk_<?php echo $i;?>">
								<?php echo $result->descripcion_servicio; ?>
							</td>
							<td rowspan="4" style="vertical-align: middle;" class="borde-inferior" id="tarifa_actual_<?php echo $i;?>" name="tarifa_actual_<?php echo $i;?>">
								<?php echo $result->tarifa_actual; ?>
							</td>

							<td>
								<label for="rg_norte" id="rgl_norte<?php echo $i; ?>"></label> <input type="range" class="rg_norte" name="rg_norte_<?php echo $i;?>" min="1" max="" value="1" id="rg_norte<?php echo $i;?>" readonly/>
								<input type="checkbox" name="chk_norte<?php echo $i;?>" id="chk_norte<?php echo $i;?>" style="display:none;"> <label class="btn-aplicar" id="chk_label_norte_<?php echo $i;?>" for="chk_norte<?php echo $i;?>"><!--Norte--></label> 
							</td>
							<td rowspan="4" style="vertical-align: middle;" id="total_celda_<?php echo $i; ?>" class="total_celda borde-inferior">
							</td>
							<input type="hidden" name="total_celda_<?php echo $i; ?>" id="celda_total_<?php echo $i;?>" value=""/>
						</tr>
						<tr>
							<td>
								<label for="rg_este" id="rgl_este<?php echo $i; ?>"></label> <input type="range" class="rg_este" name="rg_este_<?php echo $i;?>" min="1" max="" value="1" id="rg_este<?php echo $i;?>">
								<input type="checkbox" name="chk_este<?php echo $i;?>" id="chk_este<?php echo $i;?>" style="display:none;"> <label class="btn-aplicar" id="chk_label_este_<?php echo $i;?>" for="chk_este<?php echo $i;?>"><!--Este--></label> 
							</td>
						</tr>
						<tr>
							<td>
								<label for="rg_oeste" id="rgl_oeste<?php echo $i; ?>"></label> <input type="range" class="rg_oeste" name="rg_oeste_<?php echo $i;?>" min="1" max="" value="1" id="rg_oeste<?php echo $i;?>">
								<input type="checkbox" name="chk_oeste<?php echo $i;?>" id="chk_oeste<?php echo $i;?>" style="display:none;"> <label class="btn-aplicar" id="chk_label_oeste_<?php echo $i;?>" for="chk_oeste<?php echo $i;?>"><!--Oeste--></label> 
							</td>
						</tr>
						<tr>
							<td class="borde-inferior">
								<label for="rg_sur" id="rgl_sur<?php echo $i; ?>"></label> <input type="range" class="rg_sur" name="rg_sur_<?php echo $i;?>" min="1" max="" value="1" id="rg_sur<?php echo $i;?>">
								<input type="checkbox" name="chk_sur<?php echo $i;?>" id="chk_sur<?php echo $i;?>" style="display:none;"> <label class="btn-aplicar" id="chk_label_sur_<?php echo $i;?>" for="chk_sur<?php echo $i;?>"><!--Sur--></label> 
							</td>
						</tr>

						<script type="text/javascript">
							var active_chk_<?php echo $i;?> = document.getElementById('active_chk_<?php echo $i;?>');
							var chk_<?php echo $i;?> = document.getElementById('chk_<?php echo $i;?>');
							var tarifa_actual_<?php echo $i;?> = document.getElementById('tarifa_actual_<?php echo $i;?>');

							var rg_norte<?php echo $i;?> = document.getElementById("rg_norte<?php echo $i;?>");
							var rg_este<?php echo $i;?> = document.getElementById("rg_este<?php echo $i;?>");
							var rg_oeste<?php echo $i;?> = document.getElementById("rg_oeste<?php echo $i;?>");
							var rg_sur<?php echo $i;?> = document.getElementById("rg_sur<?php echo $i;?>");

							var rgl_norte<?php echo $i;?> = document.getElementById("rgl_norte<?php echo $i;?>");
							var rgl_este<?php echo $i;?> = document.getElementById("rgl_este<?php echo $i;?>");
							var rgl_oeste<?php echo $i;?> = document.getElementById("rgl_oeste<?php echo $i;?>");
							var rgl_sur<?php echo $i;?> = document.getElementById("rgl_sur<?php echo $i;?>");

							var chk_norte<?php echo $i;?> = document.getElementById('chk_norte<?php echo $i;?>');
							var chk_este<?php echo $i;?> = document.getElementById('chk_este<?php echo $i;?>');
							var chk_oeste<?php echo $i;?> = document.getElementById('chk_oeste<?php echo $i;?>');
							var chk_sur<?php echo $i;?> = document.getElementById('chk_sur<?php echo $i;?>');
							var total_celda_<?php echo $i;?> = document.getElementById('total_celda_<?php echo $i;?>');
							var celda_total_<?php echo $i;?> =document.getElementById('celda_total_<?php echo $i;?>');

							north_long.addEventListener('keyup', (e)=>{
								rg_norte<?php echo $i;?>.max = e.target.value;
							});
							east_long.addEventListener('keyup', (e)=>{
								rg_este<?php echo $i;?>.max = e.target.value;
							});
							west_long.addEventListener('keyup', (e)=>{
								rg_oeste<?php echo $i;?>.max = e.target.value;
							});
							south_long.addEventListener('keyup', (e)=>{
								rg_sur<?php echo $i;?>.max = e.target.value;
							});

							if (chk_<?php echo $i;?>.checked) {
								total_celda_<?php echo $i;?>.value = "0.00";
								habilitar(rg_norte<?php echo $i;?>, rg_este<?php echo $i;?>, rg_oeste<?php echo $i;?>, rg_sur<?php echo $i;?>, rgl_norte<?php echo $i;?>, rgl_este<?php echo $i;?>, rgl_oeste<?php echo $i;?>, rgl_sur<?php echo $i;?>,chk_norte<?php echo $i;?>, chk_este<?php echo $i;?>, chk_oeste<?php echo $i;?>, chk_sur<?php echo $i;?>, document.getElementById('chk_label_norte_<?php echo $i;?>'), document.getElementById('chk_label_este_<?php echo $i;?>'), document.getElementById('chk_label_oeste_<?php echo $i;?>'), document.getElementById('chk_label_sur_<?php echo $i;?>'), total_celda_<?php echo $i;?>);
								
							}else{
								deshabilitar(rg_norte<?php echo $i;?>, rg_este<?php echo $i;?>, rg_oeste<?php echo $i;?>, rg_sur<?php echo $i;?>, rgl_norte<?php echo $i;?>, rgl_este<?php echo $i;?>, rgl_oeste<?php echo $i;?>, rgl_sur<?php echo $i;?>, chk_norte<?php echo $i;?>, chk_este<?php echo $i;?>, chk_oeste<?php echo $i;?>, chk_sur<?php echo $i;?>, document.getElementById('chk_label_norte_<?php echo $i;?>'), document.getElementById('chk_label_este_<?php echo $i;?>'), document.getElementById('chk_label_oeste_<?php echo $i;?>'), document.getElementById('chk_label_sur_<?php echo $i;?>'), total_celda_<?php echo $i;?>);
							}

							active_chk_<?php echo $i;?>.addEventListener('click', ()=>{
								chk_<?php echo $i;?>.checked = !chk_<?php echo $i;?>.checked;
								if (chk_<?php echo $i;?>.checked) {
									total_celda_<?php echo $i;?>.value = "0.00";
									habilitar(rg_norte<?php echo $i;?>, rg_este<?php echo $i;?>, rg_oeste<?php echo $i;?>, rg_sur<?php echo $i;?>, rgl_norte<?php echo $i;?>, rgl_este<?php echo $i;?>, rgl_oeste<?php echo $i;?>, rgl_sur<?php echo $i;?>,chk_norte<?php echo $i;?>, chk_este<?php echo $i;?>, chk_oeste<?php echo $i;?>, chk_sur<?php echo $i;?>, document.getElementById('chk_label_norte_<?php echo $i;?>'), document.getElementById('chk_label_este_<?php echo $i;?>'), document.getElementById('chk_label_oeste_<?php echo $i;?>'), document.getElementById('chk_label_sur_<?php echo $i;?>'), total_celda_<?php echo $i;?>);

								}else{
									deshabilitar(rg_norte<?php echo $i;?>, rg_este<?php echo $i;?>, rg_oeste<?php echo $i;?>, rg_sur<?php echo $i;?>, rgl_norte<?php echo $i;?>, rgl_este<?php echo $i;?>, rgl_oeste<?php echo $i;?>, rgl_sur<?php echo $i;?>, chk_norte<?php echo $i;?>, chk_este<?php echo $i;?>, chk_oeste<?php echo $i;?>, chk_sur<?php echo $i;?>, document.getElementById('chk_label_norte_<?php echo $i;?>'), document.getElementById('chk_label_este_<?php echo $i;?>'), document.getElementById('chk_label_oeste_<?php echo $i;?>'), document.getElementById('chk_label_sur_<?php echo $i;?>'), total_celda_<?php echo $i;?>);
								}
							});
							chk_<?php echo $i;?>.addEventListener('click', (chk_<?php echo $i;?>)=>{
								if (chk_<?php echo $i;?>.target.checked) {
									total_celda_<?php echo $i;?>.value = "0.00";
									habilitar(rg_norte<?php echo $i;?>, rg_este<?php echo $i;?>, rg_oeste<?php echo $i;?>, rg_sur<?php echo $i;?>, rgl_norte<?php echo $i;?>, rgl_este<?php echo $i;?>, rgl_oeste<?php echo $i;?>, rgl_sur<?php echo $i;?>,chk_norte<?php echo $i;?>, chk_este<?php echo $i;?>, chk_oeste<?php echo $i;?>, chk_sur<?php echo $i;?>, document.getElementById('chk_label_norte_<?php echo $i;?>'), document.getElementById('chk_label_este_<?php echo $i;?>'), document.getElementById('chk_label_oeste_<?php echo $i;?>'), document.getElementById('chk_label_sur_<?php echo $i;?>'), total_celda_<?php echo $i;?>);
								}else{
									deshabilitar(rg_norte<?php echo $i;?>, rg_este<?php echo $i;?>, rg_oeste<?php echo $i;?>, rg_sur<?php echo $i;?>, rgl_norte<?php echo $i;?>, rgl_este<?php echo $i;?>, rgl_oeste<?php echo $i;?>, rgl_sur<?php echo $i;?>, chk_norte<?php echo $i;?>, chk_este<?php echo $i;?>, chk_oeste<?php echo $i;?>, chk_sur<?php echo $i;?>, document.getElementById('chk_label_norte_<?php echo $i;?>'), document.getElementById('chk_label_este_<?php echo $i;?>'), document.getElementById('chk_label_oeste_<?php echo $i;?>'), document.getElementById('chk_label_sur_<?php echo $i;?>'), total_celda_<?php echo $i;?>);
								}
							});

							rg_norte<?php echo $i;?>.addEventListener('change',()=> rangos(rgl_norte<?php echo $i;?>, rg_norte<?php echo $i;?>, "Norte: "));
							rg_este<?php echo $i;?>.addEventListener('change',()=> rangos(rgl_este<?php echo $i;?>, rg_este<?php echo $i;?>, "Este: "));
							rg_oeste<?php echo $i;?>.addEventListener('change',()=> rangos(rgl_oeste<?php echo $i;?>, rg_oeste<?php echo $i;?>, "Oeste: "));
							rg_sur<?php echo $i;?>.addEventListener('change', ()=> rangos(rgl_sur<?php echo $i;?>, rg_sur<?php echo $i;?>, "Sur: "));

							chk_norte<?php echo $i;?>.addEventListener('change', ()=>{
								cajas_chequeo(chk_norte<?php echo $i;?>, rg_norte<?php echo $i;?>, total_celda_<?php echo $i;?>, tarifa_actual_<?php echo $i;?>, document.getElementById('chk_label_norte_<?php echo $i;?>'))
								total_celda_<?php echo $i;?>.textContent = Math.abs(parseFloat(total_celda_<?php echo $i;?>.textContent));
								celda_total_<?php echo $i;?>.value = total_celda_<?php echo $i;?>.textContent;
								
							});
							chk_este<?php echo $i;?>.addEventListener('change', ()=>{
								cajas_chequeo(chk_este<?php echo $i;?>, rg_este<?php echo $i;?>, total_celda_<?php echo $i;?>, tarifa_actual_<?php echo $i;?>, document.getElementById('chk_label_este_<?php echo $i;?>'))
								celda_total_<?php echo $i;?>.value = total_celda_<?php echo $i;?>.textContent;
							});
							chk_oeste<?php echo $i;?>.addEventListener('change', ()=>{
								cajas_chequeo(chk_oeste<?php echo $i;?>, rg_oeste<?php echo $i;?>, total_celda_<?php echo $i;?>, tarifa_actual_<?php echo $i;?>, document.getElementById('chk_label_oeste_<?php echo $i;?>'))
								celda_total_<?php echo $i;?>.value = total_celda_<?php echo $i;?>.textContent;
							});
							chk_sur<?php echo $i;?>.addEventListener('change', ()=>{
								cajas_chequeo(chk_sur<?php echo $i;?>, rg_sur<?php echo $i;?>, total_celda_<?php echo $i;?>, tarifa_actual_<?php echo $i;?>, document.getElementById('chk_label_sur_<?php echo $i;?>'))
								celda_total_<?php echo $i;?>.value = total_celda_<?php echo $i;?>.textContent;
							});

							window.addEventListener('load', ()=>{
								var btn_agregar = document.getElementById('agregar_registro');
								var form = document.getElementById('new_contribuyente_form');
								
								form.addEventListener('submit', (e)=>{
									e.preventDefault();
									if(chk_<?php echo $i;?>.checked){
										if((chk_norte<?php echo $i;?>.checked == true) || (chk_este<?php echo $i;?>.checked == true) || (chk_oeste<?php echo $i;?>.checked == true) || (chk_sur<?php echo $i;?>.checked == true)){
											predeterminado(rg_norte<?php echo $i;?>, rg_este<?php echo $i;?>, rg_oeste<?php echo $i;?>, rg_sur<?php echo $i;?>);
											e.target.submit();
										}else{
										}
									}else{
										
									}
								});
							});
							
						</script>
						
						<?php $i++; endforeach; ?>
					</tbody>
				</table>
			</div>
			
		</div>
		
	</div>

	<div>
		<?php
		include 'includes/modal.validar-servicio.php';
		?>
	</div>
    
    <hr />
    
    <div class="form-group registrar" id="registrar" style="display:flex; justify-content:center;">
		<button class="btn btn-success" style="padding: .8em; font-size: 20px;" id="agregar_registro">Agregar nuevo registro</button>
	</div>
</form>
	<script>
		var cerrar = document.getElementById('cerrar');
		var modal_validar_servicio = document.getElementById('modal-validar-servicio');
		var body = document.getElementsByTagName("body")[0];
		var form = document.getElementById('new_contribuyente_form');
		var agregar_registro = document.getElementById('agregar_registro');

		agregar_registro.addEventListener('click', ()=>{
			if(form.willValidate){
				modal_validar_servicio.style.display = "none";

				body.style.position = "inherit";
				body.style.height = "auto";
				body.style.overflow = "visible";
			}else{
				modal_validar_servicio.style.display = "block";

				body.style.position = "static";
				body.style.height = "100%";
				body.style.overflow = "hidden";
			}
		});
		cerrar.addEventListener('click', ()=>{
			modal_validar_servicio.style.display = "none";

			body.style.position = "inherit";
			body.style.height = "auto";
			body.style.overflow = "visible";
		});
	</script>


