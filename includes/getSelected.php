<?php 
$pdo = new PDO('mysql:host=localhost;dbname=catastro;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$i = 1;

$seleccion = $_GET['seleccion'];
$north = $_GET['norte_long'];
$east = $_GET['este_long'];
$west = $_GET['oeste_long'];
$south = $_GET['sur_long'];
$sentencia = $pdo->prepare("SELECT * FROM meta_servicios_alcaldia WHERE estado_servicios = 1 AND id_servicio_alcaldia = '$seleccion';");
$sentencia->execute();
$html = "";
$totalService = 0;
$filas = $sentencia->rowCount();
if ($filas > 0) {
	$html .= "<thead><tr>";
	$html .= "<td>Código de servicio</td>";
	$html .= "<td>Servicios</td>";
	$html .= "<td>Valor</td>";
	$html .= "<td>Aplicar a</td>";
	$html .= "<td>Total</td>";
	$html .= "</tr></thead><tbody>";
	while ($rowR = $sentencia->fetch()) {
		$html .= "<tr>";
		$html .= "<td rowspan='4'>".$rowR['id_servicio_alcaldia']."</td>";
		$html .= "<td rowspan='4'>".$rowR['descripcion_servicio']."</td>";
		$html .= "<td rowspan='4'>".$rowR['tarifa_actual']."</td>";
		$html .= "<td><input type='checkbox' name='chkn' id='norte'> <label for='norte'> Norte</label></td>";
		$html .= "<td rowspan='4' id='total_service'>";
		//$html .= $north * $rowR['tarifa_actual'];
		$html .= "</td></tr>";
		$html .= "<tr><td><input type='checkbox' name='chkn' id='este'> <label for='este'> Este</label></td></tr>";
		$html .= "<tr><td><input type='checkbox' name='chkn' id='oeste'> <label for='oeste'> Oeste</label></td></tr>";
		$html .= "<tr><td><input type='checkbox' name='chkn' id='sur'> <label for='sur'> Sur</label></td></tr>";
		$html .= "<script>";
		$html .= "var chk_norte = document.getElementById('norte');";
		$html .= "var chk_este = document.getElementById('este');";
		$html .= "var chk_oeste = document.getElementById('oeste');";
		$html .= "var chk_sur = document.getElementById('sur');";
		$html .= "var ele = document.getElementsByName('chkn');";
		$html .= "var total_service = document.getElementById('total_service');";
		$html .= "for(var i=0; i<ele.length; i++){";
		$html .= "ele[i].addEventListener('change', (e)=>{";
		$html .= "console.log(e.target.id);";

		$html .= "if((e.target.id == 'norte') && (e.target.checked == true)){";
		$totalService += $north*$rowR['tarifa_actual'];
		$html .= "total_service.textContent = ".$totalService.";";
		$html .= "}else if((e.target.id == 'norte') && (e.target.checked == false)){";
		$totalService -= $north*$rowR['tarifa_actual'];
		$html .= "total_service.textContent = ".$totalService.";";
		$html .= "}";

		$html .= "if((e.target.id == 'este') && (e.target.checked == true)){";
		$totalService += $east*$rowR['tarifa_actual'];
		$html .= "total_service.textContent = ".$totalService.";";
		$html .= "}else if((e.target.id == 'este') && (e.target.checked == false)){";
		$totalService -= $east*$rowR['tarifa_actual'];
		$html .= "total_service.textContent = ".$totalService.";}";

		$html .= "if((e.target.id == 'oeste') && (e.target.checked == true)){";
		$totalService += $west*$rowR['tarifa_actual'];
		$html .= "total_service.textContent = ".$totalService.";";
		$html .= "}else if((e.target.id == 'oeste') && (e.target.checked == false)){";
		$totalService -= $west*$rowR['tarifa_actual'];
		$html .= "total_service.textContent = ".$totalService.";}";

		$html .= "if((e.target.id == 'sur') && (e.target.checked == true)){";
		$totalService += $south*$rowR['tarifa_actual'];
		$html .= "total_service.textContent = ".$totalService.";";
		$html .= "}else if((e.target.id == 'sur') && (e.target.checked == false)){";
		$totalService -= $south*$rowR['tarifa_actual'];
		$html .= "total_service.textContent = ".$totalService.";}";

		$html .= "";
		$html .= "});}";

		/*$html .= "if(chk_norte.checked){";
		$totalService = $north * $rowR['tarifa_actual'];
		$html .= "total_service.textContent = '" . $totalService . "';}";
		$html .= "else { ".$rowR['tarifa_actual']." }";
		$html .= "if(chk_este.checked){";
		$totalService = $east * $rowR['tarifa_actual'];
		$html .= "total_service.textContent = '" . $totalService . "';}";
		$html .= "else { ".$rowR['tarifa_actual']." }";
		$html .= "if(chk_oeste.checked){";
		$totalService = $west * $rowR['tarifa_actual'];
		$html .= "total_service.textContent = '" . $totalService . "';}";
		$html .= "else { ".$rowR['tarifa_actual']." }";
		$html .= "if(chk_sur.checked){";
		$totalService = $south * $rowR['tarifa_actual'];
		$html .= "total_service.textContent = '" . $totalService . "';}";
		$html .= "else { ".$rowR['tarifa_actual']." }";*/
		/*$html .= "switch(ele.id){";
		$html .= "case 'norte':";
		$html .= "if(ele.checked){";
		$totalService .= $north * $rowR['tarifa_actual'];
		$html .= "total_service.textContent = '" . $totalService . "';}";
		$html .= "break;";

		$html .= "case 'este':";
		$html .= "if(ele.checked){";
		$totalService .= $east * $rowR['tarifa_actual'];
		$html .= "total_service.textContent = '" . $totalService . "';}";
		$html .= "break;";

		$html .= "case 'oeste':";
		$html .= "if(ele.checked){";
		$totalService .= $west * $rowR['tarifa_actual'];
		$html .= "total_service.textContent = '" . $totalService . "';}";
		$html .= "break;";

		$html .= "case 'sur':";
		$html .= "if(ele.checked){";
		$totalService .= $south * $rowR['tarifa_actual'];
		$html .= "total_service.textContent = '" . $totalService . "';}";
		$html .= "break;";
		$html .= "}";*/
		$html .= "</script>";
		$i++;
	}
	$html .= "</tbody>";
}

echo $html;
?>