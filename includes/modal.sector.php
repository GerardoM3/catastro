<?php
echo <<<text
    <!--
        A partir de aquí hacia abajo es código HTML del modal personalizado
    -->
    <div class="modal" id="modal-eliminar-$i">
        <div class="modal-eliminar" >
            <div class="cabecera-modal">
                <h2 style="padding: 5px;"><i class="glyphicon glyphicon-remove"> Mensaje de confirmación</i></h2>
            </div>
            <div class="cuerpo-modal">
                <h3>¿Está seguro que desea eliminar el siguiente registro?</h3>
                <div style="display:inline-flex;">
                    <div class="desc">COD Sector: </div>
                    <div class="result" style="color:black;"><u>$r->cod_sector</u></div>
                </div>
                <br>
                <div style="display:inline-flex;">
                    <div class="desc">Sector/Tipo/Estado: </div>
                    <div class="result" style="color:black;"><u>$r->sector_estado</u></div>
                </div>
            </div>
            <div class="footer-modal">
                <div style="margin-right:15%;">
                    <input type="checkbox" name="confirm" id="confirm-$i"><label for="confirm-$i">Confirmar</label>
                </div>
                <a href="#" class="btn-modal" type="submit" id="aceptar-$i" style="margin-left: 0;margin-right:3%;" disabled>Aceptar</a>
                <button class="btn-modal not-active" style="margin-left:3%;margin-right:2%;" id="cancelar-$i">Cancelar</button>
            </div>
        </div>
    </div>

    

    <!--
        Hasta aquí termina el código HTML del modal personalizado
    -->

    <!--
        Los Scripts JavaScript que ejecuta el modal
    -->

    <script>
        var confirmar_$i = document.getElementById('confirm-$i');

        confirmar_$i.addEventListener('click', ()=>{
            var acept_$i = document.getElementById('aceptar-$i');
            acept_$i.disabled = !acept_$i.disabled;
        });
    </script>

    <script>

        var eliminar_dato_$i = document.getElementById('eliminar-dato-content-main-$i');
        var aceptar_eliminar_$i = document.getElementById('aceptar-$i');
        var cancelar_eliminar_$i = document.getElementById('cancelar-$i');
        var modal_eliminar_$i = document.getElementById('modal-eliminar-$i');
        var body = document.getElementsByTagName("body")[0];

        eliminar_dato_$i.addEventListener('click', ()=>{
            modal_eliminar_$i.style.display = "block";

            body.style.position = "static";
            body.style.height = "100%";
            body.style.overflow = "hidden";
        });
        cancelar_eliminar_$i.addEventListener('click', ()=>{
            modal_eliminar_$i.style.display = "none";
            aceptar_eliminar_$i.disabled = true;
            confirmar_$i.checked = false;

            body.style.position = "inherit";
            body.style.height = "auto";
            body.style.overflow = "visible";
        });

        aceptar_eliminar_$i.addEventListener('click', ()=>{
                if(confirmar_$i.checked){
                    aceptar_eliminar_$i.setAttribute('href', `?c=Sector&a=Eliminar&cod_sector=$r->cod_sector`);
                    modal_eliminar_$i.style.display = "none";
                    aceptar_eliminar_$i.disabled = true;
                    confirmar_$i.checked = false;
                }
                body.style.position = "inherit";
                body.style.height = "auto";
                body.style.overflow = "visible";
            });

        
    </script>
    <!--
        Fin de scripts JavaScript que ejecuta el modal
    -->
text;
?>