<?php 
$i = 1;
?>
	<div class="header-page">
		<div class="image-alcaldia">
			<img src="assets/img/escudo_alcaldia_san_rafael_obrajuelo.jpeg" alt="" srcset="">
		</div>
		<div class="datos-generales-contribuyente">
			<h2>Datos generales del contribuyente</h2>
			<p style="float: right;font-size: 19px;">
				<b>
					<span>N° Contribuyente: </span><?php echo $alm->id_contribuyente."-".$alm->correlativo; ?>
				</b>
			</p>
			<p>
				<span>Nombre completo del contribuyente: </span><?php echo $alm->nombre_contribuyente . ' ' . $alm->apellido_contribuyente;?>
			</p>
			<p>
				<span>Dirección completa del contribuyente: </span><?php echo $alm->direccion_contribuyente; ?>
			</p>
			<p>
				<span>DUI del contribuyente: </span><?php echo $alm->dui_contribuyente; ?>
			</p>
			<p>
				<span>Teléfono de contacto: </span><?php echo $alm->telefono_contribuyente; ?>
			</p>
			
		</div>
	</div>
	<div class="tabla-inmuebles">
		<table class="table table-bordered">
			<caption>
				<div class="vg-caption">
					<h2>Inmuebles del contribuyente</h2>
					<a class="btn btn-primary" href="?c=Inmueble&a=Crud&correlativo=<?php echo $alm->correlativo;?>">Agregar Inmueble</a>
				</div>
			</caption>
			<thead>
				<tr>
					<th>
						ID inmueble
					</th>
					<th>
						Dirección completa del inmueble
					</th>
					<th>
						Características del inmueble
					</th>
					<th>
						Dimensiones del inmueble
					</th>
					<th>
						<!--Botón de agregar servicios-->
					</th>
					<th>
						<!--Botón de editar-->
					</th>
					<th>
						<!--Botón de eliminar-->
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($this->model->ListarInmuebleContri($_REQUEST['correlativo']) as $r): ?>
					<tr>
						<td>
							<?php echo $r->id_inmueble; ?>
						</td>
						<td>
							<?php 
			                if($r->zona_inmueble != null){
			                    echo $r->direccion_inmueble . ", Zona: " . $r->zona_inmueble . " (". $r->cod_zona.")";
			                }else{
			                    echo $r->direccion_inmueble;
			                }
			                ?>
						</td>
						<td>
							<?php echo $r->sector_estado; ?>
						</td>
						<td>
							<?php 
							echo <<<text
							Norte: $r->norte_longitud m<br>
							Este: $r->este_longitud m<br>
							Oeste: $r->oeste_longitud m<br>
							Sur: $r->sur_longitud m
							text; 
							?>
						</td>
						<td>
							<a class="btn btn-info" href="?c=Contribuyente&a=Servicios_aplicados&id_inmueble=<?php echo $r->id_inmueble; ?>&correlativo=<?php echo $r->correlativo;?>"><i class="glyphicon glyphicon-list-alt"> Servicios aplicados</i></a>
						</td>
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
			</tbody>
		</table>
	</div>
