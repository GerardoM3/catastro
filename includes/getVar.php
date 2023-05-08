<?php
//require 'conexion.php';
$pdo = new PDO('mysql:host=localhost;dbname=catastro;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$mysqli = new mysqli("localhost", "root", "", "catastro");

$conditionNombre = $_GET['var'];
$sentencia = $pdo->prepare("SELECT correlativo, id_contribuyente, CONCAT(id_contribuyente, '-', correlativo) AS cuenta_corr, nombre_contribuyente, apellido_contribuyente, direccion_contribuyente, dui_contribuyente, telefono_contribuyente FROM contribuyente WHERE estado_contribuyente = 1 HAVING cuenta_corr LIKE '%$conditionNombre%' OR nombre_contribuyente LIKE '%$conditionNombre%' OR apellido_contribuyente LIKE '%$conditionNombre%' OR dui_contribuyente LIKE '%$conditionNombre%';");
//$sentencia->bind_param("i", $conditionNombre);
$sentencia->execute();
$html = "";
$i = 1;
//$filas = $sentencia->num_rows;
$filas = $sentencia->rowCount();
//foreach ($this->model->Listar2($conditionNombre) as $rcn):
if($filas > 0){
	while ($rowResult = $sentencia->fetch()) {
		$html .= "<tr>";
		$html .= "<td>". $rowResult['id_contribuyente'] ."-" . $rowResult['correlativo'] . "</td>";
		$html .= "<td>". $rowResult['nombre_contribuyente'] ." " . $rowResult['apellido_contribuyente'] . "</td>";
		$html .= "<td>". $rowResult['direccion_contribuyente'] . "</td>";
		$html .= "<td>". $rowResult['dui_contribuyente'] . "</td>";
		$html .= "<td>". $rowResult['telefono_contribuyente'] . "</td>";
		$html .= "<td><center>";
		$html .= "<a class='btn btn-info' class='enlace-tabla' href='?c=Contribuyente&a=View&id_contribuyente=".$rowResult['id_contribuyente']."&correlativo=".$rowResult['correlativo']."'><i class='glyphicon glyphicon-eye-open'> Vista general</i></a>";
		$html .= "</center></td>";
		$html .= "<td>";
		$html .= "<a class='btn btn-warning' href='?c=Contribuyente&a=Crud&id_contribuyente=".$rowResult['id_contribuyente']."&correlativo=".$rowResult['correlativo']."'><i class='glyphicon glyphicon-edit'> Editar</i></a>";
		$html .= "</td>";
		$html .= "<td>";
		$html .= "<a class='btn btn-danger' id='eliminar-dato-content-main-".$i."' href='#'><i class='glyphicon glyphicon-remove'> Eliminar</i></a>";
		$html .= "<div class='modal' id='modal-eliminar-".$i."'><div class='modal-eliminar'><div class='cabecera-modal'>";
		$html .= "<h2 style='padding: 5px;'>Mensaje de confirmación</h2>";
		$html .= "</div><div class='cuerpo-modal'>";
		$html .= "<h3>¿Está seguro que desea eliminar el siguiente registro?</h3><div style='display:inline-flex;'>";
		$html .= "<div class='desc'>Cuenta corriente: </div><div class='result' style='color:black;'><u>".$rowResult['id_contribuyente']."-".$rowResult['correlativo']."</u></div>";
		$html .= "</div><br><div style='display:inline-flex;'>";
		$html .= "<div class='desc'>Contribuyente: </div><div class='result' style='color:black;'><u>".$rowResult['nombre_contribuyente']." ".$rowResult['apellido_contribuyente']."</u></div>";
		$html .= "</div></div><div class='footer-modal'><div style='margin-right:15%;'>";
		$html .= "<input type='checkbox' name='confirm' id='confirm-".$i."'><label for='confirm-".$i."'>Confirmar</label></div>";
		$html .= "<a href='#' class='btn-modal' type='submit' id='aceptar-".$i."' style='margin-left:0;margin-right:3%;' disabled>Aceptar</a><button class='btn-modal not-active' style='margin-left:3%;margin-right:2%;' id='cancelar-".$i."'>Cancelar</button>";
		$html .= "</div></div></div>";
		$html .= "<script>";
		$html .= "var confirmar_".$i." = document.getElementById('confirm-".$i."');";
		$html .= "confirmar_".$i.".addEventListener('click', ()=>{";
		$html .= "var acept_".$i." = document.getElementById('aceptar-".$i."');";
		$html .= "acept_".$i.".disabled = !acept_".$i.".disabled;});</script>";
		$html .= "<script>";
		$html .= "var eliminar_dato_".$i." = document.getElementById('eliminar-dato-content-main-".$i."');";
		$html .= "var aceptar_eliminar_".$i." = document.getElementById('aceptar-".$i."');";
		$html .= "var cancelar_eliminar_".$i." = document.getElementById('cancelar-".$i."');";
		$html .= "var modal_eliminar_".$i." = document.getElementById('modal-eliminar-".$i."');";
		$html .= "var body = document.getElementsByTagName('body')[0];";
		$html .= "eliminar_dato_".$i.".addEventListener('click', ()=>{";
		$html .= "modal_eliminar_".$i.".style.display = 'block';";
		$html .= "body.style.position = 'static';";
		$html .= "body.style.height = '100%';";
		$html .= "body.style.overflow = 'hidden';});";
		$html .= "cancelar_eliminar_".$i.".addEventListener('click', ()=>{";
		$html .= "modal_eliminar_".$i.".style.display = 'none';";
		$html .= "aceptar_eliminar_".$i.".disabled = true;";
		$html .= "confirmar_".$i.".checked = false;";
		$html .= "body.style.position = 'inherit';";
		$html .= "body.style.height = 'auto';";
		$html .= "body.style.overflow = 'visible';});";
		$html .= "aceptar_eliminar_".$i.".addEventListener('click', ()=>{";
		$html .= "if(confirmar_".$i.".checked){";
		$html .= "aceptar_eliminar_".$i.".setAttribute('href', `?c=Contribuyente&a=Eliminar&id_contribuyente=".$rowResult['id_contribuyente']."&correlativo=".$rowResult['correlativo']."`);";
		$html .= "modal_eliminar_".$i.".style.display = 'none';";
		$html .= "aceptar_eliminar_".$i.".disabled = true;";
		$html .= "confirmar_".$i.".checked = false;}";
		$html .= "body.style.position = 'inherit';";
		$html .= "body.style.height = 'auto';";
		$html .= "body.style.overflow = 'visible';});</script>";
		$html .= "</td></tr>";
		$i++;
	}
}else{
	$html .= "<tr><td colspan='8' id='sin_resultado'><center>Sin resultados</center></td></tr>";
}
//endforeach;
echo $html;
?>