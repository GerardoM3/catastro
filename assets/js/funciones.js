function habilitar(rango_norte, rango_este, rango_oeste, rango_sur, rango_label_norte, rango_label_este, rango_label_oeste, rango_label_sur, chequeo_norte, chequeo_este, chequeo_oeste, chequeo_sur, chequeo_label_norte, chequeo_label_este, chequeo_label_oeste, chequeo_label_sur, total_celda){
    rango_norte.disabled = false;
    rango_este.disabled = false;
    rango_oeste.disabled = false;
    rango_sur.disabled = false;

    chequeo_norte.disabled = false;
    chequeo_este.disabled = false;
    chequeo_oeste.disabled = false;
    chequeo_sur.disabled = false;

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
    rango_norte.disabled = true;
    rango_este.disabled = true;
    rango_oeste.disabled = true;
    rango_sur.disabled = true;

    chequeo_norte.disabled = true;
    chequeo_este.disabled = true;
    chequeo_oeste.disabled = true;
    chequeo_sur.disabled = true;

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
        rango.disabled = true;
        chequeo_label.textContent = "No aplicar";
        chequeo_label.style.background = "red";
    }else{
        total_celda.textContent = (parseFloat(total_celda.textContent) - (parseFloat(tarifa_actual.textContent) * parseFloat(rango.value))).toFixed(2);
        rango.disabled = false;
        chequeo_label.textContent = "Aplicar";
        chequeo_label.style.background = "green";
    }
}

function predeterminado(rango_norte, rango_este, rango_oeste, rango_sur){
    rango_norte.disabled = false;
    rango_este.disabled = false;
    rango_oeste.disabled = false;
    rango_sur.disabled = false;
}