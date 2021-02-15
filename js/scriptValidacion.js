function validacion() {

    if( document.getElementById("nombre").value == null || document.getElementById("nombre").value.length == 0 || /^\s+$/.test(document.getElementById("nombre").value) ) {
        alert('[ERROR] El campo nombre es obligatorio');
        return false;
    }else if
        ( document.getElementById("pais").value == null || document.getElementById("pais").value.length == 0 || /^\s+$/.test(document.getElementById("pais").value) ) {
        alert('[ERROR] El campo pais es obligatorio');
        return false;
    }else if
    ( document.getElementById("estilo").value == null || document.getElementById("estilo").value.length == 0 || /^\s+$/.test(document.getElementById("estilo").value) ) {
        alert('[ERROR] El campo estilo es obligatorio');
        return false;
    }else if
    ( isNaN(document.getElementById("unidades").value)||document.getElementById("unidades").value == null || document.getElementById("unidades").value.length == 0 || /^\s+$/.test(document.getElementById("unidades").value)){
        alert('[ERROR] El campo unidades es obligatorio y debe contener un número entero');
        return false;
    }else if
    ( isNaN(document.getElementById("precio").value)||document.getElementById("precio").value == null || document.getElementById("precio").value.length == 0 || /^\s+$/.test(document.getElementById("precio").value)){
        alert('[ERROR] El campo precio es obligatorio y debe contener un valor');
        return false;
    }else if
    ( isNaN(document.getElementById("coleccion").value)||document.getElementById("coleccion").value == null || document.getElementById("coleccion").value.length == 0 || /^\s+$/.test(document.getElementById("coleccion").value)){
        alert('[ERROR] El campo coleccion es obligatorio y debe contener un número');
        return false;
    }else {
        return true;
    }
}