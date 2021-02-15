//funcion AJAX

function ajax() {
    try{
        req=new XMLHttpRequest();
    } catch(err1){
        try{
            req=new ActiveXObject("Msxml2.XMLHTTP");
        }catch (err2) {
            try{
                req=new ActiveXObject("Microsoft.XMLHTTP");
            }catch (err3) {
                req=false;
            }
        }
    }
    return req;
}

//funcion ajax para borrar
var borrar= new ajax;
function borrarUsuario(id) {    //se llama como la llame en la pagina y recibe como atributo el id del elemento
    //abriremos una ventana de aceptar para confirmar que queremos borrarlo
    if(confirm("Seguro que desea eliminar este Usuario?")) {   //si le da a aceptar seria true y se ejecuta la accion siguiente
        var myurl = 'llamadas/borrarUsuario.php';
        myRand = parseInt(Math.random() * 999999999999999); //este numero lo añadimos para tema de cache
        modurl = myurl + '?rand=' + myRand + '&id=' + id;
        borrar.open("GET", modurl, true);
        borrar.onreadystatechange = borrarUsuarioResponse();
        borrar.send(null);
    }
}


function borrarUsuarioResponse() {
    if(borrar.readyState==4){
        if(borrar.status==200){
            var listaUsuarios =borrar.responseText;
            document.getElementsByClassName('lista')[0].innerHTML=listaUsuarios;
        }
    }

}