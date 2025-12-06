<?php 
/* VERIFICA SI LA PETICION HTTP ES DE TIPO POST */
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    /* OBTIENE LA ACCION RECIBIDA DEL FORMULARIO, SI NO EXISTE SE ASIGNA UNA CADENA VACIA */
    $accion = $_POST['accion'] ?? '';

    /* SI LA ACCION ES 'VACIAR', SE ELIMINA LA COOKIE 'LISTADESEOS' */
    if($accion === 'vaciar'){
        /* ELIMINA LA COOKIE ESTABLECIENDO SU TIEMPO DE EXPIRACION EN EL PASADO */
        setcookie('listaDeseos', '', time() - 3600, '/');
    }
}

/* REDIRIGE AL USUARIO A LA PAGINA LISTADESEOS.PHP DESPUES DE PROCESAR LA ACCION */
header('Location: listaDeseos.php');
?>
