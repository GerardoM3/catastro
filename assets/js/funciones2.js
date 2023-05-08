function habilitar(rango_norte, rango_este, rango_oeste, rango_sur, rango_label_norte, rango_label_este, rango_label_oeste, rango_label_sur, chequeo_norte, chequeo_este, chequeo_oeste, chequeo_sur, chequeo_label_norte, chequeo_label_este, chequeo_label_oeste, chequeo_label_sur, total_celda){

    rango_norte.setAttribute('readonly', false);
    rango_este.setAttribute('readonly', false);
    rango_oeste.setAttribute('readonly', false);
    rango_sur.setAttribute('readonly', false);

    chequeo_label_norte.style.display = "block";
    chequeo_label_este.style.display = "block";
    chequeo_label_oeste.style.display = "block";
    chequeo_label_sur.style.display = "block";

    chequeo_label_norte.style.background = "green";
    chequeo_label_este.style.background = "green";
    chequeo_label_oeste.style.background = "green";
    chequeo_label_sur.style.background = "green";

    chequeo_label_norte.textContent = "Aplicar";
    chequeo_label_este.textContent = "Aplicar";
    chequeo_label_oeste.textContent = "Aplicar";
    chequeo_label_sur.textContent = "Aplicar";

    rango_norte.value = rango_norte.max;
    rango_este.value = rango_este.max;
    rango_oeste.value = rango_oeste.max;
    rango_sur.value = rango_sur.max;

    rango_label_norte.textContent = 'Norte: ' + rango_norte.max + ' m';
    rango_label_este.textContent = 'Este: ' + rango_este.max + ' m';
    rango_label_oeste.textContent = 'Oeste: ' + rango_oeste.max + ' m';
    rango_label_sur.textContent = 'Sur: ' + rango_sur.max + ' m';
    total_celda.textContent = "0.00";
}

function deshabilitar(rango_norte, rango_este, rango_oeste, rango_sur, rango_label_norte, rango_label_este, rango_label_oeste, rango_label_sur, chequeo_norte, chequeo_este, chequeo_oeste, chequeo_sur, chequeo_label_norte, chequeo_label_este, chequeo_label_oeste, chequeo_label_sur, total_celda){

    rango_norte.setAttribute('readonly', true);
    rango_este.setAttribute('readonly', true);
    rango_oeste.setAttribute('readonly', true);
    rango_sur.setAttribute('readonly', true);

    chequeo_label_norte.style.display = "none";
    chequeo_label_este.style.display = "none";
    chequeo_label_oeste.style.display = "none";
    chequeo_label_sur.style.display = "none";

    rango_norte.value = rango_norte.min;
    rango_este.value = rango_este.min;
    rango_oeste.value = rango_oeste.min;
    rango_sur.value = rango_sur.min;

    rango_label_norte.textContent = '';
    rango_label_este.textContent = '';
    rango_label_oeste.textContent = '';
    rango_label_sur.textContent = '';
    total_celda.textContent = "0.00";
}

function rangos(rg_label, rango, label){
    return rg_label.textContent = label + rango.value + ' m';
}

function cajas_chequeo(chequeo, rango, total_celda, tarifa_actual, chequeo_label){
    if (chequeo.checked) {
        total_celda.textContent = (parseFloat(total_celda.textContent) + (parseFloat(tarifa_actual.textContent) * parseFloat(rango.value))).toFixed(2);
        chequeo_label.textContent = "No aplicar";
        chequeo_label.style.background = "red";
    }else{
        total_celda.textContent = (parseFloat(total_celda.textContent) - (parseFloat(tarifa_actual.textContent) * parseFloat(rango.value))).toFixed(2);
        chequeo_label.textContent = "Aplicar";
        chequeo_label.style.background = "green";
    }
}