<?php 
echo <<<text
    <!--
        A partir de aquí hacia abajo es código HTML del modal personalizado
    -->
    <div class="modal" id="modal-validar-servicio">
        <div class="modal-eliminar" >
            <div class="cabecera-modal">
                <h2 style="padding: 5px;"><i class="glyphicon glyphicon-list"> Mensaje de validación</i></h2>
            </div>
            <div class="cuerpo-modal">
                <h3>Por favor, seleccione al menos un servicio</h3><br>
                <h3>Seleccione al menos un servicio y aplíquelo al menos en una de sus dimensiones</h3>
            </div>
            <div class="footer-modal">
                <button class="btn-modal" style="margin-left:3%;margin-right:2%;" id="cerrar">Cerrar</button>
            </div>
        </div>
    </div>

    <!--
        Hasta aquí termina el código HTML del modal personalizado
    -->

    <!--
        Los Scripts JavaScript que ejecuta el modal
    -->

    
    <!--
        Fin de scripts JavaScript que ejecuta el modal
    -->
text;
?>