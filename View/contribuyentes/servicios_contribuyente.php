<?php 
$i = 1;
?>
	<div class="btn btn-info btn-lg regresar" style="float: right;">
		<i class="glyphicon glyphicon-arrow-left">
			<script>var regresar = document.querySelector('.regresar'); regresar.addEventListener('click', ()=>{window.location.assign(document.referrer);});</script>
		</i>
	</div>
    <div class="header-page">
		<div class="image-alcaldia">
			<img src="assets/img/escudo_alcaldia_san_rafael_obrajuelo.jpeg" alt="" srcset="">
		</div>
		<div class="datos-generales-contribuyente">
			<h2>Datos generales del contribuyente</h2>
			<p style="float: right;font-size: 19px;">
				<b>
					<span>N° Contribuyente: </span><?php echo $contri->id_contribuyente."-".$contri->correlativo; ?>
				</b>
			</p>
			<p>
				<span>Nombre completo del contribuyente: </span><?php echo $contri->nombre_contribuyente . ' ' . $contri->apellido_contribuyente;?>
			</p>
			<p>
				<span>Dirección completa del contribuyente: </span><?php echo $contri->direccion_contribuyente; ?>
			</p>
			<p>
				<span>DUI del contribuyente: </span><?php echo $contri->dui_contribuyente; ?>
			</p>
			<p>
				<span>Teléfono de contacto: </span><?php echo $contri->telefono_contribuyente; ?>
			</p>
		</div>
	</div>
	<div class="datos-generales-inmueble">
		<h2>Datos del inmueble del contribuyente <?php echo $contri->id_contribuyente."-".$contri->correlativo; ?></h2>
		<p style="float: right;font-size: 19px;">
			<b>
				<span>ID Inmueble: </span><?php echo $inmueble->id_inmueble; ?>
			</b>
		</p>
		<p>
			<span>Dirección del inmueble: </span><?php echo $inmueble->direccion_inmueble;?>
		</p>
		<p>
			<span>Zona: </span><?php echo $inmueble->zona_inmueble . '('. $inmueble->cod_zona . ')'; ?>
		</p>
		<p>
			<span>Característica del inmueble: </span><?php echo $inmueble->sector_estado; ?>
		</p>
		<p>
			Dimensiones:<br>
			<span>Norte: </span><?php echo $inmueble->norte_longitud; ?> m<br>
			<span>Este: </span><?php echo $inmueble->este_longitud; ?> m<br>
			<span>Oeste: </span><?php echo $inmueble->oeste_longitud; ?> m<br>
			<span>Sur: </span><?php echo $inmueble->sur_longitud; ?> m
		</p>
	</div>

	<div class="servicios-aplicados">
		<h2>Servicios aplicados al inmueble</h2>
		<table class="table table-bordered">
			<thead>
				<th></th>
				<th>Servicios</th>
				<th>Valor</th>
				<th>Aplicados a</th>
				<th>Total a pagar por el servicio</th>
				<th></th>
			</thead>
			<tbody>
				<?php foreach ($this->modelServicioContri->obtenerServicioContribuyente($inmueble->id_inmueble) as $rSC): ?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $rSC->descripcion_servicio;?></td>
						<td>$<?php echo $rSC->tarifa_actual;?></td>
						<td>
							<?php echo $rSC->norte_servicio != null ? 'Norte: ' . $rSC->norte_servicio . ' m -> $'.($rSC->tarifa_actual * $rSC->norte_servicio).'<br>' : null;?>
							<?php echo $rSC->este_servicio != null ? 'Este: ' . $rSC->este_servicio . ' m -> $'.($rSC->tarifa_actual * $rSC->este_servicio).'<br>' : null;?>
							<?php echo $rSC->oeste_servicio != null ? 'Oeste: ' . $rSC->oeste_servicio . ' m -> $'.($rSC->tarifa_actual * $rSC->oeste_servicio).'<br>' : null;?>
							<?php echo $rSC->sur_servicio != null ? 'Sur: ' . $rSC->sur_servicio . ' m -> $'.($rSC->tarifa_actual * $rSC->sur_servicio): null;?>
						</td>
						<td>$<?php echo $rSC->total_pago_servicio;?></td>
						<td>
							<a class="btn btn-danger" id="eliminar-dato-content-main-<?php echo $i; ?>" href="#"><i class="glyphicon glyphicon-remove"> Eliminar</i></a>
							<?php
							include 'includes/modal.servicio_contribuyente.php';
							?>
						</td>
					</tr>
				<?php $i++;endforeach;?>
			</tbody>
		</table>
	</div>